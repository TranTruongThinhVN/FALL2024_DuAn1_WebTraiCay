<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Client\Product;
use App\Views\Admin\Pages\Product\Details;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Product\Detail;
use App\Views\Client\Pages\Product\Index;

class ProductController
{
    // hiển thị danh sách
    public static function index()
    {
        $productModel = new Product();
        $products = $productModel->getAllProduct();

        // Kiểm tra nếu có từ khoá tìm kiếm từ query string
        $keyword = isset($_GET['keyword']) && !empty(trim($_GET['keyword'])) ? $_GET['keyword'] : false;


        // Kiểm tra nếu người dùng chọn một khoảng giá
        if (isset($_GET['price_range']) && !empty($_GET['price_range'])) {
            list($minPrice, $maxPrice) = explode('-', $_GET['price_range']);
            $minPrice = (int)$minPrice;
            $maxPrice = (int)$maxPrice;
            $products = $productModel->filterProductsByPrice($minPrice, $maxPrice);
        } elseif ($keyword) {
            $products = $productModel->searchProducts($keyword);
        } else {
            $products = $productModel->getAllProduct();
        }


        Header::render();
        Index::render($products);
        Footer::render();
    }

    public static function detail($id)
    {
        $product = new Product();
        $product_detail = $product->getOneProductByStatus($id);
        if (!$product_detail) {
            NotificationHelper::error('product_detail', 'Không thể xem sản phẩm này');
            header('location: /products');
            exit;
        }
        $data = [
            'product' => $product_detail,
        ];
        Header::render();
        Detail::render($data,);
        Footer::render();
    }
}
