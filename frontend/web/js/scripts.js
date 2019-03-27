

$(function(){



	/*

	$('#agree1').click(function() {

		if ($(this).is(':checked')) {

			$('.order_submit').prop('disabled', false);

		}

		else {

			$('.order_submit').prop('disabled', true);

		}

	});

	

	

			var form = $("#order_form");



			$(".steps").steps({

				headerTag: "h3",

				bodyTag: "section",

				transitionEffect: "slideLeft",

				onStepChanging: function (event, currentIndex, newIndex)

				{

					//form.validate().settings.ignore = ":disabled,:hidden";

					return form.valid();

				},

				onFinishing: function (event, currentIndex)

				{

					//form.validate().settings.ignore = ":disabled";

					return form.valid();

				},

				onFinished: function (event, currentIndex)

				{

					alert("Submitted!");

				}

			});

	*/




	function validateField ( el, showError = 1 ){

	

		var field = el.attr('id');

		var value = el.val();

	
		var service_id = $('.service_id').val();
		

		if ( el.attr('type') == 'checkbox' ){

			if ( !el.prop("checked") ){

				value = '';

			}

		}


		$.ajax({

		    url: '/orders/validate/',

		    type: 'post',

		    data: {'field': field, 'value': value, 'service_id': service_id},

		    success: function (data) {

				error = null;

				var result = JSON.parse(data);

				for(k in result) {

					error = result[k];

				}

				if ( error ){

					if ( showError ){
					
						el.parent().addClass('has-error').removeClass('has-success');

						el.parent().find('.help-block').html(error); 
					}

					return false;

				}

				else {

					el.parent().removeClass('has-error').addClass('has-success');

					el.parent().find('.help-block').html('');

					return true;

				}

				

		   }

		});

	

	

	}



	jQuery('body').on( 'keypress', '.kirilica', function(e){



		var char = /["а-яА-Я- -]/;

		var val = String.fromCharCode(e.which);

		var test = char.test(val);

		

		if(!test) {

			$(this).parent().find('.help-block').html('Только кирилица!'); 

			return false;

		}

	});

	jQuery('.summa').attr('inputmode', 'numeric');

	jQuery('body').on( 'keypress', '.summa', function(e){





		var char = /["0-9]/;

		var val = String.fromCharCode(e.which);

		var test = char.test(val);

		//$(this).parent().find('.help-block').html('Только кирилица!');

		if(!test) {

			$(this).parent().find('.help-block').html('Только цифры!'); 

			return false;

		}

	});

	



	

	jQuery('body').on( 'change', '#order-form .required input', function(){

		

		var el = $(this);

		validateField(el);

		

	});
	
	jQuery('body').on( 'keypress', '#order-form .required input', function(e){

		var el = $(this);

		validateField(el, 0);
	
	});
	

	jQuery('body').on( 'change', '#order-form .required select', function(){



		var el = $(this);

		validateField(el);

		

	});

	

	

	jQuery('body').on( 'change', '.has-error input', function(){



		$(this).parent().removeClass( 'has-error' );

		$(this).parent().find( '.help-block' ).text('');

		

	});

	

	jQuery('body').on( 'change', '.has-error select', function(){



		$(this).parent().removeClass( 'has-error' );

		$(this).parent().find( '.help-block' ).text('');

		

	});

	

	jQuery('body').on( 'click', '.summa', function(){



		var value = $(this).val();

		value = value.replace(/\s+/g, '');

		$(this).val( value );

		

	});

	

	jQuery('body').on( 'focusout', '.summa', function(){



		var value = $(this).val();

		if ( value ){

			value = value.replace(/\s+/g, '');

			var value = parseInt(value);

			$(this).val( value.toLocaleString('ru') );

		}

		

	});

	

	jQuery('body').on( 'change', '.summa', function(){



		var value = $(this).val();

		if ( value ){

			value = value.replace(/\s+/g, '');

			var value = parseInt(value);

			$(this).val( value.toLocaleString('ru') );

		}

		

	});

	jQuery('body').on( 'click', '.show_more', function(){


		$(this).hide();
		$('.more_info').show();
		return false;
		

	});

  

	if( $(window).width() < 1024 ) {

		// Слайдер Услуги

		$owl = $('.amenities').owlCarousel({

			loop: true,

			dots: true,

			nav: true,

			navSpeed: 500,

			dotsSpeed: 500,

			onInitialized: function (event) {

				setHeight( $(event.target).find('.item'))

			},

			onResized: function (event) {

				$(event.target).find('.item').height('auto')



				setHeight( $(event.target).find('.item'))

			},

			responsive : {

				// breakpoint from 1024 up

				768 : {

					items: 2,

					margin: 20

				},

				// breakpoint from 480 up

				480 : {

					items: 2,

					margin: 20

				},

				// breakpoint from 480 up

				0 : {

					items: 1,

					margin: 20

				}

			}

		})

	}



	//Слайдер бпартнеров

	$('.slider_partners').owlCarousel({

		margin: 20,

		loop: true,

		dots: true,

		nav: true,

		navSpeed: 500,

		dotsSpeed: 500,

		responsive : {

			// breakpoint from 1024 up

			768 : {

				items: 4

			},

			// breakpoint from 480 up

			480 : {

				items: 2

			},

			// breakpoint from 480 up

			0 : {

				items: 1

			}

		}

	})



	//Слайдер отзыов

	$('.slider_reviews').owlCarousel({

		loop: true,

		dots: true,

		nav: true,

		navSpeed: 500,

		dotsSpeed: 500,

		onInitialized: function (event) {

			setHeight( $(event.target).find('.comment'))

		},

		onResized: function (event) {

			$(event.target).find('.comment').height('auto')



			setHeight( $(event.target).find('.comment'))

		},

		responsive : {

			// breakpoint from 1024 up

			1024 : {

				items: 2,

				margin: 40

			},

			// breakpoint from 768 up

			768 : {

				items: 2,

				margin: 20

			},

			// breakpoint from 480 up

			480 : {

				items: 1,

				margin: 20

			},

			// breakpoint from 480 up

			0 : {

				items: 1,

				margin: 20

			}

		}

	})



	//Слайдер статей

	$('.slider_articles').owlCarousel({

		loop: true,

		dots: true,

		nav: true,

		navSpeed: 500,

		dotsSpeed: 500,

		onInitialized: function (event) {

			setHeight( $(event.target).find('.article'))

		},

		onResized: function (event) {

			$(event.target).find('.article').height('auto')



			setHeight( $(event.target).find('.article'))

		},

		responsive : {

			// breakpoint from 1024 up

			1024 : {

				items: 2,

				margin: 40

			},

			// breakpoint from 768 up

			768 : {

				items: 2,

				margin: 20

			},

			// breakpoint from 480 up

			480 : {

				items: 1,

				margin: 20

			},

			// breakpoint from 480 up

			0 : {

				items: 1,

				margin: 20

			}

		}

	})



	//Слайдер Преимущества

	$('.advantages').owlCarousel({

		loop: true,

		dots: true,

		nav: true,

		navSpeed: 500,

		dotsSpeed: 500,

		mouseDrag: false,

		onInitialized: function (event) {

			setHeight( $(event.target).find('.slide'))

		},

		onResized: function (event) {

			$(event.target).find('.slide').height('auto')



			setHeight( $(event.target).find('.slide'))

		},

		responsive : {

			// breakpoint from 1024 up

			1024 : {

				items: 3,

				margin: 40

			},

			// breakpoint from 768 up

			768 : {

				items: 3,

				margin: 20

			},

			// breakpoint from 480 up

			480 : {

				items: 2,

				margin: 20

			},

			// breakpoint from 480 up

			0 : {

				items: 1,

				margin: 20

			}

		}

	})



	//Слайдер Схема работы

	$('.slider_scheme').owlCarousel({

		loop: true,

		dots: true,

		nav: true,

		navSpeed: 500,

		dotsSpeed: 500,

		mouseDrag: false,

		onInitialized: function (event) {

			setHeight( $(event.target).find('.slide'))

		},

		onResized: function (event) {

			$(event.target).find('.slide').height('auto')



			setHeight( $(event.target).find('.slide'))

		},

		responsive : {

			// breakpoint from 1024 up

			1024 : {

				items: 3,

				margin: 40

			},

			// breakpoint from 768 up

			768 : {

				items: 3,

				margin: 20

			},

			// breakpoint from 480 up

			480 : {

				items: 2,

				margin: 20

			},

			// breakpoint from 480 up

			0 : {

				items: 1,

				margin: 20

			}

		}

	})



	if( $(window).width() < 1024 ) {

		//Слайдер Выгодные предложения

		$('.mob_profitably').owlCarousel({

			loop: true,

			margin: 20,

			dots: true,

			nav: true,

			navSpeed: 500,

			dotsSpeed: 500,

			mouseDrag: false,

			onInitialized: function (event) {

				setHeight( $(event.target).find('.item'))

			},

			onResized: function (event) {

				$(event.target).find('.item').height('auto')



				setHeight( $(event.target).find('.item'))

			},

			responsive : {

				// breakpoint from 768 up

				768 : {

					items: 3

				},

				// breakpoint from 480 up

				480 : {

					items: 2

				},

				// breakpoint from 480 up

				0 : {

					items: 1

				}

			}

		})

	}





	// Всплывающие окна

	$('.modal_link').click(function(e){

		e.preventDefault()



		$.fancybox.close()



		$.fancybox.open({

			src  : $(this).attr('href'),

			type : 'inline',

			opts : {

				speed: 300,

				autoFocus : false,

				i18n : {

					'en' : {

						CLOSE : 'Закрыть'

					}

				},

				touch : false

			}

		})

	})



	// Увеличение картинки

	$('.fancy_img').fancybox({

		transitionEffect : 'slide',

		animationEffect : 'fade',

		i18n : {

			'en' : {

				CLOSE : 'Закрыть'

			}

		}

	})





	// Моб. меню

	firstClick = false

    $('header .mob_menu_link').click(function(e){

    	e.preventDefault()



		if( $(this).hasClass('active') ){

			$(this).removeClass('active')



			$('header .line_menu').slideUp(200)



			firstClick = false

		} else{

			$(this).addClass('active')



			$('header .line_menu').slideDown(300)



			firstClick = true

		}

    })



    if( $(window).width() < 1024 ) {

	    //Закрываем всплывашку при клике вне неё

		$(document).click(function(e){

		    if (!firstClick && $(e.target).closest('.line_menu').length == 0){

		        $('header .line_menu').fadeOut(300)



		        $('header .mob_menu_link').removeClass('active')

		    }

		    firstClick = false

		})

	}

	



	if( $(window).width() < 1024 ) {

	    //Фильтр

		$('footer .title_menu').click(function(e){

			e.preventDefault()

				

			if($(this).hasClass('active')){

				$(this).removeClass('active').next().slideUp(300)

			}else{

				$('footer .title_menu').removeClass('active')

				$('footer .menu').slideUp(300)

				$(this).addClass('active').next().slideDown(300)

			}

		})

	}





	//Аккордион

	$('.accordion .open_sub').click(function(e){

		e.preventDefault()



		if($(this).hasClass('active')){

			$(this).find('.more').text('Подробнее')

			$(this).removeClass('active').next().slideUp(300)

		}else{

			$(this).find('.more').text('Подробнее')

			$('.accordion .open_sub').removeClass('active')

			$('.accordion .on').slideUp(300)

			$(this).find('.more').text('Скрыть')

			$(this).addClass('active').next().slideDown(300)

		}

	})



	$('.accordion .more_hide').click(function(e){

		e.preventDefault()



		$(this).parent().slideUp(300)



		var boxParent = $(this).parents('.accordion')



		boxParent.find('.open_sub').removeClass('active')



		boxParent.find('.more').text('Подробнее')

	});
	
	$('.offer_link').click(function(e){

		window.open( $(this).attr('href'), "_blank");
	});



	//маска телефона

	$('input[type=tel]').mask('+7 (999)-999-99-99')

	//маска даты

	$('input.date').mask('99.99.9999');



	//Селекты

	$('.selectWrap select').niceSelect()





	//Плавный скролинг к якорю

	$('a.scroll_link').click(function(){

	    var anchor = $(this)

		$('html, body').stop().animate({

			scrollTop: $(anchor.attr('href')).offset().top

		}, 500)



	    return false

	});
	
	$('#kredit-name-top').change(function(e){
		$('#kredit-name').val( $(this).val() ).keyup();	
	});
	
	$('#kredit-phone-top').change(function(e){
		$('#kredit-phone').val( $(this).val() ).keyup();	
	});

})



	





function setHeight(className){

	var maxheight = 0

	$(className).each(function() {

		if($(this).innerHeight() > maxheight) {

			maxheight = $(this).innerHeight()

		}

	})

	$(className).innerHeight(maxheight)

}

function filterOffer() {

    var price=$('#filter-offer-price').val();
	price = price.replace(/\s/g, '');
    var date=$('#filter-offer-date li.selected').data("value");



    $('.mob_profitably.owl-carousel [data-element="true"]').each(function() {

    	var visible=true;



        if(

			($( this ).data( "min-term" )>date||date>$( this ).data( "max-term" ))

			&&date!=""

		)

		{

            visible=false;

		}



        if(

			($( this ).data( "min-price" )>price||price>$( this ).data( "max-price" ))

            &&price!=""

		)

        {

            visible=false;

        }



        if(visible)

		{

            $( this ).css('display',"flex")

		}

		else

		{

            $( this ).css('display',"none")

		}



    });



    console.log(price);

    console.log(date);

}

$(document).ready(function() {
	$('.slider_articles .owl-item .article').each(function() {
		var article_margin = $(this).height() - $(this).find('.tag').height() - $(this).find('.name').height() - $(this).find('.text').height() - $(this).find('.box').height() - 24;
		console.log(article_margin);
		$(this).find('.box').css('margin-top', article_margin);
	});

	console.log($('.section_first .title_inner').height());
	if ($('.section_first .title_inner').height() < 60) {
		$('.section_first').addClass('section_mini_title');
	}
});

function gotoform() {
	if ($(window).width() <= '767') {
		$('.table_profitably').attr('id', 'table_profitably');
		var scroll_el = $(this).attr('href'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
		if ($(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
			$('html, body').animate({ scrollTop: $(scroll_el).offset().top }, 500); // анимируем скроолинг к элементу scroll_el
	        }
	    return false; // выключаем стандартное действие
	}
}