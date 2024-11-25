document.addEventListener("DOMContentLoaded", function () {
  const nameInput = document.getElementById("name");
  const statusInput = document.getElementById("status");
  const form = document.querySelector("form");

  // Hàm hiển thị lỗi
  function showError(input, message) {
      const parent = input.parentElement;
      let error = parent.querySelector(".text-danger");

      if (!error) {
          error = document.createElement("small");
          error.className = "text-danger";
          error.style.color = "red";
          error.style.fontWeight = "bold";
          parent.appendChild(error);
      }
      error.textContent = message;

      if (message) {
          input.style.border = "2px solid red";
          input.style.borderRadius = "4px";
      } else {
          input.style.border = ""; // Xóa viền đỏ nếu không có lỗi
      }
  }

  // Xử lý sự kiện nhập liệu cho trường name
  nameInput.addEventListener("input", function () {
      const name = nameInput.value.trim();

      if (!name) {
          showError(nameInput, "Tên danh mục không được để trống.");
      } else if (name.length < 3) {
          showError(nameInput, "Tên danh mục phải có ít nhất 3 ký tự.");
      } else {
          showError(nameInput, ""); // Không có lỗi
      }
  });

  // Xử lý sự kiện thay đổi trạng thái
  statusInput.addEventListener("change", function () {
      const status = statusInput.value;

      if (!status) {
          showError(statusInput, "Vui lòng chọn trạng thái.");
      } else {
          showError(statusInput, ""); // Không có lỗi
      }
  });

  // Xử lý khi gửi form
  form.addEventListener("submit", function (event) {
      let isValid = true;

      const name = nameInput.value.trim();
      const status = statusInput.value;

      if (!name) {
          showError(nameInput, "Tên danh mục không được để trống.");
          isValid = false;
      } else if (name.length < 3) {
          showError(nameInput, "Tên danh mục phải có ít nhất 3 ký tự.");
          isValid = false;
      }

      if (!status) {
          showError(statusInput, "Vui lòng chọn trạng thái.");
          isValid = false;
      }

      if (!isValid) {
          event.preventDefault();
      }
  });
});
