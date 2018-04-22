jQuery(function ($) {

	$('.input-radio').unbind().change(function(){

		if ($(this).is(':checked')) {
			var elementoAdicionado = $(this).parent().parent().next().html();
			$("input[name='idLocal']").val(elementoAdicionado);

		} else {
			var elementoRemovido = $(this).parent().parent().next().html();
		}

	});



});