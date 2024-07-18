<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Pedido</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <!-- Flatpickr Portuguese Localization -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: url('') no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: blur(5px);                 display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;  
        }
        .container {
            margin-top: 50px;
            border-radius: 15px ;
        }
        .btn-custom {
            background-color: #FF944E;
            border: none;
        }
        .btn-confirm {
            background-color: #fa856e;
            border: none;
        }
        .card-custom {
            border: none;
            box-shadow: 0 8px 16px #FA856E;
            border-radius: 15px ;
        }
        .card-title {
            color: #FF944E;
        }
        .form-label {
            color: #343a40;
            font-weight: 600;
        }
        .form-control {
            border-radius: 10px;
        }
        .modal-header {
            background-color: #FF944E;
            color: white;
        }
        .modal-footer {
            border-top: none;
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


<div class="container">


        <div class="row justify-content-center">
            
            <div class="col-md-8">
                <div class="card card-custom mb-4">
                    <div class="card-body">
                  
                        <h1 class="card-title mb-4">Agende sua Festa</h1>
                        @if(!$criacao)
                        <div class="alert alert-info">
                            Você está editando um pedido existente. Faça as alterações abaixo.
                        </div>
                    @endif  
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="agendamentoForm" method="POST" action="{{ route('website.agendamento.salvar') }}">
                            @csrf
                            <input type="hidden" name="codigo" value="{{ $codigo }}">
                            
                            <div class="mb-3">
                                <label for="dataInicio" class="form-label">Data de Início do Evento:</label>
                                <input type="text" id="dataInicio" name="dataInicio" class="form-control" value="{{ $agendamento->dataInicio ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="dataFim" class="form-label">Data de Fim do Evento:</label>
                                <input type="text" id="dataFim" name="dataFim" class="form-control" value="{{ $agendamento->dataFim ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="horaInicio" class="form-label">Horário de Início:</label>
                                <input type="time" id="horaInicio" name="horaInicio" class="form-control" value="{{ $agendamento->horaInicio ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="horaFim" class="form-label">Horário de Fim:</label>
                                <input type="time" id="horaFim" name="horaFim" class="form-control" value="{{ $agendamento->horaFim ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="observacao" class="form-label">Observação:</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="4" placeholder="Observação sobre o pedido...">{{ $agendamento->observacao ?? '' }}</textarea>
                            </div>
                            
                            <button type="button" class="btn btn-custom w-100" data-bs-toggle="modal" data-bs-target="#confirmationModal">Agendar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmação de Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja agendar este pedido com os dados informados?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-confirm" id="confirmButton">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('confirmButton').addEventListener('click', function () {
            document.getElementById('agendamentoForm').submit();
        });

        // Inicializa o Flatpickr
        flatpickr("#dataInicio", {
            locale: "pt",
            dateFormat: "Y-m-d",
        });
        flatpickr("#dataFim", {
            locale: "pt",
            dateFormat: "Y-m-d",
        });
    </script>
</body>
</html>
