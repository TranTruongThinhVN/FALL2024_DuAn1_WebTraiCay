<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\User;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Layouts\Navbar;
use App\Views\Admin\Layouts\Settings_panel;
use App\Views\Admin\Layouts\Sidebar;
use App\Views\Admin\Pages\User\Create;
use App\Views\Admin\Pages\User\Details;
use App\Views\Admin\Pages\User\Edit;
use App\Views\Admin\Pages\User\ListUser;
use App\Views\Client\Components\Notification;

class UserController
{
    // hiển thị danh sách
    public static function index()
    {
        $user = new User();
        $data = $user->getAllUser();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        ListUser::render($data);
        Footer::render();
    }

    public static function create()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }

    // Xử lý thêm người dùng
    public static function store()
    {
        session_start(); // Khởi tạo session nếu chưa có

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $role = intval($_POST['role'] ?? 1);
        $gender = $_POST['gender'] ?? 'other';
        $status = intval($_POST['status'] ?? 1);
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $avatar = null;

        // Kiểm tra dữ liệu bắt buộc
        if (empty($email) || empty($password) || empty($name)) {
            NotificationHelper::error('user_create', 'Vui lòng nhập đầy đủ thông tin!');
            header('Location: /admin/user-create'); // Quay lại form thêm
            exit;
        }

        // Xử lý upload ảnh đại diện (nếu có)
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = self::uploadAvatar($_FILES['avatar']);
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role,
            'gender' => $gender,
            'status' => $status,
            'name' => $name,
            'phone' => $phone,
            'avatar' => $avatar,
        ];

        $userModel = new User();
        $isCreated = $userModel->createUser($data);

        if ($isCreated) {
            NotificationHelper::success('user_create', 'Thêm người dùng thành công!');
        } else {
            NotificationHelper::error('user_create', 'Có lỗi xảy ra khi thêm người dùng!');
        }

        // Chuyển hướng sang danh sách người dùng
        header('Location: /admin/users');
        exit;
    }

    public static function edit($id)
    {
        $user = new User();
        $data = $user->getOneUser($id);
        if (!$data) {
            NotificationHelper::error('edit', 'Không thể xem người dùng này');
            header('location: /admin/users');
            exit;
        }

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Edit::render(['user' => $data]); // Truyền thông tin người dùng vào view
        Footer::render();
    }

    // Xử lý cập nhật thông tin người dùng
    public static function update($id)
    {
        session_start();

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $role = intval($_POST['role'] ?? 1);

        // Lấy thông tin hiện tại của người dùng từ DB
        $userModel = new User();
        $currentUser = $userModel->getOneUser($id); // Lấy dữ liệu hiện tại của user

        if (!$currentUser) {
            NotificationHelper::error('user_edit', 'Người dùng không tồn tại!');
            header("Location: /admin/users");
            exit;
        }

        // Kiểm tra dữ liệu bắt buộc
        if (empty($name) || empty($email)) {
            NotificationHelper::error('user_edit', 'Vui lòng nhập đầy đủ thông tin!');
            header("Location: /admin/user-edit/$id");
            exit;
        }

        // Xử lý upload ảnh đại diện 
        $avatar = $currentUser['avatar']; // Giữ nguyên avatar cũ mặc định
        if (!empty($_FILES['avatar']['name'])) {
            $uploadedAvatar = self::uploadAvatar($_FILES['avatar']);
            if ($uploadedAvatar) {
                $avatar = $uploadedAvatar; // Thay thế avatar nếu có hình ảnh mới
            }
        }

        // Cập nhật dữ liệu
        $data = [
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'avatar' => $avatar, // Sử dụng avatar cũ nếu không có avatar mới
        ];

        $isUpdated = $userModel->updateUser($id, $data);

        if ($isUpdated) {
            NotificationHelper::success('user_edit', 'Cập nhật thông tin người dùng thành công!');
        } else {
            NotificationHelper::error('user_edit', 'Có lỗi xảy ra khi cập nhật thông tin!');
        }

        header('Location: /admin/users');
        exit;
    }

    // Xóa người dùng
    public static function delete($id)
    {
        $userModel = new User();
        $isDeleted = $userModel->deleteUser($id);

        if ($isDeleted) {
            NotificationHelper::success('user_delete', 'Xóa người dùng thành công');
            header('Location: /admin/users?success=deleted');
        } else {
            NotificationHelper::error('user_delete', 'Xóa người dùng thất bại');
            header('Location: /admin/users?error=delete_failed');
        }
        exit;
    }

    // Xử lý upload avatar
    private static function uploadAvatar($file)
    {
        $targetDir = 'uploads/avatars/';
        $fileName = time() . '_' . basename($file['name']);
        $targetFile = $targetDir . $fileName;

        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Upload file
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return '/' . $targetFile;
        }

        return null;
    }
}
