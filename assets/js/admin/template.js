(function ($) {
	$('.page-title-action').on('click', function (e) {
		e.preventDefault();
		var drawer = Alpine.store('DoatKolomUiDrawer');
		drawer.setContentByApi(
			wpApiSettings.root + 'super-docs/template/create',
			{
				headers: {
					'X-WP-Nonce': wpApiSettings.nonce
				}
			},
			'superDocsCreateTemplate'
		);
		drawer.changeStatus();
	})
}(jQuery));