$(function () {
    function remap(ev,el){
        console.log( ev, el, this);
    };
    
    $('ul.files').sortable({
            'placeholder': "ui-state-default",
            
            'stop':function(ev,ui){
                remap(ev,this);
            },
    });    
    
     $( "ul.files" ).disableSelection();
});
