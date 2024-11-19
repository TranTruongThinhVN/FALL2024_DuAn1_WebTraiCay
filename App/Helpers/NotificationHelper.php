<?php

namespace App\Helpers;

class NotificationHelper
{
    public static function success($key, $message)
    {
        if (!isset($_SESSION['success']) || !is_array($_SESSION['success'])) {
            $_SESSION['success'] = [];
        }
        $_SESSION['success'][$key] = $message;
    }

    public static function error($key, $message)
    {
        if (!isset($_SESSION['error']) || !is_array($_SESSION['error'])) {
            $_SESSION['error'] = [];
        }
        $_SESSION['error'][$key] = $message;
    }

    public static function confirm($key, $title, $message, $confirmText = 'Đúng rồi, xóa nó đi!', $cancelText = 'Hủy bỏ')
    {
        if (!isset($_SESSION['confirm']) || !is_array($_SESSION['confirm'])) {
            $_SESSION['confirm'] = [];
        }
        $_SESSION['confirm'][$key] = [
            'title' => $title,
            'message' => $message,
            'confirmText' => $confirmText,
            'cancelText' => $cancelText,
        ];
    }

    public static function tripleOption($key, $title, $confirmText = 'Lưu', $denyText = 'Không lưu', $cancelText = 'Hủy bỏ')
    {
        if (!isset($_SESSION['triple_option']) || !is_array($_SESSION['triple_option'])) {
            $_SESSION['triple_option'] = [];
        }
        $_SESSION['triple_option'][$key] = [
            'title' => $title,
            'confirmText' => $confirmText,
            'denyText' => $denyText,
            'cancelText' => $cancelText,
        ];
    }

    public static function unset()
    {
        unset($_SESSION['success']);
        unset($_SESSION['error']);
        unset($_SESSION['confirm']);
        unset($_SESSION['triple_option']);
    }
}
