<?php

namespace App\Views\Admin\Layouts;

use App\Views\BaseView;

class Footer extends BaseView
{
  public static function render($data = null)
  {

?>
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com</a> 2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard </a>templates from Bootstrapdash.com</span>
      </div>
    </footer>
    <!-- partial -->
    </ddi
      </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="public/assets/admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="public/assets/admin/js/off-canvas.js"></script>
    <script src="public/assets/admin/js/hoverable-collapse.js"></script>
    <script src="public/assets/admin/js/template.js"></script>
    <script src="public/assets/admin/js/settings.js"></script>
    <script src="public/assets/admin/js/todolist.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="public/assets/admin/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="public/assets/admin/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="public/assets/admin/js/dashboard.js"></script>
    <!-- End custom js for this page-->

    </body>

    </html>
<?php
  }
}

?>