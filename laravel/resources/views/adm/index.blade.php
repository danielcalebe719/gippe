<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="{{ asset('assets/css/css_adm/css_login.css') }}">


</head>
  <div class="container">
    <div class="background"></div>
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
    <div class="services-text"><h2>Bem vindo a sua área de gestão!</h2></div>
  <form method="post" action="autenticar.php">
    <div class="input-group">
      <label for="username">Email institucional</label>
      <input type="text" id="user" name="user" placeholder="Ex: email@gmail.com">
    </div>
    <div class="input-group">
      <label  for="password">Senha </label>
      
      <input    type="password" id="senha" name="senha" >
      
    
    </div>
    
    <div class="input-group forgot-password">
      <button class="quad"></button> <a href="#" > Lembre senha</a>
      <a href="#" style="padding-left: 17%;">Esqueci a senha</a>
    </div>
    
    <button class="submit-button" type="submit"  >Entrar</button>
  </form>
    <div  class="separation-line1"></div>
    <div class="separation-line"></div>
   
  </div>
  <script src="{{ asset('assets/js/js_adm/script.js') }}"></script>
</body>

</html>
