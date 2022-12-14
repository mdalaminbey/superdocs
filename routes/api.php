<?php

use WpGuide\App\Https\Controllers\CategoryController;
use WpGuide\Bootstrap\Route;

Route::group( 'category', function () {
    Route::get( 'order', [CategoryController::class, 'get'] );
    Route::get( 'create', [CategoryController::class, 'create_page'] );
    Route::post( 'create', [CategoryController::class, 'create'] );
} );
