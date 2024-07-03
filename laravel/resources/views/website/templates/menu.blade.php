
<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">buffetdivinosabor@gmail.com</a></i>
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

  
  <header id="header" class="d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">
    <a href="home.php"><img src="assets/img/logo.png" alt="" style="max-width: 50%;"><span></span></a>
    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
        <li><a class="nav-link scrollto" href="#cardapio">Cardápio</a></li>
        <li><a class="nav-link scrollto" href="#about">Sobre nós</a></li>
        <li><a class="nav-link scrollto" href="#portfolio">Galeria de fotos</a></li>
        <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
        <li><a class="nav-link scrollto" href="#contact">Fale Conoco</a></li>
        <li>
          <a href="cadastro.php"><button id="register-btn" class="nav-link btn"><i class="bi bi-person-plus"></i> Cadastrar-se</button></a>
        </li>
        <li>
          <a href="login.php"><button id="login-btn" class="nav-link btn">Fazer Login</button></a>
        </li>
        <li id="notification-btn" style="display: none;">
          <a href="#" data-bs-toggle="modal" data-bs-target="#notificationsModal">
            <button class="nav-link btn"><i class="bi bi-bell"></i> Notificações</button>
          </a>
        </li>
        
        <li id="profile-btn" style="display: none;">
             <div style="height: 14px;"></div>
          <form action="perfil.php" method="get">
            <input type="hidden" name="idClientes" value="" >
          <a href="perfil.php"><button type='submit' class="nav-link btn"><i class="bi bi-person"></i> Perfil</button></a>
          </form>
        </li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
  </div>
</header>