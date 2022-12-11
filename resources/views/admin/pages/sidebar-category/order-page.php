
<script>
  jQuery( function($) {
    let $sortcategory = $( "#category" );

    var sortEventHandler = function(event, ui){
    console.log($sortcategory.children());
};

    $sortcategory.sortable({
        stop: sortEventHandler
    }).disableSelection();

    $sortcategory.on("sortchange", sortEventHandler);

    $( ".connectedSortable" ).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
  } );
  </script>
	<div class="rounded-xl bg-[#F9FAFB]">
		<div class="px-5 py-3 min-h-[20rem] flex items-center justify-center">
			<div x-data="accordions" x-id="['test_id']" id="category" x-bind="accordion_list" role="accordion_list"
				class="mx-auto max-w-3xl w-full min-h-[16rem] space-y-4">
				<template x-for="(item, index) in items" >
					<div class="rounded-lg bg-white shadow" :id="$id('test_id', item.index)">
						<div class="justify-between px-3 py-4">
                <span class="!inline-block">
                  <svg class="cursor-move" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                </span>
                <span x-bind="accordion_button" class="items-center justify-between text-xl font-bold cursor-pointer">
                    <span x-text="item.title" class="pl-3 capitalize"></span>
                    <span x-show="isSelected(index)" aria-hidden="true" class="ml-4 float-right">&minus;</span>
                    <span x-show="!isSelected(index)" aria-hidden="true" class="ml-4 float-right">&plus;</span>
                </span>
						</div>
						<div x-show="isSelected(index)" x-collapse>
							<div class="px-6 pb-4 grid gap-3 grid-cols-1 connectedSortable" x-html="item.content"></div>
						</div>
					</div>
				</template>
			</div>
		</div>
	</div>
<?php
ob_start();
?>
<div class="bg-white shadow p-3">Item 1</div>
<div class="bg-white shadow p-3">Item 2</div>
<div class="bg-white shadow p-3">Item 3</div>
<div class="bg-white shadow p-3">Item 4</div>
<div class="bg-white shadow p-3">Item 5</div>
<?php
$c = ob_get_clean();

  $items = [
    ['title'=> 'item 1', 'content' => $c],
    ['title'=> 'item 2', 'content' => $c],
    ['title'=> 'item 3', 'content' => $c],
    ['title'=> 'item 4', 'content' => $c],
  ];
  
  ?>
	<script>
			Alpine.data('accordions', () => ({
				items: <?php echo json_encode($items)?>,
				activeItems: {},
				isSelected(item_index) {
					item_index = item_index + 1;
					if (this.activeItems[item_index] !== undefined && this.activeItems[item_index] === true) {
						return true;
					}
					return false;
				},
				getIndexFromId(id) {
					return id.substr(id.length - 1)
				},
				whichChild(el, parent) { return Array.from(parent.children).indexOf(el) },
				htmlToDocument(html) {
					var contentDocument = document.createElement("div");
					contentDocument.innerHTML = html;
					var scriptDocuments = contentDocument.querySelectorAll('script');
					var scripts = scriptDocuments;
					scriptDocuments.forEach(script => {
						script.remove();
					});
					return { contentDocument, scripts };
				}
			}));
			Alpine.bind('accordion_list', () => ({
				['x-ref']: 'accordion_list',
			}))
			Alpine.bind('accordion_button', () => ({
				[':id']() {
					return this.$id('test_id', this.whichChild(this.$el.parentElement.parentElement, this.$refs.accordion_list))
				},
				['@click']() {
					var index = this.getIndexFromId(this.$el.id);
					var is_selected = this.isSelected(index - 1);
					// this.activeItems = {};
					this.activeItems[index] = !is_selected;
				}
			}))
		// });
	</script>
