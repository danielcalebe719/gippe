<?php




include("menu.php");
?>



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
        <!-- Conteúdo dos produtos gerado dinamicamente pelo PHP -->
        <?php require("conecta.php"); ?>

        <div class="row grid">
        <?php
require("conecta.php");

// Query para selecionar todos os produtos
$querySelecao = "SELECT * FROM produtos";
$resultado = mysqli_query($conexao, $querySelecao);

if ($resultado) {
  // Loop para exibir todos os produtos
  while ($produto = mysqli_fetch_array($resultado)) {
    // Supondo que você tenha uma coluna 'categorias' no seu banco de dados
    $categorias = explode(',', $produto['tipo']);
    $classes = array_map(function ($cat) {
      return 'filter-' . strtolower(trim($cat));
    }, $categorias);
    $classesString = implode(' ', $classes);

    // Abre o loop do produto
    echo "<div class='col-sm-6 col-lg-4 all $classesString'>";
    echo "  <div class='box'>";
    echo "    <div class='product-card'>";
    echo "      <div class='img-box'>";
    echo "        <img src='ImagensProdutos/{$produto['caminhoImagem']}' alt='{$produto['nome']}'>";
    echo "      </div>";
    echo "      <div class='detail-box'>";
    echo "        <h5 class='product-name'>{$produto['nome']}</h5>";
    echo "        <p class='product-description'>{$produto['descricao']}</p>";
    echo "        <span class='product-price'>R$ {$produto['preco_unitario']}</span>";
    echo "        <div class='quantity-input d-flex align-items-center'>";
    echo "          <button type='button' class='btn btn-link px-2' onclick='this.parentNode.querySelector(\"input[type=number]\").stepDown()'>";
    echo "            <i class='fas fa-minus'></i>";
    echo "          </button>";
    echo "          <input type='number' class='quantidade-input' name='quantidade'  value='" . (($produto['tipo'] == 'salgado') ? '50' : (($produto['tipo'] == 'doce') ? '50' : '10')) . "' min='" . (($produto['tipo'] == 'salgado') ? '50' : (($produto['tipo'] == 'doce') ? '50' : '10')) . "' class='form-control form-control-sm'>";
    echo "          <button type='button' class='btn btn-link px-2' onclick='this.parentNode.querySelector(\"input[type=number]\").stepUp()'>";
    echo "            <i class='fas fa-plus'></i>";
    echo "          </button>";
    echo "          <button type='button' class='btn btn-primary addToCartButton ml-2' style='background-color: #FA856E; border:none;' data-id='{$produto['idProdutos']}'>";
    echo "            <i class='fas fa-shopping-cart'></i>";
    echo "          </button>";
    echo "        </div>";
    echo "      </div>";
    echo "    </div>";
    echo "  </div>";
    // Fecha o formulário dentro do loop
    echo "</form>";
    echo "</div>";
  }

} else {
  echo "Erro ao buscar os produtos: " . mysqli_error($conexao);
}

mysqli_close($conexao);
?>


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

  <!-- Adicione as bibliotecas jQuery e Isotope.js -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

  <script>
    // Captura o clique nos botões "Adicionar ao carrinho"
$('.addToCartButton').click(function(event) {
  // Evita o comportamento padrão do botão (envio do formulário)
  event.preventDefault();

  var form = $(this).closest('.product-form');
  var nome = form.find('input[name="nome"]').val();
  var preco = form.find('input[name="preco"]').val();
  var imagem = form.find('input[name="imagem"]').val();
  var id = form.find('input[name="id"]').val();
  var quantidade = form.find('name="quantidade"').val();

  // Envie os dados para o carrinho via POST
  $.post('carrinho.php', {nome: nome, preco: preco, imagem: imagem, id: id, quantidade: quantidade}, function(response) {
    // Aqui você pode tratar a resposta do servidor, se necessário
    console.log(response);
  });
});


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
           
           

  </section>
<!-- Adicione as bibliotecas jQuery e Isotope.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

<script>
$(document).ready(function() {
    // Função para atualizar o preço total do carrinho
    function atualizarPrecoTotal() {
        var total = 0;
        $('.item-carrinho').each(function() {
            var precoUnitario = parseFloat($(this).find('.preco-sunitario').text().replace('$', ''));
            var quantidade = parseInt($(this).find('.quantidade').val());
            var subtotal = precoUnitario * quantidade;
            total += subtotal;
            $(this).find('.subtotal').text('$' + subtotal.toFixed(2));
        });
        $('#precoTotal').text('$' + total.toFixed(2));
    }

    // Função para adicionar um item ao carrinho
    function adicionarAoCarrinho(nome, preco, imagem, quantidade) {
        // Construir o HTML para o item do carrinho
        var itemHTML =
            '<div class="item-carrinho card rounded-3 mb-4">' +
            '<div class="card-body p-4">' +
            '<div class="row d-flex justify-content-between align-items-center">' +
            '<div class="col-md-2 col-lg-2 col-xl-2">' +
            '<img src="' + imagem + '" class="img-fluid rounded-3" alt="' + nome + '">' +
            '</div>' +
            '<div class="col-md-3 col-lg-3 col-xl-3">' +
            '<p class="lead fw-normal mb-2">' + nome + '</p>' +
            '</div>' +
            '<div class="col-md-3 col-lg-3 col-xl-3 d-flex">' +
            '<button type="button" class="btn btn-link decrementarQuantidade"><i class="fas fa-minus"></i></button>' +
            '<input class="form-control form-control-sm quantidade" type="number" value="' + quantidade + '" min="1" />' +
            '<button type="button" class="btn btn-link incrementarQuantidade"><i class="fas fa-plus"></i></button>' +
            '</div>' +
            '<div class="col-md-2 col-lg-2 col-xl-2">' +
            '<h5 class="mb-0 preco-unitario">$' + preco + '</h5>' +
            '</div>' +
            '<div class="col-md-1 col-lg-1 col-xl-1">' +
            '<h5 class="mb-0 subtotal">$' + (parseFloat(preco) * quantidade).toFixed(2) + '</h5>' +
            '</div>' +
            '<div class="col-md-1 col-lg-1 col-xl-1 text-end">' +
            '<button type="button" class="btn btn-link excluirItem"><i class="fas fa-trash"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        // Adicionar o item ao carrinho
        $('#carrinho').append(itemHTML);
        atualizarPrecoTotal();
    }

    // Captura o clique nos botões "Adicionar ao carrinho"
    $('.addToCartButton').click(function() {
        var nome = $(this).closest('.box').find('.product-name').text();
        var preco = $(this).closest('.box').find('.product-price').text().replace('R$ ', '');
        var imagem = $(this).closest('.box').find('.img-box img').attr('src');
        var quantidade = parseInt($(this).closest('.box').find('.quantidade-input').val());
        adicionarAoCarrinho(nome, preco, imagem, quantidade);
    });

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
});

</script>


          <!-- Adicione o botão "Confirmar Carrinho" no final da página -->
<div class="center-container">
    <button type="button" id="confirmarCarrinhoButton" class="btn btn-primary btn-lg">Confirmar Carrinho</button>
</div>



<script>
// Captura o clique no botão "Confirmar Carrinho"
$('#confirmarCarrinhoButton').click(function() {
  // Array para armazenar os itens do carrinho
  var carrinhoItens = [];

  // Para cada item no carrinho
  $('.item-carrinho').each(function() {
    var nome = $(this).find('.product-name').text();
    var preco = $(this).find('.product-price').text().replace('R$ ', '');
    var quantidade = $(this).find('.quantidade').val();

    // Adiciona os dados do item ao array
    carrinhoItens.push({
      nome: nome,
      preco: preco,
      quantidade: quantidade
    });
  });

  // Envia os dados do carrinho para carrinho.php via POST
  $.post('carrinho.php', { itens: carrinhoItens }, function(response) {
    // Exibe a resposta do servidor
    console.log(response);
  });
});

</script>




















<div class="center-container">
    <div class="card">
      <div class="card-body">
        <a href="servicos.php">
          <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-block btn-lg btn-custom">
            Selecionar Serviços
          </button>
        </a>
      </div>
    </div>
  </div>




  </div>
  </div>
  </div>
  </div>
</body>

</html>