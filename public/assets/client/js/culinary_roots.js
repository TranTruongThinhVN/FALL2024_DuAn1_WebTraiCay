// JavaScript to initially display a limited number of recipes and load more on click
document.addEventListener("DOMContentLoaded", () => {
  const recipeItems = document.querySelectorAll(".CulinaryRoots__RecipeCard");
  let visibleRecipes = 6; // Number of recipes to show initially

  function displayRecipes() {
    recipeItems.forEach((item, index) => {
      item.style.display = index < visibleRecipes ? "block" : "none";
    });
  }

  function loadMoreRecipes() {
    visibleRecipes += 6; // Load 6 more recipes on each click
    displayRecipes();

    // Hide the button if all recipes are displayed
    if (visibleRecipes >= recipeItems.length) {
      document.querySelector(".CulinaryRoots__LoadMoreButton").style.display =
        "none";
    }
  }

  // Initial display setup
  displayRecipes();
  window.loadMoreRecipes = loadMoreRecipes; // Expose function to the global scope for button onclick
});
