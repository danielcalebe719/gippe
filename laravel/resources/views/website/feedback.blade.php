<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Feedback do Pedido - Buffet Divino Sabor</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-5/assets/css/login-5.css">
  <!-- Estilos personalizados para o Buffet de Festas -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

<script src="{{ asset('assets/js/mainn.js') }}"></script>
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
        <style>
            body {
                background-color: #f8f9fa;
                height: 100vh;
                
                align-items: center;
                justify-content: center;
            }
    
            .stars {
                font-size: 2rem;
                color: #ccc;
                cursor: pointer;
            }
    
            .stars span:hover,
            .stars span:hover~span {
                color: #ffc107;
            }
        </style>
    </head>
    
    <body>
    @include('partials.navbar')
    <br>
        <div class="container">
            
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-4">Feedback do Pedido 
                              
                                <strong><a style="color: #FA856E;" href="{{ url('website/pedidos/pedidosDetalhes/' . $pedido->codigo) }}">#{{ $pedido->codigo }}</a></strong>


                            </h2>
                            <form action="{{ route('feedback.salvar') }}" method="POST">
                                @csrf

                                <input type="hidden" name="idPedidos" id="idPedidos" value="{{$pedido->id}}">
                                <input type="hidden" name="idClientes" id="idClientes" value="{{$pedido->idClientes}}">
                                <div class="mb-3 text-center">
                                    <div class="stars" id="star-rating">
                                        <span data-value="1">★</span><span data-value="2">★</span><span data-value="3">★</span><span data-value="4">★</span><span data-value="5">★</span>
                                    </div>
                                  
                                    <input type="hidden" name="avaliacao" id="rating-value" value="0">
                                </div>
                                <div class="mb-3">
                                    <label for="mensagem" class="form-label">Sua mensagem:</label>
                                    <textarea class="form-control" id="mensagem" name="mensagem" rows="3" placeholder="Deixe seu comentário aqui..."></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Enviar Feedback</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const starRating = document.getElementById('star-rating');
            const ratingValue = document.getElementById('rating-value');
            const stars = starRating.getElementsByTagName('span');
    
            starRating.addEventListener('click', (e) => {
                if (e.target.tagName === 'SPAN') {
                    const value = Array.from(stars).indexOf(e.target) + 1;
                    ratingValue.value = value;
                    updateStars(value);
                }
            });
    
            function updateStars(value) {
                Array.from(stars).forEach((star, index) => {
                    star.style.color = index < value ? '#ffc107' : '#ccc';
                });
            }
        </script>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    
