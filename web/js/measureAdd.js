
var MeasureAdd = {
	init: function() 
	{
		this.autocomplete();
		this.commaFix();
		this.checkValidValues();
	},
	
	autocomplete: function()
	{
		$('#appbundle_measure_price').focusout(function() {
			if (
					$('#appbundle_measure_price').val() != '' &&
					$('#appbundle_measure_liter').val() != ''
				)
			{
				var value = $('#appbundle_measure_liter').val() * $('#appbundle_measure_price').val();
				$('#appbundle_measure_totalPrice').val(value.toFixed(2));
			}
		});
		
		$('#appbundle_measure_totalPrice').focusout(function() {
			console.log('focusOutTotal');
			if (
					$('#appbundle_measure_liter').val() != '' &&
					$('#appbundle_measure_totalPrice').val() != ''
				)
			{
				var value = $('#appbundle_measure_totalPrice').val() / $('#appbundle_measure_liter').val();
				$('#appbundle_measure_price').val(value.toFixed(2));
			}
			
			if (
					$('#appbundle_measure_price').val() != '' &&
					$('#appbundle_measure_totalPrice').val() != ''
				)
			{
				var value = $('#appbundle_measure_totalPrice').val() / $('#appbundle_measure_price').val();
				$('#appbundle_measure_liter').val(value.toFixed(2));
			}
		});
	},
	
	
	commaFix: function()
	{
		$('#appbundle_measure input[type="text"]').on('input', function() {
			$(this).val($(this).val().toString().replace(',', '.'));
		});
	},
	
	
	checkValidValues: function ()
	{
		var pattern = /^[\d|\.]*$/;
			
		$('#appbundle_measure input[type="text"]').on('focusout', function() {
			var val = $(this).val();
			
			if (!pattern.test(val))
			{
				alert('Wpisz poprawną wartość !');
				$(this).val('');
			}
		});
		
	}
}
	
MeasureAdd.init();