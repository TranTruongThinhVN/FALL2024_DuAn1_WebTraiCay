document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');
  const inputs = {
      title: document.getElementById('title'),
      category: document.getElementById('category_id'),
      image: document.getElementById('image_url'),
  };

  const errors = {};

  // Hàm hiển thị lỗi
  const showError = (field, message) => {
      const errorElement = field.nextElementSibling;

      if (message) {
          errors[field.id] = message;
          field.classList.add('error-border');
          if (!errorElement || !errorElement.classList.contains('text-danger')) {
              const error = document.createElement('small');
              error.classList.add('text-danger');
              error.innerText = message;
              field.insertAdjacentElement('afterend', error);
          }
      } else {
          delete errors[field.id];
          field.classList.remove('error-border');
          if (errorElement && errorElement.classList.contains('text-danger')) {
              errorElement.remove();
          }
      }
  };

  // Hàm validate từng trường
  const validateField = (field, value = null) => {
      const fieldValue = value !== null ? value : field.value.trim();
      switch (field.id) {
          case 'title':
              showError(field, fieldValue.length < 3 ? 'Tiêu đề phải có ít nhất 3 ký tự.' : '');
              break;
          
          case 'category_id':
              showError(field, !fieldValue ? 'Vui lòng chọn danh mục.' : '');
              break;
          case 'image_url':
              if (field.files[0]) {
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
              } 
              break;
              
      }
  };

  // Xử lý các sự kiện của input
  Object.values(inputs).forEach(input => {
      input.addEventListener('input', () => validateField(input));
      input.addEventListener('change', () => validateField(input));
  });

  // Hàm validate CKEditor
  const validateCKEditor = (fieldId, editorInstance) => {
      const value = editorInstance.getData().trim();
      const field = document.getElementById(fieldId);
      if (!value) {
          errors[fieldId] = `${field.previousElementSibling.textContent} không được để trống.`;
          field.classList.add('error-border');
          let errorElement = field.nextElementSibling;
          if (!errorElement || !errorElement.classList.contains('text-danger')) {
              const error = document.createElement('small');
              error.classList.add('text-danger');
              error.innerText = errors[fieldId];
              field.insertAdjacentElement('afterend', error);
          }
      } else {
          delete errors[fieldId];
          field.classList.remove('error-border');
          const errorElement = field.nextElementSibling;
          if (errorElement && errorElement.classList.contains('text-danger')) {
              errorElement.remove();
          }
      }
  };

  let ingredientsEditor, instructionsEditor;

  // Tạo CKEditor cho trường nguyên liệu (ingredients)
  ClassicEditor
      .create(document.querySelector('#ingredients'))
      .then(editor => {
          ingredientsEditor = editor;
          editor.model.document.on('change:data', () => validateCKEditor('ingredients', editor));
      })
      .catch(error => console.error('CKEditor Ingredients Error:', error));

  // Tạo CKEditor cho trường hướng dẫn (instructions)
  ClassicEditor
      .create(document.querySelector('#instructions'))
      .then(editor => {
          instructionsEditor = editor;
          editor.model.document.on('change:data', () => validateCKEditor('instructions', editor));
      })
      .catch(error => console.error('CKEditor Instructions Error:', error));

  // Xử lý sự kiện submit form
  form.addEventListener('submit', function (e) {
      Object.values(inputs).forEach(input => validateField(input));
      validateCKEditor('ingredients', ingredientsEditor);
      validateCKEditor('instructions', instructionsEditor);

      // Nếu có lỗi, ngăn form submit
      if (Object.keys(errors).length > 0) {
          e.preventDefault();
      }
  });
});
