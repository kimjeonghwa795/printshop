 var upload_file = function(img){
        var form = $('#fileupload');
        var def = $.Deferred();       
        $('input[name=filename]',form).val(img.data('file'));
        $('input[name=filecanvas]',form).val(img.attr('src').replace(/^data:image\/(png|jpg|jpeg|);base64,/, ""));        
        $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: form.serialize(),
                    dataType: "JSON",
                    success: function(res){
                            var li = img.closest('li.tmpl');                            
                            img.removeClass('need-upload');
                            if (res.files.length > 0){
                                img.attr('src',res.files[0].url);
                            }
                                
                            def.resolve(res);
                        }
                    });
        return def;
    };
     var openCropper = function(e){        
        console.log('abc',$('img',$(this).closest('li')).get(0));        
        currentImg = $('a.preview img',$(this).closest('li'));
        $('a.preview',$(this).closest('li')).fluidbox()
            /*.bind('fluidboxBeforeShow', function(event, item) {
                if(item.index == 0) {
                    item.animation = {
                        next: {
                            in: 'rotateInDownRight',
                            out: 'rotateOutUpLeft'
                        },
                        prev: {
                            in: 'rotateInDownLeft',
                            out: 'rotateOutUpRight'
                        }
                    };
                }                            
            })*/
            .bind('fluidboxBeforeClose',function(e,item){
                $('#fluidbox-inner img').cropper('destroy');
                $('body').css('overflow','');                
                })
            .bind('fluidboxAfterShow', function(e,item){
                console.log(this,e, item);
                var that = this;
                console.log('fluidboxAfterShow');
                //$('#fluidbox-inner img').cropper('destroy');
                var $image = $('#fluidbox-inner img'),
                cropBoxData = {'top':0,'left':150,'right':150,bottom:300},
                canvasData = {'top':0,'left':0,'right':600,bottom:600},
                containerData = {height:640,width:640};
                $image.cropper('destroy');
                $image.cropper({
                    aspectRatio: 1,
                    autoCropArea: 1,
                    strict: false,
                    guides: false,
                    center: true,
                    moveable: false,
                    highlight: false,
                    dragCrop: false,
                    mouseWheelZoom:false,
                    cropBoxMovable: true,
                    cropBoxResizable: false,
                    setDragMode: 'crop',
                    built: function () {
                        var cropperbutton = 
                        '<div class="cropper-buttons">\n\
                            <button type="button" class="btn btn-primary flat rotate"><i class="fa fa-rotate-right"></i></button>\n\
                            <button type="button" class="btn btn-primary flat vertical"><i class="fa fa-arrows-v"></i></button>\n\
                            <button type="button" class="btn btn-primary flat horizontal"><i class="fa fa-arrows-h"></i></button>\n\
                            <button type="button" class="btn btn-primary flat clear"><i class="fa fa-remove"></i></button>\n\
                            <button type="button" class="btn btn-primary flat ok"><i class="fa fa-check"></i></button>\n\
                        </div>';
                        $('.cropper-buttons').remove();
                        $('#fluidbox-outer').prepend(cropperbutton);
                        $('#fluidbox-btn-close').html('<button type="button" class="btn btn-primary flat"><i class="icon-remove"></i></button>');
                      // Strict mode: set crop box data first
                      //$image.cropper('setCropBoxData', cropBoxData);
                      //$image.cropper('setCanvasData', canvasData); 
                        //                        cropper button
                        $('.cropper-buttons .rotate').on('click',function(){
                            $image.cropper("rotate",5);
                        });
                        
                        $('.cropper-buttons .vertical').on('click',function(){
                            
                            var ratio = $image.cropper('getImageData').aspectRatio;
                            console.log($image.cropper('getCanvasData').height , $image.cropper('getCropBoxData').height);
                            
                            if ($image.cropper('getCanvasData').height > $image.cropper('getCropBoxData').height ){ // melebar
                                ratio = - ($image.cropper('getCropBoxData').height / $image.cropper('getCanvasData').height);
                                $image.cropper("zoom",ratio);
                                $(this).attr('disabled',true);
                            }
                        });
                        $('.cropper-buttons .horizontal').on('click',function(){
                            var ratio = $image.cropper('getImageData').aspectRatio;
                            console.log($image.cropper('getCanvasData').width , $image.cropper('getCropBoxData').width);
                            
                            if ($image.cropper('getCanvasData').width > $image.cropper('getCropBoxData').width ){ // melebar
                                ratio = - ($image.cropper('getCropBoxData').width / $image.cropper('getCanvasData').width);
                                $image.cropper("zoom",ratio);                            
                            $(this).attr('disabled',true);
                            }
                            
                        });
                        $('.cropper-buttons .clear').on('click',function(){
                            $image.cropper("reset");
                            $('.cropper-buttons .btn').attr('disabled',false);
                            $.fluidbox.close();
                        });
                        $('.cropper-buttons .ok').on('click',function(){
        //                  $('#fluidbox-outer').html($image.cropper("crop"));
                            console.log($image.cropper('getCroppedCanvas'),$image.cropper('getCroppedCanvas').toDataURL('image/png'));
                            console.log(currentImg,$(currentImg).attr('src'));
                            var type = 'image/jpg';
                            if ($(currentImg).data('file').substr(-3) == 'png' ){
                                type = 'image/png';
                            }
                            
                            $(currentImg).addClass('need-upload').attr('src' , $image.cropper('getCroppedCanvas').toDataURL(type));
                            //saveCanvasToImg(currentImg);
                            $.fluidbox.close();
//                            upload_file(currentImg);
                            
                        });
                        //end button
                    }
                  });
        }).click();

        e.stopPropagation();
        e.preventDefault();
        return false;
    };
    