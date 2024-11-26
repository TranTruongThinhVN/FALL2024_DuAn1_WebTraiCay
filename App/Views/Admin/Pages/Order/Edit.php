<?php

namespace App\Views\Admin\Pages\Order;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Chỉnh sửa đơn hàng</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item"><a href="/admin/orders">Danh sách đơn hàng</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa</li>
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
                                <h4 class="card-title">Chỉnh sửa đơn hàng #<?= $data['id'] ?></h4>
                                <form action="/admin/orders/update/<?= $data['id'] ?>" method="post">
                                    <input type="hidden" name="method" value="PUT">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên khách hàng</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($data['name'], ENT_QUOTES) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($data['address'], ENT_QUOTES) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($data['phone'], ENT_QUOTES) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="order_status" class="form-label">Trạng thái</label>
                                        <select class="form-control" id="order_status" name="order_status" required>
                                            <option value="0" <?= $data['order_status'] == 0 ? 'selected' : '' ?>>Đang xử lý</option>
                                            <option value="1" <?= $data['order_status'] == 1 ? 'selected' : '' ?>>Hoàn thành</option>
                                            <option value="2" <?= $data['order_status'] == 2 ? 'selected' : '' ?>>Đã hoàn tiền</option>
                                            <option value="3" <?= $data['order_status'] == 3 ? 'selected' : '' ?>>Đã hủy</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                                        <select class="form-control" id="payment_method" name="payment_method" required>
                                            <option value="Momo" <?= $data['payment_method'] == 'Momo' ? 'selected' : '' ?>>Thanh toán MoMo</option>
                                            <option value="COD" <?= $data['payment_method'] == 'COD' ? 'selected' : '' ?>>Thanh toán khi nhận hàng</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="shipping_method" class="form-label">Phương thức giao hàng</label>
                                        <input type="text" class="form-control" id="shipping_method" name="shipping_method" value="<?= htmlspecialchars($data['shipping_method'], ENT_QUOTES) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label">Trạng thái thanh toán</label>
                                        <select class="form-control" id="payment_status" name="payment_status" required>
                                            <option value="0" <?= $data['payment_status'] == 0 ? 'selected' : '' ?>>Đã thanh toán</option>
                                            <option value="1" <?= $data['payment_status'] == 1 ? 'selected' : '' ?>>Chưa thanh toán</option>
                                        </select>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        <a href="/admin/orders" class="btn btn-secondary">Hủy</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
