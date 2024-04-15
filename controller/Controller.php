<?php
include_once 'models/BaseFunctions.php';

Class Controller {

    public static function indexController(){
        $recipesTable = BaseFunctions::getRecipesTable();
        include 'views/index.php';
    }


    public static function recipeController(){
        $recipeId = (int) $_GET['recipeId'];

        $recipe = BaseFunctions::getRecipe($recipeId);

        $recipeName = $recipe['recipe'];
        $type = $recipe['type'];
        $numberOfPeople = $recipe['number_of_people'];
        $isNumberOfPeopleModifiable = $recipe['is_number_of_people_modifiable'];

        $ingredients = BaseFunctions::getIngredients($recipeId);

        $instructions = BaseFunctions::getInstructions($recipeId);

        require 'views/recipe.php';
    }


    public static function shoppingListController(){
        $data = BaseFunctions::cleanData($_POST['data']);

        $shoppingList = BaseFunctions::getShoppingList($data);

        require 'views/shoppingList.php';
    }

    
    public static function savedShoppingListController(){
        require 'views/savedShoppingList.php';
    }


    public static function ingredientsController(){
        $ingredientsTable = BaseFunctions::getIngredientsTable();
         
        require 'views/ingredients.php';

        if ($_POST) {
            $new_ingredient = $_POST['ingredient'];

            BaseFunctions::addIngredient($new_ingredient);
            
            // Redirect to this page.
            header("Location:/ingredients");
        }
    }


    public static function recipesController(){
        $recipesTable = BaseFunctions::getRecipesTable();
         
        require 'views/recipes.php';

        if ($_POST) {
            $recipe = $_POST['recipe'];
            $number_of_people = (int) $_POST['number_of_people'];
            $type = $_POST['type'];
            $category = $_POST['category'];
            $is_number_of_people_modifiable = (int) $_POST['is_number_of_people_modifiable'];

            BaseFunctions::addRecipe($recipe, $number_of_people, $type, $category, $is_number_of_people_modifiable);
            
            // Redirect to this page.
            header("Location:/recipes");
        } 
    }

    
    public static function recipeDetailsController(){
        $recipesTable = BaseFunctions::getRecipesTable();

        $ingredientsTable = BaseFunctions::getIngredientsTable();

        $unitsTable = BaseFunctions::getUnitsTable();

        $recipeDetailsTable = BaseFunctions::getRecipeDetailsTable();
         
        require 'views/recipeDetails.php';

        if ($_POST) {
            $recipe_id = (int) $_POST['recipe_id'];
            $ingredient_id = (int) $_POST['ingredient_id'];
            $quantity = (int) $_POST['quantity'];
            $unit_id = (int) $_POST['unit_id'];

            BaseFunctions::addRecipeDetails($recipe_id, $ingredient_id, $quantity, $unit_id);
            
            // Redirect to this page.
            header("Location:/recipeDetails");
            //exit();
        } 
    }


    public static function unitsController(){
        $unitsTable = BaseFunctions::getUnitsTable();
         
        require 'views/units.php';

        if ($_POST) {
            $unit = $_POST['unit'];
            $description = $_POST['description'];

            BaseFunctions::addUnits($unit, $description);
            
            // Redirect to this page.
            header("Location:/units");
        } 
    }


    public static function instructionsController(){
        $recipesTable = BaseFunctions::getRecipesTable();

        $instructionsTable = BaseFunctions::getInstructionsTable();
         
        require 'views/instructions.php';

        if ($_POST) {
            $recipe_id = (int) $_POST['recipe_id'];
            $instruction_id = (int) $_POST['instruction_id'];
            $instruction = $_POST['instruction'];

            BaseFunctions::addInstructions($recipe_id, $instruction_id, $instruction);
            
            // Redirect to this page.
            header("Location:/instructions");
        }
    }
}