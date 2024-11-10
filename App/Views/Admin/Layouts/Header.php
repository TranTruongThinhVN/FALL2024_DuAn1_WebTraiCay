<?php

namespace App\Views\Admin\Layouts;

use App\Views\BaseView;

class Header extends BaseView
{
    public static function render($data = null)
    {

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>CelestialUI Admin</title>
            <!-- base:css -->
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/vendors/typicons.font/font/typicons.css">
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/vendors/css/vendor.bundle.base.css">

            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/css/vertical-layout-light/style.css">
            <!-- endinject -->
            <link rel="shortcut icon" href="<?= APP_URL ?>images/favicon.png" />
        </head>

        <body>

            <div class="row" id="proBanner">
                <div class="col-12">
                    <span class="d-flex align-items-center purchase-popup">
                        <!-- <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p> -->
                        <!-- <a href="https://www.bootstrapdash.com/product/celestial-admin-template/?utm_source=organic&utm_medium=banner&utm_campaign=free-preview" target="_blank" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a> -->
                        <i class="typcn typcn-delete-outline" id="bannerClose"></i>
                    </span>
                </div>
            </div>

    <?php

    }
}

    ?>