<?php

namespace App\Views\Admin\Pages\ProductVariants;

use App\Views\BaseView;

class ListVariants extends BaseView
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
                                <h4>Danh sách biến thể</h4>
                                <a href="/admin/create-variants" class="btn btn-primary">Thêm biến thể</a>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($data['variants'])): ?>
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID Biến Thể</th>
                                                <th>Tên Biến Thể</th>
                                                <th>Tùy Chọn</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['variants'] as $variant): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($variant['variant_id']) ?></td>
                                                    <td><?= htmlspecialchars($variant['variant_name']) ?></td>
                                                    <td>
                                                        <?php
                                                        // Kiểm tra nếu dữ liệu là chuỗi thông thường hoặc JSON
                                                        $optionsRaw = $variant['options'] ?? ''; // Lấy dữ liệu gốc
                                                        $options = json_decode($optionsRaw, true); // Cố gắng giải mã JSON

                                                        if (is_array($options) && !empty($options)): ?>
                                                            <ul>
                                                                <?php foreach ($options as $option): ?>
                                                                    <li><?= htmlspecialchars($option) ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php elseif (!empty($optionsRaw)): ?>
                                                            <!-- Nếu không phải JSON nhưng có dữ liệu, tách chuỗi -->
                                                            <ul>
                                                                <?php foreach (explode(',', $variant['options']) as $option): ?>
                                                                    <li><?= htmlspecialchars(trim($option)) ?></li>
                                                                <?php endforeach; ?>

                                                            </ul>
                                                        <?php else: ?>
                                                            Không có tùy chọn
                                                        <?php endif; ?>

                                                        <!-- Thêm link Thêm tùy chọn -->
                                                        <a href="/admin/variant-options/<?= htmlspecialchars($variant['variant_id']) ?>">Cấu hình tùy chọn sản phẩm</a>


                                                    </td>


                                                    <td>
                                                        <a href="/admin/edit-variants/<?= $variant['variant_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                                        <form action="/admin/delete-variants/<?= $variant['variant_id'] ?>" method="POST" style="display:inline-block;">
                                                            <input type="hidden" name="method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $variant['variant_id'] ?>)">Xóa</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Không có biến thể nào được tìm thấy.</p>
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
