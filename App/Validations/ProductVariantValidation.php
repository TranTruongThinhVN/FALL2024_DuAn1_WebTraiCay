<?php

namespace App\Validations;

use App\Models\Admin\ProductVariant;

class ProductVariantValidation
{
    public static function validateName(): bool
    {
        $_SESSION['errors'] = []; // Reset lỗi mỗi lần gọi
        $is_valid = true;

        // Kiểm tra tên có để trống không
        if (empty($_POST['name'])) {
            $_SESSION['errors']['name'] = 'Tên không được để trống.';
            $is_valid = false;
        }

        // Kiểm tra tên có trùng không
        $model = new ProductVariant();
        if (!empty($_POST['name']) && $model->getOneProductVariantByName($_POST['name'])) {
            $_SESSION['errors']['name'] = 'Tên này đã tồn tại.';
            $is_valid = false;
        }

        return $is_valid;
    }

    public static function validateEditName($id): bool
    {
        $_SESSION['errors'] = []; // Reset lỗi mỗi lần gọi
        $is_valid = true;

        // Kiểm tra tên có để trống không
        if (empty($_POST['name'])) {
            $_SESSION['errors']['name'] = 'Tên không được để trống.';
            $is_valid = false;
        }

        // Kiểm tra tên có trùng (loại trừ ID hiện tại)
        $model = new ProductVariant();
        if (!empty($_POST['name']) && $model->getOneProductVariantByNameExceptId($_POST['name'], $id)) {
            $_SESSION['errors']['name'] = 'Tên này đã tồn tại.';
            $is_valid = false;
        }

        return $is_valid;
    }
}
