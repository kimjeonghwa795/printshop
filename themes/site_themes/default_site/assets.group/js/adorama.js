(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73277062-3', 'auto');
  ga('send', 'pageview');

$.extend({
    replaceTag: function (currentElem, newTagObj, keepProps) {
        var $currentElem = $(currentElem);
        var i, $newTag = $(newTagObj).clone();
        if (keepProps) {//{{{
            newTag = $newTag[0];
            newTag.className = currentElem.className;
            $.extend(newTag.classList, currentElem.classList);
            $.extend(newTag.attributes, currentElem.attributes);
        }//}}}
        $currentElem.wrapAll($newTag);
        $currentElem.contents().unwrap();
        // return node; (Error spotted by Frank van Luijn)
        return this; // Suggested by ColeLawrence
    }
});

$.fn.extend({
    replaceTag: function (newTagObj, keepProps) {
        // "return" suggested by ColeLawrence
        return this.each(function() {
            jQuery.replaceTag(this, newTagObj, keepProps);
        });
    }
});
  
Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };  
$(document).ready(function(){    
    $('header .navbar-default .navbar-collapse .nav-button').on('click',function(){
        $('header .navbar-default .navbar-collapse .nav-toggle').removeClass('hide');
        $('header .navbar-default .navbar-collapse ul .nav-button').on('click',function(){
            $('header .navbar-default .navbar-collapse .nav-toggle').addClass('hide');
        })
    })
    
$('.usermenu').load('/assets/usermenu');    

(function ($) {
      $.each(['show', 'hide'], function (i, ev) {
        var el = $.fn[ev];
        $.fn[ev] = function () {
          this.trigger(ev);
          return el.apply(this, arguments);
        };
      });
      



//$('.cartmenu').load('/assets/cartmenu');

    
//    setTimeout(function(){$('.header-top').slideUp();},5000);
    
    $('.qty-item').click(function(){ $('.border-style').addClass('active');});
    
    $('header .collapse-overlay').click(function(){$('header .navbar-collapse').removeClass('in');});
    
    $("img").unveil();

    if ($('body').hasClass('home')){
        $('.navbar-brand.logo img').attr('src','/themes/site_themes/default_site/assets.group/images/svg/logowhite.svg')
    } 
    if ($('body .page').hasClass('photoprint-info')){
        $('section.be-friend').hide();
        $('section.emailus').css('background','#F7F7F7');
    }
    $('.carousel').carousel({interval: 6000});
     
//    setTimeout('$(".header-top").hide("fadeUp")',5000);

    if ($('body').hasClass('home')){
        $('.navbar ').removeClass('navbar-white');
    };
    
    
     $('a').hover(            
            function(){
                var a = this;
                setTimeout(function(){
                    $(a).addClass('active');
                }, 300);
            },
            function(){
                var a = this;
                setTimeout(function(){
                    $(a).removeClass('active');
                }, 300);                
             }
    );

$('.datepicker').datepicker();

$('form button').on('click', function(){
    $('p.req-item').remove();
    if(!$('.qty-item').hasClass('active')){
        $('.border-style').prepend('<p class="req-item" style="color: red;position: absolute;left: 0;right: 0;top: -25px;">select one first...</p>');
        return false;
    }else{
        return true;
    }
})
});
 

//setTimeout(function(){$('.header-top').hide();},5000);


//$(window).on('resize',equalGrids);
//var stickyOffset = $('.header-top').offset().top;

//$(window).scroll(function(){
//  var sticky = $('.header-top'),
//      scroll = $(window).scrollTop();
//
//  if (scroll >= stickyOffset) sticky.addClass('fixed');
//  if (scroll == 0) sticky.removeClass('fixed');
//});
$.fn.changebank = function() {
    $('.bank-payment').hide(); 
//    //console.log($('.bank-payment.'+ $('.bank-select').val()));
    $('.bank-payment.' + $('.bank-select').val()).css('display','');
};

$.fn.scrollTo = function( target, options, callback ){
  if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
  var settings = $.extend({
    scrollTarget  : target,
    offsetTop     : 50,
    duration      : 500,
    easing        : 'swing'
  }, options);
  return this.each(function(){
    var scrollPane = $(this);
    var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
    var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
    scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
      if (typeof callback == 'function') { callback.call(this); }
    });
  });
};
$('#sh-footer').click(function(e){
    $('.footer-toggler').toggleClass('active');
    $(this).toggleClass('yellow');
    if($(this).hasClass('up')){
            $(this).html('Hide Footer <i class="fa fa-caret-up careD"></i>').removeClass('up');
    }else{
            $(this).html('Show Footer <i class="fa fa-caret-down careD"></i>').addClass('up');
    }
    $('html, body').animate({scrollTop: $(document).height()}, 250);
    e.stopPropagation();
});

});
//$('.border .button-back .btn').click(function(){
//    if (!$('.qty-item').hasClass("active")) {
//        $('.warn').remove();
//        $('.content .border-style').prepend('<span class="warn" style="color:#ff1212">Please Select One!</span>')
//    }
//})