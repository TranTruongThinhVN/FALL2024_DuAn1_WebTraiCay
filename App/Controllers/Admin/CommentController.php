<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Comment;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Comments\Details;
use App\Views\Admin\Pages\Comments\Edit;
use App\Views\Admin\Pages\Comments\Index;
use App\Views\Admin\Pages\Comments\Update;

class CommentController
{


    // hiển thị danh sách
    public static function index()
    {
        $comment = new Comment();
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        // Lấy tổng số bình luận và danh sách bình luận dựa trên từ khóa
        if ($keyword) {
            $totalComment = $comment->getTotalSearchComments($keyword);
            $allComment = $comment->searchComments($keyword);
            // var_dump($totalComment);
            // var_dump($allComment);
            // die;
        } else {
            $totalComment = $comment->getTotalComments();
            $allComment = $comment->getAllComment();
        }

        // Đảm bảo `$allComment` luôn là mảng
        if (!is_array($allComment)) {
            $allComment = [];
        }

        // Chia nhỏ bình luận theo trang
        $commentsPerPage = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $commentsPerPage;
        $pagedComments = array_slice($allComment, $start, $commentsPerPage);
        $totalComment = isset($totalComment) && is_numeric($totalComment) ? (int)$totalComment : 0;
        // Chuẩn bị dữ liệu để truyền vào view
        $data = [
            'allComment' => $pagedComments,
            'totalComment' => $totalComment,
            'currentPage' => $page,
            'totalPages' => ceil($totalComment / $commentsPerPage),
            'keyword' => $keyword
        ];

        // Gọi các thành phần giao diện
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }



    // hiển thị giao diện form thêm
    public static function create()
    {
        //     Header::render();
        //     Notification::render();
        //     NotificationHelper::unset();
        //     // hiển thị form thêm
        //     Create::render();
        //     Footer::render();
        // } 
        // public static function store()
        // {
        //     $is_valid = CommentValidation::create();

        //     if(!$is_valid){
        //         NotificationHelper::error('store', 'Thêm bình luận thất bại');
        //         header('Location: /admin/categories/create');
        //         exit;
        //     }

        //     $name = $_POST['name'];
        //     $status = $_POST['status'];
        //     //kiểm tra tên danh mục trùng tên
        //     $Comment = new Comment();
        //     $is_exist = $Comment->getOneCommentByName($name);

        //     if($is_exist){
        //         NotificationHelper::error('store', 'Tên bình luận đã tồn tại');
        //         header('Location: /admin/categories/create');
        //         exit;
        //     }

        //     $data = [
        //         'name' => $name,
        //         'status' => $status
        //     ]; 

        //     $result = $Comment->createComment($data);

        //     if($result){
        //         NotificationHelper::success('store', 'Thêm bình luận thành công');
        //         header('Location: /admin/categories');
        //     } else {
        //         NotificationHelper::error('store', 'Thêm bình luận thất bại');
        //         header('Location: /admin/categories/create');
        //     }
    }


    // hiển thị chi tiết
    public static function show() {}



    // hiển thị giao diện form sửa
    public static function edit(int $id)
    {

        $Comment = new Comment();
        $data = $Comment->getOneComment($id);
        // var_dump($data);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Update::render($data);
        Footer::render();
    }

    public static function uploadImages($comment_id)
    {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // Các định dạng được phép
        $uploadDir = 'public/uploads/comment-images/'; // Thư mục lưu trữ ảnh

        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }

        $uploadedImages = [];

        // Lặp qua các file tải lên
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                // Lấy phần mở rộng của file
                $extension = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);
                $extension = strtolower($extension);

                // Kiểm tra định dạng file
                if (in_array($extension, $allowedTypes)) {
                    // Tạo tên file theo format: id_cmt_YYYYMMDD_HHMMSS.extension
                    $currentDateTime = date('Ymd_His'); // Lấy thời gian hiện tại (năm tháng ngày_giờ phút giây)
                    $fileName = $comment_id . '_' . $currentDateTime . '.' . $extension; // Tên file mới

                    $targetPath = $uploadDir . $fileName;

                    // Di chuyển file vào thư mục đích
                    if (move_uploaded_file($tmpName, $targetPath)) {
                        // Chỉ lưu tên file vào mảng, không lưu đường dẫn đầy đủ
                        $uploadedImages[] = $fileName;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Chỉ chấp nhận định dạng JPG, PNG, GIF!']);
                    exit;
                }
            }
        }

        // Trả về danh sách tên ảnh đã tải lên (chỉ tên file, không đường dẫn)
        $cleanFileNames = array_map(function ($filePath) {
            return basename($filePath);
        }, $uploadedImages);

        return $cleanFileNames;
    }
    //xử lý chức năng update
    public static function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra trường ẩn để xác định yêu cầu thực sự là PUT
            if (isset($_POST['method']) && $_POST['method'] === 'PUT') {
                $id = isset($_POST['id']) ? $_POST['id'] : null;
                // var_dump($id) ;
                // die;
                if ($id) {
                    $data = [
                        'content' => $_POST['content'],
                        'status' => $_POST['status']
                    ];

                    try {
                        // Cập nhật comment
                        $comments = new Comment();
                        $updateStatus = $comments->updateComment($id, $data);

                        if ($updateStatus) {
                            error_log('Comment updated successfully with ID: ' . $id);
                            echo "Comment updated successfully with ID";
                            // Upload hình ảnh
                            $uploadedImages = self::uploadImages($id);
                            if (!empty($uploadedImages)) {
                                foreach ($uploadedImages as $image_url) {
                                    $comments->updateImage($id, $image_url);  // Cập nhật hình ảnh
                                    error_log('Image added result: success');
                                }
                            }
                            NotificationHelper::success('update-comment', "Cập nhật thành công");
                            header("Location: " . $_SERVER['HTTP_REFERER']);
                        } else {
                            error_log('Failed to update comment with ID: ' . $id);
                        }
                    } catch (\Throwable $e) {
                        error_log('Error: ' . $e->getMessage());
                    }
                } else {
                    error_log('Comment ID is missing.');
                }
            }
        }
    }


    // thực hiện xoá
    public function delete($commentId)
    {
        // Kiểm tra xem có phải là phương thức DELETE từ form không
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['method']) && $_POST['method'] === 'DELETE') {
            // Lấy thông tin từ form
            $productId = $_POST['product_id'] ?? null;
            $commentId = $_POST['id'] ?? null;

            // Kiểm tra tính hợp lệ
            if (!$productId || !$commentId) {
                echo "Sản phẩm không hợp lệ.";
                return;
            }

            // Tạo đối tượng Comment để xử lý việc xóa bình luận
            $comment = new Comment();
            $result = $comment->deleteComment($commentId);  // Xóa bình luận theo id

            if ($result) {
                NotificationHelper::success('delete-sucess', "Xoá Thành Công");
                header('Location: /comments/details?product_id=' . $productId);
                exit();  // Đảm bảo mã dừng lại ở đây
            } else {
                echo "Lỗi khi xóa bình luận.";
            }
        } else {
            echo "Phương thức không hợp lệ.";
        }
    }
    public static function details()
    {
        // Lấy product_id từ URL
        $productId = $_GET['product_id'] ?? null;

        // Log productId để đảm bảo nó được truyền đúng 
        // Kiểm tra nếu không có product_id, thì trả về thông báo lỗi
        if (!$productId) {
            echo "Sản phẩm không hợp lệ.";
            return;
        }

        // Tạo đối tượng Comment và lấy bình luận cho sản phẩm
        $comment = new Comment();
        // $comments = $comment->getComments($productId); 

        if (empty($comments)) {
            echo "Không có bình luận nào cho sản phẩm này.";
        } else {

            Header::render();  // Hiển thị phần đầu trang
            Details::render($comments);  // Gọi view để hiển thị danh sách bình luận
            Footer::render();  // Hiển thị phần chân trang
        }
    }
}
