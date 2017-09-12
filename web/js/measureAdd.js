
var MeasureAdd = {
	init: function() 
	{
		this.autocomplete();
	},
	
	autocomplete: function()
	{
		$('#appbundle_measure_price').focusout(function() {
			console.log('focusOutprice');
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
	}
}
	
MeasureAdd.init();