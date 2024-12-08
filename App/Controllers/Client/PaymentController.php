<?php

namespace App\Controllers\Client;

use App\Models\Admin\Order;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Cart\Index;
use App\Models\Client\Cart;
use App\Views\Client\Pages\PaymentSuccess;

class PaymentController
{

    public static function processPayment($orderId, $totalPrice, $paymentMethod)
    {

        if ($paymentMethod === 'momo') {
            $paymentController = new self();
            $checkoutSession = $paymentController->getmomopayments($orderId, $totalPrice);

            if (isset($checkoutSession['payUrl'])) {
                return $checkoutSession['payUrl'];
            } else {
                error_log('Error: ' . print_r($checkoutSession['message'], true));
                return 'Error: Unable to generate payment URL.';
            }
        }
        return 'Error: Unable to generate payment URL.';
    }
    function getmomopayments($orderId, $totalPrice): mixed
    {

        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $partnerCode = 'MOMOBKUN20180529';
        $orderInfo = "Thanh toan don hang " . $orderId;

        // $redirectUrl = 'https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b';
        // $ipnUrl = 'https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b';
        $baseUrl = $_ENV['APP_URL'];
        $redirectUrl = $baseUrl . '/ipn-momo';
        $ipnUrl = $baseUrl . '/ipn-momo';
        error_log('baseUrl: ' . print_r($redirectUrl, true));

        $requestType = "payWithMethod";
        $amount = intval($totalPrice);
        $orderId = $partnerCode . time();
        $requestId = $orderId;
        $extraData = '';
        $autoCapture = true;
        $lang = 'vi';

        $rawSignature = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";

        $signature = hash_hmac('sha256', $rawSignature, $secretKey);

        $requestBody = [
            'partnerCode' => $partnerCode,
            'partnerName' => 'Test',
            'storeId' => 'MomoTestStore',
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => $lang,
            'requestType' => $requestType,
            'autoCapture' => $autoCapture,
            'extraData' => $extraData,
            'orderGroupId' => '',
            'signature' => $signature
        ];
        $responseData = $this->callMomoAPI($requestBody);

        return $responseData;
    }
    function route($name)
    {
        $routes = [
            'ipn.Momo' => '/momo-ipn',
        ];
        return isset($routes[$name]) ? $routes[$name] : null;
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    private function callMomoAPI($requestBody)
    {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $response = $this->execPostRequest($endpoint, json_encode($requestBody));

        $decodedResponse = json_decode($response, true);
        // Decode the response
        return $decodedResponse;
    }

    public function ipnMomo()
    {
        $orderId = $_GET['orderId'] ?? null;
        $orderInfo = $_GET['orderInfo'] ?? null;
        $resultCode = $_GET['resultCode'] ?? null;
        $message = $_GET['message'] ?? null;
        preg_match('/\d+/', $orderInfo, $matches);
        $orderId = $matches[0] ?? null;

        if ($resultCode == '0') {
            $orderModel = new Order();
            $order = $orderModel->getOrderById($orderId);
            $updated = $orderModel->updatePaymentStatus($orderId, 1);
            if ($updated) {
                $cartModel = new Cart();
                $userId = $order['user_id'];
                $cartModel->clearCartByUserId($userId);
                $totalPrice = $order['total_price'];
                $fullName = $order['name'];
                $paymentMethod = $order['payment_method'];
                $paymentSuccessUrl = "/payment-success?orderId={$orderId}&status=success&message=Thanh%20toan%20thanh%20cong&totalPrice={$totalPrice}&fullName={$fullName}&paymentMethod={$paymentMethod}";
                header("Location: {$paymentSuccessUrl}");
                exit();
            } else {
                error_log("Lỗi khi cập nhật trạng thái thanh toán cho đơn hàng ID: {$orderId}");
                return 'Failed to update payment status';
            }
        } else {
            error_log("Payment failed: {$message}");
            return 'Payment failed';
        }
    }
    public function success()
    {
        $orderId = $_GET['orderId'] ?? null;
        $status = $_GET['status'] ?? null;
        $message = $_GET['message'] ?? null;
        $totalPrice = $_GET['totalPrice'] ?? null;
        $fullName = $_GET['fullName'] ?? null;
        $paymentMethod = $_GET['paymentMethod'] ?? null;
        Header::render();
        PaymentSuccess::render($orderId, $status, $message, $totalPrice, $fullName, $paymentMethod);
        Footer::render();
    }
}
