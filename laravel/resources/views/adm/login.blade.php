<!--test-->
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrativo</title>
  <link rel="stylesheet" href="{{ asset('assets/css/css_adm/login.css') }}">


</head>
  <div class="container">
    <div class="background"></div>
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="display: block; margin: 0 auto; width: 50%;"><br>
    <div class="services-text">
      <h2>Bem vindo a sua área de gestão! Insira os dados para fazer o login</h2>
    </div>

    
        <form method="POST" action="{{ url('/adm/login/logar') }}">
            @csrf
            @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
             
            @enderror

            @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
               
            @enderror

            @error('mensagem')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
               
            @enderror
            @if (Session::has('mensagem'))
                <div class="alert alert-danger">
                    {{ Session::get('mensagem') }}
                </div>
               
            @endif

            <div class="input-group">
                <label for="email">Email institucional</label>
                <input type="text" id="email" name="email" placeholder="Ex: email@gmail.com">
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password">
            </div>

            <button class="submit-button" type="submit">Entrar</button>
        </form>
    <div  class="separation-line1"></div>
    <div class="separation-line"></div>
   
  </div>
  <script src="{{ asset('assets/js/js_adm/script.js') }}"></script>
</body>

</html>
