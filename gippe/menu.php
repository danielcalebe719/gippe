<?php

require("conecta.php");
require("conecta2.php");
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    // O usuário está logado, exibir conteúdo personalizado
    echo "Olá, " . $_SESSION['email'] . "! Você está logado. id = " . $_SESSION['idClientes'] . "";
    echo "<a href='logout.php'>SAIR </a>";
    $loggedIn = true;
} else {
    // O usuário não está logado, exibir conteúdo padrão
    echo "Bem-vindo à nossa página inicial!";
    $loggedIn = false;
}

require("conecta.php");
require("conecta2.php");
;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Buffet Divino Sabor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="path/to/lightbox.css" rel="stylesheet">
    <!-- Incluir CSS do AOS (se necessário) -->
    <link href="path/to/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
</head>
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  var loggedIn = <?php echo json_encode($loggedIn); ?>;

  window.addEventListener('DOMContentLoaded', (event) => {
    if (loggedIn) {
      loggedInner = true;
    } else {
      loggedInner = false;
    }

    // Função para alternar a exibição dos botões de perfil e notificações com base no status de login
    function toggleButtons() {
      if (loggedInner) {
        $("#register-btn, #login-btn").hide();
        $("#profile-btn, #notification-btn").show();
      } else {
        $("#register-btn, #login-btn").show();
        $("#profile-btn, #notification-btn").hide();
      }
    }

    // Chamar a função assim que a página for carregada
    $(document).ready(function() {
      toggleButtons();
    });
  });
</script>
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    
  </style>
</head>

<body>

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
        <li><a class="nav-link scrollto active" href="home.php">Home</a></li>
        <li><a class="nav-link scrollto" href="home.php"#cardapio">Cardápio</a></li>
        <li><a class="nav-link scrollto" href="home.php"#about">Sobre nós</a></li>
        <li><a class="nav-link scrollto" href="home.php"#portfolio">Galeria de fotos</a></li>
        <li><a class="nav-link scrollto" href="home.php"#faq">FAQ</a></li>
        <li><a class="nav-link scrollto" href="home.php"#contact">Fale Conoco</a></li>
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
            <input type="hidden" name="idClientes" value="<?php echo $_SESSION['idClientes']?>" >
          <a href="perfil.php?idClientes=<?php echo $idClientes?>"><button type='submit' class="nav-link btn"><i class="bi bi-person"></i> Perfil</button></a>
          </form>
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
      <?php
if (isset($_SESSION['email'])) {
    $email = mysqli_real_escape_string($conexao, $_SESSION['email']);

    $querySelecao = "SELECT n.mensagem, n.dataEnvio
                    FROM notificacoes n
                    INNER JOIN notificacoesClientes nc ON n.idNotificacoes = nc.idNotificacoes
                    WHERE nc.idClientes = (
                        SELECT idClientes FROM clientes WHERE email = '$email'
                    )";
    $resultado = mysqli_query($conexao, $querySelecao);

    if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['mensagem'] . '</h5>';
            echo '<p class="card-text">' . $row['dataEnvio'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Nenhuma notificação encontrada.</p>';
    }
} else {
    echo '<p>Usuário não logado.</p>';
}
?>

      </div>
    </div>
  </div>
</div>
<div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
   <script src=""></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>







    // Função para alternar a exibição dos botões de perfil e notificações com base no status de login
    function toggleButtons() {
      if (loggedInner) {
        $("#register-btn, #login-btn").hide();
        $("#profile-btn, #notification-btn").show();
      } else {
        $("#register-btn, #login-btn").show();
        $("#profile-btn, #notification-btn").hide();
      }
    }
  
    // Chamar a função assim que a página for carregada
    $(document).ready(function() {
      toggleButtons();
    });
  </script>
  
  
  <script src="assets/js/main.js"></script>
  <script>
    
    window.addEventListener('DOMContentLoaded', (event) => {
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        portfolioItems.forEach(item => {
            const image = item.querySelector('img');
            const info = item.querySelector('.portfolio-info');

            // Obtém a largura da imagem
            const imageWidth = image.offsetWidth;

            // Define a largura do .portfolio-info igual à largura da imagem
            info.style.width = imageWidth + 'px';
        });
    });




</script>
<script src="scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>


</body>

</html>