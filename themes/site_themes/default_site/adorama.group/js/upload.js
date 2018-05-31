$(function () {
    var serverUrl =  $('#fileupload').attr('action');

    $('.btn.next').click(function(){
        $('#fileupload').attr('action','/index.php');
        $('#fileupload [name=ACT]').val('279');
        $('#fileupload').submit();
        return false;
    });
    
    var resizeAndSave=function(fileUrl,cropBox,canvas){
        console.log('save',fileUrl,cropBox,canvas);         
        $.post(serverUrl,{file:fileUrl,crop:cropBox},function(r){
            console.log(r);
        });
    };
    var openCropDialog = function(fileUrl){
        var $image = $('#cropper-img > img'),
        cropBoxData = {'top':0,'left':150,'right':150,bottom:300},
        canvasData = {'top':0,'left':0,'right':600,bottom:600},
        containerData = {height:640,width:640};

        $('#cropper-img img').attr('src',fileUrl);
        $('#cropper-modal').on('show.bs.modal',function(e){                
                $('a','#cropper-modal').off('click').on('click',function(e){                    
                    $('#cropper-modal').modal('hide');
                    if ($(e.currentTarget).hasClass('ok')){                        
                        resizeAndSave(fileUrl,$image.cropper('getData',1),$image.cropper('getCanvasData'));
                    }
                }); 
        });
        $('#cropper-modal').on('shown.bs.modal', function () {
          $image.cropper({
            autoCropArea: 1,
            aspectRatio:1,
            strict: true,
            cropBoxMovable:1,
            cropBoxResizable:1,
            guides:0,
            minCropBoxWidth:300,
            minCropBoxHeight:300,
            minCanvasWidth:300,
            minCanvasHeight:300,
            minContainerHeight:500,
            minContainerWidth:500,
            built: function () {
              // Strict mode: set crop box data first
              $image.cropper('setCropBoxData', cropBoxData);
              $image.cropper('setCanvasData', canvasData);
              $image.cropper('setContainerData', containerData);
              $('.cropper-container.cropper-bg',this).css('height','auto');
            }
          });
        }).on('hidden.bs.modal', function (e) {
            
            
          cropBoxData = $image.cropper('getCropBoxData');
          canvasData = $image.cropper('getCanvasData');
          $image.cropper('destroy');
          console.log(cropBoxData);
          console.log(canvasData);
          
          console.log(e);
          if ($(e.currentTarget).hasClass('ok')){
              resizeAndSave(fileUrl,cropBoxData,canvasData);
          }
        });
        
        
        $('#cropper-modal').modal();
        return false;
    }


    $('#files').on('click','li.tmpl.download',function(e){
        
        var count =  $('.count',this).data('count') + 1;
        var total  = 0;
        $('.count','#files').each(function(i,el){            
            total += $(el).data('count');            
        });
        if (total >= $('input[name=maxFiles]').val() ) return ;
        
        $(this).addClass('selected');       
        $('.count',this).data('count',count).html(count +'x');
        $('input',this).val(count).attr('checked','checked');
        if (count  > 0 ){
            $('a.act-btn.delete',this).html('-').css('font-size','40px').css('color','#fff');
            $('input',this).attr('checked','checked');
        }
            
        e.stopPropagation();
        e.preventDefault();
    });
    
    $('#files').on('click','li.tmpl.download .act-btn.edit',function(e){        
        openCropDialog($(this).attr('href'));
        e.stopPropagation();
        e.preventDefault();
    });
    
    
    $('#files').on('click','li.tmpl .act-btn.delete',function(e){        
        var self = this;
        var count =  $(this).siblings('.count').data('count') - 1;
        console.log($(this),$(this).siblings('.count'));
        $(this).siblings('.count').data('count',count).html(count +'x');
        
        if (count == 0 ){
            $(this).closest('li.tmpl').removeClass('selected');
            $(this).html('<i class="fa fa-trash"/>').css('font-size','24px').css('color','red');
        }else{
            $(this).html('-').css('font-size','40px').css('color','#fff');
        } 
        
        if (count < 0 ) {
            $.get($(this).attr('href'), function(r){
                console.log($(self).closest('li.tmpl.download'));
                $(self).closest('li.tmpl.download').remove();
            });
        }
        
        e.stopPropagation();
        e.preventDefault();
    });
    
    $('#continue').click(function(){
        $('#fileupload [name=ACT]').val(225);
        console.log($('#fileupload [name=ACT]').val(),$('#fileupload').serializeArray());
        //$('#fileupload').submit();
        return false;
    });

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').attr('action'),
        autoUpload:true,
        imageCrop: false // Force cropped images
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').attr('action'),
        dataType: 'json',
        context: $('#fileupload')[0],
//        method:'POST',
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
        console.log(result);
            $('.pageof span').html( (result.page + 1) + '/' + Math.ceil(result.count/20) ).click(function(){
            console.log('repage');
            $('#fileupload').fileupload().trigger('fileuploadstart');
        }) ;

    });

    


});
