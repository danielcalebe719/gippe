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
