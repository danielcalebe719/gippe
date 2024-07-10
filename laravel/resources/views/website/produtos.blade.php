<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
      padding: 15px;
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
      max-width: 300px; /* Ajustar conforme necessário */
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
  </style>

  <!-- Title -->
  <title>Lista de Produtos</title>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <ul class="filters_menu">
          <li class="active" data-filter="*">Todos</li>
          <li data-filter=".salgado">Salgados</li>
          <li data-filter=".doce">Doces</li>
          <li data-filter=".bebida">Bebidas</li>
        </ul>

        <div class="filters-content">
          <div class="row grid">
            <!-- Iteração sobre os produtos -->
            @foreach($produtos as $produto)
            <div class="col-md-4 mb-4 {{ strtolower($produto->tipo) }}">
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
                  <button class="btn btn-add-to-cart mt-3"
                    data-id="{{ $produto->id }}"
                    data-caminho-imagem="{{ asset('storage/ImagensProdutos/' . $produto->caminhoImagem) }}"
                    data-nome="{{ $produto->nome }}"
                    data-preco-unitario="{{ number_format($produto->precoUnitario, 2, ',', '.') }}">
                    <i class="bi bi-cart"></i> Adicionar ao Carrinho
                  </button>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="cart-container">
          <div class="cart-items">
            <h3>Carrinho de Compras</h3>
            <!-- Aqui serão inseridos dinamicamente os itens do carrinho -->
            <div class="cart-items-list"></div>
            <div class="total-price mt-3">
              <h5>Total: R$ <span id="cart-total">0.00</span></h5>
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
      // Filtro de Categorias
      var filterItems = document.querySelectorAll('.filters_menu li');
      filterItems.forEach(function (item) {
        item.addEventListener('click', function () {
          filterItems.forEach(function (el) {
            el.classList.remove('active');
          });
          this.classList.add('active');
          var filtro = this.getAttribute('data-filter');
          var gridItems = document.querySelectorAll('.grid .col-md-4');
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
          var nome = this.getAttribute('data-nome');
          var preco = parseFloat(this.getAttribute('data-preco-unitario').replace('.', '').replace(',', '.'));
          var imagem = this.getAttribute('data-caminho-imagem');
          var quantidade = parseInt(this.parentElement.querySelector('.quantity-input').value);
          addToCart(nome, preco, imagem, quantidade);
        });
      });

      // Variável para o carrinho
      var cart = {};

      // Função para adicionar ao carrinho
      function addToCart(nome, preco, imagem, quantidade) {
        if (cart[nome]) {
          cart[nome].quantidade += quantidade;
        } else {
          cart[nome] = {
            nome: nome,
            preco: preco,
            imagem: imagem,
            quantidade: quantidade
          };
        }
        updateCart();
      }

      // Função para atualizar o carrinho
      function updateCart() {
        var cartList = document.querySelector('.cart-items-list');
        cartList.innerHTML = '';
        var total = 0;

        for (var item in cart) {
          if (cart.hasOwnProperty(item)) {
            var nome = cart[item].nome;
            var preco = cart[item].preco;
            var imagem = cart[item].imagem;
            var quantidade = cart[item].quantidade;

            var li = document.createElement('div');
            li.classList.add('cart-item');
            li.innerHTML = `
              <div class="cart-item-img">
                <img src="${imagem}" alt="${nome}" style="width: 60px;">
              </div>
              <div class="cart-item-info flex-grow-1">
                <h6>${nome}</h6>
                <p>R$ ${preco.toFixed(2)} x ${quantidade}</p>
              </div>
              <button class="btn btn-sm btn-remove-item" onclick="removeFromCart('${nome}')">
                <i class="bi bi-trash"></i>
              </button>
            `;
            cartList.appendChild(li);
            total += preco * quantidade;
          }
        }

        document.getElementById('cart-total').textContent = total.toFixed(2);
      }

      // Função para remover do carrinho
      function removeFromCart(nome) {
        delete cart[nome];
        updateCart();
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
        cart = {};
        updateCart();

        // Dados a serem enviados
        var dadosPedido = {
          itens: cart
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
        .then(function (response) {
          if (!response.ok) {
            throw new Error('Erro ao enviar dados do carrinho.');
          }
          return response.json();
        })
        .then(function (data) {
          console.log('Dados do carrinho enviados com sucesso:', data.message);
          // Limpar carrinho ou redirecionar para página de sucesso
        })
        .catch(function (error) {
          console.error('Erro ao enviar dados do carrinho:', error);
        });
      });

      // Validação da entrada no campo de quantidade
      var quantityInputs = document.querySelectorAll('.quantity-input');
      quantityInputs.forEach(function (input) {
        input.addEventListener('change', function () {
          var newValue = parseInt(this.value);
          if (isNaN(newValue) || newValue < 1) {
            this.value = '1';
          }
        });
      });
    });
  </script>

</body>

</html>
