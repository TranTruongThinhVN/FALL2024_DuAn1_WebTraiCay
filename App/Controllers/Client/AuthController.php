<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\Validations\AuthValidation;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Auth\Edit_profile;
use App\Views\Client\Pages\Auth\Forgot_password;
use App\Views\Client\Pages\Auth\Login;
use App\Views\Client\Pages\Auth\Purchase_history;
use App\Views\Client\Pages\Auth\register;
use App\Views\Client\Pages\Auth\Reset_password;
use App\Views\Client\Pages\Auth\verify_otp;
use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;


class AuthController
{

    public static function register()
    {
        Register::render();
        Footer::render();
        unset($_SESSION['old']);
    }

    public static function registerAction()
    {

        $_SESSION['old'] = $_POST;
        $is_valid = AuthValidation::register();
        if (!$is_valid) {
            // NotificationHelper::error('register_valid', 'Đăng ký thất bại');
            header('location: /register');
            exit();
        }
        // Lấy ở form từ người dùng nhập vào
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);



        // đưa dữ liệu vào mảng lấy ở cột csdl
        // khúc này là bên basemodel nè lấy ra, tức là $data như basemodel là lặp qa từng data lấy ra cái key và value tương ứng 'email' => $email,
        $data = [
            'email' => $email,
            'password' => $hash_password,

        ];

        // $user = new User();
        // $result = $user->createUser($data);
        $result = AuthHelper::register($data);

        if ($result) {
            //     echo "
            //     <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            //     <script>
            //         document.addEventListener('DOMContentLoaded', function() {
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Đăng ký thành công!',
            //                 text: 'Bạn sẽ được chuyển hướng đến trang đăng nhập sau 3 giây.',
            //                 timer: 3000,
            //                 timerProgressBar: true,
            //                 willClose: () => {
            //                     window.location.href = '/login';
            //                 }
            //             });
            //         });
            //     </script>
            // ";
            NotificationHelper::success('ff', 'ffff');
            Header('location: /login');
        } else {
            header('Location: /register');
            exit();
        }
    }
    public static function login()
    {
        Notification::render();
        NotificationHelper::unset();
        Login::render();
        Footer::render();
    }
    public static function loginAction()
    {
        // Validate login inputs
        $is_valid = AuthValidation::login();
        if (!$is_valid) {
            $_SESSION['errors']['login'] = 'Đăng nhập thất bại';
            header('location: /login');
            exit();
        }

        // Process login
        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'remember' => isset($_POST['remember'])
        ];

        $result = AuthHelper::login($data);
        if ($result) {
            // If login is successful, redirect to home or dashboard, not login page
            header('location: /'); // Replace /home with the appropriate URL for your logged-in page
            exit();
        } else {
            $_SESSION['errors']['general'] = 'Email hoặc mật khẩu không đúng.';
            header('location: /login');
            exit();
        }
    }
    public static function logout()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        session_unset();
        session_destroy();


        if (isset($_COOKIE['user'])) {
            setcookie('user', '', time() - 3600, '/'); // Expire the cookie
        }

        $_SESSION['success'][] = 'Bạn đã đăng nhập thành công!';
        header("Location: /");
        exit();
    }
    public static function edit($id)
    {
        $result = AuthHelper::edit($id);
        if (!$result) {
            if (isset($_SESSION['error']['login'])) {
                header('location: /login');
                exit;
            }
            if (isset($_SESSION['error']['user_id'])) {
                $data = $_SESSION['user'];
                $user_id = $data['id'];
                header('location: /users/edit/$user_id');
                exit;
            }
        }
        $data = $_SESSION['user'];
        Header::render();
        Edit_profile::render($data);
        Footer::render();
    }
    public static function update($id)
    {
        // Lấy dữ liệu người dùng (chỉ lấy các trường có giá trị)
        $data = array_filter([
            'name' => $_POST['name'] ?? null,
            'phone' => $_POST['phone'] ?? null,
            'gender' => $_POST['gender'] ?? null,
        ]);

        // Kiểm tra nếu có file avatar được upload
        if (isset($_FILES['avatar']['tmp_name']) && !empty($_FILES['avatar']['tmp_name']) && file_exists($_FILES['avatar']['tmp_name'])) {
            $is_upload = AuthValidation::uploadAvatar();
            if ($is_upload !== false) {
                $data['avatar'] = $is_upload; // Thêm avatar vào mảng $data
            } else {
                $_SESSION['errors']['avatar'] = 'Lỗi khi tải lên avatar.';
                header("location: /users/$id");
                exit();
            }
        }



        // Cập nhật thông tin người dùng
        $result = AuthHelper::update($id, $data);
        if ($result) {
            $_SESSION['success'] = 'Cập nhật thông tin thành công.';
        } else {
            $_SESSION['errors']['update'] = 'Cập nhật thông tin thất bại.';
        }

        // Chuyển hướng lại trang chỉnh sửa
        header("location: /users/$id");
        exit();
    }

    public static function showPurchaseHistory()
    {
        Header::render();
        Purchase_history::render();
        Footer::render();
    }
    public static function forgotPassword()
    {
        Forgot_password::render();
        Footer::render();
    }
    public static function forgotPasswordAction()
    {
        $email = $_POST['email'] ?? '';

        // Kiểm tra email
        if (empty($email)) {
            $_SESSION['errors']['email'] = 'Email không được để trống';
            header('Location: /forgot-password');
            exit();
        }

        // Kiểm tra định dạng email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'Email không hợp lệ';
            header('Location: /forgot-password');
            exit();
        }

        // Tạo token reset
        $token = AuthHelper::generateResetToken($email);

        if (!$token) {
            $_SESSION['errors']['email'] = 'Email không tồn tại trong hệ thống.';
            header('Location: /forgot-password');
            exit();
        }
        // Generate OTP
        $otp = AuthHelper::generateOtp(6);
        $_SESSION['otp'] = $otp;
        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_token'] = $token;

        // Send email with OTP
        $sent = AuthHelper::sendResetEmail($email, $otp);

        // Chuyển hướng tới trang xác thực OTP sau khi gửi email thành công
        if ($sent) {
            $_SESSION['success'] = 'Đã gửi liên kết đặt lại mật khẩu tới email của bạn.';
            header('Location: /verify-otp');
        } else {
            $_SESSION['errors']['email'] = 'Không thể gửi email. Vui lòng thử lại sau.';
            header('Location: /forgot-password');
        }
        exit();
    }


    public static function resetPassword()
    {
        Reset_password::render();
        Footer::render();
    }

    public static function resetPasswordAction()
    {
        $email = $_SESSION['reset_email'] ?? '';
        $token = $_SESSION['reset_token'] ?? '';
        if (!$email || !$token) {
            $_SESSION['error'] = 'Yêu cầu không hợp lệ hoặc đã hết hạn.';
            header('Location: /forgot-password');
            exit();
        }

        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Kiểm tra mật khẩu
        if (empty($newPassword) || $newPassword !== $confirmPassword) {
            $_SESSION['errors']['password'] = 'Mật khẩu không khớp hoặc không hợp lệ.';
            header('Location: /reset-password');
            exit();
        }

        // $hashPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // $hashPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $result = AuthHelper::resetPassword($email, $newPassword);


        if ($result) {
            $_SESSION['success'] = 'Đặt lại mật khẩu thành công!';
            header('Location: /login');
        } else {
            $_SESSION['error'] = 'Đặt lại mật khẩu thất bại.';
            header('Location: /reset-password');
        }
        exit();
    }
    public static function verifyOtp()
    {
        verify_otp::render();
    }
    public static function verifyOtpAction()
    {
        $enteredOtp = $_POST['otp'] ?? '';
        $sessionOtp = $_SESSION['otp'] ?? null; // OTP được lưu trong session khi gửi email

        if (!$sessionOtp || $enteredOtp !== $sessionOtp) {
            $_SESSION['errors']['otp'] = 'Mã OTP không hợp lệ hoặc đã hết hạn.';
            header('Location: /verify-otp');
            exit();
        }

        // OTP đúng => Chuyển sang trang đặt lại mật khẩu
        $_SESSION['otp_verified'] = true;
        header('Location: /reset-password');
        exit();
    }
    // google
    public function googleLogin(): void
    {
        $client = new \Google\Client();
        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
        $client->addScope('email');
        $client->addScope('profile');

        $authUrl = $client->createAuthUrl();
        header('Location: ' . $authUrl);
        exit();
    }



    public function googleCallback()
    {
        $client = new Google_Client();
        $client->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));

        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);

            $oAuth = new \Google\Service\Oauth2($client);
            $userInfo = $oAuth->userinfo->get();

            // Lưu thông tin user vào session
            $_SESSION['user'] = [
                'google_id' => $userInfo->id,
                'name' => $userInfo->name,
                'email' => $userInfo->email,
            ];

            // Redirect về trang chính
            header('Location: /');
            exit();
        } else {
            echo "Lỗi: Không nhận được mã xác thực từ Google.";
            exit();
        }
    }
}
