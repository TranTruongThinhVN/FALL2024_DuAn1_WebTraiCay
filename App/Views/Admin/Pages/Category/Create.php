<?php

namespace App\Views\Admin\Pages\Category;

use App\Views\BaseView;

class Create extends BaseView
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
                        <h4 class="page-title">Thêm Danh Mục</h4>
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
                            <form class="form-horizontal" action="/admin/add-category" method="POST">
                                <div class="card-body">
                                    <h4 class="card-title">Thêm danh mục</h4>
                                    <input type="hidden" name="method" value="POST">

                                    <!-- Tên danh mục -->
                                    <div class="form-group">
                                        <label for="name">Tên danh mục</label>
                                        <input
                                            id="name"
                                            name="name"
                                            type="text"
                                            class="form-control <?= isset($_SESSION['errors']['name']) ? 'error-border' : '' ?>"
                                            placeholder="Tên danh mục..."
                                            value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES) : '' ?>">
                                        <?php if (isset($_SESSION['errors']['name'])): ?>
                                            <small class="text-danger"><?= $_SESSION['errors']['name'] ?></small>
                                        <?php endif; ?>
                                    </div>


                                    <!-- Mô tả -->
                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea name="description" id="description" class="form-control" rows="4"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES) : '' ?></textarea>
                                        <?php if (isset($_SESSION['errors']['description'])): ?>
                                            <small class="text-danger"><?= $_SESSION['errors']['description'] ?></small>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Trạng thái -->
                                    <div class="form-group">
                                        <label for="status">Trạng thái</label>
                                        <select class="select2 form-select shadow-none" style="width: 100%; height:36px;" id="status" name="status">
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1" <?= isset($_POST['status']) && $_POST['status'] == '1' ? 'selected' : '' ?>>Hiện</option>
                                            <option value="0" <?= isset($_POST['status']) && $_POST['status'] == '0' ? 'selected' : '' ?>>Ẩn</option>
                                        </select>
                                        <?php if (isset($_SESSION['errors']['status'])): ?>
                                            <small class="text-danger"><?= $_SESSION['errors']['status'] ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <?php unset($_SESSION['errors']); ?>

                                    <!-- Buttons -->
                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" id="success-btn" class="btn btn-success">Thêm</button>
                                            <button type="reset" class="btn btn-danger">Làm lại</button>
                                        </div>
                                    </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thêm CKEditor và SweetAlert -->
        <script src="<?= APP_URL ?>/public/assets/admin/js/categoryValidation.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


<?php
    }
}
?>