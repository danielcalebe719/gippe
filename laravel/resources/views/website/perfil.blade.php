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
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+rtOIQ4GX/D7UvOsAP37+C2z8zKL4ZpV96HuP+wnRL0Kw1h" crossorigin="anonymous"></script>
  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha384-oN46R3tlTtTw9stDShs/JFcEAw9xnK5L5uJSvKrY6J7zCjtx+ZI3d2ERsmr6x6y9" crossorigin="anonymous"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"></script>
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

  <!-- ======= Top Bar ======= -->
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
      <a href="home.html"><img src="assets/img/logo.png" alt="" style="max-width: 50%;"><span></span></a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="home.html">Home</a></li>
          <li><a class="nav-link scrollto" href="#cardapio">Cardápio</a></li>
          <li><a class="nav-link scrollto" href="#about">Sobre nós</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Galeria de fotos</a></li>
          <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="#contact">Fale Conosco</a></li>
          <li>
            <a href="cadastro.html"><button id="register-btn" class="nav-link btn"><i class="bi bi-person-plus"></i> Cadastrar-se</button></a>
          </li>
          <li>
            <a href="login.html"><button id="login-btn" class="nav-link btn">Fazer Login</button></a>
          </li>
          <li id="notification-btn" style="display: none;">
            <a href="#" data-bs-toggle="modal" data-bs-target="#notificationsModal">
              <button class="nav-link btn"><i class="bi bi-bell"></i> Notificações</button>
            </a>
          </li>
          <li id="profile-btn" style="display: none;">
            <a href="perfil.html"><button class="nav-link btn"><i class="bi bi-person"></i> Perfil</button></a>
          </li>
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

 

  <!-- Conteúdo do corpo -->
  <!-- Seção de perfil do cliente -->
  <section style="background-color: #eee;">
    <div class="container py-5">
      <!-- Detalhes do cliente -->
      <div class="row">
        <div class="col-lg-4">
          <!-- Imagem do cliente -->
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="assets/img/sample-avatar.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">Nome do Cliente</h5>
                        <form action="uploadimgPerfil.php" method="post" enctype="multipart/form-data">
     <div class="mb-3">
        <label for="formFileSm" class="form-label">Defina uma imagem de perfil</label>
        <input type="file" class="form-control form-control-sm"id="imagem" name="imagem">
      </div>
            
            <input type="hidden" name="idClientes" value="1">
            <input type="hidden" name="acao" value="imgInsercao">
            <input type="submit" value="Salvar" class="btn btn-success">
          </form>
        </div>
      </div>

      <!-- Endereço -->
      <div class="card mb-4">
        <div class="card-body">
          <h3>Endereço</h3>
          <p><strong>Tipo:</strong> Residencial</p>
          <p><strong>CEP:</strong> 12345-678</p>
          <p><strong>Cidade:</strong> Lisboa</p>
          <p><strong>Bairro:</strong> Bairro Alto</p>
          <p><strong>Rua:</strong> Rua da Alegria</p>
          <p><strong>Número:</strong> 123</p>
          <p><strong>Complemento:</strong> Apto 45</p>
          <!-- Botão "Editar Endereço" -->
          <button id="editarEnderecoBtn" type="button" class="btn btn-link edit-endereco-btn">
            <i class="bi bi-pencil"></i> Editar Endereço
          </button>
        </div>
      </div>

    </div>
    <!-- Modal para editar endereço -->

    <div class="col-lg-8">
      <!-- Informações detalhadas do cliente -->
      <div class="card mb-4">
        <div class="card-body">
          <form action="" method="post">
            <input type="hidden" name="acao" value='editaPerfil'>
            <!-- Nome -->
            <div class="row">
              <div class="col-sm-3">
                <label for="nome">Nome completo</label>
              </div>
              <div class="col-sm-8">
                <input type="text" id="nome" name="nome" class="form-control" value="Nome do Cliente" readonly>
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
                <input type="email" id="email" name="email" class="form-control" value="cliente@example.com" readonly>
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
                <input type="password" id="senha" name="senha" class="form-control" value="********" readonly>
              </div>
              <div class="col-sm-1">
                <a href="#" class="btn btn-link edit-btn" data-target="senha"><i class="bi bi-pencil"></i></a>
              </div>
            </div>
            <hr>
            <!-- CPF -->
            <div class="row">
              <div class="col-sm-3">
                <label for="cpf">CPF</label>
              </div>
              <div class="col-sm-8">
                <input type="text" id="cpf" name="cpf" class="form-control" value="12345678901" readonly maxlength="11">
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
                <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="1990-01-01" readonly>
              </div>
              <div class="col-sm-1">
                <a href="#" class="btn btn-link edit-btn" data-target="data_nascimento"><i class="bi bi-pencil"></i></a>
              </div>
            </div>
            <hr>
            <!-- Botão para salvar alterações -->
            <div class="row">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary" id="saveChangesBtn">Salvar Alterações</button>
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
          <th scope="col">ID Pedido</th>
          <th scope="col">Status</th>
          <th scope="col">Data de Entrega</th>
          <th scope="col">Endereço</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Entregue</td>
          <td>2023-06-15</td>
          <td>Rua da Alegria - 123 - Apto 45 - Bairro Alto - Lisboa - 12345-678 - Tipo: Residencial</td>
          <td>€50,00</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Pendente</td>
          <td>2023-06-20</td>
          <td>Rua da Alegria - 123 - Apto 45 - Bairro Alto - Lisboa - 12345-678 - Tipo: Residencial</td>
          <td>€30,00</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
      </div>
    </div>
  </div>
</div>
 </section>
  <div class="modal fade" id="enderecoModal" tabindex="-1" role="dialog" aria-labelledby="enderecoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="enderecoModalLabel">Editar Endereço</h5>
                </div>
                <div class="modal-body">
                    <form id="enderecoForm" method="post">
                        <input type="hidden" name="acao" value="editarEndereco">
                        <input type="hidden" name="idClientes" value="1">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="comercial">Comercial</option>
                                <option value="residencial" selected>Residencial</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" class="form-control" value="12345-678">
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" class="form-control cep-cidade" value="Lisboa">
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" class="form-control cep-bairro" value="Bairro Alto">
                        </div>
                        <div class="form-group">
                            <label for="rua">Rua</label>
                            <input type="text" id="rua" name="rua" class="form-control cep-logradouro" value="Rua da Alegria">
                        </div>
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="text" id="numero" name="numero" class="form-control" value="123">
                        </div>
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" name="complemento" class="form-control" value="Apto 45">
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
    document.getElementById("btnAbrirModal").addEventListener("click", function() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("modalBody").innerHTML = this.responseText;
                $('#modalDetalhesPedido').modal('show'); // Abre o modal
            }
        };
        xhttp.open("GET", "detalhes_pedido.html", true);
        xhttp.send();
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    const saveChangesBtn = document.getElementById('saveChangesBtn');


    editButtons.forEach(function(btn) {
      btn.addEventListener('click', function(event) {
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"></script>
<script>
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

  $(document).ready(function () {
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
        if(validacep.test(cep)) {
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
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  
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






