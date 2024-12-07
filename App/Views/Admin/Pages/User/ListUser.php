<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class ListUser extends BaseView
{
  public static function render($data = null)
  {
    $users = $data['users'] ?? []; // Danh sách người dùng
    $currentPage = $data['currentPage'] ?? 1; // Trang hiện tại
    $totalPages = $data['totalPages'] ?? 1; // Tổng số trang
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
              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th>STT</th>
                      <th>Tên người dùng</th>
                      <th>Ảnh</th>
                      <th>Email</th>
                      <th>Ngày sinh</th>
                      <th>Giới tính</th>
                      <th>Số điện thoại</th>
                      <th>Vai trò</th>
                      <th>Tuỳ chỉnh</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($users): ?>
                      <?php foreach ($users as $index => $user): ?>
                        <tr>
                          <td><?php echo ($currentPage - 1) * 10 + $index + 1; ?></td>
                          <td><?php echo $user['name'] ?? 'Chưa cập nhật tên'; ?></td>
                          <td>
                            <?php if (!empty($user['avatar'])): ?>
                              <img src="<?php echo $user['avatar']; ?>" alt="Avatar" width="40px">
                            <?php else: ?>
                              <img src="/path/to/default/avatar.jpg" alt="Default Avatar" width="40px">
                            <?php endif; ?>
                          </td>
                          <td><?php echo $user['email']; ?></td>
                          <td><?php echo $user['dob']; ?></td>
                          <td><?php echo $user['gender']; ?></td>
                          <td><?php echo $user['phone'] ?? 'Chưa cập nhật SDT'; ?></td>
                          <td><?php echo $user['role'] == 1 ? 'Người dùng' : 'Quản trị viên'; ?></td>
                          <td>
                            <a href="/admin/users-edit/<?php echo $user['id']; ?>?page=<?php echo $currentPage; ?>" class="btn btn-primary">Sửa</a>
                            <form action="/admin/users-delete/<?php echo $user['id']; ?>" method="post" style="display: inline-block;">
                              <input type="hidden" name="method" value="DELETE">
                              <button type="submit" class="btn btn-danger text-white">Xoá</button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6" class="text-center">Không có người dùng nào!</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

              <!-- Bắt đầu phân trang -->
              <div class="pagination-wrapper">
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-center">
                    <?php if ($currentPage > 1): ?>
                      <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Trước</a>
                      </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                      <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                      </li>
                    <?php endfor; ?>
                    <?php if ($currentPage < $totalPages): ?>
                      <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Sau</a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </nav>
              </div>
              <!-- Kết thúc phân trang -->
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
