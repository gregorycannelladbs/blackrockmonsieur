<?php
include_once('models/Dbh.php');

class BaseFunctions extends Dbh {

    public static function getRecipes() {
        $sql = "SELECT * FROM recipes ORDER BY recipe";
        
        $recipes = Dbh::connect()->query($sql); 
        
        return $recipes;
    }

    public static function getRecipe($recipeId) {
        $sql = "SELECT * FROM recipes WHERE  recipe_id = $recipeId";
        
        $recipe = Dbh::connect()->query($sql);
        $recipe = $recipe->fetch_assoc();
        
        return $recipe;
    }

    public static function getIngredients($recipe_id) {
        $sql =         
            "SELECT b.recipe, c.ingredient, a.quantity, d.unit
                    
            FROM recipe_details AS a
            INNER JOIN recipes AS b ON a.recipe_id = b.recipe_id
            INNER JOIN  ingredients AS c ON a.ingredient_id = c.ingredient_id
            INNER JOIN  units AS d ON a.unit_id = d.unit_id

            WHERE a.recipe_id = $recipe_id
            
            ORDER BY c.ingredient";

        $ingredients = Dbh::connect()->query($sql);
        $ingredients = $ingredients->fetch_all(MYSQLI_ASSOC);

        return $ingredients;
    }

    public static function getNumberOfPeople($recipe_id) {
        $sql = "SELECT number_of_people FROM recipes WHERE recipe_id = $recipe_id";
        $number_of_people_query = Dbh::connect()->query($sql);

        $number_of_people_row = $number_of_people_query->fetch_assoc();
        $number_of_people = (int) $number_of_people_row['number_of_people'];

        return $number_of_people;
    }

    public static function getInstructions($recipe_id) {
        $sql =
            "SELECT instruction_id, instruction 
            FROM instructions
            WHERE recipe_id = $recipe_id
            ORDER BY instruction_id";

        $instructions = Dbh::connect()->query($sql);
        $instructions = $instructions->fetch_all(MYSQLI_ASSOC);
        
        return $instructions;
    }

    public static function cleanData($rawData) {
        
        $data = $_POST['data'];

        for ($i = 0; $i < count($_POST['data']); $i++)  {
            if (!array_key_exists('recipeId',  $data[$i]) ||  $data[$i]['modifiedNumberOfPeople'] == 'Nombre'){
                unset($data[$i]);
            }
        }
        
        return $data;
    }

    public static function getRecipeIdsString($data) {
        
        $recipeIdsString = [];
        foreach($data as $assoc_array){
            $recipeId = $assoc_array['recipeId'];
            array_push($recipeIdsString, $recipeId);
        }

        $recipeIdsString = implode(',', $recipeIdsString);
        $recipeIdsString = rtrim($recipeIdsString, ',');

        return $recipeIdsString;
    }

    public static function getShoppingList($data) {
        $recipeIdsString = BaseFunctions::getRecipeIdsString($data);

        $sql=
        "CREATE TABLE modified_number (
            recipe_id INT UNSIGNED PRIMARY KEY NOT NULL ,
            modified_number_of_people INT UNSIGNED NOT NULL
        );";

        Dbh::connect()->query($sql);
        
        foreach ($data as $assoc_array) {
            $key = $assoc_array['recipeId'];
            $value = $assoc_array['modifiedNumberOfPeople'];

            $sql = "INSERT INTO modified_number VALUES ($key, $value)";
            Dbh::connect()->query($sql);
        }

        $sql =         
        "SELECT c.ingredient, 
                SUM(a.quantity / b.number_of_people * e.modified_number_of_people) AS quantity,
                d.unit
                
        FROM recipe_details AS a
        INNER JOIN recipes AS b ON a.recipe_id = b.recipe_id
        INNER JOIN  ingredients AS c ON a.ingredient_id = c.ingredient_id
        INNER JOIN  units AS d ON a.unit_id = d.unit_id
        INNER JOIN modified_number AS e ON a.recipe_id = e.recipe_id

        WHERE a.recipe_id IN ($recipeIdsString)
        
        GROUP BY c.ingredient, d.unit
        ORDER BY c.ingredient";

        $shoppingList = Dbh::connect()->query($sql);

        $sql= "DROP TABLE modified_number;";
        Dbh::connect()->query($sql);

        return $shoppingList;
    }

    /*public static function getRecipeNames($data) {
        $recipeIdsString = BaseFunctions::getRecipeIdsString($data);
        
        $sql = "SELECT recipe FROM recipes WHERE recipe_id IN ($recipeIdsString) ORDER BY recipe";
        $recipeNames = Dbh::connect()->query($sql); 

        return $recipeNames;
    }*/
}