<?php

namespace App\Views\Admin\Components;

use App\Views\BaseView;

class Notification extends BaseView
{
    public static function render($data = null)
    {
        if (isset($_SESSION['success']) && is_array($_SESSION['success'])) :
            foreach ($_SESSION['success'] as $key => $value) :
?>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: '<?= addslashes($value) ?>',
                            confirmButtonText: 'Ok'
                        });
                    });
                </script>
            <?php
            endforeach;
            unset($_SESSION['success']);
        endif;

        if (isset($_SESSION['error']) && is_array($_SESSION['error'])) :
            foreach ($_SESSION['error'] as $key => $value) :
            ?>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: '<?= addslashes($value) ?>',
                            confirmButtonText: 'Đóng'
                        });
                    });
                </script>
            <?php
            endforeach;
            unset($_SESSION['error']);
        endif;

        if (isset($_SESSION['confirm']) && is_array($_SESSION['confirm'])) :
            foreach ($_SESSION['confirm'] as $key => $confirm) :
            ?>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            title: '<?= addslashes($confirm['title']) ?>',
                            text: '<?= addslashes($confirm['message']) ?>',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<?= addslashes($confirm['confirmText']) ?>',
                            cancelButtonText: '<?= addslashes($confirm['cancelText']) ?>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Tự động gửi form xóa
                                const form = document.getElementById('deleteForm<?= $key ?>');
                                if (form) form.submit();
                            }
                        });
                    });
                </script>
            <?php
            endforeach;
            unset($_SESSION['confirm']);
        endif;

        if (isset($_SESSION['triple_option']) && is_array($_SESSION['triple_option'])) :
            foreach ($_SESSION['triple_option'] as $key => $option) :
            ?>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            title: '<?= addslashes($option['title']) ?>',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: '<?= addslashes($option['confirmText']) ?>',
                            denyButtonText: '<?= addslashes($option['denyText']) ?>',
                            cancelButtonText: '<?= addslashes($option['cancelText']) ?>',
                            customClass: {
                                confirmButton: 'btn btn-primary',
                                denyButton: 'btn btn-danger',
                                cancelButton: 'btn btn-secondary'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire('Đã lưu!', '', 'success');
                            } else if (result.isDenied) {
                                Swal.fire('Thay đổi không được lưu.', '', 'info');
                            }
                        });
                    });
                </script>
<?php
            endforeach;
            unset($_SESSION['triple_option']);
        endif;
    }
}
