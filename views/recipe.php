<!DOCTYPE html>

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/partials/topNav.css?v=2">
        <link rel="stylesheet" href="css/recipe.css?v=2">
        <script src='js/recipe.js?v=1'></script>
        <meta name="description" content="Liste des ingrédients et instructions de cuisine">
        <title>Liste des ingrédients pour la recette <?=$recipeName?></title>
    </head>
    <body>
        <?php require 'partials/topNav.php' ?>
        <main>
            <div class='header'>
                <form name='change_number_of_people' method='post'>
                    <label for='modifiedNumberOfPeople'>Modifer le nombre de personnes: </label>
                    <select id= 'modifiedNumberOfPeople' onchange='modifyQuantities()' name='modified_number_of_people'>
                        <option value='Nombre'>Nombre</option>
                        <?php if (!$isNumberOfPeopleModifiable) : ?>
                            <option value=<?=$numberOfPeople;?>><?=$numberOfPeople;?></option>
                        <?php endif; ?>
                        <?php if ($isNumberOfPeopleModifiable) : ?>
                            <option value=2>2</option>
                            <option value=4>4</option>
                            <option value=6>6</option>
                        <?php endif; ?>
                        <?php if ($type != "cookéo" && $isNumberOfPeopleModifiable) : ?>
                            <option value=8>8</option>
                        <?php endif; ?>
                    </select>
                </form>
                <h1 id='recipeTitle'><?=$recipeName." pour ". $numberOfPeople. " personnes";?></h1>
            </div>
            <div class='image'>
                <?= "<img src='images/$recipeId.jpg?v=1' alt='$recipeId'>"; ?>
            </div>
            <div class='ingredients'>
                <h2>Ingrédients</h2>
                <table id= 'ingredientsTable'>
                    <thead>
                        <tr>
                            <th>ingrédient</th>
                            <th>quantité</th>
                            <th>unité</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($ingredients as $row) {
                            echo "
                                <tr>
                                    <td>".$row['ingredient']."</td>
                                    <td>".round($row['quantity'])."</td>
                                    <td>".$row['unit']."</td>
                                </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class='instructions'>
                <h2>Instructions</h2>
                <table>
                    <thead>    
                        <tr>
                            <th>étape</th>
                            <th>instruction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($instructions as $row) {
                                echo "
                                    <tr>
                                    <td>".$row['instruction_id']."</td>
                                    <td>".$row['instruction']."</td>
                                    </tr>";
                            }
                        ?>

                    </tbody>
                </table>
            </div>
            <script type='text/javascript'>
                var numberOfPeople = <?=$numberOfPeople;?>;
                var originalQuantities = saveOriginalQuantities();
            </script>
        </main>
    </body>
</html>