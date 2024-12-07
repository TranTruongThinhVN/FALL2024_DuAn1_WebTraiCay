<?php

namespace App\Helpers;

use App\Models\Client\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Twilio\Http\CurlClient;

// use App\Models\Client\User;
// <!-- Thực tế nếu chia quyền admin, client, hay nhân viên thì chia thành các form đăng nhập riêng thì truy vấn lặp lại các lệnh nên trung gian qa đây -->
// <!-- sử dụng lại á -->
class ContactHelper
{
    public static function sendContactToAdmin($name, $email, $phone, $message)
    {
        $subject = "Liên hệ mới từ " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $body = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 10px; overflow: hidden;'>
            <div style='background-color: #4CAF50; color: white; padding: 20px; text-align: center;'>
                <h2 style='margin: 0;'>Thông tin liên hệ</h2>
            </div>
            <div style='padding: 20px;'>
                <p style='font-size: 16px; margin: 0;'><strong>Họ tên:</strong> " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "</p>
                <p style='font-size: 16px; margin: 0;'><strong>Email:</strong> <a href='mailto:" . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "' style='color: #4CAF50;'>" . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "</a></p>
                <p style='font-size: 16px; margin: 0;'><strong>Số điện thoại:</strong> " . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . "</p>
                <p style='font-size: 16px; margin-top: 10px;'><strong>Nội dung liên hệ:</strong></p>
                <p style='font-size: 14px; color: #555;'>" . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . "</p>
            </div>
            <div style='background-color: #f9f9f9; padding: 10px; text-align: center; border-top: 1px solid #ddd;'>
                <p style='font-size: 12px; color: #aaa;'>Email này được gửi tự động từ hệ thống Fruitify.</p>
            </div>
        </div>
        ";

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "nguyenquockhai2305@gmail.com"; // Địa chỉ email của bạn
            $mail->Password = "bili buhr anik pdtk"; // Mật khẩu ứng dụng
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('nguyenquockhai2305@gmail.com', 'Fruitify - Hệ thống liên hệ');
            $mail->addReplyTo($email, $name); // Người dùng có thể trả lời email này
            $mail->addAddress('nguyenquockhai2305@gmail.com'); // Email admin

            $mail->isHTML(true);
            $mail->Subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
            $mail->Body = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Gửi email thất bại: {$mail->ErrorInfo}");
            return false;
        }
    }
    // Recapcha
    public static function verifyRecaptcha($token)
    {
        $secretKey = "6LeH2ZMqAAAAALFgBS7WzYQBq6Fd8HE41QwVlcJn"; // Secret Key
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $response = file_get_contents($url . '?secret=' . $secretKey . '&response=' . $token);
        $responseKeys = json_decode($response, true);

        return $responseKeys["success"] ?? false;
    }
}
