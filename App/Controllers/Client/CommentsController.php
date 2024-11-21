<?php

namespace App\Controllers\Client;

use App\Models\Product;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Product\Detail;

class CommentsController
{
    // hiển thị danh sách
    public static function index($productId)
    {
        // $comment = new pro;

        // Lấy danh sách bình luận dựa trên product_id
        // $data = $comment->getCommentsByProductId($productId);

        // Hiển thị dữ liệu để kiểm tra
        // var_dump($data); exit;

        // Render giao diện
        Header::render(); 
        Detail::render();
        Footer::render();
    }

    
}
