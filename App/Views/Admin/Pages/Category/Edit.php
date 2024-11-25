<?php

namespace App\Views\Admin\Pages\Category;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
?>
        <style>
            .error-border {
                border: 2px solid red !important;
                border-radius: 4px;
            }

            .text-danger {
                color: red;
                font-size: 1rem;
                font-weight: bold;
            }
        </style>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Form Basic</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Library
                                    </li>
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
                            <form class="form-horizontal" action="/admin/category/<?= $data['id'] ?>" method="POST">
                                <div class="card-body">
                                    <h4 class="card-title">Sửa danh mục</h4>
                                    <input type="hidden" name="method" id="" value="PUT">
                                    <div class="form-group">
                                        <label for="id">ID</label>
                                        <input type="text" class="form-control" id="id" name="id" value="<?= $data['id'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên danh mục</label>
                                        <input
                                            id="name"
                                            name="name"
                                            type="text"
                                            class="form-control <?= isset($_SESSION['errors']['name']) ? 'error-border' : '' ?>"
                                            placeholder="Tên danh mục..."
                                            value="<?= htmlspecialchars($data['name'], ENT_QUOTES) ?>">
                                        <?php if (isset($_SESSION['errors']['name'])): ?>
                                            <small class="text-danger"><?= $_SESSION['errors']['name'] ?></small>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea name="description" id="description" class="form-control" rows="4"><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Trạng thái*</label>
                                        <select class="select2 form-select shadow-none" style="width: 100%; height:36px;" id="status" name="status" required>
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1" <?= ($data['status'] == 1 ? 'selected' : '') ?>>Hiển thị</option>
                                            <option value="0" <?= ($data['status'] == 0 ? 'selected' : '') ?>>Ẩn</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">
                                            Cập nhật
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            Làm lại
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Include the external JavaScript file -->
                        <script src="<?= APP_URL ?>/public/assets/admin/js/categoryValidation.js"></script>
                        <!-- CKEditor Integration -->
                        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#description'), {
                                    toolbar: [
                                        'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                                        'blockQuote', 'undo', 'redo'
                                    ],
                                    ckfinder: {
                                        uploadUrl: '/admin/upload-category-image'
                                    }
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
