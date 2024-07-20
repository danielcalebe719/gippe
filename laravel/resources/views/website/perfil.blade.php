<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Buffet Divino Sabor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
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
  <!-- jQuery -->
  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  <!-- Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <style>
     .corpo {
    background-image: url("{{ asset('assets/img/logo.png') }}");
    background-repeat: no-repeat; /* Evita a repetição da imagem */
    background-size: cover; /* Ajusta o tamanho da imagem para cobrir todo o elemento */
    background-position: center; /* Centraliza a imagem no elemento */
}

  </style>
  
</head>

<body>
@include('partials.navbar')


  <!-- Conteúdo do corpo -->
  <!-- Seção de perfil do cliente -->
  <section style="background-color: #eee;" >
    <div class="container py-5">
      <!-- Detalhes do cliente -->
      <div class="row">
        <div class="col-lg-4">
          
          <div class="card mb-4">
          <div class="card-body text-center">
    @if ($clientes->imgCaminho)
    <img src="{{ asset('storage/ImagensClientes/' . $clientes->caminhoImagem) }}" alt="{{$clientes->caminhoImagem}}" class="rounded-circle img-fluid" style="width: 150px;">
    @else
    <img src="{{ asset('storage/ImagensClientes/' . $clientes->caminhoImagem) }}" alt="perfil" class="rounded-circle img-fluid" style="width: 150px;"> <!-- Se não houver imagem, exibe um placeholder ou ícone padrão -->
    @endif
    <h5 class="my-3">{{ $clientes->nome }}</h5>
    
    <div id="editarImagemForm" style="display: none;">
        <form action="{{ route('website.salvar.imagem.perfil') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="imagem" class="form-label">Defina uma imagem de perfil</label>
                <input type="file" class="form-control form-control-sm" id="imagem" name="imagem">
            </div>
            <input type="hidden" name="idClientes" value="{{ $clientes->id }}">
            <input type="submit" value="Salvar" class="btn btn-success">
        </form><br>
    </div>
<div class="d d-flex justify-content-center">
    <div id="editarImagemLink">
        <a href="#" id="editarImagemBtn" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Editar Imagem
        </a>
    </div>
    </form>
    <a href="{{ url('website/logout') }}" class="btn btn-danger">
        Fazer Logout <i class="bi bi-box-arrow-right"></i>
    </a>
</div>

</div>

<script>
    document.getElementById('editarImagemBtn').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('editarImagemForm').style.display = 'block';
        document.getElementById('editarImagemLink').style.display = 'none';
    });
</script>

          </div>


          <!-- Endereço -->
          @if ($enderecos_clientes)
          <div class="card mb-4">
            <div class="card-body">
              <h3>Endereço</h3>
              <p><strong>Tipo:</strong> {{$enderecos_clientes->tipo}}</p>
              <p><strong>CEP:</strong> {{$enderecos_clientes->cep}}</p>
              <p><strong>Cidade:</strong> {{$enderecos_clientes->cidade}}</p>
              <p><strong>Bairro:</strong> {{$enderecos_clientes->bairro}}</p>
              <p><strong>Rua:</strong> {{$enderecos_clientes->rua}}</p>
              <p><strong>Número:</strong> {{$enderecos_clientes->numero}}</p>
              <p><strong>Complemento:</strong> {{$enderecos_clientes->complemento}}</p>
              <!-- Botão "Editar Endereço" -->
              <button id="editarEnderecoBtn" type="button" class="btn btn-link edit-endereco-btn">
                <i class="bi bi-pencil"></i> Editar Endereço
              </button>
            </div>
          </div>
          @else
          <div class="alert alert-warning" role="alert">
            Nenhum endereço encontrado.
          </div>
          @endif


        </div>
        <!-- Modal para editar endereço -->

        <div class="col-lg-8">
          <!-- Informações detalhadas do cliente -->
          <div class="card mb-4">
            <div class="card-body">
              <form action="{{ route('website.perfil.salvar') }}" method="post" id="perfilForm">
                @csrf
                <input type="hidden" name="acao" value="editaPerfil">

                <!-- Nome -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="nome">Nome completo</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" id="nome" name="nome" class="form-control" value="{{ $clientes->nome }}" readonly>
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="nome"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>

                <!-- Email -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="email">Email</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="email" id="email" name="email" class="form-control" value="{{ $clientes->email }}" readonly>
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="email"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>

                <!-- Senha -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="senha">Senha</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="password" id="senha" name="senha" class="form-control" value="" readonly placeholder="*********">
                    <input type="hidden" id="senha_original" name="senha_original" value="{{ $clientes->password }}">
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="senha"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>

                <!-- Telefone -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="telefone">Telefone</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" id="telefone" name="telefone" class="form-control" value="{{ $clientes->telefone }}" readonly>
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="telefone"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>

                <!-- CPF -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="cpf">CPF</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" id="cpf" name="cpf" class="form-control" value="{{ $clientes->cpf }}" readonly maxlength="11">
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="cpf"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>

                <!-- Data de nascimento -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="data_nascimento">Data de nascimento</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="{{ $clientes->dataNascimento }}" readonly>
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="data_nascimento"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>

                <!-- Botão para salvar alterações -->
                <div class="row">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary" id="saveChangesBtn" style="display: none;">Salvar Alterações</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
          <!-- Pedidos do cliente -->
          <div class="card mb-4">
            <div class="card-body">
              <h3>Pedidos</h3>
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Código do Pedido</th>
                    <th scope="col">Status</th>
                    <th scope="col">Data de Entrega</th>
                    <!--<th scope="col">Endereço</th>-->
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>

                  @if ($pedidos->count() > 0)
                  @foreach ($pedidos as $pedido)
                  <tr>
              
                  <td><a href="pedidos/pedidosDetalhes/{{$pedido->codigo}}"> {{ $pedido->codigo }}</a></td>



                    <td>
                    {{$pedido->getStatus()  }}
                    </td>
                    <td>{{ $pedido->dataEntrega }}</td>

                    <td>{{ 'R$' . number_format($pedido->totalPedido, 2, ',', '.') }}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="5">Nenhum pedido encontrado.</td>
                  </tr>
                  @endif

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <div class="modal fade" id="enderecoModal" tabindex="-1" role="dialog" aria-labelledby="enderecoModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style= " border: 1px solid #FA856E;
  box-shadow: 0 0 10px rgba(250, 133, 110, 0.5);">
        <div class="modal-header text-light" style="background-color: #FA856E;">
          <h3 class="modal-title" id="enderecoModalLabel">Editar Endereço</h3>
        </div>
        <div class="modal-body">
          <form id="enderecoForm" method="post" action="{{route('website.perfil.salvar.endereco')}}">
            @csrf
            <input type="hidden" name="acao" value="{{ isset($enderecos_clientes) ? 'editarEndereco' : 'adicionarEndereco' }}">
            <input type="hidden" name="idClientes" value="{{ $enderecos_clientes->idClientes ?? '' }}">

            <div class="form-group">
              <label for="tipo">Tipo</label>
              <select name="tipo" id="tipo" class="form-control">
                <option value="comercial" {{ isset($enderecos_clientes) && $enderecos_clientes->tipo == 'comercial' ? 'selected' : '' }}>Comercial</option>
                <option value="residencial" {{ isset($enderecos_clientes) && $enderecos_clientes->tipo == 'residencial' ? 'selected' : '' }}>Residencial</option>
              </select>
            </div>

            <div class="form-group">
              <label for="cep">CEP</label>
              <input type="text" id="cep" name="cep" class="form-control" value="{{ isset($enderecos_clientes) ? $enderecos_clientes->cep : '' }}">
            </div>

            <div class="form-group">
              <label for="cidade">Cidade</label>
              <input type="text" id="cidade" name="cidade" class="form-control cep-cidade" value="{{ isset($enderecos_clientes) ? $enderecos_clientes->cidade : '' }}">
            </div>

            <div class="form-group">
              <label for="bairro">Bairro</label>
              <input type="text" id="bairro" name="bairro" class="form-control cep-bairro" value="{{ isset($enderecos_clientes) ? $enderecos_clientes->bairro : '' }}">
            </div>

            <div class="form-group">
              <label for="rua">Rua</label>
              <input type="text" id="rua" name="rua" class="form-control cep-logradouro" value="{{ isset($enderecos_clientes) ? $enderecos_clientes->rua : '' }}">
            </div>

            <div class="form-group">
              <label for="numero">Número</label>
              <input type="text" id="numero" name="numero" class="form-control" value="{{ isset($enderecos_clientes) ? $enderecos_clientes->numero : '' }}">
            </div>

            <div class="form-group">
              <label for="complemento">Complemento</label>
              <input type="text" id="complemento" name="complemento" class="form-control" value="{{ isset($enderecos_clientes) ? $enderecos_clientes->complemento : '' }}">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary" id="saveEnderecoBtn">Salvar mudanças</button>
            </div>
          </form>


        </div>
      </div>
    </div>
  </div>
</body>
<script>
  // Evento de clique para abrir o modal e carregar os detalhes do pedido via AJAX
  //document.getElementById("btnAbrirModal").addEventListener("click", function() {
  //  var xhttp = new XMLHttpRequest();
  //  xhttp.onreadystatechange = function() {
  //    if (this.readyState == 4 && this.status == 200) {
  //      document.getElementById("modalBody").innerHTML = this.responseText;
   //     $('#modalDetalhesPedido').modal('show'); // Abre o modal
   //   }
  //  };
  //  xhttp.open("GET", "detalhes_pedido.html", true);
  //  xhttp.send();
 // });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    const saveChangesBtn = document.getElementById('saveChangesBtn');


    editButtons.forEach(function(btn) {

      btn.addEventListener('click', function(event) {
        document.getElementById('saveChangesBtn').style.display = 'block';
        event.preventDefault();
        const targetId = this.getAttribute('data-target');
        const targetInput = document.getElementById(targetId);
        targetInput.removeAttribute('readonly');
        targetInput.focus();
      });
    });
  })
  // Adiciona um evento de clique ao botão "Editar Endereço"
  const editarEnderecoBtn = document.getElementById('editarEnderecoBtn');
  const enderecoModal = document.getElementById('enderecoModal');
  const enderecoForm = document.getElementById('enderecoForm');
  const saveEnderecoBtn = document.getElementById('saveEnderecoBtn');

  editarEnderecoBtn.addEventListener('click', () => {
    // Exibe o modal
    $('#enderecoModal').modal('show');
  });

  // Event listener para salvar mudanças no endereço
  saveEnderecoBtn.addEventListener('click', () => {
    // Adicione aqui a lógica para salvar as alterações no endereço
    const formData = new FormData(enderecoForm);
    const tipo = formData.get('tipo');
    const cep = formData.get('cep');
  });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><script>
  document.getElementById("editarEnderecoBtn").addEventListener("click", function() {
    document.getElementById("enderecoModal").classList.add("show");
    document.getElementById("enderecoModal").style.display = "block";
    document.body.classList.add("modal-open");
    document.getElementsByClassName("modal-backdrop")[0].style.display = "block";
  });

  document.querySelectorAll('[data-dismiss="modal"]').forEach(function(el) {
    el.addEventListener("click", function() {
      document.getElementById("enderecoModal").classList.remove("show");
      document.getElementById("enderecoModal").style.display = "none";
      document.body.classList.remove("modal-open");
      document.getElementsByClassName("modal-backdrop")[0].style.display = "none";
    });
  });

  $(document).ready(function() {
    // Função para limpar o formulário de CEP
    function limpaFormularioCEP() {
      $(".cep-logradouro").val("");
      $(".cep-bairro").val("");
      $(".cep-cidade").val("");
      $(".cep-estado").val("");
    }

    // Evento "blur" para detectar quando o usuário termina de digitar o CEP
    $("#cep").blur(function() {
      var cep = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico do CEP
      if (cep !== "") {
        var validacep = /^[0-9]{8}$/; // Expressão regular para validar o formato do CEP
        if (validacep.test(cep)) {
          // Preenche os campos com "..." enquanto a busca está sendo realizada
          $(".cep-logradouro").val("...");
          $(".cep-bairro").val("...");
          $(".cep-cidade").val("...");
          $(".cep-estado").val("...");

          // Faz a requisição para a API ViaCEP
          $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
            if (!("erro" in dados)) {
              // Atualiza os campos do formulário com os dados recebidos
              $(".cep-logradouro").val(dados.logradouro);
              $(".cep-bairro").val(dados.bairro);
              $(".cep-cidade").val(dados.localidade);
              $(".cep-estado").val(dados.uf);
            } else {
              // CEP não encontrado
              limpaFormularioCEP();
              alert("CEP não encontrado.");
            }
          });
        } else {
          // CEP em formato inválido
          limpaFormularioCEP();
          alert("Formato de CEP inválido.");
        }
      } else {
        // CEP sem valor, limpa formulário
        limpaFormularioCEP();
      }
    });
  });
</script>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

<script src="{{ asset('assets/js/mainn.js') }}"></script>



<script>
  var loggedIn = true; // Alterar para false para simular usuário não logado

  window.addEventListener('DOMContentLoaded', (event) => {
    function toggleButtons() {
      if (loggedIn) {
        $("#register-btn, #login-btn").hide();
        $("#profile-btn, #notification-btn").show();
      } else {
        $("#register-btn, #login-btn").show();
        $("#profile-btn, #notification-btn").hide();
      }
    }

    $(document).ready(function() {
      toggleButtons();
    });
  });
</script>
</body>

</html>