<?php

namespace App\Validations;

use App\Models\Admin\Category;

class CategoryValidation
{
    public static function create(): bool
    {
        $is_valid = true;

        // Reset lỗi mỗi lần validate
        $_SESSION['errors'] = $_SESSION['errors'] ?? [];

        // Gọi model
        $categoryModel = new Category();

        // Kiểm tra tên danh mục
        if (empty($_POST['name']) || strlen($_POST['name']) < 3) {
            $_SESSION['errors']['name'] = 'Tên danh mục phải có ít nhất 3 ký tự.';
            $is_valid = false;
        } elseif (!empty($_POST['name'])) {
            // Debug kiểm tra tên danh mục
            error_log('Tên danh mục đang kiểm tra: ' . $_POST['name']);

            // Kiểm tra tên danh mục đã tồn tại
            $category = $categoryModel->getOneCategoryByName($_POST['name']);
            if ($category) {
                error_log('Tên danh mục đã tồn tại: ' . $_POST['name']);
                $_SESSION['errors']['name'] = 'Tên danh mục đã tồn tại.';
                $is_valid = false;
            } else {
                unset($_SESSION['errors']['name']); // Xóa lỗi nếu hợp lệ
            }
        }

        // Kiểm tra trạng thái
        if (!isset($_POST['status']) || !in_array($_POST['status'], ['0', '1'])) {
            $_SESSION['errors']['status'] = 'Vui lòng chọn trạng thái hợp lệ.';
            $is_valid = false;
        } else {
            unset($_SESSION['errors']['status']); // Xóa lỗi nếu hợp lệ
        }

        return $is_valid;
    }
}
