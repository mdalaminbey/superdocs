<?php

use WpGuide\App\Https\Controllers\SideCategoryController;
use WpGuide\Bootstrap\Route;

Route::get( 'sidebar-category-order-page', [SideCategoryController::class, 'get'] );