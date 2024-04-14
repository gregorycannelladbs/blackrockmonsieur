<?php
    include('connect_db.php');
    $result = $conn->query("SELECT * FROM ingredients ORDER BY ingredient");
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
        <form name = 'insert_ingredient' action='ingredients.php' method='post'>
            <label for='ingredient'>Nouvel ingrédient:</label><br>
            <input type='text' id='ingredient' name='ingredient'><br>
            <input type='submit' value='Ajouter'>
        </form>
        <?php
            if ($_POST) {
                // Execute code (such as database updates) here.
                $new_ingredient = $_POST['ingredient'];
                $conn->query("INSERT INTO ingredients (ingredient) VALUES('$new_ingredient')");
                
                // Redirect to this page.
                header("Location:ingredients.php");
                //exit();
             }

            echo "<h1>Liste des ingrédients enregistrés dans la base de données</h1>";
            
            if ($result->num_rows > 0) {
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
                while($row = $result->fetch_assoc()) {
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
            $conn->close(); 
        ?>
    </body>
</html>