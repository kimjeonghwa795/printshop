var fit = function(toFit,caR){
    var box = {}                        
    var fW = 1;
    var taR = toFit.width / toFit.height; 
    if (toFit.height <= toFit.width  && caR <= 1) {
        fW = 0;
    }			
    console.log(toFit,caR,fW );
    if ( fW ) {
        box.width 	= toFit.width;
        box.left 	= toFit.left;
        box.height 	= box.width / caR;
        box.top		= (toFit.height - box.height)/2 + toFit.top;
    }else {
        box.height = toFit.height;
        box.top = toFit.top;
        box.width = box.height * caR;
        box.left = (toFit.width - box.width)/2 + toFit.left;
    }
    return box;
}
		
        

var upload_file = function($img,def){
    var form = $('#fileupload');        
    $('input[name=filename]',form).val($img.data('file'));	
    var $li = $img.parents('li.tmpl');        
	if ($li.hasClass('inprogress')) return;
	console.trace();
    var formdata = {XID:$('input[name=XID]',form).val()};                
    var tic ;    
	$li.data('progress',0);
    var li_id = $li.data('id');
	function dummy_progress(){
			var progress = $li.data('progress');
            progress += Math.floor(Math.random() * 25 ) ;
			$li.data('progress',progress);
            if (progress > 100) return;
            $li.find('.count').attr('data-progress',progress + '%');
            $li.find('.overlay').width(progress + '%');
            clearTimeout($li.data('timer_id'));            
			$li.data('timer_id',setTimeout(dummy_progress, Math.random() * 500 ));
    }	
	$li.data('timer_id',setTimeout(dummy_progress, Math.random() * 30 ));
    if ( $img.attr('src').startsWith('data') ){        
        var canvas = $img.attr('src').replace(/^data:image\/(png|jpg|jpeg|);base64,/, "");
        var filename = $img.data('file');        
        $.extend(formdata,{'ACT':26,'filecanvas' :canvas, 'source': 'upload', filename: filename , id: li_id, meta:$li.data('meta')} );        
    }else if ($img.attr('src').startsWith('http')){                        
        var url = {};
        url[$img.data('id')] =  $img.attr('src') ;
        $.extend(formdata,{'ACT': 27 ,  'url' : url , 'source': $('[name=source]').val(), token:$('[name=token]').val() ,id: li_id,meta:$li.data('meta') }  );
    }
    $li.addClass('inprogress').removeClass('failed completed ready');
    var selecteds = JSON.parse(Cookies.get('exp_selections')) || {};
    def = $.ajax({url	: "/index.php",
                type	: "POST",                    
                data	: formdata,
                dataType: "JSON",
                success	: function(res){                            
                        $img.removeClass('need-upload');                        
                        clearTimeout($li.data('timer_id'));     
                        if (res.files.length > 0){
                            $li.addClass('completed').find('.overlay').css('width','100%').find('.done span').replaceWith('<span>Added!</span>');                        
                            res.files[0].count = selecteds[res.files[0].id];
                            var idx = $li.index();
                            var newImg = new Image();
                            newImg.onload = function(){
                                $img.attr('src',res.files[0].url)
                                //$img.hide('fadeOut',function(e){$(this).attr('src',res.files[0].url).show('fadeIn'); });
                                $li.removeClass('inprogress completed').addClass('ready');
                                $li.find('.count').attr('data-progress','100%');
                                $li.attr('data-meta',res.files[0].meta);
                                $img.siblings('input.meta').val(res.files[0].meta);
                            };
                            newImg.src= res.files[0].url;                                                        
                        }                                                                                                 
                },
                error: function(){
                    clearTimeout($li.data('timer_id'));     
                    $li.addClass('failed')
                      .find('.overlay .done span')
                      .replaceWith('<span>Click to retry</span>');
					setTimeout(function(){
						$li.remove();
					},10000);
                }
                });        
    return def;
};

var img_select = function(e){         
		
        if ($(this).hasClass('error')  ) return false;
        if ($(this).hasClass('failed')  ) return upload_file($('.preview img',this));
		
        var max = parseInt($('[name=maxFiles]').val() || 0);
        var file_id = $('.preview img',this).data('id');
        var selecteds = Cookies.get('exp_selections') || '[]';
        selecteds = JSON.parse(selecteds) || [];
        if ( selecteds.length >= max){ return; }        
        selecteds.push(file_id);
		Cookies.set('exp_selections',selecteds);
        
        var animate = $(this).find('.overlay');        
        animate.addClass('animated add-animate');
        setTimeout(function(){animate.removeClass('animated add-animate');},500);        
        var count =  parseInt($('.count',this).data('count') || 0 ) + 1;                       
        
        $(':checkbox.select',this).val(count).attr('checked','checked');
        $(':checkbox.meta',this).attr('checked','checked');
        $(this).addClass('ready');
        
        var $img = $('.preview img',this);        
        if ($img.attr('src').startsWith('data') || $img.attr('src').startsWith('http') ) {
            $img.addClass('need-upload');				
            upload_file($img);
        }
        show_summary(selecteds.length);                
        var countss = $('#count-selected .animate-count').html()
        $('.count',this).data('count',countss).html(countss + 'x');
        e.stopPropagation();
        e.preventDefault();
        return false;
};

var load_selection = function(){
    var sel =  Cookies.get('exp_selections') || '[]';
    sel = JSON.parse(sel);    
    console.log(sel);
    for (var id in sel){
        var li = (document.querySelector("li[data-id='"+ sel[id]+"']")) || false;
        if (!li) {continue};
        
        var count =  parseInt($('.count',li).data('count') || 0 ) + 1;                       
        $('.count',li).data('count',count).html(count + 'x');
        $(':checkbox.select',li).val(count).attr('checked','checked');
        $(':checkbox.meta',li).attr('checked','checked');
        $(li).addClass('ready');

    }    
    show_summary(sel.length);
}

var show_summary = function(total){
    var max = $('[name=maxFiles]').val() || 0;
    
    $('#count-selected').html( '<span class="animate-count">'+total +'</span>/' + '<span id="count-max">' + max +'</span>'); 
    $('.animate-count').addClass('animate');
    
    if (total == max) {
        $('.animate-count').css('color','#40d088');
        $('#count-max').css('color','#40d088');
        $('.nexts-btn').css({'pointer-events' : 'auto','color' : 'white'});
        
    }else{        
        $('.nexts-btn').css({'pointer-events' : 'none','color' : '#C1C1C1'});        
    }
    return total;
}

var total_selection = function(){            
    var total = 0;    
    var sel =  Cookies.get('exp_selections') || '{}';
    sel = JSON.parse(sel);    
    for (var id in sel){
        var count =  sel[id];        
        var li = $('li[data-id='+id+']');
        if ( li.length ) {            
            $(li).addClass('selected');       
            $('.count',li).data('count',count).html(count + 'x');
            $(':checkbox.select',li).val(count).attr('checked','checked');
            $(':checkbox.meta',li).attr('checked','checked');
             //$('a.act-btn.delete',li).html('<i class="fa fa-minus"/>');
            var $img = $('.preview img',li);        
            if ($img.attr('src').startsWith('data') || $img.attr('src').startsWith('http') ) {
                $img.addClass('need-upload');				
                upload_file($img);
            }
        }        
        total += count;
        if (! count ) {
            $('.count',li).data('count',count).html('');            
            delete sel[id];            
        }

    }    
    Cookies.set('exp_selections',sel);
    var max = $('[name=maxFiles]').val() || 0;
    $('#count-selected').html( '<span class="animate-count">'+total +'</span>/' + '<span id="count-max">' + max +'</span>'); 
    $('.animate-count').addClass('animate');
    $('ul.files').off('click','li.tmpl');
    if (total == max) {
        $('.animate-count').css('color','#40d088');
        $('#count-max').css('color','#40d088');
        $('.nexts-btn').css({'pointer-events' : 'auto','color' : 'white'});
    }else{        
        $('.nexts-btn').css({'pointer-events' : 'none','color' : '#C1C1C1'});
        $('ul.files').on('click','li.tmpl', img_select);
    }
    return total;
};  

$(function () {            
    var upload_files = function(){       
        var defs = [];
        $('#loading_progress').loading('spin');        
        var uploads =$('.preview img.need-upload').toArray();
        
        for (var i in uploads) {
            $('#loading_progress').data('progress',i);
            $('#loading_progress').data('total',uploads.length);            
            defs.push( upload_file($(uploads[i])) );            
        }   
        
        return defs;
    };
    
    $('.back-btn').click(function(e){            
            var url = this.href;                        
            var files = upload_files();
            $('body').addClass('inprogress');
            $.when.apply($,files).done(function(res){
                $('body').removeClass('inprogress');
                if(window.opener){
                    window.opener.location.reload();
                    window.close();
                }else{
                   window.location = url;
                }            
            }).progress(function(){
               $('body').addClass('inprogress');                 
            });
            e.stopPropagation();
            e.preventDefault();
            return false;
    });    
        
    var submit_selection = function(){                
        $('button.select').css('color','transparent').attr('disabled','disabled');
        //$('body').addClass('inprogress');
        var defs = upload_files();
        if (!defs.length)$("#selectform").submit();
        $.when.apply($,defs).done(function(res){          
            //$('body').removeClass('inprogress');
            $('button.select').css('color','').removeAttr('disabled');
            $("#selectform").submit();            
        });                        
        return false;
    };         
    
    $('.submit_button.select').click(submit_selection);
    
    var remove_selection = (function(e){                        
		e.stopPropagation();
		
        var li = $(this).parents('li.upload');
		
		if (!li.hasClass('ready')) return false;
		
        var animate = $(li).find('.overlay');
        animate.addClass('animated remove-animate');
        setTimeout(function(){animate.removeClass('animated remove-animate');},500);
        var count =  parseInt($('input:checkbox',li).val()) || 0;                
        
        var counts = count - 1;
        console.log(li,count);
               

        var selecteds = Cookies.get('exp_selections') || '[]';
        selecteds = JSON.parse(selecteds) || {};
        var del  = selecteds.lastIndexOf(li.data('id'));
        selecteds.splice(del,1);        
        console.log(selecteds);
        Cookies.set('exp_selections',JSON.stringify(selecteds));         
        show_summary(selecteds.length);
        if (counts == 0 ){
                $(this).siblings('input:checkbox').attr('checked',false);
                $('.preview img',li).removeClass('need-upload');
                $(this).closest('li.tmpl').removeClass('selected');                    
                $('.count',li).data('count',count).html('');
                console.log('11')
            }else if (counts < 0 ) { 
                if ($(this).attr('href')){
                    $.ajax($(this).attr('href'), function(r){});                
                }
                //li.remove();
                couns = 0;
                console.log('22')
            }else {
                var countss = $('#count-selected .animate-count').html()
                $('.count',li).data('count',counts).html(countss + 'x');
                console.log('33')
                if (countss == 0 ){
                    $(this).siblings('input:checkbox').attr('checked',false);
                    $('.preview img',li).removeClass('need-upload');
                    $(this).closest('li.tmpl').removeClass('selected');                    
                    $('.count',li).data('count',count).html('');
                }
                    
                
            }
        e.stopPropagation();
        e.preventDefault();
        return false;
    });    

    $("#cropper-modal").addClass($('input[name=layout_id]').val());
    
    var sku = $('input[name=sku]').val();
    $('#cropper-modal').addClass(sku);
    if (sku.substr(0,2)=='mg'){
        $('#cropper-modal').addClass('magnet');
    }
	
    var aR = $('ul.files').data('aspectratio');
	if (aR == 1) {
		$('.cropper-buttons-footer .orientate').hide();
	}

    
    var openCropper = function(e){                        
        var currentItem = $(this).parents('li');
        var currentImg = currentItem.find('.preview img').get(0);        		
		var obj = {}; 
		currentImg.src.replace(/([^=&]+)=([^&]*)/g, function(m, key, value) {
			obj[decodeURIComponent(key)] = decodeURIComponent(value);
		});

		var imgSrc = '/working/' + $('[name=item_id]').val() +'/'+ $(currentImg).data('file'); ;
        var caR = aR;
        var cropperImg = $('#cropper-modal #image').attr('src', imgSrc ).data('id',$(this).parents('li').data('id')).get(0);
        $('#cropper-modal .cropper-container').remove();                        
        var conSize =  (window.screen.width < 500 ) ? 320 : ( 500 ) ; 
        $('#cropper-modal .modal-dialog').width(conSize); 
			 
        var paddingTop = (conSize - conSize*aR)/2;
        $('#cropper-modal .modal-body').height(conSize).width(conSize) ;

        var crop_data = null;
        if ($(currentImg).siblings('input.crop').length){
            crop_data= $(currentImg).siblings('input.crop').val();
        }
        
        var cropbox ,canvasbox;
        var cropControl = function (e) {						
			if ($(cropper.dragBox).attr('data-action') == 'move') return;		
            var cb = cropper.getCropBoxData(1);   
			var cvb = (cropper.getCanvasData(1));			
			if (cb.width == cvb.width) {
				cb['left'] = cvb['left'];                    
			}else{				
				cb['top'] = cvb['top'];
			}						            			
            cropper.setCropBoxData(cb);                            
        };
        
		var maximize_cropbox = function(){
			var caR = $(currentImg).data('aspectRatio');
			var box = {top:0,left:0, width: conSize, height:conSize};			
			if ( caR > 1 ){				
				box.height = conSize / caR  ;			
				box.top    = Math.max(0,(conSize - box['height'])/2);					
			}else{				
				box.width 	= conSize*caR ;
				box.left 	= Math.max((conSize - box['width'])/2,0);								
			}						
			cropper.setCropBoxData(box);
			return box;
		}
		
		var maximize_canvas = function(){
			var cvd = cropper.getCanvasData();			
			var caR = $(currentImg).data('aspectRatio');			
			var cvR = cvd['width']/ cvd['height'];
			var box = {top:0,left:0, width: conSize, height:conSize};								
			if (cvR > 1){
				box.height = conSize / cvR;
				box.top = Math.max((conSize - box.height)/2,0);
			}else{
				box.width = conSize * cvR;
				box.left = Math.max((conSize - box.width)/2,0);
			}									
			cropper.setCanvasData(box);
			return box;
		}
		
		
		var fit_cropbox = function(cvd){
			var caR = $(currentImg).data('aspectRatio');
			
			var box = fit(cvd,caR);			
			console.log('fit_cropbox',caR,box);			
			cropper.setCropBoxData(box);
			console.log('fit_cropbox',caR,cropper.getCropBoxData());			
		}
		
		var fit_canvas = function(cbd){			
			var cvd = cropper.getCanvasData();
			var cvR = cvd['width'] / cvd['height'];						
			
			var box = fit(cbd,cvR);
			console.log('fit_canvas',box,cvR);
			cropper.setCanvasData(box);
		}
					
        
        var fit_image = function(){			
			fit_canvas(maximize_cropbox());
		};
		
		var fit_page = function(){			
			fit_cropbox(maximize_canvas());			
		};
        
        $('#cropper-modal .loading').show();
        var initCropper = function(cropperImg){
            return new Cropper(cropperImg,{
                    viewmode:1,
                    aspectRatio: aR,
                    autoCrop: 1/aR ,
                    autoCropArea:1,
                    strict: 0,
                    guides: 0,
                    center: 1,
                    moveable: 0,
                    highlight: 0,
                    dragCrop: 0,
                    dragMode: 'none',
                    toggleDragModeOnDblclick:0,
                    cropBoxMovable: true  ,
                    cropBoxResizable: 0,                    
                    responsive:0,          
                    checkOrientation:1,
                    modal:1,
                    zoomOnWheel:0,
                    zoomable:1,
                    zoomOnTouch:0,                    
                    toggleDragModeOnDblclick:0,
                    minContainerWidth:conSize,
                    minContainerHeight:conSize,                    
                    data : crop_data,                    
                    built: function () {
                        var cropper = this.cropper;             
                        cropper.reset();
                        cropbox = cropper.getCropBoxData(1);
						canvasbox= cropper.getCanvasData();
                        $('#cropper-modal .loading').hide();                        
                        $('#cropper-modal .cropper-canvas').off();
                        
                        
                        fit_image();
                        
                        
                        
                        $('.cropper-buttons-footer .orientate').off().on('click',function(){
                            caR = 1/caR;
                            cropper.setAspectRatio(caR);
                            $(currentImg).data('aspectRatio',caR);
							
							//maximize_canvas();
							//fit_cropbox();
							$('.cropper-buttons-footer .crop-control .btn').attr('disabled',false);
                            return ;
                        });
                        
                        $('.cropper-buttons-footer .rotate').off().on('click',function(){                                                        
                            cropper.rotate(90);                            
                        });
                        
                        $('.cropper-buttons-footer input.zoom').off().change(function(){
                            //cropper.reset();                            
                            cropper.zoomTo(this.value);                             
                        }).hide();
                        
                        $('.cropper-buttons-footer .zoom.out').off().on('click',function(){
                            cropper.zoom(-0.1);
                        });
                        $('.cropper-buttons-footer .zoom.in').off().on('click',function(){
                            cropper.zoom(0.1);
                        });
                                                
                        $('.cropper-buttons-footer .full-img').off().on('click',function(){
							fit_image();
                            $('.cropper-buttons-footer .crop-control .btn').attr('disabled',false);                            
                            $(this).attr('disabled',true);                            
                        });
                        
                        $('.cropper-buttons-footer .full-page').off().on('click',function(){
                            fit_page();
                            $('.cropper-buttons-footer .crop-control .btn').attr('disabled',false); 
                            $(this).attr('disabled',true);                            
                        });
						
                        $('.cropper-buttons-footer .undo').off().on('click',function(){                            
                            currentImg.src= '/working/'+$('[name=item_id]').val()+ '/' + $(currentImg).data('file');                            
                            $(currentImg).siblings('input[name^=crop]').val('');
                            cropper.reset();
                            //cropper = initCropper(cropperImg);
                            //delete currentImg;
                        });
                        $('.cropper-buttons .clear').off().on('click',function(){$('#cropper-modal').modal('hide');});
                        
                        $('.cropper-buttons-footer .ok').off().on('click',function(){
                            currentItem.addClass('loading').find('.overlay').append('<div class="loader"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
                            $('#cropper-modal button, #cropper-modal a').attr('disabled','disabled');
                            dir = $('[name=item_id]').val();
                            cropbox = cropper.getCropBoxData(1);
                            canvasbox= cropper.getCanvasData();
                            console.log(cropbox,canvasbox);
                            var type = 'image/jpg';
                            if ( $(currentImg).data('file') && $(currentImg).data('file').substr(-3) == 'png' ){
                                type = 'image/png';
                            }                            
                            
                            var cropData = cropper.getData(1); 
                            console.log(this, cropbox,canvasbox,cropData);
							//if ($('ul.files').data('aspectratio') !=  $(currentImg).data('aspectRatio') ){
							//	cropData['rotate'] = 90;
							//}
							var data = btoa(JSON.stringify( cropData));
                            // if ($(currentImg).siblings('input[name^=crop]').val()){
                                // currentImg.src = '/working/'+$('[name=item_id]').val()+ '/' + $(currentImg).data('file');                            
                            // }
                            $(currentImg).siblings('input[name^=crop]').val(data);
							
							var prData = {};
                            prData['crop'] = data;
                            prData['file'] = $(currentImg).data('file');
                            prData['item_id'] = $('[name=item_id]').val() ;
                            prData['pos'] = $(currentImg).data('pos') ;
                            
                            $.post('/?ACT=122',prData,function(res){});
                                                       
                            //$(currentImg).attr('src' , cropper.getCroppedCanvas().toDataURL(type)).addClass('need-upload');//.css('margin','');                                                        
                            $(currentImg).attr('src' , '/?ACT=122&file=' + $(currentImg).data('file')  + '&dir=' + dir + '&crop=' + data)
                                .load(function(){
                                        currentItem.removeClass('loading').find('.overlay .loader').remove();
                                        $('#cropper-modal').modal('hide');
                                    });;
							
                            
                            if ( $(currentImg).data('aspectRatio') > 1 ){                                
                                $(currentImg).parent().css('width','100%').css('margin','auto');
                            }else{                                
                                $(currentImg).parent().css('height','100%').css('margin','auto');
                            }
                            
                            /*
                            console.log($(currentImg).data('aspectRatio'));
                            if ( $(currentImg).data('aspectRatio') > 1 ){
								var w = (100/$(currentImg).data('aspectRatio'));
								$(currentImg).parent().css( {'height': (100/aR) + '%' });
                                
                            }else{
								var w = (100*$(currentImg).data('aspectRatio'));								
								$(currentImg).parent().css( { 'width': (100/aR) + '%', 'height':'100%','margin':"0 " + (100/aR/4) + "%" });
								$(currentImg).css({'width':'auto','height':'100%'});
                            }
                            */
							
							/*
                            var W = $(currentItem).width();
                            var H = $(currentItem).height();                            
                            var rect = [cropbox.top/canvasbox.height * H,(cropbox.left + cropbox.width)/canvasbox.width * W,
                                    (cropbox.top+cropbox.height)/canvasbox.height * H, cropbox.left/canvasbox.width * W ];                            
                            */
							fixArView(currentItem,false);                            							
                            //$('#cropper-modal').modal('hide');                
                        });
                        
                        cropperImg.addEventListener('zoom', function (e) {
                            console.log(e.detail.ratio);
                            $('.cropper-buttons-footer .zoom').val(e.detail.ratio);
                        });                                                
                        cropperImg.addEventListener('cropmove',cropControl);
                        cropperImg.addEventListener('cropend', cropControl);
                        
                    },
            }); 
        };
        
        $('#cropper-modal').off().on('show.bs.modal', function () {
            cropper = initCropper(cropperImg);
            $('#cropper-modal button, #cropper-modal a').removeAttr('disabled');
        }).on('hidden.bs.modal',function(){
            cropper.destroy();
            $('.cropper-buttons-footer .crop-control .btn').attr('disabled',false); 
            delete currentImg;
        });
        
        $('#cropper-modal').modal();
        e.stopPropagation();
        e.preventDefault();
        return false;
    };
    
    $('ul.files').on('click','li.tmpl .act-btn.edit', openCropper);
    $('ul.files').on('click','li.tmpl .act-btn.delete', remove_selection);
    
    $('ul.files').on('click','li.tmpl', img_select);    
});
