
var measureIndex = {
	init: function() {
		this.expandItems();
	},
	
	expandItems: function() {
		console.log('jestInit');
		$('.item-header').on('click', function() {
			$(this).next('.item-body').slideToggle(300);
			$(this).parent().toggleClass('active');
		})
	}
}

measureIndex.init();