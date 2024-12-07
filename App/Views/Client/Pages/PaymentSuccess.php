<?php

namespace App\Views\Client\Pages;

class PaymentSuccess
{
    public static function render($orderId, $status, $message, $totalPrice, $fullName, $paymentMethod)
    {
        echo '<style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                margin: 0;
                padding: 0;
            }
            .payment-success-container {
                background-color: #fff;
                width: 80%;
                max-width: 800px;
                margin: 50px auto;
                padding: 30px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                text-align: center;
            }
            h1 {
                color: #4CAF50;
                font-size: 36px;
                margin-bottom: 20px;
            }
            p {
                font-size: 18px;
                line-height: 1.5;
                color: #333;
                margin: 10px 0;
            }
            .payment-details {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 8px;
                max-width: 600px;
                margin: 20px auto;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .payment-details p {
                font-size: 16px;
                margin: 10px 0;
                line-height: 1.5;
            }

            .payment-details strong {
                color: #333;
                font-weight: bold;
            }

            .payment-details p:last-child {
                font-size: 18px;
                font-weight: bold;
                color: #28a745;
            }

            .payment-details p:nth-child(2) {
                color: #dc3545;
            }

            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
            }
            .button:hover {
                background-color: #45a049;
            }
        </style>';

        echo '<div class="payment-success-container">';
        echo "<h1>Thanh toán thành công</h1>";
        echo "<div class='payment-details'>";
        echo "<p><strong>Đơn hàng ID:</strong> {$orderId}</p>";
        echo "<p><strong>Trạng thái thanh toán:</strong> {$status}</p>";
        echo "<p><strong>Tên khách hàng:</strong> {$fullName}</p>";
        echo "<p><strong>Tổng tiền:</strong> " . number_format($totalPrice, 0, ',', '.') . " VNĐ</p>";
        echo "<p><strong>Phương thức thanh toán:</strong> {$paymentMethod}</p>";
        echo "</div>";
        echo '<a href="/" class="button">Quay lại trang chủ</a>';
        echo '</div>';
    }
}
