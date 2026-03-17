document.addEventListener('click', function(e){
  if(e.target && e.target.classList.contains('remove-item')){

    let container = document.getElementById('containerItems');
    let rows = container.querySelectorAll('.input-row');

    if(rows.length > 1){
      e.target.parentElement.remove();
    } 

  }
  
  if(e.target && e.target.id === 'add-item'){
    let container = document.getElementById('containerItems');
    let firstRow = container.querySelector('.input-row');
    let newRow = firstRow.cloneNode(true);
    newRow.querySelector('select').value = "";
    container.appendChild(newRow);
  }

});

function openModal(url){
  fetch(url)
  .then(response => response.text())
  .then(data => {
    document.getElementById("modal").innerHTML = data;
    document.getElementById("modal").style.display = "block";

  });
}

function closeModal(){
  document.getElementById("modal").style.display = "none";
}

document.addEventListener('input', function(e){

  if(e.target.classList.contains('quantity')){

    let input = e.target;

    let price = parseFloat(input.dataset.price);
    let id = input.dataset.id;

    let quantity = parseFloat(input.value) || 0;

    let total = (quantity * price).toFixed(2);

    let span = document.getElementById("total" + id);

    span.innerText = " × " + price + " € = " + total + " €";

  }

});