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
        <link rel="stylesheet" href="recipes/backoffice.css">
        <title>units list</title>
    </head>

    <body>
        <h1>Formulaire d'ajout de nouvelles unités</h1>
        <form name = 'insert_unit' action='/units' method='post'>
            <label for='unit'>Nouvelle unité:</label>
            <input type='text' id='unit' name='unit'><br>
            <label for='unit'>Description</label>
            <input type='text' id='description' name='description'><br>
            <input type='submit' value='Ajouter'>
        </form>
        <?php    
            echo "<h1>Liste des unités enregistrées dans la base de données</h1>";
            
            if ($unitsTable->num_rows > 0) {
                echo "
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>unité</th>
                                <th>description</th>
                            </tr>
                        </thead>";
                echo "  <tbody>";
                // output data of each row
                while($row = $unitsTable->fetch_assoc()) {
                  echo "
                            <tr>
                                <td>".$row["unit_id"]."</td>
                                <td>".$row["unit"]."</td>
                                <td>".$row["description"]."</td>
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