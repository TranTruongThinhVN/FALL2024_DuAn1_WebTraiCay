<?php

namespace App\Controllers\Client;

use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Culinary_roots\culinary_roots;
use App\Views\Client\Pages\Culinary_roots\detail_culinary_roots;

class Culinary_rootsController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        culinary_roots::render();
        Footer::render();
    }


    public static function detail()
    {



        // $product = new Product();

        // $product_detail = $product->getOneProductByStatus($id);
        // if (!$product_detail) {
        //     NotificationHelper::error('product_detail', 'Không thể xem sản phẩm này');
        //     header('location: /products');
        //     exit;
        // }

        // $data = [
        //     'product' => $product_detail
        // ];

        Header::render();

        detail_culinary_roots::render();
        Footer::render();
    }
}
