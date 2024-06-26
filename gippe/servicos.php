<?php
require("conecta.php");

// Consulta para recuperar os tipos de serviços fixos da tabela 'servicos'
$queryServicosFixos = "SELECT s.idServicos, s.nomeServico, s.total_servicos, s.quantidadePessoas, s.duracaoHoras,
                              SUM(sp.quantidade) AS total_barmans,
                              SUM(sp.quantidade) AS total_garcons,
                              SUM(sp.quantidade) AS total_cozinheiros
                       FROM servicos s
                       LEFT JOIN servicospedidos sp ON s.idServicos = sp.idServicos
                       WHERE s.nomeServico != 'Personalizado'
                       GROUP BY s.idServicos";

$resultadoServicosFixos = mysqli_query($conexao, $queryServicosFixos);

// Verifica se a consulta retornou resultados
if ($resultadoServicosFixos && mysqli_num_rows($resultadoServicosFixos) > 0) {
    // Array associativo para armazenar os resultados da consulta
    $servicos_fixos = mysqli_fetch_all($resultadoServicosFixos, MYSQLI_ASSOC);
} else {
    // Se não houver serviços encontrados, exibir uma mensagem de erro
    $erro = "Nenhum serviço fixo encontrado.";
}

// Fechando a conexão com o banco de dados
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Buffet Divino Sabor - Serviços</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <script src="jsservices.js"></script>
    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
     <script src="jsservices.js"></script>
    <link href="assets/css/style.css" rel="stylesheet">
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

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.html"><img src="assets/img/logo.png" alt=""><span></span></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#cardapio">Cardápio</a></li>
                    <li><a class="nav-link scrollto" href="#about">Sobre nós</a></li>
                    <li><a class="nav-link scrollto " href="#portfolio">Galeria de fotos</a></li>
                    <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Fale Conoco</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2 style="color:#FA856E;">Serviços</h2>
            <h3>Escolha um de nossos <span style="color: #FF944E;">Serviços</span></h3>
            <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <div class="row">
            <?php
            // Verifica se há serviços fixos para exibir
            if (isset($servicos_fixos) && !empty($servicos_fixos)) {
                foreach ($servicos_fixos as $servico) {
                    // Extrai os dados do serviço
                    
                    $idServico = $servico['idServicos'];
                    $nomeServico = $servico['nomeServico'];
                    $totalServicos = $servico['total_servicos'];
                    $quantidadePessoas = $servico['quantidadePessoas'];
                    $total_barmans = $servico['total_barmans'];
                    $total_garcons = $servico['total_garcons'];
                    $total_cozinheiros = $servico['total_cozinheiros'];
                    $duracaoHoras = $servico['duracaoHoras'];
                    if ($duracaoHoras == 0 || $duracaoHoras === NULL) {
                        $duracaoHoras = 0;
                    }
                    // Exibe os dados do serviço
                    echo '<div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">';
                    echo '<div class="box">';
                    echo "<h3>$nomeServico</h3>";
                    echo "<h4><sup>R$</sup>$totalServicos</h4>";
                    echo '<ul>';
                    echo "<li>Barmans: $total_barmans</li>";
                    echo "<li>Garçons: $total_garcons</li>";
                    echo "<li>Cozinheiros: $total_cozinheiros</li>"; 
                    echo "<li>Para festas de até $quantidadePessoas pessoas</li>";
                    echo "<li>Duração de $duracaoHoras horas</li>";
                    echo '</ul>';
                    echo '<div class="btn-wrap">';
                    echo '<a href="pedidos.php?idServico=' . $idServico . '" class="btn-buy">Selecionar Serviço</a>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Se não houver serviços fixos encontrados, exibe uma mensagem de erro
                echo '<div class="col-lg-12">';
                echo '<p>Nenhum serviço fixo encontrado.</p>';
                echo '</div>';
            }
            ?>
        </div>
        <br>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 mt-4 mt-md-0 justify-content-center" data-aos="fade-up" data-aos-delay="200" id="firstBox">
                    <div class="box featured">
                        <h3>Personalizado</h3>
                        <h4><sup>R$</sup>?</h4>
                        <div>Aqui você escolhe o serviço de acordo com sua festa</div>
                        <div class="btn-wrap">
                            <button id="custombutton" style="border: none; background-color: transparent;">
                                <a class="btn-buy">Personalize</a>
                            </button>
                        </div>
                    </div>
                </div>

                <div class=" col-md-8 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200" id="secondBox" style="display:none;">
    <div class="box featured">
        <h4>Personalize os Serviços:</h4>
        <form method="post" action="servicosProcessar.php">
            <p>Barmans: <input type="number" name="barmans" min="0" max="999" class="inpt" id="barmans"></p>
            <p>Garçons: <input type="number" name="garcons" min="0" max="999" class="inpt" id="garcons"></p>
            <p>Cozinheiros: <input type="number" name="cozinheiros" min="0" max="999" class="inpt" id="cozinheiros"></p>
            <p>Quantidade de Pessoas: <input type="number" name="quantidadePessoas" min="0" max="999" class="inpt" id="quantidadePessoas"></p>
            <p>Duração da Festa (Horas): <input type="number" name="duracaoHoras" min="1" max="24" class="inpt" id="duracaoHoras"></p>
            <p id="preco">Preço: R$0,00</p>
            <div class="btn-wrap">
                <button type="submit" class="btn-buy">Selecionar Serviço</button>
            </div>
        </form>
    </div>
</div>

            </div>
        </div>
    </div>
</section>


<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
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
<script>
    $(document).ready(function () {
        $("#custombutton").click(function () {
            $("#firstBox").toggleClass(" justify-content-start  justify-content-center");
            $("#secondBox").toggle(500), 200;
        });
    });
</script>
</body>
</html>
