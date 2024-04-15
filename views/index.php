<!DOCTYPE html>

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //header("Expires: 0");
?>

<script src="js/index.js?v=6"></script>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="css/partials/topNavWithSearch.css?v=2">
        <link rel="stylesheet" href="css/index.css?v=5">
        <title>Food shopping assistant</title>
        <meta name="description" content="Food shopping assistant">
    </head>
    <body onpageshow="showSubmitButton()">
        <?php require 'partials/topNavWithSearch.php' ?>
    
    <a class="savedShoppingList" href='/savedShoppingList'> 
        <span class="material-symbols-outlined">list_alt</span> Liste de course sauvegardée
    </a> 
        <main>
            <?php 
                $i = 0;
                echo"
                <form method='post' id='shoppingList' action='/shoppingList'></form>";
                foreach($recipesTable as $row) {
                    $recipeId = $row['recipe_id'];
                    $recipe = $row['recipe'];
                    $type = $row['type'];
                    $numberOfPeople = $row['number_of_people'];
                    $isNumberOfPeopleModifiable = $row['is_number_of_people_modifiable'];
                    
                    echo "
                     <div class='container'>
                        <div class='image'>
                            <a href='/recipe?recipeId=$recipeId'> <img src='thumbnails/$recipeId.jpg?v=1' alt='$recipe'></a>
                        </div>
                        <div class='description'>
                            <label for='checkbox.$recipeId'>
                                <a href='/recipe?recipeId=$recipeId' class='recipeNameButton' id='recipeNameButton.$recipeId'>";
                                if ($type == "cookéo"){
                                    echo "$recipe <b>(recette $type)</b></a>";
                                } else {
                                    echo "$recipe </a>";
                                }
                        echo"
                            </label>
                        </div>
                        <input type='checkbox' id='checkbox.$recipeId' name='data[$i][recipeId]' onclick='showSubmitButton()' value=$recipeId form='shoppingList'>
                        <select class= 'modifiedNumberOfPeople' name='data[$i][modifiedNumberOfPeople]' form='shoppingList'>
                            <option value='Nombre'>Nombre</option>";
                        if (!$isNumberOfPeopleModifiable) {
                            echo "<option value=$numberOfPeople>$numberOfPeople</option>";
                        }
                        if ($isNumberOfPeopleModifiable) {
                            echo "<option value=2>2</option>
                            <option value=4>4</option>
                            <option value=6>6</option>";
                        }
                        if ($type != "cookéo" && $isNumberOfPeopleModifiable) {
                            echo "
                            <option value=8>8</option>";
                        }
                        echo "
                        </select>
                        <input type='hidden' name='data[$i][recipe]' value='$recipe' form='shoppingList'>
                    </div>";

                    $i = $i+1;
                }
                echo "<input type='submit' id='submitButton' value='Voir ma liste de courses' form='shoppingList'>";
            ?>
        </main>
    </body>
</html>