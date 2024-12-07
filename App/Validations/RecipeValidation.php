<?php

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
