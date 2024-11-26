<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
        $user = $data['user'] ?? []; // Lấy dữ liệu người dùng từ mảng data
        $currentPage = $_GET['page'] ?? 1; // Lấy trang hiện tại từ query string
?>

        <body>
            <div class="page-wrapper">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-12 d-flex no-block align-items-center">
                            <h4 class="page-title">CHỈNH SỬA THÔNG TIN NGƯỜI DÙNG</h4>
                            <div class="ms-auto text-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                        <li class="breadcrumb-item">
                                            <a href="/admin/users?page=<?php echo $currentPage; ?>">Danh sách người dùng</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa người dùng</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="editUserForm" action="/admin/user-update/<?php echo $user['id'] ?? ''; ?>?page=<?php echo $currentPage; ?>" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="method" value="PUT">

                                        <!-- Tên người dùng -->
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="name">Tên người dùng</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên người dùng" value="<?php echo $user['name'] ?? ''; ?>">
                                            <span id="nameError" style="color: #dc2626; font-size: 14px; margin-top: 5px; display: none;"></span>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="email" style="font-weight: bold;">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" value="<?php echo $user['email'] ?? ''; ?>">
                                            <span id="emailError" style="color: #dc2626; font-size: 14px; margin-top: 5px; display: none;"></span>
                                        </div>

                                        <!-- Mật khẩu -->
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="password" style="font-weight: bold;">Đặt lại mật khẩu</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới">
                                            <span id="passwordError" style="color: #dc2626; font-size: 14px; margin-top: 5px; display: none;"></span>
                                        </div>

                                        <!-- Ảnh đại diện -->
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="avatar" style="font-weight: bold;">Ảnh đại diện</label>
                                            <input type="file" name="avatar" id="avatar" class="form-control">
                                            <?php if (!empty($user['avatar'])): ?>
                                                <img src="<?php echo $user['avatar']; ?>" alt="Avatar" width="100px" style="margin-top: 10px;">
                                            <?php endif; ?>
                                        </div>

                                        <!-- Vai trò -->
                                        <div class="form-group" style="margin-bottom: 20px; position: relative;">
                                            <label for="role" style="font-weight: bold;">Vai trò</label>
                                            <select name="role" id="role" class="form-control">
                                                <option value="0" <?php echo isset($user['role']) && $user['role'] == 0 ? 'selected' : ''; ?>>Người dùng</option>
                                                <option value="1" <?php echo isset($user['role']) && $user['role'] == 1 ? 'selected' : ''; ?>>Quản trị viên</option>
                                            </select>
                                            <span id="roleError" style="color: #dc2626; font-size: 14px; margin-top: 5px; display: none;"></span>
                                        </div>
                                        <!-- Nút hành động -->
                                        <div class="form-group" style="margin-top: 10px;">
                                            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                                            <a href="/admin/users?page=<?php echo $currentPage; ?>" class="btn btn-secondary">Hủy bỏ</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script
                src="<?= APP_URL ?>/public/assets/admin/js/EditUserValidation.js">
            </script>
        </body>
<?php
    }
}
