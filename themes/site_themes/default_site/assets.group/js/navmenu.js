$(document).on('click','#navmenu', function(e){
	e.preventDefault();
	$('body').toggleClass('toRight');
	$('.collapse').toggleClass('menuRight');
});