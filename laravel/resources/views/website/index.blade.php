<!-- 27/06/2024-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Buffet Divino Sabor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Template Main CSS File -->

<link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">



<!-- ======= Top Bar ======= -->

</head>

<body>

 @include('partials.navbar')





  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Resto do código HTML da sua página index -->







  <!--@if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
  @if(Auth::guard('cliente')->check())
    <p>Bem-vindo, {{ Auth::guard('cliente')->user()->email }}!</p>
  <a href="{{url('website/logout')}}">Logout</a>
@else
    <p>Bem-vindo, visitante!</p>
@endif->



  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1 style="color: white;">Bem vindo ao <span style="color: #FF944E;"">Buffet Divino Sabor</span></h1>
      <h2 style="color: white;"">Produzindo eventos com o melhor cardápio desde 2014.</h2>
      <div class="d-flex">
        <a href="{{url('website/cadastro2')}}" class="btn-get-started scrollto">Faça seu pedido</a>
        
        <a href="https://youtu.be/y6120QOlsfU?si=0Z_6ErtD0vy7wDzB" class="glightbox btn-watch-video"><i class="bi bi-play-circle" style="color: #FA856E;"></i><span style=" color: white; ">Clique e veja um pouco mais sobre nós</span></a>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">
        <h1><span style="color: #FA856E;"">Venha festejar conosco</span></h1>
        <div class=" row">
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"><img src="assets/img/formatura.png" alt="" srcset="" style="max-width: 100px;"></div>
                <h4 class="title"><a href="">Formaturas</a></h4>
                <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                <div class="icon"><img src="assets/img/rings.png" alt="" srcset="" style="max-width: 100px;"></div>
                <h4 class="title"><a href="">Casamentos</a></h4>
                <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                <div class="icon"><img src="assets/img/15years.png" alt="" srcset="" style="max-width: 100px;"></div>
                <h4 class="title"><a href="">15 Anos</a></h4>
                <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                <div class="icon"><img src="assets/img/kids.png" alt="" srcset="" style="max-width: 100px;"></div>
                <h4 class="title"><a href="">Infantil</a></h4>
                <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
              </div>
            </div>


      </div>

      </div>
    </section><!-- End Featured Services Section -->

    <section id="cardapio" class=" about section-bg " ">
      <div class=" section-title">
      <h2 style="color: #FA856E;">Cardápio</h2>
      <h3>Veja mais sobre os destaques do nosso<span style="color: #FF944E;"> cardápio</span></h3>
      <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
      </div>
      <img src="assets/img/CardapioBuffet.png" alt="" style="max-width: 90%;" class="rounded mx-auto d-block img-fluid">
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
                <i class=" bi bi-award" style="color: #FA856E;""></i>
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

    <!-- ======= Testimonials Section ======= -->
    </div>
    <section id=" testimonials" class="testimonials testimonials-short">
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
                        </div><!-- End testimonial item -->c

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

    <div id="portfolio-container" class="row portfolio-container justify-content-center" data-aos="fade-up" data-aos-delay="200">
      @foreach($imagens->take(15) as $imagem)
      <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item filter-{{ strtolower($imagem->evento) }}">
        <div class="portfolio-item-overlay">
          <a href="{{ asset('storage/GaleriaImagens/' . $imagem->caminhoImagem) }}" data-lightbox="portfolio" title="{{ $imagem->evento }}">
            <img class="img-fluid gallery-image" src="{{ asset('storage/GaleriaImagens/' . $imagem->caminhoImagem) }}">
          </a>
          <div class="portfolio-info-details">
            <h4>{{ $imagem->evento }}</h4>
            <p>{{ $imagem->descricao }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

    <!-- Lightbox JS -->
    <script src="{{ asset('js/lightbox.js') }}"></script>








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
          <div class="col-lg-6 ">
            <div class="info-box mb-4 p-3">
              <i class="bx bx-map"></i>
              <h3 class="mt-3">Nosso endereço</h3>
              <p class="mb-0">Avenida A, Bairro B, Belo Horizonte</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box mb-4 p-3">
              <i class="bx bx-envelope"></i>
              <h3 class="mt-3">Nosso email</h3>
              <p class="mb-0">buffetdivinosabor@gmail.com</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box mb-4 p-4"> <!-- Ajustado para p-4 para mais padding -->
              <i class="bx bx-phone-call"></i>
              <h3 class="mt-3">Nosso Telefone</h3>
              <p class="mb-0">+31 95589 55488</p>
            </div>
          </div>
        </div>


        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-6 ">
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d234.446014688871!2d-43.938484827584325!3d-19.91866308281466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa699b7a4117c47%3A0x67f927e239293eb2!2sP7%20Criativo%20-%20Ag%C3%AAncia%20de%20Desenvolvimento%20da%20Ind%C3%BAstria%20Criativa%20de%20Minas%20Gerais!5e0!3m2!1spt-BR!2sbr!4v1711927363091!5m2!1spt-BR!2sbr" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6">
            <form action="{{ route('website.mensagem') }}" method="post" class="php-email-form">
              @csrf
              <div class="row">
                <div class="col form-group">
                  <input type="text" name="nome" class="form-control" id="name" placeholder="Seu nome" required>
                </div>
                <div class="col form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Seu Email" required>
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
                <div id="mensagem-sucesso" style="display: none; color: green;">Mensagem enviada com sucesso!</div>
              </div>
              <div class="error-message"></div>
              <div class="text-center"><button type="submit">Enviar Mensagem</button></div>
            </form>
          </div>

          <script>
            // Script para mostrar a mensagem de sucesso após o envio do formulário
            document.addEventListener('DOMContentLoaded', function() {
              const form = document.querySelector('.php-email-form');

              form.addEventListener('submit', function(event) {
                event.preventDefault();


                const loading = document.querySelector('.loading');
                loading.style.display = 'block';



                setTimeout(function() {
                  loading.style.display = 'none';
                  const mensagemSucesso = document.getElementById('mensagem-sucesso');
                  mensagemSucesso.style.display = 'block';
                }, 2000); // Exibe a mensagem após 2 segundos (tempo fictício)


              });
            });
          </script>



          <script>
            $(document).ready(function() {
              // Esconde a mensagem após 5 segundos
              setTimeout(function() {
                $('.alert').alert('close');
              }, 5000);
            });
          </script>

        </div>


    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    (31)9 1234-5678 | buffetdivinosabor@gmail.com
    <a class="text-body" href=""></a>
  </div>










  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



  <script src="{{asset('assets/js/mainn.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>


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
</body>

</html>