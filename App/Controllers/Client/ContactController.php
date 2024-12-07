<?php

namespace App\Controllers\Client;

use App\Helpers\ContactHelper;
use App\Helpers\NotificationHelper;
use App\Models\Client\Contact as ClientContact;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Contact\Contact;

class ContactController
{
    // hiển thị danh sách
    public static function index()
    {
        Header::render();
        Contact::render();
        Footer::render();
    }

    public static function sendContactAction()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $message = $_POST['message'] ?? '';
        $token = $_POST['g-recaptcha-response'] ?? '';

        // Validate dữ liệu
        if (empty($name) || empty($email) || empty($phone) || empty($message)) {
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin.']);
            return;
        }

        // Kiểm tra reCAPTCHA
        if (!ContactHelper::verifyRecaptcha($token)) {
            echo json_encode(['status' => 'error', 'message' => 'Xác minh reCAPTCHA thất bại.']);
            return;
        }

        // Gửi email tới admin
        $emailSuccess = ContactHelper::sendContactToAdmin($name, $email, $phone, $message);

        // Lưu liên hệ vào cơ sở dữ liệu
        $contact = new \App\Models\Client\Contact();
        $contactData = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
        ];
        $dbSuccess = $contact->createContact($contactData);

        if ($emailSuccess && $dbSuccess) {
            echo json_encode(['status' => 'success', 'message' => 'Liên hệ của bạn đã được gửi thành công.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra khi gửi liên hệ.']);
        }
    }
}
