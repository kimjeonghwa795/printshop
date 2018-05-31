<?php

$lang = array(

//----------------------------
// General word list
//----------------------------
"register" => "Daftar",
    
'no' => 'Tidak',

'yes' => 'Ya',

'on' => 'on',

'off' => 'off',

'first' => 'Pertama',

'last' => 'Terakhir',

'enabled' =>
'enabled',

'disabled' =>
'disabled',

'back' => 'Kembali',

'submit' => 'Kirim',

'update' => 'Perbarui',

'thank_you' => 'Terima Kasih!',

'page' => 'Halaman',

'of' => 'dari',

'by' => 'oleh',

'at' => 'di ',

'dot' => 'dot',

'and' => 'dan',

'or' => 'atau',

'id' => 'ID',

'encoded_email' =>
'(JavaScript must be enabled to view this email address)',

'search' => 'Cari',

'system_off_msg' =>
'This site is currently inactive.',

'not_authorized' =>
'You are not authorized to perform this action',

'auto_redirection' =>
'Anda akan dialihkan dalam %x detik',

'click_if_no_redirect' =>
'Klik disini jika tidak langsung dialihkan',

'return_to_previous' =>
'Kembali ke halaman sebelumnya',

'not_available' =>
'Tidak Tersedia',

'setting' =>
'Setting',

'preference' =>
'Preference',

'pag_first_link' => '&lsaquo; Pertama',
'pag_last_link' => 'Terakhir &rsaquo;',

//----------------------------
// Errors
//----------------------------

'error' =>
'Error',

'generic_fatal_error' =>
'Something has gone wrong and this URL cannot be processed at this time.',

'invalid_url' =>
'The URL you submitted is not valid.',

'submission_error' =>
'The form you submitted contained the following errors',

'general_error' =>
'The following errors were encountered',

'invalid_action' =>
'The action you have requested is invalid.',

'csrf_token_expired' =>
'This form has expired. Please refresh and try again.',

'current_password_required' =>
'Membutuhkan password Anda saat ini.',

'current_password_incorrect' =>
'Password yang Anda kirim salah.',

'captcha_required' =>
'You must submit the word that appears in the image',

'captcha_incorrect' =>
'You did not submit the word exactly as it appears in the image',

'nonexistent_page' =>
'Halaman yang Anda tuju tidak tersedia',

'unable_to_load_field_type' =>
'Unable to load requested field type file:  %s.<br />
Confirm the fieldtype file is located in the expressionengine/third_party/ directory',

'unwritable_cache_folder' =>
'Your cache folder does not have proper permissions.<br>
To fix: Set the cache folder (/expressionengine/cache/) permissions to 777 (or equivalent for your server).',

'unwritable_config_file' =>
'Your configuration file does not have the proper permissions.<br>
To fix: Set the config file (/expressionengine/config/config.php) permissions to 666 (or equivalent for your server).',

'redirect_xss_fail' => 'The link you are being redirected to contained some
potentially malicious or dangerous code. We recommend you hit the back button
and email %s to report the link that generated this message.',

'missing_mime_config' =>
'Cannot import your mime-type whitelist: the file %s does not exist or cannot be read.',

'file_not_found' =>
'File %s tidak ditemukan.',

//----------------------------
// Member Groups
//----------------------------

'banned' =>
'Banned',

'guests' =>
'Tamu',

'members' =>
'Anggota',

'pending' =>
'Pending',

'super_admins' =>
'Super Admins',


//----------------------------
// Template.php
//----------------------------

'error_tag_syntax' =>
'The following tag has a syntax error:',

'error_fix_syntax' =>
'Please correct the syntax in your template.',

'error_tag_module_processing' =>
'The following tag cannot be processed:',

'error_fix_module_processing' =>
'Please check that the \'%x\' module is installed and that \'%y\' is an available method of the module',

'template_loop' =>
'You have caused a template loop due to improperly nested sub-templates (\'%s\' recursively called)',

'template_load_order' =>
'Template load order',

'error_multiple_layouts' =>
'Multiple Layouts found, please ensure you only have one layout tag per template',

'error_layout_too_late' =>
'Plugin or module tag found before layout declaration. Please move the layout tag to the top of your template.',

'error_invalid_conditional' =>
'You have an invalid conditional in your template. Please review your conditionals for an unclosed string, invalid operators, a missing }, or a missing {/if}.',

'layout_contents_reserved' =>
'The name "contents" is reserved for the template data and cannot be used as a layout variable (i.e. {layout:set name="contents"} or {layout="foo/bar" contents=""}).',

//----------------------------
// Email
//----------------------------

'forgotten_email_sent' =>
'If this email address is associated with an account, instructions for resetting your password have just been emailed to you.',

'error_sending_email' =>
'Unable to send email at this time.',

'no_email_found' =>
'The email address you submitted was not found in the database.',

'password_reset_flood_lock' =>
'You have tried to reset your password too many times today. Please check your inbox and spam folders for previous requests, or contact the site administrator.',

'your_new_login_info' =>
'Login information',

'password_has_been_reset' =>
'Your password was reset and a new one has been emailed to you.',

//----------------------------
// Date
//----------------------------

'singular' =>
'satu',

'less_than' =>
'less than',

'about' =>
'sekitar',

'past' =>
'%s lalu',

'future' =>
'dalam %s',

'ago' =>
'%x lalu',

'year' =>
'tahun',

'years' =>
'tahun',

'month' =>
'bulan',

'months' =>
'bulan',

'fortnight' =>
'fortnight',

'fortnights' =>
'fortnights',

'week' =>
'minggu',

'weeks' =>
'minggu',

'day' =>
'hari',

'days' =>
'hari',

'hour' =>
'jam',

'hours' =>
'jam',

'minute' =>
'menit',

'minutes' =>
'menit',

'second' =>
'detik',

'seconds' =>
'detik',

'am' =>
'am',

'pm' =>
'pm',

'AM' =>
'AM',

'PM' =>
'PM',

'Sun' =>
'Mgg',

'Mon' =>
'Sen',

'Tue' =>
'Sel',

'Wed' =>
'Rab',

'Thu' =>
'Kam',

'Fri' =>
'Jum',

'Sat' =>
'Sab',

'Su' =>
'M',

'Mo' =>
'S',

'Tu' =>
'S',

'We' =>
'R',

'Th' =>
'K',

'Fr' =>
'J',

'Sa' =>
'S',

'Sunday' =>
'Minggu',

'Monday' =>
'Senin',

'Tuesday' =>
'Selasa',

'Wednesday' =>
'Rabu',

'Thursday' =>
'Kamis',

'Friday' =>
'Jumat',

'Saturday' =>
'Sabtu',


'Jan' =>
'Jan',

'Feb' =>
'Feb',

'Mar' =>
'Mar',

'Apr' =>
'Apr',

'May' =>
'May',

'Jun' =>
'Jun',

'Jul' =>
'Jul',

'Aug' =>
'Aug',

'Sep' =>
'Sep',

'Oct' =>
'Oct',

'Nov' =>
'Nov',

'Dec' =>
'Dec',

'January' =>
'Januari',

'February' =>
'Februari',

'March' =>
'Maret',

'April' =>
'April',

'May_l' =>
'Mei',

'June' =>
'Juni',

'July' =>
'Juli',

'August' =>
'Agustus',

'September' =>
'September',

'October' =>
'Oktober',

'November' =>
'November',

'December' =>
'Desember',


'UM12'		=>	'(UTC -12:00) Baker/Howland Island',
'UM11'		=>	'(UTC -11:00) Niue',
'UM10'		=>	'(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti',
'UM95'		=>	'(UTC -9:30) Marquesas Islands',
'UM9'		=>	'(UTC -9:00) Alaska Standard Time, Gambier Islands',
'UM8'		=>	'(UTC -8:00) Pacific Standard Time, Clipperton Island',
'UM7'		=>	'(UTC -7:00) Mountain Standard Time',
'UM6'		=>	'(UTC -6:00) Central Standard Time',
'UM5'		=>	'(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time',
'UM45'		=>	'(UTC -4:30) Venezuelan Standard Time',
'UM4'		=>	'(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time',
'UM35'		=>	'(UTC -3:30) Newfoundland Standard Time',
'UM3'		=>	'(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay',
'UM2'		=>	'(UTC -2:00) South Georgia/South Sandwich Islands',
'UM1'		=>	'(UTC -1:00) Azores, Cape Verde Islands',
'UTC'		=>	'(UTC) Greenwich Mean Time, Western European Time',
'UP1'		=>	'(UTC +1:00) Central European Time, West Africa Time',
'UP2'		=>	'(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time',
'UP3'		=>	'(UTC +3:00) East Africa Time, Arabia Standard Time',
'UP35'		=>	'(UTC +3:30) Iran Standard Time',
'UP4'		=>	'(UTC +4:00) Moscow Time, Azerbaijan Standard Time',
'UP45'		=>	'(UTC +4:30) Afghanistan',
'UP5'		=>	'(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time',
'UP55'		=>	'(UTC +5:30) Indian Standard Time, Sri Lanka Time',
'UP575'		=>	'(UTC +5:45) Nepal Time',
'UP6'		=>	'(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time',
'UP65'		=>	'(UTC +6:30) Cocos Islands, Myanmar',
'UP7'		=>	'(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam',
'UP8'		=>	'(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time',
'UP875'		=>	'(UTC +8:45) Australian Central Western Standard Time',
'UP9'		=>	'(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time',
'UP95'		=>	'(UTC +9:30) Australian Central Standard Time',
'UP10'		=>	'(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time',
'UP105'		=>	'(UTC +10:30) Lord Howe Island',
'UP11'		=>	'(UTC +11:00) Magadan Time, Solomon Islands, Vanuatu',
'UP115'		=>	'(UTC +11:30) Norfolk Island',
'UP12'		=>	'(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time',
'UP1275'	=>	'(UTC +12:45) Chatham Islands Standard Time',
'UP13'		=>	'(UTC +13:00) Samoa Time Zone, Phoenix Islands Time, Tonga',
'UP14'		=>	'(UTC +14:00) Line Islands',

"select_timezone" =>
"Select Timezone",

"no_timezones" =>
"No Timezones",

// IGNORE
''=>'');
/* End of file core_lang.php */
/* Location: ./system/expressionengine/language/english/core_lang.php */
