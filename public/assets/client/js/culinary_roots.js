document.addEventListener("DOMContentLoaded", () => {
  const recipeItems = document.querySelectorAll(".CulinaryRoots__RecipeCard");
  let visibleRecipes = 6;

  function displayRecipes() {
    recipeItems.forEach((item, index) => {
      item.style.display = index < visibleRecipes ? "block" : "none";
    });
  }

  function loadMoreRecipes() {
    visibleRecipes += 6;
    displayRecipes();

    if (visibleRecipes >= recipeItems.length) {
      document.querySelector(".CulinaryRoots__LoadMoreButton").style.display =
        "none";
    }
  }

  // Initial display setup
  displayRecipes();
  window.loadMoreRecipes = loadMoreRecipes; // Expose function to the global scope for button onclick
});
