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
                <!-- Tiêu đề giỏ hàng -->
                <div class="cart-header">
                    <div class="cart-header__checkbox">
                        <input type="checkbox" id="selectAllCheckbox" class="custom-checkbox">
                    </div>
                    <div class="cart-header__title">Sản Phẩm</div>
                    <div class="cart-header__price">Đơn Giá</div>
                    <div class="cart-header__quantity">Số Lượng</div>
                    <div class="cart-header__total">Số Tiền</div>
                    <div class="cart-header__action">Thao Tác</div>
                </div>

                <!-- Danh sách sản phẩm -->
                <?php if (!empty($data['cartItems'])): ?>
                    <?php foreach ($data['cartItems'] as $item): ?>
                        <div class="cart-item">
                            <div class="cart-item__checkbox">
                                <input type="checkbox" class="custom-checkbox" data-cart-id="<?= $item['cart_id'] ?>">
                            </div>
                            <div class="cart-item__details">
                                <img src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($item['type'] === 'simple' ? $item['image'] : $item['sku_image']) ?>"
                                    class="cart-item__image">
                                <div class="cart-item__info">
                                    <h3 class="cart-item__name"><?= htmlspecialchars($item['sku_name']) ?></h3>
                                    <p class="cart-item__variant">Phân loại:
                                        <?= htmlspecialchars($item['variant_name'] ?? 'Không xác định') ?>
                                    </p>
                                </div>
                            </div>
                            <div class="cart-item__price">
                                <?php
                                $price = $item['type'] === 'simple' ? $item['price'] : $item['sku_price'];
                                $discountPrice = $item['discount_price'] ?? null;
                                ?>
                                <?php if (!empty($discountPrice) && $discountPrice < $price): ?>
                                    <span class="discount-price"><?= number_format($discountPrice) ?>₫</span>
                                <?php else: ?>
                                    <span class="normal-price"><?= number_format($price) ?>₫</span>
                                <?php endif; ?>
                            </div>

                            <div class="cart-item__quantity">
                                <button class="cart-item__quantity-btn" data-cart-id="<?= $item['cart_id'] ?>"
                                    data-action="decrease">-</button>
                                <input type="text" value="<?= htmlspecialchars($item['quantity']) ?>" class="cart-item__quantity-input"
                                    readonly>
                                <button class="cart-item__quantity-btn" data-cart-id="<?= $item['cart_id'] ?>"
                                    data-action="increase">+</button>
                            </div>
                            <div class="cart-item__total">
                                <?= number_format(($discountPrice ?? $price) * $item['quantity']) ?>₫
                            </div>
                            <div class="cart-item__action">
                                <form id="deleteCartItemForm" data-cart-id="<?= htmlspecialchars($item['cart_id']) ?>">
                                    <input type="hidden" name="method" value="DELETE">
                                    <button type="submit" class="cart-item__delete-btn">Xóa</button>
                                </form>
                            </div>


                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="empty-cart">Giỏ hàng của bạn đang trống!</p>
                <?php endif; ?>

            </div>

            <!-- Phần tổng kết -->
            <div class="shopping-cart__summary">
                <div class="shopping-cart__summary-bottom">
                    <div class="shopping-cart__summary-lefts">
                        <input type="checkbox" id="selectAllSummary" class="custom-checkbox">
                        <span>Chọn tất cả</span>
                        <button id="deleteSelectedButton" class="btn-delete-all">Xóa tất cả</button>
                    </div>
                    <div class="summary-right">
                        <span class="summary-total-label">Tổng thanh toán:</span>
                        <span class="summary-total-amount">0₫</span>
                        <button class="cta-button checkout-btn" id="buyNowButton">Mua Hàng</button>
                    </div>
                </div>
            </div>
        </div>
        <form id="checkoutForm" action="/checkout" method="POST">
            <input type="hidden" name="method" value="POST">
            <input type="hidden" name="selected_items" id="selectedItemsInput" value="">
        </form>


        <!-- + - số luojng á  -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const quantityButtons = document.querySelectorAll('.cart-item__quantity-btn');
                const totalAmountElement = document.querySelector('.summary-total-amount');
                const itemCheckboxes = document.querySelectorAll('.cart-item input[type="checkbox"]');
                const selectAllCheckbox = document.getElementById('selectAllCheckbox');

                // Kiểm tra sự tồn tại của phần tử trước khi thêm sự kiện
                if (selectAllCheckbox) {
                    selectAllCheckbox.addEventListener('change', () => {
                        const isChecked = selectAllCheckbox.checked;
                        itemCheckboxes.forEach(checkbox => checkbox.checked = isChecked);
                        updateCartTotal();
                    });
                }

                if (quantityButtons.length > 0) {
                    quantityButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const cartId = this.dataset.cartId;
                            const action = this.dataset.action; // "increase" hoặc "decrease"
                            const quantityInput = this.closest('.cart-item__quantity').querySelector('.cart-item__quantity-input');
                            const totalElement = this.closest('.cart-item').querySelector('.cart-item__total');
                            const priceElement = this.closest('.cart-item').querySelector('.discount-price, .normal-price');

                            if (!quantityInput || !totalElement || !priceElement) {
                                console.error('Thiếu thông tin để xử lý sự kiện tăng/giảm số lượng.');
                                return;
                            }

                            let currentQuantity = parseInt(quantityInput.value, 10);
                            const price = parseInt(priceElement.innerText.replace(/[^0-9]/g, ''), 10);

                            // Cập nhật số lượng sản phẩm
                            if (action === 'increase') {
                                currentQuantity++;
                            } else if (action === 'decrease') {
                                currentQuantity = Math.max(currentQuantity - 1, 1); // Không cho phép giảm dưới 1
                            }

                            fetch('/cart-update-quantity', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        cart_id: cartId,
                                        quantity: currentQuantity,
                                    }),
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json(); // Cố gắng parse JSON
                                })
                                .then(data => {
                                    if (data.success) {
                                        // Cập nhật giao diện nếu thành công
                                        quantityInput.value = currentQuantity; // Cập nhật số lượng
                                        totalElement.innerText = `${(currentQuantity * price).toLocaleString()}₫`; // Cập nhật tổng tiền của sản phẩm
                                        updateCartTotal(); // Cập nhật tổng tiền giỏ hàng
                                    } else {
                                        alert(data.message || 'Cập nhật số lượng thất bại!');
                                    }
                                })
                                .catch(error => {
                                    console.error('Lỗi khi cập nhật số lượng:', error);
                                    alert('Đã xảy ra lỗi khi cập nhật số lượng. Vui lòng thử lại!');
                                });

                        });
                    });
                }

                const updateCartTotal = () => {
                    let totalAmount = 0;

                    // Lấy tất cả các sản phẩm được chọn
                    document.querySelectorAll('.cart-item input[type="checkbox"]:checked').forEach(item => {
                        const cartItem = item.closest('.cart-item');
                        const priceElement = cartItem.querySelector('.cart-item__price .discount-price, .cart-item__price .normal-price');
                        const quantityInput = cartItem.querySelector('.cart-item__quantity-input');

                        if (priceElement && quantityInput) {
                            const price = parseInt(priceElement.innerText.replace(/[^0-9]/g, ''), 10);
                            const quantity = parseInt(quantityInput.value, 10);

                            if (!isNaN(price) && !isNaN(quantity)) {
                                totalAmount += price * quantity;
                            }
                        }
                    });

                    // Cập nhật tổng tiền
                    if (totalAmountElement) {
                        totalAmountElement.innerText = `${totalAmount.toLocaleString()}₫`;
                    }
                };

                // Cập nhật tổng tiền khi thay đổi checkbox
                itemCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateCartTotal);
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const buyNowButton = document.getElementById('buyNowButton');
                const itemCheckboxes = document.querySelectorAll('.cart-item input[type="checkbox"]');
                const checkoutForm = document.getElementById('checkoutForm');
                const selectedItemsInput = document.getElementById('selectedItemsInput');

                buyNowButton.addEventListener('click', () => {
                    // Lấy danh sách sản phẩm được chọn
                    const selectedItems = Array.from(itemCheckboxes)
                        .filter(checkbox => checkbox.checked)
                        .map(checkbox => checkbox.dataset.cartId);

                    if (selectedItems.length === 0) {
                        alert('Vui lòng chọn ít nhất một sản phẩm để mua!');
                        return;
                    }

                    // Gắn danh sách cart_id đã chọn vào input ẩn
                    selectedItemsInput.value = selectedItems.join(',');
                    window.location.href = "/checkout";
                    // // Submit form
                    // checkoutForm.submit();
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.cart-item__delete-btn').forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        var form = button.closest('form'); // Tìm form cha của button
                        var cartId = form.querySelector('input[name="cart_id"]').value;
                        var xhr = new XMLHttpRequest();
                        xhr.open('DELETE', '/cart-delete-single', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log('Xóa sản phẩm thành công');
                                    // Xử lý khi xóa thành công, ví dụ: remove the item from the UI
                                } else {
                                    console.error('Lỗi khi xóa sản phẩm');
                                }
                            }
                        };
                        xhr.send('cart_id=' + encodeURIComponent(cartId));
                    });
                });
            });
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