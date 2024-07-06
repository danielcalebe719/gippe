<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

  <title>Buffet Divino Sabor - Produtos</title>




  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap_pedidos.css') }}" />

  <!-- Owl Carousel stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- Nice Select CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />

  <!-- Custom Styles -->
  <link href="{{ asset('assets/css/style_pedidos.css') }}" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
  <!-- jQuery -->
  <script src="{{ asset('assets/vendor/jquery/jquery-3.6.0.min.js') }}"></script>

  <!-- Lightbox CSS -->
  <link href="{{ asset('assets/vendor/lightbox2/2.11.3/css/lightbox.min.css') }}" rel="stylesheet">

  <!-- AOS CSS -->
  <link href="{{ asset('assets/vendor/aos/2.3.4/aos.css') }}" rel="stylesheet">

  <!-- Font Awesome CSS -->
  <link href="{{ asset('assets/vendor/font-awesome/6.0.0-beta3/css/all.min.css') }}" rel="stylesheet">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      /* Exemplo de uso: define Poppins como a fonte padrão para o corpo do documento */
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">


</head>


<body>

  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:buffetdivinosabor@gmail.com">buffetdivinosabor@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+31 95589 55488</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{ url('/website') }}"><img src="assets/img/logo.png" alt="" style="max-width: 50%;"><span></span></a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ url('/website') }}">Home</a></li>
          <li><a class="nav-link scrollto" href="#cardapio">Cardápio</a></li>
          <li><a class="nav-link scrollto" href="#about">Sobre nós</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Galeria de fotos</a></li>
          <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="#contact">Fale Conosco</a></li>

          @guest('cliente')
          <!-- Mostrar se não estiver logado -->
          <li>
            <a href="{{ url('website/cadastro') }}"><button id="register-btn" class="nav-link btn"><i class="bi bi-person-plus"></i> Cadastrar-se</button></a>
          </li>
          <li>
            <a href="{{ url('website/login') }}"><button id="login-btn" class="nav-link btn">Fazer Login</button></a>
          </li>
          @else
          <!-- Mostrar se estiver logado -->
          <li id="notification-btn">
            <a href="#" data-bs-toggle="modal" data-bs-target="#notificationsModal" style="   text-decoration: none;">
              <button class="nav-link btn"><i class="bi bi-bell" "></i> Notificações</button>
                    </a>
                </li>
                <li id=" profile-btn">
                  <a href="{{ url('website/perfil') }}" style="text-decoration: none;"><button class="nav-link btn"><i class="bi bi-person"></i> Perfil</button></a>
          </li>
          @endguest
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>




  <!-- Notifications Modal -->
  <div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationsModalLabel">Notificações</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Exemplo estático de notificações -->
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">Mensagem de exemplo 1</h5>
              <p class="card-text">2024-06-26</p>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">Mensagem de exemplo 2</h5>
              <p class="card-text">2024-06-25</p>
            </div>
          </div>
          <p>Nenhuma notificação encontrada.</p>
        </div>
      </div>
    </div>
  </div>














<!-- food section -->
<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Faça seu Pedido!</h2>
    </div>

    <ul class="filters_menu">
      <li class="active" data-filter="*">Todos</li>
      <li data-filter=".salgado">Salgados</li>
      <li data-filter=".doce">Doces</li>
      <li data-filter=".bebida">Bebidas</li>
    </ul>

    <div class="filters-content">
      <div class="row grid" id="product-list">
        <!-- Aqui serão carregados os produtos -->
        @foreach($produtos->take(15) as $produto)
        <div class="col-sm-6 col-lg-4 all {{ $produto->tipo }}">
          <div class="box">
            <div>
              <div class="img-box">
                <img src="{{ asset('storage/ImagensProdutos/' . $produto->caminhoImagem) }}" alt="{{ $produto->nome }}">
              </div>
              <div class="detail-box">
                <div class="options">
                  <div>
                    <h6>{{ $produto->nome }}</h6>
                    <p>{{ $produto->descricao }}</p>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="quantity mr-3">
                      <input type="number" min="1" value="1" class="form-control form-control-sm">
                    </div>
                    <a href="#" class="btn add-to-cart" data-id="{{ $produto->id }}" data-nome="{{ $produto->nome }}" data-precoUnitario="{{ number_format($produto->precoUnitario, 2, ',', '.') }}">
                      <i class="bi bi-cart" style="color: white;"></i>
                      <span class="preco-unitario" style="display: none;">{{ number_format($produto->precoUnitario, 2, ',', '.') }}</span>
                    </a>
                    <h6>R$ {{ number_format($produto->precoUnitario, 2, ',', '.') }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="btn-box">
        <button id="ver-mais-btn" class="btn btn-primary">Ver mais</button>
      </div>
    </div>
  </div>
</section>


  <input type="hidden" id="codigo" value="{{ $codigo }}">
  <!-- end food section -->

  <!-- cart section -->
  <section class="h-100">
    <div class="container h-100 py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-10">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-normal mb-0">Carrinho</h1>
         
          </div>
          <div class="card rounded-3 mb-4">
  <div class="card-body p-4">
    <div class="row g-3 align-items-center">
      <div class="col-md-6">
        <h3 class="mb-0">{{ $servico->nomeServico }}</h3>
      </div>

    </div>
    <hr class="my-4">
    @foreach ($pedidos_servicos as $pedido_servico)
      <div class="card rounded-3 mb-4">
        <div class="card-body p-4">
          <div class="row g-3 align-items-center">
            <div class="col-md-4">
              <p class="mb-0">Funcionário: <strong>{{ $pedido_servico->funcionarioTipo }}</strong></p>
            </div>
            <div class="col-md-4">
              <p class="mb-0">Quantidade: <strong>{{ $pedido_servico->quantidade }}</strong></p>
            </div>
            <div class="col-md-4 text-end">
              <h5 class="mb-0">Subtotal: <strong style="color: #FA856E;">R${{ number_format($pedido_servico->subtotal, 2) }}</strong></h5>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    <div class="col-md-12 text-end ">
        <h3 class="mb-0" >
          Total dos Serviços:
          <span style="color: #FA856E;">R${{ number_format($servico->totalServicos, 2) }}</span>
        </h3>
      </div>
  </div>
</div>

          <div class="cart-items">
            <!-- Aqui será inserido dinamicamente o conteúdo do carrinho -->
          </div>

 





          <div class="card">
            <div class="card-body">
              <a href="{{ url('/website/agendamento/' . $codigo) }}"
              class="btn btn-warning btn-block btn-lg checkout-btn">Fazer agendamento da festa</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- end cart section -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.filters_menu li').click(function() {
        $('.filters_menu li').removeClass('active');
        $(this).addClass('active');

        var filterValue = $(this).attr('data-filter');
        if (filterValue == "*") {
          $('.filters-content .all').show();
        } else {
          $('.filters-content .all').not(filterValue).hide();
          $('.filters-content .all').filter(filterValue).show();
        }
      });

      // Array para armazenar os itens do carrinho
      let carrinho = [];

      // Função para adicionar um item ao carrinho
      $('.add-to-cart').click(function(e) {
        e.preventDefault();

        // Captura informações do produto
        let id = $(this).data('id');
        let nome = $(this).data('nome');
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
            precoUnitario: precoUnitario,
            quantidade: quantidade
          });
        }

        // Atualiza visualização do carrinho
        atualizarCarrinho();
      });

      // Função para atualizar visualização do carrinho
      function atualizarCarrinho() {
        console.log('Atualizando carrinho...');
        $('.cart-items').empty();

        let total = 0;

        carrinho.forEach(function(item) {
          let subtotal = item.precoUnitario * item.quantidade;
          total += subtotal;

          let itemHtml = `
  <div class="card rounded-3 mb-4">
  <div class="card-body p-4">
    <div class="row g-3 align-items-center">
      <div class="col-md-2">
        <img src="{{ asset('storage/ImagensProdutos/' . $produto->caminhoImagem) }}" class="img-fluid rounded-3" alt="${item.nome}">
      </div>
      <div class="col-md-4">
        <p class="lead fw-normal mb-2">${item.nome}</p>
        <p class="mb-0">Quantidade: ${item.quantidade}</p>
      </div>
      <div class="col-md-3">
        <h5 class="mb-0">Subtotal: R$${subtotal.toFixed(2)}</h5>
      </div>
      <div class="col-md-3 text-end">
        <button class="btn btn-danger remove-item" data-id="${item.id}">
          <i class="fas fa-trash fa-lg"></i>
        </button>
      </div>
    </div>
  </div>
  
</div>

        `;

          $('.cart-items').append(itemHtml);
        });

        $('.cart-items').append(`
  <div class="d-flex justify-content-end mt-4">
    <div class="bg-light p-3 rounded-3">
      <h3 class="mb-0">Total dos Produtos: R$${total.toFixed(2)} </h3>
    </div>
  </div>
`);

        
        
        // Mostra o total no carrinho


      }

      // Evento para remover um item do carrinho
      $(document).on('click', '.remove-item', function(e) {
        e.preventDefault();
        let id = $(this).data('id');

        // Remove o item do carrinho
        carrinho = carrinho.filter(item => item.id !== id);

        // Atualiza visualização do carrinho
        atualizarCarrinho();
      });

      // Evento para finalizar compra
      var codigo = document.getElementById('codigo').value;


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





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    var skip = 15; // Começa do produto 16 (índice 15 no array)

    $('#ver-mais-btn').click(function(e) {
      e.preventDefault();
      
      // Requisição AJAX para carregar mais produtos
      $.ajax({
        type: 'GET',
        url: '/website/carregar-mais-produtos',
        data: { skip: skip },
        dataType: 'html',
        success: function(response) {
          $('#product-list').append(response); // Adiciona os novos produtos ao final da lista
          skip += 15; // Atualiza o índice de início para os próximos produtos
          
          // Se não houver mais produtos para carregar, esconde o botão "Ver mais"
          if (response.trim() === '') {
            $('#ver-mais-btn').hide();
          }
        },
        error: function(xhr, status, error) {
          console.error('Erro ao carregar mais produtos:', error);
        }
      });
    });
  });
</script>














  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

</body>

</html>