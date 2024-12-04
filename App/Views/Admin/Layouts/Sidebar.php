<?php

namespace App\Views\Admin\Layouts;

use App\Views\BaseView;

class Sidebar extends BaseView
{
  public static function render($data = null)
  {

?>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <div class="d-flex sidebar-profile">
            <div class="sidebar-profile-image">
              <img src="<?= APP_URL ?>/public/assets/client/images/home/logo (1).png" alt="image">
              <span class="sidebar-status-indicator"></span>
            </div>
            <div class="sidebar-profile-name">
              <p class="sidebar-name">
                Admin
              </p>
              <p class="sidebar-designation">
                Xin chào
              </p>
            </div>
          </div>
          <div class="nav-search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
              <div class="input-group-append">
                <span class="input-group-text" id="search">
                  <i class="typcn typcn-zoom"></i>
                </span>
              </div>
            </div>
          </div>
          <p class="sidebar-menu-title">Dash menu</p>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin">
            <i class="typcn typcn-device-desktop menu-icon"></i>
            <span class="menu-title">Trang Chủ<span class="badge badge-primary ml-3">New</span></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="typcn typcn-briefcase menu-icon"></i>
            <span class="menu-title">UI Elements</span>
            <i class="typcn typcn-chevron-right menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="typcn typcn-film menu-icon"></i>
            <span class="menu-title">Sản phẩm</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="/admin/add-product">Thêm sản phẩm</a></li>
              <li class="nav-item"><a class="nav-link" href="/admin/product">Danh sách sản phẩm</a></li>
              <li class="nav-item"><a class="nav-link" href="">Tất cả danh mục</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
            <i class="typcn typcn-chart-pie-outline menu-icon"></i>
            <span class="menu-title">Charts</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="charts">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
            <i class="typcn typcn-th-small-outline menu-icon"></i>
            <span class="menu-title">Tables</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/documentation/documentation.html">
            <i class="typcn typcn-document-text menu-icon"></i>
            <span class="menu-title">Documentation</span>
          </a>
        </li>
      </ul>
      <ul class="sidebar-legend">
        <li>
          <p class="sidebar-menu-title">Category</p>
        </li>
        <li class="nav-item"><a href="#" class="nav-link">#Sales</a></li>
        <li class="nav-item"><a href="#" class="nav-link">#Marketing</a></li>
        <li class="nav-item"><a href="#" class="nav-link">#Growth</a></li>
      </ul>
    </nav>

<?php

  }
}

?>