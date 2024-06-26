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
            <input type="hidden" name="idClientes" value="<?php echo $_SESSION['idClientes']?>" >
          <a href="perfil.php"><button type='submit' class="nav-link btn"><i class="bi bi-person"></i> Perfil</button></a>
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

  

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1 style="color: white;">Bem vindo ao <span style="color: #FF944E;"">Buffet Divino Sabor</span></h1>
      <h2 style="color: white;"">Produzindo eventos com o melhor cardápio desde 2014.</h2>
      <div class="d-flex">
        <a href="cadastro2.php" class="btn-get-started scrollto">Faça seu pedido</a>
        
        <a href="https://youtu.be/y6120QOlsfU?si=0Z_6ErtD0vy7wDzB" class="glightbox btn-watch-video"><i class="bi bi-play-circle" style="color: #FA856E;"></i><span style=" color: white; ">Clique e veja um pouco mais sobre nós</span></a>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">
        <h1><span style="color: #FA856E;"">Venha festejar conosco</span></h1>
        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon" ><img src="assets/img/formatura.png" alt="" srcset="" style="max-width: 100px;"></div>
              <h4 class="title"><a href="">Formaturas</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon" ><img src="assets/img/rings.png" alt="" srcset="" style="max-width: 100px;"></div>
              <h4 class="title"><a href="">Casamentos</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon" ><img src="assets/img/15years.png" alt="" srcset="" style="max-width: 100px;"></div>
              <h4 class="title"><a href="">15 Anos</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon" ><img src="assets/img/kids.png" alt="" srcset="" style="max-width: 100px;"></div>
              <h4 class="title"><a href="">Infantil</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>
          

        </div>

      </div>
    </section><!-- End Featured Services Section -->

    <section  id="cardapio" class=" about section-bg "  ">
      <div class="section-title">
        <h2 style="color: #FA856E;">Cardápio</h2>
        <h3>Veja mais sobre os destaques do nosso<span style="color: #FF944E;"> cardápio</span></h3>
        <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
      </div>
      <img src="assets/img/Cardapio.png" alt="" style="max-width: 90%;" class="rounded mx-auto d-block img-fluid"> 
    </section>



    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 style="color: #FA856E;">Sobre nós</h2>
          <h3>Saiba mais sobre o<span style="color: #FF944E;"> Buffet Divino Sabor</span></h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="assets/img/equipebuffet.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li>
                <i class="bi bi-people-fill" style="color: #FA856E;"></i>
                <div>
                  <h5>Nossa equipe</h5>
                  <p>Magni facilis facilis repellendus cum excepturi quaerat praesentium libre trade</p>
                </div>
              </li>
              <li>
                <i class="bi bi-layers" style="color: #FA856E;""></i>
                <div>
                  <h5>Nossa infraestrutura</h5>
                  <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna pasata redi</p>
                </div>
              </li>
              <li>
                <i class="bi bi-award" style="color: #FA856E;""></i>
                <div>
                  <h5>Inovação</h5>
                  <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna pasata redi</p>
                </div>
              </li>
            </ul>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->



   

    <!-- ======= Services Section ======= -->
    <!-- <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <h3>Check our <span>Services</span></h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Sed ut perspiciatis</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Magni Dolores</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4><a href="">Nemo Enim</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-slideshow"></i></div>
              <h4><a href="">Dele cardo</a></h4>
              <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-arch"></i></div>
              <h4><a href="">Divera don</a></h4>
              <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->



    <!-- ======= Testimonials Section ======= -->
    </div>
    <section id="testimonials" class="testimonials testimonials-short">
  <div class="section-title"></div>
  <div class="container" data-aos="zoom-in">

    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img img-fluid" alt="">
            <h3>Pessoa 1</h3>
            <h4>Casamento</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img img-fluid" alt="">
            <h3>Pessoa 2</h3>
            <h4>15 anos</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img img-fluid" alt="">
            <h3>Pessoa 3</h3>
            <h4>Casamento</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img img-fluid" alt="">
            <h3>Pessoa 4</h3>
            <h4>Casamento</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img img-fluid" alt="">
            <h3>Pessoa 5</h4>
            <h4>Formatura</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>
</section><!-- End Testimonials Section -->



<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2 style="color: #FA856E;">Galeria de Fotos</h2>
            <h3>Dê uma olhada na nossa <span style="color: #FA856E;">Galeria de Fotos</span></h3>
            <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">Todas</li>
                    <li data-filter=".filter-casamento">Casamentos</li>
                    <li data-filter=".filter-15anos">15 Anos</li>
                    <li data-filter=".filter-formatura">Formaturas</li>
                    <li data-filter=".filter-infantil">Infantil</li>
                    <li data-filter=".filter-outros">Outros</li>
                </ul>
            </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            <?php
            require("conecta.php");

            $querySelecao = "SELECT id, evento, descricao, nome_imagem, tamanho_imagem, imagemCaminho FROM galeriaImagens";
            $resultado = mysqli_query($conexao, $querySelecao);

            $imageIndex = 0;
            while ($aquivos = mysqli_fetch_array($resultado)) {
                $categorias = explode(',', $aquivos['descricao']);
                $classes = array_map(function($cat) {
                    return 'filter-' . strtolower(trim($cat));
                }, $categorias);

                $hiddenClass = ($imageIndex >= 15) ? 'hidden' : '';

                echo "<div class='col-lg-3 portfolio-item $hiddenClass " . implode(' ', $classes) . "' data-index='{$imageIndex}'>";
                echo "<div class='resolve portfolio-item-overlay'>";
                echo "<a href='data:image/jpeg;base64," . base64_encode($aquivos['imagemCaminho']) . "' data-lightbox='portfolio' title='" . $aquivos['evento'] . "'>";
                echo "<img class='img-fluid gallery-image' src='GaleriaImagens/" . $aquivos['imagemCaminho'] . "' />";
                echo "</a>";
                echo "<div class='portfolio-info'>";
                echo "<h4>" . $aquivos['evento'] . "</h4>";
                echo "<p>" . $aquivos['descricao'] . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                $imageIndex++;
            }
            ?>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <button id="load-more-btn" class="btn btn-success">Mostrar mais</button>
            </div>
        </div>
    </div>
</section>

<script src="path/to/aos.js"></script>
<script src="path/to/lightbox.js"></script>

   
    <!-- ======= Pricing Section ======= -->
    <!--
    <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Pricing</h2>
          <h3>Check our <span>Pricing</span></h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
              <h3>Free</h3>
              <h4><sup>$</sup>0<span> / month</span></h4>
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li class="na">Pharetra massa</li>
                <li class="na">Massa ultricies mi</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box featured">
              <h3>Business</h3>
              <h4><sup>$</sup>19<span> / month</span></h4>
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li>Pharetra massa</li>
                <li class="na">Massa ultricies mi</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <h3>Developer</h3>
              <h4><sup>$</sup>29<span> / month</span></h4>
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li>Pharetra massa</li>
                <li>Massa ultricies mi</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <span class="advanced">Advanced</span>
              <h3>Ultimate</h3>
              <h4><sup>$</sup>49<span> / month</span></h4>
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li>Pharetra massa</li>
                <li>Massa ultricies mi</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
   

    <!-- ======= FAQ Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 style="color: #FA856E;">F.A.Q</h2>
          <h3><span style="color: #FF944E;">Perguntas</span> Frequentes </h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <div class="row justify-content-center">
          <div class="col-xl-10">
            <ul class="faq-list">

              <li>
                <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Vocês prestam serviços fora de Minas Gerais?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Como faço meu pedido sem ser pelo site?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                  </p>
                </div>
              </li>

            </ul>
          </div>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 style="color: #FA856E;">Fale conosco</h2>
          <h3><span style="color: #FF944E;">Fale conosco</span></h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Nosso endereço</h3>
              <p>Avenida A, Bairro B, Belo Horizonte</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Nosso email</h3>
              <p>buffetdivinosabor@gmail.com
              </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Nosso Telefone</h3>
              <p>+31 95589 55488</p>
            </div>
          </div>

        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-6 ">
            <iframe class="mb-4 mb-lg-0"        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d234.446014688871!2d-43.938484827584325!3d-19.91866308281466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa699b7a4117c47%3A0x67f927e239293eb2!2sP7%20Criativo%20-%20Ag%C3%AAncia%20de%20Desenvolvimento%20da%20Ind%C3%BAstria%20Criativa%20de%20Minas%20Gerais!5e0!3m2!1spt-BR!2sbr!4v1711927363091!5m2!1spt-BR!2sbr"
            frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6">
            <form action="processa_mensagens.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col form-group">
                  <input type="text" name="nome" class="form-control" id="name" placeholder="Seu nome" required>
                </div>
                <div class="col form-group">
                  <input type="email" class="form-control" name="endereco" id="email" placeholder="Seu Email" required>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="assunto" id="subject" placeholder="Assunto" required>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="mensagem" rows="5" placeholder="Mensagem" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Carregando</div>
                <div class="sent-message">Sua mensagem foi enviada</div>
                
              </div>
              <div class="error-message"></div>
              <div class="text-center"><button type="submit"> Enviar Mensagem</button></div>
            </form>
          </div>

        </div>

      
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    (31)9 1234-5678  |  buffetdivinosabor@gmail.com
<a class="text-body" href=""></a>
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