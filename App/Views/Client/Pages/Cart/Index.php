<?php

namespace App\Views\Client\Pages\Cart;

use App\Views\BaseView;

class index extends BaseView
{
    public static function render($data = null)
    {

?>
        <div class="main-container">
            <div class="cart-container">
                <div class="cart-header">
                    <div class="cart-header__checkbox">
                        <input type="checkbox" class="cart-header__checkbox-input custom-checkbox">
                    </div>
                    <div class="cart-header__title">Sản Phẩm</div>
                    <div class="cart-header__price">Đơn Giá</div>
                    <div class="cart-header__quantity">Số Lượng</div>
                    <div class="cart-header__total">Số Tiền</div>
                    <div class="cart-header__action">Thao Tác</div>
                </div>

                <?php if (!empty($data['cartItems'])): ?>
                    <?php foreach ($data['cartItems'] as $item): ?>
                        <div class="cart-item">
                            <div class="cart-item__checkbox">
                                <input type="checkbox" class="custom-checkbox">
                            </div>
                            <div class="cart-item__details">
                                <img src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($item['sku_image']) ?>" alt="Sản phẩm" class="cart-item__image" width="50px">
                                <div class="cart-item__info">
                                    <h2 class="cart-item__name">
                                        <?= isset($item['product_name']) ? htmlspecialchars($item['product_name']) : 'Sản phẩm không có tên' ?>
                                    </h2>
                                    <p class="cart-item__variant">
                                        <!-- Hiển thị tên variant hoặc option, nếu có -->
                                        Phân loại hàng: <?= isset($item['variant_name']) ? htmlspecialchars($item['variant_name']) : (isset($item['option_name']) ? htmlspecialchars($item['option_name']) : 'Không xác định') ?>
                                    </p>
                                </div>

                            </div>
                            <div class="cart-item__price"><?= number_format($item['sku_price']) ?>₫</div>
                            <div class="cart-item__quantity">
                                <button class="cart-item__quantity-btn" data-cart-id="<?= $item['cart_id'] ?>" data-action="decrease">-</button>
                                <input type="text" value="<?= htmlspecialchars($item['quantity']) ?>" class="cart-item__quantity-input" readonly>
                                <button class="cart-item__quantity-btn" data-cart-id="<?= $item['cart_id'] ?>" data-action="increase">+</button>
                            </div>

                            <div class="cart-item__total"><?= number_format($item['sku_price'] * $item['quantity']) ?>₫</div>
                            <div class="cart-item__action">
                                <form method="POST" action="/cart-delete-single">
                                    <input type="hidden" name="method" value="DELETE">
                                    <input type="hidden" name="cart_id" value="<?= htmlspecialchars($item['cart_id']) ?>">
                                    <button type="submit" class="cart-item__delete-btn">Xóa</button>
                                </form>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Giỏ hàng của bạn đang trống!</p>
                <?php endif; ?>


            </div>

            <div class="shopping-cart__summary">
                <div class="voucher-section">
                    <span class="voucher-icon">🎟️</span>
                    <span class="voucher-title">Shopee Voucher</span>
                    <a href="#" class="voucher-link">Chọn hoặc nhập mã</a>
                </div>
                <div class="shopping-cart__summary-bottom">
                    <div class="shopping-cart__summary-lefts">
                        <input type="checkbox" class="shopping-cart__summary-select-all custom-checkbox">
                        <span class="click-all-lefts">Chọn tất cả</span>
                        <form id="deleteMultipleForm" method="POST" action="/cart-delete-multiple">
                            <input type="hidden" name="method" value="DELETE">
                            <div id="selectedCartIds"></div> <!-- Nơi lưu danh sách cart_id -->
                            <button type="submit" id="deleteSelectedButton">Xóa tất cả</button>
                        </form>


                    </div>
                    <div class="summary-right">
                        <div class="shopping-cart__summary-right">
                            <span class="summary-total-label">Tổng thanh toán (1 sản phẩm):</span>
                            <?php $totalAmount = 0; ?>
                            <?php foreach ($data['cartItems'] as $item): ?>
                                <?php $totalAmount += $item['sku_price'] * $item['quantity']; ?>
                            <?php endforeach; ?>
                            <span class="summary-total-amount"><?= number_format($totalAmount) ?>₫</span>
                        </div>

                        <button class="cta-button checkout-btn">Mua Hàng</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAllCheckbox = document.querySelector('.shopping-cart__summary-select-all');
                const itemCheckboxes = document.querySelectorAll('.custom-checkbox');
                const deleteButton = document.getElementById('deleteSelectedButton');
                const selectedCartIdsContainer = document.getElementById('selectedCartIds');

                // Xử lý chọn tất cả checkbox
                selectAllCheckbox.addEventListener('change', function() {
                    itemCheckboxes.forEach((checkbox) => {
                        checkbox.checked = this.checked;
                    });
                });

                // Xử lý xóa các sản phẩm đã chọn
                deleteButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedIds = [];
                    itemCheckboxes.forEach((checkbox) => {
                        if (checkbox.checked) {
                            const cartId = checkbox.closest('.cart-item').querySelector('input[name="cart_id"]').value;
                            selectedIds.push(cartId);
                        }
                    });

                    if (selectedIds.length === 0) {
                        alert('Vui lòng chọn ít nhất một sản phẩm để xóa.');
                        return;
                    }

                    // Thêm các input ẩn chứa cart_id vào form
                    selectedCartIdsContainer.innerHTML = '';
                    selectedIds.forEach((id) => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'cart_ids[]';
                        input.value = id;
                        selectedCartIdsContainer.appendChild(input);
                    });

                    document.getElementById('deleteMultipleForm').submit();
                });
            });
        </script>
        <!-- + - số luojng á  -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const quantityButtons = document.querySelectorAll('.cart-item__quantity-btn');

                quantityButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const cartId = this.dataset.cartId;
                        const action = this.dataset.action; // "increase" or "decrease"
                        const quantityInput = this.closest('.cart-item__quantity').querySelector('.cart-item__quantity-input');
                        const totalElement = this.closest('.cart-item').querySelector('.cart-item__total');

                        let currentQuantity = parseInt(quantityInput.value);

                        // Increase or decrease quantity
                        if (action === 'increase') {
                            currentQuantity++;
                        } else if (action === 'decrease') {
                            currentQuantity = Math.max(currentQuantity - 1, 1); // Don't allow decreasing below 1
                        }

                        // Update the UI immediately
                        quantityInput.value = currentQuantity;
                        totalElement.innerHTML = `${numberWithCommas(currentQuantity * parseInt(totalElement.dataset.price))}₫`;

                        // Update the quantity on the server
                        updateCartQuantity(cartId, currentQuantity, totalElement);
                    });
                });
            });

            // Hàm để chuyển đổi giá thành số
            function parsePrice(priceStr) {
                return parseInt(priceStr.replace(/[^\d]/g, ''), 10); // Loại bỏ mọi ký tự không phải số
            }

            // Sửa lại code trong hàm updateCartQuantity
            function updateCartQuantity(cartId, newQuantity, totalElement) {
                const priceElement = totalElement.closest('.cart-item').querySelector('.cart-item__price');

                // Chuyển giá trị giá thành số
                const price = parsePrice(priceElement.innerText);

                if (isNaN(price)) {
                    console.error('Giá sản phẩm không hợp lệ!');
                    return;
                }

                // Tính toán lại tổng
                const totalPrice = newQuantity * price;
                totalElement.innerHTML = `${numberWithCommas(totalPrice)}₫`;

                fetch('/cart-update-quantity', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            cart_id: cartId,
                            quantity: newQuantity,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật lại tổng giá cho giỏ hàng
                            updateCartTotal();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error updating cart quantity:', error);
                    });
            }



            function updateCartTotal() {
                let totalAmount = 0;
                document.querySelectorAll('.cart-item').forEach(item => {
                    const price = parseInt(item.querySelector('.cart-item__price').dataset.price, 10);
                    const quantity = parseInt(item.querySelector('.cart-item__quantity-input').value, 10);

                    if (isNaN(price) || isNaN(quantity)) {
                        console.error('Giá hoặc số lượng không hợp lệ!');
                        return; // Không tính nếu giá hoặc số lượng không hợp lệ
                    }

                    totalAmount += price * quantity;
                });
                document.querySelector('.summary-total-amount').innerText = `${numberWithCommas(totalAmount)}₫`;
            }


            // Helper function to format number with commas
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        </script>
<?php

    }
}
?>
<script>
    const cartContainer = document.querySelector('.cart-container');
    const summaryContainer = document.querySelector('.shopping-cart__summary');
    cartContainer.addEventListener('scroll', function() {
        if (cartContainer.scrollTop + cartContainer.clientHeight >= cartContainer.scrollHeight - 100) {
            summaryContainer.classList.add('fixed-summary');
        } else {
            summaryContainer.classList.remove('fixed-summary');
        }
    });
</script>