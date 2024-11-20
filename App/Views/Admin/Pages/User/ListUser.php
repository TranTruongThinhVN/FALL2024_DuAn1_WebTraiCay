<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class ListUser extends BaseView
{
  public static function render($data = null)
  {
?>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">QUẢN LÝ DANH SÁCH NGƯỜI DÙNG</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Danh sách người dùng</li>
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
                <h5 class="card-title mb-0">Danh sách người dùng</h5>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th>STT</th>
                      <th>Tên người dùng</th>
                      <th>Ảnh</th>
                      <th>Email</th>
                      <!-- <th>Số điện thoại</th> -->
                      <th>Vai trò</th>
                      <!-- <th>Trạng thái</th> -->
                      <th>Tuỳ chỉnh</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $index => $user): ?>
                        <tr>
                          <td><?php echo $index + 1; ?></td>
                          <td><?php echo $user['name'] ?? 'N/A'; ?></td>
                          <td>
                            <?php if (!empty($user['avatar'])): ?>
                              <img src="<?php echo $user['avatar']; ?>" alt="Avatar" width="40px">
                            <?php else: ?>
                              <img src="/path/to/default/avatar.jpg" alt="Default Avatar" width="40px">
                            <?php endif; ?>
                          </td>
                          <td><?php echo $user['email']; ?></td>
                          <!-- <td><?php echo $user['phone'] ?? 'N/A'; ?></td> -->
                          <td><?php echo $user['role'] == 1 ? 'Người dùng' : 'Quản trị viên'; ?></td>
                          <!-- <td>
                            <?php if ($user['status'] == 1): ?>
                              <span class="badge bg-success">Hoạt động</span>
                            <?php else: ?>
                              <span class="badge bg-danger">Bị khóa</span>
                            <?php endif; ?>
                          </td> -->
                          <td>
                            <a href="/admin/users-edit/<?= $user['id'] ?>" class="btn btn-primary">Sửa</a>
                            <form action="/admin/users-delete/<?= $user['id'] ?>" method="post" style="display: inline-block;">
                              <input type="hidden" name="method" value="DELETE" id="">
                              <button type="submit" class="btn btn-danger text-white">Xoá</button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="8" class="text-center">Không có người dùng nào!</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
  }
}
