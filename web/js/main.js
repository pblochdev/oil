var main = {
	init: function() {
		this.menu();
	},
	
	menu: function() {
		$('#menu_icon').on('click touch', function() {
			$('body').toggleClass('collapsed');
		});
	}
}

main.init();