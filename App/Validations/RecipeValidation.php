<?php

namespace App\Validations;

use App\Models\Admin\Recipe_category;


namespace App\Validations;

class RecipeValidation
{
    public static function create(): bool
    {
        $is_valid = true;

        // Reset lỗi mỗi lần validate
        $_SESSION['errors'] = $_SESSION['errors'] ?? [];

        // Kiểm tra tiêu đề
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['title']) || strlen($_POST['title']) < 3) {
                $_SESSION['errors']['title'] = 'Tiêu đề phải có ít nhất 3 ký tự.';
                $is_valid = false;
            } else {
                unset($_SESSION['errors']['title']);
            }

            // Kiểm tra mô tả
            if (empty($_POST['description']) || strlen($_POST['description']) < 10) {
                $_SESSION['errors']['description'] = 'Mô tả phải có ít nhất 10 ký tự.';
                $is_valid = false;
            } else {
                unset($_SESSION['errors']['description']);
            }

            // Kiểm tra danh mục
            if (empty($_POST['category_id'])) {
                $_SESSION['errors']['category_id'] = 'Vui lòng chọn danh mục.';
                $is_valid = false;
            } else {
                unset($_SESSION['errors']['category_id']);
            }

            // Kiểm tra hình ảnh
            if (!isset($_FILES['image_url']) || $_FILES['image_url']['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['errors']['image_url'] = 'Vui lòng tải lên một hình ảnh hợp lệ.';
                $is_valid = false;
            } elseif (!in_array(mime_content_type($_FILES['image_url']['tmp_name']), ['image/jpeg', 'image/png', 'image/gif'])) {
                $_SESSION['errors']['image_url'] = 'Chỉ chấp nhận định dạng JPEG, PNG hoặc GIF.';
                $is_valid = false;
            } else {
                unset($_SESSION['errors']['image_url']);
            }
        }

        return $is_valid;
    }

    public static function uploadImage($inputName)
    {
        // Kiểm tra xem file có được gửi lên hay không
        if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
            return [
                'success' => false,
                'error' => 'Không tìm thấy file hoặc lỗi khi tải lên.'
            ];
        }

        // Kiểm tra loại file hợp lệ
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES[$inputName]['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            return [
                'success' => false,
                'error' => 'Định dạng file không hợp lệ. Chỉ chấp nhận JPEG, PNG, hoặc GIF.'
            ];
        }

        // Kiểm tra kích thước file (giới hạn 5MB)
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($_FILES[$inputName]['size'] > $maxSize) {
            return [
                'success' => false,
                'error' => 'Kích thước file quá lớn. Giới hạn là 5MB.'
            ];
        }

        // Xử lý upload file
        $imageTmpPath = $_FILES[$inputName]['tmp_name'];
        $imageName = uniqid() . '_' . basename($_FILES[$inputName]['name']);
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/recipes/';
        $uploadFilePath = $uploadDir . $imageName;

        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                return [
                    'success' => false,
                    'error' => 'Không thể tạo thư mục lưu trữ hình ảnh.'
                ];
            }
        }

        // Di chuyển file vào thư mục đích
        if (move_uploaded_file($imageTmpPath, $uploadFilePath)) {
            return [
                'success' => true,
                'path' => '/public/uploads/recipes/' . $imageName // Đường dẫn trả về
            ];
        }

        // Trường hợp lỗi không xác định
        return [
            'success' => false,
            'error' => 'Lỗi không xác định khi tải lên hình ảnh.'
        ];
    }


    public static function edit(int $id): bool
    {
        $is_valid = true;

        // Kiểm tra tiêu đề
        if (empty($_POST['title']) || strlen($_POST['title']) < 3) {
            $_SESSION['errors']['title'] = 'Tiêu đề phải có ít nhất 3 ký tự.';
            $is_valid = false;
        } else {
            unset($_SESSION['errors']['title']);
        }

        // Kiểm tra mô tả
        if (empty($_POST['description']) || strlen($_POST['description']) < 10) {
            $_SESSION['errors']['description'] = 'Mô tả phải có ít nhất 10 ký tự.';
            $is_valid = false;
        } else {
            unset($_SESSION['errors']['description']);
        }

        // Kiểm tra danh mục
        if (empty($_POST['category_id'])) {
            $_SESSION['errors']['category_id'] = 'Vui lòng chọn danh mục.';
            $is_valid = false;
        } else {
            unset($_SESSION['errors']['category_id']);
        }

        // Kiểm tra hình ảnh chỉ khi người dùng upload
        if (!empty($_FILES['image_url']['name'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = mime_content_type($_FILES['image_url']['tmp_name']);

            if (!in_array($fileType, $allowedTypes)) {
                $_SESSION['errors']['image_url'] = 'Định dạng file không hợp lệ. Chỉ chấp nhận JPEG, PNG hoặc GIF.';
                $is_valid = false;
            }

            $maxSize = 5 * 1024 * 1024; // 5MB
            if ($_FILES['image_url']['size'] > $maxSize) {
                $_SESSION['errors']['image_url'] = 'Kích thước file vượt quá giới hạn 5MB.';
                $is_valid = false;
            }
        }

        return $is_valid;
    }
}
