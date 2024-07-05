document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  const searchBtn = document.getElementById('searchBtn');
  const products = document.querySelectorAll('.product');

  searchBtn.addEventListener('click', function() {
    filterProducts(searchInput.value.toLowerCase());
  });

  searchInput.addEventListener('keyup', function() {
    filterProducts(searchInput.value.toLowerCase());
  });

  function filterProducts(searchTerm) {
    products.forEach(product => {
      const title = product.querySelector('h3').textContent.toLowerCase();
      const description = product.querySelector('p').textContent.toLowerCase();

      if (title.includes(searchTerm) || description.includes(searchTerm)) {
        product.style.display = 'block';
      } else {
        product.style.display = 'none';
      }
    });
  }
});
const carrito = document.getElementById('carrito');
const elementos1 = document.getElementById('lista-1');
const elementos2 = document.getElementById('lista-2');
const lista = document.querySelector('#lista-carrito tbody');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');
const comprarCarritoBtn = document.getElementById('comprar-carrito');
let stripe;

// Agregado: Referencia al modal
const modal = document.getElementById("modal");
// Agregado: Referencia al botón de cierre
const closeBtn = document.querySelector(".modal .close");
// Agregado: Referencia al botón de seguir comprando
const continueBtn = document.querySelector(".continue-shopping");

// Agregado: Función para cerrar el modal
closeBtn.onclick = function () {
  modal.style.display = "none";
}

// Agregado: Cerrar el modal al hacer clic fuera de él
window.onclick = function (event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
}
// Agregado: Función para cerrar el modal
closeBtn.onclick = function () {
  modal.style.display = "none";
}

// Agregado: Cerrar el modal al hacer clic fuera de él
window.onclick = function (event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
}
// Agregado: Función para cerrar el modal al hacer clic en seguir comprando
continueBtn.onclick = function () {
  modal.style.display = "none";
}

cargarEventListeners();


function cargarEventListeners() {
  elementos1.addEventListener('click', comprarElemento);
  elementos2.addEventListener('click', comprarElemento);
  carrito.addEventListener('click', eliminarElemento);
  vaciarCarritoBtn.addEventListener('click', vaciarCarrito);
  comprarCarritoBtn.addEventListener('click', pagarCarrito);
}

function comprarElemento(e) {
  e.preventDefault();
  if (e.target.classList.contains('agregar-carrito')) {
    const elemento = e.target.parentElement.parentElement;
    leerDatosElemento(elemento);
    mostrarModal();
  }
}

function leerDatosElemento(elemento) {
  const infoElemento = {
    imagen: elemento.querySelector('img').src,
    titulo: elemento.querySelector('h3').textContent,
    precio: elemento.querySelector('.precio').textContent,
    id: elemento.querySelector('a').getAttribute('data-id')
  }
  insertarCarrito(infoElemento);
}

function insertarCarrito(elemento) {
  const row = document.createElement('tr');
  row.innerHTML = `
        <td>
        <img src="${elemento.imagen}" width=100 >
        </td>
         <td>
         ${elemento.titulo}
        </td>
         <td>
         ${elemento.precio}
        </td>
         <td>
         <a href="#" class="borrar" data-id="${elemento.id}">X</a>
        </td>
        `;
  lista.appendChild(row);
}

function eliminarElemento(e) {
  e.preventDefault();
  if (e.target.classList.contains('borrar')) {
    e.target.parentElement.parentElement.remove();
  }
}

function vaciarCarrito() {
  while (lista.firstChild) {
    lista.removeChild(lista.firstChild);
  }
  return false;
}

function mostrarModal() {
  modal.style.display = "block";
}

// Agregado: Función para cerrar el modal
closeBtn.onclick = function () {
  modal.style.display = "none";
}

window.onclick = function (event) {
  if (event.target === modal) {
    modal.style.display = "none"; // Agregado: Cerrar el modal al hacer clic fuera de él
  }
}
closeBtn.onclick = function () {
  modal.style.display = "none"; // Agregado: Función para cerrar el modal
}

window.onclick = function (event) {
  if (event.target === modal) {
    modal.style.display = "none"; // Agregado: Cerrar el modal al hacer clic fuera de él
  }
}
continueBtn.onclick = function () {
  modal.style.display = "none"; // Agregado: Función para cerrar el modal al hacer clic en seguir comprando
}

function calcularTotal() {
  let total = 0;
  const items = lista.querySelectorAll('tr');
  items.forEach(item => {
    const precio = parseFloat(item.querySelector('td:nth-child(3)').textContent.replace('S/. ', ''));
    total += precio;
  });
  return total;
}

async function pagarCarrito() {
  const total = calcularTotal() * 100; // Convertir a centavos
  if (total === 0) {
    alert("El carrito está vacío");
    return;
  }

  try {
    const response = await fetch('/php/create-checkout-session.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        amount: total
      })
    });

    const session = await response.json();
    stripe.redirectToCheckout({ sessionId: session.id }); // Redirigir a Stripe para pagar
  } catch (error) {
    console.error('Error al procesar el pago:', error);
    alert('Hubo un problema al procesar el pago. Por favor, inténtalo nuevamente más tarde.');
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  stripe = Stripe('pk_test_zkJcOuqVTu4jYHlJclMwuBdo'); // Inicializar Stripe
});

