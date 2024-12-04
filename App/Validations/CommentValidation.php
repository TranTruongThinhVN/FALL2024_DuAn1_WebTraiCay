<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Comment;

class CommentValidation
{
    // public static function create(): bool
    // {
        
    // }

    public static function getCommentProduct($id)
{
    // Kiểm tra tính hợp lệ của Product ID
    if (!isset($id) || !is_numeric($id) || (int)$id <= 0) {
        return false; // ID không hợp lệ
    }

    $id = (int)$id; // Chuyển `$id` về số nguyên
    $comment = new Comment(); // Tạo đối tượng `Comment`
    $commentsPerPage = 4; // Số bình luận mỗi trang
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1; // Xác định trang hiện tại

    // Lấy tổng số bình luận
    $countCommentArray = $comment->getCountCommentByProductID($id);
    if ($countCommentArray === false || !isset($countCommentArray[0]['total_comments']) || !is_numeric($countCommentArray[0]['total_comments'])) {
        return false; // Nếu không lấy được tổng số bình luận, trả về false
    }
    $countComment = (int)$countCommentArray[0]['total_comments'];

    // Tính tổng số trang
    $totalPages = (int)ceil($countComment / $commentsPerPage);

    // Kiểm tra tính hợp lệ của trang
    if ($page > $totalPages) {
        $_SESSION['error_message'] = 'Số trang không hợp lệ!';

        // NotificationHelper::error('error-url','Có lỗi');
        // // $redirectURL = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
        // // header("Location: $redirectURL");
        // var_dump($_SESSION);
        // die;
        // exit;
    }

    // Tính toán offset
    $offset = ($page - 1) * $commentsPerPage;

    // Lấy danh sách bình luận đã phân trang
    $pagedComments = $comment->getCommentByProductId($id, $offset, $commentsPerPage);
    if (empty($pagedComments)) {
        return false; // Nếu không có bình luận nào
    }

    // Lấy các thông tin khác liên quan đến bình luận
    $rating = $comment->getAverageRating($id);
    $countImages = $comment->getCountImagesByProductId($id);

    // Trả về dữ liệu bình luận và phân trang
    $data = [
        'countImages' => $countImages,
        'countRating' => $rating,
        'comments' => $pagedComments,
        'countComment' => $countComment,
        'currentPage' => $page,
        'totalPages' => $totalPages,
    ];

    return $data;
}




    




}
