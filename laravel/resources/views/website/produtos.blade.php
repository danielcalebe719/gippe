<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons (versão 1.10.0) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
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
      padding-top: 20px;
    }

    .filters_menu {
      list-style: none;
      padding: 0;
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 20px;
    }

    .filters_menu li {
      cursor: pointer;
      padding: 10px 15px;
      background-color: #f0f0f0;
      border-radius: 5px;
    }

    .filters_menu li.active {
      background-color: var(--color-secondary);
      color: white;
    }

    .filters-content .grid {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .card {
      width: 100%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fff;
      overflow: hidden;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .card-body {
      padding: 10px;
    }

    .card-title {
      font-size: 1.25rem;
      margin-bottom: 10px;
    }

    .card-text {
      color: #666;
      font-size: 1rem;
      margin-bottom: 10px;
    }

    .price {
      font-size: 1.25rem;
      font-weight: bold;
    }

    .quantity {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 120px;
      margin-top: 10px;
    }

    .quantity input {
      text-align: center;
      width: 50px;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 5px;
      font-size: 1rem;
      outline: none;
    }

    .quantity button {
      background-color: var(--color-secondary);
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .quantity button:hover {
      background-color: var(--color-secondary-hover);
    }

    .btn-add-to-cart {
      background-color: var(--color-secondary);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-add-to-cart:hover {
      background-color: var(--color-secondary-hover);
    }

    .cart-container {
      width: 100%;
      max-width: 400px; /* Ajustado para 400px */
      position: sticky;
      top: 80px; /* Ajustar conforme necessário */
      padding-left: 15px;
    }

    .cart-items {
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fff;
      padding: 15px;
      margin-top: 20px;
    }

    .cart-items h3 {
      font-size: 1.25rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .cart-item {
      display: flex;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
    }

    .cart-item:last-child {
      border-bottom: none;
    }

    .cart-item-img {
      flex: 0 0 60px;
      margin-right: 10px;
    }

    .cart-item-info {
      flex-grow: 1;
    }

    .cart-item-info h6 {
      font-size: 1rem;
      margin-bottom: 5px;
    }

    .cart-item-info p {
      font-size: 0.875rem;
      color: #666;
      margin-bottom: 5px; /* Espaço entre os itens */
    }

    .cart-item-info button {
      background-color: transparent;
      border: none;
      color: var(--color-secondary);
      cursor: pointer;
    }

    .total-price {
      margin-top: 20px;
      text-align: right;
      font-size: 1.25rem;
      font-weight: bold;
    }

    .checkout-btn {
      background-color: var(--color-primary);
      color: white;
      border: none;
      padding: 15px 30px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .checkout-btn:hover {
      background-color: var(--color-primary-hover);
    }

    /* Estilos para os serviços */
    .services-container {
      margin-top: 30px;
    }

    .services-container .card {
      box-shadow: none;
      border: none;
      background-color: transparent;
      margin-bottom: 15px;
    }

    .services-container .card-body {
      padding: 10px;
    }

    .services-container .card-title {
      font-size: 1rem;
      margin-bottom: 5px;
    }

    .services-container .card-text {
      font-size: 0.875rem;
      color: #666;
      margin-bottom: 5px;
    }

    .services-container .subtotal {
      font-size: 0.875rem;
      color: #FA856E;
      margin-top: 5px;
    }
  </style>

  <!-- Title -->
  <title>Lista de Produtos</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <ul class="filters_menu">
          <li class="active" data-filter="*"><i class="bi bi-card-list"></i> Todos</li>
          <li data-filter=".salgado"><i class="bi bi-basket2"></i> Salgados</li>
          <li data-filter=".doce"><i class="bi bi-cake2"></i> Doces</li>
          <li data-filter=".bebida"><i class="bi bi-cup-straw"></i> Bebidas</li>
        </ul>

        <div class="filters-content">
          <div class="row grid">
            <!-- Iteração sobre os produtos -->
            @foreach($produtos as $produto)
            <div class="col-md-3 mb-4 {{ $produto->tipo }}">
              <div class="card">
                <img src="{{ asset('storage/ImagensProdutos/' . $produto->caminhoImagem) }}" class="card-img-top"
                  alt="{{ $produto->nome }}">
                <div class="card-body">
                  <h5 class="card-title">{{ $produto->nome }}</h5>
                  <p class="card-text">{{ $produto->descricao }}</p>
                  <p class="price"><strong>R$ {{ number_format($produto->precoUnitario, 2, ',', '.') }}</strong></p>
                  <div class="quantity">
                    <button class="btn btn-sm btn-decrement"><i class="bi bi-dash"></i></button>
                    <input type="number" class="form-control quantity-input" value="1" min="1">
                    <button class="btn btn-sm btn-increment"><i class="bi bi-plus"></i></button>
                  </div>
                  <button class="btn btn-add-to-cart mt-3" data-id="{{ $produto->id }}"
                    data-caminho-imagem="{{ asset('storage/ImagensProdutos/' . $produto->caminhoImagem) }}"
                    data-nome="{{ $produto->nome }}"
                    data-preco-unitario="{{ number_format($produto->precoUnitario, 2, ',', '.') }}"><i
                      class="bi bi-cart-plus"></i> Adicionar ao Carrinho</button>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Coluna para o carrinho -->
      <div class="col-md-3">
        <div class="cart-container">
          <div class="cart-items">
            <h3>Carrinho</h3>
            <div class="cart-items-list"></div>
            <div class="total-price mt-3">
              <div class="card-body p-4">
              @if($produtosSelecionados)
                @foreach($produtosSelecionados as $produtoSelecionado)
                <div class="cart-item" data-id="{{ $produtoSelecionado->produto_id }}">
                  <div class="cart-item-img">
                    <img src="{{ asset('storage/ImagensProdutos/' . $produtoSelecionado->caminhoImagem) }}" alt="{{ $produtoSelecionado->nome }}" style="width: 60px;">
                  </div>
                  <div class="cart-item-info flex-grow-1">
                    <h6>{{ $produtoSelecionado->nome }}</h6>
                    <p>R$ {{ number_format($produtoSelecionado->precoUnitario, 2, ',', '.') }} x {{ $produtoSelecionado->quantidade }}</p>
                  </div>
                  <button class="btn btn-sm btn-remove-item" >
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
                @endforeach
              @endif
                <h5>Total Produtos: R$ <span id="cart-total">0.00</span></h5>
              </div>
              </div>
              <!-- Coluna para os serviços -->
               <hr>
            <h3>Serviços</h3>
            @foreach ($pedidos_servicos as $pedido_servico)
            <div class="card rounded-3 mb-4">
              <div class="card-body p-4">
                <div class="row g-3 align-items-center">
                  <p class="mb-1">Funcionário: <strong>{{ $pedido_servico->funcionarioTipo }}</strong></p>
                  <p class="mb-1">Quantidade: <strong>{{ $pedido_servico->quantidade }}</strong></p>
                  <h6 class="mb-0 subtotal">Subtotal: <strong>R${{ number_format($pedido_servico->subtotal, 2) }}</strong></h6>
                </div>
              </div>
            </div>
            @endforeach
            <div class="col-md-12 text-end ">
              <h4 class="mb-0">
                Total dos Serviços:
                <span style="color: #FA856E;">R${{ number_format($servico->totalServicos, 2) }}</span>
              </h4>
            </div>
          <button class="btn checkout-btn mt-3">Finalizar Compra</button>
            </div>
            
        </div>
          </div>
        </div>
      </div>

    

      


  <!-- JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Variável para o carrinho
    var cart = {};

    // Filtro de Categorias
    var filterItems = document.querySelectorAll('.filters_menu li');
    filterItems.forEach(function (item) {
      item.addEventListener('click', function () {
        filterItems.forEach(function (el) {
          el.classList.remove('active');
        });
        this.classList.add('active');
        var filtro = this.getAttribute('data-filter');
        var gridItems = document.querySelectorAll('.grid .col-md-3');
        gridItems.forEach(function (gridItem) {
          gridItem.style.display = 'none';
          if (filtro === '*' || gridItem.classList.contains(filtro.substring(1))) {
            gridItem.style.display = 'block';
          }
        });
      });
    });



    // Incremento e Decremento da Quantidade
    var incrementButtons = document.querySelectorAll('.btn-increment');
    incrementButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        var input = this.parentElement.querySelector('.quantity-input');
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();
      });
    });

    var decrementButtons = document.querySelectorAll('.btn-decrement');
    decrementButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        var input = this.parentElement.querySelector('.quantity-input');
        var newValue = parseInt(input.value) - 1;
        if (newValue >= 1) {
          input.value = newValue.toString();
        }
      });
    });

    // Adicionar ao Carrinho
    var addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
    addToCartButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        var id = this.getAttribute('data-id');
        var nome = this.getAttribute('data-nome');
        var precoUnitario = parseFloat(this.getAttribute('data-preco-unitario').replace('.', '').replace(',', '.'));
        var imagem = this.getAttribute('data-caminho-imagem');
        var quantidade = parseInt(this.parentElement.querySelector('.quantity-input').value);
        addToCart(id, nome, precoUnitario, imagem, quantidade);
      });
    });

    // Função para adicionar ao carrinho
    function addToCart(id, nome, precoUnitario, imagem, quantidade) {
      if (cart[id]) {
        cart[id].quantidade += quantidade;
      } else {
        cart[id] = {
          id: id,
          nome: nome,
          precoUnitario: precoUnitario,
          imagem: imagem,
          quantidade: quantidade
        };
      }
      updateCart(); // Atualiza visualmente o carrinho
    }

    // Função para atualizar o carrinho
    function updateCart() {
      var cartList = document.querySelector('.cart-items-list');
      cartList.innerHTML = '';
      var total = 0;

      for (var id in cart) {
        if (cart.hasOwnProperty(id)) {
          var item = cart[id];
          var nome = item.nome;
          var precoUnitario = item.precoUnitario;
          var imagem = item.imagem;
          var quantidade = item.quantidade;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
          var li = document.createElement('div');
          li.classList.add('cart-item');
          li.setAttribute('data-id', id); // Adiciona um identificador único
          li.innerHTML = `
            <div class="cart-item-img">
              <img src="${imagem}" alt="${nome}" style="width: 60px;">
            </div>
            <div class="cart-item-info flex-grow-1">
              <h6>${nome}</h6>
              <p>R$ ${precoUnitario.toFixed(2)} x ${quantidade}</p>
            </div>
            <button class="btn btn-sm btn-remove-item">
              <i class="bi bi-trash"></i>
            </button>
          `;
          cartList.appendChild(li);
          total += precoUnitario * quantidade;
        }
      }

      document.getElementById('cart-total').textContent = total.toFixed(2);
      
      // Adiciona evento de clique para remover item do carrinho
      var removeButtons = document.querySelectorAll('.btn-remove-item');
      removeButtons.forEach(function (button) {
        button.addEventListener('click', function () {
          var itemId = button.closest('.cart-item').getAttribute('data-id');
          removeFromCart(itemId);
        });
      });
    }

    // Função para remover do carrinho
    function removeFromCart(id) {
      delete cart[id];
      updateCart(); // Atualiza visualmente o carrinho após remover o item
    }

    // Finalizar Compra
    var checkoutButton = document.querySelector('.checkout-btn');
    checkoutButton.addEventListener('click', function () {
      if (Object.keys(cart).length === 0) {
        alert('O carrinho está vazio.');
        return;
      }
      var total = parseFloat(document.getElementById('cart-total').textContent);
      alert('Pedido finalizado! Total: R$ ' + total.toFixed(2));

      // Dados a serem enviados
      var dadosPedido = {
        itens: Object.values(cart), // Enviar apenas os valores dos itens do carrinho
        codigo: "{{$pedido->codigo}}" // Supondo que você tenha o código do pedido aqui
      };

      // Requisição AJAX para enviar os dados do carrinho
      fetch('/website/adicionar-ao-pedido', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(dadosPedido)
        })
        .then(response => response.json())
        .then(data => {
          console.log('Sucesso:', data);
          window.location.href = "{{ route('website.agendamento', ['codigo' => $pedido->codigo]) }}";


          
        })
        .catch((error) => {
          console.error('Erro:', error);
        });
    });
  });


  function calcularTotalInicial() {
    var total = 0;

    @foreach($produtosSelecionados as $produtoSelecionado)
      total += {{ $produtoSelecionado->precoUnitario }} * {{ $produtoSelecionado->quantidade }};
    @endforeach

    document.getElementById('cart-total').textContent = total.toFixed(2);
  }

  // Chame a função ao carregar a página
  document.addEventListener('DOMContentLoaded', function () {
    // ... seu código existente ...

    calcularTotalInicial(); // Calcular o total inicial
  });


  // Chame a função ao carregar a página
  document.addEventListener('DOMContentLoaded', function () {
    // ... seu código existente ...

    calcularTotalInicial(); // Calcular o total inicial
  });


  function removeFromCart(id) {
    delete cart[id];
    updateCart(); // Atualiza visualmente o carrinho após remover o item
    calcularTotal(); // Atualiza o total
  }

  // Atualize a função de atualização do carrinho para incluir o total
  function calcularTotal() {
    var total = 0;

    for (var id in cart) {
      if (cart.hasOwnProperty(id)) {
        total += cart[id].precoUnitario * cart[id].quantidade;
      }
    }

    document.getElementById('cart-total').textContent = total.toFixed(2);
  }

  // Atualize a função de atualização do carrinho para incluir o total
  function calcularTotal() {
    var total = 0;

    for (var id in cart) {
      if (cart.hasOwnProperty(id)) {
        total += cart[id].precoUnitario * cart[id].quantidade;
      }
    }

    document.getElementById('cart-total').textContent = total.toFixed(2);
  }


  </script>
</body>


</html>
