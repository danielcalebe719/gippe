<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete seu </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style_cadastro2.css') }}">
</head>
<body>
    <div class="all"></div>
<div class="container">
    <div class="background"></div>
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
    <div class="services-text">
        <h2>Insira alguns dados adicionais para continuar nosso atendimento!</h2>
    </div>


    <form action="{{ url('website/cadastroCompletar') }}" method="POST">
    @csrf
    <input type="hidden" name="idClientes" value="{{ Auth::guard('cliente')->user()->id }}">
    
    <div class="input-group">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required value="{{ old('nome', $cliente->nome ?? '') }}">
    </div>
    
    <div class="input-group">
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" required value="<?php echo isset($formularioDados['telefone']) ? $formularioDados['telefone'] : ''; ?>">
    </div>
    <div class="input-group">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="11" required value="{{ old('cpf', $cliente->cpf ?? '') }}">
    </div>
    
    <div class="input-group">
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required value="{{ old('telefone', $cliente->telefone ?? '') }}">
    </div>
    
    <div class="input-group">
        <label for="dataNascimento">Data de Nascimento:</label>
        <input type="date" id="dataNascimento" name="dataNascimento" required value="{{ old('dataNascimento', $cliente->dataNascimento ?? '0000-00-00   ' ) }}">
    </div>
    
    <div class="input-group">
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="8" required value="{{ old('cep', $enderecosClientes->first()->cep ?? '') }}">
    </div>
    
    <div class="input-group">
        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua" maxlength="40" required value="{{ old('rua', $enderecosClientes->first()->rua ?? '') }}">
    </div>
    
    <div style="display: flex; flex-direction: row;">
        <div class="input-group" style="max-width: 50%;">
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" maxlength="5" required value="{{ old('numero', $enderecosClientes->first()->numero ?? '') }}">
        </div>
        
        <div class="input-group" style="max-width: 50%;">
            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento" maxlength="20" value="{{ old('complemento', $enderecosClientes->first()->complemento ?? '') }}">
        </div>
    </div>
    
    <div class="input-group">
        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" maxlength="25" required value="{{ old('bairro', $enderecosClientes->first()->bairro ?? '') }}">
    </div>
    
    <div class="input-group" style="max-width: 95%; margin-right: 20px;">
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" maxlength="40" required value="{{ old('cidade', $enderecosClientes->first()->cidade ?? '') }}">
    </div>
    
    <div class="input-group">
        <label for="tipo">Tipo de Endereço:</label>
        <select name="tipo" id="tipo" required>
            <option value="">Selecione o tipo de Endereço</option>
            <option value="residencial" {{ old('tipo', $enderecosClientes->first()->tipo ?? '') == 'residencial' ? 'selected' : '' }}>Residencial</option>
            <option value="comercial" {{ old('tipo', $enderecosClientes->first()->tipo ?? '') == 'comercial' ? 'selected' : '' }}>Comercial</option>
        </select>
    </div>
    
    <div class="input-check">
        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">Eu concordo com os <a href="#">termos e condições</a> do site.</label>
    </div>
<br>
    <button class="submit-button" type="submit">Continuar</button>
</form>




    <div class="separation-line1"></div>
    <div class="separation-line"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Função para limpar o formulário de CEP
        function limparFormularioCEP() {
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
        }

        // Evento "blur" para detectar quando o usuário termina de digitar o CEP
        $("#cep").blur(function() {
            var cep = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico do CEP
            if (cep !== "") {
                var validacep = /^[0-9]{8}$/; // Expressão regular para validar o formato do CEP
                if(validacep.test(cep)) {
                    // Preenche os campos com "..." enquanto a busca está sendo realizada
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    
                    // Faz a requisição para a API ViaCEP
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            // Atualiza os campos do formulário com os dados recebidos
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                        } else {
                            // CEP não encontrado
                            limparFormularioCEP();
                            alert("CEP não encontrado.");
                        }
                    });
                } else {
                    // CEP em formato inválido
                    limparFormularioCEP();
                    alert("Formato de CEP inválido.");
                }
            } else {
                // CEP sem valor
                limparFormularioCEP();
            }
        });
    });
</script>
</body>
</html>
