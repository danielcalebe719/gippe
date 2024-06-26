<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="ImagensProdutos/favicon.png" type="">

  <title> Buffet Divino Sabor </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrao_produtos.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <link href="assets/css/style_produtos2.css" rel="stylesheet">
  <link href="assets/css/style_produtos.scss" rel="stylesheet">

</head>

<body>
  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Faça seu Pedido!</h2>
      </div>

      <!-- Adicione a classe filters_menu ao elemento que contém os filtros -->
      <ul class="filters_menu">
        <li class="active" data-filter="*">Todos</li>
        <li data-filter=".filter-salgado">Salgados</li>
        <li data-filter=".filter-doce">Doces</li>
        <li data-filter=".filter-bebida">Bebidas</li>
      </ul>

      <div class="filters-content">
        <div class="row grid">
          <!-- Exemplo de produtos estáticos -->
          <div class="col-sm-6 col-lg-4 all filter-salgado">
            <div class="box">
              <div class="product-card">
                <div class="img-box">
                  <img src="ImagensProdutos/salgado1.jpg" alt="Salgado 1">
                </div>
                <div class="detail-box">
                  <h5 class="product-name">Salgado 1</h5>
                  <p class="product-description">Descrição do Salgado 1</p>
                  <span class="product-price">R$ 10,00</span>
                  <div class="quantity-input d-flex align-items-center">
                    <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                      <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" class="quantidade-input" name="quantidade" value="50" min="50" class="form-control form-control-sm">
                    <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-primary addToCartButton ml-2" style="background-color: #FA856E; border:none;" data-id="1">
                      <i class="fas fa-shopping-cart"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all filter-doce">
            <div class="box">
              <div class="product-card">
                <div class="img-box">
                  <img src="ImagensProdutos/doce1.jpg" alt="Doce 1">
                </div>
                <div class="detail-box">
                  <h5 class="product-name">Doce 1</h5>
                  <p class="product-description">Descrição do Doce 1</p>
                  <span class="product-price">R$ 5,00</span>
                  <div class="quantity-input d-flex align-items-center">
                    <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                      <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" class="quantidade-input" name="quantidade" value="50" min="50" class="form-control form-control-sm">
                    <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-primary addToCartButton ml-2" style="background-color: #FA856E; border:none;" data-id="2">
                      <i class="fas fa-shopping-cart"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all filter-bebida">
            <div class="box">
              <div class="product-card">
                <div class="img-box">
                  <img src="ImagensProdutos/bebida1.jpg" alt="Bebida 1">
                </div>
                <div class="detail-box">
                  <h5 class="product-name">Bebida 1</h5>
                  <p class="product-description">Descrição da Bebida 1</p>
                  <span class="product-price">R$ 3,00</span>
                  <div class="quantity-input d-flex align-items-center">
                    <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                      <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" class="quantidade-input" name="quantidade" value="10" min="10" class="form-control form-control-sm">
                    <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-primary addToCartButton ml-2" style="background-color: #FA856E; border:none;" data-id="3">
                      <i class="fas fa-shopping-cart"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Adicione mais produtos conforme necessário -->
        </div>
      </div>
    </div>
    <div class="btn-box">
      <a id="toggleButton">
        Ver mais produtos
      </a>
    </div>
  </section>

  <!-- Adicione as bibliotecas jQuery e Isotope.js -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

  <script>
    $(document).ready(function() {
      // Inicialização do Isotope
      var $grid = $(".grid").isotope({
        itemSelector: ".all",
        percentPosition: true,
        masonry: {
          columnWidth: ".all"
        }
      });

      // Clique nos filtros
      $('.filters_menu li').click(function() {
        $('.filters_menu li').removeClass('active');
        $(this).addClass('active');

        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
          filter: filterValue
        });
      });

      // Botão "Ver mais produtos"
      var $toggleButton = $('#toggleButton');
      var $hiddenProducts = $('.grid .all:hidden');

      $toggleButton.click(function() {
        $hiddenProducts.slice(0, 3).fadeIn();
        $hiddenProducts = $('.grid .all:hidden');

        if ($hiddenProducts.length === 0) {
          $toggleButton.hide();
        }
      });
    });
  </script>

  <!------------------carrinho start------------------------------------------------>
  <section class="h-100">
    <div class="container h-100 py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-10">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-normal mb-0">Carrinho:</h3>
          </div>
          <div id="carrinho">
            <!-- Carrinho de exemplo -->
            <div class="item-carrinho card rounded-3 mb-4">
              <div class="card-body p-4">
                <div class="row d-flex justify-content
                  <div class="col-md-2 col-lg-2 col-xl-2">
                    <img src="ImagensProdutos/salgado1.jpg" class="img-fluid rounded-3" alt="Salgado 1">
                  </div>
                  <div class="col-md-3 col-lg-3 col-xl-3">
                    <p class="lead fw-normal mb-2">Salgado 1</p>
                  </div>
                  <div class="col-md-3 col-lg-3 col-xl-3 d-flex">
                    <button type="button" class="btn btn-link decrementarQuantidade"><i class="fas fa-minus"></i></button>
                    <input class="form-control form-control-sm quantidade" type="number" value="1" min="1" />
                    <button type="button" class="btn btn-link incrementarQuantidade"><i class="fas fa-plus"></i></button>
                  </div>
                  <div class="col-md-2 col-lg-2 col-xl-2">
                    <h5 class="mb-0 preco-unitario">R$ 10,00</h5>
                  </div>
                  <div class="col-md-1 col-lg-1 col-xl-1">
                    <h5 class="mb-0 subtotal">R$ 10,00</h5>
                  </div>
                  <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                    <button type="button" class="btn btn-link excluirItem"><i class="fas fa-trash"></i></button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Adicione mais itens do carrinho conforme necessário -->

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Script para manipulação do carrinho -->
  <script>
    $(document).ready(function() {
      // Função para atualizar o preço total do carrinho
      function atualizarPrecoTotal() {
        var total = 0;
        $('.item-carrinho').each(function() {
          var precoUnitario = parseFloat($(this).find('.preco-unitario').text().replace('R$ ', ''));
          var quantidade = parseInt($(this).find('.quantidade').val());
          var subtotal = precoUnitario * quantidade;
          total += subtotal;
          $(this).find('.subtotal').text('R$ ' + subtotal.toFixed(2));
        });
        $('#precoTotal').text('R$ ' + total.toFixed(2));
      }

      // Captura o clique nos botões de incrementar e decrementar quantidade
      $('#carrinho').on('click', '.incrementarQuantidade', function() {
        var quantidadeInput = $(this).siblings('.quantidade');
        quantidadeInput.val(parseInt(quantidadeInput.val()) + 1);
        atualizarPrecoTotal();
      }).on('click', '.decrementarQuantidade', function() {
        var quantidadeInput = $(this).siblings('.quantidade');
        quantidadeInput.val(Math.max(parseInt(quantidadeInput.val()) - 1, 1));
        atualizarPrecoTotal();
      });

      // Captura o clique no botão de excluir item
      $('#carrinho').on('click', '.excluirItem', function() {
        $(this).closest('.item-carrinho').remove();
        atualizarPrecoTotal();
      });

      // Captura o clique no botão "Confirmar Carrinho"
      $('#confirmarCarrinhoButton').click(function() {
        var carrinhoItens = [];

        // Para cada item no carrinho
        $('.item-carrinho').each(function() {
          var nome = $(this).find('.lead').text();
          var preco = $(this).find('.preco-unitario').text().replace('R$ ', '');
          var quantidade = $(this).find('.quantidade').val();

          // Adiciona os dados do item ao array
          carrinhoItens.push({
            nome: nome,
            preco: preco,
            quantidade: quantidade
          });
        });

        // Simula envio dos dados para o servidor
        console.log("Itens do carrinho enviados para o servidor:");
        console.log(carrinhoItens);

        // Limpa o carrinho após confirmação
        $('#carrinho').empty();
        $('#carrinho').append('<p>Carrinho vazio</p>');
        $('#precoTotal').text('R$ 0,00');
      });
    });
  </script>

  <!-- Botão "Confirmar Carrinho" -->
  <div class="center-container">
    <button type="button" id="confirmarCarrinhoButton" class="btn btn-primary btn-lg">Confirmar Carrinho</button>
  </div>

  <!-- Final do HTML -->
</body>

</html>
