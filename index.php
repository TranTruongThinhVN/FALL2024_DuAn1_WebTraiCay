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
Route::get('/product-search', 'App\Controllers\Client\ProductController@index');
Route::get('/product-filter', 'App\Controllers\Client\ProductController@index');

Route::get('/news', 'App\Controllers\Client\NewsController@index');
Route::get('/news-detail', 'App\Controllers\Client\NewsController@detail');

Route::get('/store', 'App\Controllers\Client\StoreController@index');

Route::get('/cart', 'App\Controllers\Client\CartController@index');
Route::get('/culinary_roots', 'App\Controllers\Client\Culinary_rootsController@index');
Route::get('/culinary_roots_detail', 'App\Controllers\Client\culinary_rootsController@detail');

Route::get('/policy', 'App\Controllers\Client\PolicyController@index');
Route::get('/register', 'App\Controllers\Client\AuthController@register');
Route::post('/register', 'App\Controllers\Client\AuthController@registerAction');
// 

// *** Admin
Route::get('/admin', 'App\Controllers\Admin\DashboardController@index');
Route::get('/admin/product', 'App\Controllers\Admin\ProductController@index');
Route::get('/admin/product-details', 'App\Controllers\Admin\ProductController@details');
Route::get('/admin/add-product', 'App\Controllers\Admin\ProductController@create');
Route::get('/admin/categories', 'App\Controllers\Admin\CategoryController@index');
Route::get('/admin/add-category', 'App\Controllers\Admin\CategoryController@create');
Route::get('/admin/order', 'App\Controllers\Admin\OrderController@index');
Route::get('/admin/checkout', 'App\Controllers\Admin\CheckoutController@index');
Route::get('/admin/user', 'App\Controllers\Admin\UserController@index');
Route::get('/details', 'App\Controllers\Admin\UserController@details');


Route::get('/comments/details', 'App\Controllers\Admin\CommentController@details');
Route::get('/admin/comments', 'App\Controllers\Admin\CommentController@index');
Route::dispatch($_SERVER['REQUEST_URI']);
