-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: adorama
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `exp_accessories`
--

DROP TABLE IF EXISTS `exp_accessories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_accessories` (
  `accessory_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(75) NOT NULL DEFAULT '',
  `member_groups` varchar(255) NOT NULL DEFAULT 'all',
  `controllers` text,
  `accessory_version` varchar(12) NOT NULL,
  PRIMARY KEY (`accessory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_accessories`
--

LOCK TABLES `exp_accessories` WRITE;
/*!40000 ALTER TABLE `exp_accessories` DISABLE KEYS */;
INSERT INTO `exp_accessories` VALUES (1,'Expressionengine_info_acc','1|5','addons|addons_accessories|addons_extensions|addons_fieldtypes|addons_modules|addons_plugins|admin_content|admin_system|content|content_edit|content_files|content_files_modal|content_publish|design|homepage|members|myaccount|tools|tools_communicate|tools_data|tools_logs|tools_utilities','1.0');
/*!40000 ALTER TABLE `exp_accessories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_actions`
--

DROP TABLE IF EXISTS `exp_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_actions` (
  `action_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `csrf_exempt` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`action_id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_actions`
--

LOCK TABLES `exp_actions` WRITE;
/*!40000 ALTER TABLE `exp_actions` DISABLE KEYS */;
INSERT INTO `exp_actions` VALUES (1,'Search','do_search',1),(2,'Channel','submit_entry',0),(3,'Channel','filemanager_endpoint',0),(4,'Channel','smiley_pop',0),(5,'Channel','combo_loader',0),(6,'Member','registration_form',0),(7,'Member','register_member',0),(8,'Member','activate_member',0),(9,'Member','member_login',0),(10,'Member','member_logout',0),(11,'Member','send_reset_token',0),(12,'Member','process_reset_password',0),(13,'Member','send_member_email',0),(14,'Member','update_un_pw',0),(15,'Member','member_search',0),(16,'Member','member_delete',0),(17,'Rte','get_js',0),(18,'Mailinglist','insert_new_email',0),(19,'Mailinglist','authorize_email',0),(20,'Mailinglist','unsubscribe',0),(21,'Email','send_email',0),(22,'Comment','insert_new_comment',0),(23,'Comment_mcp','delete_comment_notification',0),(24,'Comment','comment_subscribe',0),(25,'Comment','edit_comment',0),(26,'Upload','uploads',0),(27,'Upload','fetch',0),(28,'Upload','resize',0),(29,'Upload','delete',0),(30,'Upload','get',0),(31,'Upload','list_files',0),(32,'Upload','housekeeping',0),(43,'Brilliant_retail','cart_update',0),(42,'Brilliant_retail','cart_clear',0),(41,'Brilliant_retail','cart_remove',0),(40,'Brilliant_retail','cart_add',0),(44,'Brilliant_retail','checkout',0),(45,'Brilliant_retail','checkout_shipping',0),(46,'Brilliant_retail','checkout_total',0),(47,'Brilliant_retail','promo_check_code',0),(48,'Brilliant_retail','customer_register',0),(49,'Brilliant_retail','customer_profile_update',0),(50,'Brilliant_retail','customer_pw_update',0),(51,'Brilliant_retail','customer_download_file',0),(52,'Brilliant_retail','gateway_ipn',1),(53,'Brilliant_retail','process_ipn',1),(54,'Brilliant_retail','pull_feed',0),(55,'Brilliant_retail','retrieve_password',0),(56,'Brilliant_retail','wishlist_process',0),(57,'Brilliant_retail','customer_download_note',0),(58,'Brilliant_retail','reset_password',0),(59,'Brilliant_retail_mcp','product_img_update',0),(60,'Brilliant_retail_mcp','product_add_atributes',0),(61,'Brilliant_retail_mcp','product_search',0),(62,'Brilliant_retail_mcp','product_download_update',0),(63,'Brilliant_retail_mcp','product_configurable_create_options',0),(64,'Brilliant_retail_mcp','download_upload',0),(65,'Brilliant_retail_mcp','s3_get_files',0),(81,'PhotoPrint','quantity',0),(80,'PhotoPrint','canvas',0),(79,'PhotoPrint','cover',0),(78,'PhotoPrint','size',0),(77,'PhotoPrint','product',0),(76,'PhotoPrint','get_image',0),(75,'PhotoPrint','arrange',0),(82,'PhotoPrint','border',0),(83,'Photoprint','select',0),(84,'Ig_picpuller_lite','authorization',0),(85,'Ig_picpuller_lite','deauthorization',0),(86,'Freemember','act_login',0),(87,'Freemember','act_logout',0),(88,'Freemember','act_register',0),(89,'Freemember','act_update_profile',0),(90,'Freemember','act_forgot_password',0),(91,'Freemember','act_reset_password',0),(92,'PhotoPrint','delete_selection',0);
/*!40000 ALTER TABLE `exp_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_admin_access`
--

DROP TABLE IF EXISTS `exp_br_admin_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_admin_access` (
  `admin_access_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL DEFAULT '1',
  `class` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`admin_access_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_admin_access`
--

LOCK TABLES `exp_br_admin_access` WRITE;
/*!40000 ALTER TABLE `exp_br_admin_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_admin_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_attribute`
--

DROP TABLE IF EXISTS `exp_br_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `required` int(11) NOT NULL DEFAULT '0',
  `fieldtype` varchar(255) NOT NULL,
  `filterable` int(11) NOT NULL DEFAULT '1',
  `default_text` varchar(255) DEFAULT NULL,
  `options` text,
  PRIMARY KEY (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_attribute`
--

LOCK TABLES `exp_br_attribute` WRITE;
/*!40000 ALTER TABLE `exp_br_attribute` DISABLE KEYS */;
INSERT INTO `exp_br_attribute` VALUES (22,1,'Notes','notes',0,'textarea',1,'',''),(19,1,'Color','color',0,'dropdown',1,'','Black\nBlue\nBrown\nGray\nGreen\nOrange\nRed\nWhite\nYellow'),(27,1,'File','file',0,'file',1,'',''),(21,1,'Size','size',0,'dropdown',1,'','X-Small\nSmall\nMedium\nLarge\nX-Large\nXX-Large'),(28,1,'Layout','lay',1,'text',1,'',NULL),(30,1,'Quantity','qty',0,'text',1,'',NULL),(31,1,'Layout Action','next',0,'text',1,'',NULL),(32,1,'Border','border',0,'text',1,'',NULL);
/*!40000 ALTER TABLE `exp_br_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_attribute_option`
--

DROP TABLE IF EXISTS `exp_br_attribute_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_attribute_option` (
  `attr_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`attr_option_id`),
  KEY `br_attribute_id` (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_attribute_option`
--

LOCK TABLES `exp_br_attribute_option` WRITE;
/*!40000 ALTER TABLE `exp_br_attribute_option` DISABLE KEYS */;
INSERT INTO `exp_br_attribute_option` VALUES (11,21,'Small',4,'2013-09-23 10:21:42'),(12,21,'Medium',5,'2013-09-23 10:21:42'),(13,21,'Large',6,'2013-09-23 10:21:42'),(14,21,'X-Large',7,'2013-09-23 10:21:42'),(22,29,'12',2,NULL),(23,29,'24',3,NULL),(24,29,'8',1,NULL);
/*!40000 ALTER TABLE `exp_br_attribute_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_attribute_set`
--

DROP TABLE IF EXISTS `exp_br_attribute_set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_attribute_set` (
  `attribute_set_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sort_order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`attribute_set_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_attribute_set`
--

LOCK TABLES `exp_br_attribute_set` WRITE;
/*!40000 ALTER TABLE `exp_br_attribute_set` DISABLE KEYS */;
INSERT INTO `exp_br_attribute_set` VALUES (1,1,'Layout','2015-10-11 18:07:08',1);
/*!40000 ALTER TABLE `exp_br_attribute_set` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_attribute_set_attribute`
--

DROP TABLE IF EXISTS `exp_br_attribute_set_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_attribute_set_attribute` (
  `atrribute_set_attribte_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`atrribute_set_attribte_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_attribute_set_attribute`
--

LOCK TABLES `exp_br_attribute_set_attribute` WRITE;
/*!40000 ALTER TABLE `exp_br_attribute_set_attribute` DISABLE KEYS */;
INSERT INTO `exp_br_attribute_set_attribute` VALUES (6,28,1,1),(5,27,1,0),(7,31,1,2);
/*!40000 ALTER TABLE `exp_br_attribute_set_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_cart`
--

DROP TABLE IF EXISTS `exp_br_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `session_id` varchar(100) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(100) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `token` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_cart`
--

LOCK TABLES `exp_br_cart` WRITE;
/*!40000 ALTER TABLE `exp_br_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_category`
--

DROP TABLE IF EXISTS `exp_br_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `url_title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT '/media/images/cat_banner_01.jpg',
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_descr` varchar(255) NOT NULL DEFAULT '',
  `enabled` int(11) NOT NULL DEFAULT '1',
  `meta_keyword` varchar(255) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sort` int(11) NOT NULL DEFAULT '0',
  `template_path` varchar(100) DEFAULT NULL,
  `detail` text,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_category`
--

LOCK TABLES `exp_br_category` WRITE;
/*!40000 ALTER TABLE `exp_br_category` DISABLE KEYS */;
INSERT INTO `exp_br_category` VALUES (1,1,0,'Products','/products','/media/images/cat_banner_01.jpg','','',1,'','2015-10-07 18:45:23',0,NULL,NULL),(2,1,0,'Accessories','accessories','/media/images/cat_banner_01.jpg','','',1,'','2015-10-11 17:38:34',-1444585114,NULL,NULL);
/*!40000 ALTER TABLE `exp_br_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_config`
--

DROP TABLE IF EXISTS `exp_br_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `label` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '0',
  `groups` varchar(100) NOT NULL DEFAULT '0',
  `descr` varchar(255) NOT NULL,
  `version` float(10,1) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_config`
--

LOCK TABLES `exp_br_config` WRITE;
/*!40000 ALTER TABLE `exp_br_config` DISABLE KEYS */;
INSERT INTO `exp_br_config` VALUES (1,1,'Status Codes','','status','system',1,'0','',0.0,1,'2015-10-07 18:45:21'),(2,1,'Free Shipping','Free Shipping','free','shipping',1,'0','Free shipping with a minimum purchase amount',1.0,1,'2015-10-07 18:45:21'),(4,1,'Order ID','Orders','order_id','system',1,'0','Orders',1.0,1,'2015-10-07 18:45:21'),(10,1,'Mail In','Bank Payment','mailin','gateway',1,'0','Allow users to mail in payment after the purchase.',0.5,1,'2015-11-24 09:38:20'),(6,1,'Pick up Instore','Pick up Instore','instore','shipping',1,'0','Allow the customer to pick up instore (no shipping)',1.0,1,'2015-10-19 22:27:25'),(7,1,'Pay at Store','Pay at Store','payatstore','gateway',1,'0','Allow users to make payment after the purchase when they collect.',0.5,0,'2015-10-21 01:26:25'),(9,1,'JNE Rates Matrix','JNE Shipping Rates','jne','shipping',1,'0','JNE Rates Matrix',1.0,1,'2015-10-21 03:38:05');
/*!40000 ALTER TABLE `exp_br_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_config_data`
--

DROP TABLE IF EXISTS `exp_br_config_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_config_data` (
  `config_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `value` text,
  `options` text,
  `descr` text,
  `required` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`config_data_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_config_data`
--

LOCK TABLES `exp_br_config_data` WRITE;
/*!40000 ALTER TABLE `exp_br_config_data` DISABLE KEYS */;
INSERT INTO `exp_br_config_data` VALUES (1,1,'New Order','','','1',NULL,NULL,0,0),(2,1,'Pending','','','2',NULL,NULL,0,0),(3,1,'Processing','','','3',NULL,NULL,0,0),(4,1,'Shipping','','','4',NULL,NULL,0,0),(5,1,'Complete','','','5',NULL,NULL,0,0),(6,2,'Enabled','enabled','dropdown','1','1:Yes|0:No',NULL,0,0),(7,2,'Label','label','text','Free Shipping',NULL,NULL,0,0),(8,2,'Countries','country','multiselect','a:1:{i:0;s:2:\"US\";}','AF:Afghanistan|AX:Aland Islands|AL:Albania|DZ:Algeria|AD:Andorra|AO:Angola|AI:Anguilla|AQ:Antarctica|AG:Antigua and Barbuda|AR:Argentina|AM:Armenia|AW:Aruba|AU:Australia|AT:Austria|AZ:Azerbaijan|BS:Bahamas|BH:Bahrain|BD:Bangladesh|BB:Barbados|BY:Belarus|BE:Belgium|BZ:Belize|BJ:Benin|BM:Bermuda|BT:Bhutan|BO:Bolivia|BA:Bosnia and Herzegovina|BW:Botswana|BV:Bouvet Island|BR:Brazil|IO:British Indian Ocean Territory|VG:British Virgin Islands|BN:Brunei|BG:Bulgaria|BF:Burkina Faso|BI:Burundi|KH:Cambodia|CM:Cameroon|CA:Canada|CV:Cape Verde|KY:Cayman Islands|CF:Central African Republic|TD:Chad|CL:Chile|CN:China|CX:Christmas Island|CC:Cocos [Keeling] Islands|CO:Colombia|KM:Comoros|CG:Congo - Brazzaville|CD:Congo - Kinshasa|CK:Cook Islands|CR:Costa Rica|CI:Cote d|HR:Croatia|CU:Cuba|CY:Cyprus|CZ:Czech Republic|DK:Denmark|DJ:Djibouti|DM:Dominica|DO:Dominican Republic|EC:Ecuador|EG:Egypt|SV:El Salvador|GQ:Equatorial Guinea|ER:Eritrea|EE:Estonia|ET:Ethiopia|FK:Falkland Islands|FO:Faroe Islands|FJ:Fiji|FI:Finland|FR:France|GF:French Guiana|PF:French Polynesia|TF:French Southern Territories|GA:Gabon|GM:Gambia|GE:Georgia|DE:Germany|GH:Ghana|GI:Gibraltar|GR:Greece|GL:Greenland|GD:Grenada|GP:Guadeloupe|GT:Guatemala|GN:Guinea|GW:Guinea-Bissau|GY:Guyana|HT:Haiti|HM:Heard Island and McDonald Islands|HN:Honduras|HK:Hong Kong SAR China|HU:Hungary|IS:Iceland|IN:India|ID:Indonesia|IR:Iran|IQ:Iraq|IE:Ireland|IM:Isle of Man|IL:Israel|IT:Italy|JM:Jamaica|JP:Japan|JO:Jordan|KZ:Kazakhstan|KE:Kenya|KI:Kiribati|KW:Kuwait|KG:Kyrgyzstan|LA:Laos|LV:Latvia|LB:Lebanon|LS:Lesotho|LR:Liberia|LY:Libya|LI:Liechtenstein|LT:Lithuania|LU:Luxembourg|MO:Macau SAR China|MK:Macedonia|MG:Madagascar|MW:Malawi|MY:Malaysia|MV:Maldives|ML:Mali|MT:Malta|MQ:Martinique|MR:Mauritania|MU:Mauritius|YT:Mayotte|MX:Mexico|FM:Micronesia|MD:Moldova|MC:Monaco|MN:Mongolia|MS:Montserrat|MA:Morocco|MZ:Mozambique|MM:Myanmar [Burma]|NA:Namibia|NR:Nauru|NP:Nepal|NL:Netherlands|AN:Netherlands Antilles|NC:New Caledonia|NZ:New Zealand|NI:Nicaragua|NE:Niger|NG:Nigeria|NU:Niue|NF:Norfolk Island|KP:North Korea|MP:Northern Mariana Islands|NO:Norway|OM:Oman|PK:Pakistan|PS:Palestinian Territories|PA:Panama|PG:Papua New Guinea|PY:Paraguay|PE:Peru|PH:Philippines|PN:Pitcairn Islands|PL:Poland|PT:Portugal|QA:Qatar|RE:Reunion|RO:Romania|RU:Russia|RW:Rwanda|SH:Saint Helena|KN:Saint Kitts and Nevis|LC:Saint Lucia|PM:Saint Pierre and Miquelon|VC:Saint Vincent and the Grenadines|WS:Samoa|SM:San Marino|ST:Sao Tome and Principe|SA:Saudi Arabia|SN:Senegal|SC:Seychelles|SL:Sierra Leone|SG:Singapore|SK:Slovakia|SI:Slovenia|SB:Solomon Islands|SO:Somalia|ZA:South Africa|GS:South Georgia and the South Sandwich Islands|KR:South Korea|ES:Spain|LK:Sri Lanka|SD:Sudan|SR:Suriname|SJ:Svalbard and Jan Mayen|SZ:Swaziland|SE:Sweden|CH:Switzerland|SY:Syria|TW:Taiwan|TJ:Tajikistan|TZ:Tanzania|TH:Thailand|TL:Timor-Leste|TG:Togo|TK:Tokelau|TO:Tonga|TT:Trinidad and Tobago|TN:Tunisia|TR:Turkey|TM:Turkmenistan|TC:Turks and Caicos Islands|TV:Tuvalu|UM:U.S. Minor Outlying Islands|UG:Uganda|UA:Ukraine|AE:United Arab Emirates|GB:United Kingdom|US:United States|UY:Uruguay|UZ:Uzbekistan|VU:Vanuatu|VA:Vatican City|VE:Venezuela|VN:Vietnam|WF:Wallis and Futuna|EH:Western Sahara|YE:Yemen|ZM:Zambia|ZW:Zimbabwe','Select countries where free shipping is available. Control + click to add multiple countries',0,1),(9,2,'Amount','amount','text','0',NULL,'Minimum amount for free shipping',0,2),(10,1,'Canceled','','','0',NULL,NULL,0,0),(11,4,'Order ID','','','10019',NULL,NULL,0,0),(17,6,'Label','label','text','Pick up Instore',NULL,NULL,0,0),(18,6,'Amount','amount','text','0',NULL,'Set the Amount for store Pickup',0,1),(24,9,'Label','label','text','JNE Shipping Rates',NULL,NULL,0,0),(25,9,'JNE ','jne','table','a:2:{i:1;a:9:{i:0;s:2:\"ID\";i:1;s:7:\"Jakarta\";i:2;s:0:\"\";i:3;s:0:\"\";i:4;s:0:\"\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:4:\"8000\";i:8;s:7:\"Jakarta\";}i:2;a:9:{i:0;s:2:\"ID\";i:1;s:7:\"Jakarta\";i:2;s:0:\"\";i:3;s:0:\"\";i:4;s:0:\"\";i:5;s:0:\"\";i:6;s:0:\"\";i:7;s:5:\"10000\";i:8;s:16:\"Same Day Service\";}}','country|state|zip_code|from_price|to_price|from_weight|to_weight|rate|label',NULL,0,1);
/*!40000 ALTER TABLE `exp_br_config_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_currencies`
--

DROP TABLE IF EXISTS `exp_br_currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_currencies` (
  `currency_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `marker` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `value` float(10,5) NOT NULL,
  `updated` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_currencies`
--

LOCK TABLES `exp_br_currencies` WRITE;
/*!40000 ALTER TABLE `exp_br_currencies` DISABLE KEYS */;
INSERT INTO `exp_br_currencies` VALUES (1,'US Dollar','USD','$',1.00000,''),(2,'Indonesian Rupiah','IDR','Rp',1.00000,'');
/*!40000 ALTER TABLE `exp_br_currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_email`
--

DROP TABLE IF EXISTS `exp_br_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_email` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `version` float(10,2) NOT NULL,
  `content` blob NOT NULL,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `subject` varchar(100) NOT NULL,
  `bcc_list` varchar(255) DEFAULT NULL,
  `from_name` varchar(100) NOT NULL,
  `from_email` varchar(100) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_email`
--

LOCK TABLES `exp_br_email` WRITE;
/*!40000 ALTER TABLE `exp_br_email` DISABLE KEYS */;
INSERT INTO `exp_br_email` VALUES (1,'admin-order-payment',1.00,'<table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\" bgcolor=\"#FFFFFF\" >\n	<tr>\n		<td valign=\"top\" align=\"center\">\n			<table width=\"550\" cellpadding=\"0\" cellspacing=\"0\">\n				<tr>\n					<td style=\"background-color:#FFFFFF;border-top:0px solid #000000;border-bottom:0px solid #FFCC66;text-align:right;\" align=\"center\"><span style=\"font-size:10px;color:#333333;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></td>\n				</tr>\n				<tr>\n					<td style=\"background-color:#FFFFFF;border-top:0px solid #FFFFFF;border-bottom:0px solid #333333;\"><center><a href=\"\"><IMG id=emailhead1 SRC=\"{media}/images/email-logo.jpg\" BORDER=\"0\" title=\"Your Company\"  alt=\"Your Company\" align=\"center\"></a></center></td>\n				</tr>\n			</table>\n			<table width=\"550\" cellpadding=\"20\" cellspacing=\"0\" bgcolor=\"#FFFFFF\">\n				<tr>\n					<td bgcolor=\"#FFFFFF\" valign=\"top\" style=\"font-size:12px;color:#000000;line-height:150%;font-family:trebuchet ms;\">\n						<p>\n							<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">Hi {fname}.</span><br>\n							A payment has been applied to your order.<br>\n						</p>\n						<p style=\"border:1px solid #f0f0f0; padding:14px 18px; background:#f3f3f3;\">\n							<span style=\"font-size:14px;font-weight:bold;color:#333333; font-family:arial;line-height:140%\">Order Status </span> <br>\n							<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Order #: </span>{order_id}<br>\n							<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Status:</span>\n							<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\"> {order_status} </span><br>\n						</p>\n						<p>\n							<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\"> Thank you,<br>\n							<span style=\"font-size:12px;color:#000000;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></span> <br><br>\n							If <span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">you have any questions <a href=\"{site_url}/contact\">contact us </a>. </span>\n						</p></td>\n				</tr>\n			</table>\n		</td>\n	</tr>\n</table>',1,'A payment has been processed to order #{order_id}',NULL,'Adorama PrintShop','contact@adorama'),(2,'customer-account-new',1.00,'<table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\" bgcolor=\"#FFFFFF\" >\n		<tr>\n			<td valign=\"top\" align=\"center\">\n				<table width=\"550\" cellpadding=\"0\" cellspacing=\"0\">\n					<tr>\n						<td style=\"background-color:#FFFFFF;border-top:0px solid #000000;border-bottom:0px solid #FFCC66;text-align:right;\" align=\"center\">\n							<span style=\"font-size:10px;color:#333333;line-height:200%;font-family:verdana;text-decoration:none;\">\n								{site_name}\n							</span></td>\n					</tr>\n					<tr>\n						<td style=\"background-color:#FFFFFF;border-top:0px solid #FFFFFF;border-bottom:0px solid #333333;\">\n						    <center>\n						        <a href=\"{site_url}\">\n						            <IMG id=emailhead1 SRC=\"{media}/images/email-logo.jpg\" border=\"0\" title=\"Your Company\"  alt=\"Your Company\" align=\"center\"></a>\n                            </center></td>\n					</tr>\n				</table>\n<table width=\"550\" cellpadding=\"20\" cellspacing=\"0\" bgcolor=\"#FFFFFF\">\n<tr>\n<td bgcolor=\"#FFFFFF\" valign=\"top\" style=\"font-size:12px;color:#000000;line-height:150%;font-family:trebuchet ms;\">\n<p>\n<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">Welcome {fname},</span>\n<br />\n<br />\n{if activation_url != \'\'}\n    \n    <a href=\"{activation_url}\">Click here to activate</a> your new account. \n    <br />\n    <br />\n    You can also cut and paste this link into your browser:\n    <br />\n    <br />\n    {activation_url}\n    <br />\n    <br />\n\n{if:else}\n    Your account has been created. \n    <br />\n    <br />\n    To login go to <a href=\"{site_url}/customer\">{site_url}/customer</a>. <br />\n    <br />\n{/if}\n\n\n<span style=\"font-size:16px;font-weight:bold;color:#333333; font-family:arial;line-height:140%\">New Account</span></p>\n<p style=\"border:1px solid #f0f0f0; padding:14px 18px; background:#f3f3f3;\">\n\n<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Login Email:</span><br />\n<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\"> {email} </span><br />\n<br />\n<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:100%\">If you have questions about the status of your order please <a href=\"{site_url}/contact/\">contact us</a>.</span><br />\n</p>\n<p><span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\"> Thank you,<br />\n  <span style=\"font-size:12px;color:#000000;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></span> </p></td>\n</tr>\n				</table></td>\n		</tr>\n</table>',1,'Thank you for registering with {site_name}',NULL,'Adorama PrintShop','contact@adorama'),(3,'customer-order-new',1.00,'<table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\" bgcolor=\"#FFFFFF\" >\n		<tr>\n			<td valign=\"top\" align=\"center\">\n				<table width=\"550\" cellpadding=\"0\" cellspacing=\"0\">\n					<tr>\n						<td style=\"background-color:#FFFFFF;border-top:0px solid #000000;border-bottom:0px solid #FFCC66;text-align:right;\" align=\"center\">\n							<span style=\"font-size:10px;color:#333333;line-height:200%;font-family:verdana;text-decoration:none;\">\n								{site_name}\n							</span></td>\n					</tr>\n					<tr>\n						<td style=\"background-color:#FFFFFF;border-top:0px solid #FFFFFF;border-bottom:0px solid #333333;\"><center><a href=\"\"><IMG id=emailhead1 SRC=\"{media}/images/email-logo.jpg\" border=\"0\" title=\"Your Company\"  alt=\"Your Company\" align=\"center\"></a></center></td>\n					</tr>\n				</table>\n				<table width=\"550\" cellpadding=\"20\" cellspacing=\"0\" bgcolor=\"#FFFFFF\">\n					<tr>\n						<td bgcolor=\"#FFFFFF\" valign=\"top\" style=\"font-size:12px;color:#000000;line-height:150%;font-family:trebuchet ms;\">\n							<p>\n								<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">Thank you for your order {fname} {lname}.</span><br /><br />\n								To view order details and  files  visit your account  at <a href=\"{site_url}/customer\">{site_url}/customer</a>. If <span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">you have any questions  <a href=\"{site_url}/contact\">contact us </a>. </span><br />\n								<br />\n								<span style=\"font-size:16px;font-weight:bold;color:#333333; font-family:arial;line-height:140%\">Order Confirmation</span>\n							</p>\n							<p style=\"border:1px solid #f0f0f0; padding:14px 18px; background:#f3f3f3;\">\n								<span style=\"font-size:14px;font-weight:bold;color:#333333; font-family:arial;line-height:140%\">Purchasing Information</span> \n								<br />\n								\n								{address}\n\n									<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Billed To:</span><br />\n									<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\">\n										{billing_fname} {billing_lname}<br />\n										{if \'{billing_company}\' != \'\'}{billing_company} <br />{/if}\n										{billing_address1}<br /> \n										{if \'{billing_address2}\' != \'\'}{billing_address2} <br />{/if}\n										{billing_city}, {billing_state} {billing_zip}<br /> \n										{billing_country}<br />{billing_phone}</span><br /><br />\n									<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Shipped To:</span>\n									<br />\n									<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\">\n										{shipping_fname} {shipping_lname}<br />\n										{if \'{shipping_company}\' != \'\'}{shipping_company} <br />{/if}\n										{shipping_address1}	<br />\n										{if \'{shipping_address2}\' != \'\'}{shipping_address2} <br />{/if}\n										{shipping_city}, {shipping_state} {shipping_zip}<br /> {shipping_country}<br /> {shipping_phone}</span><br /><br />\n\n								{/address}\n\n								<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">\n								Payment Method:</span>\n								\n								<br />\n								<br />\n								{payment}\n									Payment Type: {payment_type}<br />\n									Approval: {approval}<br />\n									Transaction ID: {transaction_id}<br />\n								{/payment}\n								<br />											\n								<br />\n								<span style=\"font-size:14px;font-weight:bold;color:#333333; font-family:arial;line-height:140%\">Order Summary</span> <br />\n								<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Order #: </span>{order_id}<br />\n								<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Delivery Method:</span><br />\n								<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\"> {delivery_method} - {delivery_label}</span><br />\n								<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Order Items:</span><br />\n								<table style=\"background-color:#FFF\" width=\"100%\">\n									<tr>\n										<td colspan=\"2\" align=\"left\" style=\"background-color:#EBEBEB;padding-left:4px\">\n											<span style=\"font-size:12px;font-weight:bold;color:#000000;font-family:arial;line-height:140%\">ITEMS</span></td>\n										<td valign=\"top\" style=\"width:40px;background-color:#EBEBEB;padding-left:4px\">\n											<span style=\"font-size:12px;font-weight:bold;color:#000000;font-family:arial;line-height:140%\">Qty</span></td>\n										<td valign=\"top\" style=\"background-color:#EBEBEB;padding-left:4px\">\n											<span style=\"font-size:12px;font-weight:bold;color:#000000;font-family:arial;line-height:140%\">Price</span></td>\n									{items}\n										<tr>\n											<td valign=\"top\" style=\"width:110px\">\n												<a href=\"{site_url}/product/{url_title}\">\n													<img src=\"{media}/{image_thumb}\" style=\"border:1px #CCCCCC solid\"  /></a></td>\n											<td valign=\"top\">\n												<span style=\"font-size:12px;font-weight:bold;color:#000000;font-family:arial;line-height:140%\">\n													<a href=\"{site_url}/product/{url_title}\">{title}</a></span><br />\n												<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\">\n													<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\">{options}</span>\n												</span>\n											</td>\n											<td valign=\"top\" style=\"width:40px\">\n												<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\">{quantity}</span></td>\n											<td valign=\"top\">\n												<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\">{currency_marker}{price}</span></td>\n										</tr>\n									{/items}\n								</table>\n								<span style=\"font-size:12px;font-weight:normal;color:#000000;font-family:arial;line-height:140%\">-----------</span> <br />\n								<span style=\"font-size:12px;font-weight:normal;color:#000000;font-family:arial;line-height:140%\">Subtotal: {currency_marker}{order_subtotal}</span> <br />\n								<span style=\"font-size:12px;font-weight:normal;color:#000000;font-family:arial;line-height:140%\">Discount: {currency_marker}{discount_total}</span> <br />\n								<span style=\"font-size:12px;font-weight:normal;color:#000000;font-family:arial;line-height:140%\">Tax: {currency_marker}{tax_total}</span> <br />\n								<span style=\"font-size:12px;font-weight:normal;color:#000000;font-family:arial;line-height:140%\">Shipping: {currency_marker}{shipping}</span> <br />\n								<span style=\"font-size:12px;font-weight:bold;color:#000000;font-family:arial;line-height:140%\">Total: {currency_marker}{order_total}</span> <br /><br />\n								<span style=\"font-size:12px;font-weight:normal;color:#333333;font-family:arial;line-height:140%\">Special Instructions:</span><br />\n								<br />\n								<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:100%\">If you have questions about the status of your order please <a href=\"{site_url}/contact/\">contact us</a><a href=\"{site_url}/contact\"></a>.</span><br />\n								</p>\n								<p>\n									<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\"> Thank you,<br />\n								  	<span style=\"font-size:12px;color:#000000;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></span> \n								</p>\n						</td>\n					</tr>\n					<tr>\n						<td style=\"background-color:#f2f2f2;border-top:1px solid #FFFFFF;\" valign=\"top\">\n							<span style=\"font-size:10px;color:#333333;line-height:100%;font-family:verdana;\">\n								If you do not wish to receive these emails simply <a href=\"{site_url}/unsubscribe\">unsubscribe</a>.<br />\n							</span></td>\n					</tr>\n				</table></td>\n		</tr>\n</table>',1,'Thank you for your order - Order #{order_id}',NULL,'Adorama PrintShop','contact@adorama'),(4,'customer-order-note',1.00,'<table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\" bgcolor=\"#FFFFFF\" >\n	<tr>\n		<td valign=\"top\" align=\"center\">\n			<table width=\"550\" cellpadding=\"0\" cellspacing=\"0\">\n				<tr>\n					<td style=\"background-color:#FFFFFF;border-top:0px solid #000000;border-bottom:0px solid #FFCC66;text-align:right;\" align=\"center\"><span style=\"font-size:10px;color:#333333;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></td>\n				</tr>\n				<tr>\n					<td style=\"background-color:#FFFFFF;border-top:0px solid #FFFFFF;border-bottom:0px solid #333333;\"><center><a href=\"\"><IMG id=emailhead1 SRC=\"{media}/images/email-logo.jpg\" BORDER=\"0\" title=\"Your Company\"  alt=\"Your Company\" align=\"center\"></a></center></td>\n				</tr>\n			</table>\n			<table width=\"550\" cellpadding=\"20\" cellspacing=\"0\" bgcolor=\"#FFFFFF\">\n				<tr>\n					<td bgcolor=\"#FFFFFF\" valign=\"top\" style=\"font-size:12px;color:#000000;line-height:150%;font-family:trebuchet ms;\">\n						<p>\n							<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">Hi {fname}.</span><br>\n							A note has been added to your order.<br>\n						</p>\n						<p style=\"border:1px solid #f0f0f0; padding:14px 18px; background:#f3f3f3;\">\n							<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Order #: </span>{order_id}<br>\n							<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Note:</span>\n							<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\"> {order_note} </span><br>\n						</p>\n						<p>\n							<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\"> Thank you,<br>\n							<span style=\"font-size:12px;color:#000000;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></span> <br><br>\n							If <span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">you have any questions <a href=\"{site_url}/contact\">contact us </a>. </span>\n						</p></td>\n				</tr>\n			</table>\n		</td>\n	</tr>\n</table>',1,'Your order has been updated - Order #{order_id}',NULL,'Adorama PrintShop','contact@adorama'),(5,'customer-order-status',1.00,'<table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\" bgcolor=\"#FFFFFF\" >\n	<tr>\n		<td valign=\"top\" align=\"center\">\n			<table width=\"550\" cellpadding=\"0\" cellspacing=\"0\">\n				<tr>\n					<td style=\"background-color:#FFFFFF;border-top:0px solid #000000;border-bottom:0px solid #FFCC66;text-align:right;\" align=\"center\"><span style=\"font-size:10px;color:#333333;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></td>\n				</tr>\n				<tr>\n					<td style=\"background-color:#FFFFFF;border-top:0px solid #FFFFFF;border-bottom:0px solid #333333;\"><center><a href=\"\"><IMG id=emailhead1 SRC=\"{media}/images/email-logo.jpg\" BORDER=\"0\" title=\"Your Company\"  alt=\"Your Company\" align=\"center\"></a></center></td>\n				</tr>\n			</table>\n			<table width=\"550\" cellpadding=\"20\" cellspacing=\"0\" bgcolor=\"#FFFFFF\">\n				<tr>\n					<td bgcolor=\"#FFFFFF\" valign=\"top\" style=\"font-size:12px;color:#000000;line-height:150%;font-family:trebuchet ms;\">\n						<p>\n							<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">Hi {fname}.</span><br>\n							Your order status has changed.<br>\n						</p>\n						<p style=\"border:1px solid #f0f0f0; padding:14px 18px; background:#f3f3f3;\">\n							<span style=\"font-size:14px;font-weight:bold;color:#333333; font-family:arial;line-height:140%\">Order Status </span> <br>\n							<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Order #: </span>{order_id}<br>\n							<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Status:</span>\n							<span style=\"font-size:12px;font-weight:normal;color:#333333; font-family:arial;line-height:140%\"> {order_status} </span><br>\n						</p>\n						<p>\n							<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\"> Thank you,<br>\n							<span style=\"font-size:12px;color:#000000;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></span> <br><br>\n							If <span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">you have any questions <a href=\"{site_url}/contact\">contact us </a>. </span>\n						</p></td>\n				</tr>\n			</table>\n		</td>\n	</tr>\n</table>',1,'Your order status has changed - Order #{order_id}',NULL,'Adorama PrintShop','contact@adorama'),(6,'customer-password-reset',1.00,'<table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\" bgcolor=\"#FFFFFF\" >\n	<tr>\n		<td valign=\"top\" align=\"center\">\n			<table width=\"550\" cellpadding=\"0\" cellspacing=\"0\">\n				<tr>\n					<td style=\"background-color:#FFFFFF;border-top:0px solid #000000;border-bottom:0px solid #FFCC66;text-align:right;\" align=\"center\"><span style=\"font-size:10px;color:#333333;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></td>\n				</tr>\n				<tr>\n					<td style=\"background-color:#FFFFFF;border-top:0px solid #FFFFFF;border-bottom:0px solid #333333;\"><center><a href=\"\"><IMG id=emailhead1 SRC=\"{media}/images/email-logo.jpg\" BORDER=\"0\" title=\"Your Company\"  alt=\"Your Company\" align=\"center\"></a></center></td>\n				</tr>\n			</table>\n			<table width=\"550\" cellpadding=\"20\" cellspacing=\"0\" bgcolor=\"#FFFFFF\">\n				<tr>\n					<td bgcolor=\"#FFFFFF\" valign=\"top\" style=\"font-size:12px;color:#000000;line-height:150%;font-family:trebuchet ms;\">\n						<p>\n							<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">Hi {fname}.</span><br>\n							A note has been added to your order.<br>\n						</p>\n						<p style=\"border:1px solid #f0f0f0; padding:14px 18px; background:#f3f3f3;\">\n							<span style=\"font-size:12px;font-weight:bold;color:#333333;font-family:arial;line-height:140%\">Password Reset Link: </span>{link}<br>\n						</p>\n						<p>\n							<span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\"> Thank you,<br>\n							<span style=\"font-size:12px;color:#000000;line-height:200%;font-family:verdana;text-decoration:none;\">{site_name}</span></span> <br><br>\n							If <span style=\"font-size:12px;font-weight:regular;color:#000000;font-family:arial;line-height:140%\">you have any questions <a href=\"{site_url}/contact\">contact us </a>. </span>\n						</p></td>\n				</tr>\n			</table>\n		</td>\n	</tr>\n</table>',1,'{site_name} - Password Reset Link',NULL,'Adorama PrintShop','contact@adorama');
/*!40000 ALTER TABLE `exp_br_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_feeds`
--

DROP TABLE IF EXISTS `exp_br_feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_feeds` (
  `feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_title` varchar(128) NOT NULL DEFAULT '',
  `feed_code` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`feed_id`),
  UNIQUE KEY `feed_code` (`feed_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_feeds`
--

LOCK TABLES `exp_br_feeds` WRITE;
/*!40000 ALTER TABLE `exp_br_feeds` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_log`
--

DROP TABLE IF EXISTS `exp_br_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `owner` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_log`
--

LOCK TABLES `exp_br_log` WRITE;
/*!40000 ALTER TABLE `exp_br_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_order`
--

DROP TABLE IF EXISTS `exp_br_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_id` int(11) NOT NULL DEFAULT '0',
  `site_id` int(11) NOT NULL DEFAULT '1',
  `member_id` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '1',
  `base` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `cart_id` varchar(100) NOT NULL,
  `merchant_id` varchar(100) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `agent_string` varchar(255) DEFAULT 'unknown',
  `ip_address` varchar(50) DEFAULT NULL,
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `order_member_id` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10019 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_order`
--

LOCK TABLES `exp_br_order` WRITE;
/*!40000 ALTER TABLE `exp_br_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_order_address`
--

DROP TABLE IF EXISTS `exp_br_order_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_order_address` (
  `order_address_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `shipping_fname` varchar(50) NOT NULL,
  `shipping_lname` varchar(50) NOT NULL,
  `shipping_address1` varchar(100) NOT NULL,
  `shipping_address2` varchar(100) NOT NULL,
  `shipping_state` varchar(50) NOT NULL,
  `shipping_zip` varchar(50) NOT NULL,
  `shipping_city` varchar(50) NOT NULL,
  `billing_fname` varchar(50) NOT NULL,
  `billing_lname` varchar(50) NOT NULL,
  `billing_address1` varchar(100) NOT NULL,
  `billing_address2` varchar(100) NOT NULL,
  `billing_city` varchar(50) NOT NULL,
  `billing_state` varchar(50) NOT NULL,
  `billing_zip` varchar(50) NOT NULL,
  `billing_country` varchar(5) NOT NULL,
  `shipping_country` varchar(5) NOT NULL,
  `billing_company` varchar(100) NOT NULL,
  `shipping_company` varchar(100) NOT NULL,
  `billing_phone` varchar(100) NOT NULL,
  `shipping_phone` varchar(100) NOT NULL,
  PRIMARY KEY (`order_address_id`),
  KEY `order_address_order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_order_address`
--

LOCK TABLES `exp_br_order_address` WRITE;
/*!40000 ALTER TABLE `exp_br_order_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_order_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_order_download`
--

DROP TABLE IF EXISTS `exp_br_order_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_order_download` (
  `order_download_id` int(11) NOT NULL AUTO_INCREMENT,
  `downloadable_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cnt` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `download_source` varchar(100) DEFAULT 'local',
  `download_limit` int(11) NOT NULL DEFAULT '0',
  `download_length` int(11) NOT NULL,
  `download_version` varchar(50) DEFAULT NULL,
  `license` varchar(100) NOT NULL,
  `note` text,
  PRIMARY KEY (`order_download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_order_download`
--

LOCK TABLES `exp_br_order_download` WRITE;
/*!40000 ALTER TABLE `exp_br_order_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_order_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_order_item`
--

DROP TABLE IF EXISTS `exp_br_order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `base` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `configurable_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `taxable` int(11) NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `shippable` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sku` varchar(100) NOT NULL,
  `options` text,
  PRIMARY KEY (`order_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_order_item`
--

LOCK TABLES `exp_br_order_item` WRITE;
/*!40000 ALTER TABLE `exp_br_order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_order_note`
--

DROP TABLE IF EXISTS `exp_br_order_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_order_note` (
  `order_note_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_note` text NOT NULL,
  `filenm` varchar(100) NOT NULL,
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `isprivate` int(11) NOT NULL,
  PRIMARY KEY (`order_note_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_order_note`
--

LOCK TABLES `exp_br_order_note` WRITE;
/*!40000 ALTER TABLE `exp_br_order_note` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_order_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_order_options`
--

DROP TABLE IF EXISTS `exp_br_order_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_order_options` (
  `order_item_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `options` text NOT NULL,
  PRIMARY KEY (`order_item_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_order_options`
--

LOCK TABLES `exp_br_order_options` WRITE;
/*!40000 ALTER TABLE `exp_br_order_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_order_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_order_payment`
--

DROP TABLE IF EXISTS `exp_br_order_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_order_payment` (
  `order_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `approval` varchar(100) DEFAULT NULL,
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_payment_id`),
  KEY `order_payment_order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_order_payment`
--

LOCK TABLES `exp_br_order_payment` WRITE;
/*!40000 ALTER TABLE `exp_br_order_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_order_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_order_ship`
--

DROP TABLE IF EXISTS `exp_br_order_ship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_order_ship` (
  `order_ship_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `label` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `tracknum` varchar(255) NOT NULL,
  `ship_date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_ship_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_order_ship`
--

LOCK TABLES `exp_br_order_ship` WRITE;
/*!40000 ALTER TABLE `exp_br_order_ship` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_order_ship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_password_reset`
--

DROP TABLE IF EXISTS `exp_br_password_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_password_reset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `secure` varchar(255) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_password_reset`
--

LOCK TABLES `exp_br_password_reset` WRITE;
/*!40000 ALTER TABLE `exp_br_password_reset` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_password_reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product`
--

DROP TABLE IF EXISTS `exp_br_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `type_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` int(11) NOT NULL DEFAULT '0',
  `taxable` int(11) NOT NULL DEFAULT '0',
  `sku` varchar(50) NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `shippable` int(11) NOT NULL DEFAULT '0',
  `url` varchar(100) DEFAULT NULL,
  `manage_inventory` int(11) NOT NULL DEFAULT '1',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `sale_start` datetime DEFAULT NULL,
  `sale_end` datetime DEFAULT NULL,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_descr` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(100) DEFAULT NULL,
  `detail` text,
  `attribute_set_id` int(11) DEFAULT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `featured` int(11) DEFAULT '0',
  PRIMARY KEY (`product_id`),
  FULLTEXT KEY `fulltext_product` (`title`,`meta_keyword`,`detail`,`sku`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product`
--

LOCK TABLES `exp_br_product` WRITE;
/*!40000 ALTER TABLE `exp_br_product` DISABLE KEYS */;
INSERT INTO `exp_br_product` VALUES (1,1,3,'Photobook','2015-10-11 17:17:22',1,0,'pbx20',1.00,1,'photobook',1,19997,0.00,NULL,NULL,NULL,'','','','<p>​Photobook</p>',1,0.00,1),(2,1,3,'Photoprint','2015-10-11 17:27:38',1,0,'ppxx',0.00,1,'photoprint',1,29990,0.00,NULL,NULL,NULL,'','','','<p>​</p>',1,0.00,1),(3,1,3,'Canvas','2015-10-11 17:31:23',1,0,'cvxx',1.00,1,'canvas',1,20000,0.00,NULL,NULL,NULL,'','','','<p>​</p>',1,0.00,1),(4,1,3,'Magnet','2015-10-11 17:35:05',1,0,'mgxx',1.00,1,'ma',1,20000,0.00,NULL,NULL,NULL,'','','','<p>​Magnet printing</p>',1,0.00,1);
/*!40000 ALTER TABLE `exp_br_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_addon`
--

DROP TABLE IF EXISTS `exp_br_product_addon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_addon` (
  `related_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_addon`
--

LOCK TABLES `exp_br_product_addon` WRITE;
/*!40000 ALTER TABLE `exp_br_product_addon` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_product_addon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_attributes`
--

DROP TABLE IF EXISTS `exp_br_product_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_attributes` (
  `pa_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `label` varchar(30) DEFAULT NULL,
  `descr` text NOT NULL,
  PRIMARY KEY (`pa_id`)
) ENGINE=MyISAM AUTO_INCREMENT=971 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_attributes`
--

LOCK TABLES `exp_br_product_attributes` WRITE;
/*!40000 ALTER TABLE `exp_br_product_attributes` DISABLE KEYS */;
INSERT INTO `exp_br_product_attributes` VALUES (967,1,31,NULL,'/photobook/size'),(970,2,31,NULL,'/photoprint/border'),(960,3,31,'next','/canvas/size'),(966,1,28,NULL,'photobook'),(969,2,28,NULL,'photoprint'),(953,3,28,'','canvas'),(963,4,28,NULL,'magnet'),(964,4,31,NULL,'/magnet/quantity');
/*!40000 ALTER TABLE `exp_br_product_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_attributes_option`
--

DROP TABLE IF EXISTS `exp_br_product_attributes_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_attributes_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pa_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `options` text,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `br_product_id` (`product_id`),
  KEY `br_attribute_id` (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_attributes_option`
--

LOCK TABLES `exp_br_product_attributes_option` WRITE;
/*!40000 ALTER TABLE `exp_br_product_attributes_option` DISABLE KEYS */;
INSERT INTO `exp_br_product_attributes_option` VALUES (26,964,4,31,'/magnet/quantity',0),(25,963,4,28,'magnet',0),(23,962,4,27,'',0),(24,962,4,27,NULL,1),(13,952,3,27,'',0),(14,952,3,27,NULL,1),(15,953,3,28,'canvas',0),(33,969,2,28,'photoprint',0),(32,968,2,27,NULL,1),(31,968,2,27,'',0),(29,966,1,28,'photobook',0),(28,965,1,27,NULL,1),(27,965,1,27,'',0),(22,960,3,31,'/canvas/size',0),(30,967,1,31,'/photobook/size',0),(34,970,2,31,'/photoprint/border',0);
/*!40000 ALTER TABLE `exp_br_product_attributes_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_bundle`
--

DROP TABLE IF EXISTS `exp_br_product_bundle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_bundle` (
  `bundle_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`bundle_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_bundle`
--

LOCK TABLES `exp_br_product_bundle` WRITE;
/*!40000 ALTER TABLE `exp_br_product_bundle` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_product_bundle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_category`
--

DROP TABLE IF EXISTS `exp_br_product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_category` (
  `pc_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pc_id`),
  KEY `br_category_id` (`category_id`),
  KEY `br_product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_category`
--

LOCK TABLES `exp_br_product_category` WRITE;
/*!40000 ALTER TABLE `exp_br_product_category` DISABLE KEYS */;
INSERT INTO `exp_br_product_category` VALUES (18,1,1,1,0),(19,1,1,2,0),(14,1,1,3,0),(17,1,1,4,0);
/*!40000 ALTER TABLE `exp_br_product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_configurable`
--

DROP TABLE IF EXISTS `exp_br_product_configurable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_configurable` (
  `configurable_id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `adjust_type` varchar(50) NOT NULL,
  `adjust` decimal(10,2) NOT NULL,
  `attributes` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`configurable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=427 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_configurable`
--

LOCK TABLES `exp_br_product_configurable` WRITE;
/*!40000 ALTER TABLE `exp_br_product_configurable` DISABLE KEYS */;
INSERT INTO `exp_br_product_configurable` VALUES (426,'mg1200',1000000,'fixed',100000.00,'a:1:{s:8:\"Quantity\";s:2:\"12\";}',4,'2015-10-19 22:11:03'),(424,'pb2000',1000000,'fixed',100000.00,'a:1:{s:4:\"Size\";s:4:\"20cm\";}',1,'2015-10-19 22:11:03'),(425,'mg0800',1000000,'fixed',50000.00,'a:1:{s:8:\"Quantity\";s:1:\"8\";}\n',4,'2015-10-19 22:11:03'),(423,'pb1500',999997,'fixed',50000.00,'a:1:{s:4:\"Size\";s:4:\"15cm\";}',1,'2015-10-20 15:31:35'),(420,'pp1208',1000000,'fixed',20000.00,'a:2:{s:6:\"Border\";s:4:\"12cm\";s:8:\"Quantity\";s:1:\"8\";}',2,'2015-10-19 04:04:55'),(419,'pp1024',1000000,'fixed',60000.00,'a:2:{s:6:\"Border\";s:4:\"10cm\";s:8:\"Quantity\";s:2:\"24\";}',3,'2015-10-19 04:04:55'),(418,'pp1016',999994,'fixed',50000.00,'a:2:{s:6:\"Border\";s:4:\"10cm\";s:8:\"Quantity\";s:2:\"16\";}',2,'2015-10-20 15:31:35'),(414,'cv3000',1000000,'fixed',100000.00,'a:1:{s:4:\"Size\";s:14:\"L (30 x 30 cm)\";}',3,'2015-10-19 22:11:03'),(413,'cv2000',1000000,'fixed',50000.00,'a:1:{s:4:\"Size\";s:14:\"M (20 x 20 cm)\";}\n',3,'2015-10-19 22:11:03'),(422,'pp1224',999999,'fixed',60000.00,'a:2:{s:6:\"Border\";s:4:\"12cm\";s:8:\"Quantity\";s:2:\"24\";}',2,'2015-10-21 02:53:27'),(421,'pp1216',999997,'fixed',50000.00,'a:2:{s:6:\"Border\";s:4:\"12cm\";s:8:\"Quantity\";s:2:\"16\";}',2,'2015-10-21 01:25:08'),(417,'pp1008',1000000,'fixed',20000.00,' a:2:{s:6:\"Border\";s:4:\"10cm\";s:8:\"Quantity\";s:1:\"8\";}',2,'2015-10-19 04:04:55');
/*!40000 ALTER TABLE `exp_br_product_configurable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_configurable_attribute`
--

DROP TABLE IF EXISTS `exp_br_product_configurable_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_configurable_attribute` (
  `config_attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `configurable_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`config_attr_id`),
  KEY `br_product_id` (`product_id`),
  KEY `br_attribute_id` (`attribute_id`),
  KEY `br_option_id` (`option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_configurable_attribute`
--

LOCK TABLES `exp_br_product_configurable_attribute` WRITE;
/*!40000 ALTER TABLE `exp_br_product_configurable_attribute` DISABLE KEYS */;
INSERT INTO `exp_br_product_configurable_attribute` VALUES (81,414,3,21,12,0),(80,413,3,21,13,0);
/*!40000 ALTER TABLE `exp_br_product_configurable_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_donation`
--

DROP TABLE IF EXISTS `exp_br_product_donation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_donation` (
  `donation_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `allow_recurring` int(11) NOT NULL DEFAULT '0',
  `min_donation` float NOT NULL DEFAULT '10',
  PRIMARY KEY (`donation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_donation`
--

LOCK TABLES `exp_br_product_donation` WRITE;
/*!40000 ALTER TABLE `exp_br_product_donation` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_product_donation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_download`
--

DROP TABLE IF EXISTS `exp_br_product_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_download` (
  `downloadable_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `filenm_orig` varchar(255) NOT NULL,
  `filenm` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `download_source` varchar(100) DEFAULT 'local',
  `download_limit` int(10) NOT NULL,
  `download_length` int(10) NOT NULL,
  `download_version` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`downloadable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_download`
--

LOCK TABLES `exp_br_product_download` WRITE;
/*!40000 ALTER TABLE `exp_br_product_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_product_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_entry`
--

DROP TABLE IF EXISTS `exp_br_product_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_entry` (
  `product_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  PRIMARY KEY (`product_entry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_entry`
--

LOCK TABLES `exp_br_product_entry` WRITE;
/*!40000 ALTER TABLE `exp_br_product_entry` DISABLE KEYS */;
INSERT INTO `exp_br_product_entry` VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4);
/*!40000 ALTER TABLE `exp_br_product_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_feeds`
--

DROP TABLE IF EXISTS `exp_br_product_feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_feeds` (
  `product_feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `feed_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_feed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_feeds`
--

LOCK TABLES `exp_br_product_feeds` WRITE;
/*!40000 ALTER TABLE `exp_br_product_feeds` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_product_feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_images`
--

DROP TABLE IF EXISTS `exp_br_product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `filenm` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `large` int(11) NOT NULL DEFAULT '0',
  `thumb` int(11) NOT NULL DEFAULT '0',
  `exclude` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2603 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_images`
--

LOCK TABLES `exp_br_product_images` WRITE;
/*!40000 ALTER TABLE `exp_br_product_images` DISABLE KEYS */;
INSERT INTO `exp_br_product_images` VALUES (2595,2509,'d5244a3bda940d3a1f5b6869ec9eff7a.png','long sleeve shirt detail 2',0,0,0,3),(2594,2509,'2a7a1ac80d977ce2bc15929138056d78.png','long sleeve shirt detail 3',0,0,0,2),(2385,2508,'6257e4e866018880a18179ddde662762.png','',1,1,0,0),(2384,2507,'2640292cc7e6d3b0dbb6e20ed470dda7.png','',1,1,0,0),(2593,2509,'962d8a97e97a731058310b7fe61ae851.png','long sleeve shirt detail 1',0,0,0,1),(2592,2509,'139a95a728fd4cee11bfbd5bafc98a5a.png','long sleeve shirt',1,1,0,0),(2485,2510,'954f3c231c3cb75a448cb780b30476ae.png','Safari cargo pants',1,1,0,0),(2585,2511,'661d07200a6556a8047580b9719c336c.png','Suit Jacket - Detail 2',0,0,0,4),(2584,2511,'02ab70d16d679eb73ae019cb0ff0134d.png','Suit Jacket - Gray',0,0,0,3),(2583,2511,'17b1e209ec50e1fb8e6241a1aff0e8a3.png','Suit Jacket - Blue',0,1,0,2),(2582,2511,'5485bc016204c6fd406d418b16153014.png','Suit Jacket Detail',0,0,0,1),(2460,2520,'7fb875cd2b702264ba286af7c8dd09b8.png','Smooth Face Cream',1,1,0,0),(2452,2524,'9bbe55de299f6a7ba96cbd03160fdec3.png','Lemon Pepper Mint Oil',1,1,0,0),(2423,2516,'53d170e027d361408bf6c2d0bd60e561.png','',1,1,0,0),(2439,2517,'5d5d6cb830b8030674694834c89eea75.png','',1,1,0,0),(2509,2515,'28ef631f877a87e3b9e27ef399b15ecb.png','',1,1,0,0),(2424,2516,'571a1c7b4082754310b2edcbad7a1ee2.png','',0,0,0,0),(2436,2519,'619765c91e30b4d617b067137a669fdc.png','Clothing Guide',1,1,0,0),(2477,2521,'56e2316cdc862e58bbdbe05d4f473dac.png','Banana Foot Cream',1,1,0,0),(2478,2522,'22ffe4692cd1e21b8e7bf02e9a1d3e20.png','Age Defying Body Lotion',1,1,0,0),(2517,2523,'773146bd3137830baaf0df2546ddca52.png','Shea Butter Hand Lotion',1,1,0,0),(2453,2525,'dba7c7f6bda94d74160d63cdac47c460.png','Oil Free Sunscreen SPF 30',1,1,0,0),(2596,2526,'f74d56a87889cf0be269d694501f7ac6.png','Stunning Eyeliner ',1,1,0,0),(2568,2527,'444fe8987f70b56fe81f0098653ea07d.png','Silky Shampoo',1,1,0,0),(2581,2511,'c993a2a0a017648c0bfebb8c8fd77bbe.png','Suit Jacket - Black',1,0,0,0),(2602,2536,'61e4044fc25bf124b9387acd1b987071.png','Wellington Hobo Bag ',1,1,0,0);
/*!40000 ALTER TABLE `exp_br_product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_options`
--

DROP TABLE IF EXISTS `exp_br_product_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_options` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `options` text,
  PRIMARY KEY (`po_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_options`
--

LOCK TABLES `exp_br_product_options` WRITE;
/*!40000 ALTER TABLE `exp_br_product_options` DISABLE KEYS */;
INSERT INTO `exp_br_product_options` VALUES (18,1,'N;'),(19,2,'N;'),(14,3,'N;'),(17,4,'N;');
/*!40000 ALTER TABLE `exp_br_product_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_price`
--

DROP TABLE IF EXISTS `exp_br_product_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) DEFAULT '1',
  `end_dt` datetime DEFAULT NULL,
  `start_dt` datetime DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`price_id`),
  KEY `product_price_index` (`product_id`,`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_price`
--

LOCK TABLES `exp_br_product_price` WRITE;
/*!40000 ALTER TABLE `exp_br_product_price` DISABLE KEYS */;
INSERT INTO `exp_br_product_price` VALUES (19,4,1,0,0.00,1,'2020-12-31 23:59:59','2015-09-01 00:00:00',0);
/*!40000 ALTER TABLE `exp_br_product_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_product_related`
--

DROP TABLE IF EXISTS `exp_br_product_related`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_product_related` (
  `related_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_product_related`
--

LOCK TABLES `exp_br_product_related` WRITE;
/*!40000 ALTER TABLE `exp_br_product_related` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_product_related` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_promo`
--

DROP TABLE IF EXISTS `exp_br_promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_promo` (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(50) NOT NULL,
  `code` varchar(30) NOT NULL,
  `start_dt` timestamp NULL DEFAULT NULL,
  `end_dt` timestamp NULL DEFAULT NULL,
  `code_type` varchar(10) NOT NULL DEFAULT 'fixed',
  `discount_type` varchar(50) DEFAULT 'item',
  `max_discount` decimal(10,2) DEFAULT '0.00',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `enabled` int(11) NOT NULL DEFAULT '0',
  `descr` varchar(200) NOT NULL,
  `category_list` text,
  `product_list` text,
  `min_subtotal` decimal(10,2) NOT NULL DEFAULT '1.00',
  `min_quantity` int(11) NOT NULL DEFAULT '1',
  `uses_per` int(11) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '1',
  `stop_rules` int(11) NOT NULL DEFAULT '0',
  `groups` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_promo`
--

LOCK TABLES `exp_br_promo` WRITE;
/*!40000 ALTER TABLE `exp_br_promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_search`
--

DROP TABLE IF EXISTS `exp_br_search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_search` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `hash` varchar(100) NOT NULL,
  `search_term` varchar(100) NOT NULL,
  `result_count` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`search_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_search`
--

LOCK TABLES `exp_br_search` WRITE;
/*!40000 ALTER TABLE `exp_br_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_state`
--

DROP TABLE IF EXISTS `exp_br_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `enabled` int(11) DEFAULT '1',
  PRIMARY KEY (`state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_state`
--

LOCK TABLES `exp_br_state` WRITE;
/*!40000 ALTER TABLE `exp_br_state` DISABLE KEYS */;
INSERT INTO `exp_br_state` VALUES (1,62,'ACEH','AC',1),(2,62,'Bali','BA',1),(3,62,'Bangka-Belitung','BB',1),(4,62,'Banten','BT',1),(5,62,'Bengkulu','BE',1),(6,62,'Gorontalo','GO',1),(7,62,'Jambi','JA',1),(8,62,'Jawa Barat','JR',1),(9,62,'Jawa Tengah','JT',1),(10,62,'Jawa Timur','JI',1),(11,62,'Kalimantan Barat','KB',1),(12,62,'Kalimantan Selatan','KS',1),(13,62,'Kalimantan Tengah','KT',1),(14,62,'Kalimantan Timur','KI',1),(15,62,'Lampung','LA',1),(16,62,'Maluku','MA',1),(17,62,'Maluku Utara','MU',1),(18,62,'Nusa Tenggara Barat','NB',1),(19,62,'Nusa Tenggara Timur','NT',1),(20,62,'Papua Barat','PB',1),(21,62,'Irian Jaya','IJ',1),(22,62,'Riau','RI',1),(23,62,'Sulawesi Selatan','SN',1),(24,62,'Sulawesi Tengah','ST',1),(25,62,'Sulawesi Tenggara','SG',1),(26,62,'Sulawesi Utara','SW',1),(27,62,'Sumatera Utara','SU',1),(28,62,'Sumatera Barat','SB',1),(29,62,'Sumatera Selatan','SL',1),(30,62,'DKI Jakarta','DKI',1);
/*!40000 ALTER TABLE `exp_br_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_store`
--

DROP TABLE IF EXISTS `exp_br_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `channel_id` int(11) DEFAULT NULL,
  `logo` varchar(100) NOT NULL DEFAULT 'logo.png',
  `license` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) NOT NULL DEFAULT 'ID',
  `zipcode` varchar(50) NOT NULL DEFAULT '12000',
  `fax` varchar(50) DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT '1',
  `result_limit` int(11) NOT NULL DEFAULT '24',
  `result_per_page` int(11) NOT NULL DEFAULT '12',
  `result_paginate` int(11) NOT NULL DEFAULT '5',
  `register_group` int(11) NOT NULL DEFAULT '5',
  `guest_checkout` int(11) NOT NULL DEFAULT '1',
  `media_url` varchar(255) NOT NULL DEFAULT '/media',
  `media_dir` varchar(255) NOT NULL,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_keywords` varchar(100) DEFAULT NULL,
  `meta_descr` varchar(255) DEFAULT NULL,
  `donation_enabled` int(11) NOT NULL DEFAULT '0',
  `subscription_enabled` int(11) NOT NULL DEFAULT '0',
  `first_notice` int(11) NOT NULL DEFAULT '7',
  `second_notice` int(11) NOT NULL DEFAULT '14',
  `third_notice` int(11) NOT NULL DEFAULT '21',
  `cancel_subscription` int(11) NOT NULL DEFAULT '28',
  `secure_url` varchar(150) DEFAULT NULL,
  `cart_url` varchar(100) NOT NULL DEFAULT 'cart',
  `checkout_url` varchar(100) NOT NULL DEFAULT 'checkout',
  `thankyou_url` varchar(100) NOT NULL DEFAULT 'checkout/thankyou',
  `customer_url` varchar(100) NOT NULL DEFAULT 'customer',
  `product_url` varchar(100) NOT NULL DEFAULT 'product',
  `low_stock` int(11) NOT NULL DEFAULT '0',
  `display_out_of_stock` int(11) NOT NULL DEFAULT '0',
  `downloads_use_local` int(11) NOT NULL DEFAULT '0',
  `downloads_use_s3` int(11) NOT NULL DEFAULT '0',
  `downloads_local` varchar(100) DEFAULT NULL,
  `downloads_s3_access_key` varchar(100) DEFAULT NULL,
  `downloads_s3_secret_key` varchar(100) DEFAULT NULL,
  `downloads_s3_length` int(11) DEFAULT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_store`
--

LOCK TABLES `exp_br_store` WRITE;
/*!40000 ALTER TABLE `exp_br_store` DISABLE KEYS */;
INSERT INTO `exp_br_store` VALUES (1,1,3,'logo21.png','7f32886e-9b03-458e-a589-c4c230df4761','(888) 555-5555','Kemang','Jak','Jakarta Selatan','DKI Jakarta','IDR','11100','(888) 555-5555',2,96,12,5,6,1,'http://adorama.vardion.com/media/','/srv/www/adorama.vardion.com/media','','','',0,0,7,14,21,28,'http://adorama.vardion.com','cart','checkout','payment/confirm','customer','product',25,0,0,0,'','','',0);
/*!40000 ALTER TABLE `exp_br_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_tax`
--

DROP TABLE IF EXISTS `exp_br_tax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_tax` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(50) NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT '62',
  `state_id` int(11) DEFAULT NULL,
  `zipcode` text,
  `rate` float(10,4) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`tax_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_tax`
--

LOCK TABLES `exp_br_tax` WRITE;
/*!40000 ALTER TABLE `exp_br_tax` DISABLE KEYS */;
INSERT INTO `exp_br_tax` VALUES (1,1,'Sales Tax',62,NULL,NULL,10.0000,0);
/*!40000 ALTER TABLE `exp_br_tax` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_wishlist`
--

DROP TABLE IF EXISTS `exp_br_wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_wishlist` (
  `wishlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `is_public` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(11) NOT NULL,
  `notes` text,
  PRIMARY KEY (`wishlist_id`),
  KEY `index_wishlist` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_wishlist`
--

LOCK TABLES `exp_br_wishlist` WRITE;
/*!40000 ALTER TABLE `exp_br_wishlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_wishlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_wishlist_hash`
--

DROP TABLE IF EXISTS `exp_br_wishlist_hash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_wishlist_hash` (
  `wishlist_hash_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`wishlist_hash_id`),
  UNIQUE KEY `member_id` (`member_id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_wishlist_hash`
--

LOCK TABLES `exp_br_wishlist_hash` WRITE;
/*!40000 ALTER TABLE `exp_br_wishlist_hash` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_br_wishlist_hash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_br_zone`
--

DROP TABLE IF EXISTS `exp_br_zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_br_zone` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_br_zone`
--

LOCK TABLES `exp_br_zone` WRITE;
/*!40000 ALTER TABLE `exp_br_zone` DISABLE KEYS */;
INSERT INTO `exp_br_zone` VALUES (1,'United States','US',0),(2,'Afghanistan','AF',0),(3,'Albania','AL',0),(4,'Algeria','DZ',0),(6,'Andorra','AD',0),(7,'Angola','AO',0),(8,'Anguilla','AI',0),(9,'Antarctica','AQ',0),(10,'Antigua and Barbuda','AG',0),(11,'Argentina','AR',0),(12,'Armenia','AM',0),(13,'Aruba','AW',0),(14,'Australia','AU',0),(15,'Austria','AT',0),(16,'Azerbaijan','AZ',0),(17,'Bahamas','BS',0),(18,'Bahrain','BH',0),(19,'Bangladesh','BD',0),(20,'Barbados','BB',0),(21,'Belarus','BY',0),(22,'Belgium','BE',0),(23,'Belize','BZ',0),(24,'Benin','BJ',0),(25,'Bermuda','BM',0),(26,'Bhutan','BT',0),(27,'Bolivia','BO',0),(28,'Bosnia and Herzegovina','BA',0),(29,'Botswana','BW',0),(30,'Bouvet Island','BV',0),(31,'Brazil','BR',0),(32,'British Indian Ocean Territory','IO',0),(33,'British Virgin Islands','VG',0),(34,'Brunei','BN',0),(35,'Bulgaria','BG',0),(36,'Burkina Faso','BF',0),(37,'Burundi','BI',0),(38,'Cambodia','KH',0),(39,'Cameroon','CM',0),(40,'Canada','CA',0),(41,'Cape Verde','CV',0),(42,'Cayman Islands','KY',0),(43,'Central African Republic','CF',0),(44,'Chad','TD',0),(45,'Chile','CL',0),(46,'China','CN',0),(47,'Christmas Island','CX',0),(48,'Cocos [Keeling] Islands','CC',0),(49,'Colombia','CO',0),(50,'Comoros','KM',0),(51,'Congo - Brazzaville','CG',0),(52,'Congo - Kinshasa','CD',0),(53,'Cook Islands','CK',0),(54,'Costa Rica','CR',0),(55,'Croatia','HR',0),(56,'Cuba','CU',0),(57,'Cyprus','CY',0),(58,'Czech Republic','CZ',0),(59,'Cote dIvoire','CI',0),(60,'Denmark','DK',0),(61,'Djibouti','DJ',0),(62,'Indonesia','ID',1),(102,'Dominica','DM',0),(63,'Dominican Republic','DO',0),(64,'Ecuador','EC',0),(65,'Egypt','EG',0),(66,'El Salvador','SV',0),(67,'Equatorial Guinea','GQ',0),(68,'Eritrea','ER',0),(69,'Estonia','EE',0),(70,'Ethiopia','ET',0),(71,'Falkland Islands','FK',0),(72,'Faroe Islands','FO',0),(73,'Fiji','FJ',0),(74,'Finland','FI',0),(75,'France','FR',0),(76,'French Guiana','GF',0),(77,'French Polynesia','PF',0),(78,'French Southern Territories','TF',0),(79,'Gabon','GA',0),(80,'Gambia','GM',0),(81,'Georgia','GE',0),(82,'Germany','DE',0),(83,'Ghana','GH',0),(84,'Gibraltar','GI',0),(85,'Greece','GR',0),(86,'Greenland','GL',0),(87,'Grenada','GD',0),(88,'Guadeloupe','GP',0),(90,'Guatemala','GT',0),(92,'Guinea','GN',0),(93,'Guinea-Bissau','GW',0),(94,'Guyana','GY',0),(95,'Haiti','HT',0),(96,'Heard Island and McDonald Islands','HM',0),(97,'Honduras','HN',0),(98,'Hong Kong SAR China','HK',0),(99,'Hungary','HU',0),(100,'Iceland','IS',0),(101,'India','IN',0),(103,'Iran','IR',0),(104,'Iraq','IQ',0),(105,'Ireland','IE',0),(106,'Isle of Man','IM',0),(107,'Israel','IL',0),(108,'Italy','IT',0),(109,'Jamaica','JM',0),(110,'Japan','JP',0),(112,'Jordan','JO',0),(113,'Kazakhstan','KZ',0),(114,'Kenya','KE',0),(115,'Kiribati','KI',0),(116,'Kuwait','KW',0),(117,'Kyrgyzstan','KG',0),(118,'Laos','LA',0),(119,'Latvia','LV',0),(120,'Lebanon','LB',0),(121,'Lesotho','LS',0),(122,'Liberia','LR',0),(123,'Libya','LY',0),(124,'Liechtenstein','LI',0),(125,'Lithuania','LT',0),(126,'Luxembourg','LU',0),(127,'Macau SAR China','MO',0),(128,'Macedonia','MK',0),(129,'Madagascar','MG',0),(130,'Malawi','MW',0),(131,'Malaysia','MY',0),(132,'Maldives','MV',0),(133,'Mali','ML',0),(134,'Malta','MT',0),(136,'Martinique','MQ',0),(137,'Mauritania','MR',0),(138,'Mauritius','MU',0),(139,'Mayotte','YT',0),(140,'Mexico','MX',0),(141,'Micronesia','FM',0),(142,'Moldova','MD',0),(143,'Monaco','MC',0),(144,'Mongolia','MN',0),(146,'Montserrat','MS',0),(147,'Morocco','MA',0),(148,'Mozambique','MZ',0),(149,'Myanmar [Burma]','MM',0),(150,'Namibia','NA',0),(151,'Nauru','NR',0),(152,'Nepal','NP',0),(153,'Netherlands','NL',0),(154,'Netherlands Antilles','AN',0),(155,'New Caledonia','NC',0),(156,'New Zealand','NZ',0),(157,'Nicaragua','NI',0),(158,'Niger','NE',0),(159,'Nigeria','NG',0),(160,'Niue','NU',0),(161,'Norfolk Island','NF',0),(162,'North Korea','KP',0),(163,'Northern Mariana Islands','MP',0),(164,'Norway','NO',0),(165,'Oman','OM',0),(166,'Pakistan','PK',0),(168,'Palestinian Territories','PS',0),(169,'Panama','PA',0),(170,'Papua New Guinea','PG',0),(171,'Paraguay','PY',0),(172,'Peru','PE',0),(173,'Philippines','PH',0),(174,'Pitcairn Islands','PN',0),(175,'Poland','PL',0),(176,'Portugal','PT',0),(178,'Qatar','QA',0),(179,'Romania','RO',0),(180,'Russia','RU',0),(181,'Rwanda','RW',0),(182,'Reunion','RE',0),(184,'Saint Helena','SH',0),(185,'Saint Kitts and Nevis','KN',0),(186,'Saint Lucia','LC',0),(188,'Saint Pierre and Miquelon','PM',0),(189,'Saint Vincent and the Grenadines','VC',0),(190,'Samoa','WS',0),(191,'San Marino','SM',0),(192,'Saudi Arabia','SA',0),(193,'Senegal','SN',0),(195,'Seychelles','SC',0),(196,'Sierra Leone','SL',0),(197,'Singapore','SG',0),(198,'Slovakia','SK',0),(199,'Slovenia','SI',0),(200,'Solomon Islands','SB',0),(201,'Somalia','SO',0),(202,'South Africa','ZA',0),(203,'South Georgia and the South Sandwich Islands','GS',0),(204,'South Korea','KR',0),(205,'Spain','ES',0),(206,'Sri Lanka','LK',0),(207,'Sudan','SD',0),(208,'Suriname','SR',0),(209,'Svalbard and Jan Mayen','SJ',0),(210,'Swaziland','SZ',0),(211,'Sweden','SE',0),(212,'Switzerland','CH',0),(213,'Syria','SY',0),(214,'Sao Tome and Principe','ST',0),(215,'Taiwan','TW',0),(216,'Tajikistan','TJ',0),(217,'Tanzania','TZ',0),(218,'Thailand','TH',0),(219,'Timor-Leste','TL',0),(220,'Togo','TG',0),(221,'Tokelau','TK',0),(222,'Tonga','TO',0),(223,'Trinidad and Tobago','TT',0),(224,'Tunisia','TN',0),(225,'Turkey','TR',0),(226,'Turkmenistan','TM',0),(227,'Turks and Caicos Islands','TC',0),(228,'Tuvalu','TV',0),(231,'Uganda','UG',0),(232,'Ukraine','UA',0),(233,'United Arab Emirates','AE',0),(234,'United Kingdom','GB',0),(235,'Uruguay','UY',0),(236,'Uzbekistan','UZ',0),(237,'Vanuatu','VU',0),(238,'Vatican City','VA',0),(239,'Venezuela','VE',0),(240,'Vietnam','VN',0),(241,'Wallis and Futuna','WF',0),(242,'Western Sahara','EH',0),(243,'Yemen','YE',0),(244,'Zambia','ZM',0),(245,'Zimbabwe','ZW',0),(246,'Aland Islands','AX',0);
/*!40000 ALTER TABLE `exp_br_zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_captcha`
--

DROP TABLE IF EXISTS `exp_captcha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(10) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_captcha`
--

LOCK TABLES `exp_captcha` WRITE;
/*!40000 ALTER TABLE `exp_captcha` DISABLE KEYS */;
INSERT INTO `exp_captcha` VALUES (1,1445355493,'127.0.0.1','brought48'),(2,1445409248,'127.0.0.1','three94');
/*!40000 ALTER TABLE `exp_captcha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_categories`
--

DROP TABLE IF EXISTS `exp_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_categories` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_id` int(6) unsigned NOT NULL,
  `parent_id` int(4) unsigned NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_url_title` varchar(75) NOT NULL,
  `cat_description` text,
  `cat_image` varchar(120) DEFAULT NULL,
  `cat_order` int(4) unsigned NOT NULL,
  PRIMARY KEY (`cat_id`),
  KEY `group_id` (`group_id`),
  KEY `cat_name` (`cat_name`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_categories`
--

LOCK TABLES `exp_categories` WRITE;
/*!40000 ALTER TABLE `exp_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_category_field_data`
--

DROP TABLE IF EXISTS `exp_category_field_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_category_field_data` (
  `cat_id` int(4) unsigned NOT NULL,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_id` int(4) unsigned NOT NULL,
  `field_id_1` text,
  `field_ft_1` varchar(40) DEFAULT 'none',
  PRIMARY KEY (`cat_id`),
  KEY `site_id` (`site_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_category_field_data`
--

LOCK TABLES `exp_category_field_data` WRITE;
/*!40000 ALTER TABLE `exp_category_field_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_category_field_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_category_fields`
--

DROP TABLE IF EXISTS `exp_category_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_category_fields` (
  `field_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_id` int(4) unsigned NOT NULL,
  `field_name` varchar(32) NOT NULL DEFAULT '',
  `field_label` varchar(50) NOT NULL DEFAULT '',
  `field_type` varchar(12) NOT NULL DEFAULT 'text',
  `field_list_items` text NOT NULL,
  `field_maxl` smallint(3) NOT NULL DEFAULT '128',
  `field_ta_rows` tinyint(2) NOT NULL DEFAULT '8',
  `field_default_fmt` varchar(40) NOT NULL DEFAULT 'none',
  `field_show_fmt` char(1) NOT NULL DEFAULT 'y',
  `field_text_direction` char(3) NOT NULL DEFAULT 'ltr',
  `field_required` char(1) NOT NULL DEFAULT 'n',
  `field_order` int(3) unsigned NOT NULL,
  PRIMARY KEY (`field_id`),
  KEY `site_id` (`site_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_category_fields`
--

LOCK TABLES `exp_category_fields` WRITE;
/*!40000 ALTER TABLE `exp_category_fields` DISABLE KEYS */;
INSERT INTO `exp_category_fields` VALUES (1,1,1,'blog','Blog','textarea','',128,6,'xhtml','y','ltr','y',2);
/*!40000 ALTER TABLE `exp_category_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_category_groups`
--

DROP TABLE IF EXISTS `exp_category_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_category_groups` (
  `group_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_name` varchar(50) NOT NULL,
  `sort_order` char(1) NOT NULL DEFAULT 'a',
  `exclude_group` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_html_formatting` char(4) NOT NULL DEFAULT 'all',
  `can_edit_categories` text,
  `can_delete_categories` text,
  PRIMARY KEY (`group_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_category_groups`
--

LOCK TABLES `exp_category_groups` WRITE;
/*!40000 ALTER TABLE `exp_category_groups` DISABLE KEYS */;
INSERT INTO `exp_category_groups` VALUES (1,1,'Blog','a',0,'all','','');
/*!40000 ALTER TABLE `exp_category_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_category_posts`
--

DROP TABLE IF EXISTS `exp_category_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_category_posts` (
  `entry_id` int(10) unsigned NOT NULL,
  `cat_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`entry_id`,`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_category_posts`
--

LOCK TABLES `exp_category_posts` WRITE;
/*!40000 ALTER TABLE `exp_category_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_category_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_channel_data`
--

DROP TABLE IF EXISTS `exp_channel_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_channel_data` (
  `entry_id` int(10) unsigned NOT NULL,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `channel_id` int(4) unsigned NOT NULL,
  `field_id_1` text,
  `field_ft_1` tinytext,
  PRIMARY KEY (`entry_id`),
  KEY `channel_id` (`channel_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_channel_data`
--

LOCK TABLES `exp_channel_data` WRITE;
/*!40000 ALTER TABLE `exp_channel_data` DISABLE KEYS */;
INSERT INTO `exp_channel_data` VALUES (1,1,3,'','xhtml'),(2,1,3,'','xhtml'),(3,1,3,'','xhtml'),(4,1,3,'','xhtml');
/*!40000 ALTER TABLE `exp_channel_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_channel_entries_autosave`
--

DROP TABLE IF EXISTS `exp_channel_entries_autosave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_channel_entries_autosave` (
  `entry_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `original_entry_id` int(10) unsigned NOT NULL,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `channel_id` int(4) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_topic_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `url_title` varchar(75) NOT NULL,
  `status` varchar(50) NOT NULL,
  `versioning_enabled` char(1) NOT NULL DEFAULT 'n',
  `view_count_one` int(10) unsigned NOT NULL DEFAULT '0',
  `view_count_two` int(10) unsigned NOT NULL DEFAULT '0',
  `view_count_three` int(10) unsigned NOT NULL DEFAULT '0',
  `view_count_four` int(10) unsigned NOT NULL DEFAULT '0',
  `allow_comments` varchar(1) NOT NULL DEFAULT 'y',
  `sticky` varchar(1) NOT NULL DEFAULT 'n',
  `entry_date` int(10) NOT NULL,
  `year` char(4) NOT NULL,
  `month` char(2) NOT NULL,
  `day` char(3) NOT NULL,
  `expiration_date` int(10) NOT NULL DEFAULT '0',
  `comment_expiration_date` int(10) NOT NULL DEFAULT '0',
  `edit_date` bigint(14) DEFAULT NULL,
  `recent_comment_date` int(10) DEFAULT NULL,
  `comment_total` int(4) unsigned NOT NULL DEFAULT '0',
  `entry_data` text,
  PRIMARY KEY (`entry_id`),
  KEY `channel_id` (`channel_id`),
  KEY `author_id` (`author_id`),
  KEY `url_title` (`url_title`),
  KEY `status` (`status`),
  KEY `entry_date` (`entry_date`),
  KEY `expiration_date` (`expiration_date`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_channel_entries_autosave`
--

LOCK TABLES `exp_channel_entries_autosave` WRITE;
/*!40000 ALTER TABLE `exp_channel_entries_autosave` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_channel_entries_autosave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_channel_fields`
--

DROP TABLE IF EXISTS `exp_channel_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_channel_fields` (
  `field_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_id` int(4) unsigned NOT NULL,
  `field_name` varchar(32) NOT NULL,
  `field_label` varchar(50) NOT NULL,
  `field_instructions` text,
  `field_type` varchar(50) NOT NULL DEFAULT 'text',
  `field_list_items` text NOT NULL,
  `field_pre_populate` char(1) NOT NULL DEFAULT 'n',
  `field_pre_channel_id` int(6) unsigned DEFAULT NULL,
  `field_pre_field_id` int(6) unsigned DEFAULT NULL,
  `field_ta_rows` tinyint(2) DEFAULT '8',
  `field_maxl` smallint(3) DEFAULT NULL,
  `field_required` char(1) NOT NULL DEFAULT 'n',
  `field_text_direction` char(3) NOT NULL DEFAULT 'ltr',
  `field_search` char(1) NOT NULL DEFAULT 'n',
  `field_is_hidden` char(1) NOT NULL DEFAULT 'n',
  `field_fmt` varchar(40) NOT NULL DEFAULT 'xhtml',
  `field_show_fmt` char(1) NOT NULL DEFAULT 'y',
  `field_order` int(3) unsigned NOT NULL,
  `field_content_type` varchar(20) NOT NULL DEFAULT 'any',
  `field_settings` text,
  PRIMARY KEY (`field_id`),
  KEY `group_id` (`group_id`),
  KEY `field_type` (`field_type`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_channel_fields`
--

LOCK TABLES `exp_channel_fields` WRITE;
/*!40000 ALTER TABLE `exp_channel_fields` DISABLE KEYS */;
INSERT INTO `exp_channel_fields` VALUES (1,1,1,'content','Content','-- blog content -- ','rte','','0',0,0,20,128,'y','ltr','y','n','xhtml','n',1,'any','YTo4OntzOjI0OiJydGVfZmllbGRfdGV4dF9kaXJlY3Rpb24iO3M6MzoibHRyIjtzOjExOiJydGVfdGFfcm93cyI7czoyOiIyMCI7czoxODoiZmllbGRfc2hvd19zbWlsZXlzIjtzOjE6Im4iO3M6MTk6ImZpZWxkX3Nob3dfZ2xvc3NhcnkiO3M6MToibiI7czoyMToiZmllbGRfc2hvd19zcGVsbGNoZWNrIjtzOjE6Im4iO3M6MjY6ImZpZWxkX3Nob3dfZm9ybWF0dGluZ19idG5zIjtzOjE6Im4iO3M6MjQ6ImZpZWxkX3Nob3dfZmlsZV9zZWxlY3RvciI7czoxOiJuIjtzOjIwOiJmaWVsZF9zaG93X3dyaXRlbW9kZSI7czoxOiJuIjt9');
/*!40000 ALTER TABLE `exp_channel_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_channel_form_settings`
--

DROP TABLE IF EXISTS `exp_channel_form_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_channel_form_settings` (
  `channel_form_settings_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '0',
  `channel_id` int(6) unsigned NOT NULL DEFAULT '0',
  `default_status` varchar(50) NOT NULL DEFAULT 'open',
  `require_captcha` char(1) NOT NULL DEFAULT 'n',
  `allow_guest_posts` char(1) NOT NULL DEFAULT 'n',
  `default_author` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`channel_form_settings_id`),
  KEY `site_id` (`site_id`),
  KEY `channel_id` (`channel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_channel_form_settings`
--

LOCK TABLES `exp_channel_form_settings` WRITE;
/*!40000 ALTER TABLE `exp_channel_form_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_channel_form_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_channel_member_groups`
--

DROP TABLE IF EXISTS `exp_channel_member_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_channel_member_groups` (
  `group_id` smallint(4) unsigned NOT NULL,
  `channel_id` int(6) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`channel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_channel_member_groups`
--

LOCK TABLES `exp_channel_member_groups` WRITE;
/*!40000 ALTER TABLE `exp_channel_member_groups` DISABLE KEYS */;
INSERT INTO `exp_channel_member_groups` VALUES (6,4);
/*!40000 ALTER TABLE `exp_channel_member_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_channel_titles`
--

DROP TABLE IF EXISTS `exp_channel_titles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_channel_titles` (
  `entry_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `channel_id` int(4) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_topic_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `url_title` varchar(75) NOT NULL,
  `status` varchar(50) NOT NULL,
  `versioning_enabled` char(1) NOT NULL DEFAULT 'n',
  `view_count_one` int(10) unsigned NOT NULL DEFAULT '0',
  `view_count_two` int(10) unsigned NOT NULL DEFAULT '0',
  `view_count_three` int(10) unsigned NOT NULL DEFAULT '0',
  `view_count_four` int(10) unsigned NOT NULL DEFAULT '0',
  `allow_comments` varchar(1) NOT NULL DEFAULT 'y',
  `sticky` varchar(1) NOT NULL DEFAULT 'n',
  `entry_date` int(10) NOT NULL,
  `year` char(4) NOT NULL,
  `month` char(2) NOT NULL,
  `day` char(3) NOT NULL,
  `expiration_date` int(10) NOT NULL DEFAULT '0',
  `comment_expiration_date` int(10) NOT NULL DEFAULT '0',
  `edit_date` bigint(14) DEFAULT NULL,
  `recent_comment_date` int(10) DEFAULT NULL,
  `comment_total` int(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`entry_id`),
  KEY `channel_id` (`channel_id`),
  KEY `author_id` (`author_id`),
  KEY `url_title` (`url_title`),
  KEY `status` (`status`),
  KEY `entry_date` (`entry_date`),
  KEY `expiration_date` (`expiration_date`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_channel_titles`
--

LOCK TABLES `exp_channel_titles` WRITE;
/*!40000 ALTER TABLE `exp_channel_titles` DISABLE KEYS */;
INSERT INTO `exp_channel_titles` VALUES (1,1,3,1,NULL,'127.0.0.1','Photobook','photobook','open','y',0,0,0,0,'y','n',1445106542,'2015','10','18',0,0,20151017182902,0,0),(2,1,3,1,NULL,'127.0.0.1','Photoprint','photoprint','open','y',0,0,0,0,'y','n',1445106562,'2015','10','18',0,0,20151017182922,0,0),(3,1,3,1,NULL,'127.0.0.1','Canvas','canvas','open','y',0,0,0,0,'y','n',1445104260,'2015','10','18',0,0,20151017175100,0,0),(4,1,3,1,NULL,'127.0.0.1','Magnet','ma','open','y',0,0,0,0,'y','n',1445106422,'2015','10','18',0,0,20151017182702,0,0);
/*!40000 ALTER TABLE `exp_channel_titles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_channels`
--

DROP TABLE IF EXISTS `exp_channels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_channels` (
  `channel_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `channel_name` varchar(40) NOT NULL,
  `channel_title` varchar(100) NOT NULL,
  `channel_url` varchar(100) NOT NULL,
  `channel_description` varchar(255) DEFAULT NULL,
  `channel_lang` varchar(12) NOT NULL,
  `total_entries` mediumint(8) NOT NULL DEFAULT '0',
  `total_comments` mediumint(8) NOT NULL DEFAULT '0',
  `last_entry_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_comment_date` int(10) unsigned NOT NULL DEFAULT '0',
  `cat_group` varchar(255) DEFAULT NULL,
  `status_group` int(4) unsigned DEFAULT NULL,
  `deft_status` varchar(50) NOT NULL DEFAULT 'open',
  `field_group` int(4) unsigned DEFAULT NULL,
  `search_excerpt` int(4) unsigned DEFAULT NULL,
  `deft_category` varchar(60) DEFAULT NULL,
  `deft_comments` char(1) NOT NULL DEFAULT 'y',
  `channel_require_membership` char(1) NOT NULL DEFAULT 'y',
  `channel_max_chars` int(5) unsigned DEFAULT NULL,
  `channel_html_formatting` char(4) NOT NULL DEFAULT 'all',
  `channel_allow_img_urls` char(1) NOT NULL DEFAULT 'y',
  `channel_auto_link_urls` char(1) NOT NULL DEFAULT 'n',
  `channel_notify` char(1) NOT NULL DEFAULT 'n',
  `channel_notify_emails` varchar(255) DEFAULT NULL,
  `comment_url` varchar(80) DEFAULT NULL,
  `comment_system_enabled` char(1) NOT NULL DEFAULT 'y',
  `comment_require_membership` char(1) NOT NULL DEFAULT 'n',
  `comment_use_captcha` char(1) NOT NULL DEFAULT 'n',
  `comment_moderate` char(1) NOT NULL DEFAULT 'n',
  `comment_max_chars` int(5) unsigned DEFAULT '5000',
  `comment_timelock` int(5) unsigned NOT NULL DEFAULT '0',
  `comment_require_email` char(1) NOT NULL DEFAULT 'y',
  `comment_text_formatting` char(5) NOT NULL DEFAULT 'xhtml',
  `comment_html_formatting` char(4) NOT NULL DEFAULT 'safe',
  `comment_allow_img_urls` char(1) NOT NULL DEFAULT 'n',
  `comment_auto_link_urls` char(1) NOT NULL DEFAULT 'y',
  `comment_notify` char(1) NOT NULL DEFAULT 'n',
  `comment_notify_authors` char(1) NOT NULL DEFAULT 'n',
  `comment_notify_emails` varchar(255) DEFAULT NULL,
  `comment_expiration` int(4) unsigned NOT NULL DEFAULT '0',
  `search_results_url` varchar(80) DEFAULT NULL,
  `show_button_cluster` char(1) NOT NULL DEFAULT 'y',
  `rss_url` varchar(80) DEFAULT NULL,
  `enable_versioning` char(1) NOT NULL DEFAULT 'n',
  `max_revisions` smallint(4) unsigned NOT NULL DEFAULT '10',
  `default_entry_title` varchar(100) DEFAULT NULL,
  `url_title_prefix` varchar(80) DEFAULT NULL,
  `live_look_template` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`channel_id`),
  KEY `cat_group` (`cat_group`),
  KEY `status_group` (`status_group`),
  KEY `field_group` (`field_group`),
  KEY `channel_name` (`channel_name`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_channels`
--

LOCK TABLES `exp_channels` WRITE;
/*!40000 ALTER TABLE `exp_channels` DISABLE KEYS */;
INSERT INTO `exp_channels` VALUES (1,1,'br','Brilliant Retail','/br/',NULL,'en',0,0,0,0,NULL,NULL,'open',NULL,NULL,NULL,'y','y',NULL,'all','y','n','n',NULL,NULL,'y','n','n','n',5000,0,'y','xhtml','safe','n','y','n','n',NULL,0,NULL,'y',NULL,'n',10,NULL,NULL,0),(2,1,'br','Brilliant Retail','/br/',NULL,'en',0,0,0,0,NULL,NULL,'open',NULL,NULL,NULL,'y','y',NULL,'all','y','n','n',NULL,NULL,'y','n','n','n',5000,0,'y','xhtml','safe','n','y','n','n',NULL,0,NULL,'y',NULL,'n',10,NULL,NULL,0),(3,1,'br','Brilliant Retail','/br/',NULL,'en',3,0,1445106542,0,NULL,NULL,'open',NULL,NULL,NULL,'y','y',NULL,'all','y','n','n',NULL,NULL,'y','n','n','n',5000,0,'y','xhtml','safe','n','y','n','n',NULL,0,NULL,'y',NULL,'n',10,NULL,NULL,0),(4,1,'blog','blog','http://adorama/index.php','Blogs channel','en',0,0,0,0,'',1,'open',NULL,NULL,'','y','y',NULL,'all','y','n','n','','','y','n','n','n',5000,0,'y','xhtml','safe','n','y','n','n','',0,'','y','','n',10,'','',0);
/*!40000 ALTER TABLE `exp_channels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_comment_subscriptions`
--

DROP TABLE IF EXISTS `exp_comment_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_comment_subscriptions` (
  `subscription_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entry_id` int(10) unsigned DEFAULT NULL,
  `member_id` int(10) DEFAULT '0',
  `email` varchar(75) DEFAULT NULL,
  `subscription_date` varchar(10) DEFAULT NULL,
  `notification_sent` char(1) DEFAULT 'n',
  `hash` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`subscription_id`),
  KEY `entry_id` (`entry_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_comment_subscriptions`
--

LOCK TABLES `exp_comment_subscriptions` WRITE;
/*!40000 ALTER TABLE `exp_comment_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_comment_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_comments`
--

DROP TABLE IF EXISTS `exp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_comments` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) DEFAULT '1',
  `entry_id` int(10) unsigned DEFAULT '0',
  `channel_id` int(4) unsigned DEFAULT '1',
  `author_id` int(10) unsigned DEFAULT '0',
  `status` char(1) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `url` varchar(75) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `comment_date` int(10) DEFAULT NULL,
  `edit_date` int(10) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`comment_id`),
  KEY `entry_id` (`entry_id`),
  KEY `channel_id` (`channel_id`),
  KEY `author_id` (`author_id`),
  KEY `status` (`status`),
  KEY `site_id` (`site_id`),
  KEY `comment_date_idx` (`comment_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_comments`
--

LOCK TABLES `exp_comments` WRITE;
/*!40000 ALTER TABLE `exp_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_content_types`
--

DROP TABLE IF EXISTS `exp_content_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_content_types` (
  `content_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_type_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_content_types`
--

LOCK TABLES `exp_content_types` WRITE;
/*!40000 ALTER TABLE `exp_content_types` DISABLE KEYS */;
INSERT INTO `exp_content_types` VALUES (1,'grid'),(2,'channel');
/*!40000 ALTER TABLE `exp_content_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_cp_log`
--

DROP TABLE IF EXISTS `exp_cp_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_cp_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `member_id` int(10) unsigned NOT NULL,
  `username` varchar(32) NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `act_date` int(10) NOT NULL,
  `action` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_cp_log`
--

LOCK TABLES `exp_cp_log` WRITE;
/*!40000 ALTER TABLE `exp_cp_log` DISABLE KEYS */;
INSERT INTO `exp_cp_log` VALUES (1,1,1,'admin','127.0.0.1',1444238196,'Logged in'),(2,1,1,'admin','127.0.0.1',1444242381,'Logged in'),(3,1,1,'admin','127.0.0.1',1444242534,'Logged in'),(4,1,1,'admin','127.0.0.1',1444242542,'Logged in'),(5,1,1,'admin','127.0.0.1',1444242662,'Logged in'),(6,1,1,'admin','127.0.0.1',1444242725,'Logged in'),(7,1,1,'admin','127.0.0.1',1444243757,'Logged in'),(8,1,1,'admin','127.0.0.1',1444575646,'Logged in'),(9,1,1,'admin','127.0.0.1',1444583429,'Logged in'),(10,1,1,'admin','127.0.0.1',1444585670,'Channel Created:&nbsp;&nbsp;blog'),(11,1,1,'admin','127.0.0.1',1444585689,'Field Group Created:&nbsp;blog'),(12,1,1,'admin','127.0.0.1',1444585784,'Category Group Created:&nbsp;&nbsp;Blog'),(13,1,1,'admin','127.0.0.1',1444810568,'Logged in'),(14,1,1,'admin','127.0.0.1',1444810989,'Logged in'),(15,1,1,'admin','127.0.0.1',1444824097,'Logged in'),(16,1,1,'admin','127.0.0.1',1444832689,'Logged in'),(17,1,1,'admin','127.0.0.1',1444980146,'Logged in'),(18,1,1,'admin','127.0.0.1',1445002955,'Logged in'),(19,1,1,'admin','127.0.0.1',1445103831,'Logged in'),(20,1,1,'admin','127.0.0.1',1445115472,'Logged in'),(21,1,1,'admin','127.0.0.1',1445128103,'Logged in'),(22,1,1,'admin','127.0.0.1',1445141797,'Logged in'),(23,1,1,'admin','127.0.0.1',1445141832,'Logged in'),(24,1,1,'admin','127.0.0.1',1445168130,'Logged in'),(25,1,1,'admin','127.0.0.1',1445174015,'Logged in'),(26,1,1,'admin','127.0.0.1',1445174661,'Logged in'),(27,1,1,'admin','127.0.0.1',1445236800,'Logged in'),(28,1,1,'admin','127.0.0.1',1445245983,'Logged in'),(29,1,1,'admin','127.0.0.1',1445293323,'Logged in'),(30,1,1,'admin','127.0.0.1',1445303965,'Logged in'),(31,1,1,'admin','127.0.0.1',1445307624,'Logged in'),(32,1,1,'admin','127.0.0.1',1445308619,'Logged in'),(33,1,1,'admin','127.0.0.1',1445319634,'Logged in'),(34,1,1,'admin','127.0.0.1',1445319690,'Member Group Created:&nbsp;&nbsp;Customers'),(35,1,1,'admin','127.0.0.1',1445328645,'Logged in'),(36,1,1,'admin','127.0.0.1',1445337165,'Logged in'),(37,1,1,'admin','127.0.0.1',1445337167,'Logged in'),(38,1,1,'admin','127.0.0.1',1445355126,'Logged in'),(39,1,1,'admin','127.0.0.1',1445355305,'Logged in'),(40,1,1,'admin','127.0.0.1',1445355338,'Logged in'),(41,1,1,'admin','127.0.0.1',1445390746,'Logged in'),(42,1,1,'admin','127.0.0.1',1445398671,'Logged in'),(43,1,1,'admin','127.0.0.1',1445409852,'Logged in'),(44,1,1,'admin','127.0.0.1',1445417011,'Logged in'),(45,1,1,'admin','140.0.115.201',1448354088,'Logged in'),(46,1,1,'admin','140.0.115.201',1448357622,'Logged in'),(47,1,1,'admin','140.0.115.201',1448357667,'Logged in'),(48,1,1,'admin','140.0.115.201',1448430373,'Logged in');
/*!40000 ALTER TABLE `exp_cp_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_cp_search_index`
--

DROP TABLE IF EXISTS `exp_cp_search_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_cp_search_index` (
  `search_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(20) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `access` varchar(50) DEFAULT NULL,
  `keywords` text,
  PRIMARY KEY (`search_id`),
  FULLTEXT KEY `keywords` (`keywords`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_cp_search_index`
--

LOCK TABLES `exp_cp_search_index` WRITE;
/*!40000 ALTER TABLE `exp_cp_search_index` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_cp_search_index` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_developer_log`
--

DROP TABLE IF EXISTS `exp_developer_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_developer_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` int(10) unsigned NOT NULL,
  `viewed` char(1) NOT NULL DEFAULT 'n',
  `description` text,
  `function` varchar(100) DEFAULT NULL,
  `line` int(10) unsigned DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `deprecated_since` varchar(10) DEFAULT NULL,
  `use_instead` varchar(100) DEFAULT NULL,
  `template_id` int(10) unsigned NOT NULL DEFAULT '0',
  `template_name` varchar(100) DEFAULT NULL,
  `template_group` varchar(100) DEFAULT NULL,
  `addon_module` varchar(100) DEFAULT NULL,
  `addon_method` varchar(100) DEFAULT NULL,
  `snippets` text,
  `hash` char(32) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_developer_log`
--

LOCK TABLES `exp_developer_log` WRITE;
/*!40000 ALTER TABLE `exp_developer_log` DISABLE KEYS */;
INSERT INTO `exp_developer_log` VALUES (10,1445292929,'y',NULL,'restore_xid()',2792,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'4bec96e5303169d7f7c39c425e0d378d'),(11,1445292929,'y',NULL,'restore_xid()',2896,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'8c0063facd9f90a4044d916fc3fdcdc4'),(12,1445293506,'y',NULL,'restore_xid()',3196,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mcp.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'04d08eb892216051549a096341c4256b'),(13,1445294625,'y',NULL,'restore_xid()',2797,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'a002fba9e2d9740809ad929926c81be9'),(14,1445294625,'y',NULL,'restore_xid()',2901,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'418dce5b7878f6b1629e841918d0e520'),(15,1445303711,'y',NULL,'restore_xid()',2804,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'d2234d5930c201e6b9db035b67476af0'),(16,1445303711,'y',NULL,'restore_xid()',2908,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'370e87707c2142596100252b22b0b15a'),(17,1445336809,'y',NULL,'restore_xid()',2803,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'73179249ad9150f3a30191b472f0cafd'),(18,1445336809,'y',NULL,'restore_xid()',2907,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'9c72ad132c49cf3857b361212ab6bb9d'),(19,1445355084,'y',NULL,'restore_xid()',2806,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'c24587eef1ed26c577741fc725fc594c'),(20,1445355084,'y',NULL,'restore_xid()',2910,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'7ab869710be4a68e9cd54b95866f8f94'),(21,1445393094,'n',NULL,'restore_xid()',3199,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mcp.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'366b359fa317f9523a13ef8b6f28a265'),(22,1445407614,'n',NULL,'restore_xid()',2911,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'eed8db617062ac1aba54ff0b624d227d'),(23,1445407971,'n',NULL,'restore_xid()',2808,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'8a006b1ea5701420575ef00aad5d93c9'),(24,1445407971,'n',NULL,'restore_xid()',2913,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mod.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'689635a7293880e465c5ae9b763fdc1d'),(25,1445417462,'n',NULL,'restore_xid()',681,'D:\\srv\\nginx\\html\\adorama\\system\\expressionengine\\third_party\\brilliant_retail\\mcp.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'7e9d927dcdc2297f0033663f696ff03f'),(26,1448357909,'n',NULL,'restore_xid()',3199,'system/expressionengine/third_party/brilliant_retail/mcp.brilliant_retail.php','2.8',NULL,0,NULL,NULL,NULL,NULL,NULL,'56e4232a893a17af415083a2daff9b57');
/*!40000 ALTER TABLE `exp_developer_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_email_cache`
--

DROP TABLE IF EXISTS `exp_email_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_email_cache` (
  `cache_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `cache_date` int(10) unsigned NOT NULL DEFAULT '0',
  `total_sent` int(6) unsigned NOT NULL,
  `from_name` varchar(70) NOT NULL,
  `from_email` varchar(75) NOT NULL,
  `recipient` text NOT NULL,
  `cc` text NOT NULL,
  `bcc` text NOT NULL,
  `recipient_array` mediumtext NOT NULL,
  `subject` varchar(120) NOT NULL,
  `message` mediumtext NOT NULL,
  `plaintext_alt` mediumtext NOT NULL,
  `mailinglist` char(1) NOT NULL DEFAULT 'n',
  `mailtype` varchar(6) NOT NULL,
  `text_fmt` varchar(40) NOT NULL,
  `wordwrap` char(1) NOT NULL DEFAULT 'y',
  `priority` char(1) NOT NULL DEFAULT '3',
  PRIMARY KEY (`cache_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_email_cache`
--

LOCK TABLES `exp_email_cache` WRITE;
/*!40000 ALTER TABLE `exp_email_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_email_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_email_cache_mg`
--

DROP TABLE IF EXISTS `exp_email_cache_mg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_email_cache_mg` (
  `cache_id` int(6) unsigned NOT NULL,
  `group_id` smallint(4) NOT NULL,
  PRIMARY KEY (`cache_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_email_cache_mg`
--

LOCK TABLES `exp_email_cache_mg` WRITE;
/*!40000 ALTER TABLE `exp_email_cache_mg` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_email_cache_mg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_email_cache_ml`
--

DROP TABLE IF EXISTS `exp_email_cache_ml`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_email_cache_ml` (
  `cache_id` int(6) unsigned NOT NULL,
  `list_id` smallint(4) NOT NULL,
  PRIMARY KEY (`cache_id`,`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_email_cache_ml`
--

LOCK TABLES `exp_email_cache_ml` WRITE;
/*!40000 ALTER TABLE `exp_email_cache_ml` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_email_cache_ml` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_email_console_cache`
--

DROP TABLE IF EXISTS `exp_email_console_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_email_console_cache` (
  `cache_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `cache_date` int(10) unsigned NOT NULL DEFAULT '0',
  `member_id` int(10) unsigned NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `recipient` varchar(75) NOT NULL,
  `recipient_name` varchar(50) NOT NULL,
  `subject` varchar(120) NOT NULL,
  `message` mediumtext NOT NULL,
  PRIMARY KEY (`cache_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_email_console_cache`
--

LOCK TABLES `exp_email_console_cache` WRITE;
/*!40000 ALTER TABLE `exp_email_console_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_email_console_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_email_tracker`
--

DROP TABLE IF EXISTS `exp_email_tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_email_tracker` (
  `email_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_date` int(10) unsigned NOT NULL DEFAULT '0',
  `sender_ip` varchar(45) NOT NULL,
  `sender_email` varchar(75) NOT NULL,
  `sender_username` varchar(50) NOT NULL,
  `number_recipients` int(4) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_email_tracker`
--

LOCK TABLES `exp_email_tracker` WRITE;
/*!40000 ALTER TABLE `exp_email_tracker` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_email_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_entry_versioning`
--

DROP TABLE IF EXISTS `exp_entry_versioning`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_entry_versioning` (
  `version_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entry_id` int(10) unsigned NOT NULL,
  `channel_id` int(4) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `version_date` int(10) NOT NULL,
  `version_data` mediumtext NOT NULL,
  PRIMARY KEY (`version_id`),
  KEY `entry_id` (`entry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_entry_versioning`
--

LOCK TABLES `exp_entry_versioning` WRITE;
/*!40000 ALTER TABLE `exp_entry_versioning` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_entry_versioning` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_extensions`
--

DROP TABLE IF EXISTS `exp_extensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_extensions` (
  `extension_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(50) NOT NULL DEFAULT '',
  `method` varchar(50) NOT NULL DEFAULT '',
  `hook` varchar(50) NOT NULL DEFAULT '',
  `settings` text NOT NULL,
  `priority` int(2) NOT NULL DEFAULT '10',
  `version` varchar(10) NOT NULL DEFAULT '',
  `enabled` char(1) NOT NULL DEFAULT 'y',
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_extensions`
--

LOCK TABLES `exp_extensions` WRITE;
/*!40000 ALTER TABLE `exp_extensions` DISABLE KEYS */;
INSERT INTO `exp_extensions` VALUES (1,'Rte_ext','myaccount_nav_setup','myaccount_nav_setup','',10,'1.0.1','y'),(2,'Rte_ext','cp_menu_array','cp_menu_array','',10,'1.0.1','y'),(8,'Brilliant_retail_ext','br_template_post_parse','template_post_parse','a:0:{}',99,'1.7.0.0','y'),(7,'Brilliant_retail_ext','br_cp_menu_array','cp_menu_array','a:0:{}',10,'1.7.0.0','y'),(6,'Brilliant_retail_ext','br_edit_entries_additional_where','edit_entries_additional_where','a:0:{}',10,'1.7.0.0','y'),(9,'Brilliant_retail_ext','br_edit_entries_additional_where','edit_entries_additional_where','',10,'1.7.0.0','y'),(10,'Brilliant_retail_ext','br_cp_menu_array','cp_menu_array','',10,'1.7.0.0','y'),(11,'Brilliant_retail_ext','br_template_post_parse','template_post_parse','',99,'1.7.0.0','y'),(12,'Upload_ext','member_login_hook','member_member_login_single','a:0:{}',10,'1.0.3','y');
/*!40000 ALTER TABLE `exp_extensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_field_formatting`
--

DROP TABLE IF EXISTS `exp_field_formatting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_field_formatting` (
  `formatting_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_id` int(10) unsigned NOT NULL,
  `field_fmt` varchar(40) NOT NULL,
  PRIMARY KEY (`formatting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_field_formatting`
--

LOCK TABLES `exp_field_formatting` WRITE;
/*!40000 ALTER TABLE `exp_field_formatting` DISABLE KEYS */;
INSERT INTO `exp_field_formatting` VALUES (1,1,'none'),(2,1,'br'),(3,1,'markdown'),(4,1,'xhtml');
/*!40000 ALTER TABLE `exp_field_formatting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_field_groups`
--

DROP TABLE IF EXISTS `exp_field_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_field_groups` (
  `group_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_field_groups`
--

LOCK TABLES `exp_field_groups` WRITE;
/*!40000 ALTER TABLE `exp_field_groups` DISABLE KEYS */;
INSERT INTO `exp_field_groups` VALUES (1,1,'blog');
/*!40000 ALTER TABLE `exp_field_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_fieldtypes`
--

DROP TABLE IF EXISTS `exp_fieldtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_fieldtypes` (
  `fieldtype_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `version` varchar(12) NOT NULL,
  `settings` text,
  `has_global_settings` char(1) DEFAULT 'n',
  PRIMARY KEY (`fieldtype_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_fieldtypes`
--

LOCK TABLES `exp_fieldtypes` WRITE;
/*!40000 ALTER TABLE `exp_fieldtypes` DISABLE KEYS */;
INSERT INTO `exp_fieldtypes` VALUES (1,'select','1.0','YTowOnt9','n'),(2,'text','1.0','YTowOnt9','n'),(3,'textarea','1.0','YTowOnt9','n'),(4,'date','1.0','YTowOnt9','n'),(5,'file','1.0','YTowOnt9','n'),(6,'grid','1.0','YTowOnt9','n'),(7,'multi_select','1.0','YTowOnt9','n'),(8,'checkboxes','1.0','YTowOnt9','n'),(9,'radio','1.0','YTowOnt9','n'),(10,'relationship','1.0','YTowOnt9','n'),(11,'rte','1.0','YTowOnt9','n'),(12,'brilliant_retail','1.7.0.0','YTowOnt9','n');
/*!40000 ALTER TABLE `exp_fieldtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_file_categories`
--

DROP TABLE IF EXISTS `exp_file_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_file_categories` (
  `file_id` int(10) unsigned DEFAULT NULL,
  `cat_id` int(10) unsigned DEFAULT NULL,
  `sort` int(10) unsigned DEFAULT '0',
  `is_cover` char(1) DEFAULT 'n',
  KEY `file_id` (`file_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_file_categories`
--

LOCK TABLES `exp_file_categories` WRITE;
/*!40000 ALTER TABLE `exp_file_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_file_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_file_dimensions`
--

DROP TABLE IF EXISTS `exp_file_dimensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_file_dimensions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `upload_location_id` int(4) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT '',
  `short_name` varchar(255) DEFAULT '',
  `resize_type` varchar(50) DEFAULT '',
  `width` int(10) DEFAULT '0',
  `height` int(10) DEFAULT '0',
  `watermark_id` int(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_location_id` (`upload_location_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_file_dimensions`
--

LOCK TABLES `exp_file_dimensions` WRITE;
/*!40000 ALTER TABLE `exp_file_dimensions` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_file_dimensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_file_watermarks`
--

DROP TABLE IF EXISTS `exp_file_watermarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_file_watermarks` (
  `wm_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `wm_name` varchar(80) DEFAULT NULL,
  `wm_type` varchar(10) DEFAULT 'text',
  `wm_image_path` varchar(100) DEFAULT NULL,
  `wm_test_image_path` varchar(100) DEFAULT NULL,
  `wm_use_font` char(1) DEFAULT 'y',
  `wm_font` varchar(30) DEFAULT NULL,
  `wm_font_size` int(3) unsigned DEFAULT NULL,
  `wm_text` varchar(100) DEFAULT NULL,
  `wm_vrt_alignment` varchar(10) DEFAULT 'top',
  `wm_hor_alignment` varchar(10) DEFAULT 'left',
  `wm_padding` int(3) unsigned DEFAULT NULL,
  `wm_opacity` int(3) unsigned DEFAULT NULL,
  `wm_hor_offset` int(4) unsigned DEFAULT NULL,
  `wm_vrt_offset` int(4) unsigned DEFAULT NULL,
  `wm_x_transp` int(4) DEFAULT NULL,
  `wm_y_transp` int(4) DEFAULT NULL,
  `wm_font_color` varchar(7) DEFAULT NULL,
  `wm_use_drop_shadow` char(1) DEFAULT 'y',
  `wm_shadow_distance` int(3) unsigned DEFAULT NULL,
  `wm_shadow_color` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`wm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_file_watermarks`
--

LOCK TABLES `exp_file_watermarks` WRITE;
/*!40000 ALTER TABLE `exp_file_watermarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_file_watermarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_files`
--

DROP TABLE IF EXISTS `exp_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_files` (
  `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `upload_location_id` int(4) unsigned DEFAULT '0',
  `rel_path` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` int(10) DEFAULT '0',
  `description` text,
  `credit` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `uploaded_by_member_id` int(10) unsigned DEFAULT '0',
  `upload_date` int(10) DEFAULT NULL,
  `modified_by_member_id` int(10) unsigned DEFAULT '0',
  `modified_date` int(10) DEFAULT NULL,
  `file_hw_original` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`file_id`),
  KEY `upload_location_id` (`upload_location_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_files`
--

LOCK TABLES `exp_files` WRITE;
/*!40000 ALTER TABLE `exp_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_global_variables`
--

DROP TABLE IF EXISTS `exp_global_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_global_variables` (
  `variable_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `variable_name` varchar(50) NOT NULL,
  `variable_data` text NOT NULL,
  PRIMARY KEY (`variable_id`),
  KEY `variable_name` (`variable_name`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_global_variables`
--

LOCK TABLES `exp_global_variables` WRITE;
/*!40000 ALTER TABLE `exp_global_variables` DISABLE KEYS */;
INSERT INTO `exp_global_variables` VALUES (1,1,'.htaccess','deny from all'),(2,1,'branding_begin','<div id=\"branding\">\n	<div id=\"branding_logo\"></div>\n	<div id=\"branding_sub\">\n		<h1><a href=\"{site_url}\" title=\"Agile Records Home\"></a></h1>'),(3,1,'branding_end','</div> <!-- ending #branding_sub -->\n</div> <!-- ending #branding -->'),(4,1,'comment_guidelines','<div id=\"comment_guidelines\">\n	<h6>Comment Guidelines</h6>\n	<p>Basic HTML formatting permitted - <br />\n		<code>&lt;ul&gt;</code>, <code>&lt;li&gt;</code>, <code>&lt;strong&gt;</code>, <code>&lt;em&gt;</code>, <code>&lt;a href&gt;</code>, <code>&lt;blockquote&gt;</code>, <code>&lt;code&gt;</code></p>\n</div>'),(5,1,'css','<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/jquery-ui.min.css\">\r\n<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap.min.css\">\r\n<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/style.css\">\r\n<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/adorama.css\">\r\n<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/font-awesome/css/font-awesome.min.css\">\r\n<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}fonts/stylesheet.css\">\r\n'),(6,1,'favicon','<!-- Favicon -->\n'),(7,1,'flash_message','Free shiping for order more than IDR 100.000'),(8,1,'footer','<footer>\r\n    <div class=\"bg-black\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"padd clearfix\">\r\n                    <div class=\"footer-toggle\">\r\n                        <div class=\"col-md-4 col-xs-12\">\r\n                            <ul class=\"mnu1 pull-right\">\r\n                                <li><a href=\"/contact\">Contact Us</a></li>\r\n                                <li><a href=\"/payment\">Confirm Payment</a></li>\r\n                                <li><a href=\"/privacy\">Privacy & Term</a></li>\r\n                            </ul>\r\n                        </div>\r\n                        <div class=\"col-md-8 col-xs-12\">\r\n                            <ul class=\"mnu2\">\r\n                                <li><a href=\"/faq\">Frequently Asked Questions</a></li>\r\n                                <li><a href=\"/order_and_shipping\">Shipping Information</a></li>\r\n                                <li><a href=\"/photoprint_info\">Randomizer</a></li>\r\n                            </ul>\r\n                        </div>	\r\n                    </div>\r\n                    <div class=\"col-md-4 col-xs-12\"><span class=\"lbl-footer pull-right\">&copy Copyright 2015 Adorama</span></div>\r\n                    <div class=\"col-md-8 col-xs-12 align-center\"><a href=\"#\" id=\"sh-foot\" class=\"left up\">Show Footer <i class=\"fa fa-caret-down careD\"></i></a></div>						\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</footer>'),(9,1,'foot_script',' $(document).ready(function() {\r\n     $(\'.carousel\').carousel({\r\n       interval: 6000\r\n     });\r\n     $(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			 $(\'html, body\').animate({\r\n                                    scrollTop: $(document).height()\r\n                            }, 2000);\r\n			e.preventDefault();\r\n        });\r\n     setTimeout(\'$(\".header-top\").hide(\"fadeUp\")\',5000);\r\n});\r\n\r\nfunction equalGrids(){\r\n	equalGrid = $(\'section .photoitem\').width();\r\n	$(\'section .photoitem\').height(equalGrid);\r\n	/*for footer stay on bottom*/\r\n	defContentHeight = $(window).innerHeight() - 110;\r\n	if ($(\'footer\').siblings(\'section\').height() < defContentHeight){\r\n		$(\'footer\').addClass(\'stayBottom\');\r\n	}\r\n	else if($(\'footer\').siblings(\'section\').height() > defContentHeight){\r\n		$(\'footer\').removeClass(\'stayBottom\');\r\n	}\r\n}\r\n//$(\'.datepicker\').datepicker();\r\n//$(window).on(\'resize\',equalGrids);\r\n		'),(10,1,'header','<header>    \r\n    <div class=\"header-top {flash_class}\">{flash_message}</div>\r\n    <div class=\"header-menu bg-white\">\r\n            <nav class=\"navbar navbar-default\">\r\n                    <div class=\"container\">\r\n                            <div class=\"navbar-header\">\r\n                                    <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">\r\n                                            <i class=\"fa fa-align-justify black\"></i>\r\n                                    </button>\r\n                                    <a class=\"navbar-brand logo\" href=\"{site_url}\"><img src=\"{theme_url}images/logo2.png\" class=\"img-responsive logo\"></a>\r\n                            </div>\r\n                            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\r\n                                    <ul class=\"nav navbar-nav pull-right\">\r\n                                            <li><a href=\"{site_url}products\">Shop All</a></li>\r\n                                            <li><a href=\"{site_url}about\">About</a></li>\r\n                                            <li><a href=\"{site_url}cart\">Cart(0)</a></li>\r\n                                    </ul>\r\n<!--                                    <div >\r\n                                        {if logged_in}\r\n                                          <a href=\"{path=\'member/profile\'}\">Edit your profile</a><br>\r\n                                          <a href=\"{path=\'member/memberlist\'}\">View the Memberlist</a><br>\r\n                                          <a href=\"{path=\'logout\'}\">Log Out</a>\r\n                                        {/if}\r\n                                        {if logged_out}\r\n                                          Are you a member? Please <a href=\"{path=\'member/login\'}\">log-in</a>.<br>\r\n                                          Not a member? <a href=\"{path=\'member/register\'}\">Register</a>.<br>\r\n                                          Have you <a href=\"{path=\'member/forgot\'}\">forgotten your password</a>?\r\n                                        {/if}\r\n                                    </div> -->\r\n                            </div>\r\n                    </div>\r\n            </nav>\r\n    </div>\r\n</header>'),(11,1,'html_close','</body>\n</html>'),(12,1,'html_head','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n'),(13,1,'html_head_end','</head>\n'),(14,1,'js','<!--[if IE]>\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\n<![endif]-->\n<script type=\"text/javascript\" src=\"{theme_url}js/vendor/jquery-1.11.3.min.js\"></script>\n<script type=\"text/javascript\" src=\"{theme_url}js/vendor/jquery-ui.min.js\"></script>\n<script type=\"text/javascript\" src=\"{theme_url}js/bootstrap.min.js\"></script>\n\n<script>\n\n$(document).ready(function(e){\n    $(\'#sh-foot\').click(function(e){\n			$(\'.footer-toggle\').slideToggle();\n			if($(this).hasClass(\'up\')){\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\n			}else{\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\n			}\n			 $(\'html, body\').animate({\n                                    scrollTop: $(document).height()\n                            }, 2000);\n			e.preventDefault();\n        });\n        setTimeout(\'$(\".header-top\").hide(\"fadeUp\")\',5000);\n});\n</script>'),(15,1,'meta','<meta name=\"viewport\" content=\"width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=no\" />\r\n'),(16,1,'nav_access','<ul id=\"nav_access\">\n	<li><a href=\"#navigation\">Skip to navigation</a></li>\n	<li><a href=\"#primary_content_wrapper\">Skip to content</a></li>\n</ul>'),(17,1,'rss','<!-- RSS -->\n<link href=\"{path=news/rss}\" rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS Feed\" />'),(18,1,'rss_links','<h5>RSS Feeds <img src=\"{site_url}themes/site_themes/material/images/rss12.gif\" alt=\"RSS Icon\" class=\"rssicon\" /></h5>\n		<div id=\"news_rss\">\n			<p>Subscribe to our RSS Feeds</p>\n			<ul>\n				<li><a href=\"{path=\'news/rss\'}\">News RSS Feed</a></li>\n				<li><a href=\"{path=\'news/atom\'}\">News ATOM Feed</a></li>\n			</ul>\n		</div>'),(19,1,'shop_filter','<section>\r\n    <div class=\"shop-filter\">\r\n        <div class=\"dropdown\">\r\n            <button class=\"btn btn-nostyle dropdown-toggle\" type=\"button\" id=\"dropdownMenu1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">\r\n            Everything\r\n            <span class=\"caret\"></span>\r\n            </button>\r\n            <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu1\">\r\n                <li><a href=\"#\">Everything</a></li>\r\n                <li><a href=\"#\">Prints</a></li>\r\n                <li><a href=\"#\">Photobook</a></li>\r\n                <li><a href=\"#\">Framed Prints</a></li>\r\n                <li><a href=\"#\">Accesories</a></li>\r\n            </ul>\r\n        </div>\r\n    </div>\r\n</section>'),(20,1,'uploadjs','\r\n<script src=\"{site_url}themes/site_themes/default_site/js/upload/xtpl.min.js\"></script>\r\n<script src=\"{site_url}themes/site_themes/default_site/js/upload/FileAPI.min.js\"></script>\r\n<script src=\"{site_url}themes/site_themes/default_site/js/upload/FileAPI.html5.min.js\"></script>\r\n<script src=\"{site_url}themes/site_themes/default_site/js/upload/jquery.fileapi.min.js\"></script>\r\n\r\n<script src=\"{site_url}themes/site_themes/default_site/js/upload/upload.js\"></script>\r\n\r\n'),(21,1,'upload_js','<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->\r\n<script src=\"{theme_url}js/vendor/jquery.ui.widget.js\"></script>\r\n<script src=\"{theme_url}js/upload/tmpl.min.js\"></script>\r\n\r\n\r\n<script src=\"{theme_url}js/upload/load-image.js\"></script>\r\n<script src=\"{theme_url}js/upload/load-image-ios.js\"></script>\r\n<script src=\"{theme_url}js/upload/load-image-orientation.js\"></script>\r\n<script src=\"{theme_url}js/upload/load-image-meta.js\"></script>\r\n<script src=\"{theme_url}js/upload/load-image-exif.js\"></script>\r\n<script src=\"{theme_url}js/upload/load-image-exif-map.js\"></script>\r\n\r\n\r\n<script src=\"{theme_url}js/upload/load-image.all.min.js\"></script>\r\n<!-- The Canvas to Blob plugin is included for image resizing functionality -->\r\n<script src=\"{theme_url}js/upload/canvas-to-blob.min.js\"></script>\r\n\r\n<script src=\"{theme_url}js/upload/jquery.blueimp-gallery.min.js\"></script>\r\n<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->\r\n<script src=\"{theme_url}js/upload/jquery.iframe-transport.js\"></script>\r\n<!-- The basic File Upload plugin -->\r\n<script src=\"{theme_url}js/upload/jquery.fileupload.js\"></script>\r\n<!-- The File Upload processing plugin -->\r\n<script src=\"{theme_url}js/upload/jquery.fileupload-process.js\"></script>\r\n<!-- The File Upload image preview & resize plugin -->\r\n<script src=\"{theme_url}js/upload/jquery.fileupload-image.js\"></script>\r\n\r\n<!-- The File Upload validation plugin -->\r\n<script src=\"{theme_url}js/upload/jquery.fileupload-validate.js\"></script>\r\n<!-- The File Upload user interface plugin -->\r\n<script src=\"{theme_url}js/upload/jquery.fileupload-ui.js\"></script>\r\n\r\n\r\n<script src=\"{theme_url}js/upload/jquery.appear.js\"></script>\r\n<!--<script src=\"{theme_url}js/upload/jquery.templateLoader.min.js\"></script>-->\r\n\r\n<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->\r\n<!--[if (gte IE 8)&(lt IE 10)]>\r\n<script src=\"{theme_url}js/cors/jquery.xdr-transport.js\"></script>\r\n<![endif]-->\r\n\r\n\r\n\r\n<!-- The main application script -->\r\n<script src=\"{theme_url}js/upload/croppic.js\"></script>\r\n<script src=\"{theme_url}js/upload/cropper.min.js\"></script>\r\n<script src=\"{theme_url}js/upload/picedit.js\"></script>\r\n\r\n'),(22,1,'wrapper_begin','<div id=\"page\">\n<div id=\"content_wrapper\">'),(23,1,'wrapper_close','</div> <!-- ending #content_wrapper -->\n</div> <!-- ending #page -->'),(24,1,'theme','/themes/site_themes/brilliant_retail'),(25,1,'theme','/themes/site_themes/brilliant_retail'),(26,1,'theme','/themes/site_themes/brilliant_retail'),(27,1,'theme','/themes/site_themes/brilliant_retail'),(28,1,'theme','/themes/site_themes/brilliant_retail'),(29,1,'theme','/themes/site_themes/brilliant_retail'),(30,1,'theme','/themes/site_themes/brilliant_retail'),(31,1,'theme','/themes/site_themes/brilliant_retail'),(32,1,'theme','/themes/site_themes/brilliant_retail'),(33,1,'theme','/themes/site_themes/brilliant_retail'),(34,1,'theme','/themes/site_themes/brilliant_retail'),(35,1,'theme','/themes/site_themes/brilliant_retail'),(36,1,'theme','/themes/site_themes/brilliant_retail'),(37,1,'theme','/themes/site_themes/brilliant_retail'),(38,1,'tour','<div class=\"tour\">\n<p style=\"display: none;\">Adorama has been and continue to be the leading photo finisher in Indonesia over 24 years. \n<br>Adorama always use the best equipment, paper and chemicals to produce their award winning products.\n<br> Adorama don\'t just print photos, we print memories. \n</p>\n<a href=\"#\" class=\"btn btn-circle invert\">Tour</a>\n</div>'),(39,1,'instagram_button','<a href=\"//instagram.com/adorama\" class=\"\"><i class=\"fa fa-instagram fa-cos\"></i></a>'),(40,1,'facebook_button','<a href=\"//fb.me/adorama\" class=\"\"><i class=\"fa fa-facebook fa-cos\"></i></a>'),(41,1,'twitter_button','<a href=\"//twitter.com/adorama\" class=\"\"><i class=\"fa fa-twitter fa-cos\"></i></a>');
/*!40000 ALTER TABLE `exp_global_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_grid_columns`
--

DROP TABLE IF EXISTS `exp_grid_columns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_grid_columns` (
  `col_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_id` int(10) unsigned DEFAULT NULL,
  `content_type` varchar(50) DEFAULT NULL,
  `col_order` int(3) unsigned DEFAULT NULL,
  `col_type` varchar(50) DEFAULT NULL,
  `col_label` varchar(50) DEFAULT NULL,
  `col_name` varchar(32) DEFAULT NULL,
  `col_instructions` text,
  `col_required` char(1) DEFAULT NULL,
  `col_search` char(1) DEFAULT NULL,
  `col_width` int(3) unsigned DEFAULT NULL,
  `col_settings` text,
  PRIMARY KEY (`col_id`),
  KEY `field_id` (`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_grid_columns`
--

LOCK TABLES `exp_grid_columns` WRITE;
/*!40000 ALTER TABLE `exp_grid_columns` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_grid_columns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_html_buttons`
--

DROP TABLE IF EXISTS `exp_html_buttons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_html_buttons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `member_id` int(10) NOT NULL DEFAULT '0',
  `tag_name` varchar(32) NOT NULL,
  `tag_open` varchar(120) NOT NULL,
  `tag_close` varchar(120) NOT NULL,
  `accesskey` varchar(32) NOT NULL,
  `tag_order` int(3) unsigned NOT NULL,
  `tag_row` char(1) NOT NULL DEFAULT '1',
  `classname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_html_buttons`
--

LOCK TABLES `exp_html_buttons` WRITE;
/*!40000 ALTER TABLE `exp_html_buttons` DISABLE KEYS */;
INSERT INTO `exp_html_buttons` VALUES (1,1,0,'b','<strong>','</strong>','b',1,'1','btn_b'),(2,1,0,'i','<em>','</em>','i',2,'1','btn_i'),(3,1,0,'blockquote','<blockquote>','</blockquote>','q',3,'1','btn_blockquote'),(4,1,0,'a','<a href=\"[![Link:!:http://]!]\"(!( title=\"[![Title]!]\")!)>','</a>','a',4,'1','btn_a'),(5,1,0,'img','<img src=\"[![Link:!:http://]!]\" alt=\"[![Alternative text]!]\" />','','',5,'1','btn_img');
/*!40000 ALTER TABLE `exp_html_buttons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_ig_picpuller_lite_credentials`
--

DROP TABLE IF EXISTS `exp_ig_picpuller_lite_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_ig_picpuller_lite_credentials` (
  `app_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ig_site_id` int(11) DEFAULT NULL,
  `ig_client_id` varchar(64) DEFAULT '',
  `ig_client_secret` varchar(64) DEFAULT '',
  `ig_picpuller_lite_prefix` varchar(128) DEFAULT '',
  `auth_url` varchar(256) DEFAULT '',
  `frontend_auth_url` varchar(256) DEFAULT '',
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_ig_picpuller_lite_credentials`
--

LOCK TABLES `exp_ig_picpuller_lite_credentials` WRITE;
/*!40000 ALTER TABLE `exp_ig_picpuller_lite_credentials` DISABLE KEYS */;
INSERT INTO `exp_ig_picpuller_lite_credentials` VALUES (1,1,'61ab4c38876f4eee88da5f2fec64bae5','3b74dd0ed7e3481f92842ee7245fe819','ig_','http://adorama/index.php?ACT=84','');
/*!40000 ALTER TABLE `exp_ig_picpuller_lite_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_ig_picpuller_lite_oauths`
--

DROP TABLE IF EXISTS `exp_ig_picpuller_lite_oauths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_ig_picpuller_lite_oauths` (
  `member_id` varchar(64) DEFAULT '',
  `instagram_id` varchar(64) DEFAULT '',
  `oauth` varchar(255) DEFAULT '',
  `app_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_ig_picpuller_lite_oauths`
--

LOCK TABLES `exp_ig_picpuller_lite_oauths` WRITE;
/*!40000 ALTER TABLE `exp_ig_picpuller_lite_oauths` DISABLE KEYS */;
INSERT INTO `exp_ig_picpuller_lite_oauths` VALUES ('1','441532538','441532538.61ab4c3.1660a3f0986b483b9ec0dcd495f4573d',1);
/*!40000 ALTER TABLE `exp_ig_picpuller_lite_oauths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_layout_publish`
--

DROP TABLE IF EXISTS `exp_layout_publish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_layout_publish` (
  `layout_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `member_group` int(4) unsigned NOT NULL DEFAULT '0',
  `channel_id` int(4) unsigned NOT NULL DEFAULT '0',
  `field_layout` text,
  PRIMARY KEY (`layout_id`),
  KEY `site_id` (`site_id`),
  KEY `member_group` (`member_group`),
  KEY `channel_id` (`channel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_layout_publish`
--

LOCK TABLES `exp_layout_publish` WRITE;
/*!40000 ALTER TABLE `exp_layout_publish` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_layout_publish` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_mailing_list`
--

DROP TABLE IF EXISTS `exp_mailing_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_mailing_list` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_id` int(7) unsigned NOT NULL,
  `authcode` varchar(10) NOT NULL,
  `email` varchar(75) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `list_id` (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_mailing_list`
--

LOCK TABLES `exp_mailing_list` WRITE;
/*!40000 ALTER TABLE `exp_mailing_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_mailing_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_mailing_list_queue`
--

DROP TABLE IF EXISTS `exp_mailing_list_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_mailing_list_queue` (
  `queue_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(75) NOT NULL,
  `list_id` int(7) unsigned NOT NULL DEFAULT '0',
  `authcode` varchar(10) NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`queue_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_mailing_list_queue`
--

LOCK TABLES `exp_mailing_list_queue` WRITE;
/*!40000 ALTER TABLE `exp_mailing_list_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_mailing_list_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_mailing_lists`
--

DROP TABLE IF EXISTS `exp_mailing_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_mailing_lists` (
  `list_id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `list_name` varchar(40) NOT NULL,
  `list_title` varchar(100) NOT NULL,
  `list_template` text NOT NULL,
  PRIMARY KEY (`list_id`),
  KEY `list_name` (`list_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_mailing_lists`
--

LOCK TABLES `exp_mailing_lists` WRITE;
/*!40000 ALTER TABLE `exp_mailing_lists` DISABLE KEYS */;
INSERT INTO `exp_mailing_lists` VALUES (1,'default','Default Mailing List','{message_text}\n\nTo remove your email from this mailing list, click here:\n{if html_email}<a href=\\\"{unsubscribe_url}\\\">{unsubscribe_url}</a>{/if}\n{if plain_email}{unsubscribe_url}{/if}');
/*!40000 ALTER TABLE `exp_mailing_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_member_bulletin_board`
--

DROP TABLE IF EXISTS `exp_member_bulletin_board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_member_bulletin_board` (
  `bulletin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) unsigned NOT NULL,
  `bulletin_group` int(8) unsigned NOT NULL,
  `bulletin_date` int(10) unsigned NOT NULL,
  `hash` varchar(10) NOT NULL DEFAULT '',
  `bulletin_expires` int(10) unsigned NOT NULL DEFAULT '0',
  `bulletin_message` text NOT NULL,
  PRIMARY KEY (`bulletin_id`),
  KEY `sender_id` (`sender_id`),
  KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_member_bulletin_board`
--

LOCK TABLES `exp_member_bulletin_board` WRITE;
/*!40000 ALTER TABLE `exp_member_bulletin_board` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_member_bulletin_board` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_member_data`
--

DROP TABLE IF EXISTS `exp_member_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_member_data` (
  `member_id` int(10) unsigned NOT NULL,
  `m_field_id_1` varchar(100) DEFAULT NULL,
  `m_field_id_2` varchar(100) DEFAULT NULL,
  `m_field_id_3` varchar(100) DEFAULT NULL,
  `m_field_id_4` varchar(100) DEFAULT NULL,
  `m_field_id_5` varchar(100) DEFAULT NULL,
  `m_field_id_6` varchar(100) DEFAULT NULL,
  `m_field_id_7` varchar(100) DEFAULT NULL,
  `m_field_id_8` varchar(100) DEFAULT NULL,
  `m_field_id_9` varchar(100) DEFAULT NULL,
  `m_field_id_10` varchar(100) DEFAULT NULL,
  `m_field_id_11` varchar(100) DEFAULT NULL,
  `m_field_id_12` varchar(100) DEFAULT NULL,
  `m_field_id_13` varchar(100) DEFAULT NULL,
  `m_field_id_14` varchar(100) DEFAULT NULL,
  `m_field_id_15` varchar(100) DEFAULT NULL,
  `m_field_id_16` varchar(100) DEFAULT NULL,
  `m_field_id_17` varchar(100) DEFAULT NULL,
  `m_field_id_18` varchar(100) DEFAULT NULL,
  `m_field_id_19` varchar(100) DEFAULT NULL,
  `m_field_id_20` varchar(100) DEFAULT NULL,
  `m_field_id_21` varchar(100) DEFAULT NULL,
  `m_field_id_22` varchar(100) DEFAULT NULL,
  `m_field_id_23` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_member_data`
--

LOCK TABLES `exp_member_data` WRITE;
/*!40000 ALTER TABLE `exp_member_data` DISABLE KEYS */;
INSERT INTO `exp_member_data` VALUES (1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Novan','Firmansyah','+6281258738738','Firmansyah','Novan','','Jl Anggrek 8 No 10H, Karet Kuningan','','Jakarta Selatan','','12940','+6281258738738','ID','Novan','Firmansyah','','Jl Anggrek 8 No 10H, Karet Kuningan','','Jakarta Selatan','','12940','+6281258738738','ID');
/*!40000 ALTER TABLE `exp_member_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_member_fields`
--

DROP TABLE IF EXISTS `exp_member_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_member_fields` (
  `m_field_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `m_field_name` varchar(32) NOT NULL,
  `m_field_label` varchar(50) NOT NULL,
  `m_field_description` text NOT NULL,
  `m_field_type` varchar(12) NOT NULL DEFAULT 'text',
  `m_field_list_items` text NOT NULL,
  `m_field_ta_rows` tinyint(2) DEFAULT '8',
  `m_field_maxl` smallint(3) NOT NULL,
  `m_field_width` varchar(6) NOT NULL,
  `m_field_search` char(1) NOT NULL DEFAULT 'y',
  `m_field_required` char(1) NOT NULL DEFAULT 'n',
  `m_field_public` char(1) NOT NULL DEFAULT 'y',
  `m_field_reg` char(1) NOT NULL DEFAULT 'n',
  `m_field_cp_reg` char(1) NOT NULL DEFAULT 'n',
  `m_field_fmt` char(5) NOT NULL DEFAULT 'none',
  `m_field_order` int(3) unsigned NOT NULL,
  PRIMARY KEY (`m_field_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_member_fields`
--

LOCK TABLES `exp_member_fields` WRITE;
/*!40000 ALTER TABLE `exp_member_fields` DISABLE KEYS */;
INSERT INTO `exp_member_fields` VALUES (1,'br_fname','First Name','','text','',10,100,'100%','n','n','n','y','n','none',1),(2,'br_lname','Last Name','','text','',10,100,'100%','n','n','n','y','n','none',2),(3,'br_phone','Phone Number','','text','',10,100,'100%','n','n','n','y','n','none',3),(4,'br_billing_lname','Billing Last Name','','text','',10,100,'100%','n','n','n','y','n','none',100),(5,'br_billing_fname','Billing First Name','','text','',10,100,'100%','n','n','n','y','n','none',101),(6,'br_billing_company','Billing Company','','text','',10,100,'100%','n','n','n','y','n','none',102),(7,'br_billing_address1','Billing Address 1','','text','',10,100,'100%','n','n','n','y','n','none',103),(8,'br_billing_address2','Billing Address 2','','text','',10,100,'100%','n','n','n','y','n','none',104),(9,'br_billing_city','Billing City','','text','',10,100,'100%','n','n','n','y','n','none',105),(10,'br_billing_state','Billing State','','text','',10,100,'100%','n','n','n','y','n','none',106),(11,'br_billing_zip','Billing Zip','','text','',10,100,'100%','n','n','n','y','n','none',107),(12,'br_billing_phone','Billing Phone','','text','',10,100,'100%','n','n','n','y','n','none',108),(13,'br_billing_country','Billing Country','','text','',10,100,'100%','n','n','n','y','n','none',109),(14,'br_shipping_fname','Shipping First Name','','text','',10,100,'100%','n','n','n','y','n','none',200),(15,'br_shipping_lname','Shipping Last Name','','text','',10,100,'100%','n','n','n','y','n','none',201),(16,'br_shipping_company','Shipping Company','','text','',10,100,'100%','n','n','n','y','n','none',202),(17,'br_shipping_address1','Shipping Address 1','','text','',10,100,'100%','n','n','n','y','n','none',203),(18,'br_shipping_address2','Shipping Address 2','','text','',10,100,'100%','n','n','n','y','n','none',204),(19,'br_shipping_city','Shipping City','','text','',10,100,'100%','n','n','n','y','n','none',205),(20,'br_shipping_state','Shipping Address State','','text','',10,100,'100%','n','n','n','y','n','none',206),(21,'br_shipping_zip','Shipping Address Zip','','text','',10,100,'100%','n','n','n','y','n','none',207),(22,'br_shipping_phone','Shipping Phone','','text','',10,100,'100%','n','n','n','y','n','none',208),(23,'br_shipping_country','Shipping Country','','text','',10,100,'100%','n','n','n','y','n','none',209);
/*!40000 ALTER TABLE `exp_member_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_member_groups`
--

DROP TABLE IF EXISTS `exp_member_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_member_groups` (
  `group_id` smallint(4) unsigned NOT NULL,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_title` varchar(100) NOT NULL,
  `group_description` text NOT NULL,
  `is_locked` char(1) NOT NULL DEFAULT 'y',
  `can_view_offline_system` char(1) NOT NULL DEFAULT 'n',
  `can_view_online_system` char(1) NOT NULL DEFAULT 'y',
  `can_access_cp` char(1) NOT NULL DEFAULT 'y',
  `can_access_content` char(1) NOT NULL DEFAULT 'n',
  `can_access_publish` char(1) NOT NULL DEFAULT 'n',
  `can_access_edit` char(1) NOT NULL DEFAULT 'n',
  `can_access_files` char(1) NOT NULL DEFAULT 'n',
  `can_access_fieldtypes` char(1) NOT NULL DEFAULT 'n',
  `can_access_design` char(1) NOT NULL DEFAULT 'n',
  `can_access_addons` char(1) NOT NULL DEFAULT 'n',
  `can_access_modules` char(1) NOT NULL DEFAULT 'n',
  `can_access_extensions` char(1) NOT NULL DEFAULT 'n',
  `can_access_accessories` char(1) NOT NULL DEFAULT 'n',
  `can_access_plugins` char(1) NOT NULL DEFAULT 'n',
  `can_access_members` char(1) NOT NULL DEFAULT 'n',
  `can_access_admin` char(1) NOT NULL DEFAULT 'n',
  `can_access_sys_prefs` char(1) NOT NULL DEFAULT 'n',
  `can_access_content_prefs` char(1) NOT NULL DEFAULT 'n',
  `can_access_tools` char(1) NOT NULL DEFAULT 'n',
  `can_access_comm` char(1) NOT NULL DEFAULT 'n',
  `can_access_utilities` char(1) NOT NULL DEFAULT 'n',
  `can_access_data` char(1) NOT NULL DEFAULT 'n',
  `can_access_logs` char(1) NOT NULL DEFAULT 'n',
  `can_admin_channels` char(1) NOT NULL DEFAULT 'n',
  `can_admin_upload_prefs` char(1) NOT NULL DEFAULT 'n',
  `can_admin_design` char(1) NOT NULL DEFAULT 'n',
  `can_admin_members` char(1) NOT NULL DEFAULT 'n',
  `can_delete_members` char(1) NOT NULL DEFAULT 'n',
  `can_admin_mbr_groups` char(1) NOT NULL DEFAULT 'n',
  `can_admin_mbr_templates` char(1) NOT NULL DEFAULT 'n',
  `can_ban_users` char(1) NOT NULL DEFAULT 'n',
  `can_admin_modules` char(1) NOT NULL DEFAULT 'n',
  `can_admin_templates` char(1) NOT NULL DEFAULT 'n',
  `can_edit_categories` char(1) NOT NULL DEFAULT 'n',
  `can_delete_categories` char(1) NOT NULL DEFAULT 'n',
  `can_view_other_entries` char(1) NOT NULL DEFAULT 'n',
  `can_edit_other_entries` char(1) NOT NULL DEFAULT 'n',
  `can_assign_post_authors` char(1) NOT NULL DEFAULT 'n',
  `can_delete_self_entries` char(1) NOT NULL DEFAULT 'n',
  `can_delete_all_entries` char(1) NOT NULL DEFAULT 'n',
  `can_view_other_comments` char(1) NOT NULL DEFAULT 'n',
  `can_edit_own_comments` char(1) NOT NULL DEFAULT 'n',
  `can_delete_own_comments` char(1) NOT NULL DEFAULT 'n',
  `can_edit_all_comments` char(1) NOT NULL DEFAULT 'n',
  `can_delete_all_comments` char(1) NOT NULL DEFAULT 'n',
  `can_moderate_comments` char(1) NOT NULL DEFAULT 'n',
  `can_send_email` char(1) NOT NULL DEFAULT 'n',
  `can_send_cached_email` char(1) NOT NULL DEFAULT 'n',
  `can_email_member_groups` char(1) NOT NULL DEFAULT 'n',
  `can_email_mailinglist` char(1) NOT NULL DEFAULT 'n',
  `can_email_from_profile` char(1) NOT NULL DEFAULT 'n',
  `can_view_profiles` char(1) NOT NULL DEFAULT 'n',
  `can_edit_html_buttons` char(1) NOT NULL DEFAULT 'n',
  `can_delete_self` char(1) NOT NULL DEFAULT 'n',
  `mbr_delete_notify_emails` varchar(255) DEFAULT NULL,
  `can_post_comments` char(1) NOT NULL DEFAULT 'n',
  `exclude_from_moderation` char(1) NOT NULL DEFAULT 'n',
  `can_search` char(1) NOT NULL DEFAULT 'n',
  `search_flood_control` mediumint(5) unsigned NOT NULL,
  `can_send_private_messages` char(1) NOT NULL DEFAULT 'n',
  `prv_msg_send_limit` smallint(5) unsigned NOT NULL DEFAULT '20',
  `prv_msg_storage_limit` smallint(5) unsigned NOT NULL DEFAULT '60',
  `can_attach_in_private_messages` char(1) NOT NULL DEFAULT 'n',
  `can_send_bulletins` char(1) NOT NULL DEFAULT 'n',
  `include_in_authorlist` char(1) NOT NULL DEFAULT 'n',
  `include_in_memberlist` char(1) NOT NULL DEFAULT 'y',
  `include_in_mailinglists` char(1) NOT NULL DEFAULT 'y',
  PRIMARY KEY (`group_id`,`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_member_groups`
--

LOCK TABLES `exp_member_groups` WRITE;
/*!40000 ALTER TABLE `exp_member_groups` DISABLE KEYS */;
INSERT INTO `exp_member_groups` VALUES (1,1,'Super Admins','','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','y','','y','y','y',0,'y',20,60,'y','y','y','y','y'),(2,1,'Banned','','y','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','','n','n','n',60,'n',20,60,'n','n','n','n','n'),(3,1,'Guests','','y','n','y','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','y','n','n','n','n','','y','n','y',15,'n',20,60,'n','n','n','n','n'),(4,1,'Pending','','y','n','y','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','y','n','n','n','n','','y','n','y',15,'n',20,60,'n','n','n','n','n'),(5,1,'Members','','y','n','y','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','y','y','y','n','','y','n','y',10,'y',20,60,'y','n','n','y','y'),(6,1,'Customers','','y','n','y','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','n','y','n','n','n','n','','y','n','y',15,'n',20,60,'n','n','n','n','n');
/*!40000 ALTER TABLE `exp_member_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_member_homepage`
--

DROP TABLE IF EXISTS `exp_member_homepage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_member_homepage` (
  `member_id` int(10) unsigned NOT NULL,
  `recent_entries` char(1) NOT NULL DEFAULT 'l',
  `recent_entries_order` int(3) unsigned NOT NULL DEFAULT '0',
  `recent_comments` char(1) NOT NULL DEFAULT 'l',
  `recent_comments_order` int(3) unsigned NOT NULL DEFAULT '0',
  `recent_members` char(1) NOT NULL DEFAULT 'n',
  `recent_members_order` int(3) unsigned NOT NULL DEFAULT '0',
  `site_statistics` char(1) NOT NULL DEFAULT 'r',
  `site_statistics_order` int(3) unsigned NOT NULL DEFAULT '0',
  `member_search_form` char(1) NOT NULL DEFAULT 'n',
  `member_search_form_order` int(3) unsigned NOT NULL DEFAULT '0',
  `notepad` char(1) NOT NULL DEFAULT 'r',
  `notepad_order` int(3) unsigned NOT NULL DEFAULT '0',
  `bulletin_board` char(1) NOT NULL DEFAULT 'r',
  `bulletin_board_order` int(3) unsigned NOT NULL DEFAULT '0',
  `pmachine_news_feed` char(1) NOT NULL DEFAULT 'n',
  `pmachine_news_feed_order` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_member_homepage`
--

LOCK TABLES `exp_member_homepage` WRITE;
/*!40000 ALTER TABLE `exp_member_homepage` DISABLE KEYS */;
INSERT INTO `exp_member_homepage` VALUES (1,'l',1,'l',2,'n',0,'r',1,'n',0,'r',2,'r',0,'l',0);
/*!40000 ALTER TABLE `exp_member_homepage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_member_search`
--

DROP TABLE IF EXISTS `exp_member_search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_member_search` (
  `search_id` varchar(32) NOT NULL,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `search_date` int(10) unsigned NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `fields` varchar(200) NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `total_results` int(8) unsigned NOT NULL,
  `query` text NOT NULL,
  PRIMARY KEY (`search_id`),
  KEY `member_id` (`member_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_member_search`
--

LOCK TABLES `exp_member_search` WRITE;
/*!40000 ALTER TABLE `exp_member_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_member_search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_members`
--

DROP TABLE IF EXISTS `exp_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_members` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` smallint(4) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `screen_name` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) NOT NULL DEFAULT '',
  `unique_id` varchar(40) NOT NULL,
  `crypt_key` varchar(40) DEFAULT NULL,
  `authcode` varchar(10) DEFAULT NULL,
  `email` varchar(75) NOT NULL,
  `url` varchar(150) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `occupation` varchar(80) DEFAULT NULL,
  `interests` varchar(120) DEFAULT NULL,
  `bday_d` int(2) DEFAULT NULL,
  `bday_m` int(2) DEFAULT NULL,
  `bday_y` int(4) DEFAULT NULL,
  `aol_im` varchar(50) DEFAULT NULL,
  `yahoo_im` varchar(50) DEFAULT NULL,
  `msn_im` varchar(50) DEFAULT NULL,
  `icq` varchar(50) DEFAULT NULL,
  `bio` text,
  `signature` text,
  `avatar_filename` varchar(120) DEFAULT NULL,
  `avatar_width` int(4) unsigned DEFAULT NULL,
  `avatar_height` int(4) unsigned DEFAULT NULL,
  `photo_filename` varchar(120) DEFAULT NULL,
  `photo_width` int(4) unsigned DEFAULT NULL,
  `photo_height` int(4) unsigned DEFAULT NULL,
  `sig_img_filename` varchar(120) DEFAULT NULL,
  `sig_img_width` int(4) unsigned DEFAULT NULL,
  `sig_img_height` int(4) unsigned DEFAULT NULL,
  `ignore_list` text,
  `private_messages` int(4) unsigned NOT NULL DEFAULT '0',
  `accept_messages` char(1) NOT NULL DEFAULT 'y',
  `last_view_bulletins` int(10) NOT NULL DEFAULT '0',
  `last_bulletin_date` int(10) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `join_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_visit` int(10) unsigned NOT NULL DEFAULT '0',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `total_entries` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `total_comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `total_forum_topics` mediumint(8) NOT NULL DEFAULT '0',
  `total_forum_posts` mediumint(8) NOT NULL DEFAULT '0',
  `last_entry_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_comment_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_forum_post_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_email_date` int(10) unsigned NOT NULL DEFAULT '0',
  `in_authorlist` char(1) NOT NULL DEFAULT 'n',
  `accept_admin_email` char(1) NOT NULL DEFAULT 'y',
  `accept_user_email` char(1) NOT NULL DEFAULT 'y',
  `notify_by_default` char(1) NOT NULL DEFAULT 'y',
  `notify_of_pm` char(1) NOT NULL DEFAULT 'y',
  `display_avatars` char(1) NOT NULL DEFAULT 'y',
  `display_signatures` char(1) NOT NULL DEFAULT 'y',
  `parse_smileys` char(1) NOT NULL DEFAULT 'y',
  `smart_notifications` char(1) NOT NULL DEFAULT 'y',
  `language` varchar(50) NOT NULL,
  `timezone` varchar(50) NOT NULL,
  `time_format` char(2) NOT NULL DEFAULT '12',
  `date_format` varchar(8) NOT NULL DEFAULT '%n/%j/%Y',
  `include_seconds` char(1) NOT NULL DEFAULT 'n',
  `cp_theme` varchar(32) DEFAULT NULL,
  `profile_theme` varchar(32) DEFAULT NULL,
  `forum_theme` varchar(32) DEFAULT NULL,
  `tracker` text,
  `template_size` varchar(2) NOT NULL DEFAULT '28',
  `notepad` text,
  `notepad_size` varchar(2) NOT NULL DEFAULT '18',
  `quick_links` text,
  `quick_tabs` text,
  `show_sidebar` char(1) NOT NULL DEFAULT 'n',
  `pmember_id` int(10) NOT NULL DEFAULT '0',
  `rte_enabled` char(1) NOT NULL DEFAULT 'y',
  `rte_toolset_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`),
  KEY `group_id` (`group_id`),
  KEY `unique_id` (`unique_id`),
  KEY `password` (`password`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_members`
--

LOCK TABLES `exp_members` WRITE;
/*!40000 ALTER TABLE `exp_members` DISABLE KEYS */;
INSERT INTO `exp_members` VALUES (1,1,'admin','Adorama PrintShop Admin','109711773131978e3a2d078f7e0bf2569245b4f3e1039e1ed38dc52790330c5c652c23976ad5a79e5ceddc2cbc533c03dd890ff082aca46a7415b0ef6cf975ca','?j]qLtp3@\\T)zkVG@K/4kYm#,5MDgZd]smd<}Xp94\\#q[%\\Tf30Gd3pvC8?xWXeXYpp%\\fyi:%y_}+$V9\"j{yPR%fl5<q$/nGh|.-c{,r}(J[l^PjuY.k=./=9A\'\\h7y','8bc9d9dcbc8aaa54ba135f3b37b7a75ec7f06aa6','03b80b4592d573251e9d2530b459bd290f05cb07',NULL,'hello@vardion.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'y',0,0,'127.0.0.1',1444238133,1448361619,1448430373,4,0,0,0,1444584905,0,0,0,'n','y','y','y','y','y','y','y','y','english','Asia/Jakarta','12','%n/%j/%Y','n',NULL,NULL,NULL,NULL,'28',NULL,'18','',NULL,'n',0,'y',0),(2,5,'novanxyz@gmail.com','Novan Firmansyah','559dacba83df9b20e9a743772b8e85719208fe63','','df5528d39fcbc70092f92bd379774455aacea84a',NULL,NULL,'novanxyz@gmail.com','','ID',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'y',0,0,'127.0.0.1',1445294046,0,0,0,0,0,0,0,0,0,0,'n','y','y','y','y','y','y','y','y','english','Asia/Jakarta','12','%n/%j/%Y','n',NULL,NULL,NULL,NULL,'28',NULL,'18',NULL,NULL,'n',0,'y',0);
/*!40000 ALTER TABLE `exp_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_message_attachments`
--

DROP TABLE IF EXISTS `exp_message_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_message_attachments` (
  `attachment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) unsigned NOT NULL DEFAULT '0',
  `message_id` int(10) unsigned NOT NULL DEFAULT '0',
  `attachment_name` varchar(50) NOT NULL DEFAULT '',
  `attachment_hash` varchar(40) NOT NULL DEFAULT '',
  `attachment_extension` varchar(20) NOT NULL DEFAULT '',
  `attachment_location` varchar(150) NOT NULL DEFAULT '',
  `attachment_date` int(10) unsigned NOT NULL DEFAULT '0',
  `attachment_size` int(10) unsigned NOT NULL DEFAULT '0',
  `is_temp` char(1) NOT NULL DEFAULT 'y',
  PRIMARY KEY (`attachment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_message_attachments`
--

LOCK TABLES `exp_message_attachments` WRITE;
/*!40000 ALTER TABLE `exp_message_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_message_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_message_copies`
--

DROP TABLE IF EXISTS `exp_message_copies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_message_copies` (
  `copy_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sender_id` int(10) unsigned NOT NULL DEFAULT '0',
  `recipient_id` int(10) unsigned NOT NULL DEFAULT '0',
  `message_received` char(1) NOT NULL DEFAULT 'n',
  `message_read` char(1) NOT NULL DEFAULT 'n',
  `message_time_read` int(10) unsigned NOT NULL DEFAULT '0',
  `attachment_downloaded` char(1) NOT NULL DEFAULT 'n',
  `message_folder` int(10) unsigned NOT NULL DEFAULT '1',
  `message_authcode` varchar(10) NOT NULL DEFAULT '',
  `message_deleted` char(1) NOT NULL DEFAULT 'n',
  `message_status` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`copy_id`),
  KEY `message_id` (`message_id`),
  KEY `recipient_id` (`recipient_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_message_copies`
--

LOCK TABLES `exp_message_copies` WRITE;
/*!40000 ALTER TABLE `exp_message_copies` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_message_copies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_message_data`
--

DROP TABLE IF EXISTS `exp_message_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_message_data` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) unsigned NOT NULL DEFAULT '0',
  `message_date` int(10) unsigned NOT NULL DEFAULT '0',
  `message_subject` varchar(255) NOT NULL DEFAULT '',
  `message_body` text NOT NULL,
  `message_tracking` char(1) NOT NULL DEFAULT 'y',
  `message_attachments` char(1) NOT NULL DEFAULT 'n',
  `message_recipients` varchar(200) NOT NULL DEFAULT '',
  `message_cc` varchar(200) NOT NULL DEFAULT '',
  `message_hide_cc` char(1) NOT NULL DEFAULT 'n',
  `message_sent_copy` char(1) NOT NULL DEFAULT 'n',
  `total_recipients` int(5) unsigned NOT NULL DEFAULT '0',
  `message_status` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`message_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_message_data`
--

LOCK TABLES `exp_message_data` WRITE;
/*!40000 ALTER TABLE `exp_message_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_message_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_message_folders`
--

DROP TABLE IF EXISTS `exp_message_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_message_folders` (
  `member_id` int(10) unsigned NOT NULL DEFAULT '0',
  `folder1_name` varchar(50) NOT NULL DEFAULT 'InBox',
  `folder2_name` varchar(50) NOT NULL DEFAULT 'Sent',
  `folder3_name` varchar(50) NOT NULL DEFAULT '',
  `folder4_name` varchar(50) NOT NULL DEFAULT '',
  `folder5_name` varchar(50) NOT NULL DEFAULT '',
  `folder6_name` varchar(50) NOT NULL DEFAULT '',
  `folder7_name` varchar(50) NOT NULL DEFAULT '',
  `folder8_name` varchar(50) NOT NULL DEFAULT '',
  `folder9_name` varchar(50) NOT NULL DEFAULT '',
  `folder10_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_message_folders`
--

LOCK TABLES `exp_message_folders` WRITE;
/*!40000 ALTER TABLE `exp_message_folders` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_message_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_message_listed`
--

DROP TABLE IF EXISTS `exp_message_listed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_message_listed` (
  `listed_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL DEFAULT '0',
  `listed_member` int(10) unsigned NOT NULL DEFAULT '0',
  `listed_description` varchar(100) NOT NULL DEFAULT '',
  `listed_type` varchar(10) NOT NULL DEFAULT 'blocked',
  PRIMARY KEY (`listed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_message_listed`
--

LOCK TABLES `exp_message_listed` WRITE;
/*!40000 ALTER TABLE `exp_message_listed` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_message_listed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_module_member_groups`
--

DROP TABLE IF EXISTS `exp_module_member_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_module_member_groups` (
  `group_id` smallint(4) unsigned NOT NULL,
  `module_id` mediumint(5) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_module_member_groups`
--

LOCK TABLES `exp_module_member_groups` WRITE;
/*!40000 ALTER TABLE `exp_module_member_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_module_member_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_modules`
--

DROP TABLE IF EXISTS `exp_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_modules` (
  `module_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `module_version` varchar(12) NOT NULL,
  `has_cp_backend` char(1) NOT NULL DEFAULT 'n',
  `has_publish_fields` char(1) NOT NULL DEFAULT 'n',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_modules`
--

LOCK TABLES `exp_modules` WRITE;
/*!40000 ALTER TABLE `exp_modules` DISABLE KEYS */;
INSERT INTO `exp_modules` VALUES (1,'Emoticon','2.0','n','n'),(2,'Jquery','1.0','n','n'),(3,'Search','2.2.2','n','n'),(4,'Channel','2.0.1','n','n'),(5,'Member','2.1','n','n'),(6,'Stats','2.0','n','n'),(7,'Rte','1.0.1','y','n'),(8,'Mailinglist','3.2','y','n'),(9,'Email','2.0','n','n'),(10,'Rss','2.0','n','n'),(11,'Comment','2.3.2','y','n'),(12,'Upload','1.0.1','y','n'),(18,'PhotoPrint','1.0.1','y','n'),(15,'Brilliant_retail','1.7.0.0','y','n'),(19,'Ig_picpuller_lite','1.5.5','y','n'),(20,'Query','2.0','n','n'),(21,'Freemember','2.3.2','n','n'),(22,'Pages','2.2','y','y');
/*!40000 ALTER TABLE `exp_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_online_users`
--

DROP TABLE IF EXISTS `exp_online_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_online_users` (
  `online_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `member_id` int(10) NOT NULL DEFAULT '0',
  `in_forum` char(1) NOT NULL DEFAULT 'n',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `date` int(10) unsigned NOT NULL DEFAULT '0',
  `anon` char(1) NOT NULL,
  PRIMARY KEY (`online_id`),
  KEY `date` (`date`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_online_users`
--

LOCK TABLES `exp_online_users` WRITE;
/*!40000 ALTER TABLE `exp_online_users` DISABLE KEYS */;
INSERT INTO `exp_online_users` VALUES (88,1,0,'n','','140.0.115.201',1448430352,''),(87,1,0,'n','','111.94.64.96',1448418998,''),(86,1,0,'n','','139.192.128.177',1448379383,'');
/*!40000 ALTER TABLE `exp_online_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_pages_configuration`
--

DROP TABLE IF EXISTS `exp_pages_configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_pages_configuration` (
  `configuration_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(8) unsigned NOT NULL DEFAULT '1',
  `configuration_name` varchar(60) NOT NULL,
  `configuration_value` varchar(100) NOT NULL,
  PRIMARY KEY (`configuration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_pages_configuration`
--

LOCK TABLES `exp_pages_configuration` WRITE;
/*!40000 ALTER TABLE `exp_pages_configuration` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_pages_configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_password_lockout`
--

DROP TABLE IF EXISTS `exp_password_lockout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_password_lockout` (
  `lockout_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_date` int(10) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`lockout_id`),
  KEY `login_date` (`login_date`),
  KEY `ip_address` (`ip_address`),
  KEY `user_agent` (`user_agent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_password_lockout`
--

LOCK TABLES `exp_password_lockout` WRITE;
/*!40000 ALTER TABLE `exp_password_lockout` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_password_lockout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_photoprints`
--

DROP TABLE IF EXISTS `exp_photoprints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_photoprints` (
  `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `layout_id` varchar(20) NOT NULL,
  `file` varchar(255) NOT NULL,
  `sequence` int(10) unsigned DEFAULT NULL,
  `owner_id` varchar(32) DEFAULT NULL,
  `item_id` varchar(20) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

CREATE INDEX layout_index ON exp_photoprints (layout_id) USING BTREE;
CREATE INDEX item_index ON exp_photoprints (item_id) USING BTREE;

--
-- Dumping data for table `exp_photoprints`
--

LOCK TABLES `exp_photoprints` WRITE;
/*!40000 ALTER TABLE `exp_photoprints` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_photoprints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_printorders`
--

DROP TABLE IF EXISTS `exp_printorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_printorders` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_printorders`
--

LOCK TABLES `exp_printorders` WRITE;
/*!40000 ALTER TABLE `exp_printorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_printorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_relationships`
--

DROP TABLE IF EXISTS `exp_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_relationships` (
  `relationship_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `child_id` int(10) unsigned NOT NULL DEFAULT '0',
  `field_id` int(10) unsigned NOT NULL DEFAULT '0',
  `grid_field_id` int(10) unsigned NOT NULL DEFAULT '0',
  `grid_col_id` int(10) unsigned NOT NULL DEFAULT '0',
  `grid_row_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`relationship_id`),
  KEY `parent_id` (`parent_id`),
  KEY `child_id` (`child_id`),
  KEY `field_id` (`field_id`),
  KEY `grid_row_id` (`grid_row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_relationships`
--

LOCK TABLES `exp_relationships` WRITE;
/*!40000 ALTER TABLE `exp_relationships` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_remember_me`
--

DROP TABLE IF EXISTS `exp_remember_me`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_remember_me` (
  `remember_me_id` varchar(40) NOT NULL DEFAULT '0',
  `member_id` int(10) DEFAULT '0',
  `ip_address` varchar(45) DEFAULT '0',
  `user_agent` varchar(120) DEFAULT '',
  `admin_sess` tinyint(1) DEFAULT '0',
  `site_id` int(4) DEFAULT '1',
  `expiration` int(10) DEFAULT '0',
  `last_refresh` int(10) DEFAULT '0',
  PRIMARY KEY (`remember_me_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_remember_me`
--

LOCK TABLES `exp_remember_me` WRITE;
/*!40000 ALTER TABLE `exp_remember_me` DISABLE KEYS */;
INSERT INTO `exp_remember_me` VALUES ('ee0bb2b0ee4c003ae6e55348734ff2a41b23c3a1',1,'127.0.0.1','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2535.0 Safari/537.36',0,1,1446618895,1445409295);
/*!40000 ALTER TABLE `exp_remember_me` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_reset_password`
--

DROP TABLE IF EXISTS `exp_reset_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_reset_password` (
  `reset_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `resetcode` varchar(12) NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`reset_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_reset_password`
--

LOCK TABLES `exp_reset_password` WRITE;
/*!40000 ALTER TABLE `exp_reset_password` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_reset_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_revision_tracker`
--

DROP TABLE IF EXISTS `exp_revision_tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_revision_tracker` (
  `tracker_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `item_table` varchar(20) NOT NULL,
  `item_field` varchar(20) NOT NULL,
  `item_date` int(10) NOT NULL,
  `item_author_id` int(10) unsigned NOT NULL,
  `item_data` mediumtext NOT NULL,
  PRIMARY KEY (`tracker_id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_revision_tracker`
--

LOCK TABLES `exp_revision_tracker` WRITE;
/*!40000 ALTER TABLE `exp_revision_tracker` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_revision_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_rte_tools`
--

DROP TABLE IF EXISTS `exp_rte_tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_rte_tools` (
  `tool_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `class` varchar(75) DEFAULT NULL,
  `enabled` char(1) DEFAULT 'y',
  PRIMARY KEY (`tool_id`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_rte_tools`
--

LOCK TABLES `exp_rte_tools` WRITE;
/*!40000 ALTER TABLE `exp_rte_tools` DISABLE KEYS */;
INSERT INTO `exp_rte_tools` VALUES (1,'Blockquote','Blockquote_rte','y'),(2,'Bold','Bold_rte','y'),(3,'Headings','Headings_rte','y'),(4,'Image','Image_rte','y'),(5,'Italic','Italic_rte','y'),(6,'Link','Link_rte','y'),(7,'Ordered List','Ordered_list_rte','y'),(8,'Underline','Underline_rte','y'),(9,'Unordered List','Unordered_list_rte','y'),(10,'View Source','View_source_rte','y');
/*!40000 ALTER TABLE `exp_rte_tools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_rte_toolsets`
--

DROP TABLE IF EXISTS `exp_rte_toolsets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_rte_toolsets` (
  `toolset_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `tools` text,
  `enabled` char(1) DEFAULT 'y',
  PRIMARY KEY (`toolset_id`),
  KEY `member_id` (`member_id`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_rte_toolsets`
--

LOCK TABLES `exp_rte_toolsets` WRITE;
/*!40000 ALTER TABLE `exp_rte_toolsets` DISABLE KEYS */;
INSERT INTO `exp_rte_toolsets` VALUES (1,0,'Default','3|2|5|1|9|7|6|4|10','y');
/*!40000 ALTER TABLE `exp_rte_toolsets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_search`
--

DROP TABLE IF EXISTS `exp_search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_search` (
  `search_id` varchar(32) NOT NULL,
  `site_id` int(4) NOT NULL DEFAULT '1',
  `search_date` int(10) NOT NULL,
  `keywords` varchar(60) NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `total_results` int(6) NOT NULL,
  `per_page` tinyint(3) unsigned NOT NULL,
  `query` mediumtext,
  `custom_fields` mediumtext,
  `result_page` varchar(70) NOT NULL,
  PRIMARY KEY (`search_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_search`
--

LOCK TABLES `exp_search` WRITE;
/*!40000 ALTER TABLE `exp_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_search_log`
--

DROP TABLE IF EXISTS `exp_search_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_search_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `member_id` int(10) unsigned NOT NULL,
  `screen_name` varchar(50) NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `search_date` int(10) NOT NULL,
  `search_type` varchar(32) NOT NULL,
  `search_terms` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_search_log`
--

LOCK TABLES `exp_search_log` WRITE;
/*!40000 ALTER TABLE `exp_search_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_search_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_security_hashes`
--

DROP TABLE IF EXISTS `exp_security_hashes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_security_hashes` (
  `hash_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(10) unsigned NOT NULL,
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `hash` varchar(40) NOT NULL,
  PRIMARY KEY (`hash_id`),
  KEY `session_id` (`session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_security_hashes`
--

LOCK TABLES `exp_security_hashes` WRITE;
/*!40000 ALTER TABLE `exp_security_hashes` DISABLE KEYS */;
INSERT INTO `exp_security_hashes` VALUES (45,1445328646,'7de221a4681d81ffe9c0f15ba6e95e72eb016cff','0597c51781bbe0107f7d834c63582ebaab16e69d'),(44,1445319635,'369d3c6db479bfafabffbb4b8d4846675e8a131d','e685e7c32c43193ed5b6c2761c11bc42eeaae27d'),(43,1445308619,'94e32aa947a3607cb8acae0aa36676107adf79da','7c862511d98857516f4b081a580bdab72445c09a'),(42,1445307624,'93ff46d298fb25b96d8a3c59ee308e509ba1444b','898ad4c103f2ba349333aa373b9b309d58e56de5'),(41,1445303965,'9708c0d416ae49e328e75abe6e14aa5238883526','1ba02621a7e8ab7444a5bfadcdc55587ac1c09d8'),(40,1445293323,'92064fa34b724d1462453e70595a41f715f8aa0c','fea2dfb1ea2dc096c5c383b0e417ba51f7f51127'),(39,1445245983,'9b2f3a67d205cc71565d0c5f60b0f657f300d2d3','4e4556758972447a2ee8035e3eeca6e0104fdb0c'),(38,1445236801,'17cf7ec4d631107e61de14f5051cbc50e31d1db5','a6be60e020904072831466bad1b05558556bb8dd'),(37,1445174661,'e8be118115dca8cfe3599e78138ae3641f078ba3','acf4e8ffc552eacd3190b73c24f6654ff5ab3b21'),(36,1445174015,'db468c76db77dbef49d60a8583ee7e73477729c3','39caafcbcf620dd093f0c30f27ab3bc68100455d'),(35,1445168131,'7c011d48d65f42825cd4fad100fdcd5d7cba954f','d8942941acd466ec61b6c872dab95f55ab7709b9'),(34,1445141832,'2701570bccd9c14097176171a1c87f3a85499cb9','8dd1944e2aa6370821d1c853c11105f9c0e0320d'),(33,1445141798,'2714640684c9b474db97b3c01f31896c1d5aae1f','94d6faa5a23811b549063069fd59631aa4ab0bfb'),(32,1445128103,'cfb819797b61a62c52b038a6c29e0b9c5cd4b494','0a2f3a03c4a0ed5bc8e2986d69c179c97e8117a0'),(31,1445115472,'2e533cdd5c3a4e7234ecf851331d0daefc91ad2d','346f1cc134486533c3de478f1133d0820c2e369b'),(30,1445108814,'c2a500d151042103eac461f7ed0ba6bfa6eb6531','32662aa0344e05cb5508808965bce7e53b5f9931'),(17,1445103832,'38908a4f044a74b97c5da1d112423ea1042a1c52','2f4a3dfbf67b46f432203720cafc58acfa8984bf'),(29,1445108805,'38c91da875d78503d6c81c5a0b8e394140e9660b','8c83a6cca5dc29e89afcf766732599f9ee1a94c3'),(27,1445108764,'d5350696ce85cc2ae5608ce3fada1b8a9a713f05','e73a009e60a5f6354b3797bac446402ece8dcd95'),(25,1445108171,'9d984461d643526f3375949eaf3d302773b0518a','ccfd1a652cd2eb99d334361689a8ea095806867b'),(46,1445337165,'394d5fe8c4ddde5de11d9821588b3c4f0a38a9c7','a2d4c50c67cd910c725c5324adb97459a3b71bb9'),(47,1445337168,'c39ce2299e94fc744149200e9855e135292be8c0','f26456d47e926683d3d4c1fcfc62919555b78a00'),(48,1445355127,'463b0d6ee389c9bca7134f8c3f1bac7398cb399c','13f00c46b82813e74fea179c44ffa748c609a8d6'),(49,1445355306,'934db88f5038a2498262fda6e43f7eb3d8a21274','d0eb49364ef5c3223c5b483cd5924e383180dd02'),(50,1445355338,'40ee0631fbe238a977041b590baa3142d8584e8c','e43d96c435cc7769c7619c4ee41a791382ac9fb4'),(52,1445398671,'12e8c63fd4a1f7e565fa2908fdd06c586ef87d87','d2875c165de545ed927a6682d1417c1e9f76b8c1'),(54,1445409235,'c537c6a9f34a4a18b588304021ada5dc6cbfd450','59cdd946fc0a0b3fbec0e0eae2028c276e192265'),(55,1445409297,'b4382b8aa0f572d86d9072bf2bef7879db93addc','03929bd6e23c0e0d55ca196bd483ad10c323a657'),(56,1445409852,'1eb6cf785c5c3d0c7fb6cdc049d7229d88c7c552','5c123b6ccc1c33684fd0b02660e7656490bdd35d'),(57,1445415359,'0dd201ff7d024fcc51ed104ee9aa75628f75ac2b','4a5fe952ac80939c69860a7947280dde9ffd1f35'),(58,1445417011,'de670fcdab10aa52df125762e2f64c8da83d9157','a86fe73cab5af95b01d7960055fced50bb0bf414'),(60,1448357593,'1879f9706a4e71f466aeffa8e877dd731891ff78','8cfba68a83c9febd24985fc5df9d19508321778b'),(62,1448357643,'3afc710ca4629fa80ca456dd569eb6c3bdfa1d4b','9f5aed27bf7fb81c75e35934eda9eb9b67fd773e'),(64,1448361630,'2d542462bfc9144e2c0c51372e599999471b5cd6','075b4d5abe163240fb8372485505fa4c6f2a0c37'),(65,1448430373,'a720aed67db939524daf7d49389d7ec921b7cfa8','83bbc7c9b6a48c8e72efa388e2ee070ad37237bc');
/*!40000 ALTER TABLE `exp_security_hashes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_sessions`
--

DROP TABLE IF EXISTS `exp_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `member_id` int(10) NOT NULL DEFAULT '0',
  `admin_sess` tinyint(1) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `login_state` varchar(32) DEFAULT NULL,
  `fingerprint` varchar(40) NOT NULL,
  `sess_start` int(10) unsigned NOT NULL DEFAULT '0',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `member_id` (`member_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_sessions`
--

LOCK TABLES `exp_sessions` WRITE;
/*!40000 ALTER TABLE `exp_sessions` DISABLE KEYS */;
INSERT INTO `exp_sessions` VALUES ('a720aed67db939524daf7d49389d7ec921b7cfa8',1,1,'140.0.115.201','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36',NULL,'cd71457e22c6979866b8564b5bf8cbbf',1448430373,1448430441);
/*!40000 ALTER TABLE `exp_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_sites`
--

DROP TABLE IF EXISTS `exp_sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_sites` (
  `site_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `site_label` varchar(100) NOT NULL DEFAULT '',
  `site_name` varchar(50) NOT NULL DEFAULT '',
  `site_description` text,
  `site_system_preferences` mediumtext NOT NULL,
  `site_mailinglist_preferences` text NOT NULL,
  `site_member_preferences` text NOT NULL,
  `site_template_preferences` text NOT NULL,
  `site_channel_preferences` text NOT NULL,
  `site_bootstrap_checksums` text NOT NULL,
  `site_pages` text NOT NULL,
  PRIMARY KEY (`site_id`),
  KEY `site_name` (`site_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_sites`
--

LOCK TABLES `exp_sites` WRITE;
/*!40000 ALTER TABLE `exp_sites` DISABLE KEYS */;
INSERT INTO `exp_sites` VALUES (1,'Adorama PrintShop','default_site',NULL,'YTo4ODp7czoxMDoic2l0ZV9pbmRleCI7czowOiIiO3M6ODoic2l0ZV91cmwiO3M6MTg6Imh0dHA6Ly9hZG9yYW1hLmNvbSI7czoxNjoidGhlbWVfZm9sZGVyX3VybCI7czoyNjoiaHR0cDovL2Fkb3JhbWEuY29tL3RoZW1lcy8iO3M6MTU6IndlYm1hc3Rlcl9lbWFpbCI7czoxNzoiaGVsbG9AdmFyZGlvbi5jb20iO3M6MTQ6IndlYm1hc3Rlcl9uYW1lIjtzOjA6IiI7czoyMDoiY2hhbm5lbF9ub21lbmNsYXR1cmUiO3M6NzoiY2hhbm5lbCI7czoxMDoibWF4X2NhY2hlcyI7czozOiIxNTAiO3M6MTE6ImNhcHRjaGFfdXJsIjtzOjMxOiJodHRwOi8vYWRvcmFtYS9pbWFnZXMvY2FwdGNoYXMvIjtzOjEyOiJjYXB0Y2hhX3BhdGgiO3M6NDI6IkQ6XHNydlxuZ2lueFxodG1sXGFkb3JhbWFcaW1hZ2VzXGNhcHRjaGFzXCI7czoxMjoiY2FwdGNoYV9mb250IjtzOjE6InkiO3M6MTI6ImNhcHRjaGFfcmFuZCI7czoxOiJ5IjtzOjIzOiJjYXB0Y2hhX3JlcXVpcmVfbWVtYmVycyI7czoxOiJuIjtzOjE3OiJlbmFibGVfZGJfY2FjaGluZyI7czoxOiJuIjtzOjE4OiJlbmFibGVfc3FsX2NhY2hpbmciO3M6MToibiI7czoxODoiZm9yY2VfcXVlcnlfc3RyaW5nIjtzOjE6Im4iO3M6MTM6InNob3dfcHJvZmlsZXIiO3M6MToibiI7czoxODoidGVtcGxhdGVfZGVidWdnaW5nIjtzOjE6Im4iO3M6MTU6ImluY2x1ZGVfc2Vjb25kcyI7czoxOiJuIjtzOjEzOiJjb29raWVfZG9tYWluIjtzOjA6IiI7czoxMToiY29va2llX3BhdGgiO3M6MDoiIjtzOjIwOiJ3ZWJzaXRlX3Nlc3Npb25fdHlwZSI7czoxOiJjIjtzOjE1OiJjcF9zZXNzaW9uX3R5cGUiO3M6MjoiY3MiO3M6MjE6ImFsbG93X3VzZXJuYW1lX2NoYW5nZSI7czoxOiJ5IjtzOjE4OiJhbGxvd19tdWx0aV9sb2dpbnMiO3M6MToieSI7czoxNjoicGFzc3dvcmRfbG9ja291dCI7czoxOiJ5IjtzOjI1OiJwYXNzd29yZF9sb2Nrb3V0X2ludGVydmFsIjtzOjE6IjEiO3M6MjA6InJlcXVpcmVfaXBfZm9yX2xvZ2luIjtzOjE6InkiO3M6MjI6InJlcXVpcmVfaXBfZm9yX3Bvc3RpbmciO3M6MToieSI7czoyNDoicmVxdWlyZV9zZWN1cmVfcGFzc3dvcmRzIjtzOjE6Im4iO3M6MTk6ImFsbG93X2RpY3Rpb25hcnlfcHciO3M6MToieSI7czoyMzoibmFtZV9vZl9kaWN0aW9uYXJ5X2ZpbGUiO3M6MDoiIjtzOjE3OiJ4c3NfY2xlYW5fdXBsb2FkcyI7czoxOiJ5IjtzOjE1OiJyZWRpcmVjdF9tZXRob2QiO3M6NzoicmVmcmVzaCI7czo5OiJkZWZ0X2xhbmciO3M6NzoiZW5nbGlzaCI7czo4OiJ4bWxfbGFuZyI7czoyOiJlbiI7czoxMjoic2VuZF9oZWFkZXJzIjtzOjE6InkiO3M6MTE6Imd6aXBfb3V0cHV0IjtzOjE6Im4iO3M6MTM6ImxvZ19yZWZlcnJlcnMiO3M6MToibiI7czoxMzoibWF4X3JlZmVycmVycyI7czozOiI1MDAiO3M6MTE6ImRhdGVfZm9ybWF0IjtzOjg6IiVuLyVqLyVZIjtzOjExOiJ0aW1lX2Zvcm1hdCI7czoyOiIxMiI7czoxMzoic2VydmVyX29mZnNldCI7czowOiIiO3M6MjE6ImRlZmF1bHRfc2l0ZV90aW1lem9uZSI7czoxMjoiQXNpYS9KYWthcnRhIjtzOjEzOiJtYWlsX3Byb3RvY29sIjtzOjQ6Im1haWwiO3M6MTE6InNtdHBfc2VydmVyIjtzOjA6IiI7czoxMzoic210cF91c2VybmFtZSI7czowOiIiO3M6MTM6InNtdHBfcGFzc3dvcmQiO3M6MDoiIjtzOjExOiJlbWFpbF9kZWJ1ZyI7czoxOiJuIjtzOjEzOiJlbWFpbF9jaGFyc2V0IjtzOjU6InV0Zi04IjtzOjE1OiJlbWFpbF9iYXRjaG1vZGUiO3M6MToibiI7czoxNjoiZW1haWxfYmF0Y2hfc2l6ZSI7czowOiIiO3M6MTE6Im1haWxfZm9ybWF0IjtzOjU6InBsYWluIjtzOjk6IndvcmRfd3JhcCI7czoxOiJ5IjtzOjIyOiJlbWFpbF9jb25zb2xlX3RpbWVsb2NrIjtzOjE6IjUiO3M6MjI6ImxvZ19lbWFpbF9jb25zb2xlX21zZ3MiO3M6MToieSI7czo4OiJjcF90aGVtZSI7czo3OiJkZWZhdWx0IjtzOjIxOiJlbWFpbF9tb2R1bGVfY2FwdGNoYXMiO3M6MToibiI7czoxNjoibG9nX3NlYXJjaF90ZXJtcyI7czoxOiJ5IjtzOjE5OiJkZW55X2R1cGxpY2F0ZV9kYXRhIjtzOjE6InkiO3M6MjQ6InJlZGlyZWN0X3N1Ym1pdHRlZF9saW5rcyI7czoxOiJuIjtzOjE2OiJlbmFibGVfY2Vuc29yaW5nIjtzOjE6Im4iO3M6MTQ6ImNlbnNvcmVkX3dvcmRzIjtzOjA6IiI7czoxODoiY2Vuc29yX3JlcGxhY2VtZW50IjtzOjA6IiI7czoxMDoiYmFubmVkX2lwcyI7czowOiIiO3M6MTM6ImJhbm5lZF9lbWFpbHMiO3M6MDoiIjtzOjE2OiJiYW5uZWRfdXNlcm5hbWVzIjtzOjA6IiI7czoxOToiYmFubmVkX3NjcmVlbl9uYW1lcyI7czowOiIiO3M6MTA6ImJhbl9hY3Rpb24iO3M6ODoicmVzdHJpY3QiO3M6MTE6ImJhbl9tZXNzYWdlIjtzOjM0OiJUaGlzIHNpdGUgaXMgY3VycmVudGx5IHVuYXZhaWxhYmxlIjtzOjE1OiJiYW5fZGVzdGluYXRpb24iO3M6MjE6Imh0dHA6Ly93d3cueWFob28uY29tLyI7czoxNjoiZW5hYmxlX2Vtb3RpY29ucyI7czoxOiJ5IjtzOjEyOiJlbW90aWNvbl91cmwiO3M6MzA6Imh0dHA6Ly9hZG9yYW1hL2ltYWdlcy9zbWlsZXlzLyI7czoxOToicmVjb3VudF9iYXRjaF90b3RhbCI7czo0OiIxMDAwIjtzOjE3OiJuZXdfdmVyc2lvbl9jaGVjayI7czoxOiJuIjtzOjE3OiJlbmFibGVfdGhyb3R0bGluZyI7czoxOiJuIjtzOjE3OiJiYW5pc2hfbWFza2VkX2lwcyI7czoxOiJ5IjtzOjE0OiJtYXhfcGFnZV9sb2FkcyI7czoyOiIxMCI7czoxMzoidGltZV9pbnRlcnZhbCI7czoxOiI4IjtzOjEyOiJsb2Nrb3V0X3RpbWUiO3M6MjoiMzAiO3M6MTU6ImJhbmlzaG1lbnRfdHlwZSI7czo3OiJtZXNzYWdlIjtzOjE0OiJiYW5pc2htZW50X3VybCI7czowOiIiO3M6MTg6ImJhbmlzaG1lbnRfbWVzc2FnZSI7czo1MDoiWW91IGhhdmUgZXhjZWVkZWQgdGhlIGFsbG93ZWQgcGFnZSBsb2FkIGZyZXF1ZW5jeS4iO3M6MTc6ImVuYWJsZV9zZWFyY2hfbG9nIjtzOjE6InkiO3M6MTk6Im1heF9sb2dnZWRfc2VhcmNoZXMiO3M6MzoiNTAwIjtzOjE3OiJ0aGVtZV9mb2xkZXJfcGF0aCI7czozNjoiL3Nydi93d3cvYWRvcmFtYS52YXJkaW9uLmNvbS90aGVtZXMvIjtzOjEwOiJpc19zaXRlX29uIjtzOjE6InkiO3M6MTE6InJ0ZV9lbmFibGVkIjtzOjE6InkiO3M6MjI6InJ0ZV9kZWZhdWx0X3Rvb2xzZXRfaWQiO3M6MToiMSI7fQ==','YTozOntzOjE5OiJtYWlsaW5nbGlzdF9lbmFibGVkIjtzOjE6InkiO3M6MTg6Im1haWxpbmdsaXN0X25vdGlmeSI7czoxOiJuIjtzOjI1OiJtYWlsaW5nbGlzdF9ub3RpZnlfZW1haWxzIjtzOjA6IiI7fQ==','YTo0Njp7czoxMDoidW5fbWluX2xlbiI7czoxOiI0IjtzOjEwOiJwd19taW5fbGVuIjtzOjE6IjUiO3M6MjU6ImFsbG93X21lbWJlcl9yZWdpc3RyYXRpb24iO3M6MToieSI7czoyNToiYWxsb3dfbWVtYmVyX2xvY2FsaXphdGlvbiI7czoxOiJ5IjtzOjE4OiJyZXFfbWJyX2FjdGl2YXRpb24iO3M6NDoibm9uZSI7czoyMzoibmV3X21lbWJlcl9ub3RpZmljYXRpb24iO3M6MToieSI7czoyMzoibWJyX25vdGlmaWNhdGlvbl9lbWFpbHMiO3M6MDoiIjtzOjI0OiJyZXF1aXJlX3Rlcm1zX29mX3NlcnZpY2UiO3M6MToieSI7czoyMjoidXNlX21lbWJlcnNoaXBfY2FwdGNoYSI7czoxOiJ5IjtzOjIwOiJkZWZhdWx0X21lbWJlcl9ncm91cCI7czoxOiI2IjtzOjE1OiJwcm9maWxlX3RyaWdnZXIiO3M6NjoibWVtYmVyIjtzOjEyOiJtZW1iZXJfdGhlbWUiO3M6NzoiZGVmYXVsdCI7czoxNDoiZW5hYmxlX2F2YXRhcnMiO3M6MToieSI7czoyMDoiYWxsb3dfYXZhdGFyX3VwbG9hZHMiO3M6MToibiI7czoxMDoiYXZhdGFyX3VybCI7czozMDoiaHR0cDovL2Fkb3JhbWEvaW1hZ2VzL2F2YXRhcnMvIjtzOjExOiJhdmF0YXJfcGF0aCI7czo0MToiRDovc3J2L25naW54L2h0bWwvYWRvcmFtYS9pbWFnZXMvYXZhdGFycy8iO3M6MTY6ImF2YXRhcl9tYXhfd2lkdGgiO3M6MzoiMTAwIjtzOjE3OiJhdmF0YXJfbWF4X2hlaWdodCI7czozOiIxMDAiO3M6MTM6ImF2YXRhcl9tYXhfa2IiO3M6MjoiNTAiO3M6MTM6ImVuYWJsZV9waG90b3MiO3M6MToibiI7czo5OiJwaG90b191cmwiO3M6MzY6Imh0dHA6Ly9hZG9yYW1hL2ltYWdlcy9tZW1iZXJfcGhvdG9zLyI7czoxMDoicGhvdG9fcGF0aCI7czo0NzoiRDovc3J2L25naW54L2h0bWwvYWRvcmFtYS9pbWFnZXMvbWVtYmVyX3Bob3Rvcy8iO3M6MTU6InBob3RvX21heF93aWR0aCI7czozOiIxMDAiO3M6MTY6InBob3RvX21heF9oZWlnaHQiO3M6MzoiMTAwIjtzOjEyOiJwaG90b19tYXhfa2IiO3M6MjoiNTAiO3M6MTY6ImFsbG93X3NpZ25hdHVyZXMiO3M6MToieSI7czoxMzoic2lnX21heGxlbmd0aCI7czozOiI1MDAiO3M6MjE6InNpZ19hbGxvd19pbWdfaG90bGluayI7czoxOiJuIjtzOjIwOiJzaWdfYWxsb3dfaW1nX3VwbG9hZCI7czoxOiJuIjtzOjExOiJzaWdfaW1nX3VybCI7czo0NDoiaHR0cDovL2Fkb3JhbWEvaW1hZ2VzL3NpZ25hdHVyZV9hdHRhY2htZW50cy8iO3M6MTI6InNpZ19pbWdfcGF0aCI7czo1NToiRDovc3J2L25naW54L2h0bWwvYWRvcmFtYS9pbWFnZXMvc2lnbmF0dXJlX2F0dGFjaG1lbnRzLyI7czoxNzoic2lnX2ltZ19tYXhfd2lkdGgiO3M6MzoiNDgwIjtzOjE4OiJzaWdfaW1nX21heF9oZWlnaHQiO3M6MjoiODAiO3M6MTQ6InNpZ19pbWdfbWF4X2tiIjtzOjI6IjMwIjtzOjE1OiJwcnZfbXNnX2VuYWJsZWQiO3M6MToibiI7czoyNToicHJ2X21zZ19hbGxvd19hdHRhY2htZW50cyI7czoxOiJ5IjtzOjE5OiJwcnZfbXNnX3VwbG9hZF9wYXRoIjtzOjQ4OiJEOi9zcnYvbmdpbngvaHRtbC9hZG9yYW1hL2ltYWdlcy9wbV9hdHRhY2htZW50cy8iO3M6MjM6InBydl9tc2dfbWF4X2F0dGFjaG1lbnRzIjtzOjE6IjMiO3M6MjI6InBydl9tc2dfYXR0YWNoX21heHNpemUiO3M6MzoiMjUwIjtzOjIwOiJwcnZfbXNnX2F0dGFjaF90b3RhbCI7czozOiIxMDAiO3M6MTk6InBydl9tc2dfaHRtbF9mb3JtYXQiO3M6NDoic2FmZSI7czoxODoicHJ2X21zZ19hdXRvX2xpbmtzIjtzOjE6InkiO3M6MTc6InBydl9tc2dfbWF4X2NoYXJzIjtzOjQ6IjYwMDAiO3M6MTk6Im1lbWJlcmxpc3Rfb3JkZXJfYnkiO3M6MTE6InNjcmVlbl9uYW1lIjtzOjIxOiJtZW1iZXJsaXN0X3NvcnRfb3JkZXIiO3M6MzoiYXNjIjtzOjIwOiJtZW1iZXJsaXN0X3Jvd19saW1pdCI7czoyOiIyMCI7fQ==','YTo3OntzOjIyOiJlbmFibGVfdGVtcGxhdGVfcm91dGVzIjtzOjE6InkiO3M6MTE6InN0cmljdF91cmxzIjtzOjE6Im4iO3M6ODoic2l0ZV80MDQiO3M6MTE6ImFkb3JhbWEvNDA0IjtzOjE5OiJzYXZlX3RtcGxfcmV2aXNpb25zIjtzOjE6Im4iO3M6MTg6Im1heF90bXBsX3JldmlzaW9ucyI7czoxOiI1IjtzOjE1OiJzYXZlX3RtcGxfZmlsZXMiO3M6MToieSI7czoxODoidG1wbF9maWxlX2Jhc2VwYXRoIjtzOjE5OiJ0aGVtZXMvc2l0ZV90aGVtZXMvIjt9','YTo5OntzOjIxOiJpbWFnZV9yZXNpemVfcHJvdG9jb2wiO3M6MzoiZ2QyIjtzOjE4OiJpbWFnZV9saWJyYXJ5X3BhdGgiO3M6MDoiIjtzOjE2OiJ0aHVtYm5haWxfcHJlZml4IjtzOjU6InRodW1iIjtzOjE0OiJ3b3JkX3NlcGFyYXRvciI7czo0OiJkYXNoIjtzOjE3OiJ1c2VfY2F0ZWdvcnlfbmFtZSI7czoxOiJuIjtzOjIyOiJyZXNlcnZlZF9jYXRlZ29yeV93b3JkIjtzOjg6ImNhdGVnb3J5IjtzOjIzOiJhdXRvX2NvbnZlcnRfaGlnaF9hc2NpaSI7czoxOiJuIjtzOjIyOiJuZXdfcG9zdHNfY2xlYXJfY2FjaGVzIjtzOjE6InkiO3M6MjM6ImF1dG9fYXNzaWduX2NhdF9wYXJlbnRzIjtzOjE6InkiO30=','YToyOntzOjc6ImVtYWlsZWQiO2E6MDp7fXM6Mzg6Ii9zcnYvd3d3L2Fkb3JhbWEudmFyZGlvbi5jb20vaW5kZXgucGhwIjtzOjMyOiIyYzRlZTc3ZTljNzI3OTYwNzZlNTNkMmE4NTkxOTFlOCI7fQ==','YToxOntpOjE7YToxOntzOjM6InVybCI7czoxOToiaHR0cDovL2Fkb3JhbWEuY29tLyI7fX0=');
/*!40000 ALTER TABLE `exp_sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_snippets`
--

DROP TABLE IF EXISTS `exp_snippets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_snippets` (
  `snippet_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) NOT NULL,
  `snippet_name` varchar(75) NOT NULL,
  `snippet_contents` text,
  PRIMARY KEY (`snippet_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_snippets`
--

LOCK TABLES `exp_snippets` WRITE;
/*!40000 ALTER TABLE `exp_snippets` DISABLE KEYS */;
INSERT INTO `exp_snippets` VALUES (1,1,'br_payment_layout','<div id=\"{payment_id}\" class=\"gateways\">\n	<label class=\"btn btn-circle no-style\">\n		<input type=\"radio\" name=\"gateway\" value=\"{gateway_value}\" class=\"gateway required\" id=\"{gateway_id}\" {gateway_checked} />\n       	{gateway_label}\n	</label>\n	{if \"{has_form}\"}\n		<div class=\"payment_form\" {gateway_display}>\n			{gateway_form}\n		</div>\n	{/if}\n</div>'),(2,1,'br_price_html','<p class=\"price\">\n	{price}\n</p>'),(3,1,'br_sale_price_html','<p class=\"price\">\n	<span class=\"original\">\n		{price}\n	</span>\n	<span class=\"sale\">\n		{sale_price}\n	</span>\n</p>'),(4,1,'br_shipping_layout','<p id=\"{shipping_id}\" class=\"shipping\">\n	{if \'{shipping_label}\' != \'\'}\n		<label>{shipping_label}</label>\n		<br />\n	{/if}\n\n	{rates}\n		<input type=\"radio\" name=\"shipping\" class=\"shipping\" value=\"{rate_value}\" id=\"{rate_id}\" {rate_checked} />\n		&nbsp; \n		{if \'{rate}\' != \'\'}\n			{rate} - \n		{/if}\n		{rate_label}\n		<br />\n	{/rates}\n</p>'),(5,1,'br_system_alert','<div id=\"br_alert\">\n	<p>\n		{alert}\n	</p>\n</div>'),(6,1,'br_system_message','<div id=\"br_message\">\n	<p>\n		{message}\n	</p>\n</div>');
/*!40000 ALTER TABLE `exp_snippets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_specialty_templates`
--

DROP TABLE IF EXISTS `exp_specialty_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_specialty_templates` (
  `template_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `enable_template` char(1) NOT NULL DEFAULT 'y',
  `template_name` varchar(50) NOT NULL,
  `data_title` varchar(80) NOT NULL,
  `template_data` text NOT NULL,
  PRIMARY KEY (`template_id`),
  KEY `template_name` (`template_name`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_specialty_templates`
--

LOCK TABLES `exp_specialty_templates` WRITE;
/*!40000 ALTER TABLE `exp_specialty_templates` DISABLE KEYS */;
INSERT INTO `exp_specialty_templates` VALUES (1,1,'y','offline_template','','<html>\n<head>\n\n<title>System Offline</title>\n\n<style type=\"text/css\">\n\nbody {\nbackground-color:	#ffffff;\nmargin:				50px;\nfont-family:		Verdana, Arial, Tahoma, Trebuchet MS, Sans-serif;\nfont-size:			11px;\ncolor:				#000;\nbackground-color:	#fff;\n}\n\na {\nfont-family:		Verdana, Arial, Tahoma, Trebuchet MS, Sans-serif;\nfont-weight:		bold;\nletter-spacing:		.09em;\ntext-decoration:	none;\ncolor:			  #330099;\nbackground-color:	transparent;\n}\n\na:visited {\ncolor:				#330099;\nbackground-color:	transparent;\n}\n\na:hover {\ncolor:				#000;\ntext-decoration:	underline;\nbackground-color:	transparent;\n}\n\n#content  {\nborder:				#999999 1px solid;\npadding:			22px 25px 14px 25px;\n}\n\nh1 {\nfont-family:		Verdana, Arial, Tahoma, Trebuchet MS, Sans-serif;\nfont-weight:		bold;\nfont-size:			14px;\ncolor:				#000;\nmargin-top: 		0;\nmargin-bottom:		14px;\n}\n\np {\nfont-family:		Verdana, Arial, Tahoma, Trebuchet MS, Sans-serif;\nfont-size: 			12px;\nfont-weight: 		normal;\nmargin-top: 		12px;\nmargin-bottom: 		14px;\ncolor: 				#000;\n}\n</style>\n\n</head>\n\n<body>\n\n<div id=\"content\">\n\n<h1>System Offline</h1>\n\n<p>This site is currently offline</p>\n\n</div>\n\n</body>\n\n</html>'),(2,1,'y','message_template','','<html>\n<head>\n\n<title>{title}</title>\n\n<meta http-equiv=\'content-type\' content=\'text/html; charset={charset}\' />\n\n{meta_refresh}\n\n<style type=\"text/css\">\n\nbody {\nbackground-color:	#ffffff;\nmargin:				50px;\nfont-family:		Verdana, Arial, Tahoma, Trebuchet MS, Sans-serif;\nfont-size:			11px;\ncolor:				#000;\nbackground-color:	#fff;\n}\n\na {\nfont-family:		Verdana, Arial, Tahoma, Trebuchet MS, Sans-serif;\nletter-spacing:		.09em;\ntext-decoration:	none;\ncolor:			  #330099;\nbackground-color:	transparent;\n}\n\na:visited {\ncolor:				#330099;\nbackground-color:	transparent;\n}\n\na:active {\ncolor:				#ccc;\nbackground-color:	transparent;\n}\n\na:hover {\ncolor:				#000;\ntext-decoration:	underline;\nbackground-color:	transparent;\n}\n\n#content  {\nborder:				#000 1px solid;\nbackground-color: 	#DEDFE3;\npadding:			22px 25px 14px 25px;\n}\n\nh1 {\nfont-family:		Verdana, Arial, Tahoma, Trebuchet MS, Sans-serif;\nfont-weight:		bold;\nfont-size:			14px;\ncolor:				#000;\nmargin-top: 		0;\nmargin-bottom:		14px;\n}\n\np {\nfont-family:		Verdana, Arial, Tahoma, Trebuchet MS, Sans-serif;\nfont-size: 			12px;\nfont-weight: 		normal;\nmargin-top: 		12px;\nmargin-bottom: 		14px;\ncolor: 				#000;\n}\n\nul {\nmargin-bottom: 		16px;\n}\n\nli {\nlist-style:			square;\nfont-family:		Verdana, Arial, Tahoma, Trebuchet MS, Sans-serif;\nfont-size: 			12px;\nfont-weight: 		normal;\nmargin-top: 		8px;\nmargin-bottom: 		8px;\ncolor: 				#000;\n}\n\n</style>\n\n</head>\n\n<body>\n\n<div id=\"content\">\n\n<h1>{heading}</h1>\n\n{content}\n\n<p>{link}</p>\n\n</div>\n\n</body>\n\n</html>'),(3,1,'y','admin_notify_reg','Notification of new member registration','New member registration site: {site_name}\n\nScreen name: {name}\nUser name: {username}\nEmail: {email}\n\nYour control panel URL: {control_panel_url}'),(4,1,'y','admin_notify_entry','A new channel entry has been posted','A new entry has been posted in the following channel:\n{channel_name}\n\nThe title of the entry is:\n{entry_title}\n\nPosted by: {name}\nEmail: {email}\n\nTo read the entry please visit:\n{entry_url}\n'),(5,1,'y','admin_notify_mailinglist','Someone has subscribed to your mailing list','A new mailing list subscription has been accepted.\n\nEmail Address: {email}\nMailing List: {mailing_list}'),(6,1,'y','admin_notify_comment','You have just received a comment','You have just received a comment for the following channel:\n{channel_name}\n\nThe title of the entry is:\n{entry_title}\n\nLocated at:\n{comment_url}\n\nPosted by: {name}\nEmail: {email}\nURL: {url}\nLocation: {location}\n\n{comment}'),(7,1,'y','mbr_activation_instructions','Enclosed is your activation code','Thank you for your new member registration.\n\nTo activate your new account, please visit the following URL:\n\n{unwrap}{activation_url}{/unwrap}\n\nThank You!\n\n{site_name}\n\n{site_url}'),(8,1,'y','forgot_password_instructions','Login information','{name},\n\nTo reset your password, please go to the following page:\n\n{reset_url}\n\nThen log in with your username: {username}\n\nIf you do not wish to reset your password, ignore this message. It will expire in 24 hours.\n\n{site_name}\n{site_url}'),(9,1,'y','validated_member_notify','Your membership account has been activated','{name},\n\nYour membership account has been activated and is ready for use.\n\nThank You!\n\n{site_name}\n{site_url}'),(10,1,'y','decline_member_validation','Your membership account has been declined','{name},\n\nWe\'re sorry but our staff has decided not to validate your membership.\n\n{site_name}\n{site_url}'),(11,1,'y','mailinglist_activation_instructions','Email Confirmation','Thank you for joining the \"{mailing_list}\" mailing list!\n\nPlease click the link below to confirm your email.\n\nIf you do not want to be added to our list, ignore this email.\n\n{unwrap}{activation_url}{/unwrap}\n\nThank You!\n\n{site_name}'),(12,1,'y','comment_notification','Someone just responded to your comment','{name_of_commenter} just responded to the entry you subscribed to at:\n{channel_name}\n\nThe title of the entry is:\n{entry_title}\n\nYou can see the comment at the following URL:\n{comment_url}\n\n{comment}\n\nTo stop receiving notifications for this comment, click here:\n{notification_removal_url}'),(13,1,'y','comments_opened_notification','New comments have been added','Responses have been added to the entry you subscribed to at:\n{channel_name}\n\nThe title of the entry is:\n{entry_title}\n\nYou can see the comments at the following URL:\n{comment_url}\n\n{comments}\n{comment}\n{/comments}\n\nTo stop receiving notifications for this entry, click here:\n{notification_removal_url}'),(14,1,'y','private_message_notification','Someone has sent you a Private Message','\n{recipient_name},\n\n{sender_name} has just sent you a Private Message titled ‘{message_subject}’.\n\nYou can see the Private Message by logging in and viewing your inbox at:\n{site_url}\n\nContent:\n\n{message_content}\n\nTo stop receiving notifications of Private Messages, turn the option off in your Email Settings.\n\n{site_name}\n{site_url}'),(15,1,'y','pm_inbox_full','Your private message mailbox is full','{recipient_name},\n\n{sender_name} has just attempted to send you a Private Message,\nbut your inbox is full, exceeding the maximum of {pm_storage_limit}.\n\nPlease log in and remove unwanted messages from your inbox at:\n{site_url}');
/*!40000 ALTER TABLE `exp_specialty_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_stats`
--

DROP TABLE IF EXISTS `exp_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_stats` (
  `stat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `total_members` mediumint(7) NOT NULL DEFAULT '0',
  `recent_member_id` int(10) NOT NULL DEFAULT '0',
  `recent_member` varchar(50) NOT NULL,
  `total_entries` mediumint(8) NOT NULL DEFAULT '0',
  `total_forum_topics` mediumint(8) NOT NULL DEFAULT '0',
  `total_forum_posts` mediumint(8) NOT NULL DEFAULT '0',
  `total_comments` mediumint(8) NOT NULL DEFAULT '0',
  `last_entry_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_forum_post_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_comment_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_visitor_date` int(10) unsigned NOT NULL DEFAULT '0',
  `most_visitors` mediumint(7) NOT NULL DEFAULT '0',
  `most_visitor_date` int(10) unsigned NOT NULL DEFAULT '0',
  `last_cache_clear` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`stat_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_stats`
--

LOCK TABLES `exp_stats` WRITE;
/*!40000 ALTER TABLE `exp_stats` DISABLE KEYS */;
INSERT INTO `exp_stats` VALUES (1,1,1,1,'Adorama PrintShop Admin',3,0,0,0,1445106542,0,0,1448430352,12,1445295548,1448958814);
/*!40000 ALTER TABLE `exp_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_status_groups`
--

DROP TABLE IF EXISTS `exp_status_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_status_groups` (
  `group_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_status_groups`
--

LOCK TABLES `exp_status_groups` WRITE;
/*!40000 ALTER TABLE `exp_status_groups` DISABLE KEYS */;
INSERT INTO `exp_status_groups` VALUES (1,1,'Statuses');
/*!40000 ALTER TABLE `exp_status_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_status_no_access`
--

DROP TABLE IF EXISTS `exp_status_no_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_status_no_access` (
  `status_id` int(6) unsigned NOT NULL,
  `member_group` smallint(4) unsigned NOT NULL,
  PRIMARY KEY (`status_id`,`member_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_status_no_access`
--

LOCK TABLES `exp_status_no_access` WRITE;
/*!40000 ALTER TABLE `exp_status_no_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_status_no_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_statuses`
--

DROP TABLE IF EXISTS `exp_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_statuses` (
  `status_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_id` int(4) unsigned NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_order` int(3) unsigned NOT NULL,
  `highlight` varchar(30) NOT NULL,
  PRIMARY KEY (`status_id`),
  KEY `group_id` (`group_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_statuses`
--

LOCK TABLES `exp_statuses` WRITE;
/*!40000 ALTER TABLE `exp_statuses` DISABLE KEYS */;
INSERT INTO `exp_statuses` VALUES (1,1,1,'open',1,'009933'),(2,1,1,'closed',2,'990000');
/*!40000 ALTER TABLE `exp_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_template_groups`
--

DROP TABLE IF EXISTS `exp_template_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_template_groups` (
  `group_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_name` varchar(50) NOT NULL,
  `group_order` int(3) unsigned NOT NULL,
  `is_site_default` char(1) NOT NULL DEFAULT 'n',
  PRIMARY KEY (`group_id`),
  KEY `site_id` (`site_id`),
  KEY `group_name_idx` (`group_name`),
  KEY `group_order_idx` (`group_order`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_template_groups`
--

LOCK TABLES `exp_template_groups` WRITE;
/*!40000 ALTER TABLE `exp_template_groups` DISABLE KEYS */;
INSERT INTO `exp_template_groups` VALUES (1,1,'adorama',1,'y'),(2,1,'assets',2,'n');
/*!40000 ALTER TABLE `exp_template_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_template_member_groups`
--

DROP TABLE IF EXISTS `exp_template_member_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_template_member_groups` (
  `group_id` smallint(4) unsigned NOT NULL,
  `template_group_id` mediumint(5) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`template_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_template_member_groups`
--

LOCK TABLES `exp_template_member_groups` WRITE;
/*!40000 ALTER TABLE `exp_template_member_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_template_member_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_template_no_access`
--

DROP TABLE IF EXISTS `exp_template_no_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_template_no_access` (
  `template_id` int(6) unsigned NOT NULL,
  `member_group` smallint(4) unsigned NOT NULL,
  PRIMARY KEY (`template_id`,`member_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_template_no_access`
--

LOCK TABLES `exp_template_no_access` WRITE;
/*!40000 ALTER TABLE `exp_template_no_access` DISABLE KEYS */;
INSERT INTO `exp_template_no_access` VALUES (1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(19,2),(20,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(36,2),(37,2),(38,2),(39,2),(40,2);
/*!40000 ALTER TABLE `exp_template_no_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_template_routes`
--

DROP TABLE IF EXISTS `exp_template_routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_template_routes` (
  `route_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned DEFAULT NULL,
  `route` varchar(512) DEFAULT NULL,
  `route_parsed` varchar(512) DEFAULT NULL,
  `route_required` char(1) NOT NULL DEFAULT 'n',
  PRIMARY KEY (`route_id`),
  KEY `template_id` (`template_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_template_routes`
--

LOCK TABLES `exp_template_routes` WRITE;
/*!40000 ALTER TABLE `exp_template_routes` DISABLE KEYS */;
INSERT INTO `exp_template_routes` VALUES (1,2,NULL,'404','^404\\/?$','n'),(2,3,NULL,'about','^about\\/?$','n'),(3,4,NULL,'cart/confirm','^cart\\/?confirm\\/?$','n'),(4,5,NULL,'canvas/size','^canvas\\/?size\\/?$','n'),(5,6,NULL,'cart/{owner_id:integer}','^cart\\/?(?P<egncnk0bcuu8gsgowogoks4w0wc4s48o>(((?=\\b([\\-+]?[0-9]+)\\b)([^\\/]*))))?\\/?$','n'),(6,7,NULL,'upload/{page:integer}','^upload\\/?(?P<edu1z29t9o6go84scooo4og48gg8k0sk>(((?=\\b([\\-+]?[0-9]+)\\b)([^\\/]*))))?\\/?$','n'),(7,8,NULL,'contact','^contact\\/?$','n'),(8,9,NULL,'contact/success','^contact\\/?success\\/?$','n'),(9,10,NULL,'facebook','^facebook\\/?$','n'),(10,11,NULL,'faq','^faq\\/?$','n'),(11,12,NULL,'finish','^finish\\/?$','n'),(12,13,NULL,'payment/finish','^payment\\/?finish\\/?$','n'),(13,1,NULL,NULL,NULL,'n'),(14,14,NULL,'instagram/{keyword}','^instagram\\/?(?P<ej6m6na3f8vcosggko8sgw8scckskwos>(((?=\\b([A-Za-z0-9_-]+)\\b)([^\\/]*))))?\\/?$','n'),(15,15,NULL,'login','^login\\/?$','n'),(16,16,NULL,'magnet/quantity','^magnet\\/?quantity\\/?$','n'),(17,17,NULL,'shipping','^shipping\\/?$','n'),(18,18,NULL,'list','^list\\/?$','n'),(19,19,NULL,'payment/confirm','^payment\\/?confirm\\/?$','n'),(20,20,NULL,'payment/success','^payment\\/?success\\/?$','n'),(21,21,NULL,NULL,NULL,'n'),(22,22,NULL,NULL,NULL,'n'),(23,23,NULL,'arrange/{layout_id}/{owner_id}','^arrange\\/?(?P<ecv8kt1lx35wkks044004wg0coowossg>(((?=\\b([A-Za-z0-9_-]+)\\b)([^\\/]*))))?\\/?(?P<egncnk0bcuu8gsgowogoks4w0wc4s48o>(((?=\\b([A-Za-z0-9_-]+)\\b)([^\\/]*))))?\\/?$','n'),(24,24,NULL,'photobook/size','^photobook\\/?size\\/?$','n'),(25,25,NULL,'photoprint/border','^photoprint\\/?border\\/?$','n'),(26,26,NULL,'photoprint','^photoprint\\/?$','n'),(27,27,NULL,'photoprint/quantity','^photoprint\\/?quantity\\/?$','n'),(28,28,NULL,NULL,NULL,'n'),(29,29,NULL,'products','^products\\/?$','n'),(30,30,NULL,'register','^register\\/?$','n'),(31,31,NULL,'checkout/{owner_id:integer}','^checkout\\/?(?P<egncnk0bcuu8gsgowogoks4w0wc4s48o>(((?=\\b([\\-+]?[0-9]+)\\b)([^\\/]*))))?\\/?$','n'),(32,32,NULL,'all','^all\\/?$','n'),(33,33,NULL,NULL,NULL,'n'),(34,34,NULL,NULL,NULL,'n'),(35,35,NULL,NULL,NULL,'n'),(36,37,NULL,NULL,NULL,'n'),(37,38,NULL,NULL,NULL,'n'),(38,39,NULL,NULL,NULL,'n'),(39,40,NULL,NULL,NULL,'n'),(40,36,NULL,NULL,NULL,'n'),(41,45,NULL,'book','^book\\/?$','n'),(42,43,NULL,'canvas','^canvas\\/?$','n'),(43,44,NULL,NULL,NULL,'n'),(44,47,NULL,NULL,NULL,'n'),(45,46,NULL,'photobook/{layout_id}/{owner_id}','^photobook\\/?(?P<ecv8kt1lx35wkks044004wg0coowossg>(((?=\\b([A-Za-z0-9_-]+)\\b)([^\\/]*))))?\\/?(?P<egncnk0bcuu8gsgowogoks4w0wc4s48o>(((?=\\b([A-Za-z0-9_-]+)\\b)([^\\/]*))))?\\/?$','n'),(46,48,NULL,NULL,NULL,'n'),(47,41,NULL,NULL,NULL,'n'),(48,42,NULL,NULL,NULL,'n');
/*!40000 ALTER TABLE `exp_template_routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_templates`
--

DROP TABLE IF EXISTS `exp_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_templates` (
  `template_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `group_id` int(6) unsigned NOT NULL,
  `template_name` varchar(50) NOT NULL,
  `save_template_file` char(1) NOT NULL DEFAULT 'n',
  `template_type` varchar(16) NOT NULL DEFAULT 'webpage',
  `template_data` mediumtext,
  `template_notes` text,
  `edit_date` int(10) NOT NULL DEFAULT '0',
  `last_author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cache` char(1) NOT NULL DEFAULT 'n',
  `refresh` int(6) unsigned NOT NULL DEFAULT '0',
  `no_auth_bounce` varchar(50) NOT NULL DEFAULT '',
  `enable_http_auth` char(1) NOT NULL DEFAULT 'n',
  `allow_php` char(1) NOT NULL DEFAULT 'n',
  `php_parse_location` char(1) NOT NULL DEFAULT 'o',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `protect_javascript` char(1) NOT NULL DEFAULT 'n',
  PRIMARY KEY (`template_id`),
  KEY `group_id` (`group_id`),
  KEY `template_name` (`template_name`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_templates`
--

LOCK TABLES `exp_templates` WRITE;
/*!40000 ALTER TABLE `exp_templates` DISABLE KEYS */;
INSERT INTO `exp_templates` VALUES (1,1,1,'index','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	{meta}        \r\n	{css}	\r\n</head>\r\n<body>	\r\n        {embed=assets/header}\r\n        <div class=\"page\">\r\n<!--	<section>\r\n		<div class=\"banner\">\r\n		</div>\r\n		<div class=\"tour\">\r\n			The best place to your photo <a href=\"#\" class=\"btn btn-circle\">Tour</a>\r\n		</div>\r\n	</section>\r\n        {shop_filter}-->\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"title-cont\">Featured Product</div>\r\n					<div class=\"feature clearfix\">\r\n						<div class=\"col-md-12 col-centered\">\r\n                                                    <div class=\"box1\"><a href=\"/photoprint\"><label>Photo Print</label></a></div>\r\n                                                    <div class=\"box1\"><a href=\"/canvas/3\"><label>Canvas</label></a></div>\r\n                                                    <div class=\"box1\"><a href=\"/upload\"><label>Magnets</label></a></div>\r\n                                                    <div class=\"box1\"><a href=\"/upload/2\"><label>Books</label></a></div>\r\n                                                    <div class=\"box2\"><a href=\"/upload/2\"><label>Accessories</label></a></div>\r\n						</div>\r\n					</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"bg-white\">\r\n			<div class=\"container\">\r\n				<div class=\"row\">\r\n					<div class=\"title-cont\">What people share <label class=\"lbl\">What people says at #travellingprintshop</label></div>\r\n					<div class=\"share-box clearfix\">\r\n						<div class=\"col-md-12 col-centered clearfix\">\r\n							<div class=\"share-item\"></div>\r\n							<div class=\"share-item\"></div>\r\n							<div class=\"share-item\"></div>\r\n							<div class=\"share-item\"></div>\r\n							<div class=\"share-item\"></div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"title-cont bold\">Be friend with us !</div>\r\n				<div class=\"sosmed\">\r\n					<a href=\"#\"><i class=\"fa fa-instagram fa-cos\"></i></a>\r\n					<a href=\"#\"><i class=\"fa fa-facebook fa-cos\"></i></a>\r\n					<a href=\"#\"><i class=\"fa fa-twitter fa-cos\"></i></a>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"bg-white\">\r\n			<div class=\"container\">\r\n				<div class=\"row\">\r\n					<div class=\"title-cont bold\">Only good news come to your mail! <label class=\"lbl\">Enter your mail and we will keep you posted on any news or promotions</label></div>\r\n					<div class=\"form-subscribe\">\r\n						<div class=\"input-group\">\r\n							<form>\r\n								<input type=\"email\" class=\"form-control sub-field\" placeholder=\"Email Address\">\r\n								<span class=\"input-group-btn sub-group\">\r\n									<button class=\"btn btn-default sub-button\" type=\"button\">Submit</button>\r\n								</span>\r\n							</form>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n        </div>\r\n	{embed=assets/footer}\r\n        {js}\r\n\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',206,'n'),(2,1,1,'404','y','webpage','<!DOCTYPE html>\n<html>\n<head>\n	<title>{site_name}</title>\n        {css}\n	<!--[if IE]>\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\n    <![endif]-->\n</head>\n<body>\n	{embed=assets/header}\n        <div class=\"page\">\n	<section>\n        <div class=\"container\">\n            <div class=\"row\">\n                <div class=\"title-cont story storyline\">Our story so far<br><br><br>it was... <br>\n                    <p class=\"lbl\">Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet <br> Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</p>\n                </div>\n            </div>\n        </div>\n	</section>\n	<section>\n		<div class=\"bg-white\">\n			<div class=\"container\">\n				<div class=\"img-cont story\">\n                	<img src=\"{theme_url}images/pic-building.png\" class=\"img-responsive\" />\n                </div>\n                <div class=\"title-cont storyline\">and then... <br>\n                    <p class=\"lbl\">Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet <br> Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</p>\n                </div>\n			</div>\n		</div>\n        <div class=\"container\">\n        	<div class=\"title-cont story storyline\">so today... <br>\n                <p class=\"lbl\">Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet <br> Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</p>\n            </div>\n        </div>\n        <div class=\"bg-white\">\n        	<div class=\"container\">\n            	<div class=\"img-cont story\">\n                	<img src=\"{theme_url}images/pic-phone.png\" class=\"img-responsive\" />\n            	</div>\n            </div>\n        </div>\n	</section>\n    </div>\n    {embed=assets/footer}\n    {js}\n</body>\n</html>','',1444824536,1,'y',0,'','n','n','o',708,'n'),(3,1,1,'about_us','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>{site_name}</title>\r\n        {css}\r\n	<!--[if IE]>\r\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n        <div class=\"page\">\r\n	<section>\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"title-cont story storyline\">Our story so far<br><br><br>it was... <br>\r\n                    <p class=\"lbl\">Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet <br> Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n	</section>\r\n	<section>\r\n		<div class=\"bg-white\">\r\n			<div class=\"container\">\r\n				<div class=\"img-cont story\">\r\n                	<img src=\"{theme_url}images/pic-building.png\" class=\"img-responsive\" />\r\n                </div>\r\n                <div class=\"title-cont storyline\">and then... <br>\r\n                    <p class=\"lbl\">Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet <br> Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</p>\r\n                </div>\r\n			</div>\r\n		</div>\r\n        <div class=\"container\">\r\n        	<div class=\"title-cont story storyline\">so today... <br>\r\n                <p class=\"lbl\">Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet <br> Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"bg-white\">\r\n        	<div class=\"container\">\r\n            	<div class=\"img-cont story\">\r\n                	<img src=\"{theme_url}images/pic-phone.png\" class=\"img-responsive\" />\r\n            	</div>\r\n            </div>\r\n        </div>\r\n	</section>\r\n    </div>\r\n    {embed=assets/footer}\r\n    {js}\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',1,'n'),(4,1,1,'add_cart_confirmation','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap.min.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/style.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/font-awesome/css/font-awesome.min.css\">\r\n	<!--[if IE]>\r\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n</head>\r\n<body>\r\n	{embed=assets/header}\n<div class=\"page\">\r\n	<section class=\"min-height\">\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content sucess\">\r\n					<div class=\"title-cont bold f42\">This item has been added to your cart</div>\r\n					<img src=\"{theme_url}images/shop.png\" class=\"img-responsive img-centered\">\r\n					<div class=\"button-back marg\">\r\n						<a href=\"#\" class=\"btn btn-circle pad-hop\">Proceed to Payment</a>\r\n					</div>\r\n					<label class=\"text-center disblock\"><a href=\"#\">Continue shopping</a></label>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\n	{embed=assets/footer}\r\n{js}\r\n{js}\r\n<script>\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n	});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',3,'n'),(5,1,1,'canvas_size_selector','y','webpage','<!DOCTYPE html>\n<html>\n<head>\n	<title>PrintShop Adorama</title>\n        {css}\n</head>\n<body>\n	{embed=assets/header}\n        <div class=\"page canvas\">\n	<section class=\"min-height\">\n		<div class=\"container\">\n			<div class=\"row\">\n				<div class=\"content sucess\">\n                                    <form action=\"/\" method=\"POST\">\n                                        <input type=\"hidden\" name=\"XID\" value=\"{XID_HASH}\" />\n                                        <input type=\"hidden\" name=\"ACT\" value=\"276\" />\n                                        <input type=\"hidden\" name=\"layout_id\" value=\"{segment:layout_id}\" />\n                                        \n					<div class=\"title-cont bold f42\">Select a Size</div>\n					<div class=\"border-style\">\n                                                <label>\n                                                <input type=\'radio\' name=\"canvas\"  value=\"medium\"/>\n						<div class=\"border-img\">\n							<div>\n								<img src=\"{theme_url}images/medium-size.png\">\n							</div>\n							<div class=\"detail-size\">\n								<label class=\"lbl-size\">Medium</label>\n								<label class=\"lbl-size\">20cm x 20cm</label>\n							</div>\n							<label>IDR 50.000</label>\n						</div>\n                                                </label>\n                                                <label>\n                                                <input type=\'radio\' name=\"canvas\"  value=\"large\"/>\n						<div class=\"border-img\">\n							<div>\n								<img src=\"{theme_url}images/large-size.png\">\n							</div>\n							<div class=\"detail-size\">\n								<label class=\"lbl-size\">Large</label>\n								<label class=\"lbl-size\">30cm x 30cm</label>\n							</div>\n							<label>IDR 100.000</label>\n						</div>\n                                                </label>\n					</div>\n					<div class=\"button-back marg\">\n                                            <button href=\"#\" class=\"btn btn-black\" style=\"padding:10px 45px\">Next</button>\n					</div>\n                                    </form>    \n				</div>\n			</div>\n		</div>\n	</section>\n{js}\n{js}\n<script>\n	$(document).ready(function(){\n		$(\'#sh-foot\').click(function(e){\n			$(\'.footer-toggle\').slideToggle();\n			\n			if($(this).hasClass(\'up\')){\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\n			}else{\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\n			}\n			$(\'html, body\').animate({\n	           scrollTop: $(document).height()\n	        }, 2000);\n			e.preventDefault();\n		});\n	});\n</script>\n</body>\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',33,'n'),(6,1,1,'cart','y','webpage','<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>PrintShop Adorama</title>\r\n        {meta}\r\n        {css}\r\n    </head>\r\n    <body>\r\n    {embed=assets/header}\r\n    <div class=\"page\">\r\n        <section class=\"maincontent\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"shop-cart\">\r\n                        <h1>Shopping Cart</h1>\r\n                        {exp:brilliant_retail:show_message}\r\n                        {if {exp:brilliant_retail:cart_items} == 0}\r\n                            <div id=\"br_alert\">Your shopping cart is currently empty.</div>\r\n                        {if:else}\r\n                        {exp:brilliant_retail:cart}        \r\n                            <ul class=\"carts\">\r\n                                {items}\r\n                                <li class=\"cart-item\">\r\n                                <div class=\"product-img\">\r\n                                    <img src=\"{image_thumb}\" style=\"width: 100%;height: 100%\"/>                                    \r\n                                </div>\r\n                                <div class=\"cart\">\r\n                                    <div class=\"product\">\r\n                                        <h5><a href=\"{exp:brilliant_retail:path src=\'product/{url_title}\'}\">{title}</a></h5>\r\n                                        <ul>\r\n                                            {options}\r\n                                        </ul>\r\n                                    </div>\r\n                                    <div class=\"desc\">\r\n                                        <div class=\"cost\">{subtotal}</div>\r\n                                        <div class=\"qty\">Qty <input type=\"number\" name=\"qty[{hash}]\" value=\"{quantity}\"/></div>\r\n                                    </div>\r\n                                    <div class=\"act\">\r\n                                    <button type=\"button\" class=\"btn btn-circle no-style\">Update</button>\r\n                                    <a  href=\"{remove_link}\" class=\"btn btn-circle no-style\">Remove</a>\r\n                                    </div>\r\n                                </div>\r\n                                </li>\r\n                                {/items}\r\n                            </ul>\r\n                        {/exp:brilliant_retail:cart}\r\n                        {/if}\r\n                        <div class=\"totals\">\r\n                            <div class=\"total\">Total : <label>{exp:brilliant_retail:cart_total}</label> </div>\r\n                            \r\n                            <span class=\"btn btn-circle\">{exp:brilliant_retail:checkout_buttons}</span>\r\n                            <div class=\"continue\"><a href=\"{exp:brilliant_retail:path src=\'/\'}\">continue shopping</a></div>\r\n                        </div>\r\n                        <div class=\"info\">\r\n                            Please note that shipping will calculated at the end of proccess\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        </div>\r\n	{embed=assets/footer}\r\n    {js}    \r\n    </body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',247,'n'),(7,1,1,'computer_upload_module','y','webpage','<!DOCTYPE html>\n<html>\n<head>\n	<title>PrintShop Adorama</title>\n        {meta}\n        {css}\n        <link rel=\"stylesheet\" href=\"{theme_url}css/cropper.min.css\">\n        <link rel=\"stylesheet\" href=\"{theme_url}css/upload.css\">\n</head>\n<body>\n	{embed=assets/header}\n        <div class=\"page upload\">\n	<section class=\"maincontent\">\n		<div class=\"container\">\n                        <div>\n                            <h2 style=\"display: inline-block\">Upload and Select your files</h2>\n                            <a href=\"\" class=\"btn btn-black next\" style=\"margin-top:20px;float:right\">Next</a>\n                        </div>\n                        <br class=\"clearfix\" style=\"clear:both\"/>\n			<div class=\"row\" id=\"upload\">\n                            <form id=\"fileupload\" action=\"/index.php?ACT=31&XID={XID_HASH}&page={segment:page}\" method=\"POST\" enctype=\"multipart/form-data\">\n                                <input type=\"hidden\" name=\"ACT\" value=\"26\" />\n                                <input type=\"hidden\" name=\"XID\" value=\"{XID_HASH}\" />\n                                <input type=\"hidden\" name=\"page\" value=\"{segment:page}\" />\n                                <input type=\"hidden\" name=\"maxFiles\" value=\"<?=@$_SESSION[\'max_selected\'] ? $_SESSION[\'max_selected\'] : 20  ?> \"/>\n                                <input type=\"hidden\" name=\"map\" id=\"map\"/>\n                                <input type=\"hidden\" name=\"owner_id\" id=\"session_id\" value=\"<?=session_id()?>\"/>\n                                <input id=\"layout_id\" type=\"hidden\" name=\"layout_id\" value=\"{exp:session_variables:get name=\'layout_id\'}\" />\n                                <div role=\"presentation\" class=\"layout layout_1\">\n                                    <ul id=\"files\" class=\"pg files \" data-page=\"1\" data-max_item=\"1\" >\n                                        <li class=\"col-md-2 col-sm-2 col-xs-4 tmpl instruction\">\n                                            <label for=\"file_input\" class=\"box-photo box-upload\">\n                                                <span >Upload More +</span><input id=\"file_input\" type=\"file\" name=\"file[]\" string=\"Add File!\" multiple=\"true\" accept=\"image/*\" style=\"position:absolute;opacity: 0\">\n                                            </label>\n                                        </li>\n                                    </ul>\n                                    <div class=\"spacer clearfix\" style=\"clear: both;\"></div>\n                                </div>\n                                </form>\n                                \n                            \n			</div>\n		</div>\n	</section>\n        </div>\n	<footer style=\"height: 54px\">\n		<div class=\"bg-black\">\n			<div class=\"container\">\n				<div class=\"row\">\n					<div class=\"foot_upload\">\n						<ul>\n                                                        {if logged_in}\n                                                            <li>\n                                                                <a href=\"{exp:ig_picpuller_lite:authorization_url}\" class=\'submit authorize\'>Instagram</a>\n<!--                                                                <a href=\"https://instagram.com/oauth/authorize/?client_id=61ab4c38876f4eee88da5f2fec64bae5&redirect_uri=http://adorama/index.php?ACT=217&display=touch&response_type=code\" class=\'submit authorize\'>Instagram</a>-->\n                                                            </li>\n                                                            <li><a href=\"#\">Facebook</a></li>\n                                                        {if:else}\n                                                            <li><a href=\"/login\">Instagram</a></li>\n                                                            <li><a href=\"/login\">Facebook</a></li>\n                                                        {/if}\n                                                                                                                \n							<li><a href=\"#\" onclick=\"$(\'#files\').click();return false;\">Upload</a></li>\n							<li class=\"pageof\"><span>1/24</span></li>\n						</ul>\n					</div>\n				</div>\n			</div>\n		</div>\n	</footer>        \n<div id=\"blueimp-gallery\" class=\"blueimp-gallery blueimp-gallery-single\" data-filter=\":even\">\n    <div class=\"slides\">\n        <div class=\"cropbox\"></div>\n        <img class=\"slide-content\"/>\n    </div>\n    <h3 class=\"title\"></h3>\n    <a class=\"hrev\">‹</a>\n    <a class=\"next\">›</a>\n    <a class=\"close\">×</a>\n    <a class=\"play-pause\"></a>\n    <ol class=\"indicator\"></ol>\n</div>        \n\n<div class=\"modal fade\" id=\"cropper-modal\">\n  <div class=\"modal-dialog\">\n    <div class=\"modal-content\">\n      <div class=\"modal-body\">\n          <div id=\"cropper-img\" style=\"width: 100%;height: 100%;overflow: hidden;\">\n            <img  src=\"\" alt=\"Picture\" height=\"600px\">\n          </div>         \n      </div>\n        <div class=\"ctrl-btn\" style=\"position: absolute;top:10px;right:10px;\">\n            <a class=\"ctrl btn btn-black rotate cw\"><i class=\"fa fa fa-rotate-right\" ></i></a>\n            <a class=\"ctrl btn btn-black rotate ccw\"><i class=\"fa fa fa-rotate-left\" ></i></a>\n            <span class=\'separator hz\'></span>\n            \n            <a class=\"ctrl btn btn-black zoom in\"><i class=\"fa fa fa-plus\" ></i></a>\n            <a class=\"ctrl btn btn-black zoom out\"><i class=\"fa fa fa-minus\" ></i></a>\n            <span class=\'separator hz\'></span>\n            <a class=\"btn btn-black ok\"><i class=\"fa fa-check\" ></i></a>\n            <a class=\"btn btn-grey close\"><i class=\"fa fa-times\"></i></a>\n        </div>\n    </div>\n  </div>\n</div>        \n        \n        \n<script id=\"template-upload\" type=\"text/x-tmpl\" data-template-src=\"{site_url}themes/site_themes/material/tmpl/upload.html\">\n{% for (var i=0, file; file=o.files[i]; i++) { /*  */ %}\n    <li class=\"col-md-2 col-sm-2 col-xs-4 tmpl upload\" data-index=\"{%=i+1%}\" data-file=\"{%=file.name%}\">\n        <div class=\"photoitem\" >\n            <div class=\"overlay\">\n                <span  id=\"count_{%=i+1%}\" data-count=\"0\" class=\"count\"></span>\n                <a class=\"act-btn delete\" href=\"{%=file.deleteUrl%}\">-</a>\n                <a class=\"act-btn edit\" href=\"{%=file.url%}\"><i class=\"fa fa-edit\"/></a>\n            </div>						\n            <span class=\"preview\" id=\"file{%=i+1%}\" data-gallery></span>\n        </div>\n    </li>\n{% /*  */ } /*  */ %}\n\n</script>\n<!-- The template to display files available for download -->\n<script id=\"template-download\" type=\"text/x-tmpl\" data-template-src=\"{site_url}themes/site_themes/material/tmpl/download.html\">    \n  {% for (var i=0, file; file=o.files[i]; i++) { /*  */ %}\n    <li class=\"col-md-2 col-sm-2 col-xs-4 tmpl download\" data-index=\"{%=i+1%}\" data-file=\"{%=file.name%}\">\n        <div class=\"photoitem\">\n            <div class=\"overlay\">\n                <input type=\"checkbox\" name=\"selection[{%=btoa(file.url)%}]\" value=\"0\" style=\"width:0;height:0;opacity:0\"/>\n                <span  data-count=\"0\"  class=\"count\" id=\"count_{%=i+1%}\"></span>\n                    <a class=\"act-btn delete\" href=\"{%=file.deleteUrl%}\">-</a>\n                    <a class=\"act-btn edit\" href=\"{%=file.url%}\"><i class=\"fa fa-edit\"/></a>\n                </div>						\n            <img data-gallery class=\"preview\" src=\"{%=file.thumbnailUrl%}\" id=\"file{%=i+1%}\">                    \n        </div>\n    </li>     \n{% /* ** */}/* ** */ %}    \n</script>\n{js}\n<script>\n    $(document).ready(function(){\n        $(\".authorize\").bind(\'click\', processAuthorization);\n\n        function processAuthorization(e)\n        {\n                e.preventDefault();\n                var theURL = $(this).attr(\'href\');\n                window.open(theURL,\'ingram_auth\',\'width=400,height=450,left=0,top=100,screenX=0,screenY=100\');\n                $(window).focus(function() {\n                   // user closed the popup window... refresh this page to see if their info was successfully saved\n                    window.location.reload();\n                });\n        }\n			\n			/*function getParameterByName(name, data) {\n			    var match = RegExp(\'[?&]\' + name + \'=([^&]*)\')\n			                    .exec(data);\n			    return match && decodeURIComponent(match[1].replace(/\\+/g, \' \'));\n			}*/\n	});\n</script>\n{upload_js}\n<script src=\"{theme_url}js/upload.js\"></script>\n</body>\n</html>','',1445110438,1,'n',0,'','n','y','o',390,'n'),(8,1,1,'contactus','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap.min.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/style.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/font-awesome/css/font-awesome.min.css\">\r\n	<!--[if IE]>\r\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n</head>\r\n<body>\r\n	{embed=assets/header}\n<div class=\"page\">\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content clearfix\">\r\n					<div class=\"title-cont bold\">Contact Us</div>\r\n					<div class=\"col-md-6 clearfix\">\r\n						<div class=\"desc1\">\r\n							<div class=\"group\">\r\n								<label>Email</label>\r\n								<div>info@travelingprintshop.com</div>\r\n							</div>\r\n							<div class=\"group\">\r\n								<label>Phone Number</label>\r\n								<div>+62 214 533 3489</div>\r\n							</div>	\r\n							<div class=\"group\">\r\n								<label>Retail Shop</label>\r\n								<div class=\"bold\">Menteng Central</div>\r\n								<div>Menteng Central</div>\r\n								<div>Jl. HOS Cokroamimoto No. 80 Menteng. Jakarta Pusat 1130</div>\r\n							</div>\r\n							<div class=\"group\">\r\n								<label>Plasa Indonesia</label>\r\n								<div>Ground Floor - BGM 267 / 76 Jakarta Pusat, 11249</div>\r\n							</div>\r\n						</div>\r\n						<div class=\"desc1\">\r\n							<div class=\"group\">\r\n								<label>Cikajang</label>\r\n								<div>Jl. HOS Cokroamimoto No. 80 Menteng. Jakarta Pusat 1130</div>\r\n							</div>\r\n							<div class=\"group\">\r\n								<label>Plasa Senayan</label>\r\n								<div>Ground Floor - BGM 267 / 76 Jakarta Pusat, 11249</div>\r\n							</div>\r\n							<div class=\"group\">\r\n								<label>Grand Indoensia</label>\r\n								<div>Ground Floor - BGM 267 / 76 Jakarta Pusat, 11249</div>\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"col-md-6\">\r\n						<div class=\"map\">\r\n							\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"bg-white\">\r\n			<div class=\"container\">\r\n				<div class=\"row\">\r\n					<div class=\"title-cont\">Question Time ! <label class=\"lbl\">Shoot us with all of your question by filling this enquiry form !</label></div>\r\n					<div class=\"form-contact clearfix\">\r\n						<form>\r\n							<div class=\"contact-cont\">\r\n								<div class=\"field-cont\">\r\n									<input type=\"text\" name=\"firstname\" class=\"form-control cus-field\" placeholder=\"First Name *\" required>\r\n								</div>\r\n								<div class=\"field-cont\">\r\n									<input type=\"text\" name=\"lastname\" class=\"form-control cus-field\" placeholder=\"Last Name *\" required>\r\n								</div>\r\n								<div class=\"field-cont\">\r\n									<input type=\"email\" name=\"email\" class=\"form-control cus-field\" placeholder=\"Email *\" required>\r\n								</div>\r\n							</div>\r\n							<div class=\"contact-cont\">\r\n								<div class=\"field-cont\">\r\n									<input type=\"text\" name=\"message1\" class=\"form-control cus-field\" placeholder=\"Message\">\r\n								</div>\r\n								<div class=\"field-cont\">\r\n									<input type=\"text\" name=\"message2\" class=\"form-control cus-field\" placeholder=\"Message\">\r\n								</div>\r\n							</div>\r\n							<div class=\"clearfix\"></div>\r\n							<div class=\"div-button\">\r\n								<button class=\"btn btn-oval\">Submit</button>\r\n							</div>\r\n							<label class=\"pull-right lbl-required\">* required to fill</label>\r\n						</form>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\n	{embed=assets/footer}\r\n{js}\r\n{js}\r\n<script>\r\n// $(document).ready(function() {\r\n//     $(\'.carousel\').carousel({\r\n//       interval: 6000\r\n//     })\r\n//   });\r\n	\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n	});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(9,1,1,'contactus_success','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap.min.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/style.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/font-awesome/css/font-awesome.min.css\">\r\n	<!--[if IE]>\r\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n</head>\r\n<body>\r\n	{embed=assets/header}\n<div class=\"page\">\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content sucess\">\r\n					<div class=\"title-cont bold f42\">Thank you for your message! <label class=\"lbl f25\">Your message has been sucessfully send to us. Our respinse team will reply your question soon!</label></div>\r\n					<img src=\"{theme_url}images/contact-success.png\" class=\"img-responsive img-fix\">\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"bg-white\">\r\n			<div class=\"container\">\r\n				<div class=\"row\">\r\n					<div class=\"button-back\">\r\n						<a href=\"#\" class=\"btn btn-circle pad-hop\">Back to Shop</a>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\n	{embed=assets/footer}\r\n{js}\r\n{js}\r\n<script>\r\n// $(document).ready(function() {\r\n//     $(\'.carousel\').carousel({\r\n//       interval: 6000\r\n//     })\r\n//   });\r\n	\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n	});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(10,1,1,'facebook_module','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	{meta}\r\n        {css}\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n<div class=\"page\">\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content sucess\">\r\n					<div class=\"title-cont bold f42\">Connect your account</div>\r\n					<div class=\"text-center\"><i class=\"fa fa-facebook\"></i></div>\r\n					<div class=\"text-center\">\r\n						<p>To get started make your order you\'ll have to connect with your facebook account</p>\r\n					</div>\r\n					<div class=\"button-back marg\">\r\n						<a href=\"#\" class=\"btn btn-circle pad-hop\">Connect</a>\r\n					</div>\r\n					<div class=\"text-center\">\r\n						<p class=\"label-media\">Metadata taken from your facebook post such as hashtag, location and date will be printed on the back</p>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\r\n	{embed=assets/footer}\r\n{js}\r\n{js}\r\n<script>\r\n// $(document).ready(function() {\r\n//     $(\'.carousel\').carousel({\r\n//       interval: 6000\r\n//     })\r\n//   });\r\n\r\nfunction equalGrids(){\r\n	equalGrid = $(\'section .photoitem\').width();\r\n	$(\'section .photoitem\').height(equalGrid);\r\n	/*for footer stay on bottom*/\r\n	defContentHeight = $(window).innerHeight() - 110;\r\n	if ($(\'footer\').siblings(\'section\').height() < defContentHeight){\r\n		$(\'footer\').addClass(\'stayBottom\');\r\n	}\r\n	else if($(\'footer\').siblings(\'section\').height() > defContentHeight){\r\n		$(\'footer\').removeClass(\'stayBottom\');\r\n	}\r\n}\r\n\r\n$(window).on(\'resize\',equalGrids);\r\n	\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n		equalGrids();\r\n	});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(11,1,1,'faq','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>{site_name}</title>\r\n	{css}\r\n\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n        <div class=\"page\">\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content maxwidth8x\">\r\n					<div class=\"title-cont bold f30\">Frequently Asked Questions! <label class=\"lbl\">Below you will find answer to the most common question regarding our product and also our site</label> </div>\r\n					<div class=\"desc-content\"><img src=\"{theme_url}images/faq-1.png\" class=\"img-responsive img-centered\"></div>\r\n					<div class=\"desc-content\">\r\n						<div class=\"title-cont bold\">Why travelling print shop is so awesome?</div>\r\n						<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus dolorem vero illum consequuntur enim fugit, similique quisquam veniam temporibus minus quasi eaque ea minima laudantium. Sint rem voluptatum totam expedita!</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"bg-white\">\r\n			<div class=\"container\">\r\n				<div class=\"row\">\r\n					<div class=\"content maxwidth8x\">\r\n						<div class=\"desc-content\">\r\n							<div class=\"title-cont\">How to order from this awesome shop?</div>\r\n							<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem repellendus delectus sit eligendi, tempora blanditiis obcaecati, quam quis maxime enim distinctio esse excepturi eos quas, magni, est sint vero tenetur.</div>\r\n						</div>\r\n						<div class=\"desc-content\">\r\n							<div class=\"title-cont\"> Is there any difference between photo and paper?</div>\r\n							<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem repellendus delectus sit eligendi, tempora blanditiis obcaecati, quam quis maxime enim distinctio esse excepturi eos quas, magni, est sint vero tenetur.</div>\r\n						</div>\r\n						<div class=\"desc-content\">\r\n							<div class=\"title-cont\">How do travelling print shop ship my goods?</div>\r\n							<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem repellendus delectus sit eligendi, tempora blanditiis obcaecati, quam quis maxime enim distinctio esse excepturi eos quas, magni, est sint vero tenetur.</div>\r\n						</div>\r\n						<div class=\"img-fixed\">\r\n							<img src=\"{theme_url}images/faq-2.png\" class=\"img-responsive img-fix top-pls\">\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content maxwidth8x\">\r\n					<div class=\"desc-content padd-top\">\r\n						<div class=\"title-cont bold\">Is it possible to me to exchange my goods?</div>\r\n						<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem repellendus delectus sit eligendi, tempora blanditiis obcaecati, quam quis maxime enim distinctio esse excepturi eos quas, magni, est sint vero tenetur.</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n        </div>\r\n		</div>\r\n	{embed=assets/footer}\r\n        {js}        \r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(12,1,1,'finished_module','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	{css}\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n        <div class=\"page finished\">\r\n	<section class=\"maincontent\">\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay needreview\">\r\n                                                    <span><a href=\"#\" class=\"whit\" data-toggle=\"modal\" data-target=\"#myModal\">\r\n                                                        <img src=\"/working/1/result/draft.jpg\" style=\"width:100%;height: 100%\"/>\r\n                                                        </a>\r\n                                                    </span>\r\n                                                </div>						\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay needreview\"><span><a href=\"#\" class=\"whit\" class=\"whit\" data-toggle=\"modal\" data-target=\"#myModal\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay needreview\"><span><a href=\"#\" class=\"whit\" class=\"whit\" data-toggle=\"modal\" data-target=\"#myModal\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-2 col-sm-2 col-xs-4\">\r\n\r\n					<div class=\"photoitem\">\r\n						<div class=\"overlay hiderev\"><span><a href=\"#\" class=\"whit\">Review</a></span></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\r\n	{embed=assets/footer}\r\n	{js}\r\n	{js}\r\n	<script>\r\n	// $(document).ready(function() {\r\n	//     $(\'.carousel\').carousel({\r\n	//       interval: 6000\r\n	//     })\r\n	//   });\r\n\r\n	function equalGrids(){\r\n		equalGrid = $(\'section .photoitem\').width();\r\n		$(\'section .photoitem\').height(equalGrid);\r\n		$(\'section .photoitem > .overlay > span\').css(\'line-height\',equalGrid +\'px\');\r\n		/*for footer stay on bottom*/\r\n		defContentHeight = $(window).innerHeight() - 110;\r\n		if ($(\'footer\').siblings(\'section\').height() < defContentHeight){\r\n			$(\'footer\').addClass(\'stayBottom\');\r\n		}\r\n		else if($(\'footer\').siblings(\'section\').height() > defContentHeight){\r\n			$(\'footer\').removeClass(\'stayBottom\');\r\n		}\r\n	}\r\n\r\n	$(window).on(\'resize\',equalGrids);\r\n\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n		equalGrids();\r\n	});\r\n	</script>\r\n</body>\r\n<!-- MODAL POP-UP -->\r\n<div class=\"modal fade\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">\r\n  <div class=\"modal-dialog\" role=\"document\">\r\n    <div class=\"modal-content\">\r\n      <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\r\n      <div class=\"modal-body\">\r\n        <!-- Content Pop Up -->\r\n      </div>\r\n      <div class=\"mdl-button\"><button type=\"submit\" name=\"confm\" class=\"btn btn-modul\">Confirm</button></div>\r\n    </div>\r\n  </div>\r\n</div>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(13,1,1,'finished_payment_confirmation','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap.min.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/style.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/font-awesome/css/font-awesome.min.css\">\r\n	<!--[if IE]>\r\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n</head>\r\n<body>\r\n	{embed=assets/header}\n<div class=\"page\">\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content sucess\">\r\n					<div class=\"title-cont bold f42\">You are champ! </div>\r\n					<img src=\"{theme_url}images/finished-pay.png\" class=\"img-responsive img-centered\">\r\n					<div class=\"desc-img\">\r\n						Awesome your order is being processed and will be shipped to your soon!\r\n					</div>\r\n					<div class=\"button-back marg\">\r\n						<a href=\"#\" class=\"btn btn-circle pad-hop\">Continue Shopping</a>\r\n					</div>\r\n					<label class=\"lbl-finished\">Don\'t forget to confirm your payment if you choose bank transfer method use this <strong>Page</strong> or use the link that we sent you on your mail </label>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\n	{embed=assets/footer}\r\n{js}\r\n{js}\r\n<script>\r\n// $(document).ready(function() {\r\n//     $(\'.carousel\').carousel({\r\n//       interval: 6000\r\n//     })\r\n//   });\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n	});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(14,1,1,'instagram_upload_module','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n        {meta}\r\n        {css}\r\n        <link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/instagram.css\">\r\n        <link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/colorbox.css\">\r\n\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n        <div class=\"page instagram\">\r\n	<section class=\"maincontent\">\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n                            <input name=\"hash\" value=\"{segment_2}\"/>\r\n                            <button name=\"search\" class=\"btn btn-black\">Search</button>\r\n                            <button name=\"save\" class=\"btn btn-black\" style=\"float:right\">Save to My Collection</button>\r\n                            <form id=\"save-form\" action=\"/index.php\" method=\"POST\">\r\n                            <input type=\"hidden\" name=\"ACT\" value=\"267\" />\r\n                            <input type=\"hidden\" name=\"XID\" value=\"{XID_HASH}\" />\r\n                            <br class=\"clearfix\"/>\r\n                            {if segment_2}\r\n                                {exp:simplee_instagram:hash hash=\"{segment_2}\" limit=\"20\"}\r\n                                    <label>\r\n                                    <input type=\"checkbox\" value=\"{image}\" name=\"url[]\"  />\r\n                                    <div class=\"col-md-2 col-sm-3 col-xs-4\">\r\n                                        <div class=\"photoitem\">\r\n<!--                                            <div class=\"overlay\"><span>1x</span><a class=\"act-btn\" href=\"#\">-</a></div>-->\r\n                                            <img src=\"{image}\" class=\"img-responsive logo\"/>\r\n                                        </div>\r\n                                    </div>                                                                    \r\n                                    </label>    \r\n                                {/exp:simplee_instagram:hash}\r\n                            {if:else}\r\n                                {exp:simplee_instagram:user username=\"adorama\" limit=\"20\"}\r\n                                    <label >\r\n                                    <input type=\"checkbox\" value=\"{image}\" name=\"url[]\" />\r\n                                    <div class=\"col-md-2 col-sm-3 col-xs-4\">\r\n                                        <div class=\"photoitem\">\r\n<!--                                            <div class=\"overlay\"><span>1x</span><a class=\"act-btn\" href=\"#\">-</a></div>-->\r\n                                            <img src=\"{image}\" class=\"img-responsive logo\"/>\r\n                                        </div>\r\n                                    </div>\r\n                                    </label>\r\n                                {/exp:simplee_instagram:user}\r\n                            {/if}\r\n                            </form>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\r\n	{embed=assets/footer}\r\n        {js}\r\n<script>\r\n\r\n$(document).ready(function(){\r\n    \r\n    window.resizeTo(window.screen.width,window.screen.height);\r\n    \r\n    setTimeout(function(){\r\n        $(\'.header-top\').hide(\'fadeOut\');\r\n    },3000);\r\n    \r\n    $(\'button[name=search\').click(function(){\r\n        var url  =  \'/instagram/\' + $(\'input[name=hash]\').val();\r\n        document.location.href = url;\r\n    });\r\n    $(\'button[name=save\').click(function(){\r\n        \r\n        if ( $(\'input:checked\').length < 1) return alert(\'You dont make any selection yet\');\r\n        \r\n        $(\'#save-form\').submit();\r\n        window.opener.location.reload();\r\n        window.close();\r\n    });\r\n\r\n});\r\n    \r\n    \r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',22,'n'),(15,1,1,'login','y','webpage','{if logged_in}\n   {redirect=\"/\"}\n{/if}\n<!DOCTYPE html>\n<html>\n<head>\n	<title>{site_name}</title>\n        {css}\n	\n</head>\n<body>\n	{embed=assets/header}\n        <div class=\"page\">\n	<section class=\"container\">\n        <div class=\"container login\">\n            <div class=\"row\">\n                {exp:member:login_form return=\'{current_url}\'} \n                  <p>\n                    <label>Username</label><br>\n                    <input type=\"text\" name=\"username\" value=\"\" maxlength=\"32\" size=\"25\" style=\"border:1px solid #cbcbcb\"/>\n                  </p>\n                  <p>\n                    <label>Password</label><br>\n                    <input type=\"password\" name=\"password\" value=\"\" maxlength=\"32\" size=\"25\" style=\"border:1px solid #cbcbcb\"/>\n                  </p>\n                  {if auto_login}\n                    <p><input type=\"checkbox\" name=\"auto_login\" value=\"1\"> Auto-login on future visits</p>\n                  {/if}\n\n                  <p><input type=\"checkbox\" name=\"anon\" value=\"1\" checked=\"checked\"> Show my name in the online users list</p>\n                  <p><input type=\"submit\" name=\"submit\" value=\"Submit\"></p>\n                  <p><a href=\"{path=\'member/forgot_password\'}\">Forgot your password?</a></p>\n                {/exp:member:login_form}\n                <a href=\"/register\">Register as a new member</a>\n\n            </div>\n        </div>\n	</section>\n\n    </div>\n    {embed=assets/footer}\n    {js}\n    \n</body>\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',26,'n'),(16,1,1,'magnets_quantity','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	{css}\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n<div class=\"page\">\r\n	<section class=\"maincontent\">\r\n		<div class=\"container\">\r\n                <form action=\"/\" method=\"POST\">\r\n                    <input type=\"hidden\" name=\"XID\" value=\"{XID_HASH}\" />\r\n                    <input type=\"hidden\" name=\"ACT\" value=\"279\" />\r\n                    <input type=\"hidden\" name=\"layout_id\" value=\"{segment:layout_id}\" />\r\n                    \r\n			<div class=\"title-cont storyline\">Select a quantity</div>\r\n			<div class=\"qty-options\">\r\n				<div class=\"qty-item\" id=\"qty1\">\r\n					<div class=\"qty-number\">8</div>\r\n					<div class=\"qty-price\">IDR 50.000</div>\r\n				</div>\r\n				<div class=\"qty-item\" id=\"qty2\">\r\n					<div class=\"qty-number\">12</div>\r\n					<div class=\"qty-price\">IDR 100.000</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"button-back marg\">\r\n				<a href=\"#\" class=\"btn btn-circle pad-hop\">Next</a>\r\n			</div>\r\n                </form>\r\n		</div>\r\n	</section>\r\n\r\n{js}\r\n<script>	\r\n$(document).ready(function(){\r\n	\r\n\r\n	$(\'.qty-item\').click(function(){\r\n		$(this).addClass(\'active\');\r\n		$(\'.qty-item\').not($(this)).removeClass(\'active\');\r\n	});\r\n});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',9,'n'),(17,1,1,'order_and_shipping','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap.min.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/style.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/font-awesome/css/font-awesome.min.css\">\r\n	<!--[if IE]>\r\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n</head>\r\n<body>\r\n	{embed=assets/header}\n<div class=\"page\">\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content maxwidth8x\">\r\n					<div class=\"desc-content\">\r\n						<div class=\"title-cont bold\">Order & Shipping Information</div>\r\n						<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus dolorem vero illum consequuntur enim fugit, similique quisquam veniam temporibus minus quasi eaque ea minima laudantium. Sint rem voluptatum totam expedita!</div>\r\n					</div>\r\n					<div class=\"img-fixed\">\r\n						<img src=\"{theme_url}images/order-2.png\" class=\"img-responsive img-fix top-pls resize\">\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"bg-white\">\r\n			<div class=\"container\">\r\n				<div class=\"row\">\r\n					<div class=\"content maxwidth8x\">\r\n						<div class=\"desc-content order-marg-top\">\r\n							<div class=\"title-cont\">Receiving your order?</div>\r\n							<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem repellendus delectus sit eligendi, tempora blanditiis obcaecati, quam quis maxime enim distinctio esse excepturi eos quas, magni, est sint vero tenetur.</div>\r\n						</div>\r\n						<div class=\"img\">\r\n							<img src=\"{theme_url}images/order-3.png\" class=\"img-responsive img\">\r\n						</div>\r\n						<div class=\"desc-content\">\r\n							<div class=\"title-cont\">Confirm your payment?</div>\r\n							<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem repellendus delectus sit eligendi, tempora blanditiis obcaecati, quam quis maxime enim distinctio esse excepturi eos quas, magni, est sint vero tenetur.</div>\r\n						</div>\r\n						<div class=\"img\">\r\n							<img src=\"{theme_url}images/order-1.png\" class=\"img-responsive img\">\r\n						</div>\r\n						<div class=\"desc-content\">\r\n							<div class=\"title-cont\">Preparing your order?</div>\r\n							<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem repellendus delectus sit eligendi, tempora blanditiis obcaecati, quam quis maxime enim distinctio esse excepturi eos quas, magni, est sint vero tenetur.</div>\r\n						</div>\r\n						<div class=\"img-fixed\">\r\n							<img src=\"{theme_url}images/order-4.png\" class=\"img-responsive img-fix top-pls resize\">\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content maxwidth8x\">\r\n					<div class=\"desc-content padd-top\">\r\n						<div class=\"title-cont bold\">Is it possible to me to exchange my goods?</div>\r\n						<div class=\"desc\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem repellendus delectus sit eligendi, tempora blanditiis obcaecati, quam quis maxime enim distinctio esse excepturi eos quas, magni, est sint vero tenetur.</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\n	{embed=assets/footer}\r\n{js}\r\n{js}\r\n<script>\r\n// $(document).ready(function() {\r\n//     $(\'.carousel\').carousel({\r\n//       interval: 6000\r\n//     })\r\n//   });\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n	});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',1,'n'),(19,1,1,'payment_confirmation','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	<meta name=\"viewport\" content=\"width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=no\" />\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap.min.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/style.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap-datepicker.min.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/font-awesome/css/font-awesome.min.css\">\r\n	<!--[if IE]>\r\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n<div class=\"page\">\r\n	<section class=\"min-height\">\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"title-cont paddtop65\">Confirm Payment  <label class=\"lbl\">Confirm the payment you made using this form and we will get back to you</label></div>\r\n				<div class=\"form-contact clearfix\">\r\n					<form>\r\n						<div class=\"contact-cont\">\r\n							<div class=\"field-cont\">\r\n								<input type=\"email\" name=\"email\" class=\"form-control cus-field\" placeholder=\"Email Address *\" required>\r\n							</div>\r\n							<div class=\"field-cont\">\r\n								<input type=\"text\" name=\"order\" class=\"form-control cus-field\" placeholder=\"Order id *\" required>\r\n							</div>\r\n							<div class=\"field-cont\">\r\n								<select class=\"form-control cus-field\" required>\r\n									<option value=\"\" selected>Payment made to * </option>\r\n									<option value=\"123\">123</option>\r\n								</select>\r\n							</div>\r\n						</div>\r\n						<div class=\"contact-cont\">\r\n							<div class=\"field-cont\">\r\n								<input type=\"text\" name=\"acountname\" class=\"form-control cus-field\" placeholder=\"Account holder name * \" required>\r\n							</div>\r\n							<div class=\"field-cont\">\r\n								<input type=\"text\" name=\"acountnum\" class=\"form-control cus-field\" placeholder=\"Account Number * \" required>\r\n							</div>\r\n							<div class=\"field-cont\">\r\n								<input type=\"text\" name=\"transferdate\" class=\"form-control cus-field\" id=\"date\" placeholder=\"Transferdate\" readonly required>\r\n							</div>\r\n						</div>\r\n						<div class=\"clearfix\"></div>\r\n						<div class=\"div-button\">\r\n							<a href=\"/payment/success\" class=\"btn btn-oval\">Submit</a>\r\n						</div>\r\n						<label class=\"pull-right lbl-required\">* required to fill</label>\r\n					</form>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\r\n	{embed=assets/footer}\r\n{js}\r\n{js}\r\n{js}\r\n<script>\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n		$(\'#date\').datepicker();\r\n	});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',6,'n'),(20,1,1,'payment_confirmation_success','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	{css}\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n<div class=\"page\">\r\n	<section>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content sucess\">\r\n					<div class=\"title-cont bold f42\">Thank you for your confirmation! <label class=\"lbl f25\">Your payment confirmation has been succesfully submite. our team will asses it soon and let you know when your item are ready to ship!</label></div>\r\n					<div class=\"img-mintop\">\r\n						<img src=\"{theme_url}images/paymen-success.png\" class=\"img-responsive img-fix min-wid\">\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n	<section>\r\n		<div class=\"bg-white\">\r\n			<div class=\"container\">\r\n				<div class=\"row\">\r\n					<div class=\"button-back\">\r\n						<a href=\"/\" class=\"btn btn-circle pad-hop\" style=\"margin-left:0px;\">Back to Shop</a>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\r\n	{embed=assets/footer}\r\n        {js}\r\n\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(22,1,1,'photobook_instagram_module','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap.min.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/style.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/font-awesome/css/font-awesome.min.css\">\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"fonts_/stylesheet.css\">\r\n	<!--[if IE]>\r\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n<div class=\"page\">\r\n	<section class=\"min-height2\">\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content sucess\">\r\n					<div class=\"title-cont bold\">Connect your account</div>\r\n					<div class=\"text-center\">\r\n						<i class=\"fa fa-instagram\" style=\"font-size:100pt\"></i>\r\n					</div>\r\n					<div class=\"text-center\">\r\n						To get started make your order you\'ll have to connect with your instagram account\r\n					</div>\r\n					<div class=\"button-back marg\">\r\n						<a href=\"#\" class=\"btn btn-circle pad-hop\" style=\"margin-left:0px\">Connect</a>\r\n					</div>\r\n					<p class=\"text-center\">Metadata taken from your instagram post such as hastag, location and date will be printed on back</p>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n		</div>\r\n	{embed=assets/footer}\r\n{js}\r\n{js}\r\n<script>\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n	});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(23,1,1,'photobook_rearrange','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n	{meta}\r\n        {css}\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n        <div class=\"page\">\r\n	<section class=\"maincontent\" id=\"upload\">\r\n		<div class=\"container pre-settings\">\r\n                    <form action=\'/\' method=\'POST\'>\r\n                        <input type=\"hidden\" name=\'ACT\' value=\'271\'/>\r\n                        <input type=\"hidden\" name=\'XID\' value=\"{XID_HASH}\"/>\r\n                        <input type=\"hidden\" name=\'layout_id\' value=\"{exp:session_variables:get name=\'layout_id\'}\"/>\r\n                        <input type=\"hidden\" name=\'owner_id\' value=\"{exp:session_variables:get name=\'owner_id\'}\"/>\r\n			<div class=\"row\">\r\n				<div class=\"col-md-4 cover-selector\">\r\n					<div class=\"title-cont storyline\">Cover Selector</div>\r\n                                        <div class=\"selected-cover\" style=\"height: 303px;\">\r\n                                            <img src=\"\"/>\r\n                                        </div>\r\n					<br>\r\n					<label class=\"lbl-cover\">Click <i class=\"fa fa-star\"></i> on thumbnail to select your cover</label>\r\n					<a class=\"btn btn-rounded randomize\" >Randomizer !</a>\r\n					<div class=\"book-title\">\r\n						<div class=\"title-cont storyline\">Book Title</div>\r\n						<div class=\"b-title\">Test Title</div>\r\n						<input type=\"text\" class=\"form-control cus-field fl-top\" name=\"book_t\" placeholder=\"Type your title here *\" required>\r\n					</div>\r\n                                        <button class=\"btn btn-rounded\" name=\"continue\" value=\"1\">Print it!</button>\r\n\r\n				</div>\r\n				<div class=\"col-md-8\">\r\n					<div class=\"box-margleft\">\r\n						<div class=\"title-cont storyline\" style=\"margin-left: 9px;\">Reorder or delete selected photo</div>\r\n						<div class=\"rearange-box layout layout_1\"> \r\n                                                    <ul class=\'files \'>\r\n                                                    {exp:query sql=\"SELECT file FROM exp_photoprints WHERE owner_id = ? AND  layout_id = ? ORDER BY sequence \" params=\"{segment:owner_id},{segment:layout_id}\" }\r\n							{if no_results}\r\n                                                            <div>You haven\'t select any file yet,\r\n                                                                <p>Please click <a href=\"/upload/\">here</a> to select your files</p>    \r\n                                                            </div>\r\n                                                        {/if}\r\n                                                        <li class=\"tmpl sel-file ui-state-default\" data-pos=\"{count}\">\r\n                                                            <label>\r\n                                                            <input type=\'radio\' name=\'cover\' value=\"{file}\"/>\r\n                                                            <img src=\"{file}\" class=\"selected-img\"/>\r\n                                                            <input type=\'hidden\' name=\'position[{count}]\' value=\'{file}\' />\r\n                                                            </label>\r\n                                                        </li>\r\n                                                        \r\n                                                        {if count % 10 == 0 && segment:layout_id == 2}\r\n                                                            <li class=\"tmpl filler2\"/>\r\n                                                        {/if}\r\n                                                    {/exp:query}\r\n                                                    </ul>\r\n                                                    \r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n                    </form>\r\n		</div>\r\n	</section>\r\n        </div>\r\n{embed=assets/footer}\r\n{js}\r\n<script type=\"text/javascript\" src=\"{theme_url}js/jquery.gridster.min.js\"></script>\r\n<script>\r\n$(document).ready(function(){\r\n    $.fn.random = function() {\r\n      return this.eq(Math.floor(Math.random() * this.length));\r\n    }; \r\n    \r\n    $(\'.files .tmpl:nth-child(n+23)\').remove();\r\n    \r\n    function remap(ev,el){\r\n        $(\'.files li.sel-file\').removeAttr(\'style\');\r\n        $(\'.files .filler2\').remove();\r\n        $(\'.files .sel-shadow\').remove();\r\n        $(\'.files li.sel-file\').each(function(i,el){\r\n            $(\'input[type=hidden]\',el).attr(\'name\',\'position[\'+ (i+1) + \']\');\r\n            $(el).attr(\'data-pos\',(i+1));\r\n        });\r\n        $(\'.layout_1 .files .sel-file:nth-child(10)\').after(\'<li class=\"tmpl filler2\">\');\r\n        $(\'.layout_1 .files .sel-file:nth-child(21)\').after(\'<li class=\"tmpl filler2\">\');\r\n    };\r\n    \r\n    var count  = $(\'.files li.sel-file\').length / 2;    \r\n    function randomize(from){\r\n        var files = $(\'.files li.sel-file\');                \r\n        var t = Math.floor(Math.random() * (files.length -2)+1 );\r\n            console.log(count);\r\n            var to =   $(files.eq(t)) ;\r\n            if (to.index()== from.index()) {\r\n                return randomize(files.random());\r\n            }\r\n            var temp = $(\'<li class=\"tmpl sel-shadow\">\').insertAfter(from);\r\n            from.css({\'top\':from.offset().top ,\'left\':from.offset().left}).addClass(\'moving\');\r\n            from.animate({top:to.offset().top  , left:to.offset().left },                    \r\n                    \'slow\',\r\n                    function(){\r\n                        from.detach().insertAfter(to).removeClass(\'moving\').removeAttr(\'style\');\r\n                        temp.remove();                                                            \r\n                        var f = files.random();\r\n                        if (!count) {\r\n                            remap();                            \r\n                            return;\r\n                        }\r\n                        randomize(f);\r\n                        count--;\r\n                    }                \r\n            );\r\n            \r\n        \r\n        return false;\r\n    }\r\n    \r\n    \r\n    \r\n    $(\'.randomize\').click(function(){randomize($(\'.files li.sel-file\').random());});\r\n    \r\n    \r\n    \r\n    $(\'ul.files\').sortable({\r\n            \'placeholder\': \"tmpl sel-shadow\",\r\n//            grid : [130,130],\r\n//            forcePlaceholderSize: true,\r\n            \'stop\':function(ev,ui){\r\n                remap(ev,this);\r\n            },\r\n    }).disableSelection();    \r\n    \r\n    $(\'input[name=cover]\').change(function(){\r\n        $(\'.selected-cover img\').attr(\'src\',$(this).val());\r\n        \r\n    });\r\n    \r\n    $(\'.selected-cover img\').attr(\'src\',$(\'.files .sel-file input[name=cover]\').eq(0).val());\r\n});\r\n\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',199,'n'),(24,1,1,'photobook_size','y','webpage','<!DOCTYPE html>\n<html>\n<head>\n	<title>PrintShop Adorama</title>\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.min.css\"/>\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\"/>	\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/font-awesome/css/font-awesome.min.css\"/>\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"fonts/stylesheet.css\">\n	<!--[if IE]>\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\n    <![endif]-->\n</head>\n<body>\n	<header>\n		<div class=\"header-menu\">\n			<nav class=\"navbar navbar-default menu-white\">\n				<div class=\"container\">\n					<div class=\"navbar-header\">\n						<a class=\"navbar-brand logo\" href=\"#\"><img src=\"images/logo2.png\" class=\"img-responsive logo\"></a>\n						<span class=\"navbar-title\">Photo Prints</span>\n					</div>\n				</div>\n			</nav>\n		</div>\n	</header>\n	<section class=\"min-height\">\n		<div class=\"container\">\n			<div class=\"row\">\n				<div class=\"content sucess\">\n					<div class=\"title-cont storyline\">Select a Size</div>\n					<div class=\"border-style\">\n						<div class=\"qty-options\">\n							<div class=\"qty-item\" id=\"qty1\">\n								<div class=\"border-indside\"></div>\n								<div class=\"qty-number box-round box-cus-width\">S</div>\n								<div class=\"qty-price\">\n									<label class=\"lbl-size\">Small</label>\n									<label class=\"lbl-size\">20cm x 20cm</label>\n									<label class=\"lbl-size\">15 Pages</label>\n								</div>\n								<label>IDR 50.000</label>\n							</div>\n							<div class=\"qty-item\" id=\"qty2\">\n								<div class=\"border-indside\"></div>\n								<div class=\"qty-number box-round box-cus-width\">M</div>\n								<div class=\"qty-price\">\n									<label class=\"lbl-size\">Medium</label>\n									<label class=\"lbl-size\">20cm x 20cm</label>\n									<label class=\"lbl-size\">15 Pages</label>\n								</div>\n								<label>IDR 100.000</label>\n							</div>\n						</div>\n					</div>\n					<div class=\"button-back marg\">\n						<a href=\"photoprint_quantity.html\" class=\"btn btn-black\" style=\"padding:10px 45px\">Next</a>\n					</div>\n				</div>\n			</div>\n		</div>\n	</section>\n	<script type=\"text/javascript\" src=\"js/jquery-1.11.3.min.js\"></script>\n<script type=\"text/javascript\" src=\"js/bootstrap.min.js\"></script>\n<script>\n	$(document).ready(function(){\n		$(\'#sh-foot\').click(function(e){\n			$(\'.footer-toggle\').slideToggle();\n			\n			if($(this).hasClass(\'up\')){\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\n			}else{\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\n			}\n			$(\'html, body\').animate({\n	           scrollTop: $(document).height()\n	        }, 2000);\n			e.preventDefault();\n		});\n	});\n	$(\'.qty-item\').click(function(){\n		$(this).addClass(\'active\');\n		$(\'.qty-item\').not($(this)).removeClass(\'active\');\n	});\n</script>\n</body>\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',37,'n'),(25,1,1,'photoprint_border','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n        {meta}\r\n        {css}\r\n\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n        <div class=\"page border\">\r\n	<section class=\"min-height\">\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content sucess\">\r\n                                    <form action=\"/\" method=\"POST\">\r\n                                        <input type=\"hidden\" name=\"XID\" value=\"{XID_HASH}\" />\r\n                                        <input type=\"hidden\" name=\"ACT\" value=\"276\" />\r\n                                            \r\n					<div class=\"title-cont bold f42\">Select border style</div>\r\n					<div class=\"border-style\">\r\n                                            <div class=\"qty-options\">\r\n                                                <label class=\"qty-item\" id=\"qty1\">\r\n                                                    <input type=\'radio\' name=\"border\"  value=\"10\"/>\r\n                                                    <div class=\"box-border\">\r\n                                                            <div class=\"border-item\"></div>\r\n                                                    </div>\r\n                                                    <div class=\"qty-price\">\r\n                                                            <label class=\"lbl-size\">10 x 10 cm</label>\r\n                                                    </div>                                                    \r\n                                                </label>\r\n                                            \r\n                                                <label class=\"qty-item\" id=\"qty2\">\r\n                                                    <input type=\'radio\' name=\"border\" value=\"12\"/>\r\n                                                    <div class=\"box-border itm2\">\r\n                                                            <div class=\"border-item itm2-border\"></div>\r\n                                                    </div>\r\n                                                    <div class=\"qty-price\">\r\n                                                            <label class=\"lbl-size\">10 x 12 cm</label>\r\n                                                    </div>                                                \r\n                                                </label>\r\n                                            </div>\r\n					</div>\r\n					<div class=\"button-back marg\">\r\n						<button class=\"btn btn-black\" style=\"padding:10px 45px\">Next</button>\r\n					</div>\r\n                                        </form>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n{js}\r\n<script>\r\n	$(document).ready(function(){\r\n		$(\'#sh-foot\').click(function(e){\r\n			$(\'.footer-toggle\').slideToggle();\r\n			\r\n			if($(this).hasClass(\'up\')){\r\n				$(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n			}else{\r\n				$(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n			}\r\n			$(\'html, body\').animate({\r\n	           scrollTop: $(document).height()\r\n	        }, 2000);\r\n			e.preventDefault();\r\n		});\r\n	});\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',51,'n'),(26,1,1,'photoprint_info','y','webpage','<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>PrintShop Adorama</title>\r\n        {meta}\r\n        {css}\r\n        <link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/flexslider.css\">\r\n    </head>\r\n    <body>\r\n{embed=assets/header}\r\n    <div class=\"page photoprint-info\">   \r\n        <section>\r\n            <div class=\"banner\">\r\n                <div class=\"slider\" >\r\n                    <div class=\"photoprint\">\r\n                        <ul class=\"slides\">\r\n                            <li>\r\n                                <div class=\"slider_img\"> <img alt=\"alt\"  src=\"{theme_url}images/temp.jpg\" > </div>\r\n                                <div class=\"slider_desc\">\r\n                                    <h1>Photo Prints</h1>\r\n                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident necessitatibus, expedita, odit et quisquam consequatur, quis delectus, obcaecati commodi eveniet omnis repudiandae autem! Reiciendis tempora ut in, aut consequuntur autem.</p>\r\n                                    <div class=\"slider_info\">\r\n                                        <div class=\"pricing\">Start from IDR 20.000</div>\r\n                                        <a class=\"btn btn-circle\" href=\"/index.php?ACT=68&product_id=2&XID={XID_HASH}\">Let\'s Create!</a>\r\n                                    </div>\r\n                                </div>\r\n                            </li>\r\n                            <li>\r\n                                <div class=\"slider_img\"> <img alt=\"alt\"  src=\"{theme_url}images/temp.jpg\" > </div>\r\n                                <div class=\"slider_desc\">\r\n                                    <h1>Photo Prints</h1>\r\n                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident necessitatibus, expedita, odit et quisquam consequatur, quis delectus, obcaecati commodi eveniet omnis repudiandae autem! Reiciendis tempora ut in, aut consequuntur autem.</p>\r\n                                    <div class=\"slider_info\">\r\n                                        <div class=\"pricing\">Start from IDR 20.000</div>\r\n                                        <a class=\"btn btn-circle\" href=\"/index.php?ACT=68&product_id=2&XID={XID_HASH}\">Let\'s Create!</a>\r\n                                    </div>\r\n                                </div>\r\n                            </li>\r\n                        </ul>\r\n                        <div class=\"slider_nav_container\"></div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        <section>\r\n            <div class=\"bg-white\">\r\n                <div class=\"container\">\r\n                    <div class=\"row\">\r\n                        <div class=\"title-cont\">What people share <label class=\"lbl\">What people says at #travellingprintshop</label></div>\r\n                        <div class=\"share-box clearfix\">\r\n                            <div class=\"col-md-12 col-centered\">\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        <section>\r\n        <div class=\"bg-white\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"title-cont\">You might also like this !</div>\r\n                    <div class=\"share-box clearfix\">\r\n                        <div class=\"col-md-12 col-centered\">\r\n                            <div class=\"share-item2\"></div>\r\n                            <div class=\"share-item2\"></div>\r\n                            <div class=\"share-item2\"></div>\r\n                            <div class=\"share-item2\"></div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        </section>\r\n         <section>\r\n        <div class=\"bg-white\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"title-cont bold\">Only good news come to your mail! <label class=\"lbl\">Enter your mail and we will keep you posted on any news or promotions</label></div>\r\n                    <div class=\"form-subscribe\">\r\n                        <div class=\"input-group\">\r\n                            <form>\r\n                                <input type=\"email\" class=\"form-control sub-field\" placeholder=\"Email Address\">\r\n                                <span class=\"input-group-btn sub-group\">\r\n                                    <button class=\"btn btn-default sub-button\" type=\"button\">Submit</button>\r\n                                </span>\r\n                            </form>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </section>\r\n</div>\r\n{embed=assets/footer}\r\n{js}\r\n<script type=\"text/javascript\" src=\"{theme_url}js/flexslider.min.js\"></script>\r\n<script>\r\n    $(document).ready(function() {\r\n        $(\'.photoprint\').flexslider({\r\n            animation: \"slide\",\r\n            controlsContainer: $(\".slider_nav_container\"),\r\n        });\r\n    });\r\n</script>\r\n</body>\r\n</html>','',1444825357,1,'n',0,'','n','y','o',57,'n'),(27,1,1,'photoprint_quantity','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>PrintShop Adorama</title>\r\n        {css}\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n<div class=\"page\">\r\n	<section class=\"min-height\">\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"content sucess\">\r\n                                    <form action=\"/\" method=\"POST\">\r\n                                        <input type=\"hidden\" name=\"XID\" value=\"{XID_HASH}\" />\r\n                                        <input type=\"hidden\" name=\"ACT\" value=\"278\" />\r\n					<div class=\"title-cont bold f42\">Select a quantity</div>\r\n					<div class=\"border-style\">\r\n                                            <div class=\"qty-options\">\r\n                                                <label class=\"qty-item\" id=\"qty1\">\r\n                                                <input type=\'radio\' name=\"quantity\" value=\"8\"/>\r\n                                                    <div class=\"qty-number box-round\">8</div>\r\n                                                    <div class=\"qty-price\">\r\n                                                            <label class=\"lbl-size\">IDR 20.000</label>\r\n                                                    </div>						\r\n                                                </label>\r\n                                                <label class=\"qty-item\" id=\"qty2\">\r\n                                                    <div class=\"border1\"></div>\r\n                                                    <input type=\'radio\' name=\"quantity\" style=\"display:none\" value=\"16\"/>\r\n                                                    <div class=\"qty-number box-round\">16</div>\r\n                                                    <div class=\"qty-price\">\r\n                                                            <label class=\"lbl-size\">IDR 50.000</label>\r\n                                                    </div>\r\n						\r\n                                                </label>\r\n                                                <label class=\"qty-item\" id=\"qty3\">\r\n                                                    <div class=\"border1\"></div>\r\n                                                    <div class=\"border2\"></div>                                                    \r\n                                                    <input type=\'radio\' name=\"quantity\" style=\"display:none\" value=\"24\"/>\r\n                                                    <div class=\"qty-number box-round\">24</div>\r\n                                                    <div class=\"qty-price\">\r\n                                                            <label class=\"lbl-size\">IDR 60.000</label>\r\n                                                    </div>\r\n                                                </label>\r\n                                            </div>\r\n					</div>\r\n					<div class=\"button-back marg\">\r\n						<button class=\"btn btn-black\" style=\"padding:10px 45px\">Next</button>\r\n					</div>\r\n                                    </form>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</section>\r\n    {embed=assets/footer}\r\n{js}\r\n<script>\r\n\r\n$(document).ready(function(){\r\n    \r\n});\r\n\r\n</script>\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',54,'n'),(28,1,1,'product','y','webpage','<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>PrintShop Adorama</title>\r\n        {css}\r\n    </head>\r\n    <body>\r\n        {embed=assets/header}\r\n<div class=\"page\">\r\n        <section>\r\n            <div class=\"banner\">\r\n                <div class=\"slider\" >\r\n                    <div class=\"photoprint\">\r\n                        <ul class=\"slides\">\r\n                            <li>\r\n                                <div class=\"slider_img\"> <img alt=\"alt\"  src=\"{theme_url}images/temp.jpg\" > </div>\r\n                                <div class=\"slider_desc\">\r\n                                    <h1>Photo Prints</h1>\r\n                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident necessitatibus, expedita, odit et quisquam consequatur, quis delectus, obcaecati commodi eveniet omnis repudiandae autem! Reiciendis tempora ut in, aut consequuntur autem.</p>\r\n                                    <div class=\"slider_info\">\r\n                                        <div class=\"pricing\">Start from IDR 20.000</div>\r\n                                        <a class=\"btn btn-circle\" href=\"/photoprint/border/2\">Let\'s Create</a>\r\n                                    </div>\r\n                                </div>\r\n                            </li>\r\n                            <li>\r\n                                <div class=\"slider_img\"> <img alt=\"alt\"  src=\"{theme_url}images/temp.jpg\" > </div>\r\n                                <div class=\"slider_desc\">\r\n                                    <h1>Photo Prints</h1>\r\n                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident necessitatibus, expedita, odit et quisquam consequatur, quis delectus, obcaecati commodi eveniet omnis repudiandae autem! Reiciendis tempora ut in, aut consequuntur autem.</p>\r\n                                    <div class=\"slider_info\">\r\n                                        <div class=\"pricing\">Start from IDR 20.000</div>\r\n                                        <a class=\"btn btn-circle\" href=\"/photoprint/border/2\">Let\'s Create</a>\r\n                                    </div>\r\n                                </div>\r\n                            </li>\r\n                        </ul>\r\n                        <div class=\"slider_nav_container\"></div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        <section>\r\n            <div class=\"bg-white\">\r\n                <div class=\"container\">\r\n                    <div class=\"row\">\r\n                        <div class=\"title-cont\">What people share <label class=\"lbl\">What people says at #travellingprintshop</label></div>\r\n                        <div class=\"share-box clearfix\">\r\n                            <div class=\"col-md-12 col-centered\">\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        <section>\r\n        <div class=\"bg-white\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"title-cont\">You might also like this !</div>\r\n                    <div class=\"share-box clearfix\">\r\n                        <div class=\"col-md-12 col-centered\">\r\n                            <div class=\"share-item2\"></div>\r\n                            <div class=\"share-item2\"></div>\r\n                            <div class=\"share-item2\"></div>\r\n                            <div class=\"share-item2\"></div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        </section>\r\n         <section>\r\n        <div class=\"bg-white\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"title-cont bold\">Only good news come to your mail! <label class=\"lbl\">Enter your mail and we will keep you posted on any news or promotions</label></div>\r\n                    <div class=\"form-subscribe\">\r\n                        <div class=\"input-group\">\r\n                            <form>\r\n                                <input type=\"email\" class=\"form-control sub-field\" placeholder=\"Email Address\">\r\n                                <span class=\"input-group-btn sub-group\">\r\n                                    <button class=\"btn btn-default sub-button\" type=\"button\">Submit</button>\r\n                                </span>\r\n                            </form>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </section>\r\n    	</div>\r\n	{embed=assets/footer}\r\n    {js}\r\n    {js}\r\n    <script type=\"text/javascript\" src=\"{theme_url}js/flexslider.min.js\"></script>\r\n    <script>\r\n    $(document).ready(function() {\r\n        $(\'#sh-foot\').click(function(e){\r\n            $(\'.footer-toggle\').slideToggle();\r\n            if($(this).hasClass(\'up\')){\r\n                $(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n            }else{\r\n                $(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n            }\r\n            $(\'html, body\').animate({\r\n               scrollTop: $(document).height()\r\n            }, 2000);\r\n            e.preventDefault();\r\n        });\r\n        $(\'.photoprint\').flexslider({\r\n            animation: \"slide\",\r\n            controlsContainer: $(\".slider_nav_container\"),\r\n        });\r\n    });\r\n    </script>\r\n    </body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(29,1,1,'products','y','webpage','<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>PrintShop Adorama</title>\r\n        {css}\r\n        <!--[if IE]>\r\n        <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n        <![endif]-->\r\n    </head>\r\n    <body>\r\n         {embed=assets/header}\r\n        <div class=\"page\">\r\n        {shop_filter}\r\n\r\n        <section class=\"bg-white\">\r\n            <div class=\"container\" style=\"padding-top: 13px;\">\r\n                <div class=\"row\">\r\n                    <div class=\"feature clearfix\">\r\n                        <div class=\"col-md-12 col-centered\">\r\n                            {exp:brilliant_retail:product product_id=1}\r\n                            <div>\r\n                               {price_html}\r\n                               <label>{title}</label>\r\n                               <label>Quantity</label>         \r\n                               {quantity_select}\r\n                               <input type=\"submit\" value=\"Add to cart\"/>\r\n                            </div>\r\n                            {/exp:brilliant_retail:product}\r\n\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        <section>\r\n            <div class=\"bg-white\">\r\n                <div class=\"container\">\r\n                    <div class=\"row\">\r\n                        <div class=\"title-cont\">What people share <label class=\"lbl\">What people says at #travellingprintshop</label></div>\r\n                        <div class=\"share-box clearfix\">\r\n                            <div class=\"col-md-12 col-centered\">\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                                <div class=\"share-item\"></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        <section>\r\n            <div class=\"bg-white\">\r\n                <div class=\"container\">\r\n                    <div class=\"row\">\r\n                        <div class=\"title-cont bold\">Only good news come to your mail! <label class=\"lbl\">Enter your mail and we will keep you posted on any news or promotions</label></div>\r\n                        <div class=\"form-subscribe\">\r\n                            <div class=\"input-group\">\r\n                                <form>\r\n                                    <input type=\"email\" class=\"form-control sub-field\" placeholder=\"Email Address\">\r\n                                    <span class=\"input-group-btn sub-group\">\r\n                                    <button class=\"btn btn-default sub-button\" type=\"button\">Submit</button>\r\n                                    </span>\r\n                                </form>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        	</div>\r\n	{embed=assets/footer}\r\n    {js}\r\n    {js}\r\n    <script>\r\n    $(document).ready(function(){\r\n        $(\'#sh-foot\').click(function(e){\r\n            $(\'.footer-toggle\').slideToggle();\r\n            if($(this).hasClass(\'up\')){\r\n                $(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\r\n            }else{\r\n                $(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\r\n            }\r\n            $(\'html, body\').animate({\r\n               scrollTop: $(document).height()\r\n            }, 2000);\r\n            e.preventDefault();\r\n        });\r\n    });\r\n    </script>\r\n    </body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(30,1,1,'register','y','webpage','<!DOCTYPE html>\n<html>\n<head>\n	<title>{site_name}</title>\n        {css}\n	\n</head>\n<body>\n	{embed=assets/header}\n        <div class=\"page register\">\n	<section class=\"container\">\n        <div class=\"container register\">\n            <div class=\"row\">\n                <form id=\"register_member_form\" method=\"post\" action=\"http://adorama/index.php\">\n                    <div class=\"hiddenFields\">\n                    <input type=\"hidden\" name=\"ACT\" value=\"12\">\n                    <input type=\"hidden\" name=\"RET\" value=\"<?=$_SESSION[\'return_page\']?>\">\n                    <input type=\"hidden\" name=\"FROM\" value=\"\">\n                    <input type=\"hidden\" name=\"site_id\" value=\"1\">\n                    <input type=\"hidden\" name=\"csrf_token\" value=\"5ed1bc36e516e007a0e93668fa1725ba7bb1c9fe\">\n                    </div>\n                <div class=\"regis-form\">\n                    <div class=\'regis-field\'>\n                    <label for=\"username\">User name</label>\n                    <input name=\"username\" id=\"username\" value=\"<?=$_SESSION[\'username\']?>\" />\n                    </div>\n                    <div class=\'regis-field\'>\n                    <label for=\"email\">Email</label>\n                    <input name=\"email\" id=\"email\" value=\"<?=$_SESSION[\'email\']?>\" placeholder=\"Enter valid email address as contact\"/>\n                    </div>\n\n                    \n                    \n                    <div class=\'regis-field\'>\n                    <label for=\"firstname\">Screen name </label>\n                        <input name=\"firstname\" id=\"firstname\" value=\"<?=$_SESSION[\'firstname\']?>\" placeholder=\"First name\" class=\"inline in-left\"/>\n                        <input name=\"lastname\" id=\"lastname\" value=\"<?=$_SESSION[\'lastname\']?>\" placeholder=\"Last name\" class=\"inline in-right\"/>\n                    </div>\n                    \n                    <div class=\'regis-field\'>\n                    <label for=\"password\">Password</label>\n                    <input type=\"password\" placeholder=\"type your password\" name=\"password\" id=\"password\" value=\"<?=$_SESSION[\'password\']?>\" />\n\n                    \n                    <input type=\"password\" placeholder=\"confirm your password\" name=\"password_confirm\" id=\"lastname\" value=\"<?=$_SESSION[\'password\']?>\"/>\n                    </div>\n                    \n                    \n                    <div class=\'regis-field\'>\n                    <label for=\"agreement\">I\'m agree with the agreement terms</label>\n                    <input type=\"checkbox\" name=\"accept_terms\" id=\"agreement\" value=\"y\" />\n                    </div>\n                    \n                    <button value=\'register\' string=\'Register\' >Register</button>\n                    \n                </div>\n                </form>\n            </div>\n        </div>\n	</section>\n\n    </div>\n    {embed=assets/footer}\n    {js}    \n</body>\n</html>','',1445355538,1,'n',0,'','n','y','o',5,'n'),(31,1,1,'checkout','y','webpage','<!DOCTYPE html>\n<html>\n<head>\n    <title>PrintShop Adorama</title>\n    {meta}\n    {css}\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/bootstrap-datepicker.min.css\"/>\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/font-awesome/css/font-awesome.min.css\"/>\n</head>\n<body>\n   {embed=assets/header}\n    <div class=\"page\">\n        {exp:brilliant_retail:checkout_form}\n        {form_open}\n        <input type=\"hidden\" name=\"br_billing_country\" value=\"ID\" />\n        <input type=\"hidden\" name=\"br_shipping_country\" value=\"ID\" />\n        <section>\n            <div class=\"container\">\n                <div class=\"row\">\n                    <div class=\"form-review\">\n                        <h3 class=\"mb40\">Review & Pay</h3>\n                        {if \'{exp:brilliant_retail:message_exists}\'}\n                            <div class=\"alert alert-warning\">\n                                {exp:brilliant_retail:show_message}\n                            </div>\n                        {/if}\n                        <div class=\"input-group\">\n                                <input type=\"email\" name=\"email\" class=\"form-control sub-field\" placeholder=\"Email Address\">\n                                <span class=\"input-group-btn sub-group\">\n                                <button class=\"btn btn-default sub-button\" style=\"margin-top: 0px\" type=\"button\">Submit</button>\n                                </span>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </section>\n        <section>            \n                <div class=\"container bg-white\">\n                    <div class=\"row\">\n                        <div class=\"form-contact clearfix\">\n                            <h3 class=\"mb40\">Billing Address</h3>                            \n                                <div class=\"contact-cont\">\n                                    <div class=\"field-cont\">\n                                        <input	class=\"txtinp required form-control cus-field\" \n	                    		name=\"br_billing_fname\"  placeholder=\"Firstname *\" required\n	                    		value=\"{exp:member:custom_profile_data}{br_billing_fname}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                                    </div>\n                                    <div class=\"field-cont\">\n                                        <input	class=\"txtinp required form-control cus-field\" \n	                    		name=\"br_billing_lname\"  placeholder=\"Lastname *\" required\n	                    		value=\"{exp:member:custom_profile_data}{br_billing_lname}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                                    </div>\n                                    <div class=\"field-cont\">\n                                        <input	class=\"txtinp required form-control cus-field\" \n	                    		name=\"br_billing_phone\"  placeholder=\"Billing Phone number *\" required\n	                    		value=\"{exp:member:custom_profile_data}{br_billing_phone}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                                    </div>\n                                </div>\n                                <div class=\"contact-cont\">\n                                    <div class=\"field-cont\">\n                                        <input	class=\"txtinp required form-control cus-field\" \n	                    		name=\"br_billing_address1\"  placeholder=\"Billing Street Address *\" required\n	                    		value=\"{exp:member:custom_profile_data}{br_billing_address1}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                                        <input	class=\"txtinp form-control cus-field\" style=\"margin-top: 16px\"\n	                    		name=\"br_billing_address2\" \n	                    		value=\"{exp:member:custom_profile_data}{br_billing_address2}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                                    </div>\n                                    <div class=\"field-cont\" style=\"display: inline-block;width: calc(100% - 120px);float:left;margin-right: 10px;\">\n                                        <input	class=\"txtinp required form-control cus-field\" style=\"\"\n	                    		name=\"br_billing_city\"  placeholder=\"Billing City *\" \n	                    		value=\"{exp:member:custom_profile_data}{br_billing_city}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                                    </div>\n                                    <div class=\"field-cont\" style=\"width:100px;display: inline-block\">\n                                        <input	class=\"txtinp  form-control cus-field\" \n	                    		name=\"br_billing_zip\"  placeholder=\"Post Code *\" \n	                    		value=\"{exp:member:custom_profile_data}{br_billing_zip}{/exp:member:custom_profile_data}\" type=\"text\" />\n                                        <input name=\"br_billing_country\" value=\"ID\" type=\"hidden\"/>\n                                    </div>\n                                    <div class=\"field-cont\">\n                                        <input type=\"checkbox\" name=\"gift\" id=\"gift\" onchange=\"$(\'#ship_same_address\').val(!$(this).is(\':checked\'));$(\'#shipping_address_section\').toggle($(this).val())\"/> Send as a gift ?\n                                        <input type=\"hidden\" name=\"ship_same_address\" id=\"ship_same_address\"/>\n                                    </div>\n\n                                </div>\n                        </div>\n                    </div>\n                </div>            \n        </section>\n        <section id=\"shipping_address_section\" style=\"display:none\">\n            <div class=\"container bg-white\">\n                <div class=\"row\">\n                <div class=\"form-contact clearfix\">                    \n                    <h3 class=\"mb40\">Shipping  Address</h3>                            \n                    <div class=\"contact-cont\">\n                        <div class=\"field-cont\">\n                            <input	class=\"txtinp required form-control cus-field\" \n                            name=\"br_shipping_fname\"  placeholder=\"Firstname *\" required\n                            value=\"{exp:member:custom_profile_data}{br_shipping_fname}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                        </div>\n                        <div class=\"field-cont\">\n                            <input	class=\"txtinp required form-control cus-field\" \n                            name=\"br_shipping_lname\"  placeholder=\"Lastname *\" required\n                            value=\"{exp:member:custom_profile_data}{br_shipping_lname}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                        </div>\n                    </div>\n                    <div class=\"contact-cont\">\n                        <div class=\"field-cont\">\n                            <input	class=\"txtinp required form-control cus-field\" \n                            name=\"br_shipping_address1\"  placeholder=\"Shipping  Address Street *\" required\n                            value=\"{exp:member:custom_profile_data}{br_shipping_address1}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                        </div>\n                        <div class=\"field-cont\">\n                            <input	class=\"txtinp form-control cus-field\" \n                            name=\"br_shipping_address2\"  placeholder=\"Shipping Address Street 2 *\" \n                            value=\"{exp:member:custom_profile_data}{br_shipping_address2}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                        </div>\n                        <div class=\"field-cont\" style=\"width: calc(100% - 120px);display: inline-block;margin-right: 10px\">\n                            <input	class=\"txtinp form-control cus-field\" \n                            name=\"br_shipping_city\"  placeholder=\"Shipping  Address City *\" \n                            value=\"{exp:member:custom_profile_data}{br_shipping_city}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                        </div>\n                        <div class=\"field-cont\" style=\"width:100px;display: inline-block\">\n                            <input	class=\"txtinp form-control cus-field\" \n                            name=\"br_shipping_zip\"  placeholder=\"Post Code *\" \n                            value=\"{exp:member:custom_profile_data}{br_shipping_zip}{/exp:member:custom_profile_data}\" type=\"text\" />                                        \n                        </div>\n                    </div>\n                    \n                </div>\n                </div>\n            </div>\n        </section>\n        <section>\n            <div class=\"container bg-grey\">\n                <div class=\"row\">\n                    <div class=\"form-contact\">\n                        <h3 class=\"mb40\">Secure Payment</h3>\n                        <h3 style=\"display:none\"><a href=\"#\">Change Method</a></h3>\n                        <div class=\"payment\">\n                            <div class=\"text-center\">\n                                {payment_options}\n                            </div>\n                        </div>                                                \n                    </div>\n                </div>\n            </div>\n        </section>\n        <section>\n                <div class=\"container bg-white\">\n                    <div class=\"row\">\n                        <div class=\"form-contact clearfix review\">\n                            <h3 class=\"mb40\">Review & Place Order</h3>\n                                <div class=\"contact-cont\">\n                                    <div class=\"field-cont\" >                                        \n                                        {exp:brilliant_retail:promo_form}\n		                            <div class=\"input-group\">\n		                            	<input class=\"form-control cus-field\" name=\"code\" value=\"{coupon_code}\" type=\"text\" placeholder=\"Enter Coupon Code * \" />                                                \n                                                <span class=\"input-group-btn sub-group\">\n                                                    <button class=\"btn btn-black sub-button\" style=\"margin-top: 0px\" type=\"button\">Apply</button>\n                                                </span>                                                \n		                            </div>\n		                            <div class=\"clearboth\"><!-- --></div>\n                                        {/exp:brilliant_retail:promo_form}\n                                        \n                                    </div>\n                                </div>\n                                <div class=\"contact-cont\">\n                                    <div class=\"item-total\">\n                                        <div class=\"field-cont\" style=\"padding-top: 8px\">\n                                            <label><span>{exp:brilliant_retail:cart_items}</span>  item</label>\n                                            <label class=\"pull-right\">{exp:brilliant_retail:cart_total}</label>\n                                        </div>\n\n                                        <div class=\"field-cont\">\n                                            <label>Shipping </label>                                            \n                                            <div id=\"shipping_options\">\n                                                <div id=\"options\">Enter your shipping information to display options. </div>\n                                            </div>                                                                                        <div id=\"get_shipping_container\">\n                                            <button class=\"btn\" id=\"get_shipping_rates\">Get Shipping Rates</button>\n\n                                        </div>\n                                        </div>\n                                    </div>\n                                </div>                                \n                                <div class=\"clearfix\"></div>\n                                <div class=\"review\" style=\"float:right\">\n                                    <div class=\"totals\">\n                                        <div class=\"total\">Total : <label> {exp:brilliant_retail:cart_total} </label> </div>\n                                        <button type=\"submit\" class=\"btn btn-circle\" string=\"Place Order\">Place Order</button>\n<!--                                        <a class=\"btn btn-rounded\" href=\"/payment/success\">Place Order</a>-->\n                                    </div>\n                                </div>\n                        </div>\n                    </div>\n                </div>                \n        </section>\n       {/exp:brilliant_retail:checkout_form}\n       \n    </div>\n    {embed=assets/footer}\n    {js}\n    <script type=\"text/javascript\" src=\"{theme_url}js/bootstrap-datepicker.min.js\"></script>    \n    <script type=\"text/javascript\" src=\"{theme_url}js/jquery-validate.js\"></script>\n    <script type=\"text/javascript\">\n    $(document).ready(function(){\n        $(\'input[name^=\"br_billing_\"]\').on(\'keyup paste\',function(){            \n            var name = $(this).attr(\'name\').replace(\'_billing_\',\'_shipping_\');            \n            $(\'input[name=\'+name+\']\').val($(this).val());            \n        });\n        \n        $(\'input[name=\"gateway\"]\').on(\'change\',function(){                      \n          $(\'#shipping_instore input\').attr(\'checked\',false);\n            if ($(this).closest(\'.gateways\')[0].id == \'gateway_payatstore\') {\n                $(\'#shipping_instore input\').attr(\'checked\',true);\n            }\n        });\n    });\n    </script>                \n</body>\n</html>','',1445115924,1,'n',0,'','n','y','o',224,'n'),(36,1,2,'index','y','webpage','0',NULL,1444825357,1,'n',0,'','n','n','o',0,'n'),(37,1,2,'404','y','webpage','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n	<title>{site_name}</title>\r\n        {css}\r\n	<!--[if IE]>\r\n    <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n</head>\r\n<body>\r\n	{embed=assets/header}\r\n        <div class=\"page\">\r\n	<section>\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"title-cont story storyline\">Our story so far<br><br><br>it was... <br>\r\n                    <p class=\"lbl\">Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet <br> Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n	</section>\r\n	<section>\r\n		<div class=\"bg-white\">\r\n			<div class=\"container\">\r\n				<div class=\"img-cont story\">\r\n                	<img src=\"{theme_url}images/pic-building.png\" class=\"img-responsive\" />\r\n                </div>\r\n                <div class=\"title-cont storyline\">and then... <br>\r\n                    <p class=\"lbl\">Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet <br> Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</p>\r\n                </div>\r\n			</div>\r\n		</div>\r\n        <div class=\"container\">\r\n        	<div class=\"title-cont story storyline\">so today... <br>\r\n                <p class=\"lbl\">Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet <br> Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"bg-white\">\r\n        	<div class=\"container\">\r\n            	<div class=\"img-cont story\">\r\n                	<img src=\"{theme_url}images/pic-phone.png\" class=\"img-responsive\" />\r\n            	</div>\r\n            </div>\r\n        </div>\r\n	</section>\r\n    </div>\r\n    {embed=assets/footer}\r\n    {js}\r\n</body>\r\n</html>',NULL,1444238133,1,'n',0,'','n','n','o',11,'n'),(38,1,2,'ads','y','webpage','',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(39,1,2,'footer','y','webpage','<footer>\r\n    <div class=\"bg-black\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"padd clearfix\">\r\n                    <div class=\"footer-toggle\">\r\n                        <div class=\"col-md-4 col-xs-12\">\r\n                            <ul class=\"mnu1 pull-right\">\r\n                                <li><a href=\"/contact\">Contact Us</a></li>\r\n                                <li><a href=\"/payment\">Confirm Payment</a></li>\r\n                                <li><a href=\"/privacy\">Privacy & Term</a></li>\r\n                            </ul>\r\n                        </div>\r\n                        <div class=\"col-md-8 col-xs-12\">\r\n                            <ul class=\"mnu2\">\r\n                                <li><a href=\"/faq\">Frequently Asked Questions</a></li>\r\n                                <li><a href=\"/order_and_shipping\">Shipping Information</a></li>\r\n                                <li><a href=\"/photoprint_info\">Randomizer</a></li>\r\n                            </ul>\r\n                        </div>	\r\n                    </div>\r\n                    <div class=\"col-md-4 col-xs-12\"><span class=\"lbl-footer pull-right\">&copy Copyright 2015 Adorama</span></div>\r\n                    <div class=\"col-md-8 col-xs-12 align-center\"><a href=\"#\" id=\"sh-foot\" class=\"left up\">Show Footer <i class=\"fa fa-caret-down careD\"></i></a></div>						\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</footer>',NULL,1444238133,1,'n',0,'','n','n','o',0,'n'),(40,1,2,'header','y','webpage','<header>    \n    <div class=\"header-top {flash_class}\">{flash_message}\n        <!--<span class=\"header-close\" style=\"position:absolute;right: 10px;\" onclick=\"$(this).parent().hide();\"><i class=\"fa fa-times\"></i></span>-->\n    </div>\n    <div class=\"header-menu\">\n            <nav class=\"navbar navbar-default navbar-white\">\n                    <div class=\"container\">\n                            <div class=\"navbar-header\">\n                                    <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">\n                                            <i class=\"fa fa-align-justify black\"></i>\n                                    </button>\n                                    <a class=\"navbar-brand logo\" href=\"{site_url}\"><img src=\"{theme_url}/images/logo2.png\" class=\"img-responsive logo\"></a>                                    \n                                    <span class=\"navbar-title\">{exp:session_variables:get name=\'layout\' key=\"layout_name\"}</span>\n                            </div>\n                            <div class=\"collapse navbar-collapse cbm-push\" id=\"bs-example-navbar-collapse-1\">\n                                    <ul class=\"nav navbar-nav pull-right\">\n                                            <li><a class=\"hvr-bounce-to-bottom\" href=\"{site_url}products\">Shop All</a></li>\n                                            <li><a class=\"hvr-bounce-to-bottom\" href=\"{site_url}about\">About</a></li>\n                                            <li>\n                                                <a class=\"hvr-bounce-to-bottom\" href=\"{exp:brilliant_retail:path src=\'cart\'}\">Cart {if {exp:brilliant_retail:cart_items} >= 1}(<span class=\"cart_total\">{exp:brilliant_retail:cart_items}</span>){/if}</a>\n                                                {if {exp:brilliant_retail:cart_items} >= 1}\n                                                <div class=\"nav-menu cart-menu\">\n                                                    <label>Total</label><br />\n                                                    <span>{exp:brilliant_retail:cart_total}</span>\n                                                    <a href=\"/review\">Review</a><br />\n                                                    <a href=\"/checkout\">Checkout</a>\n                                                </div>\n                                                {/if}\n                                            </li>\n                                            <li>\n                                                {if logged_in}\n                                                <a class=\"hvr-bounce-to-bottom\" href=\"{path=\'member/{member_id}\'}\" class=\"member_name\">{screen_name}</a>\n                                                <div class=\"nav-menu member-menu\" >                                                      \n                                                      <a href=\"{path=\'logout\'}\">Log Out</a>\n                                                </div>\n                                                {/if}                                                    \n                                                {if logged_out}\n                                                  <a class=\"hvr-bounce-to-bottom\" href=\"{path=\'/login\'}\">Log-in</a>\n                                                  <div class=\"nav-menu member-menu\" >                                                      \n                                                    Not a member? <a href=\"{path=\'/register\'}\">Register</a>.<br>\n                                                    Have you <a href=\"{path=\'/forgot\'}\">forgotten your password</a>?\n                                                  </div>\n                                                {/if}\n                                            </li>\n                                    </ul>\n\n                            </div>\n                    </div>\n            </nav>\n    </div>\n</header>','',1448357628,1,'n',0,'','n','n','o',0,'n'),(41,1,2,'recommend','y','webpage','<section>\n        <div class=\"bg-white\">\n                <div class=\"container\">\n                        <div class=\"row\">\n                                <div class=\"title-cont\">What people share <label class=\"lbl\">What people says at #travellingprintshop</label></div>\n                                <div class=\"share-box clearfix\">\n                                        <div class=\"col-md-12 col-centered clearfix\">\n                                            <div class=\"share-item\">\n                                                <img src=\"{theme_url}/images/assets/canvas-print/pic-canvas-print-desktop-share1.jpg\" class=\"img-responsive\">                                                        \n                                            </div>\n                                            <div class=\"share-item\">\n                                                <img src=\"{theme_url}/images/assets/canvas-print/pic-canvas-print-desktop-share2.jpg\" class=\"img-responsive\">                                                        \n                                            </div>\n                                            <div class=\"share-item\">\n                                                <img src=\"{theme_url}/images/assets/canvas-print/pic-canvas-print-desktop-share3.jpg\" class=\"img-responsive\">                                                        \n                                            </div>\n                                            <div class=\"share-item\">\n                                                <img src=\"{theme_url}/images/assets/canvas-print/pic-canvas-print-desktop-share4.jpg\" class=\"img-responsive\">                                                        \n                                            </div>\n                                            <div class=\"share-item\">\n                                                <img src=\"{theme_url}/images/assets/canvas-print/pic-canvas-print-desktop-share5.jpg\" class=\"img-responsive\">                                                        \n                                            </div>\n                                        </div>\n                                </div>\n                        </div>\n                </div>\n        </div>\n</section>\n<section>\n        <div class=\"container\">\n                <div class=\"row\">\n                        <div class=\"title-cont bold black\">Be friend with us !</div>\n                        <div class=\"sosmed\">\n                                <a href=\"#\"><i class=\"fa fa-instagram fa-cos\"></i></a>\n                                <a href=\"#\"><i class=\"fa fa-facebook fa-cos\"></i></a>\n                                <a href=\"#\"><i class=\"fa fa-twitter fa-cos\"></i></a>\n                        </div>\n                </div>\n        </div>\n</section>',NULL,1448354014,1,'n',0,'','n','n','o',0,'n'),(42,1,2,'subscribe','y','webpage','<section>\n        <div class=\"bg-white\">\n                <div class=\"container\">\n                        <div class=\"row\">\n                                <div class=\"title-cont bold\">Only good news come to your mail! <label class=\"lbl\">Enter your mail and we will keep you posted on any news or promotions</label></div>\n                                <div class=\"form-subscribe\">\n                                        <div class=\"input-group\">\n                                                <form>\n                                                        <input type=\"email\" class=\"form-control sub-field\" placeholder=\"Email Address\">\n                                                        <span class=\"input-group-btn sub-group\">\n                                                                <button class=\"btn btn-default sub-button\" type=\"button\">Submit</button>\n                                                        </span>\n                                                </form>\n                                        </div>\n                                </div>\n                        </div>\n                </div>\n        </div>\n</section>',NULL,1448354014,1,'n',0,'','n','n','o',0,'n'),(43,1,1,'canvas_info','y','webpage','<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>PrintShop Adorama</title>\r\n        {meta}\r\n        {css}\r\n        <link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/flexslider.css\">\r\n    </head>\r\n    <body>\r\n{embed=assets/header}\r\n    <div class=\"page photoprint-info\">   \r\n        <section>\r\n            <div class=\"banner nothome\">\r\n                <div class=\"slider\" >\r\n                    <div class=\"photoprint\">\r\n                        <div>\r\n                            <div class=\"slider_img\"> <img class=\"img-responsive\" alt=\"alt\"  src=\"{theme_url}images/assets/home/canvas.png\"> </div>\r\n                            <div class=\"slider_desc\">\r\n                                <div class=\"slider_head\">\r\n                                    <h1>Canvas</h1>\r\n                                    <a href=\"#\" class=\"detail\">Product details+</a>\r\n                                </div>\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident necessitatibus, expedita, odit et quisquam consequatur, quis delectus, obcaecati commodi eveniet omnis repudiandae autem! Reiciendis tempora ut in, aut consequuntur autem.</p>\r\n                                <div class=\"slider_info\">\r\n                                    <div class=\"pricing\">Start from IDR 20.000</div>\r\n                                    <a class=\"btn btn-circle invert\" href=\"/index.php?ACT=77&product_id=3&XID={XID_HASH}\">Let\'s Create</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"slider_nav_container\"></div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        {embed=assets/recommend}\r\n        {embed=assets/subscribe}\r\n        \r\n   \r\n</div>\r\n{embed=assets/footer}\r\n{js}\r\n<script type=\"text/javascript\" src=\"{theme_url}js/flexslider.min.js\"></script>\r\n<script type=\"text/javascript\" src=\"{theme_url}js/slick.min.js\"></script>\r\n<script>\r\n    $(document).ready(function() {\r\n        $(\'.photoprint\').slick({\r\n            infinite: false,\r\n            arrows:false,\r\n            dots:true,\r\n            slidesToShow: 1,\r\n            appendDots: \'.slider_nav_container\'\r\n        });\r\n    });\r\n</script>\r\n</body>\r\n</html>',NULL,1448356747,1,'n',0,'','n','n','o',0,'n'),(44,1,1,'classic_info','y','webpage','<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>PrintShop Adorama</title>\r\n        {meta}\r\n        {css}\r\n        <link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/flexslider.css\">\r\n    </head>\r\n    <body>\r\n{embed=assets/header}\r\n    <div class=\"page photoprint-info\">   \r\n        <section>\r\n            <div class=\"banner nothome\">\r\n                <div class=\"slider\" >\r\n                    <div class=\"photoprint\">\r\n                        <div>\r\n                            <div class=\"slider_img\"> <img class=\"img-responsive\" alt=\"alt\"  src=\"{theme_url}images/assets/home/classic-print.png\"> </div>\r\n                            <div class=\"slider_desc\">\r\n                                <div class=\"slider_head\">\r\n                                    <h1>Classic Prints</h1>\r\n                                    <a href=\"#\" class=\"detail\">Product details+</a>\r\n                                </div>\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident necessitatibus, expedita, odit et quisquam consequatur, quis delectus, obcaecati commodi eveniet omnis repudiandae autem! Reiciendis tempora ut in, aut consequuntur autem.</p>\r\n                                <div class=\"slider_info\">\r\n                                    <div class=\"pricing\">Start from IDR 20.000</div>\r\n                                    <a class=\"btn btn-circle invert\" href=\"#\">Let\'s Create</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"slider_nav_container\"></div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        {embed=assets/recommend}\r\n        {embed=assets/subscribe}\r\n        \r\n   \r\n</div>\r\n{embed=assets/footer}\r\n{js}\r\n<script type=\"text/javascript\" src=\"{theme_url}js/flexslider.min.js\"></script>\r\n<script type=\"text/javascript\" src=\"{theme_url}js/slick.min.js\"></script>\r\n<script>\r\n    $(document).ready(function() {\r\n        $(\'.photoprint\').slick({\r\n            infinite: false,\r\n            arrows:false,\r\n            dots:true,\r\n            slidesToShow: 1,\r\n            appendDots: \'.slider_nav_container\'\r\n        });\r\n    });\r\n</script>\r\n</body>\r\n</html>',NULL,1448356747,1,'n',0,'','n','n','o',0,'n'),(45,1,1,'books_info','y','webpage','<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>PrintShop Adorama</title>\r\n        {meta}\r\n        {css}\r\n        <link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/flexslider.css\">\r\n    </head>\r\n    <body>\r\n{embed=assets/header}\r\n    <div class=\"page photoprint-info\">   \r\n        <section>\r\n            <div class=\"banner nothome\">\r\n                <div class=\"slider\" >\r\n                    <div class=\"photoprint\">\r\n                        <div>\r\n                            <div class=\"slider_img\"> <img class=\"img-responsive\" alt=\"alt\"  src=\"{theme_url}images/assets/home/books.png\" > </div>\r\n                            <div class=\"slider_desc\">\r\n                                <div class=\"slider_head\">\r\n                                    <h1>Photo Books</h1>\r\n                                    <a href=\"#\" class=\"detail\">Product details+</a>\r\n                                </div>\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident necessitatibus, expedita, odit et quisquam consequatur, quis delectus, obcaecati commodi eveniet omnis repudiandae autem! Reiciendis tempora ut in, aut consequuntur autem.</p>\r\n                                <div class=\"slider_info\">\r\n                                    <div class=\"pricing\">Start from IDR 20.000</div>\r\n                                    <a class=\"btn btn-circle invert\" href=\"/index.php?ACT=77&product_id=1&XID={XID_HASH}\">Let\'s Create</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"slider_nav_container\"></div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        {embed=assets/recommend}\r\n        {embed=assets/subscribe}\r\n        \r\n   \r\n</div>\r\n{embed=assets/footer}\r\n{js}\r\n<script type=\"text/javascript\" src=\"{theme_url}js/flexslider.min.js\"></script>\r\n<script type=\"text/javascript\" src=\"{theme_url}js/slick.min.js\"></script>\r\n<script>\r\n    $(document).ready(function() {\r\n        $(\'.photoprint\').slick({\r\n            infinite: false,\r\n            arrows:false,\r\n            dots:true,\r\n            slidesToShow: 1,\r\n            appendDots: \'.slider_nav_container\'\r\n        });\r\n    });\r\n</script>\r\n</body>\r\n</html>',NULL,1448356747,1,'n',0,'','n','n','o',0,'n'),(46,1,1,'photobook_review_book','y','webpage','<!DOCTYPE html>\n<html>\n    <head>\n        <title>PrintShop Adorama</title>\n        <link rel=\"stylesheet\" href=\"{theme_url}css/slick.css\" type=\"text/css\"/>\n        <link rel=\"stylesheet\" href=\"{theme_url}css/slick-theme.css\" type=\"text/css\"/>\n        {meta}\n        {css}\n    </head>\n    <body>\n        {embed=assets/header}\n        <section class=\"min-height2\">\n            <div class=\"container\">\n                <div class=\"row\">\n                    <div class=\"content sucess\">\n                        <div class=\"title-cont black\" style=\"text-align:left\">Review your photobook before ordering</div>\n                        <div class=\"spine\"><div><span>{exp:session_variables:get name=\"book_t\"}</span></div><label>Spine</label><a href=\"#\" class=\"btn btn-circle invert\">Edit</a></div>\n                        <div class=\"review-book\">\n                        {exp:query sql=\"SELECT * FROM exp_photoprints WHERE owner_id = ? AND  layout_id = ? ORDER BY sequence \" params=\"{segment:owner_id},{segment:layout_id}\" }\n                            <div>\n                                <div class=\"photobook-item\">\n                                    <img src=\"/working/{segment:owner_id}/{file}\" class=\"img-responsive\">\n                                </div>\n                                <label>Page 1</label>\n                            </div>\n                          {/exp:query}\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </section>\n        <footer>\n            <div class=\"bg-black\">\n                <div class=\"container\">\n                    <div class=\"row\">\n                        <div class=\"foot_upload\">\n                            <ul>\n                                <li class=\"pull-left\"><a href=\"/arrange/{segment:layout_id}/{segment:owner_id}\"><i class=\"fa fa-arrow-left\"></i> Rearange Photos</a></li>\n                                <li class=\"pull-right\"><a href=\"/cart/{exp:session_variables:get name=\'cart_id\'}\"><label class=\"center\">Order Books <i class=\"fa fa-arrow-right\"></i></label></a></li>\n                            </ul>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </footer>\n        {js}\n        <script type=\"text/javascript\" src=\"{theme_url}js/slick.min.js\"></script>\n        <script>\n        $(document).ready(function(){\n            function equalGrids(){\n                equalGrid = $(\'section .photoitem\').width();\n                $(\'section .photoitem\').height(equalGrid);\n                $(\'section .photoitem > .overlay > span\').css(\'line-height\',equalGrid +\'px\');\n                /*for footer stay on bottom*/\n                defContentHeight = $(window).innerHeight() - 110;\n                if ($(\'footer\').siblings(\'section\').height() < defContentHeight){\n                    $(\'footer\').addClass(\'stayBottom\');\n                }\n                else if($(\'footer\').siblings(\'section\').height() > defContentHeight){\n                    $(\'footer\').removeClass(\'stayBottom\');\n                }\n            }\n\n            $(window).on(\'resize\',equalGrids);\n  		$(\'.review-book\').slick({\n    		infinite: false,\n  			slidesToShow: 2,\n  			slidesToScroll: 2,\n  			 responsive: [\n			    {\n			      breakpoint: 600,\n			      settings: {\n			        slidesToShow: 1,\n			        slidesToScroll: 1\n			      }\n			    }]\n  		});\n        $(\'#sh-foot\').click(function(e){\n        $(\'.footer-toggle\').slideToggle();\n        if($(this).hasClass(\'up\')){\n        $(this).html(\'Hide Footer <i class=\"fa fa-caret-up careD\"></i>\').removeClass(\'up\');\n        }else{\n        $(this).html(\'Show Footer <i class=\"fa fa-caret-down careD\"></i>\').addClass(\'up\');\n        }\n        $(\'html, body\').animate({\n            scrollTop: $(document).height()\n            }, 2000);\n        e.preventDefault();\n        });\n        });\n        </script>\n    </body>\n</html>',NULL,1448356747,1,'n',0,'','n','n','o',0,'n'),(47,1,1,'magnets_info','y','webpage','<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <title>PrintShop Adorama</title>\r\n        {meta}\r\n        {css}\r\n        <link rel=\"stylesheet\" type=\"text/css\" href=\"{theme_url}css/flexslider.css\">\r\n    </head>\r\n    <body>\r\n{embed=assets/header}\r\n    <div class=\"page photoprint-info\">   \r\n        <section>\r\n            <div class=\"banner nothome\">\r\n                <div class=\"slider\" >\r\n                    <div class=\"photoprint\">\r\n                        <div>\r\n                            <div class=\"slider_img\"> <img class=\"img-responsive\" alt=\"alt\"  src=\"{theme_url}images/assets/home/magnets.png\"> </div>\r\n                            <div class=\"slider_desc\">\r\n                                <div class=\"slider_head\">\r\n                                    <h1>Magnets</h1>\r\n                                    <a href=\"#\" class=\"detail\">Product details+</a>\r\n                                </div>\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident necessitatibus, expedita, odit et quisquam consequatur, quis delectus, obcaecati commodi eveniet omnis repudiandae autem! Reiciendis tempora ut in, aut consequuntur autem.</p>\r\n                                <div class=\"slider_info\">\r\n                                    <div class=\"pricing\">Start from IDR 20.000</div>\r\n                                    <a class=\"btn btn-circle invert\" href=\"/index.php?ACT=77&product_id=4&XID={XID_HASH}\">Let\'s Create</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"slider_nav_container\"></div>\r\n                </div>\r\n            </div>\r\n        </section>\r\n        {embed=assets/recommend}\r\n        {embed=assets/subscribe}\r\n        \r\n   \r\n</div>\r\n{embed=assets/footer}\r\n{js}\r\n<script type=\"text/javascript\" src=\"{theme_url}js/flexslider.min.js\"></script>\r\n<script type=\"text/javascript\" src=\"{theme_url}js/slick.min.js\"></script>\r\n<script>\r\n    $(document).ready(function() {\r\n        $(\'.photoprint\').slick({\r\n            infinite: false,\r\n            arrows:false,\r\n            dots:true,\r\n            slidesToShow: 1,\r\n            appendDots: \'.slider_nav_container\'\r\n        });\r\n    });\r\n</script>\r\n</body>\r\n</html>',NULL,1448356747,1,'n',0,'','n','n','o',0,'n'),(48,1,2,'banner','y','webpage','<section>\n        <div class=\"banner\">\n                <div class=\"slider\">\n                        <div id=\"myCarousel\" class=\"carousel slide\" data-ride=\"carousel\">\n                          <!-- Wrapper for slides -->\n                          <div class=\"carousel-inner\" role=\"listbox\">\n                            <div class=\"item active\">\n                              <img src=\"http://adorama/html/update/images/slider/pic-slider-home.png\" alt=\"printshop\" class=\"img-responsive\">\n                            </div>\n\n                            <div class=\"item\">\n                              <img src=\"http://adorama/html/update/images/slider/pic-slider-home.png\" alt=\"printshop\" class=\"img-responsive\">\n                            </div>\n\n                          <!-- Left and right controls -->\n                          <!-- <a class=\"left carousel-control\" href=\"#myCarousel\" role=\"button\" data-slide=\"prev\">\n                            <span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span>\n                            <span class=\"sr-only\">Previous</span>\n                          </a>\n                          <a class=\"right carousel-control\" href=\"#myCarousel\" role=\"button\" data-slide=\"next\">\n                            <span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span>\n                            <span class=\"sr-only\">Next</span>\n                          </a> -->\n                            </div>\n                        </div>\n                </div>\n        </div>\n        <div class=\"tour\">\n                The best place to your photo <a href=\"#\" class=\"btn btn-circle invert\">Tour</a>\n        </div>\n</section>',NULL,1448356747,1,'n',0,'','n','n','o',0,'n');
/*!40000 ALTER TABLE `exp_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_throttle`
--

DROP TABLE IF EXISTS `exp_throttle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_throttle` (
  `throttle_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL,
  `locked_out` char(1) NOT NULL DEFAULT 'n',
  PRIMARY KEY (`throttle_id`),
  KEY `ip_address` (`ip_address`),
  KEY `last_activity` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_throttle`
--

LOCK TABLES `exp_throttle` WRITE;
/*!40000 ALTER TABLE `exp_throttle` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_throttle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_upload_no_access`
--

DROP TABLE IF EXISTS `exp_upload_no_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_upload_no_access` (
  `upload_id` int(6) unsigned NOT NULL,
  `upload_loc` varchar(3) NOT NULL,
  `member_group` smallint(4) unsigned NOT NULL,
  PRIMARY KEY (`upload_id`,`member_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_upload_no_access`
--

LOCK TABLES `exp_upload_no_access` WRITE;
/*!40000 ALTER TABLE `exp_upload_no_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_upload_no_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exp_upload_prefs`
--

DROP TABLE IF EXISTS `exp_upload_prefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exp_upload_prefs` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) unsigned NOT NULL DEFAULT '1',
  `name` varchar(50) NOT NULL,
  `server_path` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL,
  `allowed_types` varchar(3) NOT NULL DEFAULT 'img',
  `max_size` varchar(16) DEFAULT NULL,
  `max_height` varchar(6) DEFAULT NULL,
  `max_width` varchar(6) DEFAULT NULL,
  `properties` varchar(120) DEFAULT NULL,
  `pre_format` varchar(120) DEFAULT NULL,
  `post_format` varchar(120) DEFAULT NULL,
  `file_properties` varchar(120) DEFAULT NULL,
  `file_pre_format` varchar(120) DEFAULT NULL,
  `file_post_format` varchar(120) DEFAULT NULL,
  `cat_group` varchar(255) DEFAULT NULL,
  `batch_location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exp_upload_prefs`
--

LOCK TABLES `exp_upload_prefs` WRITE;
/*!40000 ALTER TABLE `exp_upload_prefs` DISABLE KEYS */;
/*!40000 ALTER TABLE `exp_upload_prefs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-25  5:47:57
