<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/************************************************************/
/*	BrilliantRetail 										*/
/*															*/
/*	@package	BrilliantRetail								*/
/*	@Author		David Dexter  								*/
/* 	@copyright	Copyright (c) 2010-2014						*/
/* 	@license	http://brilliantretail.com/license.html		*/
/* 	@link		http://brilliantretail.com 					*/
/*															*/
/************************************************************/
/* NOTICE													*/
/*															*/
/* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF 	*/
/* ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED	*/
/* TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 		*/
/* PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT 		*/
/* SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY */
/* CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION	*/
/* OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR 	*/
/* IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 		*/
/* DEALINGS IN THE SOFTWARE. 								*/	
/************************************************************/

	$sql[] = "ALTER TABLE exp_br_store ADD COLUMN display_out_of_stock int(11) NOT NULL DEFAULT '0'";
	$sql[] = "ALTER TABLE exp_br_store ADD COLUMN downloads_use_local int(11) NOT NULL DEFAULT '0'";
	$sql[] = "ALTER TABLE exp_br_store ADD COLUMN downloads_use_s3 int(11) NOT NULL DEFAULT '0'";
	$sql[] = "ALTER TABLE exp_br_store ADD COLUMN downloads_local varchar(100)";
	$sql[] = "ALTER TABLE exp_br_store ADD COLUMN downlaods_s3_access_key varchar(100)";
	$sql[] = "ALTER TABLE exp_br_store ADD COLUMN downlaods_s3_secret_key varchar(100)";
					