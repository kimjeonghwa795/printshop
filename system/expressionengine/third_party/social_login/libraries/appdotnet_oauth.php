<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(0);

class Appdotnet_oauth
{
    const SCHEME = 'https';
    const HOST = 'alpha.app.net';
    const AUTHORIZE_URI = '/oauth/authorize';
    const REQUEST_URI   = '/oauth/request_token';
    const ACCESS_URI    = '/oauth/access_token';
    const USERINFO_URI    = 'alpha-api.app.net/stream/0/users/me';
    
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
    public function appdotnet_oauth($params)
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
    public function get_request_token($callback, $will_post=true)
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
        $scope = "basic,email,write_post,follow";
        if ($will_post==true) $scope .= "";
        $redirect = self::SCHEME.'://'.self::HOST.self::AUTHORIZE_URI."?response_type=code&scope=$scope&client_id=".$this->_consumer['key']."&redirect_uri=".urlencode($callback);
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

        $baseurl = self::SCHEME.'://'.self::HOST.self::ACCESS_URI;

        $response = $this->_connect($baseurl, '', "client_id=".$this->_consumer['key']."&grant_type=authorization_code&redirect_uri=".urlencode($callback)."&client_secret=".$this->_consumer['secret']."&code=".$_GET['code']);

        //Parse the response into an array it should contain
        //both the access token and the secret key. (You only
        //need the secret key if you use HMAC-SHA1 signatures.)
        
        $oauth = array();
        
        if (function_exists('json_decode'))
        {
            $a = json_decode($response);
        }
        else
        {
            require_once(PATH_THIRD.'social_login_pro/libraries/inc/JSON.php');
            $json = new Services_JSON();
            $a = $json->decode($response);
        }
            
        if (strpos($response, 'error')!==false)
        {
            $oauth['oauth_problem'] = $a->error;
        } 
        else
        {
        	$oauth['access_token'] = $a->access_token;
        	$oauth['username'] = $a->username;
        	$oauth['remote_user_id'] = $a->user_id;
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
    private function _connect($url, $auth,$data=false)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
        //curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($auth));
        
        if ($data!==false)
        {
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }

        $response = curl_exec($ch);

        curl_close($ch);
        return $response;
    }
    
    function get_user_data($response = array())
    {
        $access_token = $response['access_token'];
        $baseurl = self::SCHEME.'://'.self::USERINFO_URI."?access_token=".$access_token;

        $response = $this->_connect($baseurl, array());
       
        if (function_exists('json_decode'))
        {
            $rawdata = json_decode($response);
        }
        else
        {
            require_once(PATH_THIRD.'social_login_pro/libraries/inc/JSON.php');
            $json = new Services_JSON();
            $rawdata = $json->decode($response);
        }            

        $data = array();
        $data['username'] = (isset($rawdata->data->username))?$rawdata->data->username:$rawdata->data->id.'@app.net';
        $data['screen_name'] = $rawdata->data->name;
        $data['bio'] = $rawdata->data->description->text;
        $data['occupation'] = '';
        $data['email'] = $rawdata->data->email;
        $data['location'] = '';
        $data['url'] = $rawdata->data->canonical_url;
        $data['custom_field'] = (isset($rawdata->data->username))?$rawdata->data->username:$rawdata->data->id;
        $data['alt_custom_field'] = $rawdata->data->id;
        $data['avatar'] = $rawdata->data->avatar_image->url;
        $data['photo'] = $rawdata->data->cover_image->url;
        $data['status_message'] = '';
        $data['timezone'] = $rawdata->data->timezone;
        
        $data['full_name'] = $rawdata->data->name;
        $data['first_name'] = substr($rawdata->data->name, 0, strpos($rawdata->data->name, " "));
        $data['last_name'] = substr($rawdata->data->name, strpos($rawdata->data->name, " ")+1);
        $data['gender'] = '';
        /*
        $baseurl = self::SCHEME.'://'.self::HOST.self::USERINFO_URI."/feed?access_token=".$access_token;
        $response = $this->_connect($baseurl, array());
        if (function_exists('json_decode'))
        {
            $rawdata = json_decode($response);
        }
        else
        {
            $rawdata = $json->decode($response);
        }        
        foreach ($rawdata->data as $message)
        {
            if ($message->type=='status')
            {
                $data['status_message'] = $message->message;
                break;
            }
        }
*/
        return $data;
    }
    
    

    
    
}
// ./system/application/libraries
?>