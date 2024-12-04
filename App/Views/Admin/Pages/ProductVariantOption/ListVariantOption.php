<?php

namespace App\Views\Admin\Pages\ProductVariantOption;

use App\Views\BaseView;

class ListVariantOption extends BaseView
{
    public static function render($data = null)
    {
?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Danh sách tùy chọn cho biến thể: <?= htmlspecialchars($data['variant']['name']) ?></h4>
                                <a href="/admin/product-variants" class="btn btn-secondary">Quay lại</a>
                            </div>
                            <div class="card-body">
                                <form action="/admin/variant-options/store-option/<?= $data['variant']['id'] ?>" method="POST">
                                    <input type="hidden" name="method" value="POST">
                                    <div class="form-group">
                                        <label for="name">Tên tùy chọn</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Thêm tùy chọn</button>
                                </form>

                                <hr>

                                <h5>Danh sách tùy chọn</h5>
                                <?php if (!empty($data['options'])): ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên tùy chọn</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['options'] as $option): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($option['id']) ?></td>
                                                    <td><?= htmlspecialchars($option['name']) ?></td>
                                                    <td>
                                                        <a href="/admin/variant-options/edit/<?= htmlspecialchars($option['id']) ?>" class="btn btn-warning btn-sm">Sửa</a>
                                                        <form action="/admin/variant-options/delete/<?= $option['id'] ?>" method="POST" style="display:inline-block;">
                                                            <input type="hidden" name="method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger btn-sm" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tùy chọn này không?')">Xóa</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Không có tùy chọn nào.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
