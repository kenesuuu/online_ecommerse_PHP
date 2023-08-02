const bar = document.getElementById('bar');
const nav = document.getElementById('navbar');
const close = document.getElementById('close');

if (bar) {
    bar.addEventListener('click',()=> {
        nav.classList.add('active');
    })
}

if (close) {
    close.addEventListener('click',()=> {
        nav.classList.remove('active');
    })
}

function incrementQuantity() {
    var quantityInput = document.getElementById("quantity-input");
    quantityInput.value = parseInt(quantityInput.value) + 1;
  }
  
  function decrementQuantity() {
    var quantityInput = document.getElementById("quantity-input");
    if (parseInt(quantityInput.value) > 1) {
      quantityInput.value = parseInt(quantityInput.value) - 1;
    }
  }
  
