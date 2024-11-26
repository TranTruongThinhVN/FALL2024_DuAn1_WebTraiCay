<?php

namespace App\Views\Admin\Pages\Discount;

use App\Views\BaseView;

class Edit_discount extends BaseView
{
    public static function render($data = null)
    {
        $discount = $data['discount'];
        $old = $_SESSION['old'] ?? [];

        $discount_type = $old['discount_type'] ?? $discount['discount_type'];

        if ($discount_type == 1) {
            $discount_value_display = intval($old['discount_value'] ?? $discount['discount_value']) . '%';
        } else {
            $discount_value_display = number_format($old['discount_value'] ?? $discount['discount_value'], 0, ',', '.') . ' VNĐ';
        }

        $min_order_value_display = number_format($old['min_order_value'] ?? $discount['min_order_value'], 0, ',', '.') . ' VNĐ';

        $start_date = isset($old['start_date']) ? date('Y-m-d\TH:i', strtotime($old['start_date'])) : date('Y-m-d\TH:i', strtotime($discount['start_date']));
        $end_date = isset($old['end_date']) ? date('Y-m-d\TH:i', strtotime($old['end_date'])) : date('Y-m-d\TH:i', strtotime($discount['end_date']));
?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="/admin/edit-discount/<?= htmlspecialchars($discount['id']) ?>" method="POST" class="form-horizontal">
                                <input type="hidden" name="method" value="PUT">
                                <div class="card-body">
                                    <h4 class="card-title">Sửa Mã Giảm Giá</h4>

                                    <div class="form-group row">
                                        <label for="code" class="col-sm-3 text-end control-label col-form-label">Mã giảm giá</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control <?= isset($_SESSION['errors']['code']) ? 'is-invalid' : '' ?>" id="code" name="code" value="<?= htmlspecialchars($old['code'] ?? $discount['code']) ?>" required>
                                            <?php if (isset($_SESSION['errors']['code'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['code']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 text-end control-label col-form-label">Mô tả</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control <?= isset($_SESSION['errors']['description']) ? 'is-invalid' : '' ?>" id="description" name="description"><?= htmlspecialchars($old['description'] ?? $discount['description']) ?></textarea>
                                            <?php if (isset($_SESSION['errors']['description'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['description']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="discount_type" class="col-sm-3 text-end control-label col-form-label">Loại giảm giá</label>
                                        <div class="col-sm-9">
                                            <select class="form-control <?= isset($_SESSION['errors']['discount_type']) ? 'is-invalid' : '' ?>" id="discount_type" name="discount_type">
                                                <option value="1" <?= ($discount_type == 1) ? 'selected' : '' ?>>Giảm theo %</option>
                                                <option value="2" <?= ($discount_type == 2) ? 'selected' : '' ?>>Giảm số tiền</option>
                                            </select>
                                            <?php if (isset($_SESSION['errors']['discount_type'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['discount_type']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="discount_value" class="col-sm-3 text-end control-label col-form-label">Giá trị giảm</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control <?= isset($_SESSION['errors']['discount_value']) ? 'is-invalid' : '' ?>" id="discount_value" name="discount_value" value="<?= htmlspecialchars($discount_value_display) ?>" required>
                                            <?php if (isset($_SESSION['errors']['discount_value'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['discount_value']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="min_order_value" class="col-sm-3 text-end control-label col-form-label">Giá trị đơn tối thiểu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control <?= isset($_SESSION['errors']['min_order_value']) ? 'is-invalid' : '' ?>" id="min_order_value" name="min_order_value" value="<?= htmlspecialchars($min_order_value_display) ?>" required>
                                            <?php if (isset($_SESSION['errors']['min_order_value'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['min_order_value']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="start_date" class="col-sm-3 text-end control-label col-form-label">Ngày bắt đầu</label>
                                        <div class="col-sm-9">
                                            <input type="datetime-local" class="form-control <?= isset($_SESSION['errors']['start_date']) ? 'is-invalid' : '' ?>" id="start_date" name="start_date" value="<?= htmlspecialchars($start_date) ?>" required>
                                            <?php if (isset($_SESSION['errors']['start_date'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['start_date']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="end_date" class="col-sm-3 text-end control-label col-form-label">Ngày kết thúc</label>
                                        <div class="col-sm-9">
                                            <input type="datetime-local" class="form-control <?= isset($_SESSION['errors']['end_date']) ? 'is-invalid' : '' ?>" id="end_date" name="end_date" value="<?= htmlspecialchars($end_date) ?>" required>
                                            <?php if (isset($_SESSION['errors']['end_date'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['end_date']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 text-end control-label col-form-label">Trạng thái</label>
                                        <div class="col-sm-9">
                                            <select class="form-control <?= isset($_SESSION['errors']['status']) ? 'is-invalid' : '' ?>" id="status" name="status">
                                                <option value="1" <?= ($old['status'] ?? $discount['status']) == 1 ? 'selected' : '' ?>>Kích hoạt</option>
                                                <option value="0" <?= ($old['status'] ?? $discount['status']) == 0 ? 'selected' : '' ?>>Ngừng kích hoạt</option>
                                            </select>
                                            <?php if (isset($_SESSION['errors']['status'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['status']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-success">Lưu</button>
                                            <a href="/admin/discounts" class="btn btn-secondary">Quay lại</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<? APP_URL ?>/public/assets/admin/js/DiscountValidations.js"></script>
<?php
        unset($_SESSION['errors'], $_SESSION['old']);
    }
}
?>