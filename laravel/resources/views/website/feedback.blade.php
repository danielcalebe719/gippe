<!DOCTYPE html>
<html lang="en">
    <head>
   
        <title>Feedback do Pedido - Buffet Divino Sabor</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f8f9fa;
                height: 100vh;
                display: flex;
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
    </body>
    
    </html>
    
