<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\User;
use App\Validations\UserValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\User\Create;
use App\Views\Admin\Pages\User\Details;
use App\Views\Admin\Pages\User\Edit;
use App\Views\Admin\Pages\User\ListUser;
use App\Views\Client\Components\Notification;

class UserController
{
    public static function index()
    {
        $user = new User();

        $perPage = 10; // Số người dùng trên mỗi trang
        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1; // Trang hiện tại
        $offset = ($currentPage - 1) * $perPage;

        $data = $user->getUsersByPage($perPage, $offset); // Lấy danh sách người dùng
        $totalUsers = $user->getTotalUsers(); // Tổng số người dùng
        $totalPages = ceil($totalUsers / $perPage); // Tính tổng số trang

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        ListUser::render([
            'users' => $data,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
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
        // Kiểm tra dữ liệu đầu vào
        if (!UserValidation::register()) {
            NotificationHelper::error('user_create', 'Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.');
            header('Location: /admin/user-create');
            exit;
        }

        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mã hóa mật khẩu
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $dob = trim($_POST['dob'] ?? null);
        $gender = trim($_POST['gender'] ?? 'other');
        $status = intval($_POST['status'] ?? 1);
        $avatar = null;

        // Kiểm tra và xử lý ảnh đại diện
        if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
            $uploadResult = self::uploadAvatar($_FILES['avatar']);
            if (isset($uploadResult['error'])) {
                NotificationHelper::error('user_create', $uploadResult['error']);
                header('Location: /admin/user-create');
                exit;
            }
            $avatar = $uploadResult['path'];  // Lưu đường dẫn ảnh đã upload
        }

        $data = [
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'phone' => $phone,
            'dob' => $dob,
            'gender' => $gender,
            'status' => $status,
            'avatar' => $avatar, // Lưu ảnh nếu có
        ];

        $userModel = new User();
        $isCreated = $userModel->createUser($data);

        if ($isCreated) {
            NotificationHelper::success('user_create', 'Thêm người dùng thành công!');
            header('Location: /admin/users');
        } else {
            NotificationHelper::error('user_create', 'Có lỗi xảy ra khi thêm người dùng. Vui lòng thử lại.');
            header('Location: /admin/user-create');
        }
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

        // Lấy tham số page từ URL (nếu có)
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

        Header::render();
        Notification::render();
        NotificationHelper::unset();

        // Truyền tham số `page` vào View để giữ thông tin
        Edit::render(['user' => $data, 'page' => $page]);
        Footer::render();
    }

    public function update($id)
    {
        // Lấy dữ liệu từ form gửi lên
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 0;
        $avatar = $_FILES['avatar'] ?? null;

        // Kiểm tra và xử lý ảnh đại diện (nếu có)
        $avatarPath = null;
        if ($avatar && $avatar['error'] === UPLOAD_ERR_OK) {
            $uploadResult = self::uploadAvatar($avatar);

            // Kiểm tra nếu có lỗi trong việc tải ảnh
            if (isset($uploadResult['error'])) {
                NotificationHelper::error('user_update', $uploadResult['error']);
                header('Location: /admin/user-edit/' . $id);
                exit;
            }

            // Lưu đường dẫn ảnh nếu upload thành công
            $avatarPath = $uploadResult['path'];
        }

        // Nếu người dùng nhập mật khẩu mới, xử lý mật khẩu
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_BCRYPT); // Mã hóa mật khẩu
        } else {
            $password = null; // Nếu không thay đổi mật khẩu, giữ nguyên giá trị cũ
        }

        // Cập nhật thông tin người dùng trong cơ sở dữ liệu
        $userModel = new User();

        // Dữ liệu cần cập nhật
        $data = [
            'name' => $name,
            'email' => $email,
            'role' => $role,
        ];

        // Nếu mật khẩu được thay đổi, thêm mật khẩu vào dữ liệu
        if ($password) {
            $data['password'] = $password;
        }

        // Nếu có ảnh đại diện mới, thêm vào dữ liệu
        if ($avatarPath) {
            $data['avatar'] = $avatarPath;
        }

        // Cập nhật người dùng
        $updated = $userModel->updateUser($id, $data);

        // Thông báo kết quả cập nhật
        if ($updated) {
            NotificationHelper::success('user_update', 'Cập nhật người dùng thành công!');
            header('Location: /admin/users?page=' . ($_GET['page'] ?? 1));
        } else {
            NotificationHelper::error('user_update', 'Có lỗi xảy ra khi cập nhật thông tin người dùng.');
            header('Location: /admin/users?page=' . ($_GET['page'] ?? 1));
        }
        exit;
    }
    public static function delete($id)
    {
        // Kiểm tra nếu form gửi lên với phương thức DELETE
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['method']) && $_POST['method'] === 'DELETE') {
            $userModel = new User();

            // Kiểm tra xem người dùng có tồn tại hay không
            $user = $userModel->getOneUser($id);
            if (!$user) {
                NotificationHelper::error('user_delete', 'Không tìm thấy người dùng.');
                header('Location: /admin/users');
                exit;
            }
            // Thực hiện xóa người dùng
            $isDeleted = $userModel->deleteUser($id);

            if ($isDeleted) {
                NotificationHelper::success('user_delete', 'Xóa người dùng thành công');
                header('Location: /admin/users?success=deleted');
            } else {
                NotificationHelper::error('user_delete', 'Có lỗi xảy ra khi xóa người dùng. Vui lòng thử lại.');
                header('Location: /admin/users?error=delete_failed');
            }
            exit;
        }

        // Nếu không phải phương thức POST với method DELETE, chuyển hướng về danh sách người dùng
        header('Location: /admin/users');
        exit;
    }

    // Xử lý upload avatar
    private static function uploadAvatar($file)
    {
        // Định nghĩa thư mục upload
        $targetDir = 'public/uploads/avatars/';
        // Đảm bảo thư mục tồn tại
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }

        // Tạo tên file duy nhất dựa trên thời gian
        $fileName = time() . '_' . basename($file['name']);
        $targetFile = $targetDir . $fileName;

        // Kiểm tra kích thước file (tối đa 2MB)
        if ($file['size'] > 2 * 1024 * 1024) {
            return ['error' => 'Kích thước file quá lớn. Vui lòng chọn file nhỏ hơn 2MB.'];
        }

        // Kiểm tra loại file (jpg, jpeg, png)
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            return ['error' => 'Chỉ hỗ trợ định dạng jpg, jpeg hoặc png.'];
        }

        // Kiểm tra lỗi upload file
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['error' => 'Lỗi tải lên file.'];
        }

        // Di chuyển file vào thư mục mục tiêu
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return ['path' => '/' . $targetFile]; // Trả về đường dẫn của ảnh đã upload
        }

        return ['error' => 'Không thể di chuyển file đến thư mục.'];
    }
}
