<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
        $user = $data['user'] ?? []; // Lấy dữ liệu người dùng từ mảng data
?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">CHỈNH SỬA THÔNG TIN NGƯỜI DÙNG</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item"><a href="/admin/user-list">Danh sách người dùng</a></li>
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
                                <h5 class="card-title">Form chỉnh sửa thông tin người dùng</h5>
                                <form action="/admin/user-update/<?php echo $user['id'] ?? ''; ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="method" value="PUT">
                                    <!-- Tên người dùng -->
                                    <div class="form-group">
                                        <label for="name">Tên người dùng</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="<?php echo $user['name'] ?? ''; ?>" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="<?php echo $user['email'] ?? ''; ?>" required>
                                    </div>

                                    <!-- Ảnh đại diện -->
                                    <div class="form-group">
                                        <label for="avatar">Ảnh đại diện</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control">
                                        <?php if (!empty($user['avatar'])): ?>
                                            <img src="<?php echo $user['avatar']; ?>" alt="Avatar" width="100px" class="mt-2">
                                        <?php endif; ?>
                                    </div>

                                    <!-- Vai trò -->
                                    <div class="form-group">
                                        <label for="role">Vai trò</label>
                                        <select name="role" id="role" class="form-control" required>
                                            <option value="0" <?php echo isset($user['role']) && $user['role'] == 0 ? 'selected' : ''; ?>>Người dùng</option>
                                            <option value="1" <?php echo isset($user['role']) && $user['role'] == 1 ? 'selected' : ''; ?>>Quản trị viên</option>
                                        </select>
                                    </div>

                                    <!-- Nút hành động -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                                        <a href="/admin/users" class="btn btn-secondary">Hủy bỏ</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
