const defaultProductCount = 10;

function showMoreProducts(category) {
  const productGrid = document.querySelector(
    `.product-section__category--${category} .product-section__grid`
  );
  const hiddenProducts = productGrid.querySelectorAll(".product-card.hidden");

  hiddenProducts.forEach((product, index) => {
    if (index < defaultProductCount) {
      product.classList.remove("hidden");
    }
  });

  const remainingHiddenProducts = productGrid.querySelectorAll(
    ".product-card.hidden"
  );
  if (remainingHiddenProducts.length === 0) {
    document.querySelector(
      `.product-section__category--${category} .product-section__show-more`
    ).style.display = "none";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".product-section__category").forEach((section) => {
    const productGrid = section.querySelector(".product-section__grid");
    const products = productGrid.querySelectorAll(".product-card");

    products.forEach((product, index) => {
      if (index >= defaultProductCount) {
        product.classList.add("hidden");
      }
    });
  });
});
