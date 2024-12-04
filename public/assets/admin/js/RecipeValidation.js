document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const inputs = {
        title: document.getElementById('title'),
        category: document.getElementById('category_id'),
        image: document.getElementById('image_url')
    };

    let ingredientsEditor, instructionsEditor;

    // Hàm hiển thị lỗi
    const showError = (field, message) => {
        let errorElement = field.nextElementSibling;

        if (message) {
            // Thêm class lỗi vào input
            field.classList.add('error-border');

            // Tạo hoặc cập nhật nội dung lỗi
            if (!errorElement || !errorElement.classList.contains('text-danger')) {
                errorElement = document.createElement('small');
                errorElement.classList.add('text-danger');
                field.insertAdjacentElement('afterend', errorElement);
            }
            errorElement.innerText = message;
        } else {
            // Xóa lỗi nếu có
            field.classList.remove('error-border');
            if (errorElement && errorElement.classList.contains('text-danger')) {
                errorElement.remove();
            }
        }
    };

    // Hàm kiểm tra dữ liệu
    const validateField = (field) => {
        const value = field.value.trim();

        switch (field.id) {
            case 'title':
                showError(field, value.length < 3 ? 'Tiêu đề phải có ít nhất 3 ký tự.' : '');
                break;
            case 'category_id':
                showError(field, !value ? 'Vui lòng chọn danh mục.' : '');
                break;
            case 'image_url':
                if (field.files.length > 0) {
                    const file = field.files[0];
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    const maxSize = 5 * 1024 * 1024; // 5MB
                    if (!allowedTypes.includes(file.type)) {
                        showError(field, 'Chỉ chấp nhận các định dạng JPEG, PNG, hoặc GIF.');
                    } else if (file.size > maxSize) {
                        showError(field, 'Dung lượng file không được vượt quá 5MB.');
                    } else {
                        showError(field, '');
                    }
                } else {
                    showError(field, 'Vui lòng tải lên một hình ảnh.');
                }
                break;
        }
    };

    // Kiểm tra CKEditor
    const validateCKEditor = (editor, fieldId) => {
        const content = editor.getData().trim();
        const field = document.getElementById(fieldId);

        if (!content) {
            showError(field, `${field.previousElementSibling.textContent} không được để trống.`);
        } else {
            showError(field, '');
        }
    };

    // Sự kiện input và change cho các trường
    Object.values(inputs).forEach(input => {
        input.addEventListener('input', () => validateField(input));
        input.addEventListener('change', () => validateField(input));
    });

    // Tạo CKEditor
    ClassicEditor.create(document.querySelector('#ingredients'))
        .then(editor => {
            ingredientsEditor = editor;
            editor.model.document.on('change:data', () => validateCKEditor(editor, 'ingredients'));
        })
        .catch(error => console.error(error));

    ClassicEditor.create(document.querySelector('#instructions'))
        .then(editor => {
            instructionsEditor = editor;
            editor.model.document.on('change:data', () => validateCKEditor(editor, 'instructions'));
        })
        .catch(error => console.error(error));

    // Xử lý form submit
    form.addEventListener('submit', (e) => {
        // Kiểm tra tất cả các trường input
        Object.values(inputs).forEach(input => validateField(input));
        validateCKEditor(ingredientsEditor, 'ingredients');
        validateCKEditor(instructionsEditor, 'instructions');

        // Nếu có lỗi, ngăn chặn submit
        const hasErrors = document.querySelectorAll('.text-danger').length > 0;
        if (hasErrors) {
            e.preventDefault();
        }
    });
});
