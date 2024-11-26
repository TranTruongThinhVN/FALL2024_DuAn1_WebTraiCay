<?php

namespace App\Views\Admin\Pages\Discount;

use App\Views\BaseView;

class Create extends BaseView
{
    public static function render($data = null)
    {


?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="#" method="POST" class="form-horizontal">
                                <input type="hidden" name="method" value="POST">
                                <div class="card-body">
                                    <h4 class="card-title">Thêm Mã Giảm Giá</h4>

                                    <!-- Mã giảm giá -->
                                    <div class="form-group row">
                                        <label for="code" class="col-sm-3 text-end control-label col-form-label">Mã giảm giá</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control <?= isset($_SESSION['errors']['code']) ? 'is-invalid' : '' ?>" id="code" name="code" value="<?= htmlspecialchars($_SESSION['old']['code'] ?? $discount['code'] ?? '') ?>">
                                            <?php if (isset($_SESSION['errors']['code'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['code']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Mô tả -->
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 text-end control-label col-form-label">Mô tả</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control <?= isset($_SESSION['errors']['description']) ? 'is-invalid' : '' ?>" id="description" name="description"><?= htmlspecialchars($_SESSION['old']['description'] ?? '') ?></textarea>
                                            <?php if (isset($_SESSION['errors']['description'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['description']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Loại giảm giá -->
                                    <div class="form-group row">
                                        <label for="discount_type" class="col-sm-3 text-end control-label col-form-label">Loại giảm giá</label>
                                        <div class="col-sm-9">
                                            <select class="form-control <?= isset($_SESSION['errors']['discount_type']) ? 'is-invalid' : '' ?>" id="discount_type" name="discount_type" onchange="updateDiscountValueFormat()">
                                                <option value="1" <?= isset($_SESSION['old']['discount_type']) && $_SESSION['old']['discount_type'] == 1 ? 'selected' : '' ?>>Giảm theo %</option>
                                                <option value="2" <?= isset($_SESSION['old']['discount_type']) && $_SESSION['old']['discount_type'] == 2 ? 'selected' : '' ?>>Giảm số tiền</option>
                                            </select>
                                            <?php if (isset($_SESSION['errors']['discount_type'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['discount_type']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Giá trị giảm -->
                                    <div class="form-group row">
                                        <label for="discount_value" class="col-sm-3 text-end control-label col-form-label">Giá trị giảm</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control <?= isset($_SESSION['errors']['discount_value']) ? 'is-invalid' : '' ?>" id="discount_value" name="discount_value" value="<?= htmlspecialchars($_SESSION['old']['discount_value'] ?? '') ?>">
                                            <?php if (isset($_SESSION['errors']['discount_value'])): ?>
                                                <div class="invalid-feedback"><?= htmlspecialchars($_SESSION['errors']['discount_value']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Giá trị đơn tối thiểu -->
                                    <div class="form-group row">
                                        <label for="min_order_value" class="col-sm-3 text-end control-label col-form-label">Giá trị đơn tối thiểu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control <?= isset($_SESSION['errors']['min_order_value']) ? 'is-invalid' : '' ?>" id="min_order_value" name="min_order_value" value="<?= htmlspecialchars($_SESSION['old']['min_order_value'] ?? '') ?>">
                                            <?php if (isset($_SESSION['errors']['min_order_value'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['min_order_value']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Ngày bắt đầu -->
                                    <div class="form-group row">
                                        <label for="start_date" class="col-sm-3 text-end control-label col-form-label">Ngày bắt đầu</label>
                                        <div class="col-sm-9">
                                            <input type="datetime-local" class="form-control <?= isset($_SESSION['errors']['start_date']) ? 'is-invalid' : '' ?>" id="start_date" name="start_date" value="<?= htmlspecialchars($_SESSION['old']['start_date'] ?? '') ?>">
                                            <?php if (isset($_SESSION['errors']['start_date'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['start_date']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Ngày kết thúc -->
                                    <div class="form-group row">
                                        <label for="end_date" class="col-sm-3 text-end control-label col-form-label">Ngày kết thúc</label>
                                        <div class="col-sm-9">
                                            <input type="datetime-local" class="form-control <?= isset($_SESSION['errors']['end_date']) ? 'is-invalid' : '' ?>" id="end_date" name="end_date" value="<?= htmlspecialchars($_SESSION['old']['end_date'] ?? '') ?>">
                                            <?php if (isset($_SESSION['errors']['end_date'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['end_date']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Trạng thái -->
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 text-end control-label col-form-label">Trạng thái</label>
                                        <div class="col-sm-9">
                                            <select class="form-control <?= isset($_SESSION['errors']['status']) ? 'is-invalid' : '' ?>" id="status" name="status">
                                                <option value="1" <?= isset($_SESSION['old']['status']) && $_SESSION['old']['status'] == 1 ? 'selected' : '' ?>>Kích hoạt</option>
                                                <option value="0" <?= isset($_SESSION['old']['status']) && $_SESSION['old']['status'] == 0 ? 'selected' : '' ?>>Ngừng kích hoạt</option>
                                            </select>
                                            <?php if (isset($_SESSION['errors']['status'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($_SESSION['errors']['status']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <!-- Nút Submit -->
                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-success">Thêm</button>
                                            <a href="/admin/discounts" class="btn btn-secondary">Quay lại</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

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