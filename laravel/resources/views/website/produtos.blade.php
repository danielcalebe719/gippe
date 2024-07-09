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
            <!-- Aqui serão carregados os produtos -->
            <?php foreach($produtos as $produto): ?>
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="<?php echo asset('storage/ImagensProdutos/' . $produto->caminhoImagem); ?>" class="card-img-top" alt="<?php echo $produto->nome; ?>">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $produto->nome; ?></h5>
                  <p class="card-text"><?php echo $produto->descricao; ?></p>
                  <p class="price"><strong>R$ <?php echo number_format($produto->precoUnitario, 2, ',', '.'); ?></strong></p>
                  <div class="quantity">
                    <button class="btn btn-sm btn-decrement"><i class="bi bi-dash"></i></button>
                    <input type="number" class="form-control quantity-input" value="1" min="1">
                    <button class="btn btn-sm btn-increment"><i class="bi bi-plus"></i></button>
                  </div>
                  <button class="btn btn-add-to-cart mt-3" data-id="<?php echo $produto->id; ?>" data-caminho-imagem="<?php echo asset('storage/ImagensProdutos/' . $produto->caminhoImagem); ?>" data-nome="<?php echo $produto->nome; ?>" data-preco-unitario="<?php echo number_format($produto->precoUnitario, 2, ',', '.'); ?>"><i class="bi bi-cart"></i> Adicionar ao Carrinho</button>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
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
              <h5>Total: R$ <span id="totalPrice">0.00</span></h5>
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
    $(document).ready(function() {
      // Incremento e Decremento da Quantidade
      $('.btn-increment').on('click', function() {
        var input = $(this).siblings('.quantity-input');
        var newValue = parseInt(input.val()) + 1;
        input.val(newValue);
      });

      $('.btn-decrement').on('click', function() {
        var input = $(this).siblings('.quantity-input');
        var newValue = parseInt(input.val()) - 1;
        if (newValue >= 1) {
          input.val(newValue);
        }
      });

      // Adicionar ao Carrinho
      $('.btn-add-to-cart').on('click', function() {
        var id = $(this).data('id');
        var caminhoImagem = $(this).data('caminho-imagem');
        var nome = $(this).data('nome');
        var precoUnitario = $(this).data('preco-unitario');
        var quantidade = $(this).closest('.card-body').find('.quantity-input').val();
      
  $('.add-to-cart').click(function(e) {
        e.preventDefault();

        // Captura informações do produto
        let id = $(this).data('id');
        let nome = $(this).data('nome');
        let caminhoImagem = $(this).data('caminho-imagem');
        console.log(caminhoImagem)
        let precoUnitarioElement = $(this).find('.preco-unitario'); // Encontra o elemento que contém o preço unitário
        let precoUnitario = parseFloat(precoUnitarioElement.text().replace(',', '.')); // Extrai o texto e converte para float
        let quantidade = parseInt($(this).closest('.options').find('.quantity input').val());

        // Verifica se o item já está no carrinho
        let index = carrinho.findIndex(item => item.id === id);
        if (index !== -1) {
          // Se já está no carrinho, atualiza a quantidade
          carrinho[index].quantidade += quantidade;
        } else {
          // Senão, adiciona ao carrinho
          carrinho.push({
            id: id,
            nome: nome,
            caminhoImagem: caminhoImagem,
            precoUnitario: precoUnitario,
            quantidade: quantidade
            
          });
        }

        // Atualiza visualização do carrinho
        atualizarCarrinho();
      });///tem que arrumar essa disnara aqui
      
      Criar HTML do item do carrinho
        var itemHTML = `
          <div class="cart-item">
            <div class="cart-item-img">
              <img src="${caminhoImagem}" alt="${nome}" style="width: 60px;">
            </div>
            <div class="cart-item-info flex-grow-1">
              <h6>${nome}</h6>
              <p>R$ ${precoUnitario} x ${quantidade}</p>
            </div>
            <button class="btn btn-sm btn-remove-item"><i class="bi bi-trash"></i></button>
          </div>
        `;

        // Adicionar ao carrinho
        $('.cart-items-list').append(itemHTML);

        // Calcular e atualizar total do carrinho
        calcularTotalCarrinho();
      });

      // Remover item do Carrinho
      $(document).on('click', '.btn-remove-item', function() {
        $(this).closest('.cart-item').remove();
        calcularTotalCarrinho();
      });

      // Calcular e atualizar total do Carrinho
      function calcularTotalCarrinho() {
        var total = 0;

        $('.cart-item').each(function() {
          var precoStr = $(this).find('p').text().trim().split(' ')[1].replace('R$', '').replace(',', '.');
          var quantidade = parseInt($(this).find('p').text().trim().split(' ')[3]);
          var preco = parseFloat(precoStr) * quantidade;
          total += preco;
        });

        $('#totalPrice').text(total.toFixed(2));
      }

      // Finalizar Compra (exemplo)
      $('.checkout-btn').click(function() {
        // Verifica se há itens no carrinho para enviar
        if (carrinho.length === 0) {
          console.log('O carrinho está vazio.');
          return;
        }

        // Dados a serem enviados
        let dadosPedido = {
          codigo: codigo,
          itens: carrinho
        };

        // Requisição AJAX para enviar os dados do carrinho
        $.ajax({
          type: 'POST',
          url: '/website/adicionar-ao-pedido',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: dadosPedido,
          dataType: 'json',
          success: function(response) {
            console.log('Dados do carrinho enviados com sucesso:', response.message);
            // Limpar carrinho ou redirecionar para página de sucesso
          },
          error: function(xhr, status, error) {
            console.error('Erro ao enviar dados do carrinho:', error);
          }
        });
      });
   

    });
  </script>

</body>

</html>
