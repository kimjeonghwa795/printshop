<?php
/*
Copyright (C) 2008 Robert Wallis
*/

$plugin_info = array(
	'pi_name'			=> 'Number Format',
	'pi_version'		=> '1.2',
	'pi_author'			=> 'Robert Wallis',
	'pi_author_url'		=> 'http://jubjub.com/',
	'pi_description'	=> 'Exposes PHP\'s <a href="http://php.net/manual/en/function.number-format.php">number_format()</a> function via EE tags.',
	'pi_usage'			=> Number_format::usage()
);

class Number_format{
	function Number_format($number = ''){
		$TMPL = ee()->TMPL;
		
		if ($number == '' && FALSE === ($number = $TMPL->fetch_param("number")))
			$number = $TMPL->tagdata;
		
		$this->return_data = number_format(	trim($number),
				(FALSE === $TMPL->fetch_param("decimals"))	? NULL : round($TMPL->fetch_param("decimals")),
				(FALSE === $TMPL->fetch_param("dec_point"))	? NULL : $TMPL->fetch_param("dec_point"),
				(FALSE === $TMPL->fetch_param("thousands_sep"))	? NULL : $TMPL->fetch_param("thousands_sep")
                        );
    } // Number_format
    
// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.

	function usage()
	{
		return 'This is really just a wrapper for PHP\'s number_format function:
http://us.php.net/manual/en/function.number-format.php

{exp:number_format number="1234.56"}
returns: 1,235

{exp:number_format number="1234.56" decimals="2" dec_point="." thousands_sep=","}
returns: 1,234.56

{exp:number_format decimals="2"}
	156730.236
{/exp:number_format}
returns: 156,730.24
';
	} // usage()

} // class

?>