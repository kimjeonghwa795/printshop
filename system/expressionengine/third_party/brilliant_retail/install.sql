
--  ------------------------------   Records of exp_global_variables--  ----------------------------
INSERT INTO exp_global_variables (site_id, variable_name, variable_data) 
VALUES ('1', 'theme', '/themes/site_themes/brilliant_retail');
--  ------------------------------   Table structure for exp_br_admin_access--  ----------------------------
DROP TABLE IF EXISTS exp_br_admin_access;
CREATE TABLE exp_br_admin_access (  
admin_access_id int(11) NOT NULL AUTO_INCREMENT,  
site_id int(11) NOT NULL DEFAULT '1',  
group_id int(11) NOT NULL DEFAULT '1',  
class varchar(255) NOT NULL,  
method varchar(255) NOT NULL,  
created datetime NOT NULL,  
PRIMARY KEY (admin_access_id)) 
ENGINE=MyISAM DEFAULT CHARSET=utf8;


--  ----------------------------
--   Table structure for exp_br_attribute
--  ----------------------------
DROP TABLE IF EXISTS exp_br_attribute;
CREATE TABLE exp_br_attribute (  attribute_id int(11) NOT NULL AUTO_INCREMENT,  site_id int(11) NOT NULL DEFAULT '1',  title varchar(50) NOT NULL,  code varchar(50) NOT NULL,  required int(11) NOT NULL DEFAULT '0',  fieldtype varchar(255) NOT NULL,  filterable int(11) NOT NULL DEFAULT '1',  default_text varchar(255) DEFAULT NULL,  options text,  PRIMARY KEY (attribute_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  -----------------------------------
--   Records of exp_br_attribute_option
--  -----------------------------------
DROP TABLE IF EXISTS exp_br_attribute_option;
CREATE TABLE exp_br_attribute_option (attr_option_id int(11) NOT NULL AUTO_INCREMENT,attribute_id int(11) DEFAULT NULL,label varchar(100) DEFAULT NULL,sort int(11) DEFAULT NULL,created datetime DEFAULT NULL,PRIMARY KEY (attr_option_id),KEY br_attribute_id (attribute_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*
INSERT INTO `exp_br_attribute_option` 
(`attr_option_id`, `attribute_id`, `label`, `sort`, `created`) 
VALUES
(1, 19, 'Black', 0, '2013-09-23 10:21:42'),
(2, 19, 'Blue', 1, '2013-09-23 10:21:42'),
(3, 19, 'Brown', 2, '2013-09-23 10:21:42'),
(4, 19, 'Gray', 3, '2013-09-23 10:21:42'),
(5, 19, 'Green', 4, '2013-09-23 10:21:42'),
(6, 19, 'Orange', 5, '2013-09-23 10:21:42'),
(7, 19, 'Red', 6, '2013-09-23 10:21:42'),
(8, 19, 'White', 7, '2013-09-23 10:21:42'),
(9, 19, 'Yellow', 8, '2013-09-23 10:21:42'),
(10, 21, 'X-Small', 0, '2013-09-23 10:21:42'),
(11, 21, 'Small', 1, '2013-09-23 10:21:42'),
(12, 21, 'Medium', 2, '2013-09-23 10:21:42'),
(13, 21, 'Large', 3, '2013-09-23 10:21:42'),
(14, 21, 'X-Large', 4, '2013-09-23 10:21:42'),
(15, 21, 'XX-Large', 5, '2013-09-23 10:21:42'),
(16, 19, 'Bittersweet', 0, '2013-09-23 10:21:42'),
(17, 19, 'Apricot', 0, '2013-09-23 10:21:42'),
(18, 19, 'Apricot', 0, '2013-09-23 10:21:42'),
(19, 21, 'xx-small', 0, '2013-09-23 10:21:42'),
(20, 19, 'Apricot', 0, '2013-09-23 10:21:42'),
(21, 21, 'xxx-small', 0, '2013-09-23 10:21:42');
*/
--  ----------------------------
--   Table structure for exp_br_attribute_set
--  ----------------------------
DROP TABLE IF EXISTS exp_br_attribute_set;
CREATE TABLE exp_br_attribute_set (  attribute_set_id int(11) NOT NULL AUTO_INCREMENT,  site_id int(11) NOT NULL DEFAULT '1',  title varchar(255) NOT NULL,  created TIMESTAMP NOT NULL DEFAULT current_timestamp,  sort_order int(11) NOT NULL DEFAULT 1 ,  PRIMARY KEY (attribute_set_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records of exp_br_attribute_set
--  ----------------------------
-- INSERT INTO exp_br_attribute_set VALUES ('1', '1', 'Default', '2010-06-22 13:15:18', '0'), ('6', '1', 'Attachment', '0000-00-00 00:00:00', '0');

--  ----------------------------
--   Table structure for exp_br_attribute_set_attribute
--  ----------------------------
DROP TABLE IF EXISTS exp_br_attribute_set_attribute;
CREATE TABLE exp_br_attribute_set_attribute (  atrribute_set_attribte_id int(11) NOT NULL AUTO_INCREMENT,  attribute_id int(11) NOT NULL,  attribute_set_id int(11) NOT NULL,  sort_order int(11) NOT NULL,  PRIMARY KEY (atrribute_set_attribte_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records of exp_br_attribute_set_attribute
--  ----------------------------
-- INSERT INTO exp_br_attribute_set_attribute VALUES ('80', '27', '6', '1'),('79', '22', '6', '0'),('72', '22', '1', '0');

--  ----------------------------
--   Table structure for exp_br_cart
--  ----------------------------
DROP TABLE IF EXISTS exp_br_cart;
CREATE TABLE exp_br_cart (  cart_id int(11) NOT NULL AUTO_INCREMENT,  
    member_id int(11) NOT NULL DEFAULT '0',  
    session_id varchar(100) NOT NULL,  
    order_id int(11) NULL, 
    content text NOT NULL, 
    created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  
    updated timestamp NULL DEFAULT NULL, 
    status int(11) NOT NULL DEFAULT '0', 
    ip varchar(100) NOT NULL, 
    coupon_code varchar(255)  NULL, 
    token varchar(150) NULL,
PRIMARY KEY (cart_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_category
--  ----------------------------
DROP TABLE IF EXISTS exp_br_category;
CREATE TABLE exp_br_category (
  category_id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT '1',
  parent_id int(11) NOT NULL DEFAULT '0',
  title varchar(255) NOT NULL,
  url_title varchar(100) NOT NULL,
  image varchar(100) NOT NULL DEFAULT '/media/images/cat_banner_01.jpg',
  meta_title varchar(255) NOT NULL DEFAULT '',
  meta_descr varchar(255) NOT NULL DEFAULT '',
  enabled int(11) NOT NULL DEFAULT '1',
  meta_keyword varchar(255) NOT NULL DEFAULT '',
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  sort int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (category_id),
  template_path varchar(100) DEFAULT NULL, 
  detail text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--  ----------------------------
--   Table structure for exp_br_config
--  ----------------------------
DROP TABLE IF EXISTS exp_br_config;
CREATE TABLE exp_br_config (
  config_id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT '1',
  title varchar(255) NOT NULL,
  label varchar(100) NOT NULL,
  code varchar(100) NOT NULL,
  type varchar(100) NOT NULL,
  enabled int(11) NOT NULL DEFAULT '0',
  groups varchar(100) NOT NULL DEFAULT '0',
  descr varchar(255) NOT NULL,
  version float(10,1) NOT NULL,
  sort int(11) NOT NULL DEFAULT '1',
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (config_id)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records of exp_br_config
--  ----------------------------
INSERT INTO exp_br_config (title,label,code,type,enabled,descr,version,sort) VALUES ('Status Codes', '', 'status', 'system', '1', '', '0.0', '1');
INSERT INTO exp_br_config (title,label,code,type,enabled,descr,version,sort) VALUES ('Free Shipping', 'Free Shipping', 'free', 'shipping', '1', 'Free shipping with a minimum purchase amount', '1.0', '1');
INSERT INTO exp_br_config (title,label,code,type,enabled,descr,version,sort) VALUES ('Mail In', 'Mail in Payment', 'mailin', 'gateway', '1', 'Allow users to mail in payment after the purchase.', '0.5', '1');
INSERT INTO exp_br_config (title,label,code,type,enabled,descr,version,sort) VALUES ('Order ID', 'Orders', 'order_id', 'system', '1', 'Orders', '1.0', '1');

--  ----------------------------
--   Table structure for exp_br_config_data
--  ----------------------------
DROP TABLE IF EXISTS exp_br_config_data;
CREATE TABLE exp_br_config_data (
  config_data_id int(11) NOT NULL AUTO_INCREMENT,
  config_id int(11) NOT NULL,
  label varchar(100) NOT NULL,
  code varchar(50) NOT NULL,
  type varchar(30) NOT NULL,
  value text,
  options text,
  descr text,
  required int(11) NOT NULL DEFAULT '0',
  sort int(11) NOT NULL,
PRIMARY KEY (config_data_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records of exp_br_config_data
--  ----------------------------
INSERT INTO exp_br_config_data VALUES 
('1', '1', 'New Order', '', '', '1', null, null, '0', '0'), 
('2', '1', 'Pending', '', '', '2', null, null, '0', '0'), 
('3', '1', 'Processing', '', '', '3', null, null, '0', '0'), 
('4', '1', 'Shipping', '', '', '4', null, null, '0', '0'), 
('5', '1', 'Complete', '', '', '5', null, null, '0', '0'), 
('6', '2', 'Enabled', 'enabled', 'dropdown', '1', '1:Yes|0:No', null, '0', '0'), 
('7', '2', 'Label', 'label', 'text', 'Free Shipping', null, null, '0', '0'),
('8', '2', 'Countries', 'country', 'multiselect', 'a:1:{i:0;s:2:\"US\";}', 'AF:Afghanistan|AX:Aland Islands|AL:Albania|DZ:Algeria|AD:Andorra|AO:Angola|AI:Anguilla|AQ:Antarctica|AG:Antigua and Barbuda|AR:Argentina|AM:Armenia|AW:Aruba|AU:Australia|AT:Austria|AZ:Azerbaijan|BS:Bahamas|BH:Bahrain|BD:Bangladesh|BB:Barbados|BY:Belarus|BE:Belgium|BZ:Belize|BJ:Benin|BM:Bermuda|BT:Bhutan|BO:Bolivia|BA:Bosnia and Herzegovina|BW:Botswana|BV:Bouvet Island|BR:Brazil|IO:British Indian Ocean Territory|VG:British Virgin Islands|BN:Brunei|BG:Bulgaria|BF:Burkina Faso|BI:Burundi|KH:Cambodia|CM:Cameroon|CA:Canada|CV:Cape Verde|KY:Cayman Islands|CF:Central African Republic|TD:Chad|CL:Chile|CN:China|CX:Christmas Island|CC:Cocos [Keeling] Islands|CO:Colombia|KM:Comoros|CG:Congo - Brazzaville|CD:Congo - Kinshasa|CK:Cook Islands|CR:Costa Rica|CI:Cote d|HR:Croatia|CU:Cuba|CY:Cyprus|CZ:Czech Republic|DK:Denmark|DJ:Djibouti|DM:Dominica|DO:Dominican Republic|EC:Ecuador|EG:Egypt|SV:El Salvador|GQ:Equatorial Guinea|ER:Eritrea|EE:Estonia|ET:Ethiopia|FK:Falkland Islands|FO:Faroe Islands|FJ:Fiji|FI:Finland|FR:France|GF:French Guiana|PF:French Polynesia|TF:French Southern Territories|GA:Gabon|GM:Gambia|GE:Georgia|DE:Germany|GH:Ghana|GI:Gibraltar|GR:Greece|GL:Greenland|GD:Grenada|GP:Guadeloupe|GT:Guatemala|GN:Guinea|GW:Guinea-Bissau|GY:Guyana|HT:Haiti|HM:Heard Island and McDonald Islands|HN:Honduras|HK:Hong Kong SAR China|HU:Hungary|IS:Iceland|IN:India|ID:Indonesia|IR:Iran|IQ:Iraq|IE:Ireland|IM:Isle of Man|IL:Israel|IT:Italy|JM:Jamaica|JP:Japan|JO:Jordan|KZ:Kazakhstan|KE:Kenya|KI:Kiribati|KW:Kuwait|KG:Kyrgyzstan|LA:Laos|LV:Latvia|LB:Lebanon|LS:Lesotho|LR:Liberia|LY:Libya|LI:Liechtenstein|LT:Lithuania|LU:Luxembourg|MO:Macau SAR China|MK:Macedonia|MG:Madagascar|MW:Malawi|MY:Malaysia|MV:Maldives|ML:Mali|MT:Malta|MQ:Martinique|MR:Mauritania|MU:Mauritius|YT:Mayotte|MX:Mexico|FM:Micronesia|MD:Moldova|MC:Monaco|MN:Mongolia|MS:Montserrat|MA:Morocco|MZ:Mozambique|MM:Myanmar [Burma]|NA:Namibia|NR:Nauru|NP:Nepal|NL:Netherlands|AN:Netherlands Antilles|NC:New Caledonia|NZ:New Zealand|NI:Nicaragua|NE:Niger|NG:Nigeria|NU:Niue|NF:Norfolk Island|KP:North Korea|MP:Northern Mariana Islands|NO:Norway|OM:Oman|PK:Pakistan|PS:Palestinian Territories|PA:Panama|PG:Papua New Guinea|PY:Paraguay|PE:Peru|PH:Philippines|PN:Pitcairn Islands|PL:Poland|PT:Portugal|QA:Qatar|RE:Reunion|RO:Romania|RU:Russia|RW:Rwanda|SH:Saint Helena|KN:Saint Kitts and Nevis|LC:Saint Lucia|PM:Saint Pierre and Miquelon|VC:Saint Vincent and the Grenadines|WS:Samoa|SM:San Marino|ST:Sao Tome and Principe|SA:Saudi Arabia|SN:Senegal|SC:Seychelles|SL:Sierra Leone|SG:Singapore|SK:Slovakia|SI:Slovenia|SB:Solomon Islands|SO:Somalia|ZA:South Africa|GS:South Georgia and the South Sandwich Islands|KR:South Korea|ES:Spain|LK:Sri Lanka|SD:Sudan|SR:Suriname|SJ:Svalbard and Jan Mayen|SZ:Swaziland|SE:Sweden|CH:Switzerland|SY:Syria|TW:Taiwan|TJ:Tajikistan|TZ:Tanzania|TH:Thailand|TL:Timor-Leste|TG:Togo|TK:Tokelau|TO:Tonga|TT:Trinidad and Tobago|TN:Tunisia|TR:Turkey|TM:Turkmenistan|TC:Turks and Caicos Islands|TV:Tuvalu|UM:U.S. Minor Outlying Islands|UG:Uganda|UA:Ukraine|AE:United Arab Emirates|GB:United Kingdom|US:United States|UY:Uruguay|UZ:Uzbekistan|VU:Vanuatu|VA:Vatican City|VE:Venezuela|VN:Vietnam|WF:Wallis and Futuna|EH:Western Sahara|YE:Yemen|ZM:Zambia|ZW:Zimbabwe', 'Select countries where free shipping is available. Control + click to add multiple countries', '0', '1'),
('9', '2', 'Amount', 'amount', 'text', '0', null, 'Minimum amount for free shipping', '0', '2'), 
('10', '1', 'Canceled', '', '', '0', null, null, '0', '0'),
('11', '4', 'Order ID', '', '', '10000', null, null, '0', '0');


--  ----------------------------
--   Table structure for exp_br_currencies
--  ----------------------------
 DROP TABLE IF EXISTS exp_br_currencies;
 CREATE TABLE exp_br_currencies (currency_id int(11) unsigned NOT NULL AUTO_INCREMENT,title varchar(50) NOT NULL,code varchar(5) NOT NULL,marker varchar(10) NOT NULL,value float(10,5) NOT NULL,updated varchar(50) NOT NULL,PRIMARY KEY (currency_id)) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

--  ----------------------------
--   Records of exp_br_currencies
--  ----------------------------
INSERT INTO exp_br_currencies VALUES 
('1', 'US Dollar', 'USD', '$', '1.0000000', ''),
('2', 'Indonesian Rupiah', 'IDR', 'Rp', '1.0000000', '');

--  ----------------------------
--   Table structure for exp_br_email
--  ----------------------------
DROP TABLE IF EXISTS exp_br_email;
CREATE TABLE exp_br_email (  
  email_id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  version float(10,2) NOT NULL,
  content blob NOT NULL,
  site_id int(11) NOT NULL DEFAULT '1',
  subject varchar(100) NOT NULL,
  bcc_list varchar(255) DEFAULT NULL,
  from_name varchar(100) NOT NULL,
  from_email varchar(100) NOT NULL,  
PRIMARY KEY (email_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_log
--  ----------------------------
DROP TABLE IF EXISTS exp_br_log;
CREATE TABLE exp_br_log (  log_id int(11) NOT NULL AUTO_INCREMENT,  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  content text NOT NULL,  owner varchar(100) NOT NULL,  type varchar(100) NOT NULL,  PRIMARY KEY (log_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_order
--  ----------------------------
DROP TABLE IF EXISTS exp_br_order;
CREATE TABLE exp_br_order (  order_id int(11) NOT NULL AUTO_INCREMENT,  subscription_id int(11) NOT NULL default '0',  site_id int(11) NOT NULL default '1',  member_id int(11) NOT NULL default '0',  status_id int(11) NOT NULL default '1',  base decimal(10,2) NOT NULL,  tax decimal(10,2) NOT NULL,  shipping decimal(10,2) NOT NULL,  total decimal(10,2) NOT NULL,  discount decimal(10,2) NOT NULL,  cart_id varchar(100) NOT NULL,  merchant_id varchar(100) NOT NULL,  coupon_code varchar(50) NOT NULL,  agent_string varchar(255) default 'unknown',  ip_address varchar(50),  created int(10) unsigned NOT NULL default '0',  updated timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,   PRIMARY KEY  (order_id),  KEY order_member_id (member_id) ) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_order_address
--  ----------------------------
DROP TABLE IF EXISTS exp_br_order_address;
CREATE TABLE exp_br_order_address (  order_address_id int(11) NOT NULL AUTO_INCREMENT,  order_id int(11) NOT NULL,  shipping_fname varchar(50) NOT NULL,  shipping_lname varchar(50) NOT NULL,  shipping_address1 varchar(100) NOT NULL,  shipping_address2 varchar(100) NOT NULL,  shipping_state varchar(50) NOT NULL,  shipping_zip varchar(50) NOT NULL,  shipping_city varchar(50) NOT NULL,  billing_fname varchar(50) NOT NULL,  billing_lname varchar(50) NOT NULL,  billing_address1 varchar(100) NOT NULL,  billing_address2 varchar(100) NOT NULL,  billing_city varchar(50) NOT NULL,  billing_state varchar(50) NOT NULL,  billing_zip varchar(50) NOT NULL,  billing_country varchar(5) NOT NULL,  shipping_country varchar(5) NOT NULL,  billing_company varchar(100) NOT NULL,  shipping_company varchar(100) NOT NULL,  billing_phone varchar(100) NOT NULL,  shipping_phone varchar(100) NOT NULL,  PRIMARY KEY (order_address_id),   KEY order_address_order_id (order_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_order_download
--  ----------------------------
DROP TABLE IF EXISTS exp_br_order_download;
CREATE TABLE exp_br_order_download (order_download_id int(11) NOT NULL AUTO_INCREMENT,downloadable_id int(11) NOT NULL,member_id int(11) NOT NULL DEFAULT '0',product_id int(11) NOT NULL,order_id int(11) NOT NULL,cnt int(11) NOT NULL DEFAULT '0',created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,download_source varchar(100) DEFAULT 'local', download_limit int(11) NOT NULL DEFAULT '0',download_length int(11) NOT NULL,download_version varchar(50) DEFAULT NULL,license varchar(100) NOT NULL,note text, PRIMARY KEY (order_download_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_order_item
--  ----------------------------
DROP TABLE IF EXISTS exp_br_order_item;
CREATE TABLE exp_br_order_item (  order_item_id int(11) NOT NULL AUTO_INCREMENT,  order_id int(11) NOT NULL,  product_id int(11) NOT NULL,  base decimal(10,2) NOT NULL DEFAULT '0.00',  price decimal(10,2) NOT NULL DEFAULT '0.00',  cost decimal(10,2) NOT NULL DEFAULT '0.00',   discount decimal(10,2) NOT NULL DEFAULT '0.00',  quantity int(11) NOT NULL DEFAULT '1',  status int(11) NOT NULL DEFAULT '0',  configurable_id int(11) NOT NULL DEFAULT '0',  title varchar(100) NOT NULL,  taxable int(11) NOT NULL,  weight decimal(10,2) DEFAULT NULL,  shippable int(11) NOT NULL,  url varchar(100) NOT NULL,  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  sku varchar(100) NOT NULL,  options text,  PRIMARY KEY (order_item_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_order_note
--  ----------------------------
DROP TABLE IF EXISTS exp_br_order_note;
CREATE TABLE exp_br_order_note (
  order_note_id int(11) NOT NULL AUTO_INCREMENT,
  order_note text NOT NULL,
  filenm varchar(100) NOT NULL,
  created int(10) unsigned NOT NULL default '0',
  member_id int(11) NOT NULL,
  order_id int(11) NOT NULL,
  isprivate int(11) NOT NULL,
  PRIMARY KEY (order_note_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--  ----------------------------
--   Table structure for exp_br_order_options
--  ----------------------------
DROP TABLE IF EXISTS exp_br_order_options;
CREATE TABLE exp_br_order_options (
  order_item_option_id int(11) NOT NULL AUTO_INCREMENT,
  order_id int(11) NOT NULL,
  order_item_id int(11) NOT NULL,
  product_id int(11) NOT NULL,
  options text NOT NULL,
  PRIMARY KEY (order_item_option_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_order_payment
--  ----------------------------
DROP TABLE IF EXISTS exp_br_order_payment;
CREATE TABLE exp_br_order_payment (
  order_payment_id int(11) NOT NULL AUTO_INCREMENT,
  order_id int(11) NOT NULL,
  transaction_id varchar(100) NOT NULL,
  payment_type varchar(50) NOT NULL,
  amount decimal(10,2) NOT NULL default '0.00',
  details text,
  approval varchar(100) default NULL,
  created int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (order_payment_id),
  KEY order_payment_order_id (order_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--  ----------------------------
--   Table structure for exp_br_order_ship
--  ----------------------------
DROP TABLE IF EXISTS exp_br_order_ship;
CREATE TABLE exp_br_order_ship (order_ship_id int(11) NOT NULL AUTO_INCREMENT,order_id int(11) NOT NULL,status int(11) NOT NULL,code varchar(50) NOT NULL,rate decimal(10,2) NOT NULL,cost decimal(10,2) NULL,label varchar(100) NOT NULL,method varchar(50) NOT NULL,tracknum varchar(255) NOT NULL,ship_date int(10) unsigned NOT NULL default '0',PRIMARY KEY (order_ship_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_password_reset
--  ----------------------------
DROP TABLE IF EXISTS exp_br_password_reset;
CREATE TABLE `exp_br_password_reset` (`id` int(11) NOT NULL AUTO_INCREMENT,`member_id` int(11) NOT NULL,`token` varchar(255) DEFAULT NULL,`created` int(11) DEFAULT NULL,`ip` varchar(255) DEFAULT NULL,`secure` varchar(255) DEFAULT NULL,`length` int(11) DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--  ----------------------------
--   Table structure for exp_br_product
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product;
CREATE TABLE exp_br_product (  product_id int(11) NOT NULL AUTO_INCREMENT,  site_id int(11) NOT NULL DEFAULT '1',  type_id int(11) NOT NULL,  title varchar(100) NOT NULL,  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  enabled int(11) NOT NULL DEFAULT '0',  taxable int(11) NOT NULL DEFAULT '0',  sku varchar(50) NOT NULL,  weight decimal(10,2) DEFAULT NULL,  shippable int(11) NOT NULL DEFAULT '0',  url varchar(100) DEFAULT NULL,  manage_inventory int(11) NOT NULL DEFAULT '1',  quantity int(11) NOT NULL DEFAULT '0',  price decimal(10,2) NOT NULL,  sale_price decimal(10,2) DEFAULT NULL,  sale_start datetime DEFAULT NULL,  sale_end datetime DEFAULT NULL,  meta_title varchar(100) DEFAULT NULL,  meta_descr varchar(255) DEFAULT NULL,  meta_keyword varchar(100) DEFAULT NULL,  detail text,  attribute_set_id int(11) DEFAULT NULL,  cost decimal(10,2) NOT NULL DEFAULT '0.00',  featured int(11) DEFAULT 0,   PRIMARY KEY (product_id),  FULLTEXT KEY fulltext_product (title,meta_keyword,detail,sku)) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--  ----------------------------
--   Table structure for exp_br_product_attributes
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_attributes;
CREATE TABLE exp_br_product_attributes (  pa_id int(11) NOT NULL AUTO_INCREMENT,  product_id int(11) NOT NULL,  attribute_id int(11) NOT NULL,  label varchar(30)  NULL,  descr text NOT NULL,  PRIMARY KEY (pa_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records exp_br_product_attributes_option
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_attributes_option;
CREATE TABLE exp_br_product_attributes_option (id int(11) NOT NULL AUTO_INCREMENT,pa_id int(11) DEFAULT NULL,product_id int(11) DEFAULT NULL,attribute_id int(11) DEFAULT NULL,options text DEFAULT NULL,sort int(11) DEFAULT NULL,PRIMARY KEY (id),KEY br_product_id (product_id),KEY br_attribute_id (attribute_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--  ----------------------------
--   Table structure for exp_br_product_bundle
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_bundle;
CREATE TABLE exp_br_product_bundle (
  bundle_id int(11) NOT NULL AUTO_INCREMENT,
  parent_id int(11) NOT NULL,
  product_id int(11) NOT NULL,
  PRIMARY KEY (bundle_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records of exp_br_product_bundle
--  ----------------------------
--  INSERT INTO exp_br_product_bundle VALUES ('100', '2517', '2516'),


--  ----------------------------
--   Table structure for exp_br_product_category
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_category;
CREATE TABLE exp_br_product_category (  pc_id int(11) NOT NULL AUTO_INCREMENT,  site_id int(11) DEFAULT '1'  NOT NULL,   category_id int(11) NOT NULL,  product_id int(11) NOT NULL,  sort_order int(11) NOT NULL DEFAULT 0,  PRIMARY KEY (pc_id),  KEY br_category_id (category_id),   KEY br_product_id (product_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--  ----------------------------
--   Table structure for exp_br_product_configurable
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_configurable;
CREATE TABLE exp_br_product_configurable (  
configurable_id int(11) NOT NULL AUTO_INCREMENT,  
sku varchar(50) NOT NULL,  
qty int(10) NOT NULL,  
adjust_type varchar(50) NOT NULL,  
adjust decimal(10,2) NOT NULL,  
attributes text NOT NULL,  
product_id int(11) NOT NULL,  
created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
PRIMARY KEY (configurable_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records of exp_br_product_configurable
--  ----------------------------
-- INSERT INTO exp_br_product_configurable 
-- VALUES ('192', '', '0', 'fixed', '0.00', 'a:1:{i:19;s:11:\"Bittersweet\";}', '2499', '2010-10-24 10:15:36'),
--  ('193', '', '10', 'fixed', '0.00', 'a:1:{i:19;s:7:\"Apricot\";}', '2505', '2010-10-24 14:45:51'),
--  ('194', '', '0', 'fixed', '0.00', 'a:2:{i:19;s:7:\"Apricot\";i:21;s:8:\"xx-small\";}', '2506', '2010-10-24 17:26:54'),
--  ('195', '', '0', 'fixed', '0.00', 'a:2:{i:19;s:7:\"Apricot\";i:21;s:9:\"xxx-small\";}', '2506', '2010-10-24 17:26:54'),
--  ('196', '10107645', '500', 'fixed', '0.00', 'a:2:{i:19;s:5:\"White\";i:21;s:6:\"Medium\";}', '2507', '2010-10-24 17:56:32'),
--  ('197', '10107522', '300', 'fixed', '0.00', 'a:2:{i:19;s:5:\"White\";i:21;s:5:\"Large\";}', '2508', '2010-10-24 21:48:29'),
--  ('198', '101023198', '300', 'fixed', '0.00', 'a:2:{i:19;s:5:\"White\";i:21;s:5:\"Small\";}', '2508', '2010-10-24 21:48:29'),
--  ('199', '10102378', '300', 'fixed', '0.00', 'a:2:{i:19;s:5:\"White\";i:21;s:6:\"Medium\";}', '2508', '2010-10-24 21:48:29'),
--  ('391', '10107642', '100', 'fixed', '150.00', 'a:2:{i:19;s:4:\"Gray\";i:21;s:5:\"Small\";}', '2511', '2010-11-01 23:55:15'),
--  ('392', '10108874', '276', 'fixed', '0.00', 'a:2:{i:19;s:4:\"Gray\";i:21;s:6:\"Medium\";}', '2511', '2010-11-09 09:33:52'),
--  ('393', '10102245', '98', 'fixed', '300.00', 'a:2:{i:19;s:4:\"Gray\";i:21;s:5:\"Large\";}', '2511', '2010-11-03 11:44:29'),
--  ('394', '10102486', '298', 'fixed', '0.00', 'a:2:{i:19;s:3:\"Red\";i:21;s:5:\"Small\";}', '2509', '2010-11-05 17:34:31'),
--  ('395', '10106534', '300', 'fixed', '0.00', 'a:2:{i:19;s:3:\"Red\";i:21;s:6:\"Medium\";}', '2509', '2010-11-05 17:34:31'),
--  ('396', '10106112', '298', 'fixed', '0.00', 'a:2:{i:19;s:3:\"Red\";i:21;s:5:\"Large\";}', '2509', '2010-11-05 17:34:31'),
--  ('397', '10107625', '199', 'fixed', '0.00', 'a:2:{i:19;s:3:\"Red\";i:21;s:8:\"X-Large \";}', '2509', '2010-11-05 17:34:31'),
--  ('398', '10104523', '50', 'fixed', '0.00', 'a:2:{i:19;s:3:\"Red\";i:21;s:8:\"XX-Large\";}', '2509', '2010-11-05 17:34:31'),
--  ('399', '10108739', '100', 'fixed', '0.00', 'a:2:{i:19;s:5:\"Black\";i:21;s:7:\"X-Small\";}', '2509', '2010-11-05 17:34:31'),
--  ('400', '10105239', '300', 'fixed', '0.00', 'a:2:{i:19;s:5:\"Black\";i:21;s:5:\"Small\";}', '2509', '2010-11-05 17:34:31'),
--  ('401', '10106428', '300', 'fixed', '0.00', 'a:2:{i:19;s:5:\"Black\";i:21;s:6:\"Medium\";}', '2509', '2010-11-05 17:34:31'),
--  ('402', '10106745', '300', 'fixed', '0.00', 'a:2:{i:19;s:5:\"Black\";i:21;s:5:\"Large\";}', '2509', '2010-11-05 17:34:31'),
--  ('403', '10105637', '300', 'fixed', '0.00', 'a:2:{i:19;s:5:\"Black\";i:21;s:8:\"X-Large \";}', '2509', '2010-11-05 17:34:31'),
--  ('404', '10107632', '65', 'fixed', '0.00', 'a:2:{i:19;s:5:\"Black\";i:21;s:8:\"XX-Large\";}', '2509', '2010-11-05 17:34:31'),
--  ('405', '10107537', '199', 'fixed', '0.00', 'a:2:{i:19;s:5:\"White\";i:21;s:5:\"Small\";}', '2509', '2010-11-05 17:34:31'),
--  ('406', '10109952', '200', 'fixed', '0.00', 'a:2:{i:19;s:5:\"White\";i:21;s:6:\"Medium\";}', '2509', '2010-11-05 17:34:31'),
--  ('407', '10103429', '200', 'fixed', '0.00', 'a:2:{i:19;s:5:\"White\";i:21;s:5:\"Large\";}', '2509', '2010-11-05 17:34:31');


--  ----------------------------
--   Table structure for exp_br_product_configurable
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_configurable_attribute;
CREATE TABLE exp_br_product_configurable_attribute (
    config_attr_id int(11) NOT NULL AUTO_INCREMENT,
    configurable_id int(11) DEFAULT NULL,
    product_id int(11) DEFAULT NULL,
    attribute_id int(11) DEFAULT NULL,
    option_id int(11) DEFAULT NULL,
    sort int(11) DEFAULT NULL,
PRIMARY KEY (config_attr_id),
KEY br_product_id (product_id),KEY br_attribute_id (attribute_id),KEY br_option_id (option_id) ) 
ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `exp_br_product_configurable_attribute` 
(`config_attr_id`, `configurable_id`, `product_id`, `attribute_id`, `option_id`, `sort`) 
VALUES
(1, 192, 2499, 19, 16, 0),
(2, 193, 2505, 19, 17, 0),
(3, 194, 2506, 19, 18, 0),
(4, 194, 2506, 21, 19, 1),
(5, 195, 2506, 19, 20, 0),
(6, 195, 2506, 21, 21, 1),
(7, 196, 2507, 19, 8, 0),
(8, 196, 2507, 21, 12, 1),
(9, 197, 2508, 19, 8, 0),
(10, 197, 2508, 21, 13, 1),
(11, 198, 2508, 19, 8, 0),
(12, 198, 2508, 21, 11, 1),
(13, 199, 2508, 19, 8, 0),
(14, 199, 2508, 21, 12, 1),
(15, 391, 2511, 19, 4, 0),
(16, 391, 2511, 21, 11, 1),
(17, 392, 2511, 19, 4, 0),
(18, 392, 2511, 21, 12, 1),
(19, 393, 2511, 19, 4, 0),
(20, 393, 2511, 21, 13, 1),
(21, 394, 2509, 19, 7, 0),
(22, 394, 2509, 21, 11, 1),
(23, 395, 2509, 19, 7, 0),
(24, 395, 2509, 21, 12, 1),
(25, 396, 2509, 19, 7, 0),
(26, 396, 2509, 21, 13, 1),
(27, 397, 2509, 19, 7, 0),
(28, 397, 2509, 21, 14, 1),
(29, 398, 2509, 19, 7, 0),
(30, 398, 2509, 21, 21, 1),
(31, 399, 2509, 19, 1, 0),
(32, 399, 2509, 21, 10, 1),
(33, 400, 2509, 19, 1, 0),
(34, 400, 2509, 21, 11, 1),
(35, 401, 2509, 19, 1, 0),
(36, 401, 2509, 21, 12, 1),
(37, 402, 2509, 19, 1, 0),
(38, 402, 2509, 21, 13, 1),
(39, 403, 2509, 19, 1, 0),
(40, 403, 2509, 21, 14, 1),
(41, 404, 2509, 19, 1, 0),
(42, 404, 2509, 21, 21, 1),
(43, 405, 2509, 19, 8, 0),
(44, 405, 2509, 21, 11, 1),
(45, 406, 2509, 19, 8, 0),
(46, 406, 2509, 21, 12, 1),
(47, 407, 2509, 19, 8, 0),
(48, 407, 2509, 21, 13, 1);

--  ----------------------------
--   Table structure for exp_br_product_donation
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_donation;
CREATE TABLE exp_br_product_donation (donation_id int(11) NOT NULL AUTO_INCREMENT,product_id int(11) NOT NULL,allow_recurring int(11) NOT NULL DEFAULT '0',min_donation float NOT NULL DEFAULT '10',PRIMARY KEY (donation_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_product_download
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_download;
CREATE TABLE exp_br_product_download (downloadable_id int(11) NOT NULL AUTO_INCREMENT,product_id int(11) NOT NULL,title varchar(100) NOT NULL,filenm_orig varchar(255) NOT NULL,filenm varchar(100) NOT NULL,created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,download_source varchar(100) DEFAULT 'local', download_limit int(10) NOT NULL,download_length int(10) NOT NULL,download_version varchar(50) DEFAULT NULL,PRIMARY KEY (downloadable_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_product_related
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_entry;
CREATE TABLE exp_br_product_entry (product_entry_id int(11) NOT NULL AUTO_INCREMENT,product_id int(11) NOT NULL,entry_id int(11) NOT NULL,PRIMARY KEY (product_entry_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_product_images
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_images;
CREATE TABLE exp_br_product_images (  image_id int(11) NOT NULL AUTO_INCREMENT,  product_id int(11) NOT NULL,  filenm varchar(100) NOT NULL,  title varchar(100) DEFAULT NULL,  large int(11) NOT NULL DEFAULT '0',  thumb int(11) NOT NULL DEFAULT '0',  exclude int(11) NOT NULL DEFAULT '0',  sort int(11) NOT NULL DEFAULT '0',  PRIMARY KEY (image_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records of exp_br_product_images
--  ----------------------------
/*
INSERT INTO exp_br_product_images VALUES ('2595', '2509', 'd5244a3bda940d3a1f5b6869ec9eff7a.png', 'long sleeve shirt detail 2', '0', '0', '0', '3'),
('2594', '2509', '2a7a1ac80d977ce2bc15929138056d78.png', 'long sleeve shirt detail 3', '0', '0', '0', '2'),
('2385', '2508', '6257e4e866018880a18179ddde662762.png', '', '1', '1', '0', '0'),
('2384', '2507', '2640292cc7e6d3b0dbb6e20ed470dda7.png', '', '1', '1', '0', '0'),
('2593', '2509', '962d8a97e97a731058310b7fe61ae851.png', 'long sleeve shirt detail 1', '0', '0', '0', '1'),
('2592', '2509', '139a95a728fd4cee11bfbd5bafc98a5a.png', 'long sleeve shirt', '1', '1', '0', '0'),
('2485', '2510', '954f3c231c3cb75a448cb780b30476ae.png', 'Safari cargo pants', '1', '1', '0', '0'),
('2585', '2511', '661d07200a6556a8047580b9719c336c.png', 'Suit Jacket - Detail 2', '0', '0', '0', '4'),
('2584', '2511', '02ab70d16d679eb73ae019cb0ff0134d.png', 'Suit Jacket - Gray', '0', '0', '0', '3'),
('2583', '2511', '17b1e209ec50e1fb8e6241a1aff0e8a3.png', 'Suit Jacket - Blue', '0', '1', '0', '2'),
('2582', '2511', '5485bc016204c6fd406d418b16153014.png', 'Suit Jacket Detail', '0', '0', '0', '1'),
('2460', '2520', '7fb875cd2b702264ba286af7c8dd09b8.png', 'Smooth Face Cream', '1', '1', '0', '0'),
('2452', '2524', '9bbe55de299f6a7ba96cbd03160fdec3.png', 'Lemon Pepper Mint Oil', '1', '1', '0', '0'),
('2423', '2516', '53d170e027d361408bf6c2d0bd60e561.png', '', '1', '1', '0', '0'),
('2439', '2517', '5d5d6cb830b8030674694834c89eea75.png', '', '1', '1', '0', '0'),
('2509', '2515', '28ef631f877a87e3b9e27ef399b15ecb.png', '', '1', '1', '0', '0'),
('2424', '2516', '571a1c7b4082754310b2edcbad7a1ee2.png', '', '0', '0', '0', '0'),
('2436', '2519', '619765c91e30b4d617b067137a669fdc.png', 'Clothing Guide', '1', '1', '0', '0'),
('2477', '2521', '56e2316cdc862e58bbdbe05d4f473dac.png', 'Banana Foot Cream', '1', '1', '0', '0'),
('2478', '2522', '22ffe4692cd1e21b8e7bf02e9a1d3e20.png', 'Age Defying Body Lotion', '1', '1', '0', '0'),
('2517', '2523', '773146bd3137830baaf0df2546ddca52.png', 'Shea Butter Hand Lotion', '1', '1', '0', '0'),
('2453', '2525', 'dba7c7f6bda94d74160d63cdac47c460.png', 'Oil Free Sunscreen SPF 30', '1', '1', '0', '0'),
('2596', '2526', 'f74d56a87889cf0be269d694501f7ac6.png', 'Stunning Eyeliner ', '1', '1', '0', '0'),
('2568', '2527', '444fe8987f70b56fe81f0098653ea07d.png', 'Silky Shampoo', '1', '1', '0', '0'),
('2581', '2511', 'c993a2a0a017648c0bfebb8c8fd77bbe.png', 'Suit Jacket - Black', '1', '0', '0', '0'),
('2602', '2536', '61e4044fc25bf124b9387acd1b987071.png', 'Wellington Hobo Bag ', '1', '1', '0', '0');
*/
--  ----------------------------
--   Table structure exp_br_product_price
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_price;
CREATE TABLE exp_br_product_price (price_id int(11) NOT NULL AUTO_INCREMENT,product_id int(11) NOT NULL,type_id int(11) NOT NULL,group_id int(11) NOT NULL,price decimal(10,2) NOT NULL,qty int(11) DEFAULT '1',end_dt datetime DEFAULT NULL,start_dt datetime DEFAULT NULL,sort_order int(11) NOT NULL,PRIMARY KEY (price_id),KEY product_price_index (product_id,group_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- INSERT INTO `exp_br_product_price` VALUES ('1', '2519', '1', '0', '15.00', '1', null, null, '0'),
-- ('2', '2523', '1', '0', '14.99', '1', null, null, '0'),
-- ('3', '2516', '1', '0', '349.00', '1', null, null, '0'),
-- ('4', '2517', '1', '0', '450.00', '1', null, null, '0'),
-- ('5', '2517', '2', '0', '400.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0'),
-- ('6', '2524', '1', '0', '60.00', '1', null, null, '0'),
-- ('7', '2524', '2', '0', '40.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0'),
-- ('8', '2525', '1', '0', '5.99', '1', null, null, '0'),
-- ('9', '2526', '1', '0', '12.50', '1', null, null, '0'),
-- ('10', '2527', '1', '0', '50.99', '1', null, null, '0'),
-- ('11', '2527', '2', '0', '34.99', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0'),
-- ('12', '2507', '1', '0', '25.00', '1', null, null, '0'),
-- ('13', '2508', '1', '0', '20.00', '1', null, null, '0'),
-- ('14', '2509', '1', '0', '30.00', '1', null, null, '0'),
-- ('15', '2509', '2', '0', '25.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0'),
-- ('16', '2510', '1', '0', '75.00', '1', null, null, '0'),
-- ('17', '2511', '1', '0', '279.00', '1', null, null, '0'),
-- ('18', '2511', '2', '0', '200.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0'),
-- ('19', '2520', '1', '0', '29.99', '1', null, null, '0'),
-- ('20', '2521', '1', '0', '14.99', '1', null, null, '0'),
-- ('21', '2522', '1', '0', '8.99', '1', null, null, '0'),
-- ('22', '2522', '2', '0', '6.99', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0'),
-- ('23', '2515', '1', '0', '80.00', '1', null, null, '0'),
-- ('24', '2536', '1', '0', '199.00', '1', null, null, '0');

--  ----------------------------
--   Table structure for exp_br_product_options
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_options;
CREATE TABLE exp_br_product_options (
  po_id int(11) NOT NULL AUTO_INCREMENT,
  product_id int(11) NOT NULL,
  options text,
  PRIMARY KEY (po_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records of exp_br_product_options
--  ----------------------------
-- INSERT INTO exp_br_product_options VALUES ('460', '2521', 'N;'),
-- ('461', '2522', 'N;'),
-- ('483', '2523', 'N;'),
-- ('451', '2525', 'N;'),
-- ('504', '2511', 'a:1:{i:0;a:5:{s:5:\"title\";s:11:\"Jacket Size\";s:4:\"type\";s:8:\"dropdown\";s:8:\"required\";s:1:\"1\";s:4:\"sort\";i:1;s:4:\"opts\";a:7:{i:0;a:4:{s:5:\"title\";s:8:\"44 Short\";s:4:\"type\";s:5:\"fixed\";s:5:\"price\";s:1:\"0\";s:4:\"sort\";i:1;}i:1;a:4:{s:5:\"title\";s:7:\"46 Long\";s:4:\"type\";s:5:\"fixed\";s:5:\"price\";s:1:\"0\";s:4:\"sort\";i:2;}i:2;a:4:{s:5:\"title\";s:10:\"48 Regular\";s:4:\"type\";s:5:\"fixed\";s:5:\"price\";s:1:\"0\";s:4:\"sort\";i:3;}i:3;a:4:{s:5:\"title\";s:7:\"50 Long\";s:4:\"type\";s:5:\"fixed\";s:5:\"price\";s:1:\"0\";s:4:\"sort\";i:4;}i:4;a:4:{s:5:\"title\";s:10:\"50 Regular\";s:4:\"type\";s:5:\"fixed\";s:5:\"price\";s:1:\"0\";s:4:\"sort\";i:5;}i:5;a:4:{s:5:\"title\";s:7:\"52 Long\";s:4:\"type\";s:5:\"fixed\";s:5:\"price\";s:1:\"0\";s:4:\"sort\";i:6;}i:6;a:4:{s:5:\"title\";s:9:\"52 Reglar\";s:4:\"type\";s:5:\"fixed\";s:5:\"price\";s:1:\"0\";s:4:\"sort\";i:7;}}}}'),
-- ('391', '2507', 'N;'),
-- ('392', '2508', 'N;'),
-- ('514', '2509', 'N;'),
-- ('464', '2510', 'N;'),
-- ('455', '2520', 'N;'),
-- ('473', '2515', 'N;'),
-- ('422', '2516', 'N;'),
-- ('440', '2517', 'N;'),
-- ('450', '2524', 'N;'),
-- ('434', '2519', 'N;'),
-- ('516', '2526', 'N;'),
-- ('499', '2527', 'N;'),
-- ('478', '2531', 'N;'),
-- ('480', '2532', 'N;'),
-- ('481', '2533', 'N;'),
-- ('484', '2534', 'N;'),
-- ('485', '2535', 'N;'),
-- ('520', '2536', 'N;');

--  ----------------------------
--   Table structure for exp_br_product_related
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_addon;
CREATE TABLE exp_br_product_addon (  related_id int(11) NOT NULL AUTO_INCREMENT,  parent_id int(11) NOT NULL,  product_id int(11) NOT NULL,  PRIMARY KEY (related_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_product_related
--  ----------------------------
DROP TABLE IF EXISTS exp_br_product_related;
CREATE TABLE exp_br_product_related (  related_id int(11) NOT NULL AUTO_INCREMENT,  parent_id int(11) NOT NULL,  product_id int(11) NOT NULL,  PRIMARY KEY (related_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Records of exp_br_product_related
--  ----------------------------
-- INSERT INTO exp_br_product_related VALUES ('288', '2509', '2507'),
-- ('287', '2509', '2508'),
-- ('214', '2510', '2509'),
-- ('213', '2510', '2507'),
-- ('275', '2511', '2510'),
-- ('274', '2511', '2509'),
-- ('273', '2511', '2507'),
-- ('272', '2511', '2508'),
-- ('167', '2516', '2515'),
-- ('226', '2515', '2517'),
-- ('225', '2515', '2516'),
-- ('204', '2521', '2520'),
-- ('206', '2522', '2521'),
-- ('205', '2522', '2520'),
-- ('231', '2523', '2522'),
-- ('184', '2525', '2523'),
-- ('185', '2525', '2522'),
-- ('188', '2520', '2521'),
-- ('189', '2520', '2523'),
-- ('190', '2520', '2522'),
-- ('296', '2536', '2509'),
-- ('295', '2536', '2508');

--  ----------------------------
--   Table structure for exp_br_promo
--  ----------------------------
DROP TABLE IF EXISTS exp_br_promo;
CREATE TABLE exp_br_promo (  promo_id int(11) NOT NULL AUTO_INCREMENT,  site_id int(11) NOT NULL DEFAULT '1',  title varchar(50) NOT NULL,  code varchar(30) NOT NULL,  start_dt timestamp NULL DEFAULT NULL,  end_dt timestamp NULL DEFAULT NULL,  code_type varchar(10) NOT NULL DEFAULT 'fixed',  discount_type varchar(50) DEFAULT 'item',  max_discount decimal(10,2) DEFAULT 0,  amount decimal(10,2) NOT NULL DEFAULT '0.00',  enabled int(11) NOT NULL DEFAULT '0',  descr varchar(200) NOT NULL,  category_list text,  product_list text,  min_subtotal decimal(10,2) NOT NULL DEFAULT '1.00',  min_quantity int(11) NOT NULL DEFAULT '1',  uses_per int(11) NOT NULL DEFAULT '0',  priority int(11) NOT NULL DEFAULT '1',  stop_rules int(11) NOT NULL DEFAULT '0',  groups varchar(100) NOT NULL DEFAULT '0',
                  PRIMARY KEY (promo_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_search
--  ----------------------------
DROP TABLE IF EXISTS exp_br_search;
CREATE TABLE exp_br_search (  search_id int(11) NOT NULL AUTO_INCREMENT,  site_id int(11) NOT NULL DEFAULT '1',  hash varchar(100) NOT NULL,  search_term varchar(100) NOT NULL,  result_count int(11) NOT NULL,  member_id int(11) NOT NULL,  ip varchar(100) NOT NULL,  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  PRIMARY KEY (search_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ----------------------------
--   Table structure for exp_br_state
--  ----------------------------
DROP TABLE IF EXISTS exp_br_state;
CREATE TABLE `exp_br_state` (state_id int(11) NOT NULL AUTO_INCREMENT,zone_id int(11) NOT NULL,title varchar(100) NOT NULL,code varchar(10) NOT NULL,enabled int(11) DEFAULT 1, PRIMARY KEY (state_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--  ----------------------------
--   Table structure for exp_br_store
--  ----------------------------
DROP TABLE IF EXISTS exp_br_store;
CREATE TABLE exp_br_store (
store_id int(11) NOT NULL AUTO_INCREMENT,
site_id int(11) NOT NULL DEFAULT '1',
channel_id int(11) NULL,
logo varchar(100) NOT NULL DEFAULT 'logo.png',
license varchar(255) NULL,
phone varchar(255) NULL,
address1 varchar(100) NULL,
address2 varchar(100) NULL,
city varchar(100) NULL,
state varchar(50) NULL,
country varchar(50) NOT NULL DEFAULT 'ID',
zipcode varchar(50) NOT NULL DEFAULT '12000',
fax varchar(50) NULL ,
currency_id int(11) NOT NULL DEFAULT '1',
result_limit int(11) NOT NULL DEFAULT '24',
result_per_page int(11) NOT NULL DEFAULT '12',
result_paginate int(11) NOT NULL DEFAULT '5',
register_group int(11) NOT NULL DEFAULT '5',
guest_checkout int(11) NOT NULL DEFAULT '1',
media_url varchar(255) NOT NULL DEFAULT '/media',
media_dir varchar(255) NOT NULL ,
meta_title varchar(100) NULL,
meta_keywords varchar(100) NULL,
meta_descr varchar(255)  NULL,
donation_enabled int(11) NOT NULL DEFAULT '0', 
subscription_enabled int(11) NOT NULL DEFAULT '0',
first_notice int(11) NOT NULL DEFAULT '7',
second_notice int(11) NOT NULL DEFAULT '14',
third_notice int(11) NOT NULL DEFAULT '21',
cancel_subscription int(11) NOT NULL DEFAULT '28',
secure_url varchar(150) NULL, 
cart_url varchar(100) NOT NULL DEFAULT 'cart',
checkout_url varchar(100) NOT NULL DEFAULT 'checkout', 
thankyou_url varchar(100) NOT NULL DEFAULT 'checkout/thankyou', 
customer_url varchar(100) NOT NULL DEFAULT 'customer', 
product_url varchar(100) NOT NULL DEFAULT 'product',
low_stock int(11) NOT NULL DEFAULT 0,
display_out_of_stock int(11) NOT NULL DEFAULT '0',
downloads_use_local int(11) NOT NULL DEFAULT '0',
downloads_use_s3 int(11) NOT NULL DEFAULT '0',
downloads_local varchar(100), 
downloads_s3_access_key varchar(100), 
downloads_s3_secret_key varchar(100), 
downloads_s3_length int(11) NOT NULL DEFAULT '10', 
PRIMARY KEY (store_id)) 
ENGINE=MyISAM DEFAULT CHARSET=utf8;
--  ----------------------------
--   Records of exp_br_store
--  ----------------------------

--  ----------------------------
--   Table structure for exp_br_tax
--  ----------------------------
DROP TABLE IF EXISTS exp_br_tax;
CREATE TABLE exp_br_tax (
  tax_id int(11) NOT NULL AUTO_INCREMENT,
  site_id int(11) NOT NULL DEFAULT '1',
  title varchar(50) NOT NULL,
  zone_id int(11) NOT NULL DEFAULT 62,
  state_id int(11) NULL,
  zipcode text NULL, 
  rate float(10,4) NOT NULL,
  sort int(11) NOT NULL,
  PRIMARY KEY (tax_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--  ------------------------------   Table structure for exp_br_zone--  ----------------------------
DROP TABLE IF EXISTS exp_br_zone;
CREATE TABLE exp_br_zone (  
zone_id int(11) NOT NULL AUTO_INCREMENT,  
title varchar(100) NOT NULL,  
code varchar(10) NOT NULL,  
enabled int(11) DEFAULT 0,   
PRIMARY KEY (zone_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--  ----------------------------
--   Table structure for exp_br_product_feeds
--  ----------------------------
CREATE TABLE exp_br_product_feeds (  product_feed_id int(11) NOT NULL AUTO_INCREMENT,  product_id int(11) NOT NULL DEFAULT '0',  feed_id int(11) NOT NULL DEFAULT '0',  PRIMARY KEY (product_feed_id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--  ----------------------------
--   Table structure for exp_br_feeds
--  ----------------------------
CREATE TABLE exp_br_feeds (  feed_id int(11) NOT NULL AUTO_INCREMENT,  feed_title varchar(128) NOT NULL DEFAULT '',  feed_code varchar(128) NOT NULL DEFAULT '',  PRIMARY KEY (feed_id),  UNIQUE (feed_code)) ENGINE=MyISAM DEFAULT CHARSET=utf8;	
-- INSERT INTO exp_br_feeds (feed_title,feed_code) VALUES ('Google Base','google_base');
--  ----------------------------
--   Table structure for exp_br_wishlist
--  ----------------------------
DROP TABLE IF EXISTS exp_br_wishlist;
CREATE TABLE exp_br_wishlist (wishlist_id int(11) NOT NULL AUTO_INCREMENT,member_id int(11) NOT NULL DEFAULT '0',is_public int(11) NOT NULL DEFAULT '0',created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,product_id int(11) NOT NULL,notes text,PRIMARY KEY (wishlist_id),KEY index_wishlist (member_id)) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
--  ----------------------------
--   Table structure for exp_br_wishlist_hash
--  ----------------------------
DROP TABLE IF EXISTS exp_br_wishlist_hash;
CREATE TABLE exp_br_wishlist_hash (wishlist_hash_id int(11) NOT NULL auto_increment,member_id int(11) NOT NULL,hash varchar(255) NOT NULL,PRIMARY KEY  (wishlist_hash_id),UNIQUE KEY member_id (member_id),UNIQUE KEY hash (hash)) ENGINE=MyISAM DEFAULT CHARSET=utf8;











 


--  ----------------------------
--   Records of exp_br_attribute
--  ----------------------------
/*
INSERT INTO exp_br_attribute VALUES ('22', '1', 'Notes', 'notes', '0', 'textarea', '1', '', ''),
('19', '1', 'Color', 'color', '0', 'dropdown', '1', '', 'Black\nBlue\nBrown\nGray\nGreen\nOrange\nRed\nWhite\nYellow'),
('27', '1', 'File', 'fle', '0', 'file', '1', '', ''),
('21', '1', 'Size', 'size', '0', 'dropdown', '1', '', 'X-Small\nSmall\nMedium\nLarge\nX-Large\nXX-Large');
*/


--  ----------------------------
--   Records of exp_br_product_attributes
--  ----------------------------
/*        
INSERT INTO exp_br_product_attributes 
VALUES 
 ('896', '2510', '22', '', 'Easy-Stretch Fabric<br />\nSize: Fits Medium to Large<br />\nWaist: Fits 32-34<br />\nInseam: Fits 30-34<br />\nColor: Khak<br />\n<ul>\n<li>Sits low on hips</li>\n<li>Big belt loops</li>\n<li>Hidden pockets</li>\n<li>Loose comfortable fit</li>\n<li> Hemmed straight leg</li>\n</ul>'),
 ('872', '2517', '22', '', '2 Year Service Plan Includes:<br />\n<ul>\n<li>Any electronics purchased online </li>\n<li>Accidental Damage</li>\n<li>Battery Replacment</li>\n<li>Power Surges</li>\n<li>Maintenance</li>\n</ul>\n<br />\n<h3>Camera Features:</h3>\n<ul>\n<li>20 Megapixel, video output </li>\n<li>Eye level, single-reflex viewfinder</li>\n<li>Rechargable Lithium-ion battery</li>\n<li>5\" LCD Screen</li>\n<li>5x Optical Zoom Lens</li>\n</ul>'),
 ('897', '2515', '22', '', '2 Year Service Plan Includes:<br />\n<ul>\n<li>Any electronics purchased online </li>\n<li>Accidental Damage</li>\n<li>Battery Replacment</li>\n<li>Power Surges</li>\n<li>Maintenance</li>\n</ul>'),
 ('864', '2516', '22', '', 'Camera Features:<br />\n<ul>\n<li>20 Megapixel, video output </li>\n<li>Eye level, single-reflex viewfinder</li>\n<li>Rechargable Lithium-ion battery</li>\n<li>5\" LCD Screen</li>\n<li>5x Optical Zoom Lens</li>\n</ul>\n'),
 ('884', '2520', '22', '', 'Item Weight: <br />\n3.6 ounces\n<br />\n<br />\nIngredients: <br />\nWater Purified, Cetyl Ricinoleate, Ceresin, Ammonium Glycolate, Glyceryl Stearate (and), PEG 50 Stearate, Sorbitan Stearate, Sorbitol, Methylparaben, Propylparaben, Magnesium Aluminum Silicate, Dimethicone, Gum, Trisodium FDTE <br />'),
 ('891', '2521', '22', '', 'Ingredients: glycerin, olea europaea (olive) fruit oil, avena sativa (oat) kernel protein, lanolin, cocos nucifera (coconut) oil, tocopherol, mentha piperita (peppermint) oil, rosmarinus officinalis (rosemary) leaf oil, fragrance<br />\n<br />\nHow to Use It:\nRub cream on foot and let it absorb. Optional: soak feet in hot water for 5-10 minutes and use a pumice stone on your heel. Massage Banana Foot Creme into your feet. After, you use the cream, put a sock on your foot and keep them on overnight to lock in the moisture. '),
 ('892', '2522', '22', '', 'Overview:<br />\nSize:  10.5 oz.<br />\n<br />\nPrevents Moisture Loss\n<br />\nWith vitamin E and Aloe\n<br />\nDermatologically tested'),
 ('880', '2524', '22', '', 'Ingredients:  oil<br />\n<br />\nOther Oils: Aloe Vera, Peppermint Leaves,<br />\n<br />\nFragrant Oil: Lemon, alderwood<br />\n<br />'),
 ('881', '2525', '22', '', '8 ounce bottle of sunscreen<br />\n<br />\nHypoallergenic, Doesn\'t contain Oil,  Won\'t Clog Pours<br />\n<br />\nProtection from Harmful Rays <br />\n<br />\nWaterproof!'),
 ('937', '2526', '22', '', 'Shipping Weight: <br />\n<br />\n0.1 LBS\nContainer Type: <br />\n<br />\nSmall Peg'),
 ('927', '2527', '22', '', 'Scent: <br />\n<br /> \nVanilla<br />\n<br />\nSize:\n34 mL\n\n'),
 ('934', '2511', '27', '', 'a:2:{s:5:\"title\";s:22:\"Suit Jacket Size Guide\";s:4:\"file\";s:0:\"\";}'), 
 ('933', '2511', '22', '', 'Please download the PDF to view sizing quidelines'), 
 ('939', '2536', '22', '', 'Specs:<br />\n<ul>\n<li>Model: WHB55003 </li>\n<li>Construction: Leather</li>\n<li>Lining: Stripped tan and black</li>\n<li>Hardware: Platinum</li>\n<li>Handles: Flat </li>\n<li>Access: Zipper</li>\n<li>Dimensions: 13\"Height x 15\"Width x 5\"Depth x 18\"Drop</li>\n</ul>\n');
*/


--  ----------------------------
--   Records of exp_br_zone
--  ----------------------------
INSERT INTO exp_br_zone VALUES ('1', 'United States', 'US',1),
('2', 'Afghanistan', 'AF',0),
('3', 'Albania', 'AL',0),
('4', 'Algeria', 'DZ',0),
('6', 'Andorra', 'AD',0),
('7', 'Angola', 'AO',0),
('8', 'Anguilla', 'AI',0),
('9', 'Antarctica', 'AQ',0),
('10', 'Antigua and Barbuda', 'AG',0),
('11', 'Argentina', 'AR',0),
('12', 'Armenia', 'AM',0),
('13', 'Aruba', 'AW',0),
('14', 'Australia', 'AU',0),
('15', 'Austria', 'AT',0),
('16', 'Azerbaijan', 'AZ',0),
('17', 'Bahamas', 'BS',0),
('18', 'Bahrain', 'BH',0),
('19', 'Bangladesh', 'BD',0),
('20', 'Barbados', 'BB',0),
('21', 'Belarus', 'BY',0),
('22', 'Belgium', 'BE',0),
('23', 'Belize', 'BZ',0),
('24', 'Benin', 'BJ',0),
('25', 'Bermuda', 'BM',0),
('26', 'Bhutan', 'BT',0),
('27', 'Bolivia', 'BO',0),
('28', 'Bosnia and Herzegovina', 'BA',0),
('29', 'Botswana', 'BW',0),
('30', 'Bouvet Island', 'BV',0),
('31', 'Brazil', 'BR',0),
('32', 'British Indian Ocean Territory', 'IO',0),
('33', 'British Virgin Islands', 'VG',0),
('34', 'Brunei', 'BN',0),
('35', 'Bulgaria', 'BG',0),
('36', 'Burkina Faso', 'BF',0),
('37', 'Burundi', 'BI',0),
('38', 'Cambodia', 'KH',0),
('39', 'Cameroon', 'CM',0),
('40', 'Canada', 'CA',0),
('41', 'Cape Verde', 'CV',0),
('42', 'Cayman Islands', 'KY',0),
('43', 'Central African Republic', 'CF',0),
('44', 'Chad', 'TD',0),
('45', 'Chile', 'CL',0),
('46', 'China', 'CN',0),
('47', 'Christmas Island', 'CX',0),
('48', 'Cocos [Keeling] Islands', 'CC',0),
('49', 'Colombia', 'CO',0),
('50', 'Comoros', 'KM',0),
('51', 'Congo - Brazzaville', 'CG',0),
('52', 'Congo - Kinshasa', 'CD',0),
('53', 'Cook Islands', 'CK',0),
('54', 'Costa Rica', 'CR',0),
('55', 'Croatia', 'HR',0),
('56', 'Cuba', 'CU',0),
('57', 'Cyprus', 'CY',0),
('58', 'Czech Republic', 'CZ',0),
('59', 'Cote dIvoire', 'CI',0),
('60', 'Denmark', 'DK',0),
('61', 'Djibouti', 'DJ',0),
('62', 'Indonesia', 'ID',0),
('102', 'Dominica', 'DM',0),
('63', 'Dominican Republic', 'DO',0),
('64', 'Ecuador', 'EC',0),
('65', 'Egypt', 'EG',0),
('66', 'El Salvador', 'SV',0),
('67', 'Equatorial Guinea', 'GQ',0),
('68', 'Eritrea', 'ER',0),
('69', 'Estonia', 'EE',0),
('70', 'Ethiopia', 'ET',0),
('71', 'Falkland Islands', 'FK',0),
('72', 'Faroe Islands', 'FO',0),
('73', 'Fiji', 'FJ',0),
('74', 'Finland', 'FI',0),
('75', 'France', 'FR',0),
('76', 'French Guiana', 'GF',0),
('77', 'French Polynesia', 'PF',0),
('78', 'French Southern Territories', 'TF',0),
('79', 'Gabon', 'GA',0),
('80', 'Gambia', 'GM',0),
('81', 'Georgia', 'GE',0),
('82', 'Germany', 'DE',0),
('83', 'Ghana', 'GH',0),
('84', 'Gibraltar', 'GI',0),
('85', 'Greece', 'GR',0),
('86', 'Greenland', 'GL',0),
('87', 'Grenada', 'GD',0),
('88', 'Guadeloupe', 'GP',0),
('90', 'Guatemala', 'GT',0),
('92', 'Guinea', 'GN',0),
('93', 'Guinea-Bissau', 'GW',0),
('94', 'Guyana', 'GY',0),
('95', 'Haiti', 'HT',0),
('96', 'Heard Island and McDonald Islands', 'HM',0),
('97', 'Honduras', 'HN',0),
('98', 'Hong Kong SAR China', 'HK',0),
('99', 'Hungary', 'HU',0),
('100', 'Iceland', 'IS',0),
('101', 'India', 'IN',0),
('103', 'Iran', 'IR',0),
('104', 'Iraq', 'IQ',0),
('105', 'Ireland', 'IE',0),
('106', 'Isle of Man', 'IM',0),
('107', 'Israel', 'IL',0),
('108', 'Italy', 'IT',0),
('109', 'Jamaica', 'JM',0),
('110', 'Japan', 'JP',0),
('112', 'Jordan', 'JO',0),
('113', 'Kazakhstan', 'KZ',0),
('114', 'Kenya', 'KE',0),
('115', 'Kiribati', 'KI',0),
('116', 'Kuwait', 'KW',0),
('117', 'Kyrgyzstan', 'KG',0),
('118', 'Laos', 'LA',0),
('119', 'Latvia', 'LV',0),
('120', 'Lebanon', 'LB',0),
('121', 'Lesotho', 'LS',0),
('122', 'Liberia', 'LR',0),
('123', 'Libya', 'LY',0),
('124', 'Liechtenstein', 'LI',0),
('125', 'Lithuania', 'LT',0),
('126', 'Luxembourg', 'LU',0),
('127', 'Macau SAR China', 'MO',0),
('128', 'Macedonia', 'MK',0),
('129', 'Madagascar', 'MG',0),
('130', 'Malawi', 'MW',0),
('131', 'Malaysia', 'MY',0),
('132', 'Maldives', 'MV',0),
('133', 'Mali', 'ML',0),
('134', 'Malta', 'MT',0),
('136', 'Martinique', 'MQ',0),
('137', 'Mauritania', 'MR',0),
('138', 'Mauritius', 'MU',0),
('139', 'Mayotte', 'YT',0),
('140', 'Mexico', 'MX',0),
('141', 'Micronesia', 'FM',0),
('142', 'Moldova', 'MD',0),
('143', 'Monaco', 'MC',0),
('144', 'Mongolia', 'MN',0),
('146', 'Montserrat', 'MS',0),
('147', 'Morocco', 'MA',0),
('148', 'Mozambique', 'MZ',0),
('149', 'Myanmar [Burma]', 'MM',0),
('150', 'Namibia', 'NA',0),
('151', 'Nauru', 'NR',0),
('152', 'Nepal', 'NP',0),
('153', 'Netherlands', 'NL',0),
('154', 'Netherlands Antilles', 'AN',0),
('155', 'New Caledonia', 'NC',0),
('156', 'New Zealand', 'NZ',0),
('157', 'Nicaragua', 'NI',0),
('158', 'Niger', 'NE',0),
('159', 'Nigeria', 'NG',0),
('160', 'Niue', 'NU',0),
('161', 'Norfolk Island', 'NF',0),
('162', 'North Korea', 'KP',0),
('163', 'Northern Mariana Islands', 'MP',0),
('164', 'Norway', 'NO',0),
('165', 'Oman', 'OM',0),
('166', 'Pakistan', 'PK',0),
('168', 'Palestinian Territories', 'PS',0),
('169', 'Panama', 'PA',0),
('170', 'Papua New Guinea', 'PG',0),
('171', 'Paraguay', 'PY',0),
('172', 'Peru', 'PE',0),
('173', 'Philippines', 'PH',0),
('174', 'Pitcairn Islands', 'PN',0),
('175', 'Poland', 'PL',0),
('176', 'Portugal', 'PT',0),
('178', 'Qatar', 'QA',0),
('179', 'Romania', 'RO',0),
('180', 'Russia', 'RU',0),
('181', 'Rwanda', 'RW',0),
('182', 'Reunion', 'RE',0),
('184', 'Saint Helena', 'SH',0),
('185', 'Saint Kitts and Nevis', 'KN',0),
('186', 'Saint Lucia', 'LC',0),
('188', 'Saint Pierre and Miquelon', 'PM',0),
('189', 'Saint Vincent and the Grenadines', 'VC',0),
('190', 'Samoa', 'WS',0),
('191', 'San Marino', 'SM',0),
('192', 'Saudi Arabia', 'SA',0),
('193', 'Senegal', 'SN',0),
('195', 'Seychelles', 'SC',0),
('196', 'Sierra Leone', 'SL',0),
('197', 'Singapore', 'SG',0),
('198', 'Slovakia', 'SK',0),
('199', 'Slovenia', 'SI',0),
('200', 'Solomon Islands', 'SB',0),
('201', 'Somalia', 'SO',0),
('202', 'South Africa', 'ZA',0),
('203', 'South Georgia and the South Sandwich Islands', 'GS',0),
('204', 'South Korea', 'KR',0),
('205', 'Spain', 'ES',0),
('206', 'Sri Lanka', 'LK',0),
('207', 'Sudan', 'SD',0),
('208', 'Suriname', 'SR',0),
('209', 'Svalbard and Jan Mayen', 'SJ',0),
('210', 'Swaziland', 'SZ',0),
('211', 'Sweden', 'SE',0),
('212', 'Switzerland', 'CH',0),
('213', 'Syria', 'SY',0),
('214', 'Sao Tome and Principe', 'ST',0),
('215', 'Taiwan', 'TW',0),
('216', 'Tajikistan', 'TJ',0),
('217', 'Tanzania', 'TZ',0),
('218', 'Thailand', 'TH',0),
('219', 'Timor-Leste', 'TL',0),
('220', 'Togo', 'TG',0),
('221', 'Tokelau', 'TK',0),
('222', 'Tonga', 'TO',0),
('223', 'Trinidad and Tobago', 'TT',0),
('224', 'Tunisia', 'TN',0),
('225', 'Turkey', 'TR',0),
('226', 'Turkmenistan', 'TM',0),
('227', 'Turks and Caicos Islands', 'TC',0),
('228', 'Tuvalu', 'TV',0),
('231', 'Uganda', 'UG',0),
('232', 'Ukraine', 'UA',0),
('233', 'United Arab Emirates', 'AE',0),
('234', 'United Kingdom', 'GB',0),
('235', 'Uruguay', 'UY',0),
('236', 'Uzbekistan', 'UZ',0),
('237', 'Vanuatu', 'VU',0),
('238', 'Vatican City', 'VA',0),
('239', 'Venezuela', 'VE',0),
('240', 'Vietnam', 'VN',0),
('241', 'Wallis and Futuna', 'WF',0),
('242', 'Western Sahara', 'EH',0),
('243', 'Yemen', 'YE',0),
('244', 'Zambia', 'ZM',0),
('245', 'Zimbabwe', 'ZW',0),
('246', 'Aland Islands', 'AX',0);	



--  ----------------------------
--   Records of exp_br_state
--  ----------------------------
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'ACEH', 'AC',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Bali', 'BA',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Bangka-Belitung', 'BB',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Banten', 'BT',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Bengkulu', 'BE',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Gorontalo', 'GO',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Jambi', 'JA',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Jawa Barat', 'JR',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Jawa Tengah', 'JT',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Jawa Timur', 'JI',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Kalimantan Barat', 'KB',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Kalimantan Selatan', 'KS',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Kalimantan Tengah', 'KT',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Kalimantan Timur', 'KI',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Lampung', 'LA',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Maluku', 'MA',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Maluku Utara', 'MU',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Nusa Tenggara Barat', 'NB',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Nusa Tenggara Timur', 'NT',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Papua Barat', 'PB',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Irian Jaya', 'IJ',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Riau', 'RI',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Sulawesi Selatan', 'SN',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Sulawesi Tengah', 'ST',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Sulawesi Tenggara', 'SG',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Sulawesi Utara', 'SW',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Sumatera Utara', 'SU',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Sumatera Barat', 'SB',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'Sumatera Selatan', 'SL',1);
INSERT INTO `exp_br_state`(zone_id,title,code,enabled) VALUES (62, 'DKI Jakarta', 'DKI',1);


