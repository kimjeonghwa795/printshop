<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(0);

class facebook_oauth
{
    const SCHEME = 'https';
    const HOST = 'graph.facebook.com';
    const AUTHORIZE_URI = '/oauth/authorize';
    const REQUEST_URI   = '/oauth/request_token';
    const ACCESS_URI    = '/oauth/access_token';
    const USERINFO_URI    = '/me';
    
    //Array that should contain the consumer secret and
    //key which should be passed into the constructor.
    private $_consumer = false;
    
    /**
     * Pass in a parameters array which should look as follows:
     * array('key'=>'example.com', 'secret'=>'mysecret');
     * Note that the secret should either be a hash string for
     * HMAC signatures or a file path string for RSA signatures.
     *
     * @param array $params
     */
    public function facebook_oauth($params)
    {
        $this->CI = get_instance();
        $this->CI->load->helper('oauth');
        
        if(!array_key_exists('method', $params))$params['method'] = 'GET';
        if(!array_key_exists('algorithm', $params))$params['algorithm'] = OAUTH_ALGORITHMS::HMAC_SHA1;
        
        $this->_consumer = $params;
    }
    
    /**
     * This is called to begin the oauth token exchange. This should only
     * need to be called once for a user, provided they allow oauth access.
     * It will return a URL that your site should redirect to, allowing the
     * user to login and accept your application.
     *
     * @param string $callback the page on your site you wish to return to
     *                         after the user grants your application access.
     * @return mixed either the URL to redirect to, or if they specified HMAC
     *         signing an array with the token_secret and the redirect url
     */
    public function get_request_token($callback, $is_popup=false)
    {
        /*$baseurl = self::SCHEME.'://'.self::HOST.self::AUTHORIZE_URI;

        //Generate an array with the initial oauth values we need
        $auth = build_auth_array($baseurl, $this->_consumer['key'], $this->_consumer['secret'],
                                 array('oauth_callback'=>urlencode($callback)),
                                 $this->_consumer['method'], $this->_consumer['algorithm']);
        //Create the "Authorization" portion of the header
        $str = "";
        foreach($auth as $key => $value)
            $str .= ",{$key}=\"{$value}\"";
        $str = 'Authorization: OAuth '.substr($str, 1);
        //Send it
        $response = $this->_connect($baseurl, $str);
        //We should get back a request token and secret which
        //we will add to the redirect url.
        parse_str($response, $resarray);*/
        //Return the full redirect url and let the user decide what to do from there.
        $display = ($is_popup==true)?'popup':'page';
        $redirect = self::SCHEME.'://'.self::HOST.self::AUTHORIZE_URI."?type=web_server&scope=email&display=$display&client_id=".$this->_consumer['key']."&redirect_uri=".urlencode($callback);
        //$response = $this->_connect($redirect, '');
        //var_dump($response);
        header("Location: $redirect");
        exit();
        //If they are using HMAC then we need to return the token secret for them to store.
        /*if($this->_consumer['algorithm'] == OAUTH_ALGORITHMS::RSA_SHA1)return $redirect;
        else return array('token_secret'=>$resarray['oauth_token_secret'], 'redirect'=>$redirect);*/
    }
    
    /**
     * This is called to finish the oauth token exchange. This too should
     * only need to be called once for a user. The token returned should
     * be stored in your database for that particular user.
     *
     * @param string $token this is the oauth_token returned with your callback url
     * @param string $secret this is the token secret supplied from the request (Only required if using HMAC)
     * @param string $verifier this is the oauth_verifier returned with your callback url
     * @return array access token and token secret
     */
    public function get_access_token($callback = false, $secret = false)
    {
  
        if($secret !== false)$tokenddata['oauth_token_secret'] = urlencode($secret);

        $baseurl = self::SCHEME.'://'.self::HOST.self::ACCESS_URI."?client_id=".$this->_consumer['key']."&redirect_uri=".urlencode($callback)."&client_secret=".$this->_consumer['secret']."&code=$secret";

        $response = $this->_connect($baseurl, '');
		
        //Parse the response into an array it should contain
        //both the access token and the secret key. (You only
        //need the secret key if you use HMAC-SHA1 signatures.)
        if (strpos($response, 'error')!==false)
        {
            if (function_exists('json_decode'))
            {
                $a = json_decode($response);
            }
            else
            {
                require_once(PATH_THIRD.'social_login/libraries/inc/JSON.php');
                $json = new Services_JSON();
                $a = $json->decode($response);
            }
            $oauth['oauth_problem'] = $a->error->message;
        } 
        else
        {                            
            //parse_str($response, $oauth);        
			$oauth = (array)json_decode($response);
        }   
        //Return the token and secret for storage
        return $oauth;
    }
    
    /**
     * Connects to the server and sends the request,
     * then returns the response from the server.
     * @param <type> $url
     * @param <type> $auth
     * @return <type>
     */
    private function _connect($url, $auth)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
        //curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($auth));

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    function get_user_data($response = array()){
		
        $baseurl = self::SCHEME.'://'.self::HOST.self::USERINFO_URI."?fields=id,name,email,bio,location,link,timezone,first_name,last_name,gender&access_token=".$response['access_token'];
		
        $response = $this->_connect($baseurl, array());
        
        if (function_exists('json_decode'))
        {
            $rawdata = json_decode($response);
        }
        else
        {
            require_once(PATH_THIRD.'social_login/libraries/inc/JSON.php');
            $json = new Services_JSON();
            $rawdata = $json->decode($response);
        }

        $data = array();
        $data['username'] = (isset($rawdata->username))?$rawdata->username:$rawdata->id.'@facebook';
        $data['screen_name'] = $rawdata->name;
        $data['email'] = (isset($rawdata->email))?$rawdata->email:'';
        $data['location'] = $rawdata->location->name;
        $fb_url = (isset($rawdata->username))?'http://www.facebook.com/'.$rawdata->username:'http://www.facebook.com/profile.php?id='.$rawdata->id;
        $data['url'] = ($rawdata->link!='')?$rawdata->link:$fb_url;
        $data['custom_field'] = (isset($rawdata->username))?$rawdata->username:$rawdata->id;
        $data['alt_custom_field'] = $rawdata->id;
        $data['avatar'] = 'http://graph.facebook.com/'.$rawdata->id.'/picture';
        $data['photo'] = 'http://graph.facebook.com/'.$rawdata->id.'/picture?type=large';
        
        /*$baseurl = 'https://graph.facebook.com/'.$data['alt_custom_field'].'?fields=cover&access_token='.$access_token;
        $response = $this->_connect($baseurl, array());
        if (function_exists('json_decode'))
        {
            $rawdata = json_decode($response);
        }
        else
        {
            $rawdata = $json->decode($response);
        }        
        $data['photo'] = (isset($rawdata->cover->source))?$rawdata->cover->source:$data['photo'];
        */
        
        return $data;
    }
}
// ./system/application/libraries
?>