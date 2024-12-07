<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Comment;
use App\Models\Product;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Product\Detail;

class CommentsController
{
    // hiển thị danh sách
    public static function index($productId)
    {
        // // Lấy danh sách bình luận dựa trên product_id
        // $comment = new Comment();
        // $data = $comment->getCommentsByProductId($productId);

        // // Render giao diện
        // Header::render(); 
        // Detail::render($data);
        // Footer::render();
    }

    public static function create()
    {
        // Khai báo biến $result mặc định để tránh lỗi undefined variable
        $result = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $data = [
                'rating' => $_POST['rating'],
                'content' => $_POST['content'],
                'user_id' => $_POST['user_id'],
                'product_id' => 115, //$_POST['product_id'],
                'created_at' => date('Y-m-d H:i:s'),
            ];
            try {
                $comments = new Comment();
                $result = $comments->createComment($data);

                // Kiểm tra kết quả trả về và in ra
                var_dump($result);
                if ($result) {
                    NotificationHelper::success('comment-success', 'Cảm ơn bạn đã đánh giá');
                    if (isset($_SERVER['HTTP_REFERER'])) {
                        header("Location: " . $_SERVER['HTTP_REFERER']);
                    } else {
                        // Nếu không lấy được trang trước, chuyển hướng về trang mặc định
                        header("Location: /");
                        exit;
                    }
                } else {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }
            } catch (\Throwable $e) {
                // Ghi log lỗi và kiểm tra lại biến $result
                error_log('Lỗi tạo đánh giá: ' . $e->getMessage());
                var_dump($result);

                // Trả về thông báo lỗi
                echo json_encode([
                    'success' => false,
                    'message' => 'loi he tohng',
                    'debug' => $data
                ]);
            }
            //Render giao diện
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Detail::render();
            Footer::render();
        }
    }
}
