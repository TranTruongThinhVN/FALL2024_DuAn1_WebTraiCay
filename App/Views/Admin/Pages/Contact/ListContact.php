<?php

namespace App\Views\Admin\Pages\Contact;

use App\Views\BaseView;

class ListContact extends BaseView
{

    public static function render($data = null)
    {

?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">QUẢN LÝ LIÊN HỆ</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Danh sách liên hệ</li>
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
                                <h5 class="card-title" style="margin-bottom: 20px;">Danh sách liên hệ</h5>
                                <!-- Tìm kiếm -->
                                <form class="d-flex" method="GET" action="/admin/contact" style="display: flex; gap: 10px; align-items: center; margin-bottom: 20px;">
                                    <input
                                        class="form-control"
                                        type="search"
                                        name="search"
                                        placeholder="Nhập tên, email hoặc số điện thoại..."
                                        style="width: 300px; padding: 5px; height: 38px;"
                                        value="<?= htmlspecialchars($data['keyword'] ?? '', ENT_QUOTES) ?>">
                                    <button class="btn btn-success" type="submit" style="height: 38px; padding: 5px 10px;">Tìm kiếm</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table " style="width: 100%; text-align: left; border-collapse: collapse;">
                                    <thead style="background-color: #f4f4f4;">
                                        <tr>
                                            <th style="padding: 10px;">Tên</th>
                                            <th style="padding: 10px;">Email</th>
                                            <th style="padding: 10px;">Số điện thoại</th>
                                            <th style="padding: 10px;">Ngày gửi</th>
                                            <th style="padding: 10px;">Nội dung</th>
                                            <th style="padding: 10px;">Trạng thái</th>
                                            <th></th>
                                            <th style="padding: 10px;">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($data['contacts']) && is_array($data['contacts'])): ?>
                                            <?php foreach ($data['contacts'] as $contact): ?>
                                                <tr>
                                                    <td style="padding: 10px;"><?= htmlspecialchars($contact['name']) ?></td>
                                                    <td style="padding: 10px;"><?= htmlspecialchars($contact['email']) ?></td>
                                                    <td style="padding: 10px;"><?= htmlspecialchars($contact['phone']) ?></td>
                                                    <td style="padding: 10px;"><?= date('d/m/Y H:i', strtotime($contact['created_at'])) ?></td>
                                                    <td style="padding: 10px;">
                                                        <button
                                                            class="btn btn-info btn-sm view-description"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#descriptionModal"
                                                            data-description="<?= htmlspecialchars($contact['message']) ?>"
                                                            style="padding: 5px 10px;">
                                                            Xem nhanh
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <?= $contact['status'] == 0
                                                            ? '<span style="color: orange;">Chờ xử lý</span>'
                                                            : '<span style="color: green;">Đã xử lý</span>' ?>
                                                    </td>
                                                    <td style="padding: 10px;">
                                                        <div class="d-flex flex-column gap-2">
                                                            <!-- Form cập nhật trạng thái -->
                                                            <form action="/admin/contact/update-status/<?= $contact['id'] ?>" method="POST" class="d-inline-block">
                                                                <input type="hidden" name="method" value="PUT">
                                                                <input type="hidden" name="status" value="<?= $contact['status'] == 0 ? 1 : 0 ?>">
                                                                <button type="submit" class="btn btn-sm <?= $contact['status'] == 0 ? 'btn-success' : 'btn-secondary' ?>">
                                                                    <?= $contact['status'] == 0 ? 'Đánh dấu đã xử lý' : 'Đánh dấu chờ xử lý' ?>
                                                                </button>
                                                            </form>

                                                            <!-- Form gửi phản hồi -->
                                                            <form method="POST" action="/admin/contacts/reply/<?= $contact['id'] ?>" class="d-flex flex-column gap-2">
                                                                <input type="hidden" name="method" value="POST">
                                                                <textarea name="reply_message" placeholder="Phản hồi" class="form-control mb-2" rows="2" style="resize: none;"></textarea>
                                                                <button type="submit" class="btn btn-primary btn-sm">Gửi Email</button>
                                                            </form>
                                                        </div>
                                                    </td>

                                                    <td style="padding: 10px;">
                                                        <form action="/admin/contact/<?= $contact['id'] ?>" method="post" style="display: inline-block;" onsubmit="return confirm('Bạn chắc chắn muốn xóa liên hệ này?')">
                                                            <input type="hidden" name="method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger" style="text-decoration: none;">Xóa</button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" style="text-align: center; padding: 20px;">Không tìm thấy kết quả phù hợp.</td>
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
        <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="descriptionModalLabel">Chi tiết nội dung</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="modalDescription">Đang tải...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .table th,
            .table td {
                padding: 10px;
                vertical-align: middle;
                line-height: 1.5;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('descriptionModal');
                const modalDescription = document.getElementById('modalDescription');

                // Gán sự kiện cho tất cả nút "Xem nhanh"
                document.querySelectorAll('.view-description').forEach(button => {
                    button.addEventListener('click', function() {
                        const description = this.getAttribute('data-description');
                        modalDescription.textContent = description || 'Không có nội dung.';
                    });
                });
            });
        </script>
<?php

    }
}
?>