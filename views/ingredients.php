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
        <title>Ingredients</title>
    </head>

    <body>
        <h1>Formulaire d'ajout de nouveaux ingrédients</h1>
        <form name = 'insert_ingredient' action='/ingredients' method='post'>
            <label for='ingredient'>Nouvel ingrédient:</label><br>
            <input type='text' id='ingredient' name='ingredient'><br>
            <input type='submit' value='Ajouter'>
        </form>
        <?php
            echo "<h1>Liste des ingrédients enregistrés dans la base de données</h1>";
            
            if ($ingredientsTable->num_rows > 0) {
                echo "
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>ingrédient</th>
                            </tr>
                        </thead>";
                echo "  <tbody>";
                // output data of each row
                while($row = $ingredientsTable->fetch_assoc()) {
                  echo "
                            <tr>
                                <td>".$row["ingredient_id"]."</td>
                                <td>".$row["ingredient"]."</td>
                            </tr>";
                }
                echo "  </tbody>
                    </table>";
              } else {
                echo "0 results";
              }
        ?>
    </body>
</html>