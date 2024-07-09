<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

    
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/css/style_login.css') }}" rel="stylesheet" />



  <style>.alert {
    
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}       </style>
</head>

<body>
  <div class="all"></div>
  <div class="container">
    <form id="loginForm" >
      @csrf
      <div class="background"></div>
      <a href="{{route('website.index')}}"><img src="{{asset('assets/img/logo.png')}}" alt="Logo" style="display: block; margin: 0 auto; width: 50%;"></a>
      <div class="services-text">
        <h2>Entre e descubra os nossos serviços e produtos para sua festa!</h2>
      </div>
    <div id="erro">


    </div>



      <div class="input-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Ex: email@gmail.com">
      </div>
      <div class="input-group">
        <label for="password">Senha</label>
        <input type="password" id="password" name="password">
      </div>
      <button class="submit-button" type="submit">Entrar</button>
    
    
      <a href="{{ url('website/cadastro') }}">Quero me cadastrar</a>
    </form>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


</body>

</html>
