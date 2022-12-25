<?php

$saved_values = get_option('superdocs-general-settings', true);

if($saved_values) {
	$saved_values = unserialize($saved_values);
} else {
	$saved_values = [];
}

$inputs = [
	'single_docs_slug' => [
		'title' => esc_html__( 'Single Docs Permalink', 'superdocs' ),
		'type' => 'text',
		'value' => 'docs',
		'required' => true,
	],
	'breadcrumb_home_url' => [
		'title' => esc_html__( 'Breadcrumb Home Url', 'superdocs' ),
		'type' => 'text',
		'value' => '',
		'required' => true,
	],
	'toc_supported_heading_tag' => [
		'title' => esc_html__('TOC Supported Heading Tag', 'superdocs'),
		'type' => 'checkbox',
		'required' => false,
		'value' => ['h1', 'h2'],
		'options' => [
			[
				'title' => 'H1',
				'value' => 'h1'
			],
			[
				'title' => 'H2',
				'value' => 'h2'
			],
			[
				'title' => 'H3',
				'value' => 'h3'
			],
			[
				'title' => 'H4',
				'value' => 'h4'
			],
			[
				'title' => 'H5',
				'value' => 'h5'
			],
			[
				'title' => 'H6',
				'value' => 'h6'
			]
		]
	]
];
?>

<div class="px-6" x-data>
	<form class="generalSettingsForm">
		<table class="border-separate border-spacing-y-6">
			<tbody>
			<?php foreach($inputs as $name => $input):
					if($saved_values[$name]) {
						$input['value'] = $saved_values[$name];
					}
					switch ($input['type']) {
						case 'checkbox':
							?>
							<tr>
								<th class="w-72 text-left">
									<label class="text-base font-semibold">
										<?php wp_commander_render($input['title']) ?>
									</label>
								</th>
								<td class="inline-flex gap-6 font-medium text-sm">
									<?php foreach($input['options'] as $option):?>
										<span>
											<input 
												type="checkbox" 
												id="<?php wp_commander_render( $option['value'] ) ?>"
												<?php wp_commander_render( $input['required'] ? 'required' : '' ) ?> 
												<?php wp_commander_render( in_array($option['value'], $input['value']) ? 'checked' : '' ) ?> 
												name="settings[<?php wp_commander_render( $name ) ?>][]"
												value="<?php wp_commander_render( $option['value'] ) ?>"
												class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 before:invisible checked:border-primary checked:bg-primary hover:border-primary focus:border-primary">
											<label for="<?php wp_commander_render( $option['value'] ) ?>">
												<?php wp_commander_render($option['title']) ?>
											</label>
										</span>
									<?php endforeach;?>
								</td>
							</tr>
							<?php
							break;
						default:
							?>
							<tr>
								<th class="w-72 text-left">
									<label class="text-base font-semibold">
										<?php wp_commander_render($input['title']) ?>
									</label>
								</th>
								<td>
									<input 
										type="text" 
										<?php $input['required'] ? 'required' : '' ?> 
										name="settings[<?php wp_commander_render($name) ?>]" 
										value="<?php wp_commander_render($input['value']) ?>" 
										class="w-[400px] form-input rounded-lg border border-slate-300 bg-slate-100 px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary" />
								</td>
							</tr>
							<?php
						break;
					}
				?>
				<?php endforeach;?>
				
			</tbody>
		</table>

		<button class="mt-7 font-semibold rounded-md px-7 py-3 text-white items-center bg-primary hover:bg-primary-hover">
			<?php esc_html_e('Save Changes', 'superdocs')?>
		</button>
	</form>
</div>
<script>
	jQuery(function ($) {
		$('body').on('submit', '.generalSettingsForm', function(e) {
			e.preventDefault();
			$.ajax({
				url: "<?php wp_commander_render( get_rest_url( null, 'superdocs/settings/general' ) )?>",
				method: 'POST',
				beforeSend: function(xhr) {
					xhr.setRequestHeader( 'X-WP-Nonce', "<?php wp_commander_render(wp_create_nonce('wp_rest'))?>" );
				},
				data: $(this).serialize(),
				success: function(data) {},
				complete: function() {}
			})
		})
	})
</script>