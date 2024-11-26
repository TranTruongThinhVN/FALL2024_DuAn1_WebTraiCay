<?php

namespace App\Views\Admin\Pages\Discount;

use App\Views\BaseView;

class Discount extends BaseView
{

    public static function render($data = null)
    {

?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">QUẢN LÝ MÃ GIẢM GIÁ</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Danh sách mã giảm giá</li>
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
                                <h5 class="card-title" style="margin-bottom: 20px;">Danh sách mã giảm giá</h5>
                                <div class="card-filter" style="display: flex; gap: 16px; margin-bottom: 20px;">
                                    <!-- Lọc theo loại giảm giá -->
                                    <form method="GET" action="/admin/discount" style="display: flex; align-items: center; gap: 10px;">
                                        <select class="form-control" name="discount_type" style="width: 200px; padding: 5px; height: 38px;">
                                            <option value="">Tất cả loại giảm giá</option>
                                            <option value="1" <?= isset($_GET['discount_type']) && $_GET['discount_type'] == '1' ? 'selected' : '' ?>>Giảm theo %</option>
                                            <option value="2" <?= isset($_GET['discount_type']) && $_GET['discount_type'] == '2' ? 'selected' : '' ?>>Giảm số tiền</option>
                                        </select>
                                        <button class="btn btn-primary" type="submit" style="height: 38px; padding: 5px 10px;">Lọc</button>
                                    </form>
                                    <!-- Tìm kiếm -->
                                    <form class="d-flex" method="GET" action="/admin/discount" style="display: flex; gap: 10px; align-items: center;">
                                        <input
                                            class="form-control"
                                            type="search"
                                            name="search"
                                            placeholder="Nhập mã giảm giá ..."
                                            style="width: 300px; padding: 5px; height: 38px;"
                                            value="<?= htmlspecialchars($data['keyword'] ?? '', ENT_QUOTES) ?>">
                                        <button class="btn btn-success" type="submit" style="height: 38px; padding: 5px 10px;">Tìm kiếm</button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table " style="width: 100%; text-align: left; border-collapse: collapse;">
                                    <thead style="background-color: #f4f4f4;">
                                        <tr>
                                            <th style="padding: 10px;">Mã giảm giá</th>
                                            <th style="padding: 10px;">Mô tả</th>
                                            <th style="padding: 10px;">Loại giảm giá</th>
                                            <th style="padding: 10px;">Giá trị</th>
                                            <th style="padding: 10px;">Ngày bắt đầu</th>
                                            <th style="padding: 10px;">Ngày kết thúc</th>
                                            <th style="padding: 10px;">Đơn hàng tối thiểu</th>
                                            <th style="padding: 10px;">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($data['discounts']) && is_array($data['discounts'])): ?>
                                            <?php foreach ($data['discounts'] as $discount): ?>
                                                <tr>
                                                    <td style="padding: 10px;">
                                                        <!-- Hiển thị mã giảm giá -->
                                                        <code style="background-color: #f8f9fa; border: 1px solid #ddd; padding: 2px 5px; border-radius: 3px; font-size: 14px;">
                                                            <?= htmlspecialchars($discount['code']) ?>
                                                        </code>
                                                        <!-- Hiển thị ID, Sửa, Xóa -->
                                                        <div class="d-flex align-items-center gap-1 mt-1">
                                                            <span>ID: <?= htmlspecialchars($discount['id']) ?></span> |
                                                            <a href="/admin/edit-discount/<?= $discount['id'] ?>" class="text-warning" style="text-decoration: none;">Chỉnh sửa</a> |
                                                            <form action="/admin/delete-discount/<?= $discount['id'] ?>" method="post" style="display: inline-block;" onsubmit="return confirm('Bạn chắc chắn muốn xóa mã giảm giá này?')">
                                                                <input type="hidden" name="method" value="DELETE">
                                                                <button type="submit" class="text-danger btn  p-0" style="text-decoration: none;">Xóa</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td style="padding: 10px;">
                                                        <button
                                                            class="btn btn-info btn-sm view-description"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#descriptionModal"
                                                            data-description="<?= htmlspecialchars($discount['description']) ?>"
                                                            style="padding: 5px 10px;">
                                                            Xem nhanh
                                                        </button>
                                                    </td>

                                                    <td style="padding: 10px;"><?= $discount['discount_type'] == 1 ? 'Giảm theo %' : 'Giảm số tiền' ?></td>
                                                    <td style="padding: 10px;">
                                                        <?= $discount['discount_type'] == 1
                                                            ? intval($discount['discount_value']) . '%'
                                                            : number_format($discount['discount_value'], 0, ',', '.') . ' VNĐ' ?>
                                                    </td>
                                                    <td style="padding: 10px;"><?= date('d/m/Y H:i', strtotime($discount['start_date'])) ?></td>
                                                    <td style="padding: 10px;"><?= date('d/m/Y H:i', strtotime($discount['end_date'])) ?></td>
                                                    <td style="padding: 10px;"><?= number_format($discount['min_order_value'], 0, ',', '.') ?> VNĐ</td>
                                                    <td style="padding: 10px;">
                                                        <?= $discount['status'] == 1
                                                            ? '<span style="color: #fff; background-color: #28a745; padding: 5px 10px; border-radius: 5px;">Kích hoạt</span>'
                                                            : '<span style="color: #fff; background-color: #6c757d; padding: 5px 10px; border-radius: 5px;">Ngừng kích hoạt</span>' ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" style="text-align: center; padding: 20px;">Không tìm thấy kết quả phù hợp.</td>
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
                        <h5 class="modal-title" id="descriptionModalLabel">Chi tiết mô tả</h5>
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
                        modalDescription.textContent = description || 'Không có mô tả.';
                    });
                });
            });
        </script>
<?php

    }
}

?>