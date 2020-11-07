$(document).ready(function(){
	$('.menu li:has(ul)').click(function(){

		if($('#nav').hasClass('activo')){
			$(this).removeClass('activo');
			$(this).children('ul').slideUp();
		}else{
			$('.menu li ul').slideUp();
			$('.menu li').removeClass('activo');
			$(this).addClass('activo');
			$(this).children('ul').slideDown();
		}

	});


	$('.btn-menu').click(function(){
			$('.contenedor-menu .menu').slideToggle();
	});


});