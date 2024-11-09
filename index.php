<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', TRUE);
ini_set('error_log', './logs/php/php-errors.log');

use App\Route;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once 'config.php';



// *** Client
Route::get('/', 'App\Controllers\Client\HomeController@index');
Route::get('/contact', 'App\Controllers\Client\ContactController@index');
Route::get('/checkout', 'App\Controllers\Client\CheckoutController@index');

Route::get('/introduce', 'App\Controllers\Client\IntroduceController@index');
Route::get('/products', 'App\Controllers\Client\ProductController@index');
Route::get('/product-detail', 'App\Controllers\Client\ProductController@detail');

Route::get('/news', 'App\Controllers\Client\NewsController@index');
Route::get('/news-detail', 'App\Controllers\Client\NewsController@detail');

Route::get('/store', 'App\Controllers\Client\StoreController@index');

Route::get('/cart', 'App\Controllers\Client\CartController@index');
Route::get('/Culinary_roots', 'App\Controllers\Client\Culinary_rootsController@index');
Route::get('/Culinary_roots_detail', 'App\Controllers\Client\Culinary_rootsController@detail');
// *** Admin

Route::get('/admin', 'App\Controllers\Admin\HomeController@index');

Route::dispatch($_SERVER['REQUEST_URI']);
