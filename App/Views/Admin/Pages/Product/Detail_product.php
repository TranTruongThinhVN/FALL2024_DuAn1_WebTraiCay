<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Detail_product extends BaseView
{
    public static function render($data = null)
    {
        $product = $data['product'];
?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Chi tiết sản phẩm</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/products">Sản phẩm</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center"><?= $product['name'] ?></h4>

                                <!-- Hình ảnh sản phẩm -->
                                <div class="text-center mb-4">
                                    <img src="/public/uploads/products/<?= htmlspecialchars($product['image']) ?>" alt="Hình ảnh chính" style="max-width: 300px; object-fit: cover; height: 300px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                </div>

                                <!-- Thumbnail -->
                                <div class="text-center d-flex justify-content-center">
                                    <?php
                                    $thumbnails = json_decode($product['thumbnails'], true);

                                    if (is_array($thumbnails) && !empty($thumbnails)) {
                                        foreach ($thumbnails as $thumbnail) { ?>
                                            <div style="margin: 5px;">
                                                <img src="/public/uploads/thumbnails/<?= htmlspecialchars($thumbnail, ENT_QUOTES) ?>" alt="Thumbnail" style="width: 80px; height: 80px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                            </div>
                                        <?php }
                                    } else { ?>
                                        <p>Không có ảnh thumbnails nào.</p>
                                    <?php } ?>

                                </div>


                                <!-- Thông tin sản phẩm -->
                                <div class="form-group mt-4">
                                    <label>Danh mục:</label>
                                    <p><?= $product['category_name'] ?? 'Không xác định' ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Giá:</label>
                                    <p><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</p>
                                </div>
                                <div class="form-group">
                                    <label>Giá giảm:</label>
                                    <p><?= number_format($product['discount_price'], 0, ',', '.') ?> VNĐ</p>
                                </div>
                                <div class="form-group">
                                    <label>Nổi bật:</label>
                                    <p><?= $product['is_featured'] == '1' ? 'Có' : 'Không' ?></p>
                                </div>

                                <div class="form-group">
                                    <label>Trạng thái:</label>
                                    <p><?= $product['status'] == 1 ? 'Hiện' : 'Ẩn' ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả:</label>
                                    <p><?= $product['description'] ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Số lượng:</label>
                                    <p><?= $product['quantity'] ?></p>
                                </div>
                                <div class="form-group">
                                    <a href="/admin/product" class="btn btn-primary">Quay lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
