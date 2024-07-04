<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="assets/js/jsservices.js"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/style_login.css') }}">

  <title>Login</title>
</head>

<body>

  <div class="container">
    <form id="loginForm" action="{{ url('/website/login') }}" method="POST">
    @csrf
      <div class="background"></div>
      <img src="assets/img/logo.png" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
      <div class="services-text">
        <h2>Entre e descubra os nossos serviços e produtos para sua festa!</h2>
      </div>

      <div class="input-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Ex: email@gmail.com">
      </div>
      <div class="input-group">
        <label for="password">Senha</label>
        <input type="password" id="password" name="password">
      </div>

    

      <button class="submit-button" type="submit" ">Entrar</button>
      <div class="separation-line1"></div>
      <div class="separation-line"></div>
      <a href="{{url('website/cadastrar')}}" >Quero me cadastrar</a>
    
    </form>
  </div>

  <script>

  </script>

</body>

</html>
