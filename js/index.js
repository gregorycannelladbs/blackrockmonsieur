function filterRecipes() {
    var input = document.getElementById("search");
    var filter = input.value.toLowerCase();
    var nodes = document.getElementsByClassName('container');
  
    for (i = 0; i < nodes.length; i++) {
      if (nodes[i].innerText.toLowerCase().includes(filter)) {
        nodes[i].style.display = "flex";
      } else {
        nodes[i].style.display = "none";
      }
    }
  }
  
function showSubmitButton() {
  var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');

  if (checkboxes.length > 0) {
    document.getElementById("submitButton").style.display = "inline-block";
  } else {
    document.getElementById("submitButton").style.display = "none";
  }
}