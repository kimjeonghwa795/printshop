<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * Format Text Plugin
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Plugin
 * @author		EllisLab Docs
 * @link		http://expressionengine.com/user_guide/development/plugins.html
 */

$plugin_info = array(
	'pi_name'		=> 'Format',
	'pi_version'	=> '1.0.0',
	'pi_author'		=> 'EllisLab Docs',
	'pi_author_url'	=> 'http://expressionengine.com/user_guide/development/plugins.html',
	'pi_description'=> 'Formats text',
	'pi_usage'		=> Text::usage()
);

 class Text{

  function __construct(){
    $this->EE =& get_instance();
    $parameter = $this->EE->TMPL->fetch_param('type');	
	if($parameter) $this->__call($parameter);
  }
  
  function __call($key,$param=''){	
	$parameter = $key ? $key :$this->EE->TMPL->fetch_param('type');
	
    switch ($parameter){
      case 'uppercase':
        return strtoupper($this->EE->TMPL->tagdata);
        break;
      case 'lowercase':
        return  strtolower($this->EE->TMPL->tagdata);
        break;
	  case 'nl2br':
        return  nl2br($this->EE->TMPL->tagdata);
        break;	  
	  case 'replace':
		$neddle = $this->EE->TMPL->fetch_param('find');
		$replace = $this->EE->TMPL->fetch_param('replacement');
		return str_replace($neddle,$replace,$this->EE->TMPL->tagdata);
	  case 'substr':
		$start = (int)$this->EE->TMPL->fetch_param('start');
		$length = (int)$this->EE->TMPL->fetch_param('length');
		return ($length) ? substr($this->EE->TMPL->tagdata,$start,$length) : substr($this->EE->TMPL->tagdata,$start);
	  case 'wrap': 
		$length = (int)$this->EE->TMPL->fetch_param('length');
		$break = $this->EE->TMPL->fetch_param('break') ? $this->EE->TMPL->fetch_param('break') : '<br/>';
		return substr($this->EE->TMPL->tagdata,$length) ;
      case 'bold' :
        return  "<strong>".$this->EE->TMPL->tagdata."</strong>";
        break;
      case 'italic':
        return  "<i>".$this->EE->TMPL->tagdata."</i>";
        break;
	  case "number" : 
		$number = $this->EE->TMPL->tagdata ?  (float)$this->EE->TMPL->tagdata : (float)$this->EE->TMPL->fetch_param('number');
		return number_format($number,0,',','.');
		break;
	  case "currency" : 	  
		$number = $this->EE->TMPL->tagdata ?  (float)$this->EE->TMPL->tagdata : (float)$this->EE->TMPL->fetch_param('number');
		$currency = $this->EE->TMPL->fetch_param('symbol') ? $this->EE->TMPL->fetch_param('symbol') : 'Rp' ;
		return  $currency .' '. number_format($number,0,',','.');
		break;
      default:
        // did not specify type, return data untouched
        return $this->EE->TMPL->tagdata;
        break;
    }
  }
	// ----------------------------------------------------------------
	
	/**
	 * Plugin Usage
	 */
	public static function usage()
	{
		ob_start();
?>
  {exp:format type="uppercase"}This should be converted to uppercase{/exp:format}
  
  Format text to be bold, uppercase, lowercase, italic
  
  type options: uppercase, lowercase, bold, italic
<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}


/* End of file pi.format.php */
/* Location: /system/expressionengine/third_party/format/pi.format.php */