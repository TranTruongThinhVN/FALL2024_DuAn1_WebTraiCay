<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Purchase_history extends BaseView
{
    public static function render($data = null)
    {
?>
        <link rel="stylesheet" href="public/styles/main.css">
        <div class="purchase-history">
            <h2 class="purchase-history__title">Lịch Sử Mua Hàng</h2>
            <div class="purchase-history__filters">
                <a href="#" class="purchase-history__filter-link purchase-history__filter-link--active">Tất cả</a>
                <a href="#" class="purchase-history__filter-link">Chờ thanh toán</a>
                <a href="#" class="purchase-history__filter-link">Chờ giao hàng</a>
                <a href="#" class="purchase-history__filter-link">Hoàn thành</a>
                <a href="#" class="purchase-history__filter-link">Đã hủy</a>
            </div>
            <div class="purchase-history__list">
                <div class="purchase-history__item">
                    <img src="path/to/image.jpg" alt="Product Image" class="purchase-history__item-image">

                    <div class="purchase-history__item-info">
                        <h3 class="purchase-history__item-title">Bộ nắp sau tay lái | ốp gáy sau Vision</h3>
                        <span class="purchase-history__item-price">198.000₫</span>
                        <span class="purchase-history__item-status">Đã hủy bởi bạn</span>
                    </div>

                    <div class="purchase-history__item-actions">
                        <button class="purchase-history__item-button">Mua Lại</button>
                        <button class="purchase-history__item-button">Xem Chi Tiết Hủy Đơn</button>
                        <button class="purchase-history__item-button">Liên Hệ Người Bán</button>
                    </div>
                </div>
                <!-- Thêm các item khác nếu cần -->
            </div>
        </div>

<?php
    }
}
?>