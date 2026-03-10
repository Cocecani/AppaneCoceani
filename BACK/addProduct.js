// funzione per chiudere modale
function chiudiModal(){
  document.querySelector('.modal').style.display='none';
}

// rimuovi riga ingrediente
document.addEventListener('click', function(e){
  if(e.target && e.target.classList.contains('remove-btn')){

    let container = document.getElementById('containerIngredients');
    let rows = container.querySelectorAll('.input-row');

    // controlla che rimanga almeno una select
    if(rows.length > 1){
      e.target.parentElement.remove();
    } 

  }
  // aggiungere riga
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

    document.getElementById("modalAdd").innerHTML = data;
    document.getElementById("modalAdd").style.display = "block";

  });

}

function closeModalAdd(){
  document.getElementById("modalAdd").style.display = "none";
}