
$(function(){


	$('#agree1').click(function() {
		if ($(this).is(':checked')) {
			$('.order_submit').prop('disabled', false);
		}
		else {
			$('.order_submit').prop('disabled', true);
		}
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
	})

	//маска телефона
	$('input[type=tel]').mask('+7 (999)-999-99-99')

	//Селекты
	$('.selectWrap select').niceSelect()


	//Плавный скролинг к якорю
	$('a.scroll_link').click(function(){
	    var anchor = $(this)
		$('html, body').stop().animate({
			scrollTop: $(anchor.attr('href')).offset().top
		}, 500)

	    return false
	})
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