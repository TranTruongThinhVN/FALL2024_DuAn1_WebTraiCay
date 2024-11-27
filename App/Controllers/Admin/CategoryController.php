<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Category;
use App\Validations\CategoryValidation;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Category\Create;
use App\Views\Admin\Pages\Category\Edit;
use App\Views\Admin\Pages\Category\Index;

class CategoryController
{
    // hiển thị danh sách
    public static function index()
    {
        $category = new Category();
        $search = $_GET['search'] ?? null; // Lấy từ khóa tìm kiếm từ URL

        if ($search) {
            $data = $category->searchCategories($search);
        } else {
            $data = $category->getAllCategory();
        }

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }


    //hiển thi ra form thêm
    public static function create()
    {

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }
    public static function store()
    {
        $is_valid = CategoryValidation::create();

        if (!$is_valid) {
            // Trả về form với lỗi nếu không hợp lệ
            header('location: /admin/add-category');
            exit;
        }

        // Thực hiện thêm danh mục nếu hợp lệ
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'status' => $_POST['status'],
        ];

        $category = new Category();
        $result = $category->createCategory($data);

        if ($result) {
            NotificationHelper::success('Thành công!', 'Thêm loại sản phẩm thành công.');
            header('location: /admin/category');
        } else {
            NotificationHelper::error('store', 'Thêm loại sản phẩm thất bại');
            header('location: /admin/add-category');
            exit;
        }
    }







    public static function delete(int $id)
    {
        $category = new Category();
        if ($category) {
        }
        $result = $category->deleteCategory($id);
        if ($result) {
            NotificationHelper::success($message = "Thành công!", $details = "Xóa thành công.");
            header('location: /admin/category');
            exit;
        } else {
            echo "<script>
            alert('Xóa loại sản phẩm thất bại!');
            window.location.href = '/admin/category';
        </script>";
            exit;
        }
    }


    public static function edit(int $id)
    {

        $category = new Category();
        $data = $category->getOneCategory($id);

        if (!$data) {
            echo "<script>
            alert('Không thể xem loại sản phẩm này!');
            window.location.href = '/admin/category';
        </script>";
            exit;
        }
        if ($data) {
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Edit::render(data: $data);
            Footer::render();
        } else {
            header('location: /admin/category');
        }
    }

    public static function update(int $id)
    {
        // Lấy dữ liệu từ form
        $name = $_POST['name'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        $category = new Category();

        // Kiểm tra tên danh mục (bỏ qua chính danh mục đang được cập nhật)
        $existingCategory = $category->getOneCategoryByName($name);

        if ($existingCategory && $existingCategory['id'] != $id) {
            NotificationHelper::error('update', 'Tên danh mục đã tồn tại.');
            header("location: /admin/category/$id");
            exit;
        }

        // Thực hiện cập nhật
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status,
        ];

        $result = $category->updateCategory($id, $data);

        if ($result) {
            NotificationHelper::success('update', 'Cập nhật thành công!');
            header("location: /admin/category");
        } else {
            NotificationHelper::error('update', 'Cập nhật thất bại!');
            header("location: /admin/category/$id");
            exit;
        }
    }


    public function uploadImage()
    {
        // Kiểm tra nếu có file được tải lên
        if (!isset($_FILES['uploads']) || $_FILES['uploads']['error'] !== UPLOAD_ERR_OK) {
            $response = [
                'uploaded' => 0,
                'error' => [
                    'message' => 'No file uploaded or an error occurred during the upload.'
                ]
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        // Lấy thông tin file
        $file = $_FILES['upload'];


        $fileName = uniqid() . '_' . basename($file['name']); // Đặt tên file duy nhất
        $targetDir = 'public/uploads/'; // Thư mục lưu trữ file
        $targetFile = $targetDir . $fileName;

        // Kiểm tra thư mục lưu trữ
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }

        // Kiểm tra định dạng file
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $response = [
                'uploaded' => 0,
                'error' => [
                    'message' => 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.'
                ]
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        // Kiểm tra kích thước file (giới hạn 2MB)
        if ($file['size'] > 2 * 1024 * 1024) { // 2MB = 2 * 1024 * 1024 bytes
            $response = [
                'uploaded' => 0,
                'error' => [
                    'message' => 'File size exceeds 2MB limit.'
                ]
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        // Di chuyển file từ thư mục tạm sang thư mục đích
        if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
            $response = [
                'uploaded' => 0,
                'error' => [
                    'message' => 'Failed to save uploaded file.'
                ]
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        // Trả về phản hồi thành công
        $response = [
            'uploaded' => 1,
            'fileName' => $fileName,
            'url' => '/' . $targetFile // Đường dẫn URL file
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
