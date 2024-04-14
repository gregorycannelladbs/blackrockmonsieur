<?php
    include('connect_db.php');

    $recipes = $conn->query("select recipe_id, recipe from recipes ORDER BY recipe");
    
    $ingredients = $conn->query(
        "SELECT ingredient_id, ingredient from ingredients ORDER BY ingredient"
    );
    
    $units = $conn->query("select unit_id, unit from units");

    $result = $conn->query(
        "SELECT b.recipe, c.ingredient, a.quantity, d.unit
                
        FROM recipe_details AS a
        INNER JOIN recipes AS b ON a.recipe_id = b.recipe_id
        INNER JOIN  ingredients AS c ON a.ingredient_id = c.ingredient_id
        INNER JOIN  units AS d ON a.unit_id = d.unit_id
        
        ORDER BY recipe, ingredient"
    );
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
            <form name = 'insert_recipe_details' action='recipe_details.php' method='post'>
            <label for='recipe_id'>Recette: </label>
            <select name='recipe_id'>
                <?php
                    while ($row = $recipes->fetch_assoc()) {
                        echo "<option value='" . $row['recipe_id'] . "'>" . $row['recipe'] . "</option>";
                    }
                ?>
            </select><br>

            <label for='ingredient_id'>Ingrédient: </label>
            <select name='ingredient_id'>
                <?php
                    while ($row = $ingredients->fetch_assoc()) {
                        echo "<option value='" . $row['ingredient_id'] . "'>" . $row['ingredient'] . "</option>";
                    }
                ?>
            </select><br>

            <label for='quantity'>Quantité</label>
            <input type='text' id='quantity' name='quantity'><br>
            
            <label for='unit_id'>Unité: </label>
            <select name='unit_id'>
                <?php
                    while ($row = $units->fetch_assoc()) {
                        echo "<option value='" . $row['unit_id'] . "'>" . $row['unit'] . "</option>";
                    }
                ?>
            </select><br>

            <input type='submit' value='Ajouter'>
            
            <?php
                if ($_POST) {
                    // Execute code (such as database updates) here.
                    $recipe_id = (int) $_POST['recipe_id'];
                    $ingredient_id = (int) $_POST['ingredient_id'];
                    $quantity = (int) $_POST['quantity'];
                    $unit_id = (int) $_POST['unit_id'];

                    $conn->query(
                        "INSERT INTO recipe_details (recipe_id, ingredient_id, quantity, unit_id) 
                        VALUES('$recipe_id' , '$ingredient_id', '$quantity', '$unit_id')"
                    );
                    
                    // Redirect to this page.
                    header("Location:recipe_details.php");
                    //exit();
                } 
            ?>
            <h1>Liste des détails de recettes enregistrées dans la base de données</h1>
            
            <?php
                if ($result->num_rows > 0) {
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
                    while($row = $result->fetch_assoc()) {
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
                $conn->close();
            ?>
    </body>
</html>