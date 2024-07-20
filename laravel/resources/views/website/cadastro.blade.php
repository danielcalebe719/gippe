<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="{{ asset('assets/css/style__cadastro.css') }}" rel="stylesheet">
    
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

<script src="{{ asset('assets/js/mainn.js') }}"></script>
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
            background-color: #fff5e6; /* Cor de fundo do corpo */
        }

        .bg-blur {
            position: fixed; /* Posição fixa para cobrir toda a tela */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f2e9e1;
            background-size: cover;
            z-index: -1; /* Coloca a imagem de fundo atrás de todo o conteúdo */
        }

        .text-bg-primary {
            background-color: #FAA562; /* Cor de fundo do lado esquerdo */
            color: #fff;
            padding: 20px;
        }

        .btn-primary,
        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #FA856E; /* Cor de fundo do botão de login */
            border-color: #FA856E; /* Cor da borda do botão de login */
        }

        .btn-outline-primary,
        .btn-outline-primary:hover,
        .btn-outline-primary:focus {
            color: #FA856E; /* Cor do texto do botão de redes sociais */
            border-color: #FA856E; /* Cor da borda do botão de redes sociais */
        }

        .form-label {
            color: #FA856E; /* Cor do texto das labels do formulário */
        }

        .form-control {
            border-color: #FA856E; /* Cor da borda dos campos de formulário */
        }

        .text-secondary {
            color: #FAA562; /* Cor do texto secundário (ex: 'Keep me logged in') */
        }
    </style>
</head>

<body>
@include('partials.navbar')
  
    <div class="bg-blur"></div>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="card border-light-subtle shadow-sm" style="border: 5px solid #FA856E; border-radius: 5px;">
                <div class="row g-0">
                    <!-- Div movida para a direita -->
                    <div class="col-12 col-md-6 order-md-last d-flex align-items-center justify-content-center"
                        style="background-color: #FA856E; color: #fff; margin: -5px;">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="col-10 col-xl-8 py-3">
                                <a href="{{ route('website.index') }}">
                                    <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid rounded mb-4"
                                        loading="lazy" width="245" height="80" alt="Buffet de Festas Logo"
                                        style="margin-left: 17%;">
                                </a>
                                <hr class="border-primary-subtle mb-4">
                                <h2 class="h1 mb-4">Cadastre-se para descobrir os nossos serviços!</h2>
                                <p class="lead m-0">Oferecemos uma experiência gastronômica única, com pratos
                                    exclusivos e decoração impecável para seu evento.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Div movida para a esquerda -->
                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12"><br><br>
                                    <div class="mb-5">
                                        <h3 style="color: #FA856E;">Cadastro</h3>
                                        <!-- Cor do título 'Cadastro' -->
                                        <p>Preencha o formulário abaixo para criar sua conta.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="erro">
                                <!-- Conteúdo do #erro -->
                            </div>
                            <form id="cadastroForm" method="POST" action="{{ url('/website/cadastro') }}">
                                @csrf
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="name@example.com" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Senha <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Insira uma senha forte" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="password_confirmation" class="form-label">Confirme sua senha <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="Confirme sua senha" required>
                                    </div>
                                    <div class="col-12">
                                        <br><br>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn bsb-btn-xl btn-primary" type="submit">Cadastre-se
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-5 mb-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                        <a href="{{ url('website/login') }}" class="link-secondary text-decoration-none"
                                            style="color: #FA856E;">Já tenho uma conta</a>
                                        <!--  <a href="#!" class="link-secondary text-decoration-none" style="color: #FA856E;">Forgot password</a> Cor do link 'Forgot password' alterada -->
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
                url: "{{ url('/website/cadastro') }}",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        // Redirecionamento para a página de login após cadastro bem-sucedido
                        window.location.href = "{{ url('website/login') }}";
                    } else {
                        $('.alert-danger').remove();
                        $('#erro').empty().append('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function (xhr, status, error) {
                    var errorMessage = xhr.responseJSON.message; // Captura a mensagem de erro do JSON
                    $('.alert-danger').remove();
                    $('#erro').empty().append('<div class="alert alert-danger">' + errorMessage + '</div>');
                }
            });
        });
    });


    </script>


</body>

</html>
