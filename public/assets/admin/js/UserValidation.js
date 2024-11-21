document.addEventListener("DOMContentLoaded", function () {
  const emailInput = document.getElementById("email");
  const emailError = document.getElementById("emailError");
  const passwordInput = document.getElementById("password");
  const passwordError = document.getElementById("passwordError");

  // Hàm kiểm tra lỗi và thêm CSS border đỏ
  function validateInput(input, errorElement, errorMessage) {
    if (!input.value.trim()) {
      errorElement.textContent = errorMessage;
      errorElement.style.display = "block";
      input.style.border = "1px solid #dc2626";
      input.style.boxShadow = "#cbd5e1";
    } else {
      errorElement.style.display = "none";
      input.style.border = ""; // Xóa border
      input.style.boxShadow = ""; // Xóa box shadow
    }
  }

  // Gắn sự kiện blur để kiểm tra khi rời khỏi input
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

  // Gắn sự kiện input để xóa lỗi khi bắt đầu nhập
  emailInput.addEventListener("input", function () {
    emailError.style.display = "none";
    emailInput.style.border = "";
    emailInput.style.boxShadow = "";
  });

  passwordInput.addEventListener("input", function () {
    passwordError.style.display = "none";
    passwordInput.style.border = "";
    passwordInput.style.boxShadow = "";
  });
});
