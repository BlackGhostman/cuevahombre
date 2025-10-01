 <?php
include '../php/conexion.php';

@session_start();

if (!isset($_SESSION['id'])) {
    header('Location:../../index.php');
    exit();
}

// Fetch products
$query_productos = $base_de_datos->query("SELECT id_pro, nombre_pro, precio_venta, stock, imagen FROM producto WHERE stock > 0 AND estado IN ('a', 'd')");
$productos = $query_productos->fetchAll(PDO::FETCH_ASSOC);

// Fetch barbers
$query_barberos = $base_de_datos->query("SELECT id, nombre FROM usuario WHERE tipo IN ('empleado', 'administrador')");
$barberos = $query_barberos->fetchAll(PDO::FETCH_ASSOC);

// Fetch payment methods
$query_metodos_pago = $base_de_datos->query("SELECT id_cat_ingresos, nombre FROM categoria_ingresos");
$metodos_pago = $query_metodos_pago->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto de Venta Moderno</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .product-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">

    <div class="flex flex-col lg:flex-row lg:h-screen">

        <!-- Columna Izquierda: Resumen de la Venta -->
        <aside class="w-full lg:w-1/3 xl:w-1/4 bg-white p-6 flex flex-col shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-slate-700 border-b pb-4">Resumen de Venta</h2>
            
            <div id="cart-items" class="flex-grow overflow-y-auto custom-scrollbar pr-2">
                <div id="empty-cart-message" class="flex flex-col items-center justify-center h-full text-slate-400">
                    <i class="fas fa-shopping-cart fa-3x mb-4"></i>
                    <p class="text-center">Aún no hay productos en la venta.</p>
                </div>
            </div>

            <div class="mt-auto pt-6 border-t">
                <div class="flex justify-between items-center mb-2 text-slate-600">
                    <span>Subtotal:</span>
                    <span id="subtotal" class="font-medium">₡ 0</span>
                </div>
                <div class="flex justify-between items-center mb-2 text-slate-600">
                    <span>Descuento:</span>
                    <span id="discount-amount" class="font-medium">₡ 0</span>
                </div>
                <div class="flex justify-between items-center text-xl font-bold text-slate-800 mt-4">
                    <span>Total:</span>
                    <span id="total">₡ 0</span>
                </div>
                <button id="complete-sale-btn" class="w-full bg-teal-500 text-white font-bold py-3 rounded-lg mt-6 hover:bg-teal-600 transition-colors disabled:bg-slate-300 disabled:cursor-not-allowed">
                    <i class="fas fa-check-circle mr-2"></i>
                    Terminar Venta
                </button>
            </div>
        </aside>

        <!-- Columna Derecha: Productos y Controles -->
        <main class="w-full lg:w-2/3 xl:w-3/4 p-6 flex flex-col overflow-y-auto custom-scrollbar">
            <div class="bg-white rounded-xl shadow-md p-4 mb-6">
                <h1 class="text-2xl font-bold text-teal-600 mb-4">Panel de Ventas</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Seleccionar Cliente -->
                    <div class="relative">
                        <label for="cliente" class="text-xs font-semibold text-slate-500 mb-1 block">Seleccione Cliente</label>
                        <i class="fas fa-user absolute left-3 top-9 text-slate-400"></i>
                        <input type="text" id="cliente" placeholder="Buscar..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                    <!-- Seleccionar Barbero -->
                    <div>
                        <label for="barbero" class="text-xs font-semibold text-slate-500 mb-1 block">Seleccione Barbero</label>
                        <select id="barbero" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white">
                            <option value="">Seleccione...</option>
                            <?php foreach ($barberos as $barbero): ?>
                                <option value="<?php echo htmlspecialchars($barbero['id']); ?>"><?php echo htmlspecialchars($barbero['nombre']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Descuento -->
                    <div>
                        <label for="descuento" class="text-xs font-semibold text-slate-500 mb-1 block">Descuento (%)</label>
                        <input type="number" id="descuento" value="0" min="0" max="100" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                    <!-- Método de Pago -->
                    <div>
                        <label for="metodo-pago" class="text-xs font-semibold text-slate-500 mb-1 block">Método de Pago</label>
                        <select id="metodo-pago" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white">
                            <option value="">Seleccione...</option>
                             <?php foreach ($metodos_pago as $metodo): ?>
                                <option value="<?php echo htmlspecialchars($metodo['id_cat_ingresos']); ?>"><?php echo htmlspecialchars($metodo['nombre']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Búsqueda y Productos -->
            <div class="flex-grow flex flex-col bg-white rounded-xl shadow-md p-4">
                <div class="relative mb-4">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" id="search-product" placeholder="Buscar producto por nombre..." class="w-full pl-12 pr-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div id="product-list" class="flex-grow overflow-y-auto custom-scrollbar p-2 grid product-grid gap-4">
                    <!-- Los productos se cargarán aquí -->
                </div>
            </div>
        </main>
    </div>
    
    <!-- Modal de notificación -->
    <div id="notification-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-8 shadow-xl text-center">
            <div class="text-teal-500 mb-4">
                <i class="fas fa-check-circle fa-4x"></i>
            </div>
            <h3 class="text-2xl font-bold mb-2">¡Éxito!</h3>
            <p class="text-slate-600">La venta se ha completado correctamente.</p>
            <button id="close-modal-btn" class="mt-6 bg-teal-500 text-white px-6 py-2 rounded-lg hover:bg-teal-600 transition-colors">Cerrar</button>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const products = <?php echo json_encode($productos); ?>.map(p => ({
        id: parseInt(p.id_pro),
        name: p.nombre_pro,
        price: parseFloat(p.precio_venta),
        stock: parseInt(p.stock),
        img: `../producto/subir_producto/${p.imagen}` // Assuming image path
    }));

    let cart = [];

    const productListContainer = document.getElementById('product-list');
    const cartItemsContainer = document.getElementById('cart-items');
    const emptyCartMessage = document.getElementById('empty-cart-message');
    const subtotalEl = document.getElementById('subtotal');
    const discountAmountEl = document.getElementById('discount-amount');
    const totalEl = document.getElementById('total');
    const searchInput = document.getElementById('search-product');
    const discountInput = document.getElementById('descuento');
    const completeSaleBtn = document.getElementById('complete-sale-btn');
    const notificationModal = document.getElementById('notification-modal');
    const closeModalBtn = document.getElementById('close-modal-btn');

    const formatCurrency = (number) => {
        return new Intl.NumberFormat('es-CR', { style: 'currency', currency: 'CRC' }).format(number);
    };

    const renderProducts = (productsToRender) => {
        productListContainer.innerHTML = '';
        if (productsToRender.length === 0) {
            productListContainer.innerHTML = `<p class="text-slate-500 col-span-full text-center">No se encontraron productos.</p>`;
            return;
        }
        productsToRender.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'bg-slate-50 p-3 rounded-lg text-center cursor-pointer hover:shadow-md hover:bg-teal-50 transition-all duration-200 flex flex-col';
            productCard.innerHTML = `
                <img src="${product.img}" alt="${product.name}" class="w-full h-28 object-cover rounded-md mb-3 mx-auto" onerror="this.src='https://placehold.co/150x150/e2e8f0/334155?text=No+Img'">
                <p class="font-semibold text-sm flex-grow">${product.name}</p>
                <p class="font-bold text-teal-600 mt-2">${formatCurrency(product.price)}</p>
            `;
            productCard.addEventListener('click', () => addProductToCart(product.id));
            productListContainer.appendChild(productCard);
        });
    };

    const addProductToCart = (productId) => {
        const product = products.find(p => p.id === productId);
        const existingProduct = cart.find(item => item.productId === productId);

        if (existingProduct) {
            if (existingProduct.quantity < product.stock) {
                 existingProduct.quantity++;
            } else {
                alert('No hay más stock disponible para este producto.');
            }
        } else {
            if (product.stock > 0) {
                cart.push({ productId: product.id, name: product.name, price: product.price, quantity: 1 });
            } else {
                 alert('Este producto está agotado.');
            }
        }
        renderCart();
        updateTotals();
    };

    const renderCart = () => {
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '';
            emptyCartMessage.classList.remove('hidden');
            return;
        }
        
        emptyCartMessage.classList.add('hidden');
        cartItemsContainer.innerHTML = '';

        cart.forEach(item => {
            const cartItemEl = document.createElement('div');
            cartItemEl.className = 'flex items-center justify-between mb-4';
            cartItemEl.innerHTML = `
                <div>
                    <p class="font-semibold">${item.name}</p>
                    <p class="text-sm text-slate-500">${formatCurrency(item.price)}</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="quantity-change text-slate-500 hover:text-red-500" data-id="${item.productId}" data-change="-1"><i class="fas fa-minus-circle"></i></button>
                    <span class="font-bold w-5 text-center">${item.quantity}</span>
                    <button class="quantity-change text-slate-500 hover:text-green-500" data-id="${item.productId}" data-change="1"><i class="fas fa-plus-circle"></i></button>
                </div>
            `;
            cartItemsContainer.appendChild(cartItemEl);
        });
    };
    
    const updateTotals = () => {
        const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        const discountPercentage = parseFloat(discountInput.value) || 0;
        const discount = subtotal * (discountPercentage / 100);
        const total = subtotal - discount;

        subtotalEl.textContent = formatCurrency(subtotal);
        discountAmountEl.textContent = formatCurrency(discount);
        totalEl.textContent = formatCurrency(total);
        
        completeSaleBtn.disabled = cart.length === 0;
    };
    
    const changeQuantity = (productId, change) => {
        const productInCart = cart.find(item => item.productId === productId);
        if (productInCart) {
            const product = products.find(p => p.id === productId);
            const newQuantity = productInCart.quantity + change;

            if (change > 0 && newQuantity > product.stock) {
                 alert('No hay más stock disponible para este producto.');
                 return;
            }

            productInCart.quantity = newQuantity;

            if (productInCart.quantity <= 0) {
                cart = cart.filter(item => item.productId !== productId);
            }
        }
        renderCart();
        updateTotals();
    };

    const filterProducts = () => {
        const searchTerm = searchInput.value.toLowerCase();
        const filtered = products.filter(product => product.name.toLowerCase().includes(searchTerm));
        renderProducts(filtered);
    };

    const resetSale = () => {
        cart = [];
        discountInput.value = 0;
        document.getElementById('cliente').value = '';
        document.getElementById('barbero').value = '';
        document.getElementById('metodo-pago').value = '';
        renderCart();
        updateTotals();
    };

    searchInput.addEventListener('input', filterProducts);
    discountInput.addEventListener('input', updateTotals);

    cartItemsContainer.addEventListener('click', (e) => {
        const button = e.target.closest('.quantity-change');
        if (button) {
            const productId = parseInt(button.dataset.id);
            const change = parseInt(button.dataset.change);
            changeQuantity(productId, change);
        }
    });

    completeSaleBtn.addEventListener('click', () => {
        if(cart.length === 0) return;

        const saleData = {
            cart: cart,
            total: cart.reduce((sum, item) => sum + item.price * item.quantity, 0),
            descuento: parseFloat(discountInput.value) || 0,
            id_cliente: document.getElementById('cliente').value, // Needs a proper customer selection implementation
            id_empleado: document.getElementById('barbero').value,
            id_metodo_pago: document.getElementById('metodo-pago').value,
        };

        // Simple validation
        if (!saleData.id_empleado || !saleData.id_metodo_pago) {
            alert('Por favor, seleccione un barbero y un método de pago.');
            return;
        }

        // AJAX call to a new PHP script to process the sale
        fetch('procesar_venta_moderna.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(saleData),
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                notificationModal.classList.remove('hidden');
            } else {
                alert('Error al procesar la venta: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error de conexión al procesar la venta.');
        });
    });

    closeModalBtn.addEventListener('click', () => {
        notificationModal.classList.add('hidden');
        resetSale();
    });

    renderProducts(products);
    updateTotals();
});
</script>

</body>
</html>