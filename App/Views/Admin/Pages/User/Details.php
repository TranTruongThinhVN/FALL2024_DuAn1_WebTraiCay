<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Details extends BaseView
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
            <h4 class="page-title">QUẢN LÝ LOẠI SẢN PHẨM</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Danh sách loại sản phẩm</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div> 
      <div class="container-fluid"> 
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-0">Static Table With Checkboxes</h5>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-light">
                    <tr> 
                      <th scope="col">Tên người dùng</th>
                      <th scope="col">Ảnh</th>
                      <th scope="col">Ngày tạo</th>
                      <th scope="col">Email</th>
                      <th scope="col">Số điện thoại</th> 
                      <th scope="col">Địa chỉ</th>
                      <th scope="col">Vai trò</th> 
                      <th scope="col">Trạng thái</th>
                      <th scope="col">Tuỳ chỉnh</th>
                    </tr>
                  </thead>
                  <tbody class="customtable">
                    <tr> 
                      <td><a href="">Cam Vàng</a></td>
                      <td><img src="https://media.loveitopcdn.com/1254/thumb/cam-vang-my-moi-2.jpg" alt="" width="40px"></td>
                      <td>30-01-2020</td>
                      <td>thanh@gmail.com</td>
                      <td>45656565</td>
                      <td>Hưng Phú, Cái Răng, TP Cần Thơ</td> 
                      <th>Unkown</th>
                      <td><p class="badge bg-danger">Đang bị khoá</p></td>
                      <td>
                        <div>
                        <a class="badge bg-warning" href="">Chỉnh sửa</a>
                        <a class="badge bg-danger" href="">Xoá</a>
                        </div>
                      </td>
                    </tr>  
                  </tbody>
                </table>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-light">
                    <tr> 
                      <th scope="col">Số lần mua hàng</th>
                      <th scope="col">Số lượng đã mua</th> 
                      <th scope="col">Mua thành công</th>
                      <th scope="col">Huỷ đơn</th> 
                    </tr>
                  </thead>
                  <tbody class="customtable">
                    <tr class=""> 
                      <td><p class="badge bg-primary">1</p></td>
                      <td><p class="badge bg-success">334</a></td>
                      <td><p class="badge bg-success">1</p></td>
                      <td><p class="badge bg-danger">0</p></td>
                    </tr>  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
      </div>
    </div>
<?php

  }
}

?>