<?php

namespace App\Views\Admin\Pages\Product;

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
                  <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
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
                <!-- <h5 class="card-title mb-0">Static Table With Checkboxes</h5> -->
                <div class="card-filter d-flex" style="gap: 16px;">
                  <div class="btn-group ">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" fdprocessedid="g0r54q">
                      Lọc
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Màu sắc</a>
                      <a class="dropdown-item" href="#">Kích thước lớn</a>
                      <a class="dropdown-item" href="#">Kích thước nhỏ</a>
                      <a class="dropdown-item" href="#">Trạng thái còn hàng</a>  
                      <a class="dropdown-item" href="#">Trạng thái hết hàng</a> 
                    </div>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" fdprocessedid="g0r54q">
                      Sắp xếp
                    </button>
                    <div class="dropdown-menu"> 
                      <a class="dropdown-item" href="#">Số lượng</a>
                      <a class="dropdown-item" href="#">Giá từ cao đến thấp</a>
                      <a class="dropdown-item" href="#">Giá dịch từ thấp đến cao</a>
                      <a class="dropdown-item" href="#">Ngày tạo</a> 
                    </div>
                  </div>
                  <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm mã sản phẩm" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                  </form>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th>
                        <label class="customcheckbox mb-3">
                          <input type="checkbox" id="mainCheckbox">
                          <span class="checkmark"></span>
                        </label>
                      </th>
                      <th>#</th>
                      <th scope="col">Tên sản phẩm</th>
                      <th scope="col">Ảnh</th>
                      <th scope="col">Ngày nhập</th>
                      <th scope="col">Số lượng</th>
                      <th scope="col">Xuất sứ</th>
                      <th scope="col">Giá</th>
                      <th scope="col">Trạng thái</th>
                      <th scope="col">Tuỳ chỉnh</th>

                    </tr>
                  </thead>
                  <tbody class="customtable">
                    <tr>
                      <th>
                        <label class="customcheckbox">
                          <input type="checkbox" class="listCheckbox">
                          <span class="checkmark"></span>
                        </label>
                      </th>
                      <td>1</td>
                      <td><a href="">Cam Vàng</a></td>
                      <td><img src="https://media.loveitopcdn.com/1254/thumb/cam-vang-my-moi-2.jpg" alt="" width="40px"></td>
                      <td>30-01-2020</td>
                      <td>4</td>
                      <td>Hoa kỳ</td>
                      <td>50.000</td>
                      <td><p class="badge bg-success">Còn hàng</p></td>
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