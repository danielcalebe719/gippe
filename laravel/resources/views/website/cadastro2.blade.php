<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete seu cadastro</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <style>
        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff5e6;
        }

        .bg-blur {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f2e9e1;
            background-size: cover;
            z-index: -1;
        }

        .text-bg-primary {
            background-color: #FAA562;
            color: #fff;
            padding: 20px;
        }

        .btn-primary,
        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #FA856E;
            border-color: #FA856E;
        }

        .btn-outline-primary,
        .btn-outline-primary:hover,
        .btn-outline-primary:focus {
            color: #FA856E;
            border-color: #FA856E;
        }

        .form-label {
            color: #FA856E;
        }

        .form-control {
            border-color: #FA856E;
        }

        .text-secondary {
            color: #FAA562;
        }
    </style>
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
      <a href="{{ url('/website') }}"><img src="assets/img/logo.png" alt="" style="max-width: 50%;"><span></span></a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ url('/website') }}">Home</a></li>
          <li><a class="nav-link scrollto" href="./#cardapio">Cardápio</a></li>
          <li><a class="nav-link scrollto" href="./#about">Sobre nós</a></li>
          <li><a class="nav-link scrollto" href="./#portfolio">Galeria de fotos</a></li>
          <li><a class="nav-link scrollto" href="./#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="./#contact">Fale Conosco</a></li>

          @guest('cliente')
          <!-- Mostrar se não estiver logado -->
          <li>
            <a href="{{ url('website/cadastro') }}">
              <button id="register-btn" class="nav-link btn"><i class="bi bi-person-plus"></i> Cadastrar-se</button>
            </a>
          </li>
          <li>
            <a href="{{ url('website/login') }}">
              <button id="login-btn" class="nav-link btn">Fazer Login</button>
            </a>
          </li>
          @else
          <!-- Mostrar se estiver logado -->
          <li id="notification-btn">
            <a href="#" data-bs-toggle="modal" data-bs-target="#notificationsModal">
              <button class="nav-link btn"><i class="bi bi-bell"></i> Notificações
                @if($quantidadeNotificacoes > 0)
                <span class="badge bg-danger quantidadeNotificacoes">{{ $quantidadeNotificacoes }}</span>
                @endif
              </button>
            </a>
          </li>
          <li id="profile-btn">
            <a href="{{ url('website/perfil') }}">
              <button class="nav-link btn"><i class="bi bi-person"></i> Perfil</button>
            </a>
          </li>
          @endguest

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  

  <div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationsModalLabel">Notificações</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if ($notificacoes->isNotEmpty())
          @foreach ($notificacoes as $notificacao)
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">{{ $notificacao->mensagem }}</h5>
              <p class="card-text">{{ $notificacao->dataEnvio }}</p>
              <!-- Verificar se a notificação não foi lida -->
              @if ($notificacao->lido == false)
              <form class="form-marcar-lida" data-notificacao-id="{{ $notificacao->id }}" action="{{ route('notificacoes.marcarLida', $notificacao->id) }}" method="POST">
                @csrf
                <button type="button" class="btn btn-primary btn-marcar-lida">
                  <i class="bi bi-check"></i> Marcar como lida
                </button>
              </form>
              @else
              <button type="button" class="btn btn-secondary disabled">
                <i class="bi bi-check"></i> Lida
              </button>
              @endif
            </div>
          </div>
          @endforeach
          @else
          <p>Nenhuma notificação encontrada.</p>
          @endif
        </div>
      </div>
    </div>
  </div>

    <div class="bg-blur"></div>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="card border-light-subtle shadow-sm" style="border: 5px solid #FA856E; border-radius: 5px;">
                <div class="row g-0">
                    <div class="col-12 col-md-6 order-md-last d-flex align-items-center justify-content-center"
                        style="background-color: #FA856E; color: #fff; margin: -5px;">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="col-10 col-xl-8 py-3">
                                <a href="{{ route('website.index') }}">
                                    <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid rounded mb-4"
                                        loading="lazy" width="245" height="80" alt="Logo" style="margin-left: 17%;">
                                </a>
                                <hr class="border-primary-subtle mb-4">
                                <h2 class="h1 mb-4">Complete seu cadastro para continuar nosso atendimento!</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h3 style="color: #FA856E;">Cadastro</h3>
                                        <p>Preencha o formulário abaixo para completar seu cadastro.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="erro">
                                <!-- Conteúdo do #erro -->
                            </div>
                            <form id="cadastroForm" method="POST" action="{{ url('website/cadastroCompletar') }}">
                                @csrf
                                <input type="hidden" name="idClientes" value="{{ Auth::guard('cliente')->user()->id }}">
                                
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nome" name="nome" required value="{{ old('nome', $cliente->nome ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="telefone" class="form-label">Telefone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telefone" name="telefone" required value="{{ old('nome', $cliente->telefone ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="cpf" class="form-label">CPF <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" required value="{{ old('cpf', $cliente->cpf ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="dataNascimento" class="form-label">Data de Nascimento <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required value="{{ old('dataNascimento', $cliente->dataNascimento ?? '0000-00-00') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="endereco_select" class="form-label">Selecione um endereço ou adicione um novo <span class="text-danger">*</span></label>
                                        <select class="form-select" id="endereco_select" name="endereco_select" required>
                                            <option value="">Selecione um endereço</option>
                                            @foreach($enderecosClientes as $endereco)
                                                <option value="{{ $endereco->id }}">
                                                    {{ $endereco->rua }}, {{ $endereco->numero }} - {{ $endereco->bairro }}, {{ $endereco->cidade }}
                                                </option>
                                            @endforeach
                                            <option value="novo">Adicionar novo endereço</option>
                                        </select>
                                    </div>
                                    <div id="novo_endereco" style="display: none;">
                                        <div class="col-12">
                                            <label for="cep" class="form-label">CEP <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="cep" name="cep" maxlength="8">
                                        </div>
                                        <div class="col-12">
                                            <label for="rua" class="form-label">Rua <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="rua" name="rua" maxlength="40">
                                        </div>
                                        <div class="col-6">
                                            <label for="numero" class="form-label">Número <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="numero" name="numero" maxlength="5">
                                        </div>
                                        <div class="col-6">
                                            <label for="complemento" class="form-label">Complemento</label>
                                            <input type="text" class="form-control" id="complemento" name="complemento" maxlength="20">
                                        </div>
                                        <div class="col-12">
                                            <label for="bairro" class="form-label">Bairro <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="bairro" name="bairro" maxlength="25">
                                        </div>
                                        <div class="col-12">
                                            <label for="cidade" class="form-label">Cidade <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="cidade" name="cidade" maxlength="40">
                                        </div>
                                        <div class="col-12">
                                            <label for="tipo" class="form-label">Tipo de Endereço <span class="text-danger">*</span></label>
                                            <select class="form-select" id="tipo" name="tipo">
                                                <option value="">Selecione o tipo de Endereço</option>
                                                <option value="residencial">Residencial</option>
                                                <option value="comercial">Comercial</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                            <label class="form-check-label" for="terms">
                                                Eu concordo com os <a href="#">termos e condições</a> do site.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <br>
                                        <button type="submit" class="btn btn-primary">Continuar</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-5 mb-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                        <a href="{{ url('website/login') }}" class="link-secondary text-decoration-none" style="color: #FA856E;"><!--visuasualizar a pagina de produtos mesmo sem estar logado?--></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>


$(document).ready(function () {
    $('#cadastroForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: "{{ url('/website/cadastroCompletar') }}",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log('Resposta AJAX recebida:', response);
                if (response.success) {
                    // Armazena o endereco_cliente no localStorage
                    localStorage.setItem('endereco_cliente', JSON.stringify(response.endereco_cliente));
                    console.log('Endereço do cliente salvo no localStorage:', response.endereco_cliente);

                    // Verifique se o localStorage está sendo definido corretamente
                    var enderecoCliente = localStorage.getItem('endereco_cliente');
                    console.log('Verificação localStorage:', enderecoCliente);

                    // Redireciona para a página de serviços
                    console.log('Redirecionando para página de serviços...');
                    window.location.href = "{{ url('website/servicos') }}";
                } else {
                    $('.alert-danger').remove();
                    $('#erro').empty().append('<div class="alert alert-danger">' + response.message + '</div>');
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON.message;
                console.log('Erro na resposta AJAX:', errorMessage);
                $('.alert-danger').remove();
                $('#erro').empty().append('<div class="alert alert-danger">' + errorMessage + '</div>');
                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        });
    });





        

        $('#endereco_select').change(function() {
            if ($(this).val() == 'novo') {
                $('#novo_endereco').show();
            } else {
                $('#novo_endereco').hide();
            }
        });

        $("#cep").blur(function() {
            var cep = $(this).val().replace(/\D/g, '');
            if (cep !== "") {
                var validacep = /^[0-9]{8}$/;
                if(validacep.test(cep)) {
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                        } else {
                            limparFormularioCEP();
                            alert("CEP não encontrado.");
                        }
                    });
                } else {
                    limparFormularioCEP();
                    alert("Formato de CEP inválido.");
                }
            } else {
                limparFormularioCEP();
            }
        });

        function limparFormularioCEP() {
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
        }
    });
    </script>
</body>

</html>