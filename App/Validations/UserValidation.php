<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;
use App\Models\User;

class UserValidation
{
    // Kiểm tra dữ liệu khi tạo người dùng
    public static function register(): bool
    {
        $is_valid = true;
        $_SESSION['errors'] = []; // Reset lỗi mỗi lần kiểm tra

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
            strlen($_POST['password']) < 8 ||
            strlen($_POST['password']) > 16 ||
            !preg_match('/[A-Z]/', $_POST['password']) ||
            !preg_match('/[a-z]/', $_POST['password']) ||
            !preg_match('/[0-9]/', $_POST['password']) ||
            !preg_match('/[\W]/', $_POST['password'])
        ) {
            $_SESSION['errors']['password'] = 'Mật khẩu phải từ 8-16 ký tự, có ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt';
            $is_valid = false;
        }

        // Phone validation
        if (empty($_POST['phone'])) {
            $_SESSION['errors']['phone'] = 'Số điện thoại không được để trống';
            $is_valid = false;
        } elseif (!preg_match('/^0[0-9]{9}$/', $_POST['phone'])) {
            $_SESSION['errors']['phone'] = 'Số điện thoại phải có 10 chữ số và bắt đầu bằng số 0';
            $is_valid = false;
        }

        // Date of Birth (dob) validation
        if (empty($_POST['dob'])) {
            $_SESSION['errors']['dob'] = 'Ngày sinh không được để trống';
            $is_valid = false;
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['dob'])) {
            $_SESSION['errors']['dob'] = 'Ngày sinh không đúng định dạng (YYYY-MM-DD)';
            $is_valid = false;
        } elseif (strtotime($_POST['dob']) > strtotime('now')) {
            $_SESSION['errors']['dob'] = 'Ngày sinh không được lớn hơn ngày hiện tại';
            $is_valid = false;
        }

        // Gender validation
        if (empty($_POST['gender']) || !in_array($_POST['gender'], ['male', 'female', 'other'])) {
            $_SESSION['errors']['gender'] = 'Giới tính không hợp lệ';
            $is_valid = false;
        }

        return $is_valid;
    }

    // Kiểm tra dữ liệu khi chỉnh sửa
    public static function edit(): bool
    {
        $is_valid = true;
        $_SESSION['errors'] = []; // Reset lỗi

        // Name validation
        if (empty($_POST['name'])) {
            $_SESSION['errors']['name'] = 'Họ và tên không được để trống';
            $is_valid = false;
        }

        // Email validation
        if (empty($_POST['email'])) {
            $_SESSION['errors']['email'] = 'Email không được để trống';
            $is_valid = false;
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'Email không đúng định dạng';
            $is_valid = false;
        }

        // Phone validation (nếu có chỉnh sửa)
        if (!empty($_POST['phone']) && !preg_match('/^0[0-9]{9}$/', $_POST['phone'])) {
            $_SESSION['errors']['phone'] = 'Số điện thoại phải có 10 chữ số và bắt đầu bằng số 0';
            $is_valid = false;
        }

        // Date of Birth (dob) validation (nếu có chỉnh sửa)
        if (!empty($_POST['dob']) && strtotime($_POST['dob']) > strtotime('now')) {
            $_SESSION['errors']['dob'] = 'Ngày sinh không được lớn hơn ngày hiện tại';
            $is_valid = false;
        }

        return $is_valid;
    }

    public static function uploadAvatar($file)
    {
        // Đường dẫn thư mục lưu ảnh
        $targetDir = 'public/uploads/users/';
        $fileName = time() . '_' . basename($file['name']);
        $targetFile = $targetDir . $fileName;

        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Kiểm tra định dạng tệp (jpg, jpeg, png)
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (!in_array($fileType, ['jpg', 'jpeg', 'png'])) {
            return false; // Không hợp lệ, trả về false
        }

        // Di chuyển file vào thư mục
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return '/' . $targetFile; // Trả về đường dẫn file nếu upload thành công
        }

        return false; // Trả về false nếu upload thất bại
    }
}
