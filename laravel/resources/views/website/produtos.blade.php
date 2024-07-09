<html><head><base href="https://websim.ai" />
<title>Buffet Divino Sabor: Delícias para Festas</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/tippy.js@6"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

  :root {
    --color-primary: #FCB774;
    --color-primary-hover: #FAA562;
    --color-secondary: #FA856E;
    --color-secondary-hover: #F97058;
    --color-background: #FFF5E6;
    --color-text: #333333;
    --color-footer: #4A5568;
  }

  body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--color-background);
    color: var(--color-text);
  }

  .shadcn-button {
    @apply inline-flex items-center justify-center rounded-full text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none ring-offset-background;
    padding: 0.5rem 1.5rem;
  }

  .shadcn-button-primary {
    background-color: var(--color-secondary);
    color: white;
  }

  .shadcn-button-primary:hover {
    background-color: var(--color-secondary-hover);
  }

  .shadcn-button-secondary {
    background-color: var(--color-secondary);
    color: white;
  }

  .shadcn-button-secondary:hover {
    background-color: var(--color-secondary-hover);
  }

  .shadcn-button-outline {
    @apply border border-input hover:bg-accent hover:text-accent-foreground;
  }

  .shadcn-card {
    @apply rounded-xl border bg-card text-card-foreground shadow-sm;
    background-color: white;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .shadcn-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }

  .shadcn-badge {
    @apply inline-flex items-center border rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2;
  }

  .shadcn-input {
    @apply flex h-10 w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50;
  }

  .shadcn-label {
    @apply text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70;
  }

  .shadcn-select {
    @apply flex h-10 w-full items-center justify-between rounded-md border border-input bg-transparent px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50;
  }

.category-buttons {
    display: flex;
    justify-content: center; /* Centraliza os botões horizontalmente */
    margin-bottom: 20px;
}

.category-button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    margin-right: 10px;
}

.category-button.active {
    background-color: #0056b3;
}

  .category-button:hover {
    background-color: rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
  }

  .category-button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(250, 133, 110, 0.5);
  }

  .category-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.75rem;
  }

  .category-button i {
    margin-right: 8px;
  }

  #load-more {
    @apply mt-8 mx-auto block;
  }
</style>
</head>
<body>
  <header class="py-12" style="background-color: var(--color-background);">
    <div class="container mx-auto text-center">
      <h1 class="text-4xl font-bold mb-2">Bem-vindo ao Buffet Divino Sabor</h1>
      <p class="text-xl">Desfrute de nossas delícias para tornar sua festa inesquecível</p>
    </div>
  </header>

  <main class="container mx-auto my-8">
    <div class="flex flex-wrap -mx-4">
      <div class="w-full lg:w-3/4 px-4">
        <div class="mb-6 category-container">
        <ul class="filters_menu">
  <li class="category-button active" data-filter="*"><i class="fas fa-utensils"></i> Todos</li>
  <li class="category-button" data-filter=".salgado"><i class="fas fa-hamburger"></i> Salgados</li>
  <li class="category-button" data-filter=".doce"><i class="fas fa-cookie"></i> Doces</li>
  <li class="category-button" data-filter=".bebida"><i class="fas fa-glass-cheers"></i> Bebidas</li>
  <li class="category-button" data-filter=".vegetariano"><i class="fas fa-leaf"></i> Vegetariano</li>
</ul>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="product-list">
          <div class="shadcn-card">
            <img src="https://websim.ai/images/coxinha.jpg" class="w-full h-48 object-cover rounded-t-xl" alt="Coxinhas">
            <div class="p-4">
              <h5 class="font-semibold mb-2">Coxinhas</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ 2.50</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('Coxinhas')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-Coxinhas" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('Coxinhas')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('Coxinhas')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('Coxinhas')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>
        
          <div class="shadcn-card">
            <img src="https://websim.ai/images/bolinha-de-queijo.jpg" class="w-full h-48 object-cover rounded-t-xl" alt="Bolinhas de Queijo">
            <div class="p-4">
              <h5 class="font-semibold mb-2">Bolinhas de Queijo</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ 2.00</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('Bolinhas de Queijo')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-Bolinhas de Queijo" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('Bolinhas de Queijo')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('Bolinhas de Queijo')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('Bolinhas de Queijo')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>
        
          <div class="shadcn-card">
            <img src="https://websim.ai/images/kibe.jpg" class="w-full h-48 object-cover rounded-t-xl" alt="Kibe">
            <div class="p-4">
              <h5 class="font-semibold mb-2">Kibe</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ 2.50</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('Kibe')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-Kibe" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('Kibe')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('Kibe')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('Kibe')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>
        
          <div class="shadcn-card">
            <img src="https://websim.ai/images/mini-pizza.jpg" class="w-full h-48 object-cover rounded-t-xl" alt="Mini Pizzas">
            <div class="p-4">
              <h5 class="font-semibold mb-2">Mini Pizzas</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ 3.50</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('Mini Pizzas')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-Mini Pizzas" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('Mini Pizzas')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('Mini Pizzas')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('Mini Pizzas')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>
        
          <div class="shadcn-card">
            <img src="https://websim.ai/images/brigadeiro.jpg" class="w-full h-48 object-cover rounded-t-xl" alt="Brigadeiros">
            <div class="p-4">
              <h5 class="font-semibold mb-2">Brigadeiros</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ 1.50</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('Brigadeiros')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-Brigadeiros" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('Brigadeiros')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('Brigadeiros')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('Brigadeiros')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>
        
          <div class="shadcn-card">
            <img src="https://websim.ai/images/beijinho.jpg" class="w-full h-48 object-cover rounded-t-xl" alt="Beijinhos">
            <div class="p-4">
              <h5 class="font-semibold mb-2">Beijinhos</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ 1.50</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('Beijinhos')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-Beijinhos" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('Beijinhos')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('Beijinhos')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('Beijinhos')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>

          <div class="shadcn-card">
            <img src="https://websim.ai/images/refrigerante.jpg" class="w-full h-48 object-cover rounded-t-xl" alt="Refrigerante">
            <div class="p-4">
              <h5 class="font-semibold mb-2">Refrigerante</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ 5.00</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('Refrigerante')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-Refrigerante" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('Refrigerante')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('Refrigerante')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('Refrigerante')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>

          <div class="shadcn-card">
            <img src="https://websim.ai/images/suco.jpg" class="w-full h-48 object-cover rounded-t-xl" alt="Suco Natural">
            <div class="p-4">
              <h5 class="font-semibold mb-2">Suco Natural</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ 6.00</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('Suco Natural')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-Suco Natural" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('Suco Natural')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('Suco Natural')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('Suco Natural')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>

          <div class="shadcn-card">
            <img src="https://websim.ai/images/quiche.jpg" class="w-full h-48 object-cover rounded-t-xl" alt="Mini Quiche de Espinafre">
            <div class="p-4">
              <h5 class="font-semibold mb-2">Mini Quiche de Espinafre</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ 3.00</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('Mini Quiche de Espinafre')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-Mini Quiche de Espinafre" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('Mini Quiche de Espinafre')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('Mini Quiche de Espinafre')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('Mini Quiche de Espinafre')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>
        </div>
        <button id="load-more" class="shadcn-button shadcn-button-primary" onclick="loadMoreProducts()">
          <i class="fas fa-plus mr-2"></i>Ver Mais Produtos
        </button>
      </div>
      <div class="w-full lg:w-1/4 px-4">
        <div class="shadcn-card p-4 sticky top-4">
          <h3 class="text-lg font-semibold mb-4"><i class="fas fa-shopping-cart mr-2"></i>Seu Carrinho</h3>
          <ul id="cart-list" class="space-y-2 mb-4">
            <!-- Itens do carrinho serão adicionados aqui -->
          </ul>
          <p class="mb-4">Total: R$ <span id="cart-total">0.00</span></p>
          <button class="shadcn-button shadcn-button-secondary w-full" onclick="checkout()"><i class="fas fa-check mr-2"></i>Finalizar Pedido</button>
        </div>
      </div>
    </div>
  </main>

  <footer style="background-color: var(--color-footer); color: white;" class="py-6 mt-12">
    <div class="container mx-auto text-center">
      <p>&copy; 2023 Buffet Divino Sabor. Todos os direitos reservados.</p>
    </div>
  </footer>

  <script>
    let cart = {};
    let currentProducts = [];
    let displayedProducts = 9;
    const productsPerPage = 9;
    const products = [
      { name: 'Coxinhas', price: 2.50, category: 'salgado', image: 'coxinha.jpg' },
      { name: 'Bolinhas de Queijo', price: 2.00, category: 'salgado', image: 'bolinha-de-queijo.jpg' },
      { name: 'Kibe', price: 2.50, category: 'salgado', image: 'kibe.jpg' },
      { name: 'Mini Pizzas', price: 3.50, category: 'salgado', image: 'mini-pizza.jpg' },
      { name: 'Brigadeiros', price: 1.50, category: 'doce', image: 'brigadeiro.jpg' },
      { name: 'Beijinhos', price: 1.50, category: 'doce', image: 'beijinho.jpg' },
      { name: 'Refrigerante', price: 5.00, category: 'bebida', image: 'refrigerante.jpg' },
      { name: 'Suco Natural', price: 6.00, category: 'bebida', image: 'suco.jpg' },
      { name: 'Mini Quiche de Espinafre', price: 3.00, category: 'vegetariano', image: 'quiche.jpg' },
      { name: 'Bolinho de Queijo', price: 2.50, category: 'vegetariano', image: 'bolinho-queijo.jpg' },
      { name: 'Empadinha', price: 3.00, category: 'salgado', image: 'empadinha.jpg' },
      { name: 'Torta de Limão', price: 4.00, category: 'doce', image: 'torta-limao.jpg' },
      { name: 'Água Mineral', price: 2.00, category: 'bebida', image: 'agua-mineral.jpg' },
      { name: 'Bruschetta', price: 3.50, category: 'vegetariano', image: 'bruschetta.jpg' },
      { name: 'Pastel de Forno', price: 3.00, category: 'salgado', image: 'pastel-forno.jpg' },
    ];

    function loadMoreProducts() {
      const productList = document.getElementById('product-list');
      const endIndex = Math.min(displayedProducts + productsPerPage, currentProducts.length);
      
      for (let i = displayedProducts; i < endIndex; i++) {
        const product = currentProducts[i];
        const productHtml = `
          <div class="shadcn-card">
            <img src="https://websim.ai/images/${product.image}" class="w-full h-48 object-cover rounded-t-xl" alt="${product.name}">
            <div class="p-4">
              <h5 class="font-semibold mb-2">${product.name}</h5>
              <p class="text-sm text-muted-foreground mb-4"><i class="fas fa-tag mr-1"></i>R$ ${product.price.toFixed(2)}</p>
              <div class="flex items-center mb-4">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-l-md" onclick="decreaseQuantity('${product.name}')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity-${product.name}" value="1" min="1" max="99" class="shadcn-input mx-0 w-16 text-center rounded-none border-l-0 border-r-0" onchange="updateQuantity('${product.name}')">
                <button class="shadcn-button shadcn-button-outline px-2 py-1 rounded-r-md" onclick="increaseQuantity('${product.name}')"><i class="fas fa-plus"></i></button>
              </div>
              <button class="shadcn-button shadcn-button-secondary w-full rounded-md" onclick="addToCart('${product.name}')"><i class="fas fa-cart-plus mr-2"></i>Adicionar ao Carrinho</button>
            </div>
          </div>
        `;
        productList.innerHTML += productHtml;
      }
      
      displayedProducts = endIndex;
      document.getElementById('load-more').style.display = displayedProducts >= currentProducts.length ? 'none' : 'block';
    }

   // Função para filtrar produtos por categoria
$('.category-button').on('click', function() {
    const category = $(this).data('category');
    const filteredProducts = products.filter(product => product.category === category);

    // Limpar a lista de produtos
    $('#product-list').empty();

    // Construir HTML dos produtos filtrados
    let html = '';
    filteredProducts.forEach(product => {
        html += `<div class="product">${product.name}</div>`;
    });

    // Adicionar produtos filtrados ao container
    $('#product-list').append(html);

    // Atualizar classe ativa nos botões de categoria
    $('.category-button').removeClass('active');
    $(this).addClass('active');
});


    function addToCart(item) {
      const quantity = parseInt(document.getElementById(`quantity-${item}`).value);
      if (cart[item]) {
        cart[item] += quantity;
      } else {
        cart[item] = quantity;
      }
      updateCart();
    }

    function updateCart() {
      const cartList = document.getElementById('cart-list');
      const cartTotal = document.getElementById('cart-total');
      cartList.innerHTML = '';
      let total = 0;

      for (const [item, count] of Object.entries(cart)) {
        const product = products.find(p => p.name === item);
        const li = document.createElement('li');
        li.className = 'flex justify-between items-center';
        li.innerHTML = `
          <span><i class="fas fa-drumstick-bite mr-2"></i>${item} x${count}</span>
          <span class="flex items-center">
            R$ ${(product.price * count).toFixed(2)}
            <button class="shadcn-button shadcn-button-outline ml-2 p-1 rounded-full" onclick="confirmRemoveFromCart('${item}')">
              <i class="fas fa-trash-alt"></i>
            </button>
          </span>
        `;
        cartList.appendChild(li);
        total += product.price * count;
      }

      cartTotal.textContent = total.toFixed(2);
    }

    function confirmRemoveFromCart(item) {
      if (confirm(`Tem certeza que deseja remover ${item} do carrinho?`)) {
        removeFromCart(item);
      }
    }

    function removeFromCart(item) {
      delete cart[item];
      updateCart();
    }

    function checkout() {
      alert('Pedido finalizado! Total: R$ ' + document.getElementById('cart-total').textContent);
      cart = {};
      updateCart();
    }

    function decreaseQuantity(item) {
      const input = document.getElementById(`quantity-${item}`);
      if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
      }
    }

    function increaseQuantity(item) {
      const input = document.getElementById(`quantity-${item}`);
      if (input.value < 99) {
        input.value = parseInt(input.value) + 1;
      }
    }

    function updateQuantity(item) {
      const input = document.getElementById(`quantity-${item}`);
      if (input.value < 1) {
        input.value = 1;
      } else if (input.value > 99) {
        input.value = 99;
      }
    }

    // Inicializar a página com todos os produtos
    currentProducts = products;
    loadMoreProducts();

    // Inicializar tooltips
    tippy('[data-tippy-content]');
  </script>
</body></html>