<?php

namespace App\Controllers\Admin;

use App\Controllers\Client\NewsController;
use App\Models\Product;
use App\Models\Comment; 
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Comments\Details;
use App\Views\Admin\Pages\Comments\Edit;
use App\Views\Admin\Pages\Comments\ListComments; 

class CommentController
{


    // hiển thị danh sách
    public static function index()
    { 
        
        $product = new Product();
        
        // Lấy danh sách sản phẩm và tổng bình luận
        $data = $product->getProductsWithCommentCount(); 
        Header::render();
        ListComments::render($data);
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
    public static function show()
    {
    }


    // hiển thị giao diện form sửa
    public static function edit(int $id)
    {
        
        $Comment = new Comment();
        $data = $Comment->getOneCommentJoinProductAndUser($id); 
        // if(!$data){
        //     NotificationHelper::error('edit', 'Không thể xem bình luận này');
        //     header('Location : /admin/categories');
        //     exit;
        // }

        Header::render(); 
        Edit::render($data);
        Footer::render(); 
    }


    //xử lý chức năng update
    public function update($id)
{
    // Kiểm tra nếu phương thức là PUT
    if ($_POST['method'] !== 'PUT') {
        echo "Phương thức không hợp lệ.";
        exit;
    }

    // Lấy dữ liệu từ form
    $content = trim($_POST['content']);
    $status = $_POST['status'];
    $productId = $_POST['product_id'];

    // Kiểm tra dữ liệu
    if (empty($content)) {
        echo "Nội dung không được để trống.";
        exit;
    }

    if (!in_array($status, ['0', '1'], true)) {
        echo "Trạng thái không hợp lệ.";
        exit;
    }

    // Xử lý ảnh (nếu có)
    $imageUrls = [];
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $uploadDir = 'public/uploads/comment-images/'; // Đường dẫn thư mục lưu ảnh
        foreach ($_FILES['images']['name'] as $key => $imageName) {
            $targetFile = $uploadDir . basename($imageName);
            // Kiểm tra xem ảnh có hợp lệ không (size, type, etc.)
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFile)) {
                $imageUrls[] = $targetFile; // Lưu đường dẫn ảnh vào mảng
            } else {
                echo "Lỗi tải ảnh lên.";
                exit;
            }
        }
    }

    $Comment = new Comment();
    $data = [
        'content' => $content,
        'status' => $status,
        'update_at' => date('Y-m-d H:i:s'), // Cập nhật thời gian
    ];

    // Nếu có ảnh, thêm vào dữ liệu
    if (!empty($imageUrls)) {
        $data['images'] = implode(',', $imageUrls); // Lưu đường dẫn ảnh vào cơ sở dữ liệu, nối bằng dấu phẩy
    } 

    // Cập nhật bình luận
    $data = $Comment->updateComment($id, $data); 
     // Kiểm tra giá trị của $result;

    if ($data) {
        header("Location: /comments/details?product_id=" . $productId);
        exit;
    } else {
        echo "Cập nhật thất bại.";
    }
}


    // thực hiện xoá
    public function delete($commentId) {
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
                // Chuyển hướng về trang chi tiết sản phẩm sau khi xóa
                header('Location: /comments/details?product_id=' . $productId);
                exit();  // Đảm bảo mã dừng lại ở đây
            } else {
                echo "Lỗi khi xóa bình luận.";
            }
        } else { 
            echo "Phương thức không hợp lệ.";
        }
    } 
    public static function details() {
        // Lấy product_id từ URL
        $productId = $_GET['product_id'] ?? null;
    
        // Log productId để đảm bảo nó được truyền đúng 
        // Kiểm tra nếu không có product_id, thì trả về thông báo lỗi
        if (!$productId) {
            echo "Sản phẩm không hợp lệ.";
            return;
        }
    
        // Tạo đối tượng Comment và lấy bình luận cho sản phẩm
        $comment = new Product();
        $comments = $comment->getCommentsByProductId($productId); 
        
        if (empty($comments)) {
            echo "Không có bình luận nào cho sản phẩm này.";
        } else {
            
            Header::render();  // Hiển thị phần đầu trang
            Details::render($comments);  // Gọi view để hiển thị danh sách bình luận
            Footer::render();  // Hiển thị phần chân trang
        }
    }
    
    
    
    
    
}

