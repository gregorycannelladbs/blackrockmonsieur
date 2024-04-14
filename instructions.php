<?php
    include('connect_db.php');
    
    $recipes = $conn->query("select recipe_id, recipe from recipes");
    
    $result = $conn->query(
        "SELECT * 
            
        FROM instructions AS a
        INNER JOIN recipes AS b ON a.recipe_id = b.recipe_id

        ORDER BY recipe, instruction_id"
    );
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
        <form name = 'insert_instruction' action='instructions.php' method='post'>
            <label for='recipe_id'>Recette: </label>
            <select name='recipe_id'>
                <?php
                    while ($row = $recipes->fetch_assoc()) {
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
            if ($_POST) {
                // Execute code (such as database updates) here.
                $recipe_id = (int) $_POST['recipe_id'];
                $instruction_id = (int) $_POST['instruction_id'];
                $instruction = $_POST['instruction'];

                $conn->query(
                    "INSERT INTO instructions (recipe_id, instruction_id, instruction) 
                    VALUES('$recipe_id', '$instruction_id', '$instruction')"
                );
                
                // Redirect to this page.
                header("Location:instructions.php");
                //exit();
             }

            echo "<h1>Liste des recettes enregistrées dans la base de données</h1>";

            if ($result->num_rows > 0) {
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
                while($row = $result->fetch_assoc()) {
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
            $conn->close(); 
        ?>
    </body>
</html>