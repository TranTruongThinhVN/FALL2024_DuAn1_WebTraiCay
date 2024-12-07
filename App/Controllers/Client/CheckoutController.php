<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Order;
use App\Models\Client\Cart;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Checkout\Checkout;
use App\Views\Client\Pages\Contact\Contact;

class CheckoutController
{
    // hiển thị danh sách
    public static function index()
    {

        $userid = ($_SESSION['user']['id']);
        $cartModel = new Cart();
        $cartProducts = $cartModel->getCartProducts($userid);
        Header::render();
        Checkout::render($cartProducts);
        Footer::render();
    }
    public static function store()
    {
        $userid = ($_SESSION['user']['id']);
        $inputData = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $totalPrice = $inputData['total'];
            $paymentMethod = $inputData['paymentMethod'];
            $orderModel = new Order();
            $orderId = $orderModel->createOrder([
                'total' => $inputData['total'],
                'fullName' => $inputData['fullName'],
                'address' => $inputData['address'],
                'phoneNumber' => $inputData['phoneNumber'],
                'paymentMethod' => $inputData['paymentMethod'],
                'deliveryMethod' => $inputData['deliveryMethod'],
                'userId' => $userid ?? null,
                'cartItems' => $inputData['cartItems'],
            ]);

            if ($orderId) {
                $paymentUrl = PaymentController::processPayment($orderId, $totalPrice, $paymentMethod);
                if ($paymentUrl) {
                    echo json_encode([
                        'success' => true,
                        'paymentUrl' => $paymentUrl
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'QR Code tạo không thành công. Vui lòng thử lại sau'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error creating order'
                ]);
            }
        } else {
            error_log('Invalid JSON received');
            echo json_encode([
                'success' => false,
                'message' => 'Invalid JSON received'
            ]);
        }
    }
}
