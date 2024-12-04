<?php

namespace App\Validations;

use App\Models\Admin\Recipe_category;


class Recipe_categoryValidation
{
    public static function create(int $id = null): bool
    {
        $is_valid = true;
    
        // Reset lỗi mỗi lần validate
        $_SESSION['errors'] = $_SESSION['errors'] ?? [];
    
        // Gọi model
        $RecipeModel = new Recipe_category();
    
        // Kiểm tra tên danh mục
        if (empty($_POST['name']) || strlen($_POST['name']) < 3) {
            $_SESSION['errors']['name'] = 'Tên danh mục phải có ít nhất 3 ký tự.';
            $is_valid = false;
        } elseif (!empty($_POST['name'])) {
            // Kiểm tra tên danh mục đã tồn tại (loại trừ chính danh mục đang sửa)
            $category = $RecipeModel->getOneRecipe_categoryByName($_POST['name']);
            if ($category && intval($category['id']) !== $id) {
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
