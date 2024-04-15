<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/backoffice.css">
        <title>recipe details</title>
    </head>

    <body>
            <form name = 'insert_recipe_details' action='/recipeDetails' method='post'>
            <label for='recipe_id'>Recette: </label>
            <select name='recipe_id'>
                <?php
                    while ($row = $recipesTable->fetch_assoc()) {
                        echo "<option value='" . $row['recipe_id'] . "'>" . $row['recipe'] . "</option>";
                    }
                ?>
            </select><br>

            <label for='ingredient_id'>Ingrédient: </label>
            <select name='ingredient_id'>
                <?php
                    while ($row = $ingredientsTable->fetch_assoc()) {
                        echo "<option value='" . $row['ingredient_id'] . "'>" . $row['ingredient'] . "</option>";
                    }
                ?>
            </select><br>

            <label for='quantity'>Quantité</label>
            <input type='text' id='quantity' name='quantity'><br>
            
            <label for='unit_id'>Unité: </label>
            <select name='unit_id'>
                <?php
                    while ($row = $unitsTable->fetch_assoc()) {
                        echo "<option value='" . $row['unit_id'] . "'>" . $row['unit'] . "</option>";
                    }
                ?>
            </select><br>

            <input type='submit' value='Ajouter'>
            
            <h1>Liste des détails de recettes enregistrées dans la base de données</h1>
            
            <?php
                if ($recipeDetailsTable->num_rows > 0) {
                    echo "
                        <table>
                            <thead>
                                <tr>
                                    <th>recette</th>
                                    <th>ingrédient</th>
                                    <th>quantité</th>
                                    <th>unité</th>
                                </tr>
                            </thead>";
                    echo "  <tbody>";
                    // output data of each row
                    while($row = $recipeDetailsTable->fetch_assoc()) {
                    echo "
                                <tr>
                                    <td>".$row["recipe"]."</td>
                                    <td>".$row["ingredient"]."</td>
                                    <td>".$row["quantity"]."</td>
                                    <td>".$row["unit"]."</td>
                                </tr>";
                    }
                    echo "
                            </tbody>
                        </table>";
                } else {
                    echo "0 results";
                }
            ?>
    </body>
</html>