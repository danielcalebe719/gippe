<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Buffet Divino Sabor - Serviços</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <script src="{{ asset('assets/js/js_adm/jsservices.js') }}"></script>
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
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
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
                <a href="{{ url('/website') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="" style="max-width: 50%;"><span></span></a>
                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto" href="{{ url('/website') }}">Home</a></li>
                        <li><a class="nav-link scrollto" href="{{ url('/website') }}#cardapio">Cardápio</a></li>
                        <li><a class="nav-link scrollto" href="{{ url('/website') }}#about">Sobre nós</a></li>
                        <li><a class="nav-link scrollto" href="{{ url('/website') }}#portfolio">Galeria de fotos</a></li>
                        <li><a class="nav-link scrollto" href="{{ url('/website') }}#faq">FAQ</a></li>
                        <li><a class="nav-link scrollto" href="{{ url('/website') }}#contact">Fale Conosco</a></li>

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


            <!-- ======= Pricing Section ======= -->
            <section id="pricing" class="pricing">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2 style="color:#FA856E;">Serviços</h2>
                        <h3>Escolha um de nossos <span style="color: #FF944E;">Serviços</span></h3>
                        <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
                    </div>

                    <div class="row">


                        <!-- Loop para exibir apenas os 4 primeiros serviços -->

                        @if(isset($pedidos))
                        <div class="alert alert-info">
                            Você está editando um pedido existente. Escolha suas alterações abaixo.
                        </div>
                    @endif




                    @foreach ($servicos as $servico)
    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="box">
            <h3>{{ $servico->nomeServico }}</h3>
            <h4><sup>R$</sup>{{ $servico->totalServicos }}</h4>
            <ul>
                @foreach ($servico->pedidos_servicos as $pedido)
                    @if ($pedido->funcionarioTipo == 'Barman')
                        <li>Barmans: {{ $pedido->quantidade }}</li>
                    @elseif ($pedido->funcionarioTipo == 'Garcom')
                        <li>Garçons: {{ $pedido->quantidade }}</li>
                    @elseif ($pedido->funcionarioTipo == 'Cozinheiro')
                        <li>Cozinheiros: {{ $pedido->quantidade }}</li>
                    @endif
                @endforeach
                <li>Para festas de até {{ $servico->quantidadePessoas }} pessoas</li>
                <li>Duração de {{ $servico->duracaoHoras }} horas</li>
            </ul>
            
            <div class="btn-wrap">
                <form action="{{ route('processar.servico.padrao') }}" method="post" class="servico-form">
                    @csrf
                    <input type="hidden" name="idPedidos" value="{{ $pedidos->id ?? '' }}">
                    <input type="hidden" name="idClientes" value="{{ Auth::guard('cliente')->user()->id }}">
                    <input type="hidden" name="idServicos" value="{{ $servico->id }}">
                    <input type="hidden" class="idEnderecos" name="idEnderecos" value="">
                    <button type="submit" class="btn-buy" style="border: none;">Selecionar Serviço</button>
                </form>
            </div>
        </div>
    </div>
@endforeach

                    </div>
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

                        <div class="col-md-8 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200" id="secondBox" style="display:none;">
                            <div class="box featured">
                                <h4>Personalize os Serviços:</h4>
                                <form method="post" action="{{ route('processar.servico.personalizado') }}">
            @csrf
            <input type="hidden" name="idServicos" value="{{ $servico->id ?? '' }}">
            <input type="hidden" name="id" value="{{ $pedidos->id ?? '' }}">
            <input type="hidden" name="idClientes" value="{{ Auth::guard('cliente')->user()->id }}">
            <input type="hidden" class="idEnderecos" name="idEnderecos" value="">

            <p>Barmans: <input type="number" name="tipo[Barmam]" min="0" max="999" class="inpt" id="barmans"></p>
            <p>Garçons: <input type="number" name="tipo[Garcom]" min="0" max="999" class="inpt" id="garcons"></p>
            <p>Cozinheiros: <input type="number" name="tipo[Cozinheiro]" min="0" max="999" class="inpt" id="cozinheiros"></p>
            <p>Quantidade de Pessoas: <input type="number" name="quantidadePessoas" min="0" max="999" class="inpt" id="quantidadePessoas"></p>
            <p>Duração da Festa (Horas): <input type="number" name="duracaoHoras" min="1" max="24" class="inpt" id="duracaoHoras"></p>
            <!--<p id="preco">Preço: R$0,00</p>-->
            <div class="btn-wrap">
                <button type="submit" class="btn-buy" style="border: none;">Selecionar Serviço</button>
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
        <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
        <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('assets/js/mainn.js') }}"></script>

        <script>

$(document).ready(function () {
    // Recupera o endereco_cliente do localStorage
    var enderecoCliente = localStorage.getItem('endereco_cliente');

    if (enderecoCliente) {
        enderecoCliente = JSON.parse(enderecoCliente);
        console.log('Endereço do cliente:', enderecoCliente);

        // Adiciona um evento de clique para cada botão de envio
        $('.btn-buy').on('click', function (e) {
            // Preenche o campo oculto idEnderecos com o id do enderecoCliente
            var form = $(this).closest('.servico-form');
            form.find('.idEnderecos').val(enderecoCliente.id);
        });
    }
});





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
            $(document).ready(function() {
                $("#custombutton").click(function() {
                    $("#firstBox").toggleClass(" justify-content-start  justify-content-center");
                    $("#secondBox").toggle(500), 200;
                });
            });
        </script>
    </body>

</html>