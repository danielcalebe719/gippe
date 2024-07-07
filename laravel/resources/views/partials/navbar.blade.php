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
            <a href="#" data-bs-toggle="modal" data-bs-target="#notificationsModal">
              <button class="nav-link btn"><i class="bi bi-bell"></i> Notificações</button>
            </a>
          </li>
          <li id="profile-btn">
            <a href="{{ url('website/perfil') }}"><button class="nav-link btn"><i class="bi bi-person"></i> Perfil</button></a>
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
          @if ($notificacoes->isNotEmpty())
          @foreach ($notificacoes as $notificacao)
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">{{ $notificacao->mensagem }}
                <!-- @foreach ($notificacoes_clientes as $notificacao_cliente)
                        @if ($notificacao_cliente->idPedidos)
                            <a href="">{{ $notificacao_cliente->idPedidos }}</a>
                        @endif
                    @endforeach-->
              </h5>
              <p class="card-text">{{ $notificacao->dataEnvio }}</p>
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