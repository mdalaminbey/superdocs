<?php

use WpGuide\Bootstrap\Application as WpCommanderApplication;

$application = WpCommanderApplication::$instance;
wp_enqueue_script( 'doatkolom-ui-focus-' . $application::$config['namespace'], $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs-focus.min.js', [], $application::$config['version'] );
wp_enqueue_script( 'doatkolom-ui-' . $application::$config['namespace'], $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs.min.js', [], $application::$config['version'] );
?>
<div class="mt-8 pr-6 doatkolom-ui wp-guide">
    <div class="rounded-xl bg-[#F8FAFC]">
        <div class="min-h-[38rem] p-10">
              <?php
                  use DoatKolom\Ui\WpLayout;
                  use WpGuide\Bootstrap\Application;
                  $layout = WpLayout::instance( Application::$instance );
                  $layout->tab( [
                      'classes' => [
                          'body'           => 'test',
                          'selectors_body' => 'selectors_body',
                          'content_body'   => 'content_body'
                      ],
                      'tabs'    => [
                          [
                              'title'   => 'Tab 01',
                              'classes' => [
                                  // 'tab_selector' => 'bg-[#EEEEEF]',
                                  // 'selector_button' => 'bg-[#EEEEEF]',
                                  // 'content_inner' => 'bg-[#EEEEEF]',
                              ],
                              'content_cache' => false,
                              'content_url' => 'http://wpcommander.test/wp-json/wp-guide/hello/1',
                            //   'content' => function () {}
                          ],
                          [
                              'title'         => 'Tab 02',
                              'content_url'   => 'http://wpcommander.test/wp-json/wp-guide/hello/2',
                              'content_cache' => false,
                              'content'       => function () {
                                  echo ' asdfasdfasdfasdfasdfasdf';
                              }
                          ]
                      ]

                  ] );
              ?>
        </div>
    </div>
</div>
