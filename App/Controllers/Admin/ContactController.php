<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Admin\Contact;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Contact\Index;
use App\Views\Admin\Pages\Contact\ListContact;

class ContactController
{
    // Hiển thị danh sách liên hệ
    public static function index()
    {
        $contactModel = new Contact();
        $status = $_GET['status'] ?? null; // Lọc theo trạng thái
        $search = $_GET['search'] ?? null; // Lấy từ khóa tìm kiếm
        $contacts = $contactModel->getAllContacts($search); // Lấy danh sách liên hệ từ model

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        ListContact::render(['contacts' => $contacts, 'search' => $search]); // Gửi dữ liệu qua view
        Footer::render();
    }
    // Cập nhật trạng thái liên hệ
    public static function update($id)
    {
        $status = $_POST['status'] ?? null;

        if ($status === null) {
            header('location: /admin/contact');
            exit;
        }

        $contact = new Contact();
        $result = $contact->updateContactStatus($id, $status);

        if ($result) {
            header('location: /admin/contact');
        } else {
            echo "Lỗi: Không thể cập nhật trạng thái liên hệ.";
        }
    }
    // Xóa liên hệ
    public static function delete($id)
    {
        $contactModel = new Contact();
        $result = $contactModel->deleteContact($id); // Xóa liên hệ từ model

        if ($result) {
            NotificationHelper::success('Thành công!', 'Xóa liên hệ thành công.');
        } else {
            NotificationHelper::error('Thất bại!', 'Không thể xóa liên hệ.');
        }

        header('Location: /admin/contact');
        exit;
    }
    public static function replyEmail($id)
    {
        error_log("Received ID: " . $id);
        $contactModel = new Contact();
        $contact = $contactModel->getOneContact($id);

        if (!$contact) {
            error_log("Contact not found for ID: " . $id);
            echo "Không tìm thấy liên hệ.";
            exit;
        }

        $email = $contact['email'];
        $name = $contact['name'];
        $replyMessage = $_POST['reply_message'] ?? '';

        if (empty($replyMessage)) {
            error_log("Reply message is empty");
            echo "Phản hồi không được để trống.";
            exit;
        }

        if (self::sendReplyEmail($email, $name, $replyMessage)) {
            error_log("Email sent to: " . $email);
            echo "Email phản hồi đã được gửi!";
        } else {
            error_log("Failed to send email to: " . $email);
            echo "Gửi email thất bại!";
        }

        header('Location: /admin/contacts');
    }



    private static function sendReplyEmail($email, $name, $replyMessage)
    {
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "nguyenquockhai2305@gmail.com"; // Địa chỉ email của bạn
            $mail->Password = "bili buhr anik pdtk"; // Mật khẩu ứng dụng
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('nguyenquockhai2305@gmail.com', 'Hỗ trợ khách hàng');
            $mail->addAddress($email, $name);

            // Đảm bảo mã hóa UTF-8
            $mail->CharSet = 'UTF-8';

            // Tiêu đề email
            $subject = "Phản hồi từ Hệ thống liên hệ";
            $mail->Subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

            // Nội dung email
            $mail->isHTML(true);
            $mail->Body = "
                <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 10px; overflow: hidden;'>
                    <div style='background-color: #007bff; color: white; padding: 20px; text-align: center;'>
                        <h2 style='margin: 0; font-size: 22px;'>Phản hồi từ ý kiến của bạn</h2>
                    </div>
                    <div style='padding: 20px;'>
                        <p style='font-size: 16px;'>Chào <strong>{$name}</strong>,</p>
                        <p style='font-size: 16px;'>Cảm ơn bạn đã liên hệ với chúng tôi. Đây là phản hồi từ đội ngũ hỗ trợ:</p>
                        <blockquote style='border-left: 4px solid #007bff; padding-left: 10px; margin-left: 0; color: #555; font-style: italic;'>
                            {$replyMessage}
                        </blockquote>
                        <p style='font-size: 16px;'>Nếu bạn có bất kỳ câu hỏi nào khác, vui lòng trả lời email này hoặc liên hệ qua số điện thoại <a href='tel:19001234' style='color: #007bff; text-decoration: none;'>1900 1234</a>.</p>
                    </div>
                    <div style='background-color: #f9f9f9; padding: 15px; text-align: center; border-top: 1px solid #ddd;'>
                        <p style='font-size: 14px; color: #666;'>Trân trọng,<br>Đội ngũ hỗ trợ khách hàng</p>
                        <p style='font-size: 12px; color: #aaa;'>Email này được gửi tự động, vui lòng không trả lời trực tiếp.</p>
                    </div>
                </div>";

            $mail->send();
            return true;
        } catch (\Exception $e) {
            error_log('Lỗi khi gửi email: ' . $mail->ErrorInfo);
            return false;
        }
    }
}
