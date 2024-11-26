document.addEventListener("DOMContentLoaded", function () {
  // Select form fields
  const name = document.getElementById("name");
  const description = document.getElementById("description");
  const status = document.getElementById("status");
  const form = document.querySelector("form");

  // Add CSS for error-border if not already defined
  const style = document.createElement("style");
  style.innerHTML = `
     .error-border {
        border: 1px solid red !important;
   }
   .error-message {
   font-size: 0.9rem;
 margin-top: 4px;
   display: block;
 }
  `;
  document.head.appendChild(style);

  // Function to show error
  function showError(input, message) {
    const parent = input.parentElement;

    // Remove existing error
    let error = parent.querySelector(".error-message");
    if (error) {
      error.remove();
    }

    // Add new error message if needed
    if (message) {
      error = document.createElement("span");
      error.className = "error-message text-danger";
      error.textContent = message;
      parent.appendChild(error);

      // Add red border
      input.classList.add("error-border");
    } else {
      // Remove red border and error message
      input.classList.remove("error-border");
    }
  }

  // Validate individual fields
  function validateField(input, message) {
    if (!input.value.trim()) {
      showError(input, message);
      return false;
    } else {
      showError(input, ""); // Clear error
      return true;
    }
  }

  // Validate all fields on form submission
  form.addEventListener("submit", function (event) {
    let isValid = true;

    // Validate name field
    if (!validateField(name, "Tên danh mục không được để trống.")) {
      isValid = false;
    }

    // Validate description field
    if (!validateField(description, "Mô tả không được để trống.")) {
      isValid = false;
    }

    // Validate status field
    if (!validateField(status, "Vui lòng chọn trạng thái.")) {
      isValid = false;
    }

    // If any validation fails, prevent form submission
    if (!isValid) {
      event.preventDefault();
    }
  });

  // Add input event listeners to clear errors on change
  name.addEventListener("input", function () {
    validateField(name, "Tên danh mục không được để trống.");
  });

  description.addEventListener("input", function () {
    validateField(description, "Mô tả không được để trống.");
  });

  status.addEventListener("change", function () {
    validateField(status, "Vui lòng chọn trạng thái.");
  });
});

// Select form fields
const name = document.getElementById("name");
const description = document.getElementById("description");
const status = document.getElementById("status");

// Function to show error
function showError(input, message) {
  const parent = input.parentElement;

  // Remove existing error
  const existingError = parent.querySelector(".error-message");
  if (existingError) {
    existingError.remove();
  }

  // Show new error if message exists
  if (message) {
    const error = document.createElement("span");
    error.className = "error-message text-danger";
    error.textContent = message;
    parent.appendChild(error);
  }
}

// Add change event listener to fields
name.addEventListener("input", function () {
  if (!name.value.trim()) {
    showError(name, "Tên danh mục không được để trống.");
  } else {
    showError(name, ""); // Clear error
  }
});

description.addEventListener("input", function () {
  if (!description.value.trim()) {
    showError(description, "Mô tả không được để trống.");
  } else {
    showError(description, ""); // Clear error
  }
});

status.addEventListener("change", function () {
  if (!status.value.trim()) {
    showError(status, "Vui lòng chọn trạng thái.");
  } else {
    showError(status, ""); // Clear error
  }
});

// Prevent form submission if any field is invalid
const form = document.querySelector(".forms-sample");
form.addEventListener("submit", function (event) {
  let isValid = true;

  // Validate all fields
  if (!name.value.trim()) {
    isValid = false;
    showError(name, "Tên danh mục không được để trống.");
  }
  if (!description.value.trim()) {
    isValid = false;
    showError(description, "Mô tả không được để trống.");
  }
  if (!status.value.trim()) {
    isValid = false;
    showError(status, "Vui lòng chọn trạng thái.");
  }

  // If form is invalid, prevent submission
  if (!isValid) {
    event.preventDefault();
  }
});









document.addEventListener("DOMContentLoaded", function() {
  // Lấy các trường form
  const name = document.getElementById("name"); // Trường tên danh mục
  // const description = document.getElementById("description"); // Trường mô tả (bỏ qua)
  const status = document.getElementById("status"); // Trường trạng thái
  const form = document.querySelector("form"); // Form

  // Thêm CSS để xử lý lỗi (viền đỏ và thông báo lỗi)
  const style = document.createElement("style");
  style.innerHTML = `
      .error-border {
          border: 1px solid red; 
      }
      .error-message {
          color: red; 
          font-size: 0.875rem; 
          margin-top: 4px; 
          display: block; 
      }
  `;
  document.head.appendChild(style); // Thêm CSS vào thẻ <head>

  // Hàm hiển thị lỗi
  function showError(input, message) {
      const parent = input.parentElement; // Lấy phần tử cha của ô nhập

      // Xóa thông báo lỗi cũ nếu có
      let error = parent.querySelector(".error-message");
      if (error) {
          error.remove();
      }

      // Thêm thông báo lỗi mới nếu có thông báo
      if (message) {
          error = document.createElement("span");
          error.className = "error-message"; // Thêm lớp cho thông báo lỗi
          error.textContent = message; // Nội dung thông báo lỗi
          parent.appendChild(error); // Chèn thông báo vào DOM

          // Thêm viền đỏ vào ô nhập liệu
          input.classList.add("error-border");
      } else {
          // Xóa viền đỏ và thông báo lỗi nếu hợp lệ
          input.classList.remove("error-border");
      }
  }

  // Hàm kiểm tra từng trường
  function validateField(input, message) {
      if (!input.value.trim()) {
          // Nếu giá trị trống, hiển thị lỗi
          showError(input, message);
          return false;
      } else {
          // Nếu hợp lệ, xóa lỗi
          showError(input, "");
          return true;
      }
  }

  // Xử lý khi gửi form
  form.addEventListener("submit", function(event) {
      let isValid = true; // Biến kiểm tra tính hợp lệ

      // Kiểm tra trường "Tên danh mục"
      if (!validateField(name, "Tên danh mục không được để trống.")) {
          isValid = false;
      }

      // Bỏ qua kiểm tra trường "Mô tả"

      // Kiểm tra trường "Trạng thái"
      if (!validateField(status, "Vui lòng chọn trạng thái.")) {
          isValid = false;
      }

      // Nếu có lỗi, chặn gửi form
      if (!isValid) {
          event.preventDefault();
      }
  });

  // Xử lý khi người dùng nhập liệu để xóa lỗi
  name.addEventListener("input", function() {
      validateField(name, "Tên danh mục không được để trống.");
  });

  // Bỏ qua xử lý sự kiện cho trường "Mô tả"

  status.addEventListener("change", function() {
      validateField(status, "Vui lòng chọn trạng thái.");
  });
});
