$(function(){



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

}
