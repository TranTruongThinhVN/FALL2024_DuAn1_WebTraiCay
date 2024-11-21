<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;
use App\Models\User;
use DateTime;

class AuthValidation
{
    public static function register(): bool
    {
        $is_valid = true;
        $_SESSION['errors'] = []; // Reset errors each time

        // Email validation
        if (empty($_POST['email'])) {
            $_SESSION['errors']['email'] = 'Email không được để trống';
            $is_valid = false;
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'Email không đúng định dạng';
            $is_valid = false;
        }

        // Password validation
        if (empty($_POST['password'])) {
            $_SESSION['errors']['password'] = 'Mật khẩu không được để trống';
            $is_valid = false;
        } elseif (
            strlen($_POST['password']) < 6 ||
            !preg_match('/[A-Z]/', $_POST['password']) ||
            !preg_match('/[a-z]/', $_POST['password']) ||
            !preg_match('/[0-9]/', $_POST['password']) ||
            !preg_match('/[\W]/', $_POST['password'])
        ) {
            $_SESSION['errors']['password'] = 'Mật khẩu của bạn phải dài từ 8 đến 16 ký tự, phải chứa ít nhất 1 ký tự viết hoa, 1 ký tự viết thường, 1 ký tự số và 1 ký tự đặc biệt';
            $is_valid = false;
        }

        // Confirm password validation
        if (empty($_POST['re_password'])) {
            $_SESSION['errors']['re_password'] = 'Xác nhận mật khẩu không được để trống';
            $is_valid = false;
        } elseif ($_POST['password'] !== $_POST['re_password']) {
            $_SESSION['errors']['re_password'] = 'Xác nhận mật khẩu không khớp';
            $is_valid = false;
        }

        return $is_valid;
    }
    public static function login(): bool
    {
        $_SESSION['errors'] = [];
        $is_valid = true;

        if (empty($_POST['email'])) {
            $_SESSION['errors']['email'] = 'Email không được để trống';
            $is_valid = false;
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'Email không đúng định dạng';
            $is_valid = false;
        }

        if (empty($_POST['password'])) {
            $_SESSION['errors']['password'] = 'Mật khẩu không được để trống';
            $is_valid = false;
        }

        return $is_valid;
    }
    public static function forgotPassword(): bool
    {
        $_SESSION['errors'] = [];
        $is_valid = true;

        // Email validation
        if (empty($_POST['email'])) {
            $_SESSION['errors']['email'] = 'Email không được để trống';
            $is_valid = false;
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'Email không đúng định dạng';
            $is_valid = false;
        }

        return $is_valid;
    }

    public static function resetPassword(): bool
    {
        $_SESSION['errors'] = [];
        $is_valid = true;

        if (empty($_POST['new_password'])) {
            $_SESSION['errors']['new_password'] = 'Mật khẩu mới không được để trống';
            $is_valid = false;
        } elseif (strlen($_POST['new_password']) < 6) {
            $_SESSION['errors']['new_password'] = 'Mật khẩu mới phải có ít nhất 6 ký tự';
            $is_valid = false;
        }

        if (empty($_POST['confirm_password'])) {
            $_SESSION['errors']['confirm_password'] = 'Xác nhận mật khẩu không được để trống';
            $is_valid = false;
        } elseif ($_POST['new_password'] !== $_POST['confirm_password']) {
            $_SESSION['errors']['confirm_password'] = 'Mật khẩu không khớp';
            $is_valid = false;
        }

        return $is_valid;
    }
    public static function edit(): bool
    {
        $is_valid = true;
        $_SESSION['errors'] = [];

        if (!isset($_POST['name']) || $_POST['name'] === '') {
            $_SESSION['errors']['name'] = 'Họ và tên không được để trống';
            $is_valid = false;
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

        if (
            empty($_POST['dob_day']) &&
            empty($_POST['dob_month']) &&
            empty($_POST['dob_year'])
        ) {
            // Người dùng không nhập ngày sinh, bỏ qua kiểm tra
            $_SESSION['data']['dob'] = null;
        } elseif (
            !empty($_POST['dob_day']) &&
            !empty($_POST['dob_month']) &&
            !empty($_POST['dob_year']) &&
            checkdate((int)$_POST['dob_month'], (int)$_POST['dob_day'], (int)$_POST['dob_year'])
        ) {
            // Người dùng nhập ngày sinh hợp lệ
            $_SESSION['data']['dob'] = sprintf(
                '%04d-%02d-%02d',
                (int)$_POST['dob_year'],
                (int)$_POST['dob_month'],
                (int)$_POST['dob_day']
            );
        } else {
            // Người dùng nhập ngày sinh không hợp lệ
            $_SESSION['errors']['dob'] = 'Ngày sinh không hợp lệ.';
            $is_valid = false;
        }


        // Kiểm tra giới tính (nếu có)
        if (!empty($_POST['gender'])) {
            $valid_genders = ['male', 'female', 'other'];
            if (!in_array($_POST['gender'], $valid_genders)) {
                $_SESSION['errors']['gender'] = 'Giới tính không hợp lệ.';
                $is_valid = false;
            }
        }


        return $is_valid;
    }

    public static function uploadAvatar()
    {
        if (!file_exists($_FILES['avatar']['tmp_name']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            return false;
        }
        $target_dir = 'public/uploads/users/';
        $imageFileType = strtolower(pathinfo(basename($_FILES['avatar']['name']), PATHINFO_EXTENSION));

        // Kiểm tra định dạng tệp
        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
            NotificationHelper::error('type_upload', 'Chỉ nhận file ảnh JPG, PNG, JPEG');
            return false;
        }

        // Đổi tên file theo năm tháng ngày phút giây
        $nameImage = date('YmdHis') . '.' . $imageFileType;
        $target_file = $target_dir . $nameImage;

        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
            NotificationHelper::error('move_upload', 'Không thể tải ảnh vào thư mục lưu trữ');
            return false;
        }

        return $nameImage;
    }
    public static function isValidPhoneNumber($phone)
    {
        return preg_match('/^(\+84|0)[3|5|7|8|9]\d{8}$/', $phone);
    }
}
