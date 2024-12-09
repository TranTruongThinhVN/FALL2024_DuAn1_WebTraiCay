<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Product extends BaseView
{
  public static function truncateString($string, $maxLength = 3)
  {
    if (mb_strlen($string, 'UTF-8') > $maxLength) {
      return mb_substr($string, 0, $maxLength, 'UTF-8') . '...';
    } else {
      return $string;
    }
  }

  public static function render($data = null)
  {

?>

    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">QUẢN LÝ SẢN PHẨM</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-0">Danh sách sản phẩm</h5>
                <div class="card-filter mb-3 mt-3">
                  <div class="row g-3">
                    <div class="col-lg-8 col-md-12">
                      <form class="row g-2" method="GET" action="/admin/product">
                        <div class="col-md-3">
                          <select class="form-select" name="category_id">
                            <option value="">Tất cả danh mục</option>
                            <?php foreach ($data['categories'] as $category): ?>
                              <option value="<?= $category['id'] ?>" <?= isset($_GET['category_id']) && $_GET['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <select class="form-select" name="status">
                            <option value="">Tất cả trạng thái</option>
                            <option value="1" <?= isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : '' ?>>Còn hàng</option>
                            <option value="0" <?= isset($_GET['status']) && $_GET['status'] == '0' ? 'selected' : '' ?>>Hết hàng</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <button class="btn btn-primary w-100" type="submit">Lọc</button>
                        </div>
                      </form>
                    </div>

                    <div class="col-lg-4 col-md-12">
                      <form class="d-flex" method="GET" action="/admin/product">
                        <div class="input-group">
                          <input class="form-control" type="search" name="search" placeholder="Nhập tên sản phẩm ..." aria-label="Search" value="<?= htmlspecialchars($data['keyword'] ?? '', ENT_QUOTES) ?>">
                          <button class="btn btn-success" type="submit">Tìm kiếm</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>


              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Ảnh</th>
                      <th>Tên sản phẩm</th>
                      <th>Danh mục</th>
                      <th>Giá</th>
                      <th>Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($data['products'])): ?>
                      <tr>
                        <td colspan="8" class="text-center">Không tìm thấy sản phẩm nào</td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($data['products'] as $product): ?>
                        <tr>
                          <td>
                            <img style="width: 80px; height:80px; object-fit:cover;" src="/public/uploads/products/<?= htmlspecialchars($product['image']) ?>" alt="Ảnh sản phẩm" style="width: 60px; height: 60px;">
                          </td>
                          <td>
                            <!-- Tên sản phẩm -->
                            <div class="product-info">
                              <div><strong><?= htmlspecialchars($product['name']) ?></strong></div>

                              <!-- Hiển thị ID, nút Sửa và Xóa -->
                              <div class="d-flex align-items-center gap-2 mt-1">
                                <small class="text-muted">ID: <?= htmlspecialchars($product['id']) ?></small>
                                |
                                <a href="/admin/edit-product/<?= $product['id'] ?>" class="text-warning">Sửa</a>
                                |
                                <form action="/admin/delete-product/<?= $product['id'] ?>" method="POST" style="display: inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');">
                                  <input type="hidden" name="method" id="" value="DELETE">
                                  <button type="submit" class="btn text-danger p-0">Xóa</button>
                                </form>
                              </div>
                            </div>
                          </td>

                          <td><?= htmlspecialchars($product['category_name']) ?></td>

                          <td><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</td>
                          <td>
                            <?php if ($product['status'] == 1): ?>
                              <span class="badge bg-success">Còn hàng</span>
                            <?php else: ?>
                              <span class="badge bg-danger">Hết hàng</span>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <?php if ($data['totalPages'] > 1): ?>
                <div class="pagination-container">
                  <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <!-- Nút Trang trước -->
                      <?php if ($data['currentPage'] > 1): ?>
                        <li class="page-item">
                          <a class="page-link" href="?page=<?= $data['currentPage'] - 1 ?>">Trước</a>
                        </li>
                      <?php endif; ?>

                      <!-- Các trang -->
                      <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                        <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                      <?php endfor; ?>

                      <!-- Nút Trang sau -->
                      <?php if ($data['currentPage'] < $data['totalPages']): ?>
                        <li class="page-item">
                          <a class="page-link" href="?page=<?= $data['currentPage'] + 1 ?>">Tiếp</a>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </nav>
                </div>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>



    </div>

<?php

  }
}

?>

<style>
  .thumbnail-popup {
    position: absolute;
    background: #fff;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .thumbnail-popup img {
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .thumbnail-popup img:hover {
    transform: scale(1.1);
  }
</style>
<script>
  function showThumbnails(productId) {
    const thumbnails = document.getElementById(`thumbnails-${productId}`);
    if (thumbnails.style.display === "none" || thumbnails.style.display === "") {
      thumbnails.style.display = "flex";
    } else {
      thumbnails.style.display = "none";
    }
  }
</script>
<script>
  function showDescriptionModal(productId) {
    // Lấy mô tả từ bảng bằng ID
    const descriptionContent = document.querySelector(`#description-${productId}`).textContent;

    // Hiển thị nội dung vào modal
    document.getElementById('modalDescriptionContent').textContent = descriptionContent;

    // Hiển thị modal
    document.getElementById('descriptionModal').style.display = 'flex';
  }

  function closeModal() {
    // Ẩn modal
    document.getElementById('descriptionModal').style.display = 'none';
  }
</script>
<div id="descriptionModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mô tả sản phẩm</h5>
        <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="modalDescriptionContent">Nội dung mô tả sẽ được hiển thị ở đây.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Đóng</button>
      </div>
    </div>
  </div>
</div>