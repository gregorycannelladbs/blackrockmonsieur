function saveOriginalQuantities() {

    numberOfRows = document.getElementById("ingredientsTable").rows.length -1;

    var quantities = [];

    for (i = 0; i <= numberOfRows; i++) {
        quantities[i] = Number(document.getElementById("ingredientsTable").rows[i].cells[1].innerHTML);
    }

    //quantities.splice(0,1);
    //quantities.filter(x => !isNaN(x))
    quantities[0] = 0;
    
    return quantities
}

function modifyQuantities() {
    if(document.getElementById("modifiedNumberOfPeople").value != "Nombre") {

        var modifiedNumberOfPeople = Number(document.getElementById("modifiedNumberOfPeople").value);
        var numberOfRows = document.getElementById("ingredientsTable").rows.length -1;
    
        document.getElementById("recipeTitle").innerHTML =
            document.getElementById("recipeTitle").innerHTML.replace(/[0-9]/g, modifiedNumberOfPeople);
    
        for (i = 1; i <= numberOfRows; i++) {
            var quantity = originalQuantities[i];
    
            var modifiedQuantity = quantity / numberOfPeople * modifiedNumberOfPeople;
            var modifiedQuantity = Math.round((modifiedQuantity + Number.EPSILON) * 100) / 100;
    
            document.getElementById("ingredientsTable").rows[i].cells[1].innerHTML = modifiedQuantity;
        }
    }
}