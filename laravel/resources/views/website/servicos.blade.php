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
@include('partials.navbar')



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
            <h3>{{ $servico->nome }}</h3>
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
            <p>Quantidade de Convidados: <input type="number" name="quantidadePessoas" min="0" max="999" class="inpt" id="quantidadePessoas"></p>
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