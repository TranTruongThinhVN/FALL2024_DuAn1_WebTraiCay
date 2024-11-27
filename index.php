<?php

session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', TRUE);
ini_set('error_log', './logs/php/php-errors.log');

use App\Helpers\AuthHelper;
use App\Route;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once 'config.php';

AuthHelper::middleware();

// *** Client
Route::get('/', 'App\Controllers\Client\HomeController@index');
Route::get('/contact', 'App\Controllers\Client\ContactController@index');
Route::get('/checkout', 'App\Controllers\Client\CheckoutController@index');

//cment 
Route::post('/create-comment', 'App\Controllers\Client\CommentsController@create');


Route::get('/introduce', 'App\Controllers\Client\IntroduceController@index');
Route::get('/products', 'App\Controllers\Client\ProductController@index');
Route::get('/product-detail/{id}', 'App\Controllers\Client\ProductController@detail');
Route::get('/product-search', 'App\Controllers\Client\ProductController@index');
Route::get('/product-filter', 'App\Controllers\Client\ProductController@index');
Route::get('/news', 'App\Controllers\Client\NewsController@index');
Route::get('/news-detail', 'App\Controllers\Client\NewsController@detail');
Route::get('/store', 'App\Controllers\Client\StoreController@index');
Route::get('/cart', 'App\Controllers\Client\CartController@index');
Route::get('/culinary_roots', 'App\Controllers\Client\Culinary_rootsController@index');
Route::get('/culinary_roots_detail', 'App\Controllers\Client\culinary_rootsController@detail');
Route::get('/policy', 'App\Controllers\Client\PolicyController@index');
// cart
Route::post('/cart-add', 'App\Controllers\Client\CartController@addToCart');
// Auth *** //// Auth *** //// Auth *** //// Auth *** //// Auth *** //// Auth *** //// Auth *** //// Auth *** //// Auth *** //// Auth *** //
Route::get('/register', 'App\Controllers\Client\AuthController@register');
Route::post('/register', 'App\Controllers\Client\AuthController@registerAction');
Route::get('/login', 'App\Controllers\Client\AuthController@login');
Route::post('/login', 'App\Controllers\Client\AuthController@loginAction');
Route::get('/logout', 'App\Controllers\Client\AuthController@logout');
Route::get('/logout', 'App\Controllers\Client\AuthController@logout');
Route::get('/forgot-password', 'App\Controllers\Client\AuthController@forgotPassword');
Route::post('/forgot-password', 'App\Controllers\Client\AuthController@forgotPasswordAction');
Route::get('/reset-password', 'App\Controllers\Client\AuthController@resetPassword');
Route::post('/reset-password', 'App\Controllers\Client\AuthController@resetPasswordAction');
Route::get('/users/{id}', 'App\Controllers\Client\AuthController@edit');
Route::put('/users/{id}', 'App\Controllers\Client\AuthController@update');
Route::get('/verify-otp',  'App\Controllers\Client\AuthController@verifyOtp');
Route::post('/verify-otp',  'App\Controllers\Client\AuthController@verifyOtpAction');
// Thêm vào file routes của bạn
Route::get('/google-login', 'App\Controllers\Client\AuthController@googleLogin');
Route::get('/google-callback', 'App\Controllers\Client\AuthController@googleCallback');

Route::get('/profile', 'App\Controllers\Client\AuthController@edit');

// *** Admin***// *** Admin***// *** Admin***// *** Admin***// *** Admin***// *** Admin***// *** Admin***// *** Admin***// *** Admin***
Route::get('/admin', 'App\Controllers\Admin\DashboardController@index');
// Product
Route::get('/admin/product', 'App\Controllers\Admin\ProductController@index');
Route::get('/admin/product-details', 'App\Controllers\Admin\ProductController@details');
Route::get('/admin/add-product', 'App\Controllers\Admin\ProductController@create');
Route::post('/admin/add-product', 'App\Controllers\Admin\ProductController@store');
Route::post('/admin/add-product', 'App\Controllers\Admin\ProductController@store');
Route::get('/admin/edit-product/{id}', 'App\Controllers\Admin\ProductController@edit');
Route::put('/admin/edit-product/{id}', 'App\Controllers\Admin\ProductController@update');
Route::get('/admin/detail-product/{id}', 'App\Controllers\Admin\ProductController@show');
Route::delete('/admin/delete-product/{id}', 'App\Controllers\Admin\ProductController@delete');
Route::delete('/admin/products/delete-thumbnail', 'App\Controllers\Admin\ProductController@deleteThumbnail');
// Route::post('/admin/products', 'App\Controllers\Admin\ProductController@index');
// 
Route::post('/admin/products/upload-image', 'App\Controllers\Admin\ProductController@uploadImageCkeditor');
// Discount
Route::get('/admin/discount', 'App\Controllers\Admin\DiscountController@index');
Route::get('/admin/add-discount', 'App\Controllers\Admin\DiscountController@create');
Route::post('/admin/add-discount', 'App\Controllers\Admin\DiscountController@store');
Route::get('/admin/edit-discount/{id}', 'App\Controllers\Admin\DiscountController@edit');
Route::put('/admin/edit-discount/{id}', 'App\Controllers\Admin\DiscountController@update');
Route::delete('/admin/delete-discount/{id}', 'App\Controllers\Admin\DiscountController@delete');


Route::get('/admin/product-details', 'App\Controllers\Admin\ProductController@details');
Route::get('/admin/add-product', 'App\Controllers\Admin\ProductController@create');
Route::get('/admin/order', 'App\Controllers\Admin\OrderController@index');
Route::get('/admin/checkout', 'App\Controllers\Admin\CheckoutController@index');
Route::get('/admin/users', 'App\Controllers\Admin\UserController@index');

Route::get('/admin/user-create', 'App\Controllers\Admin\UserController@create');
Route::post('/admin/user-create', 'App\Controllers\Admin\UserController@store');
Route::get('/admin/users-edit/{id}', 'App\Controllers\Admin\UserController@edit');
Route::put('/admin/user-update/{id}', 'App\Controllers\Admin\UserController@update');
Route::delete('/admin/users-delete/{id}', 'App\Controllers\Admin\UserController@delete');
Route::get('/admin/user-details', 'App\Controllers\Admin\UserController@details');

Route::get('/admin/order', 'App\Controllers\Admin\OrderController@index');
Route::get('/admin/orders/edit/{id}', 'App\Controllers\Admin\OrderController@edit');
Route::put('/admin/orders/update/{id}', 'App\Controllers\Admin\OrderController@update');
Route::delete('/admin/orders/delete/{id}', 'App\Controllers\Admin\OrderController@delete');


// Route::get('/comments/details', 'App\Controllers\Admin\CommentController@details');
Route::get('/admin/comments', 'App\Controllers\Admin\CommentController@index');
Route::get('/admin/comments/{id}', 'App\Controllers\Admin\CommentController@edit');
Route::get('/comments/details', 'App\Controllers\Admin\CommentController@details');
Route::delete('/comments/delete/{id}', 'App\Controllers\Admin\CommentController@delete');
Route::get('/comments/edit/{id}', 'App\Controllers\Admin\CommentController@edit');
Route::put('/comments/update/{id}', 'App\Controllers\Admin\CommentController@update');
// Route::get('/comments/details', 'App\Controllers\Admin\CommentController@details');
Route::get('/admin/comments', 'App\Controllers\Admin\CommentController@index');


//category
Route::get('/admin/category', 'App\Controllers\Admin\CategoryController@index');
Route::get('/admin/add-category', 'App\Controllers\Admin\CategoryController@create');
Route::post('/admin/add-category', 'App\Controllers\Admin\CategoryController@store');
Route::get('/admin/category/{id}', controllerMethod: 'App\Controllers\Admin\CategoryController@edit');
Route::delete('/admin/category/{id}', 'App\Controllers\Admin\CategoryController@delete');
Route::put('/admin/category/{id}', 'App\Controllers\Admin\CategoryController@update');






Route::dispatch($_SERVER['REQUEST_URI']);
