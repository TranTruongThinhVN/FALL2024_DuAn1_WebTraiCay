<?php

namespace App\Controllers\Client;

use App\Models\Client\Product;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;

class HomeController
{
    // hiển thị danh sách
    public static function index()
    {
        $product = new Product();
        $featuredProducts = $product->getAllFeaturedProducts(); // Lấy danh sách sản phẩm nổi bật

        $data = [
            'featuredProducts' => $featuredProducts,
        ];
        Header::render();
        Home::render($data);
        Footer::render();
    }
}
