<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Product extends BaseView
{
  public static function render($data = null)
  {

?>
    <!-- partial -->

    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" style="padding: 0px;">
              <h4 class="card-title">Hoverable Table</h4>
              <div class="card-search">
                <div class="nav-search d-flex justify-content-space-between">
                  <a href="./basic_elements.html" class="btn btn-success">Thêm sản phẩm</a>
                  <div class="nav-filter d-flex mr-3">
                    <div class="dropdown">
                      <button type="button" class="btn btn-success dropdown-toggle mx-sm-2"
                        id="dropdownMenuIconButton4" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Lọc sản phẩm
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton4">
                        <!-- <h6 class="dropdown-header">Danh mục</h6> -->
                        <a class="dropdown-item" href="#">Tên sản phẩm</a>
                        <a class="dropdown-item" href="#">Danh mục</a>
                        <a class="dropdown-item" href="#">Xuất sứ</a>
                        <a class="dropdown-item" href="#">Giá dưới 100.000</a>
                        <a class="dropdown-item" href="#">Giá từ 100.000 đến 200.000</a>
                        <a class="dropdown-item" href="#">Giá từ 200.000 đến 500.000</a>
                        <a class="dropdown-item" href="#">Giá từ 500.000</a>
                      </div>
                    </div>
                    <div class="dropdown">
                      <button type="button" class="btn btn-success dropdown-toggle" id="dropdownMenuIconButton4"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sắp xếp theo
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton4">
                        <!-- <h6 class="dropdown-header">Danh mục</h6> -->
                        <a class="dropdown-item" href="#">Giá cao đến thấp</a>
                        <a class="dropdown-item" href="#">Giá thấp đến cao</a>
                        <a class="dropdown-item" href="#">Số lượng đã bán</a>
                        <a class="dropdown-item" href="#">Số lượng tồn kho</a>
                        <a class="dropdown-item" href="#">Được đánh giá cao</a>
                        <a class="dropdown-item" href="#">Ngày tạo</a>
                        <a class="dropdown-item" href="#">Ngày cập nhật</a>
                      </div>
                    </div>
                  </div>

                  <div class=" col-sm-4 input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="search"
                      aria-describedby="search">
                    <div class="input-group-append">
                      <span class="input-group-text" id="search">
                        <i class="typcn typcn-zoom"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead style="text-align: center; vertical-align: middle;">
                    <tr>
                      <th>
                        <div class="form-check form-check-danger" style="margin-bottom: -4px !important; text-align: left;">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" checked="">
                            Chọn tất cả
                            <i class="input-helper"></i></label>
                        </div>
                      </th>
                      <th>Mã sản phẩm</th>
                      <th>Ảnh</th>
                      <th>Tên sản phẩm</th>
                      <th>Ngày nhập</th>
                      <th>Giá (đơn vị Kg)</th>
                      <th>Đã bán (đơn vị Kg)</th>
                      <th>Tồn kho (đơn vị Kg)</th>
                      <th>Danh mục</th>
                      <th>Trạng thái</th>
                      <th>Tùy chỉnh</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="text-align: center; vertical-align: middle;">
                      <td>
                        <div class="form-group " style="text-align: left ">
                          <div class="form-check form-check-danger">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">

                              <i class="input-helper"></i></label>
                          </div>
                      </td>
                      <td>2324</td>
                      <td style="padding: 0 !important;">
                        <img src="https://nongsandungha.com/wp-content/uploads/2024/08/cam-vang-uc-dung-ha.jpg"
                          style="border-radius: 0%; width: 60px !important; height: auto; ">
                      </td>
                      <td>Cam vàng châu mỹ</td>
                      <td>20/12/2024</td>
                      <td>695.000</td>
                      <td>454</td>
                      <td>45</td>
                      <td>Trái cây nhập khẩu</td>
                      <td><label class="badge badge-success">Còn hàng</label></td>
                      <td>
                        <label class="badge badge-warning">Chỉnh sửa</label>
                        <label class="badge badge-danger">Xóa</label>
                      </td>
                    </tr>
                    <tr style="text-align: center; vertical-align: middle;">
                      <td>
                        <div class="form-group" style="text-align: left ">
                          <div class="form-check form-check-danger">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">

                              <i class="input-helper"></i></label>
                          </div>
                      </td>
                      <td>4324</td>
                      <td style="">
                        <img src="https://dalatfarm.net/wp-content/uploads/2021/10/bo-booth-da-lat.jpg"
                          style="border-radius: 0%; width: 60px !important; height: auto; ">
                      </td>
                      <td>Bơ Đà Lạt</td>
                      <td>20/12/2024</td>
                      <td>100.000</td>
                      <td>894</td>
                      <td>453</td>
                      <td>Bơ</td>
                      <td><label class="badge badge-success">Còn hàng</label></td>
                      <td>
                        <label class="badge badge-warning">Chỉnh sửa</label>
                        <label class="badge badge-danger">Xóa</label>
                      </td>
                    </tr>
                    <tr style="text-align: center; vertical-align: middle;">
                      <td>
                        <div class="form-group" style="text-align: left ">
                          <div class="form-check form-check-danger">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                              <i class="input-helper"></i></label>
                          </div>
                      </td>
                      <td>2344</td>
                      <td style="padding: 0 !important;">
                        <img src="https://media.loveitopcdn.com/31293/dau-tay-2.jpg"
                          style="border-radius: 0%; width: 60px !important; height: auto; ">
                      </td>
                      <td>Dâu tây Đà Lạt</td>
                      <td>20/12/2024</td>
                      <td>300.000</td>
                      <td>170</td>
                      <td>0</td>
                      <td>Dâu tây</td>
                      <td><label class="badge badge-danger">Hết hàng</label></td>
                      <td>
                        <label class="badge badge-warning">Chỉnh sửa</label>
                        <label class="badge badge-danger">Xóa</label>
                      </td>
                    </tr>
                  </tbody>

                </table>
                <div class="navigation-page" style="display: flex; justify-content: center; margin: 14px; ">
                  <div class="btn-group  d-flex" role="group" aria-label="Basic example" style="gap: 10px;">
                    <a href="" type="button" class="btn btn-primary">Trang trước</a>
                    <a href="" type="button" class="btn btn-primary">1</a>
                    <a href="" type="button" class="btn btn-primary">2</a>
                    <a href="" type="button" class="btn btn-primary">3</a>
                    <a href="" type="button" class="btn btn-primary">Trang sau</a>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Thống kê lượt bán</h4>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>
                        Mã sản phẩm
                      </th>
                      <th>
                        Ảnh
                      </th>
                      <th>
                        Tên
                      </th>
                      <th>
                        Giá
                      </th>
                      <th>
                        Đã bán
                      </th>
                      <th>
                        Tỷ lệ tăng trưởng
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="py-1">
                        <img src="../../images/faces/face1.jpg" alt="image" />
                      </td>
                      <td>
                        Herman Beck
                      </td>
                      <td>
                        Cam vàng châu mỹ
                      </td>
                      <td>
                        $ 77.99
                      </td>
                      <td>
                        May 15, 2015
                      </td>
                      <td class="col-3">
                        <div class="progress d-flex align-items-center justify-content-space-between mx-2 text-center" style="height: auto !important; gap: 6px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 80%; height: 8px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          <p class="mb-0 ms-2 d-flex text-success" style="font-size: 12px;">28.76% <i class="typcn typcn-arrow-sorted-up"></i></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="py-1">
                        <img src="../../images/faces/face1.jpg" alt="image" />
                      </td>
                      <td>
                        Herman Beck
                      </td>
                      <td>
                        Cam vàng châu mỹ
                      </td>
                      <td>
                        $ 77.99
                      </td>
                      <td>
                        May 15, 2015
                      </td>
                      <td class="col-3">
                        <div class="progress d-flex align-items-center justify-content-space-between mx-2 text-center" style="height: auto !important; gap: 6px;">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 60%; height: 8px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          <p class="mb-0 ms-2 d-flex text-warning" style="font-size: 12px;">28.76% <i class="typcn typcn-arrow-sorted-down"></i></p>
                        </div>
                      </td>
                    <tr>
                      <td class="py-1">
                        <img src="../../images/faces/face1.jpg" alt="image" />
                      </td>
                      <td>
                        Herman Beck
                      </td>
                      <td>
                        Cam vàng châu mỹ
                      </td>
                      <td>
                        $ 77.99
                      </td>
                      <td>
                        May 15, 2015
                      </td>
                      <td class="col-3">
                        <div class="progress d-flex align-items-center justify-content-space-between mx-2 text-center" style="height: auto !important; gap: 6px;">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 18%; height: 8px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          <p class="mb-0 ms-2 d-flex text-danger" style="font-size: 12px;">18.76% <i class="typcn typcn-arrow-sorted-down"></i></p>
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
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © <a
            href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com</a> 2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Free <a
            href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard </a>templates from
          Bootstrapdash.com</span>
      </div>
    </footer>
<?php

  }
}

?>