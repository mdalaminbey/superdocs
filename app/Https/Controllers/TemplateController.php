<?php

namespace WpGuide\App\Https\Controllers;

use WpGuide\Bootstrap\View;
use WP_REST_Request;

class TemplateController
{
	public function create_page()
	{
		return View::send('admin/pages/template/create');
	}
}
