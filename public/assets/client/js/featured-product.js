document.addEventListener("DOMContentLoaded", () => {
    const productSections = document.querySelectorAll('.product-grid');
  
    productSections.forEach(section => {
      const products = section.querySelectorAll('.product-card');
      products.forEach((product, index) => {
        if (index >= 12) { // Show only the first 12 products initially
          product.classList.add('product-hidden');
          product.style.display = 'none';
        }
      });
    });
  });
  
  function showMoreProducts(category) {
    const categorySection = document.querySelector(`.${category}-products .product-grid`) || 
                            document.querySelector(`.${category}-fruits .product-grid`) ||
                            document.querySelector(`.featured-product-grid .product-grid`);
  
    if (!categorySection) {
      console.error(`Không tìm thấy phần tử với class .${category}-products .product-grid, .${category}-fruits .product-grid hoặc .featured-products .product-grid`);
      return;
    }
  
    const hiddenProducts = categorySection.querySelectorAll('.product-hidden');
  
    let count = 0;
    hiddenProducts.forEach(product => {
      if (count < 6) {
        product.style.display = 'block';
        product.classList.remove('product-hidden');
        count++;
      }
    });
  
    if (categorySection.querySelectorAll('.product-hidden').length === 0) {
      document.querySelector(`.show-more-btn[data-category="${category}"]`).style.display = 'none';
    }
  }
  