<?php

namespace App\Views\Admin\Pages\Recipe;

use App\Views\BaseView;

class Index extends BaseView
{
  public static function render($data = null)
  {
?>
    <style>
      #customModal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
      }

      #modalContent {
        background: white;
        padding: 20px;
        border-radius: 8px;
        max-width: 600px;
        width: 90%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        text-align: left;
        position: relative;
      }

      #modalBody {
        font-size: 16px;
        line-height: 1.6;
        overflow-y: auto;
        max-height: 400px;
        word-wrap: break-word;
        font-family: 'Arial', sans-serif;
        color: #333;
        padding: 10px;
      }

      #modalContent h3 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #555;
      }

      #closeModal {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
        color: #888;
        font-weight: bold;
      }

      #closeModal:hover {
        color: #555;
      }
    </style>
    <style>
      .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 10px;
      }

      .pagination a {
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        color: #333;
      }

      .pagination a.active {
        background-color: #14532D;
        color: #fff;
        border-color: #14532D;
      }
    </style>

    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">QUẢN LÝ LOẠI SẢN PHẨM</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Danh sách công thức</li>
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
              <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Danh sách Công thức</h5>
                <a href="/admin/add_recipe" class="btn btn-primary">Thêm công thức</a>
              </div>
              <div class="card-filter d-flex" style="gap: 16px; margin-top: -15px ; margin-left: 10px ; margin-bottom: 10px ;">
                <form class="d-flex" method="GET" action="/admin/recipe">
                  <input class="form-control me-2" type="search" name="search" placeholder="Tìm danh mục..." aria-label="Search" value="<?= $_GET['search'] ?? '' ?>">
                  <button class="btn btn-success" type="submit">Tìm</button>
                </form>
                <form class="d-flex" method="GET" action="/admin/recipe">
                  <select class="form-control me-2" name="category">
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($data['categories'] as $category): ?>
                      <option value="<?= $category['id'] ?>" <?= (isset($_GET['category']) && $_GET['category'] == $category['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <button class="btn btn-success" type="submit">Lọc</button>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th style="font-weight: bold;" scope="col">Id</th>

                      <th style="font-weight: bold;" scope="col">Tiêu đề</th>
                      <th style="font-weight: bold;" scope="col">Hình ảnh</th>
                      <th style="font-weight: bold;" scope="col">Danh mục</th>
                      <th style="font-weight: bold;" scope="col">Nguyên liệu</th>
                      <th style="font-weight: bold;" scope="col">Hướng dẫn</th>

                      <th style="font-weight: bold;" scope="col">Ngày thêm</th>
                      <th style="font-weight: bold;" scope="col">Trạng thái</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody class="customtable">
                    <?php if (count($data['recipes'])) : ?>
                      <?php foreach ($data['recipes'] as $recipe) : ?>
                        <tr>
                          <td><?= htmlspecialchars($recipe['id']) ?></td>
                          <td><?= htmlspecialchars($recipe['title']) ?></td>
                          <td><img src="<?= htmlspecialchars($recipe['image_url']) ?>" alt="Image" style="width: 100px;"></td>
                          <td><?= htmlspecialchars($recipe['category_name']) ?></td>
                          <td>
                            <button class="btn btn-info btn-sm btn-view" data-content="<?= $recipe["ingredients"] ?>">
                              Xem
                            </button>

                          </td>

                          <td>
                            <button class="btn btn-info btn-sm btn-view" data-content="<?= $recipe["instructions"] ?>">
                              Xem
                            </button>
                          </td>

                          <td><?= $recipe['created_at'] ?></td>
                          <td><?= $recipe['status'] == 1 ? 'Hiển thị' : 'Ẩn' ?></td>

                          <td>
                            <a href="/admin/update_recipe/<?= $recipe['id'] ?>">
                              <label class="badge bg-warning">Chỉnh sửa</label>
                            </a>
                            <form action="/admin/recipe/<?= $recipe['id'] ?>" method="post" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa Danh mục này không?')">
                              <input type="hidden" name="method" value="DELETE">
                              <button style="margin: 0; padding: 3.5px; border: 0;" type="submit" class="badge bg-danger">Xoá</button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="10" style="text-align: center; padding: 20px; font-weight: bold; color: #888;">
                          Không tìm thấy kết quả phù hợp.
                        </td>
                      </tr>
                    <?php endif; ?>


                  </tbody>
                  <div id="customModal" style="display: none;">
                    <div id="modalContent">
                      <span class="close-btn">&times;</span>
                      <div id="modalBody"></div>
                    </div>
                  </div>

                </table>
              </div>


            </div>
          </div>
        </div>
        <?php if (isset($data['pagination'])): ?>
          <div class="pagination">
            <?php
            $totalPages = ceil($data['pagination']['total'] / $data['pagination']['perPage']);
            $currentPage = $data['pagination']['currentPage'];

            for ($i = 1; $i <= $totalPages; $i++): ?>
              <a href="?page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>">
                <?= $i ?>
              </a>
            <?php endfor; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
    <script src="<?= APP_URL ?>/public/assets/admin/dist/js/categoryValidation.js">
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('customModal');
        const modalContent = document.getElementById('modalContent');
        const closeBtn = document.querySelector('.close-btn');
        const modalBody = document.getElementById('modalBody');

        // Hàm mở modal
        const openModal = (content, ) => {
          modalBody.innerHTML = `</h3><p>${content}</p>`;
          modal.style.display = 'flex'; // Hiện modal
        };

        // Hàm đóng modal
        const closeModal = () => {
          modal.style.display = 'none'; // Ẩn modal
        };

        // Đóng modal khi nhấn nút "X"
        closeBtn.addEventListener('click', closeModal);

        // Đóng modal khi nhấn ra ngoài modal
        window.addEventListener('click', (event) => {
          if (event.target === modal) {
            closeModal();
          }
        });

        // Lắng nghe sự kiện nhấn nút "Xem"
        document.querySelectorAll('.btn-view').forEach((button) => {
          button.addEventListener('click', function() {
            const content = this.dataset.content; // Lấy nội dung từ thuộc tính data-content
            const title = this.dataset.title; // Lấy tiêu đề từ thuộc tính data-title
            openModal(content, title);
          });
        });
      });
    </script>

<?php
  }
}
