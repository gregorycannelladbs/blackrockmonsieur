function saveShoppingList() {
    // Retrieve recipes
        //Create an array to store the li values
    var recipe_list = [];

    var values = document.querySelectorAll('li');
    //Cycle through the li array
    for (var i = 0; i < values.length; i++) {
      recipe_list.push(values[i].innerHTML);
    }

    console.log(recipe_list);
    
    localStorage.setItem('recipe_list', JSON.stringify(recipe_list));
    
    // Retrieve data from the HTML table
    const table = document.getElementById('shoppingListTable');
    const rows = table.rows;
    const data = [];
    
    for (let i = 1; i < rows.length; i++) {
    const cells = rows[i].cells;
    const rowData = {
      ingredient: cells[0].innerText,
      quantity: cells[1].innerText,
      unit: cells[2].innerText
    };
    data.push(rowData);
    }
    
    // Convert data to JSON and save to local storage
    localStorage.setItem('tableData', JSON.stringify(data));
    
    //alert('Ta liste de course a été sauvegardée!');
    
    window.location.replace("/savedShoppingList");
}

function deleteRow(r) {
  var index = r.parentNode.parentNode.rowIndex;
  document.querySelector('#shoppingListTable').deleteRow(index);

  var table = document.querySelector('#shoppingListTable');
  var trolley = document.querySelector('#trolley');
  var shoppingList = document.querySelector('#shoppingList');

  if (table.rows.length == 1) {
    trolley.style.display = "none";
    shoppingList.style.display = "none";
    document.querySelector('#checkMark').style.display = "block";
  }
}

function insertRow() {
  var table = document.querySelector('#shoppingListTable');
  var row = table.insertRow(1);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);

  cell1.innerHTML =  "<p contenteditable='true' id= 'itemName'></p>";
  cell2.innerHTML = "<p contenteditable='true' id= 'quantity'></p>";
  cell3.innerHTML = "<p contenteditable='true' id= 'unit'></p>";
  cell4.innerHTML = "<td><button id='deleteButton' onclick='deleteRow(this)'><span class='material-symbols-outlined'>delete</span></button></td>";
}