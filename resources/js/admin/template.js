(function ($) {
	$('.page-title-action').on('click', function (e) {
		e.preventDefault();
		var drawer = Alpine.store('DoatKolomUiDrawer');
		drawer.setContentByApi(
			SuperDocsSettings.root + 'superdocs/template/create',
			{
				headers: {
					'X-WP-Nonce': SuperDocsSettings.nonce
				}
			},
			'superDocsCreateTemplate'
		);
		drawer.changeStatus();
	})
}(jQuery));