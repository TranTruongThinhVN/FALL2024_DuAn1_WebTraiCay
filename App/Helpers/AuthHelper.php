<?php

namespace App\Helpers;

use App\Models\Client\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// use App\Models\Client\User;
// <!-- Thực tế nếu chia quyền admin, client, hay nhân viên thì chia thành các form đăng nhập riêng thì truy vấn lặp lại các lệnh nên trung gian qa đây -->
// <!-- sử dụng lại á -->
class AuthHelper
{
    public static function register($data)
    {

        $user = new User();
        // bắt tồn tại email
        // kiểm tra mảng email có tồn tại hay chưa
        $is_exits = $user->getOneUserByEmail($data['email']);
        if ($is_exits) {
            $_SESSION['errors']['email'] = 'Email đã tồn tại.';
            return false;
        }
        $result = $user->createUser($data);
        if ($result) {
            return true;
        }
        return false;
        // 
    }


    public static function login($data)
    {
        $user = new User();
        $userRecord = $user->getOneUserByEmail($data['email']);

        // Check if the user exists and password is correct
        if (!$userRecord || !password_verify($data['password'], $userRecord['password'])) {
            $_SESSION['error'] = 'Email hoặc mật khẩu không đúng';
            return false;
        }

        // Set session
        $_SESSION['user'] = $userRecord;

        // Handle "Remember Me" functionality
        if ($data['remember']) {
            self::updateCookie($userRecord['id']);
        } else {
            self::updateSession($userRecord['id']);
        }

        return true;
    }

    // Update Cookie for "Remember Me" feature
    public static function updateCookie($id)
    {
        $user = new User();
        $userRecord = $user->getOneUser($id);

        if ($userRecord) {
            $userData = json_encode($userRecord);
            setcookie('user', json_encode($userRecord), time() + (3600 * 24 * 30), '/');

            $_SESSION['user'] = $userRecord; // Also set session for immediate use
        }
    }

    // Update Session
    public static function updateSession($id)
    {
        $user = new User();
        $userRecord = $user->getOneUser($id);

        if ($userRecord) {
            $_SESSION['user'] = $userRecord;
        }
    }

    // Check if user is logged in, either via session or cookie
    public static function checkLogin()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }

        if (isset($_COOKIE['user'])) {
            $_SESSION['user'] = json_decode($_COOKIE['user'], true); // Decode and set to session
            return true;
        }

        return false;
    }

    public static function generateResetToken($email)
    {
        $user = new User();
        $userRecord = $user->getOneUserByEmail($email);

        if (!$userRecord) {
            return false;
        }

        $token = bin2hex(random_bytes(30));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $user->updateResetToken($email, $token, $expires);

        return $token;
    }
    public static function sendResetEmail($email, $otp)
    {

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nguyenquockhai2305@gmail.com';
            $mail->Password = 'bili buhr anik pdtk';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('your_email@gmail.com', 'FRUITIFY');
            $mail->addAddress($email, 'name');

            $mail->CharSet = 'UTF-8';

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'MÃ XÁC NHẬN QUÊN MẬT KHẨU';
            $mail->Body = '
        <div style="font-family: Arial, sans-serif; color: #333;">
            <h1 style="color: #4CAF50;">Xin chào!</h1>
            <p style="font-size: 16px;">Mã OTP của bạn là:</p>
            <p style="font-size: 24px; font-weight: bold; color: #FF5722;">' . $otp . '</p>
            <p style="font-size: 14px; color: #999;">Vui lòng không chia sẻ mã này với bất kỳ ai.</p>
        </div>
    ';
            $mail->AltBody = "Xin chào! Mã OTP của bạn là: $otp. Vui lòng không chia sẻ mã này với bất kỳ ai.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Không thể gửi email: {$mail->ErrorInfo}");
            return false;
        }
    }

    public static function resetPassword($email, $newPassword): bool
    {
        $user = new User();

        // Hash the password here
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        return $user->updatePasswordByEmail($email, $hashedPassword);
    }
    public static function generateOtp($length = 6)
    {
        $characters = '0123456789';
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $otp;
    }
    public static function edit($id): bool
    {

        if (!self::checkLogin()) {
            NotificationHelper::error('Login', 'Vui lòng đăng nhập để xem thông tin');
            return false;
        }
        $data = $_SESSION['user'];
        $user_id = $data['id'];

        if ($user_id != $id) {
            NotificationHelper::error('user_id', 'Không có quyền truy cập');
            return false;
        }
        return true;
    }
    public static function update($id, $data)
    {
        $user = new User();
        $result = $user->updateUser($id, $data);
        if (!$result) {
            // NotificationHelper::error('update_user', 'Cập nhật thông tin tài khoản thất bại');
            return false;
        }
        if ($_SESSION['user']) {
            self::updateSession($id);
        }
        if (isset($_COOKIE['user']) && !empty($_COOKIE['user'])) {
            $user = json_decode($_COOKIE['user'], true);
        } else {
            error_log("Cookie 'user' is not set or empty.");
        }



        // NotificationHelper::success('update_user', 'Cập nhật thông tin tài khoản thành công');
        return true;
    }
    public static function middleware()
    {
        // var_dump($_SERVER['REQUEST_URI']);
        $admin = explode('/', $_SERVER['REQUEST_URI']);
        $admin = $admin[1];
        if ($admin == 'admin') {
            // if(!isset($_SESSION['user'])|| $_SESSION['user']['role'] != 1){
            //     NotificationHelper::error('admin','Tài khoản này không có quyền truy cập');
            //     header('location: /login');
            //     exit;

            // }
            if (!isset($_SESSION['user'])) {
                NotificationHelper::error('admin', 'Vui lòng đăng nhập');
                header('location: /login');
                // exit;
                var_dump($_SESSION['user']); // Thêm dòng này để kiểm tra
                exit;
            }

            if ($_SESSION['user']['role'] != 0) {
                NotificationHelper::error('admin', 'Tài khoản này không có quyền truy cập');
                header('location: /login');
                exit;
            }
        }
    }
}
