<?php
    include('connect_db.php');
    $result = $conn->query("SELECT * FROM recipes ORDER BY recipe");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/backoffice.css">
        <title>recipes list</title>
    </head>

    <body>
        <h1>Formulaire d'ajout de nouvelles recettes</h1>
        <form name = 'insert_recipe' action='recipes.php' method='post'>
            <label for='recipe'>Nouvelle recette:</label>
            <input type='text' id='recipe' name='recipe'><br>
            <label for='recipe'>Nombre de personnes</label>
            <input type='text' id='number_of_people' name='number_of_people'><br>
            <label for='category'>Catégory:</label>
            <select id='category' name='category'>
                <option value= plat>plat</option>
                <option value= entrée>entrée</option>
                <option value= dessert>dessert</option>
            </select><br>
            <label for='type'>Type:</label>
            <select id='type' name='type'>
                <option value= classique>classique</option>
                <option value= cookéo>cookéo</option>
            </select><br><br>
            <label for='is_number_of_people_modifiable'>Nombre de personnes modifiable?:</label>
            <select id='is_number_of_people_modifiable' name='is_number_of_people_modifiable'>
                <option value= 1>1</option>
                <option value= 0>0</option>
            </select><br><br>
            <input type='submit' value='Ajouter'>
        </form>
        <?php
            if ($_POST) {
                // Execute code (such as database updates) here.
                $recipe = $_POST['recipe'];
                $number_of_people = (int) $_POST['number_of_people'];
                $type = $_POST['type'];
                $category = $_POST['category'];
                $is_number_of_people_modifiable = (int) $_POST['is_number_of_people_modifiable'];

                $conn->query(
                    "INSERT INTO recipes (recipe, number_of_people, type, category, is_number_of_people_modifiable) 
                    VALUES('$recipe', '$number_of_people', '$type', '$category', '$is_number_of_people_modifiable')"
                );
                
                // Redirect to this page.
                header("Location:recipes.php");
                //exit();
             } 

            echo "<h1>Liste des recettes enregistrées dans la base de données</h1>";
            
            if ($result->num_rows > 0) {
                echo "
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>recette</th>
                                <th>nombre de personnes</th>
                                <th>catégory</th>
                                <th>type</th>
                            </tr>
                        </thead>";
                echo " <tbody>";
                // output data of each row
                while($row = $result->fetch_assoc()) {
                echo "
                            <tr>
                                <td>".$row['recipe_id']."</td>
                                <td>".$row['recipe']."</td>
                                <td>".$row['number_of_people']."</td>
                                <td>".$row['category']."</td>
                                <td>".$row['type']."</td></tr>
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