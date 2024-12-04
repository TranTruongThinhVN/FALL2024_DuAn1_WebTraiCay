<?php

namespace App\Views\Admin\Pages\ProductVariantOption;

use App\Views\BaseView;

class CreateOption extends BaseView
{
    public static function render($data = null)
    {
        var_dump($data['variant']);
?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Thêm Tùy Chọn</h4>
                            </div>
                            <div class="card-body">
                                <form action="/admin/variant-options/store-option/<?= $data['variant']['id'] ?>" method="POST">
                                    <input type="hidden" name="method" id="" value="POST">
                                    <div class="form-group">
                                        <label for="name">Tên Tùy Chọn</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                    <input type="hidden" name="variant_id" value="<?= $data['variant']['id'] ?>">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="/admin/variants" class="btn btn-secondary">Quay lại</a>
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
