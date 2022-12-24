<?php

use WpGuide\App\Https\Controllers\CategoryController;
use WpGuide\App\Https\Controllers\SearchController;
use WpGuide\App\Https\Controllers\TemplateController;
use WpGuide\Bootstrap\Route;

Route::group( 'category', function () {
    Route::get( 'order', [CategoryController::class, 'get'] );
    Route::post( 'order', [CategoryController::class, 'order'] );
    Route::get( 'create', [CategoryController::class, 'create_page'] );
    Route::post( 'create', [CategoryController::class, 'create'] );
    Route::get( 'delete', [CategoryController::class, 'delete_page'] );
    Route::post( 'delete', [CategoryController::class, 'delete'] );
    Route::get( 'edit', [CategoryController::class, 'edit_page'] );
    Route::post( 'update', [CategoryController::class, 'update'] );
} );

Route::group( 'template', function () {
    Route::get( 'create', [TemplateController::class, 'create_page'] );
    Route::post( 'create', [TemplateController::class, 'create'] );
} );

Route::post( 'search', [SearchController::class, 'get'], true );
