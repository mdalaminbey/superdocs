<?php

namespace WpGuide\Bootstrap;

use WpCommander\Route\Route as RouteRoute;

class Route extends RouteRoute
{
    protected static function get_application_instance(): Application
    {
        return Application::$instance;
    }
}
