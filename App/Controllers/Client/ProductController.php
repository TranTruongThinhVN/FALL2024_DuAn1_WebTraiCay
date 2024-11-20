<?php

namespace App\Controllers\Client;

use App\Models\Product;
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

        // Lấy danh sách sản phẩm, nếu có tìm kiếm thì gọi phương thức tìm kiếm
        // if ($keyword) {
        //     $products = $productModel->searchProducts($keyword); // Gọi phương thức tìm kiếm
        // } else {
        //     $products = $productModel->getAllProduct(); // Lấy tất cả sản phẩm nếu không có tìm kiếm
        // }

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

    public static function detail()
    {
        Header::render();
        Detail::render();
        Footer::render();
    }
}
