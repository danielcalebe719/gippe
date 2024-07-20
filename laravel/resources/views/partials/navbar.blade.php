<head>
    <!-- Google Fonts (opcional) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Inclua o CSS do CookieConsent -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.css">

    <!-- Inclua o CSS personalizado -->
    <style>
        .cc-window {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2) !important;
        }

        .cc-popup {
            background: #333 !important;
            color: #fff !important;
            padding: 20px !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .cc-button, .cc-btn {
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-size: 14px !important;
            cursor: pointer !important;
        }

        .cc-dismiss {
            background-color: #FF944E !important; /* Cor para o botão 'Entendi!' */
            color: #fff !important; /* Texto branco */
        }

        .cc-allow {
            background-color: #4CAF50 !important; /* Cor para o botão 'Aceitar cookies' */
            color: #fff !important; /* Texto branco */
        }

        .cc-link {
            color: #FF944E !important; /* Cor laranja */
        }

        .cc-link:hover {
            text-decoration: underline !important;
            color: #fff !important; /* Texto branco ao passar o mouse */
        }
    </style>
</head>
<body>
    <!-- CookieConsent JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.js"></script>

   <!-- Inicialize o CookieConsent -->
<script>
    window.addEventListener("load", function() {
        cookieconsent.initialise({
            palette: {
                popup: {
                    background: "#333"
                },
                button: {
                    background: "#FF944E", 
                    text: "#fff"
                }
            },
            theme: "classic",
            type: "opt-in",
            content: {
                message: "Este site usa cookies para garantir que você obtenha a melhor experiência. Escolha quais cookies deseja aceitar.",
                dismiss: "Entendi!",
                link: "Saiba mais",
                href: "/website/politica-de-cookies",
                allow: "Aceitar cookies"
            },
            categories: {
                necessary: {
                    text: "Cookies necessários para o funcionamento básico do site.",
                    consent: true
                },
                analytics: {
                    text: "Cookies usados para análise e melhoria do site.",
                    consent: false
                },
                marketing: {
                    text: "Cookies usados para marketing e publicidade.",
                    consent: false
                }
            },
            onStatusChange: function(status) {
                console.log(this.hasConsented() ? "Cookies consentidos" : "Cookies não consentidos");
            },
            onChange: function(status) {
                console.log('Status de consentimento alterado: ', status);
            }
        });
    }); 
</script>

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
    <a href="{{ url('/website') }}"><img src="{{asset('assets/img/logo.png')}}" alt="" style="max-width: 50%;"><span></span></a>
    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto active" href="{{ url('/website') }}">Home</a></li>
        <li><a class="nav-link scrollto" href="{{ url('/website') }}#cardapio">Cardápio</a></li>
        <li><a class="nav-link scrollto" href="{{ url('/website') }}#about">Sobre nós</a></li>
        <li><a class="nav-link scrollto" href="{{ url('/website') }}#portfolio">Galeria de fotos</a></li>
        <li><a class="nav-link scrollto" href="{{ url('/website') }}#faq">FAQ</a></li>
        <li><a class="nav-link scrollto" href="{{ url('/website') }}#contact">Fale Conosco</a></li>

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
            <div class="modal-header"
                <h5 class="modal-title" id="notificationsModalLabel">Notificações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (isset($notificacoesAgrupadas) && $notificacoesAgrupadas->isNotEmpty())
                    @foreach ($notificacoesAgrupadas as $idPedido => $notificacoesGrupo)
                        @foreach ($notificacoesGrupo as $notificacao)
                        @php
                                        $pedido = $pedidos->where('id', $idPedido)->first();
                                   
                                    @endphp
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $notificacao->titulo }} 
                                    
                                      <a href="{{ url('website/pedidos/pedidosDetalhes/' . $pedido->codigo ) }}">
                                        <strong style="color:#FF944E;">#{{$pedido->codigo}}</strong>
                                      </a>
                                  
                                    </h5>
                                    <p class="card-text">{{ $notificacao->mensagem }}</p>
                                    <p class="card-text">{{ $notificacao->dataEnvio }}</p>
                                    
                                  
                        
                                    @if ($pedido)
                                    @if ($pedido->status == 6)
                                    @if ($notificacao->titulo == 'Entregue')
                                    <a href="{{ url('/website/feedback/' . $pedido->codigo) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-star-fill"></i> Avaliar o pedido
                                    </a>
                                    @endif  
                                @endif  
                                    @else
                                        <p class="text-danger">Pedido não encontrado (ID: {{ $idPedido }}).</p>
                                    @endif
                        
                                    @if ($notificacao->lido == false)
                                        <form class="form-marcar-lida" data-notificacao-id="{{ $notificacao->id }}" action="{{ route('notificacoes.marcarLida', $notificacao->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm mt-2 btn-marcar-lida">
                                                <i class="bi bi-check"></i> Marcar como lida
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-secondary btn-sm mt-2 disabled">
                                            <i class="bi bi-check"></i> Lida
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @else
                    <p>Nenhuma notificação encontrada.</p>
                @endif
            </div>
        </div>
    </div>
</div>



  <script>
    $(document).ready(function() {
      $('.btn-marcar-lida').click(function() {
        var form = $(this).closest('form');
        var formData = form.serialize();

        $.ajax({
          url: form.attr('action'),
          type: 'POST',
          data: formData,
          success: function(response) {
            console.log(response); // Verifica a resposta do servidor
            // Atualizar a interface conforme necessário
            console.log('Notificação marcada como lida com sucesso.');
            form.find('.btn-marcar-lida').attr('disabled', true).addClass('disabled'); // Desativa o botão depois de marcado como lida
            form.find('.btn-marcar-lida').removeClass('btn-primary').addClass('btn-secondary disabled').html('<i class="bi bi-check"></i> Lida'); // Altera o botão para refletir que a notificação está lida
          },
          error: function(xhr) {
            console.error('Erro ao marcar a notificação como lida.');
            console.log(xhr.responseText); // Exibe o erro no console para depuração
          }
        });

        return false; // Evita o comportamento padrão de envio do formulário
      });
    });
  </script>