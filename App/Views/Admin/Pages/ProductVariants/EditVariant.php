<?php

namespace App\Views\Admin\Pages\ProductVariants;

use App\Views\BaseView;

class EditVariant extends BaseView
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
                                <h4>Sửa biến thể</h4>
                            </div>
                            <div class="card-body">
                                <form action="/admin/update-variants/<?= $data['variant']['id'] ?>" method="POST">
                                    <input type="hidden" name="method" value="PUT">
                                    <div class="form-group">
                                        <label for="name">Tên biến thể</label>
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="form-control"
                                            value="<?= htmlspecialchars($_POST['name'] ?? $data['variant']['name'] ?? '') ?>">
                                        <?php if (isset($_SESSION['errors']['name'])): ?>
                                            <small class="text-danger"><?= $_SESSION['errors']['name'] ?></small>
                                            <?php unset($_SESSION['errors']['name']); ?>
                                        <?php endif; ?>
                                    </div>

                                    <button type="submit" class="btn btn-success mt-3">Lưu</button>
                                    <a href="/admin/product-variants" class="btn btn-secondary mt-3">Quay lại</a>
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
