$(document).ready(function(){
	var imgItems = $('.slider .li').length; // Numero de Slides
	var imgPos = 1;

	// Agregando paginacion --
	for(i = 1; i <= imgItems; i++){
		$('.pagination').append('<li><i class="fas fa-circle"></i></li>');
	} 
	//------------------------

	$('.slider .li').hide(); // Ocultanos todos los slides
	$('.slider .li:first').show(); // Mostramos el primer slide
	$('.pagination li').css({'color': 'rgba(236, 101, 39,0.5)'}); 
	$('.pagination li:first').css({'color': '#EC6527'}); // Damos estilos al primer item de la paginacion

	// Ejecutamos todas las funciones
	$('.pagination li').click(pagination);
	$('.right span').click(nextSlider);
	$('.left span').click(prevSlider);

	setInterval(nextSlider, 7000);



	// FUNCIONES =========================================================

	function pagination(){
		var paginationPos = $(this).index() + 1; // Posicion de la paginacion seleccionada

		$('.slider .li').hide(); // Ocultamos todos los slides
		$('.slider .li:nth-child('+ paginationPos +')').fadeIn(); // Mostramos el Slide seleccionado

		// Dandole estilos a la paginacion seleccionada
		$('.pagination li').css({'color': 'rgba(236, 101, 39,0.5)'});
		$(this).css({'color': '#EC6527'});

		imgPos = paginationPos;

	}

	function nextSlider(){
		if( imgPos >= imgItems){imgPos = 1;} 
		else {imgPos++;}

		$('.pagination li').css({'color': 'rgba(236, 101, 39,0.5)'});
		$('.pagination li:nth-child(' + imgPos +')').css({'color': '#EC6527'});

		$('.slider .li').hide(); // Ocultamos todos los slides
		$('.slider .li:nth-child('+ imgPos +')').fadeIn(); // Mostramos el Slide seleccionado

	}

	function prevSlider(){
		if( imgPos <= 1){imgPos = imgItems;} 
		else {imgPos--;}

		$('.pagination li').css({'color': 'rgba(236, 101, 39,0.5)'});
		$('.pagination li:nth-child(' + imgPos +')').css({'color': '#EC6527'});

		$('.slider .li').hide(); // Ocultamos todos los slides
		$('.slider .li:nth-child('+ imgPos +')').fadeIn(); // Mostramos el Slide seleccionado
	}

});