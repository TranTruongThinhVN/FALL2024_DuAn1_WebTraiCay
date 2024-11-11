<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class AuthValidation
{
    public static function register(): bool
    {
        $is_valid = true;
        // Mảng này lưu trữ các thông báo lỗi tương ứng với từng trường dữ liệu trong form.
        $_SESSION['errors'] = [];
        // Kiểm tra xem tên đăng nhập có được nhập hay không. Nếu không, thêm lỗi vào mản
        if (!isset($_POST['password']) || $_POST['password'] === '') {
            $_SESSION['errors']['password'] = 'Mật khẩu không được để trống';
            $is_valid = false;
        } else {
            if (strlen($_POST['password']) < 3) {
                $_SESSION['errors']['password'] = 'Mật khẩu phải lớn hơn 3 ký tự';
                $is_valid = false;
            }
        }
        if (!isset($_POST['re_password']) || $_POST['re_password'] === '') {
            $_SESSION['errors']['re_password'] = 'Xác nhận mật khẩu không được để trống';
            $is_valid = false;
        } else {
            if ($_POST['password'] != $_POST['re_password']) {
                $_SESSION['errors']['re_password'] = 'Xác nhận mật khẩu không khớp';
                $is_valid = false;
            }
        }
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            $_SESSION['errors']['email'] = 'Email không được để trống';
            $is_valid = false;
        } else {
            $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            if (!preg_match($emailPattern, $_POST['email'])) {
                $_SESSION['errors']['email'] = 'Email không đúng định dạng';
                $is_valid = false;
            }
        }
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            $_SESSION['errors']['name'] = 'Họ và tên không được để trống';
            $is_valid = false;
        }

        return $is_valid;
    }
}
