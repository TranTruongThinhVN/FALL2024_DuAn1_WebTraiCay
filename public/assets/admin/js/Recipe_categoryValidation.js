document.addEventListener("DOMContentLoaded", function () {
    const nameInput = document.getElementById("name");
    const statusInput = document.getElementById("status");
    const descriptionInput = document.getElementById("description"); // Thêm phần lắng nghe mô tả
    const form = document.querySelector("form");

    // Hàm hiển thị lỗi
    function showError(input, message) {
        const parent = input.parentElement;
        let error = parent.querySelector(".text-danger");

        if (!error) {
            error = document.createElement("small");
            error.className = "text-danger";
            parent.appendChild(error);
        }
        error.textContent = message;

        if (message) {
            input.classList.add("error-border");
        } else {
            input.classList.remove("error-border");
        }
    }


    // Lắng nghe thay đổi ở trường "Tên danh mục"
    nameInput.addEventListener("input", function () {
        const name = nameInput.value.trim();
        if (!name) {
            showError(nameInput, "Tên danh mục không được để trống.");
        } else if (name.length < 3) {
            showError(nameInput, "Tên danh mục phải có ít nhất 3 ký tự.");
        } else {
            showError(nameInput, "");
        }
    });



    // Lắng nghe thay đổi ở trường "Trạng thái"
    statusInput.addEventListener("change", function () {
        const status = statusInput.value;
        if (!status) {
            showError(statusInput, "Vui lòng chọn trạng thái.");
        } else {
            showError(statusInput, "");
        }
    });

    // Kiểm tra trước khi gửi form
    form.addEventListener("submit", function (event) {
        let isValid = true;

        const name = nameInput.value.trim();
        const status = statusInput.value;
        const description = descriptionInput.value.trim();

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
