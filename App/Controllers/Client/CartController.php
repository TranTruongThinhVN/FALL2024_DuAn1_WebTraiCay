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
        echo '<pre>';
        print_r($cartItems);
        echo '</pre>';

        // Truyền dữ liệu cho header
        Header::render(['cartItems' => $cartItems, 'cartTotal' => $cartTotal]);



        Index::render(['cartItems' => $cartItems]); // Truyền dữ liệu giỏ hàng vào view
        Footer::render(); // Render Footer
    }
    public function addToCart()
    {
        try {
            $productId = $_POST['product_id'] ?? null;
            $variantId = $_POST['variant_id'] ?? null;
            $optionId = $_POST['option_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if (!$productId) {
                throw new \Exception('Sản phẩm không tồn tại.');
            }

            // Khởi tạo model
            $productModel = new Product(); // Đảm bảo model sản phẩm
            $cartModel = new Cart(); // Đảm bảo model giỏ hàng

            // Lấy sản phẩm từ bảng products
            $product = $productModel->getOneProduct($productId);

            if (!$product) {
                throw new \Exception('Sản phẩm không hợp lệ.');
            }

            // Nếu sản phẩm là loại biến thể
            if ($product['type'] === 'variable') {
                $sku = $cartModel->getSkuByVariantAndOption($variantId, $optionId);

                if (!$sku) {
                    throw new \Exception('Không tìm thấy SKU cho sản phẩm biến thể.');
                }

                $cartItem = [
                    'user_id' => $_SESSION['user']['id'], // ID người dùng
                    'sku_id' => $sku['id'], // SKU ID của sản phẩm biến thể
                    'quantity' => $quantity,
                    'price' => $sku['price'], // Giá của SKU
                    'discount_price' => $sku['discount_price'], // Giá giảm của SKU
                ];
            } else {
                $cartItem = [
                    'user_id' => $_SESSION['user']['id'], // ID người dùng
                    'product_id' => $productId, // ID sản phẩm đơn giản
                    'quantity' => $quantity,
                    'price' => $product['price'], // Giá của sản phẩm đơn giản
                    'discount_price' => $product['discount_price'], // Giá giảm của sản phẩm đơn giản
                ];
            }

            // Thêm sản phẩm vào giỏ hàng
            $cartModel->addItem($cartItem);

            echo json_encode(['success' => true, 'message' => 'Thêm sản phẩm vào giỏ hàng thành công!']);
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
        $cartItems = $cart->getCartItems($user_id); // Lấy dữ liệu giỏ hàng
        $cartTotal = $cart->getCartTotal($user_id); // Lấy tổng giá trị giỏ hàng
        echo '<pre>';
        print_r($cartItems);
        echo '</pre>';

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
    public function updateQuantity()
    {
        try {
            $cartId = $_POST['cart_id'] ?? null;
            $quantity = $_POST['quantity'] ?? null;

            if (!$cartId || !$quantity) {
                throw new \Exception("Dữ liệu không hợp lệ.");
            }

            $cart = new Cart();
            $success = $cart->updateProductQuantity($cartId, $quantity);

            if ($success) {
                $updatedCartItem = $cart->getCartItemById($cartId);
                $cartTotal = $cart->getCartTotal($_SESSION['user']['id']);

                echo json_encode([
                    'success' => true,
                    'new_total_price' => $updatedCartItem['sku_price'] * $updatedCartItem['quantity'],
                    'cart_total' => $cartTotal,
                ]);
            } else {
                throw new \Exception("Không thể cập nhật số lượng sản phẩm.");
            }
        } catch (\Exception $e) {
            http_response_code(400); // Đặt HTTP status code là 400
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
