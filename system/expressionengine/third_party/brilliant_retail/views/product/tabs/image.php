<?php
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

/********************/
/* Images Tab 		*/
/********************/
$hide_header = (count($images) == 0) ? 'style="display:none"' : '';
?>	

<div class="publish_field" id="hold_br_title">

	<label class="hide_field">
		<span>
			<?=lang('br_images')?>
		</span>
	</label>

	<div id="sub_hold_title">
		<fieldset class="holder custom_field">
			<table id="imageTable" class="product_edit" cellspacing="0" cellpadding="0" border="0" width="100%">
				<thead>
					<tr>
						<td colspan="7" align="left" style="text-align:left;border-bottom:0">
							<div id="img_upload_button">
								<div id="showprogress"><img src="<?=$theme?>images/loader.gif" /></div>
								<div id="divButtonPlaceholder">
									<span id="spanButtonPlaceholder"></span>
								</div>
								<div id="showimages"></div>
							</div>
							<div id="img_browse_button" >
								<?=lang('br_browse');?>
							</div>
							<div style="clear:both"></div>
							<iframe src="" id="image_browse_frame" width="100%" style="height:452px;display:none;border:0"></iframe></td>
					</tr>
					<tr>
						<th width="25%"><?=lang('br_image')?></th>
						<th width="20%"><?=lang('br_title')?></th>
						<th width="15%"><?=lang('br_large')?></th>
						<th width="15%"><?=lang('br_thumbnail')?></th>
						<th width="10%"><?=lang('br_exclude')?></th>
						<th width="5%" colspan="2"><?=lang('br_actions')?></th>
					</tr>
				</thead>
				<?php
					// Show the footer?
						$show_footer = '';
						if(count($images) > 0 ){
							$show_footer = 'nodisplay';
						}
				?>
				<tfoot class="<?=$show_footer?>">
					<tr>
						<td colspan="7">
							<?=lang('br_image_empty')?></td>
					</tr>
				</tfoot>
				<tbody>
			<?php
				$cnt = 0;
				
				foreach($images as $img){
					$large = ($img["large"] == 1) ? 'checked' : '';
					$thumb = ($img["thumb"] == 1) ? 'checked' : '';
					$exclude = ($img["exclude"] == 1) ? 'checked' : '';
					
					$a = explode(".",$img["filenm"]);
					$len = strlen($img["filenm"])-(strlen($a[count($a)-1])+1);
					$base = substr($img["filenm"],0,$len);
					echo '	<tr>
								<td>
									<img src="'.$media_url.'products/thumb/'.$img["filenm"].'" class="thumb" />
									<input type="hidden" name="cImg_name['.$base.']" value="'.$img["filenm"].'" /></td>
								<td><input type="text" name="cImg_title['.$base.']" value="'.$img["title"].'" /></td>
								<td><input type="radio" name="cImg_large" value="'.$base.'" '.$large.' /></td>
								<td><input type="radio" name="cImg_thumb" value="'.$base.'" '.$thumb.' /></td>
								<td><input type="checkbox" name="cImg_exclude['.$base.']"  value="'.$img["filenm"].'" '.$exclude.' /></td>
								<td class="move_image_row"><img src="'.$theme.'images/move.png" /></td>
								<td><a href="#" class="remove_img"><img src="'.$theme.'images/delete.png" /></a></td>
							</tr>';
					$cnt++;
				}
			?>
				</tbody>
			</table>
		</fieldset>
	</div> <!-- /sub_hold_field -->

</div>




<script type="text/javascript">
	
	var browse_window_show = false;
	
	var setBrowseUrl = function(txt){
		top.$('#image_browse_frame').slideUp(function(){
			var fl = txt.replace(/^\/|\/$/g,'');
			var a = fl.split('.');
			top._add_image_row(a[0]+'|'+fl);
			$(this).attr('src','');
			top.browse_window_show = false;
		});
	}
	
	
	$(function(){
		_restripe_images();
		create_image_uploader();
		
		$('#img_browse_button').bind('click',function(){
			// Well lets go ahead and initiate the Image only browser then. 
				if(!browse_window_show){
					$('#image_browse_frame')
						.slideDown()
						.attr(	'src',
								'<?=URL_THIRD_THEMES?>brilliant_retail/script/ckeditor/plugins/pgrfilemanager/PGRBrowseImage.php?langCode=en&type=Image');
					browse_window_show = true;
				}else{
					$('#image_browse_frame')
						.slideUp()
						.attr('src','');
					browse_window_show = false;
				}
				return false;
		});
		
	});
function create_image_uploader(){
	// Create the image 
		swfu = new SWFUpload({
			// Backend Settings
			upload_url: "<?=$image_upload?>",
			post_params: {
							"site_id" : <?=$site_id?>, 
							"PHPSESSID" : "<?=session_id()?>"
						},

			// File Upload Settings
			file_size_limit : "20 MB",	// 4MB
			file_types : "*.jpg;*.png;*.gif",
			file_types_description : "JPG, PNG, or GIF Images",
			file_upload_limit : 0,

			file_dialog_complete_handler : 	function fileDialogComplete(numFilesSelected, numFilesQueued) {
												try {
													if (numFilesQueued > 0) {
														$('#showprogress').show();
														this.startUpload();
													}
												} catch (ex) {
													this.debug(ex);
												}
											},
			upload_progress_handler : 	function uploadProgress(file, loaded, total) {
											/* var percent = Math.ceil((loaded / total) * 100); */
										}, 
			upload_success_handler : function uploadSuccess(file,serverData){
																_add_image_row(serverData);
															},
			upload_complete_handler :  function uploadComplete(file) {
											try {
												/*  I want the next upload to continue automatically so I'll call startUpload here */
												if (this.getStats().files_queued > 0) {
													this.startUpload();
												} else {
													$('#showprogress').hide();
												}
											} catch (ex) {
												this.debug(ex);
											}
										},
			// Button Settings
			button_image_url : "<?=$theme?>images/btn-add.png",
			button_placeholder_id : "spanButtonPlaceholder",
			button_width: 100,
			button_height: 24,
			button_text : '<span class="button"><?=lang('br_upload')?></span>',
			button_text_style : '.button { font-family: Helvetica, Arial, sans-serif;font-weight:bold;font-size: 12px; color: #666666 }',
			button_text_top_padding: 6,
			button_text_left_padding: 25,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,
			
			// Flash Settings
			flash_url : "<?=$theme?>script/swfupload/swfupload.swf",
			flash9_url : "<?=$theme?>script/swfupload/swfupload_fp9.swf",
	
			custom_settings : {
				upload_target : "divFileProgressContainer"
			},
			
			// Debug Settings
			debug: false  
		});
}

function _add_image_row(serverData){
	var img = serverData.split('|');
	
	// Hide the footer message
		$('#imageTable tfoot').hide();
	
	$('	<tr>'+ 
		'	<td><img src="<?=$media_url?>products/thumb/'+img[1]+'" class="thumb" />'+
		'		<input type="hidden" name="cImg_name['+img[0]+']" value="'+img[1]+'" /></td>'+
		'	<td><input type="text" name="cImg_title['+img[0]+']" /></td>'+
		'	<td><input type="radio" name="cImg_large" value="'+img[0]+'" /></td>'+
		'	<td><input type="radio" name="cImg_thumb" value="'+img[0]+'" /></td>'+
		'	<td><input type="checkbox" name="cImg_exclude['+img[0]+']"  value="'+img[1]+'" /></td>'+
		'	<td class="move_image_row"><img src="<?=$theme?>images/move.png" /></td>'+
		'	<td><a href="#" class="remove_img"><img src="<?=$theme?>images/delete.png" /></a></td>'+
		'</tr>').appendTo($('#imageTable tbody'));
		
		// Make sure the header is showing
			$('#image_header').show();
			
		// Make sure that at least one radio button is selected
		// For the large and the thumbnail image
			_set_image_radio();
		
		// Restrip things and set the delete buttons
			_restripe_images();
}

function _set_image_radio(){
	if($('#imageTable tr').size() == 2){
		// No need to show the header
		$('#image_header').hide();	
	}else{
		// Set the radio button for 
		// the large image if needed
			if($('input[name="cImg_large"]:checked').size() == 0){
				$('input[name="cImg_large"]:eq(0)').attr('checked',true);
			}
		// Set the radio button for
		// the thumbnail if needed
			if($('input[name="cImg_thumb"]:checked').size() == 0){
				$('input[name="cImg_thumb"]:eq(0)').attr('checked',true);
			}
	}
}

function _restripe_images(){
	$('#imageTable tbody').not('.nodrag').sortable({
							axis:'y', 
							cursor:'move', 
							opacity:0.6, 
							items: "tr", 
							handle:'.move_image_row',
							helper:function(e, ui) {
								ui.children().each(function() {
									$(this).width($(this).width());
								});		
								return ui;
							},
							update: function(){
								_restripe_images() 
							}
						});
							
	$('.remove_img').unbind('click').bind('click',function(){
																		$(this).parent().parent().remove();
																		
																		if($('#imageTable tbody tr').size() == 0){
																			$('#imageTable tfoot').show();
																		}

																		_set_image_radio();
																		_restripe_images();
																		return false;
																	});
}		
</script>