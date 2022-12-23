(function ($) {
	$('.page-title-action').on('click', function (e) {
		e.preventDefault();
		var drawer = Alpine.store('DoatKolomUiDrawer');
		drawer.width = '400px';
		drawer.setContentByApi(
			wpApiSettings.root + 'wp-guide/template/create',
			{
				headers: {
					'X-WP-Nonce': wpApiSettings.nonce
				}
			}
		);
		drawer.changeStatus();
	})
}(jQuery));