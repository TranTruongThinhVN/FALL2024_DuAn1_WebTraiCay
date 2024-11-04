<?php

namespace App\Views\Client\Layouts;

use App\Views\BaseView;

class Footer extends BaseView
{
    public static function render($data = null)
    {
?>

        <footer class="footer">Footer</footer>

        <script src="<?= APP_URL ?>App/Styles/vendors/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

        </body>

        </html>


<?php

        // unset($_SESSION['success']);
        // unset($_SESSION['error']);
    }
}

?>