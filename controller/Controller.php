<?php
include_once 'models/BaseFunctions.php';

Class Controller {

    public static function indexController(){
        $recipes = BaseFunctions::getRecipes();
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
    
}