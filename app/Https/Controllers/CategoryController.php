<?php

namespace WpGuide\App\Https\Controllers;

use WP_REST_Request;
use WpGuide\Bootstrap\View;

class CategoryController
{
    public function get()
    {
        View::send( 'admin/pages/category/order-page' );
    }

    public function create_page()
    {
        View::send( 'admin/pages/category/create' );
    }

	public function create(WP_REST_Request $wpRestRequest)
	{

		
$moveIcon = '<svg class="cursor-move" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
<path fill="none" d="M0 0h24v24H0V0z"/>
<path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
</svg>';

ob_start();
?>
<div class="bg-slate-50 font-primary capitalize shadow p-2">
	<div class="float-left">
		<?php echo $moveIcon; ?>
	</div>
	<div class="float-left pl-2">
		Item 1
	</div>
	<div class="float-right">
		<span x-on:click="show()" x-data="modalButton">
			<button type="button" class="rounded-md text-xs px-4 py-0.5 shadow text-neutral-50 !bg-amber-400">
				Edit
			</button>
		</span>
	</div>
</div>
<div class="bg-slate-50 font-primary capitalize shadow p-2">
	<div class="float-left">
		<?php echo $moveIcon; ?>
	</div>
	<div class="float-left pl-2">
		Item 2
	</div>
	<div class="float-right">
		<span x-on:click="show()" x-data="modalButton">
			<button type="button" class="rounded-md text-xs px-4 py-0.5 shadow text-neutral-50 !bg-amber-400">
				Edit
			</button>
		</span>
	</div>
</div>
<?php
$content =  ob_get_clean();
	$accordion = [
		'title' => 'item '. time(),
		'head' => '<button type="button" x-data="modalButton" x-on:click="show" class="rounded-md text-xs px-4 py-0.5 mr-7 shadow text-neutral-50 !bg-amber-400">Edit</button>',
		'content' =>$content,
		'icon' => $moveIcon
	];


		return $accordion;
	}
}
