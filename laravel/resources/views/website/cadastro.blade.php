<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="{{asset('assets/css/style_cadastro.css')}}">
    
</head>
<body>
    
    <div class="container">
        <div class="background"></div>
        <img src="assets/img/logo.png" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
        <div class="services-text">
            <h2>Cadastre-se para descobrir os nossos serviços e produtos para sua festa com um <br> Divino Sabor!</h2>
        </div>
        
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form id="cadastroForm"  method="POST" action="{{ url('/website/cadastrar') }}">
        @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Ex: email@gmail.com" value="{{ old('email') }}">
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Insira uma senha forte: ">
            </div>
            <div class="input-group">
                <label for="password_confirmation">Confirme sua senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <button class="submit-button" type="submit" >Cadastre-se</button>
        </form>

        <div class="separation-line1"></div>
        <div class="separation-line"></div>

        <div class="other-options">
            <button class="btn1"><img src="google.png" alt="" srcset="" style="padding-right: 10px; ">Entre com Google</button>
            <br>
            <button class="btn1" style="padding-right: 33px;"><img src="apple.png" alt="" srcset="" style="padding-right: 10px; "> Entre com Apple</button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

    </script>
</body>
</html>
