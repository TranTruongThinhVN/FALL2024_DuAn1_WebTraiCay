<?php

namespace App\Controllers\Client;

use App\Models\Admin\Product;
use App\Models\Client\Cart;
use App\Models\Client\Product as ClientProduct;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Cart\Index;


class CartController
{
    // hiển thị danh sách
    public static function index()
    {
        // Render Header, Body (giỏ hàng) và Footer
        $user_id = $_SESSION['user']['id'] ?? null; // Kiểm tra user đăng nhập
        if (!$user_id) {
            echo "Vui lòng đăng nhập để xem giỏ hàng!";
            return;
        }

        $cart = new Cart();
        $cartItems = $cart->getCartItems($user_id); // Lấy dữ liệu giỏ hàng
        $cartTotal = $cart->getCartTotal($user_id); // Lấy tổng giá trị giỏ hàng


        // Truyền dữ liệu cho header
        Header::render(['cartItems' => $cartItems, 'cartTotal' => $cartTotal]);
        Index::render(['cartItems' => $cartItems]); // Truyền dữ liệu giỏ hàng vào view
        Footer::render(); // Render Footer
    }
    public function addToCart()
    {
        if (!isset($_SESSION['user']) || empty($_SESSION['user']['id'])) {
            echo json_encode([
                'success' => false,
                'redirect' => '/login',
                'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.',
            ]);
            exit();
        }

        try {
            $productId = $_POST['product_id'] ?? null;
            $variantId = $_POST['variant_id'] ?? null;
            $optionId = $_POST['option_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if (!$productId) {
                throw new \Exception('Sản phẩm không tồn tại.');
            }

            $productModel = new Product();
            $cartModel = new Cart();

            $product = $productModel->getOneProduct($productId);
            if (!$product) {
                throw new \Exception('Sản phẩm không hợp lệ.');
            }

            $price = $product['price'];
            $discountPrice = $product['discount_price'];
            $finalPrice = $price - ($discountPrice ?? 0);

            // Nếu là sản phẩm có biến thể, lấy giá từ SKU
            if ($product['type'] === 'variable') {
                $sku = $cartModel->getSkuByVariantAndOption($variantId, $optionId);

                if (!$sku) {
                    throw new \Exception('Không tìm thấy SKU cho sản phẩm biến thể.');
                }

                $price = $sku['price'];
                $discountPrice = $sku['discount_price'];
                $finalPrice = $price - ($discountPrice ?? 0);
            }

            // Đảm bảo giá không âm
            $finalPrice = max($finalPrice, 0);

            // Thêm sản phẩm vào giỏ hàng
            $cartItem = [
                'user_id' => $_SESSION['user']['id'],
                'product_id' => $productId,
                'sku_id' => $sku['id'] ?? null,
                'quantity' => $quantity,
                'price' => $price,
                'discount_price' => $discountPrice,
            ];
            $cartModel->addItem($cartItem);

            echo json_encode([
                'success' => true,
                'message' => 'Thêm sản phẩm vào giỏ hàng thành công!',
                'name' => $product['name'],
                'price' => number_format($finalPrice),
                'image' => $sku['image'] ?? $product['image'], // Hình ảnh từ SKU nếu có
            ]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }







    public function getSkuPrice()
    {
        try {
            $variantId = $_POST['variant_id'] ?? null;
            $optionId = $_POST['option_id'] ?? null;

            if (!$variantId || !$optionId) {
                throw new \Exception('Dữ liệu không hợp lệ.');
            }
            $productModel = new Cart();
            $sku = $productModel->getSkuByVariantAndOption($variantId, $optionId);

            if (!$sku) {
                throw new \Exception('Không tìm thấy SKU tương ứng.');
            }

            // Log kết quả SKU lấy được
            error_log("SKU Fetched: " . json_encode($sku));

            echo json_encode([
                'success' => true,
                'price' => number_format($sku['price']),
            ]);
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }






    public static function showCart()
    {
        $user_id = $_SESSION['user']['id'] ?? null; // Kiểm tra user đăng nhập
        if (!$user_id) {
            echo "Vui lòng đăng nhập để xem giỏ hàng!";
            return;
        }

        $cart = new Cart();
        $cartItems = $cart->getCartProducts($user_id); // Lấy dữ liệu giỏ hàng
        $cartTotal = $cart->getCartTotal($user_id); // Lấy tổng giá trị giỏ hàng

        // Truyền dữ liệu cho header
        Header::render(['cartItems' => $cartItems, 'cartTotal' => $cartTotal]);


        // Tiếp tục render phần giỏ hàng trong main content
        Index::render(['cartItems' => $cartItems]);
        Footer::render();
    }

    public function deleteSingle()
    {
        try {
            $cartId = $_POST['cart_id'] ?? null; // Lấy `cart_id` từ form
            error_log("Lỗi cập nhật số lượng: " . print_r($_POST['cart_id']));
            if (!$cartId) {
                throw new \Exception("Không tìm thấy sản phẩm cần xóa.");
            }

            $cart = new Cart();
            $success = $cart->deleteProduct($cartId); // Xóa sản phẩm bằng ID

            if ($success) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.'
                ]);
            } else {
                throw new \Exception("Không thể xóa sản phẩm.");
            }
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function deleteMultiple()
    {
        try {
            $cartIds = $_POST['cart_ids'] ?? null; // Lấy danh sách `cart_ids` từ form

            if (!$cartIds || !is_array($cartIds)) {
                throw new \Exception("Không có sản phẩm nào được chọn.");
            }

            $cart = new Cart();
            $success = $cart->deleteMultipleProducts($cartIds); // Xóa nhiều sản phẩm

            if ($success) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Các sản phẩm đã được xóa khỏi giỏ hàng.'
                ]);
            } else {
                throw new \Exception("Không thể xóa sản phẩm.");
            }
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public static function getProductCart($userId)
    {
        $cartModel = new Cart();
        $cartProducts = $cartModel->getCartProducts($userId);


        return $cartProducts;
    }
    public function updateCart()
    {
        $userid = ($_SESSION['user']['id']);
        $dataCart = CartController::getProductCart($userid);

        ob_start();
?>
        <div class="offcanvas-cart-body" id="offcanvas-cart-body">
            <?php if (!empty($dataCart)): ?>
                <p class="free-shipping-text">Bạn được giao hàng miễn phí!</p>
                <hr>
                <?php foreach ($dataCart as $product): ?>
                    <div class="cart-item">
                        <img src="<?= APP_URL ?>/public/uploads/products/<?= htmlspecialchars($product['image']) ?>"
                            alt="<?= htmlspecialchars($product['sku_name']) ?>">
                        <div class="item-details">
                            <h4><?= htmlspecialchars($product['sku_name']) ?></h4>
                            <span><?= number_format($product['discount_price'] ?? $product['price'], 0, ',', '.') ?>đ</span>
                            <!-- <span>Xuất xứ: <?= htmlspecialchars($product['variant_name']) ?></span> -->
                        </div>
                        <div class="item-quantity-container">
                            <input type="number" value="<?= $product['quantity'] ?>" class="item-quantity">
                            <a href="/cart/remove/<?= $product['product_id'] ?>" class="remove-item">Bỏ</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Giỏ hàng của bạn đang trống.</p>
            <?php endif; ?>
        </div>
        <div>
            <p><strong>Tổng: </strong><?= number_format($this->getCartTotal($dataCart), 0, ',', '.') ?> đ</p>
        </div>
<?php
        $cartHTML = ob_get_clean();
        echo json_encode([
            'success' => true,
            'cartHTML' => $cartHTML,
            'cartTotal' => number_format($this->getCartTotal($dataCart), 0, ',', '.')
        ]);
        exit;
    }
    public function getCartTotal($cartItems)
    {

        $total = 0;
        foreach ($cartItems as $item) {
            $price = $item['discount_price'] ?? $item['price'];
            $total += $price * $item['quantity'];
        }
        return $total;
    }
    public function updateQuantity()
    {
        try {
            $cartId = $_POST['cart_id'] ?? null;
            $quantity = $_POST['quantity'] ?? null;

            if (!$cartId || !$quantity || !is_numeric($quantity) || $quantity <= 0) {
                throw new \Exception("Dữ liệu không hợp lệ: Vui lòng kiểm tra `cart_id` và `quantity`.");
            }

            $cart = new Cart();

            // Kiểm tra tồn tại của sản phẩm trong giỏ hàng
            $cartItem = $cart->getCartItemById($cartId);
            if (!$cartItem) {
                throw new \Exception("Không tìm thấy sản phẩm trong giỏ hàng.");
            }

            // Cập nhật số lượng sản phẩm
            $success = $cart->updateProductQuantity($cartId, $quantity);
            if ($success) {
                $updatedCartItem = $cart->getCartItemById($cartId);
                $cartTotal = $cart->getCartTotal($_SESSION['user']['id']);

                echo json_encode([
                    'success' => true,
                    'new_total_price' => $updatedCartItem['sku_price'] * $updatedCartItem['quantity'],
                    'cart_total' => $cartTotal,
                    'message' => 'Cập nhật số lượng thành công.'
                ]);
            } else {
                throw new \Exception("Không thể cập nhật số lượng sản phẩm.");
            }
        } catch (\Exception $e) {
            // Trả HTTP code lỗi và log thông báo
            http_response_code(400);
            error_log("Lỗi cập nhật số lượng: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
