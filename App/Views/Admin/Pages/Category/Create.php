<?php

namespace App\Views\Admin\Pages\Category;

use App\Views\BaseView;

class Create extends BaseView
{
    public static function render($data = null)
    {
?>

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
                            <form class="form-horizontal" action="/admin/add-category" method="POST">
                                <div class="card-body">
                                    <h4 class="card-title">Thêm sản phẩm</h4>
                                    <input type="hidden" name="method" value="POST">

                                    <div class="form-group">
                                        <label for="name">Tên danh mục</label>
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Tên danh mục...">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Trạng thái</label>
                                        <select class="select2 form-select shadow-none" style="width: 100%; height:36px;" id="status" name="status">
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1">Hiện</option>
                                            <option value="0">Ẩn</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" id="success-btn" class="btn btn-success">
                                            Thêm
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            Làm lại
                                        </button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thêm CKEditor và SweetAlert -->
        <script src="<?= APP_URL ?>/public/assets/admin/js/categoryValidation.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
        <script>
            // Kích hoạt CKEditor
            CKEDITOR.replace('description');
        </script>

<?php
    }
}
