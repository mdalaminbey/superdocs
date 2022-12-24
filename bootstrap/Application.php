<?php

namespace SuperDocs\Bootstrap;

use WpCommander\Application as WpCommanderApplication;

class Application extends WpCommanderApplication
{
    public static $instance, $config;
    protected static $instances = [], $configs = [], $is_boot = false, $root_dir;

    public function configuration(): array
    {
        return [
            'api' => [
                'register_route' => RegisterRoute::class
            ]
        ];
    }
}
