let carrito = {};

function agregarAlCarrito(producto, precio) {
    if (carrito[producto]) {
        carrito[producto].cantidad++;
    } else {
        carrito[producto] = { precio, cantidad: 1 };
    }
    actualizarCarrito();
}

function vaciarCarrito() {
    carrito = {};
    actualizarCarrito();
}

function quitarDelCarrito(producto) {
    if (carrito[producto] && carrito[producto].cantidad > 0) {
        carrito[producto].cantidad--;
        if (carrito[producto].cantidad === 0) {
            delete carrito[producto];
        }
        actualizarCarrito();
    }
}

function actualizarCarrito() {
    const itemsCarrito = document.getElementById('itemsCarrito');
    itemsCarrito.innerHTML = '';

    Object.keys(carrito).forEach(producto => {
        const div = document.createElement('div');
        div.innerHTML = `${producto} - Cantidad: ${carrito[producto].cantidad} <button onclick="quitarDelCarrito('${producto}')">Quitar uno</button>`;
        itemsCarrito.appendChild(div);
    });
}


document.addEventListener('DOMContentLoaded', () => {
    const selectorTema = document.getElementById('themeSelector');
    selectorTema.addEventListener('change', (event) => {
        cambiarTema(event.target.value);
    });
});

function cambiarTema(tema) {
    document.body.className = ''; 
    switch(tema) {
        case 'oscuro':
            document.body.classList.add('tema-oscuro');
            break;
        case 'rojo':
            document.body.classList.add('tema-rojo');
            break;
        case 'azul':
            document.body.classList.add('tema-azul');
            break;

    }
}

const stripe = Stripe('tu_clave_publica_de_stripe');

function realizarPago() {
    stripe.redirectToCheckout({
        sessionId: 'ID_de_la_sesion_de_pago_generada_en_el_servidor',
    }).then(function (result) {
        // Maneja el resultado
        if (result.error) {
            console.error(result.error.message);
            alert('Hubo un error al procesar el pago.');
        }
    });
}


document.addEventListener("DOMContentLoaded", function () {
    // Realizar solicitud AJAX para obtener datos del backend
    fetch('backend.php')
        .then(response => response.json())
        .then(data => {
            // Manipular datos recibidos
            console.log(data.users); // Datos de usuarios
            console.log(data.posts); // Datos de publicaciones
        })
        .catch(error => console.error('Error:', error));
});


// Función para mostrar el formulario de agregar producto
function mostrarFormularioAgregar() {
    document.getElementById('formTitle').innerText = 'Agregar Producto';
    document.getElementById('productoForm').reset();
    document.getElementById('productoId').value = '';
    document.getElementById('formularioProducto').style.display = 'block';
}

// Función para mostrar el formulario de editar producto
function mostrarFormularioEditar(id, nombre, descripcion, precio, imagenURL) {
    document.getElementById('formTitle').innerText = 'Editar Producto';
    document.getElementById('productoId').value = id;
    document.getElementById('nombre').value = nombre;
    document.getElementById('descripcion').value = descripcion;
    document.getElementById('precio').value = precio;
    document.getElementById('imagenURL').value = imagenURL;
    document.getElementById('formularioProducto').style.display = 'block';
}

// Función para cerrar el formulario
function cerrarFormulario() {
    document.getElementById('formularioProducto').style.display = 'none';
}

// Función para guardar un producto (Agregar o Actualizar)
function guardarProducto() {
    // Implementar lógica para enviar los datos del formulario a tu servidor (usando AJAX, por ejemplo)
    // Puedes obtener los valores del formulario usando document.getElementById() y .value
    // Ejemplo: var nombre = document.getElementById('nombre').value;
    
    // Después de guardar, puedes cerrar el formulario
    cerrarFormulario();
}
