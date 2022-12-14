
<?php

use DoatKolom\Ui\Components\Accordion;
use DoatKolom\Ui\Components\Modal;
use DoatKolom\Ui\Utils\Common;

$headers = [
	'headers' => [
		'X-WP-Nonce' => wp_create_nonce( 'wp_rest' )
	]
];

$categoryDataKey = Common::generateRandomString( 10 );

$moveIcon = '<svg class="cursor-move" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
<path fill="none" d="M0 0h24v24H0V0z"/>
<path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
</svg>';

$items = [
	[
		'title' => 'item 1',
		'head' => function() {
			?>
				<button type="button" x-data="modalButton" x-on:click="show" class="rounded-md text-xs px-4 py-0.5 mr-7 shadow text-neutral-50 !bg-amber-400">
					Edit
				</button>
			<?php
		},
		'content' => function() use($moveIcon) {
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
		},
		'icon' => $moveIcon
	],
	[
		'title' => 'item 2',
		'head' => function() {
			?>
				<button type="button" class="rounded-md text-xs px-4 py-0.5 mr-7 shadow text-neutral-50 !bg-amber-400">
					Edit
				</button>
			<?php
		},
		'content' => function() use($moveIcon) {
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
		},
		'icon' => $moveIcon
	],
];

?>
<!-- px-5 py-3 -->
<div class="rounded-xl p-7">
	
	<!-- <div class="flex justify-center"> -->

	<?php

	$accordion = new Accordion;
	$accordion->start( [
		'init'     => false,
		'position' => 'left',
		'multiple' => true,
		'classes'  => [
			'body'      => '',
			'tablist'   => '',
			'tabpanels' => 'bg-white',
			'accordionHead' => 'bg-slate-100',
			'accordionContent' => 'px-6 py-4'
		]
	], $items );


	?>

	<div x-data="<?php echo $categoryDataKey?>">
		<div class="justify-between mb-10">
			<h4 class="text-[20px] font-bold font-primary text-heading mb-9 inline"><?php esc_html_e('Category List', 'wp-guide')?></h4>
			<div class="float-right">
				<button x-on:click="createCategory($data)" class="cursor-pointer font-semibold rounded-md px-7 py-3 text-white items-center bg-primary hover:bg-primary-hover">
				+ <?php esc_html_e('Add Category', 'wp-guide')?>
				</button>
			</div>
		</div>
	<?php $accordion->content(); ?>
	</div>
 	<?php $accordion->end(); ?>
</div>
<script>
	Alpine.data('<?php echo $categoryDataKey?>', () => ({
		createCategory($data) {
			var modal = Alpine.store('datokolomUiModal');
			modal.setContentByApi('<?php wp_commander_render(get_rest_url( null, 'wp-guide/category/create' ))?>', <?php wp_commander_render(json_encode($headers)); ?>, '<?php wp_commander_render( Common::generateRandomString() ); ?>');
			modal.pushModalData('getCategories', $data);
			modal.changeModalStatus();
		},
		test() {
			console.log("Hello")
		},
	}));

	Alpine.data('modalButton', () => ({
		show() {
			var modal = Alpine.store('datokolomUiModal');
			modal.setContentByApi('<?php wp_commander_render( get_rest_url( null, 'wp-guide/modal-content?id=10' ) );?>', <?php wp_commander_render( json_encode($headers) ); ?>);
			modal.changeModalStatus()
		}
	}))
</script>
