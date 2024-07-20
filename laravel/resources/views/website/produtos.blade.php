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

        .filters-content .row {
            margin-left: 0;
            margin-right: 0;
        }

        .card {
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            overflow: hidden;
            padding: 10px;
            margin-bottom: 15px; /* Adiciona espaço entre cards */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: 150px; /* Altura fixa */
            object-fit: cover; /* Mantém a proporção e cobre o contêiner */
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
            max-width: 350px;
            position: sticky;
            top: 80px;
            padding: 0 10px; /* Diminuído o padding da esquerda e da direita */
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
            margin-bottom: 5px;
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

/* Ajuste do grid */
@media (min-width: 1150px) {
    .col-com-4 {
        flex: 0 0 25%; /* 4 colunas em telas grandes */
        max-width: 25%;
    }
}

@media (max-width: 1149.98px) and (min-width: 900.2px) {
    .col-com-3 {
        flex: 0 0 33.3333%; /* 3 colunas em telas médias */
        max-width: 33.3333%;
    }
    .order-md-1 {
        order: 1; /* Colocar o carrinho em baixo quando há 3 colunas */
    }
}

@media (max-width: 900px) {
    .col-com-1 {
        flex: 0 0 100%; /* 1 coluna em telas pequenas */
        max-width: 100%;
    }
    .order-md-1 {
        order: 1; /* Colocar o carrinho em baixo quando há 1 coluna */
    }
}

/* Novo CSS para garantir que o carrinho vá para baixo quando há 3 ou menos produtos visíveis */
@media (min-width: 900px) {
    .row.grid {
        display: flex;
        flex-wrap: wrap;
    }

    .col-md-9 {
        order: 0;
    }

    .col-md-3 {
        order: 1; /* Colocar o carrinho abaixo dos produtos em telas médias */
    }
}


    </style>

    <!-- Title -->
    <title>Lista de Produtos</title>
<!-- Favicons -->
<link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  </head>

  <body>
@include('partials.navbar')
<br><br>

<div class="container">
        <div class="row">
            <!-- Filtros de Categorias -->
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
                        <div class="col-com-4 col-com-3 col-com-1 {{ $produto->tipo }}">
                            <div class="card">
                                <img src="{{ asset('storage/ImagensProdutos/' . $produto->caminhoImagem) }}" class="card-img-top" alt="{{ $produto->nome }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produto->nome }}</h5>
                                    <p class="card-text">{{ $produto->descricao }}</p>
                                    <p class="price"><strong>R$ {{ number_format($produto->precoUnitario, 2, ',', '.') }}</strong></p>
                                    <div class="quantity">
                                        <button class="btn btn-sm btn-decrement"><i class="bi bi-dash"></i></button>
                                        <input type="number" class="form-control quantity-input" value="1" min="1">
                                        <button class="btn btn-sm btn-increment"><i class="bi bi-plus"></i></button>
                                    </div>
                                    <button class="btn btn-add-to-cart mt-3" style="background-color: #FA856E;" 
                                            data-id="{{ $produto->id }}"
                                            data-caminho-imagem="{{ asset('storage/ImagensProdutos/' . $produto->caminhoImagem) }}"
                                            data-nome="{{ $produto->nome }}"
                                            data-preco-unitario="{{ number_format($produto->precoUnitario, 2, ',', '.') }}">
                                        <i class="bi bi-cart-plus"></i> Comprar
                                    </button>
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
                        <div class="cart-items-list">
                            <!-- Iteração sobre os produtos selecionados no carrinho -->
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
                                <button class="btn btn-sm btn-remove-item">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <h5>Total Produtos: R$ <span id="cart-total">0.00</span></h5>
                    
                    <button class="btn checkout-btn mt-3" style="background-color: #FA856E;">Finalizar Compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br>
      <!-- ======= Footer ======= -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    (31)9 1234-5678 | buffetdivinosabor@gmail.com
    <a class="text-body" href=""></a>
  </div>


      


  <!-- JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Variável para o carrinho
    var cart = {};

    // Inicializar o carrinho com os produtos já selecionados
    @foreach($produtosSelecionados as $produtoSelecionado)
        cart['{{ $produtoSelecionado->produto_id }}'] = {
            id: '{{ $produtoSelecionado->produto_id }}',
            nome: '{{ $produtoSelecionado->nome }}',
            precoUnitario: {{ $produtoSelecionado->precoUnitario }},
            imagem: '{{ asset("storage/ImagensProdutos/" . $produtoSelecionado->caminhoImagem) }}',
            quantidade: {{ $produtoSelecionado->quantidade }}
        };
    @endforeach

    // Filtro de Categorias
    var filterItems = document.querySelectorAll('.filters_menu li');
    filterItems.forEach(function (item) {
        item.addEventListener('click', function () {
            filterItems.forEach(function (el) {
                el.classList.remove('active');
            });
            this.classList.add('active');
            var filtro = this.getAttribute('data-filter');
            var gridItems = document.querySelectorAll('.grid .col-com-4, .grid .col-com-3, .grid .col-com-1');
            gridItems.forEach(function (gridItem) {
                gridItem.style.display = 'none';
                if (filtro === '*' || gridItem.classList.contains(filtro.substring(1))) {
                    gridItem.style.display = 'block';
                }
            });

            adjustCartPosition();
        });
    });

    // Incremento e Decremento da Quantidade
    document.querySelectorAll('.btn-increment, .btn-decrement').forEach(function (button) {
        button.addEventListener('click', function () {
            var input = this.parentElement.querySelector('.quantity-input');
            var newValue = parseInt(input.value) + (this.classList.contains('btn-increment') ? 1 : -1);
            if (newValue >= 1) {
                input.value = newValue.toString();
            }
        });
    });

    // Adicionar ao Carrinho
    document.querySelectorAll('.btn-add-to-cart').forEach(function (button) {
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
        updateCart();
    }

    // Função para atualizar o carrinho
    function updateCart() {
        var cartList = document.querySelector('.cart-items-list');
        cartList.innerHTML = '';
        var total = 0;

        for (var id in cart) {
            if (cart.hasOwnProperty(id)) {
                var item = cart[id];
                var li = document.createElement('div');
                li.classList.add('cart-item');
                li.setAttribute('data-id', id);
                li.innerHTML = `
                    <div class="cart-item-img">
                        <img src="${item.imagem}" alt="${item.nome}" style="width: 60px;">
                    </div>
                    <div class="cart-item-info flex-grow-1">
                        <h6>${item.nome}</h6>
                        <p>R$ ${item.precoUnitario.toFixed(2)} x ${item.quantidade}</p>
                    </div>
                    <button class="btn btn-sm btn-remove-item" data-id="${id}">
                        <i class="bi bi-trash"></i>
                    </button>
                `;
                cartList.appendChild(li);
                total += item.precoUnitario * item.quantidade;
            }
        }

        document.getElementById('cart-total').textContent = total.toFixed(2);

        // Adiciona evento de clique para remover item do carrinho
        document.querySelectorAll('.btn-remove-item').forEach(function (button) {
            button.addEventListener('click', function () {
                var itemId = this.getAttribute('data-id');
                removeFromCart(itemId);
            });
        });
    }

    // Função para remover do carrinho
    function removeFromCart(id) {
        delete cart[id];
        updateCart();
    }



   document.querySelector('.checkout-btn').addEventListener('click', function () {
    if (Object.keys(cart).length === 0) {
        alert('O carrinho está vazio.');
        return;
    }

    var total = parseFloat(document.getElementById('cart-total').textContent);
    if (isNaN(total)) {
        console.error('Total inválido');
        alert('Ocorreu um erro ao calcular o total. Por favor, atualize a página e tente novamente.');
        return;
    }

    // Incluir {{$pedido->codigo}} diretamente no objeto dadosPedido
    var dadosPedido = {
        itens: Object.values(cart),
        codigo: "{{$pedido->codigo ?? ''}}"  // Aqui você insere o valor diretamente
    };

    console.log('Enviando dados:', dadosPedido);

    fetch('/website/adicionar-ao-pedido', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(dadosPedido)
    })
    .then(response => {
        console.log('Status da resposta:', response.status);
        if (!response.ok) {
            throw new Error('Erro na resposta do servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Sucesso:', data);
        console.log('Código do pedido:', data.codigo);
        console.log('Criação:', data.criacao);

        if (data.codigo) {
    let redirectUrl;
    if (data.criacao) {
        redirectUrl = "/website/agendamento/" + data.codigo;
    } else {
        redirectUrl = "/website/pedidos/pedidosDetalhes/" + data.codigo;
    }
    console.log('Redirecionando para:', redirectUrl);
    alert('Pedido finalizado! Total: R$ ' + total.toFixed(2));
    window.location.replace(redirectUrl);
}
        
    })
    .catch((error) => {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao processar o pedido. Por favor, tente novamente.');
    });
});



    // Função para ajustar a posição do carrinho
    function adjustCartPosition() {
        var productCount = document.querySelectorAll('.grid .col-com-4, .grid .col-com-3, .grid .col-com-1').length;
        var cartContainer = document.querySelector('.cart-container');

        if (productCount <= 3) {
            cartContainer.style.order = '1';
        } else {
            cartContainer.style.order = '0';
        }
    }

    // Inicializar o carrinho e ajustar a posição
    updateCart();
    adjustCartPosition();
});
</script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

<script src="{{ asset('assets/js/mainn.js') }}"></script>

</body>


</html>
