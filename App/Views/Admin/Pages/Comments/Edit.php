<?php

namespace App\Views\Admin\Pages\Comments;

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
                            <form class="form-horizontal" action="/comments/update/<?= $data['id'] ?>" method="POST">
                                <input type="hidden" name="method" value="PUT">
                                <input type="hidden" name="product_id" value="<?= $data['product_id'] ?>">
                                <div class="card-body">
                                    <h4 class="card-title">Chỉnh sửa bình luận</h4>
                                    <div class="form-group row">
                                        <label for="id" class="col-sm-3 text-end control-label col-form-label">Id bình luận</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="id" value="<?= $data['id'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product_name" class="col-sm-3 text-end control-label col-form-label">Sản phẩm</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="product_name" value="<?= $data['product_name'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="content" class="col-sm-3 text-end control-label col-form-label">Nội dung</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="content" name="content" rows="4"><?= $data['content'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 text-end control-label col-form-label">Trạng thái:</label>
                                        <div class="col-sm-9 d-flex align-items-center" style="gap: 14px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status" value="1" <?= ($data['status'] == 1 ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="status1">Hiển thị</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status" value="0" <?= ($data['status'] == 0 ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="status0">Ẩn</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-end control-label col-form-label">File Upload</label>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="images[]" id="image-input" multiple>
                                                <ul id="image-list"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                        <button type="reset" class="btn btn-danger">Làm lại</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let selectedFiles = []; // Mảng để lưu trữ tất cả các ảnh đã chọn

            document.getElementById("image-input").addEventListener("change", function(event) {
                let files = event.target.files; // Lấy tất cả các tệp được chọn

                // Duyệt qua các tệp đã chọn và thêm vào mảng selectedFiles
                for (let i = 0; i < files.length; i++) {
                    selectedFiles.push(files[i]); // Thêm tệp vào mảng
                }

                // Hiển thị các ảnh đã chọn trong danh sách
                updateImageList();
            });

            function updateImageList() {
                let imageList = document.getElementById("image-list");
                imageList.innerHTML = ''; // Xóa danh sách hiện tại

                // Duyệt qua tất cả các ảnh đã chọn và hiển thị tên
                selectedFiles.forEach((file, index) => {
                    let listItem = document.createElement("li");
                    listItem.textContent = file.name; // Hiển thị tên tệp
                    imageList.appendChild(listItem);
                }); 
                
            }
        </script>
<?php

    }
}

?>