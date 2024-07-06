<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/css/login_style.css') }}" rel="stylesheet" /></head>

<body>
  <div class="all"></div>
  <div class="container">
    <form id="loginForm" action="{{ url('/website/login') }}" method="POST">
      @csrf
      <div class="background"></div>
      <img src="{{asset('assets/img/logo.png')}}" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
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
      <button class="submit-button" type="submit">Entrar</button>
    
    
      <a href="{{ url('website/cadastro') }}">Quero me cadastrar</a>
    </form>
  </div>
</body>

</html>
