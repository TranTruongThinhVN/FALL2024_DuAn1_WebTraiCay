<?php

namespace App\Views\Admin\Pages\Order;

use App\Views\BaseView;

class Index extends BaseView
{
  public static function render($data = null, $currentPage = 1, $totalPages = 1)
  {
?>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Danh sách đơn hàng</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
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
                <div class="card-filter d-flex" style="gap: 16px;">
                  <!-- Bộ lọc -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Lọc
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Trạng thái: Đang xử lý</a>
                      <a class="dropdown-item" href="#">Trạng thái: Hoàn thành</a>
                      <a class="dropdown-item" href="#">Trạng thái: Đã hủy</a>
                    </div>
                  </div>
                  <!-- Sắp xếp -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Sắp xếp
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Giá: Cao đến thấp</a>
                      <a class="dropdown-item" href="#">Giá: Thấp đến cao</a>
                      <a class="dropdown-item" href="#">Ngày đặt: Mới nhất</a>
                    </div>
                  </div>
                  <!-- Tìm kiếm -->
                  <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm mã đơn hàng" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                  </form>
                </div>
              </div>
              <!-- Bảng danh sách đơn hàng -->
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <!-- <th>#</th> -->
                      <th>Code</th>
                      <!-- <th>Order Date</th> -->
                      <th>Total Price</th>
                      <th>Name</th>
                      <!-- <th>Address</th> -->
                      <th>Phone</th>
                      <th>Order Status</th>
                      <th>Payment Method</th>
                      <th>Shipping Method</th>
                      <th>Payment Status</th>
                      <!-- <th>User ID</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($data)) : ?>
                      <?php foreach ($data as $index => $row) : ?>
                        <tr>
                          <!-- <td><?= $index + 1 ?></td> -->
                          <td><?= $row['id'] ?></td>
                          <!-- <td><?= $row['order_date'] ?></td> -->
                          <td><?= number_format($row['total_price'], 2) ?> VNĐ</td>
                          <td><?= $row['name'] ?></td>
                          <!-- <td><?= $row['address'] ?></td> -->
                          <td><?= $row['phone'] ?></td>
                          <td>
                            <span class="btn 
                              <?= $row['order_status'] == 0 ? 'btn-warning' : ($row['order_status'] == 1 ? 'btn-success' : ($row['order_status'] == 2 ? 'btn-primary' : ($row['order_status'] == 3 ? 'btn-danger' : 'btn-secondary'))) ?>">
                              <?=
                              $row['order_status'] == 0 ? 'Đang xử lý' : ($row['order_status'] == 1 ? 'Hoàn thành' : ($row['order_status'] == 2 ? 'Đã hoàn tiền' : ($row['order_status'] == 3 ? 'Đã hủy' : 'Unknown Status')))
                              ?>
                            </span>
                          </td>
                          <td><?= $row['payment_method'] ?></td>
                          <td><?= $row['shipping_method'] ?></td>
                          <td><?= $row['payment_status'] == 0 ? 'Đã thanh toán' : 'Chưa thanh toán' ?></td>
                          <!-- <td><?= $row['user_id'] ?></td> -->
                          <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailModal<?= $row['id'] ?>">
                              Xem chi tiết
                            </button>
                          </td>
                        </tr>
                        <!-- Modal Chi tiết Đơn hàng -->
                        <div class="modal fade" id="orderDetailModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="orderDetailLabel<?= $row['id'] ?>" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="orderDetailLabel<?= $row['id'] ?>">Chi tiết đơn hàng #<?= $row['id'] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <p><strong>Tên khách hàng:</strong> <?= $row['name'] ?></p>
                                <p><strong>Địa chỉ:</strong> <?= $row['address'] ?></p>
                                <p><strong>Số điện thoại:</strong> <?= $row['phone'] ?></p>
                                <p><strong>Ngày đặt hàng:</strong> <?= $row['order_date'] ?></p>
                                <p><strong>Trạng thái:</strong>
                                  <span class="btn 
                                    <?= $row['order_status'] == 0 ? 'btn-warning' : ($row['order_status'] == 1 ? 'btn-success' : ($row['order_status'] == 2 ? 'btn-primary' : ($row['order_status'] == 3 ? 'btn-danger' : 'btn-secondary'))) ?>">
                                    <?=
                                    $row['order_status'] == 0 ? 'Đang xử lý' : ($row['order_status'] == 1 ? 'Hoàn thành' : ($row['order_status'] == 2 ? 'Đã hoàn tiền' : ($row['order_status'] == 3 ? 'Đã hủy' : 'Unknown Status')))
                                    ?>
                                  </span>
                                </p>
                                <p><strong>Phương thức thanh toán:</strong> <?= $row['payment_method'] ?></p>
                                <p><strong>Giao hàng:</strong> <?= $row['shipping_method'] ?></p>
                                <p><strong>Trạng thái thanh toán:</strong> <?= $row['payment_status'] == 0 ? 'Đã thanh toán' : 'Chưa thanh toán' ?></p>
                                <hr>
                                <h6>Danh sách sản phẩm</h6>
                                <ul>
                                  <li>Sản phẩm 1 - 2 x 100,000 VNĐ</li>
                                  <li>Sản phẩm 2 - 1 x 50,000 VNĐ</li>
                                  <li>Sản phẩm 3 - 3 x 200,000 VNĐ</li>
                                </ul>
                              </div>
                              <div class="modal-footer">
                                <a href="/admin/orders/edit/<?= $row['id'] ?>" class="btn btn-warning">Sửa</a>
                                <form id="deleteForm<?= $row['id'] ?>" method="POST" action="/admin/orders/delete/<?= $row['id'] ?>">
                                  <input type="hidden" name="method" value="DELETE">
                                  <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                                <button type=" button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Kết thúc Modal -->
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="13" class="text-center">Không có dữ liệu</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <!-- Phân trang -->
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                  <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=1">Đầu</a>
                  </li>
                  <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= $currentPage == $i ? 'active' : '' ?>">
                      <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                  <?php endfor; ?>
                  <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $totalPages ?>">Cuối</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
