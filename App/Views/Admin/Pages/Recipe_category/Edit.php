<?php

namespace App\Views\Admin\Pages\Recipe_category;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
?>
        <style>
            .error-border {
                border: 2px solid red;
                border-radius: 4px;
            }

            .text-danger {
                color: red;
                font-weight: bold;
            }
        </style>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Sửa Danh Mục Công Thức</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item"><a href="/admin/recipe_category">Danh mục công thức</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sửa danh mục</li>
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
                            <form class="form-horizontal" action="/admin/recipe_category/<?= $data['id'] ?>" method="POST">
                                <div class="card-body">
                                    <h4 class="card-title">Chỉnh sửa danh mục công thức</h4>
                                    <input type="hidden" name="method" value="PUT">

                                    <div class="form-group">
                                        <label for="name">Tên danh mục</label>
                                        <input
                                            id="name"
                                            name="name"
                                            type="text"
                                            class="form-control <?= isset($_SESSION['errors']['name']) ? 'error-border' : '' ?>"
                                            placeholder="Nhập tên danh mục..."
                                            value="<?= htmlspecialchars($data['name'], ENT_QUOTES) ?>">
                                        <?php if (isset($_SESSION['errors']['name'])): ?>
                                            <small class="text-danger"><?= $_SESSION['errors']['name'] ?></small>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea name="description" id="description" class="form-control" rows="4"><?= htmlspecialchars($data['description'], ENT_QUOTES) ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Trạng thái</label>
                                        <select class="form-control <?= isset($_SESSION['errors']['status']) ? 'error-border' : '' ?>" id="status" name="status" required>
                                            <option value="1" <?= ($data['status'] == 1 ? 'selected' : '') ?>>Hiện</option>
                                            <option value="0" <?= ($data['status'] == 0 ? 'selected' : '') ?>>Ẩn</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                        <a href="/admin/recipe_category" class="btn btn-secondary">Hủy</a>
                                    </div>
                                </div>
                            </form>

                            <?php unset($_SESSION['errors']); ?>

                        </div>

                        <!-- CKEditor -->
                        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
                        <script src="<?= APP_URL ?>/public/assets/admin/js/Recipe_categoryValidation.js"></script>

                        <script>
                            ClassicEditor
                                .create(document.querySelector('#description'), {
                                    toolbar: [
                                        'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                                        'blockQuote', 'undo', 'redo'
                                    ]
                                })
                                .catch(error => {
                                    console.error('CKEditor Error:', error);
                                });
                        </script>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
