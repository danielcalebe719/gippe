<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buffet de Festas - Login</title>
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-5/assets/css/login-5.css">
  <!-- Estilos personalizados para o Buffet de Festas -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">

  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff5e6;
      /* Cor de fundo do corpo */
      /* Impede que a imagem de fundo se estenda além dos limites do corpo */
    }

    .bg-blur {
      position: fixed;
      /* Posição fixa para cobrir toda a tela */
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #f2e9e1;
      background-size: cover;


      z-index: -1;
      /* Coloca a imagem de fundo atrás de todo o conteúdo */
    }

    .text-bg-primary {
      background-color: #FAA562;
      /* Cor de fundo do lado esquerdo */

      color: #fff;
      padding: 20px;

    }

    .btn-primary,
    .btn-primary:hover,
    .btn-primary:focus {
      background-color: #FA856E;
      /* Cor de fundo do botão de login */
      border-color: #FA856E;
      /* Cor da borda do botão de login */
    }

    .btn-outline-primary,
    .btn-outline-primary:hover,
    .btn-outline-primary:focus {
      color: #FA856E;
      /* Cor do texto do botão de redes sociais */
      border-color: #FA856E;
      /* Cor da borda do botão de redes sociais */
    }

    .form-label {
      color: #FA856E;
      /* Cor do texto das labels do formulário */
    }

    .form-control {
      border-color: #FA856E;
      /* Cor da borda dos campos de formulário */
    }

    .text-secondary {
      color: #FAA562;
      /* Cor do texto secundário (ex: 'Keep me logged in') */
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
          <div class="col-12 col-md-6 d-flex align-items-center justify-content-center" style="background-color: #FA856E; color: #fff; margin: -5px ;">
            <div class="d-flex align-items-center justify-content-center h-100">
              <div class="col-10 col-xl-8 py-3">
                <a href="{{route('website.index')}}"><img src="{{asset('assets/img/logo.png')}}" class="img-fluid rounded mb-4" loading="lazy" width="245" height="80" alt="Buffet de Festas Logo" style="margin-left: 17%; ;">
                </a>
                <hr class="border-primary-subtle mb-4">
                <h2 class="h1 mb-4">Descubra o sabor das melhores festas!</h2>
                <p class="lead m-0">Oferecemos uma experiência gastronômica única, com pratos exclusivos e decoração impecável para seu evento.</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <div class="row">
                <div class="col-12"><br><br>
                  <div class="mb-5">
                    <h3 style="color: #FA856E;">Login</h3> <!-- Cor do título 'Log in' alterada -->
                    <p>Bem-vindo de volta!<br> Faça o login para acessar sua conta.</p>
                  </div>
                </div>
              </div>
              <div id="erro">


              </div>

              <form id="loginForm">
                @csrf
                <div class="row gy-3 gy-md-4 overflow-hidden">
                  <div class="col-12">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Senha <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password" value="" required>
                  </div>
                  <div class="col-12">
                    <br><br>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button class="btn bsb-btn-xl btn-primary" type="submit">Entrar agora</button>
                    </div>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="col-12">
                  <hr class="mt-5 mb-4 border-secondary-subtle">
                  <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                    <a href="{{url('website/cadastro')}}" class="link-secondary text-decoration-none " style="color: #FA856E;">Criar nova conta</a> <!-- Cor do link 'Create new account' alterada -->
                    <!--  <a href="#!" class="link-secondary text-decoration-none" style="color: #FA856E;">Forgot password</a> Cor do link 'Forgot password' alterada -->
                  </div>
                </div>
              </div>
              <br><br><br>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

<script src="{{ asset('assets/js/mainn.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#loginForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
          type: 'POST',
          url: "{{ url('/website/login') }}",
          data: $(this).serialize(),
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          success: function(response) {
            if (response.success) {
              window.location.href = response.redirect;
            } else {
              $('.alert-danger').remove();
              $('#erro').prepend('<div class="alert alert-danger">' + response.message + '</div>');
            }
          },
          error: function(xhr, status, error) {
            var response = JSON.parse(xhr.responseText);
            $('.alert-danger').remove();
            $('#erro').prepend('<div class="alert alert-danger">' + response.message + '</div>');
          }
        });
      });
    });
  </script>
      <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

<script src="{{ asset('assets/js/mainn.js') }}"></script>
</body>

</html>