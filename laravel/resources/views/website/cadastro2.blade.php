

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete seu cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/css/style_02cadastro.css')}}   ">
</head>
<body>
<div class="container">
    <div class="background"></div>
    <img src="{{asset('assets/img/logo.png')}}" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
    <div class="services-text">
        <h2>Insira alguns dados adicionais para continuar nosso atendimento!</h2>
    </div>
    <form action="" method="POST">
    <div class="input-group">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required value="<?php echo isset($formularioDados['nome']) ? $formularioDados['nome'] : ''; ?>">
    </div>
    <div class="input-group">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="11" required value="<?php echo isset($formularioDados['cpf']) ? $formularioDados['cpf'] : ''; ?>">
    </div>
    <div class="input-group">
        <label for="dob">Data de Nascimento:</label>
        <input type="date" id="dob" name="dob" required value="<?php echo isset($formularioDados['dataNascimento']) ? $formularioDados['dataNascimento'] : ''; ?>">
    </div>
    <div class="input-group">
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="8" required value="<?php echo isset($formularioDados['cep']) ? $formularioDados['cep'] : ''; ?>">
    </div>
    <div class="input-group">
        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua" maxlength="40" required value="<?php echo isset($formularioDados['rua']) ? $formularioDados['rua'] : ''; ?>">
    </div>
    <div style="display: flex; flex-direction: row;">
        <div class="input-group" style="max-width: 50%;">
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" maxlength="5" required value="<?php echo isset($formularioDados['numero']) ? $formularioDados['numero'] : ''; ?>">
        </div>
        <div class="input-group" style="max-width: 50%;">
            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento" maxlength="20" value="<?php echo isset($formularioDados['complemento']) ? $formularioDados['complemento'] : ''; ?>">
        </div>
    </div>  
    <div class="input-group">
        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" maxlength="25" required value="<?php echo isset($formularioDados['bairro']) ? $formularioDados['bairro'] : ''; ?>">
    </div>
    <div class="input-group" style="max-width: 95%; margin-right: 20px;">
        <label for="city">Cidade:</label>
        <select name="city" id="city" required>
            <option value=""></option>
            <option value="Belo Horizonte" >Belo Horizonte</option>
            <option value="Contagem" Contagem</option>
            <option value="Betim" >Betim</option>
            <option value="Sabará" >Sabará</option>
            <option value="Ibirité">Ibirité</option>
        </select>
    </div>
    <div class="input-group">
        <label for="tipo_endereco">Tipo de Endereço:</label>
        <select name="tipo_endereco" id="tipo_endereco" required>
            <option value=""></option>
            <option value="residencial" >Residencial</option>
            <option value="comercial" >Comercial</option>
        </select>
    </div>
    <div class="input-check">
        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">Eu concordo com os <a href="#">termos e condições</a> do site. <br> </label>
    </div>
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
            $("#city").val("");
            // Limpe outros campos conforme necessário
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
                    $("#city").val("...");
                    
                    // Faz a requisição para a API ViaCEP
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            // Atualiza os campos do formulário com os dados recebidos
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#city").val(dados.localidade);
                            // Atualize outros campos conforme necessário
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
                // CEP sem valor, limpa formulário
                limparFormularioCEP();
            }
        });
    });
</script>


    
</body>
</html>