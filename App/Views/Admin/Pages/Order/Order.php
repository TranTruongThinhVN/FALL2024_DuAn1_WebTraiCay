<?php

namespace App\Views\Admin\Pages\Order;

use App\Views\BaseView;

class Order extends BaseView
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
            <h4 class="page-title">Danh sách đơn hàng</h4>
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
                      <a class="dropdown-item" href="#">Trạng thái giao thành công</a>  
                      <a class="dropdown-item" href="#">Trạng thái đang xử lí</a> 
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
                      <a class="dropdown-item" href="#">Ngày đặt</a> 
                    </div>
                  </div>
                  <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm mã đơn hàng" aria-label="Search">
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
                      <th scope="col">Mã đơn hàng</th>
                      <th scope="col">Người mua hàng</th>
                      <th>Số điện thoại</th>
                      <th>Địa chỉ</th>
                      <th scope="col">Ngày đặt</th>
                      <th scope="col">Số lượng</th>
                      <th scope="col">Tổng tiền</th> 
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
                      <td><a href="">pceewq2</a></td>
                      <td>Thanh</td>
                      <td>123456677</td>
                      <td>Cần thơ</td>
                      <td>30-01-2020</td>
                      <td>4</td> 
                      <td>50.000</td>
                      <td><p class="badge bg-warning">Đang xử lí</p></td>
                      <td>
                        <div>
                        <a class="badge bg-success" href="">Chỉnh sửa</a>
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
      </div>
    </div>
<?php

    }
}

?>