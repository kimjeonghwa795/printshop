$(function () {
    
    var srvUrl = $('#fileupload').attr('action');
    
    
    $("ul.nav-tabs").on('show.bs.tab', "li.disabled a", function(event) {
		event.stopImmediatePropagation();
        	return false;
    });
    $("ul.nav-tabs").off('show.bs.tab', "li:not(.disabled) a");
    
    var downloadResult = function(e){
        var croppicContainerModalOptions = {
                        uploadUrl: srvUrl, 
                        cropUrl:  srvUrl,
                        modal:true,
                        imgEyecandyOpacity:0.4,
                        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
        }
        var cropContainerModal = new Croppic($(e.target), croppicContainerModalOptions);        
    }
    
    var openPictureEditor = function(e){
        console.log(e);
        var croppicContainerModalOptions = {
                        uploadUrl: srvUrl, 
                        cropUrl:  srvUrl,
                        modal:true,
                        imgEyecandyOpacity:0.4,
                        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
        }
        var cropContainerModal = new Croppic(e.target, croppicContainerModalOptions);                
    }
    
    
    var remap = function(ev,ul){
        var files = new Array();
        var $files = $('ul.files');
        var max = $files.data('max_item');
        refill(ul, max );
//        $files.find('li:gt('+ (max - 1) +'):empty').remove();
        var page = $(ul).data('page');
        $('ul.pg').find('li:not(:empty)').each(function(i,item) {            
            files.push({'page':page, 'index' : $(item).index() , 'file':$(item).data('file') });
            //var replaced = $(ul).find('li:gt('+ $(item).index()  + '):empty').detach();
        });
        $('#map').val(JSON.stringify(files));

        return JSON.stringify(files);
    };

    
    var refill = function(el,max){
        //
        while ( $(el).find('li').length < max) {
            var index = ($(el).find('li').length) + 1 ;
            $('<li class="tmpl" data-index="'+ index +'"></li>').appendTo(el);
        }   
    }; 
    
    var relayout = function(e,data){
        $('ul.page.files .tmpl:empty').remove();
        var ul = $('ul.page.files:last()');
        var max = $(ul).data('max_item');
        var page = $(ul).data('page');
        
        ul.find('li .preview').unbind('click').click(openPictureEditor);
        
        while ( $(ul).find('li').length > max) {     
            var split = Math.floor($(ul).find('li').length/2 );
//            var newUL = $('<ul></ul>').insertAfter(ul).addClass('page files').data('page',page + 1).data('max_item',max);
            var moved = $(ul).find('li:gt('+ split +')').detach();
//            moved.appendTo(newUL);                
        }
        
        $('ul.nav-tabs li a[href=#result]').parent().removeClass('disabled');
        
        $('ul.page.files').each(function(i,el){       
            refill(el,max);
        });
        
        $('ul.files').sortable({
            'connectWith': '.layout .page ',
            'stop':function(ev,ui){
                remap(ev,this);
            },
        });
        remap(e,ul);
        return data;
    }


    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        // xhrFields: {withCredentials: true},        
//        url: $(this).attr('action')
        url: $('#fileupload').attr('action') + '?ACT=195',
        imageCrop:true,
        previewCrop:true,
        limitConcurrentUploads:12,
        autoUpload:true,
//        filesContainer:$('div[role=presentation].layout .page.files:last()'),
        getFilesFromResponse:function(data){
            if (data.result && data.result.files.length) {
                $('ul.page.files:last()').empty();
            }
            
            return data.result.files;
        },
        completed:relayout,
        added:relayout,  
        
    });


    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/upload/cors/result.html?%s'
        )
    );

    
    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0],
        data: $('#fileupload').serializeArray(),
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
        if (result.files.length)
            $('ul.nav-tabs li a[href=#result]').parent().removeClass('disabled');
    });
    
    
//});


});
