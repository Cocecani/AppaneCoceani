document.addEventListener('click', function(e){
  if(e.target && e.target.classList.contains('remove-btn')){

    let container = document.getElementById('containerIngredients');
    let rows = container.querySelectorAll('.input-row');

    if(rows.length > 1){
      e.target.parentElement.remove();
    } 

  }
  
  if(e.target && e.target.id === 'add-ingredient'){
    let container = document.getElementById('containerIngredients');
    let firstRow = container.querySelector('.input-row');
    let newRow = firstRow.cloneNode(true);
    newRow.querySelector('select').value = "";
    container.appendChild(newRow);
  }

});

function openModalAdd(){

  fetch("modalAddProduct.php")
  .then(response => response.text())
  .then(data => {

    document.getElementById("modal").innerHTML = data;
    document.getElementById("modal").style.display = "block";

  });

}

function openModalModify(id){

  fetch("modalModifyProduct.php?id="+id)
  .then(response => response.text())
  .then(data => {

    document.getElementById("modal").innerHTML = data;
    document.getElementById("modal").style.display = "block";

  });

}

function closeModal(){
  document.getElementById("modal").style.display = "none";
}