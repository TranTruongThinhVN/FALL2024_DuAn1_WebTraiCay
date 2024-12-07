<?php

namespace App\Views\Client\Pages\Checkout;

use App\Views\BaseView;

class Checkout extends BaseView
{
    public static function render($data = null)
    {
        $items = $data['items'] ?? [];
        $total = $data['total'] ?? 0;
?>
        <!DOCTYPE html>
        <html lang="vi">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Checkout Page</title>
        </head>

        <body>
            <h2>Tóm tắt đơn hàng</h2>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <div class="summary-item">
                        <img src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($item['sku_image']) ?>" alt="Product Image">
                        <p><?= htmlspecialchars($item['product_name']) ?></p>
                        <p>Số lượng: <?= (int)$item['quantity'] ?></p>
                        <p>Giá: <?= number_format(($item['discount_price'] ?? $item['sku_price']) * $item['quantity']) ?> VNĐ</p>
                    </div>
                <?php endforeach; ?>
                <p>Tổng: <?= number_format($total) ?> VNĐ</p>
                <form method="POST" action="/checkout/submit-order">
                    <input type="text" name="fullname" placeholder="Họ và Tên" required>
                    <input type="text" name="phone" placeholder="Điện thoại" required>
                    <input type="text" name="address" placeholder="Địa chỉ" required>
                    <select name="payment_method">
                        <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                        <option value="momo">MoMo</option>
                        <!-- Thêm các phương thức khác nếu cần -->
                    </select>
                    <button type="submit">Thanh toán ngay</button>
                </form>
            <?php else: ?>
                <p>Không có sản phẩm nào trong đơn hàng!</p>
            <?php endif; ?>
        </body>

        </html>
<?php
    }
}
