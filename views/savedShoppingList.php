<!DOCTYPE html>
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<script>
        let stateStack = [];
</script>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Liste de courses">
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=block"/>
        <link rel="stylesheet" href="css/partials/topNav.css?v=4">
        <link rel="stylesheet" href="css/shoppingList.css?v=20">
        <script src="js/shoppingList.js?v=9"></script>
        <title>Ma liste de courses</title>
    </head>
    <body>
        <?php require 'views/partials/topNav.php' ?>
        <main>
            <div id='recipeList'>
                <h2>Mes recettes</h2>
                <ul id='myRecipes'></ul>
                <script>
                    const recipe_list = JSON.parse(localStorage.getItem('recipe_list'));
                    
                    for (var i = 0; i < recipe_list.length; i++) {
                        
                        const li = document.createElement("li");
                        li.innerHTML = recipe_list[i];
                        
                        document.getElementById("myRecipes").appendChild(li)
                    }
                </script>
            </div>
            <img src='images/trolley.png' id='trolley'>
            <div id='shoppingList'>
                <h2>Ma liste de courses</h2>
                <div class="saveBox">
                    <button id='saveButton' onclick="saveShoppingList()">
                        <span class="material-symbols-outlined" style="font-size:40px;">save</span>
                    </button>
                </div>
                <div class="undoBox">
                    <button class='undoButton' onclick="undo()">
                        <span class="material-symbols-outlined">undo</span>  
                    </button>
                    <p>Rajouter un article supprimé</p>
                </div>
                <table id= 'shoppingListTable'>
                    <thead>
                        <tr>
                            <th>article</th>
                            <th>quantité</th>
                            <th>unité</th>
                            <th><button id='insertRowButton' onclick='insertRow()'>
                            <span class="material-symbols-outlined">add</span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>
            <img src='images/check_mark.png' id='checkMark'>
        </main>

        <script>
            // Retrieve data from local storage
            const retrievedData = localStorage.getItem('tableData');
            
            if (retrievedData) {
            const parsedData = JSON.parse(retrievedData);
            const tableBody = document.getElementById('tableBody');
            
            const deleleteButton = "\
                <button id='deleteButton' onclick='deleteRow(this)'>\
                    <span class='material-symbols-outlined'>delete</span>\
                </button>\
            ";

            // Iterate over the data and create table rows dynamically
            parsedData.forEach(
                rowData => {
                    const row = document.createElement('tr');
                    const ingredientCell = document.createElement('td');
                    const quantityCell = document.createElement('td');
                    const unitCell = document.createElement('td');
                    const deleteButtonCell = document.createElement('td');
    
                    ingredientCell.innerText = rowData.ingredient;
                    quantityCell.innerText = rowData.quantity;
                    unitCell.innerText = rowData.unit;
                    deleteButtonCell.innerHTML = deleleteButton;
    
                    row.appendChild(ingredientCell);
                    row.appendChild(quantityCell);
                    row.appendChild(unitCell);
                    row.appendChild(deleteButtonCell);
    
                    tableBody.appendChild(row);
                }
            );
        }
        </script> 
    </body>
</html>