<?php

// use WpGuide\App\Http\Controllers\TestController;
use WpGuide\Bootstrap\Route;
use WpGuide\Bootstrap\View;

Route::get( '/hello/1', function () {
    // echo "<h1>Hello World 1</h1>" ;
   View::api_render('test');
}, true );
Route::get( '/hello/2', function () {
    View::api_render('test1');
    
}, true );
Route::get( '/hello/3', function () {
    echo "<h1>Hello World 3</h1>" ;
}, true );
Route::get( '/hello/4', function () {
    echo "<h1>Hello World 4</h1>" ;
}, true );
Route::get( '/hello/5', function () {
    echo "<h1>Hello World 5</h1>" ;
}, true );
