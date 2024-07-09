<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>



    <link href="{{ asset('assets/css/style__cadastro.css') }}" rel="stylesheet">

  
</head>
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
<body>


  

  <div class="all_cadastro"></div>
    <div class="container_cadastro">
        <div class="background_cadastro"></div>
        <img src="{{asset('assets/img/logo.png')}}" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
        <div class="services-text_cadastro">
            <h2>Cadastre-se para descobrir os nossos serviços e produtos para sua festa com um <br> Divino Sabor!</h2>
        </div>

        @if ($errors->any())
    <div>
        <ul>

            @foreach ($errors->all() as $error)

            <div class="alert alert-danger">
            <p>@lang($error)</p>
    </div>
                
            @endforeach
        </ul>
        
    </div>
@endif


        <form id="cadastroForm" method="POST" action="{{ url('/website/cadastro') }}">
            @csrf
            <div class="input-group_cadastro">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Ex: email@gmail.com" value="{{ old('email') }}">
            </div>
            <div class="input-group_cadastro">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Insira uma senha forte: ">
            </div>
            <div class="input-group_cadastro">
                <label for="password_confirmation">Confirme sua senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>
            <button class="submit-button_cadastro" type="submit">Cadastre-se</button>
        </form>

        <a href="{{ url('website/login') }}">Já tenho uma conta</a>
    </div>
    

  
</body>
</html>