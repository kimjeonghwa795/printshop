
(function() {
	// getElementById
	function $id(id) {return document.getElementById(id);}
	// output information
	function Output(msg) {
            $id("messages").innerHTML = msg;		
	}
	// file drag hover
	function FileDragHover(e) {
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}
        function cancelUpload(e){
            e.stopPropagation();
            e.preventDefault();
            $('section.no-upload').hide();$('section#gallery').show().addClass('active'); e.stopPropagation();return false;
        }
        $('#cancelupload').on('click',cancelUpload);

	// file selection
        var maxSize = 5242880;
        var maxWidth = 3000;
        var maxHeight = 3000;
        var minWidth = 130;
        var minHeight = 130;

	function FileSelectHandler(e) {
		// cancel event and hover styling
		FileDragHover(e);

		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;
		
                //$('body').addClass('inprogress');
                var def = $.Deferred();
                                
                var afiles = new Array();
                for (var i = 0; i < files.length; ++i ) {
                    var ifile = files.item(i);
                    if ( !ifile.size) continue;
                    if ( ifile.size > maxSize ) continue;
                    if ( !ifile.type.startsWith('image') ) continue;                    
                    ifile.id = btoa(ifile.lastModified+ifile.name).replace(/=/g,'') ;
                    ifile.meta = JSON.stringify({});
                    afiles.push(ifile);
                }                
                
                if (afiles.length < files.length) {
                    return Output('Image too big, please replace with smaller image') ;
                }
                
                var FR = new FileReader();            
                var curIdx = 0 ; 
                var fileCnt = afiles.length;
                                              
                
                FR.onload = function (e){ 
                    var testImg = new Image();
                    testImg.src =  e.target.result;
                    //
                    //var exif = new ExifReader();
                    //exif.load(e.target.result);
                    //exif.loadView(new jDataView(e.target.result));
                    //console.log(exif);
                    
                    if (testImg.naturalWidth < minWidth) return Output('Image too small, please replace with bigger image');
                    if (testImg.naturalHeight < minHeight) return Output('Image too small, please replace with bigger image');                    
                    if (testImg.naturalWidth > maxWidth) return Output('Image too big, please replace with smaller image');
                    if (testImg.naturalHeight > maxHeight) return Output('Image too big, please replace with smaller image');                    
                                        
                    afiles[curIdx].fn = afiles[curIdx].id + afiles[curIdx].name.substr(-4);
                    var newImg = (tmpl('template-upload',afiles[curIdx]))  ;                                                      
                    newImg =  $(newImg).appendTo('#files');
                    
                    $('.preview img' ,newImg).attr('src',e.target.result);                    
                    //window.location.hash= '#gallery';                    
                };                                                            
                FR.onloadend = function(){
                    curIdx++;
                    if (curIdx == fileCnt) return def.resolve(curIdx);// $('body').removeClass('inprogress');
                    var file = afiles[curIdx];                                        
                    FR.readAsDataURL(file);
                    def.notify({progress: curIdx / fileCnt} );
                    $('#upload').hide();
                    $('#gallery').show();                    
                };
                
                if (fileCnt){                    
                    FR.readAsDataURL(afiles[curIdx]);                                
                }
                return def;
	}


	// output file information
	function ParseFile(file) {

		Output(
			"<p>File information: <strong>" + file.name +
			"</strong> type: <strong>" + file.type +
			"</strong> size: <strong>" + file.size +
			"</strong> bytes</p>"
		);

	}


	// initialize
	function Init() {

		var fileselect = $id("fileselect"),
                filedrag = $id("filedrag"),
		submitbutton = $id("submitbutton");

		// file select
		fileselect.addEventListener("change", FileSelectHandler, false);
                filedrag.addEventListener('click',function(){fileselect.click();}, false);

		// is XHR2 available?
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {
			// file drop
			filedrag.addEventListener("dragover", FileDragHover, false);
			filedrag.addEventListener("dragleave", FileDragHover, false);
			filedrag.addEventListener("drop", FileSelectHandler, false);
			filedrag.style.display = "block";

			// remove submit button
			submitbutton.style.display = "none";
		}

	}

	// call initialization file
	if (window.File && window.FileList && window.FileReader) {
		Init();
	}


})();
