// Recipes stored in JS array for demo
let recipes = [
    {title: "Spaghetti Bolognese", ingredients: "Spaghetti, Beef, Tomato Sauce", instructions: "Cook spaghetti. Cook beef. Mix with sauce."},
    {title: "Pancakes", ingredients: "Flour, Eggs, Milk", instructions: "Mix ingredients. Fry on pan."}
];

function renderRecipes() {
    const list = document.getElementById('recipe-list');
    if (!list) return;
    list.innerHTML = '';
    recipes.forEach((r, i) => {
        const div = document.createElement('div');
        div.innerHTML = `<h3>${r.title}</h3><strong>Ingredients:</strong> <p>${r.ingredients}</p><strong>Instructions:</strong> <p>${r.instructions}</p>`;
        list.appendChild(div);
    });
}

function addRecipe(title, ingredients, instructions) {
    recipes.push({title, ingredients, instructions});
    renderRecipes();
}

document.addEventListener('DOMContentLoaded', () => {
    renderRecipes();
    const form = document.getElementById('submitRecipeForm');
    if (form) {
        form.addEventListener('submit', e => {
            e.preventDefault();
            addRecipe(
                form.title.value,
                form.ingredients.value,
                form.instructions.value
            );
            document.getElementById('submitResult').innerText = 'Recipe submitted!';
            form.reset();
        });
    }
});
