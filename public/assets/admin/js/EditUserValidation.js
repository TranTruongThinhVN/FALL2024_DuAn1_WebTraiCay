document.addEventListener("DOMContentLoaded", function () {
  const nameInput = document.getElementById("name");
  const nameError = document.getElementById("nameError");

  const emailInput = document.getElementById("email");
  const emailError = document.getElementById("emailError");

  const passwordInput = document.getElementById("password");
  const passwordError = document.getElementById("passwordError");

  const form = document.getElementById("editUserForm");

  // Hàm kiểm tra lỗi và hiển thị thông báo
  function validateInput(input, errorElement, errorMessage) {
    if (!input.value.trim()) {
      errorElement.textContent = errorMessage;
      errorElement.style.display = "block";
      input.style.border = "1px solid #dc2626";
    } else {
      errorElement.style.display = "none";
      input.style.border = "";
    }
  }

  // Gắn sự kiện `blur` để kiểm tra khi rời khỏi input
  nameInput.addEventListener("blur", function () {
    validateInput(nameInput, nameError, "Tên người dùng không được để trống.");
  });

  emailInput.addEventListener("blur", function () {
    validateInput(emailInput, emailError, "Email không được để trống.");
  });

  passwordInput.addEventListener("blur", function () {
    validateInput(
      passwordInput,
      passwordError,
      "Mật khẩu không được để trống."
    );
  });

  // Gắn sự kiện `input` để xóa lỗi khi người dùng bắt đầu nhập
  nameInput.addEventListener("input", function () {
    nameError.style.display = "none";
    nameInput.style.border = "";
  });

  emailInput.addEventListener("input", function () {
    emailError.style.display = "none";
    emailInput.style.border = "";
  });

  passwordInput.addEventListener("input", function () {
    passwordError.style.display = "none";
    passwordInput.style.border = "";
  });

  // Kiểm tra form trước khi submit
  form.addEventListener("submit", function (e) {
    validateInput(nameInput, nameError, "Tên người dùng không được để trống.");
    validateInput(emailInput, emailError, "Email không được để trống.");
    validateInput(
      passwordInput,
      passwordError,
      "Mật khẩu không được để trống."
    );

    if (
      !nameInput.value.trim() ||
      !emailInput.value.trim() ||
      !passwordInput.value.trim()
    ) {
      e.preventDefault(); // Ngăn form submit nếu có lỗi
    }
  });
});
