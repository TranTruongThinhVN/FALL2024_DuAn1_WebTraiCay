<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Create extends BaseView
{
    public static function render($data = null)
    {
?>

        <body>
            <div class="page-wrapper">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-12 d-flex no-block align-items-center">
                            <h4 class="page-title">QUẢN LÝ THÊM NGƯỜI DÙNG</h4>
                            <div class="ms-auto text-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Thêm người dùng</li>
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
                                <form class="form-horizontal" action="/admin/user-create" method="POST" enctype="multipart/form-data" id="registerForm">
                                    <div class="card-body">
                                        <h4 class="card-title">Thêm người dùng</h4>
                                        <input type="hidden" name="method" value="POST">

                                        <div class="form-group">
                                            <label for="email">Email*</label>
                                            <input type="email" class="form-control" id="email" placeholder="Nhập email..." name="email">
                                            <span id="emailError" style="color: red; font-size: 12px; display: none; margin-top:5px">Email không được để trống.</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Mật khẩu*</label>
                                            <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu..." name="password">
                                            <span id="passwordError" style="color: red; font-size: 12px; display: none;margin-top:5px">Mật khẩu không được để trống.</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="avatar">Ảnh đại diện</label>
                                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                                        </div>

                                        <div class="form-group">
                                            <label for="role">Vai trò*</label>
                                            <select class="form-control" id="role" name="role" required>
                                                <option value="1">Người dùng</option>
                                                <option value="0">Quản trị viên</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại..." name="phone">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Tên người dùng</label>
                                            <input type="text" class="form-control" id="name" placeholder="Nhập tên người dùng..." name="name">
                                        </div>

                                        <div class="form-group">
                                            <label>Giới tính</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" checked>
                                                <label class="form-check-label" for="genderMale">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                                                <label class="form-check-label" for="genderFemale">Nữ</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="genderOther" value="other">
                                                <label class="form-check-label" for="genderOther">Khác</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="dob">Ngày sinh</label>
                                            <input type="date" class="form-control" id="dob" name="dob">
                                        </div>


                                        <div class="form-group">
                                            <label for="status">Trạng thái</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Hoạt động</option>
                                                <option value="0">Vô hiệu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="reset" class="btn btn-danger text-white">Làm lại</button>
                                            <button type="submit" class="btn btn-primary">Thêm</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script
                src="<?= APP_URL ?>/public/assets/admin/js/UserValidation.js">
            </script>
        </body>
<?php
    }
}
