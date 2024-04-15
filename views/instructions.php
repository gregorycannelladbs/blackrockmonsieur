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
        <title>instructions list</title>
    </head>

    <body>
        <h1>Formulaire d'ajout des instructions de recette</h1>
        <form name = 'insert_instruction' action='/instructions' method='post'>
            <label for='recipe_id'>Recette: </label>
            <select name='recipe_id'>
                <?php
                    while ($row = $recipesTable->fetch_assoc()) {
                        echo "<option value='" . $row['recipe_id'] . "'>" . $row['recipe'] . "</option>";
                    }
                ?>
            </select><br>
            <label for='instruction_id'>Numéro de l'étape: </label>
            <input type='text' id='instruction_id' name='instruction_id'><br>
            <label for='instruction'>Instruction: </label>
            <input type='text' id='instruction' name='instruction'><br>
            <input type='submit' value='Ajouter'>
        </form>
        <?php
            echo "<h1>Liste des recettes enregistrées dans la base de données</h1>";

            if ($instructionsTable->num_rows > 0) {
                echo "
                    <table>
                        <thead>
                            <tr>
                                <th>recette</th>
                                <th>Etape</th>
                                <th>instruction</th>
                            </tr>
                        </thead>";
                echo "  <tbody>";
                // output data of each row
                while($row = $instructionsTable->fetch_assoc()) {
                  echo "
                            <tr>
                                <td>".$row["recipe"]."</td>
                                <td>".$row["instruction_id"]."</td>
                                <td>".$row["instruction"]."</td>
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