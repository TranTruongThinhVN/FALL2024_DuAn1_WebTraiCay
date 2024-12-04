<?php

namespace App\Views\Admin\Pages\ProductVariantOption;

use App\Views\BaseView;

class EditOption extends BaseView
{
    public static function render($data = null)
    {
?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Sửa Tùy Chọn</h4>
                            </div>
                            <div class="card-body">
                                <form action="/admin/variant-options/update/<?= $data['option']['id'] ?>" method="POST">
                                    <input type="hidden" name="method" value="PUT">
                                    <div class="form-group">
                                        <label for="name">Tên Tùy Chọn</label>
                                        <input type="text" name="name" id="name" value="<?= htmlspecialchars($data['option']['name']) ?>" class="form-control" required>
                                    </div>
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
