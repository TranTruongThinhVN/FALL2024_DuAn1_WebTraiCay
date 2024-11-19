<?php

namespace App\Views\Admin\Pages\Category;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
?>
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
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
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
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
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Tên danh mục..." value="<?= $data['name'] ?>">
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

                </div>
            </div>
        </div>
    </div>
<?php
    }
}
