<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="assets/js/jsservices.js"></script>
  <link rel="stylesheet" href="assets/css/style_login.css">

  <title>Login</title>
</head>

<body>

  <div class="container">
    <form id="loginForm" action="processa_login.php" method="post">
      <div class="background"></div>
      <img src="assets/img/logo.png" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
      <div class="services-text">
        <h2>Entre e descubra os nossos serviços e produtos para sua festa!</h2>
      </div>

      <div class="input-group">
        <label for="username">Email</label>
        <input type="text" id="username" name="username" placeholder="Ex: email@gmail.com">
      </div>
      <div class="input-group">
        <label for="password">Senha</label>
        <input type="password" id="password" name="password">
      </div>

      <?php
      if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == 'senha_incorreta') {
          echo '<div class="alert alert-danger" role="alert">Senha incorreta. Por favor, tente novamente.</div>';
        } elseif ($error == 'cliente_nao_encontrado') {
          echo '<div class="alert alert-danger" role="alert">Usuário não encontrado. Verifique suas credenciais e tente novamente.</div>';
        }
      }
      ?>

      <button class="submit-button" type="submit" onclick="submitForm()">Entrar</button>
      <div class="separation-line1"></div>
      <div class="separation-line"></div>
      <a href="cadastro.php">Quero me cadastrar</a>
      <div class="other-options">
        <button class="btn1"><img src="assets/img/google.png" alt="Google Logo" style="padding-right: 10px;">Entre com o Google</button>
        <br>
        <button class="btn1" style="padding-right: 33px;"><img src="assets/img/apple.png" alt="Apple Logo" style="padding-right: 10px;">Entre com a Apple</button>
      </div>
    </form>
  </div>

  <script>
    function submitForm(event) {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;

      if (username.trim() === "" || password.trim() === "") {
        alert("Por favor, preencha todos os campos.");
        event.preventDefault();
      } else {
        document.getElementById("loginForm").submit();
      }
    }

    document.querySelector('.submit-button').addEventListener('click', function(event) {
      submitForm(event);
    });
  </script>

</body>

</html>
