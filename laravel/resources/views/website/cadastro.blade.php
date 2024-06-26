<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="assets/css/style_cadastro.css">
    
</head>
<body>
    
    <div class="container">
        <div class="background"></div>
        <img src="assets/img/logo.png" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
        <div class="services-text">
            <h2>Cadastre-se para descobrir os nossos serviços e produtos para sua festa com um <br> Divino Sabor!</h2>
        </div>

        <form id="cadastroForm" method="post">
            <div class="input-group">
                <label for="username">Email</label>
                <input type="text" id="username" name="username" placeholder="Ex: email@gmail.com">
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Insira uma senha forte: ">
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirme sua senha</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>

            <button class="submit-button" type="button" onclick="cadastrar()">Cadastre-se</button>
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
        function cadastrar() {
            var username = $('#username').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();

            // Verifica se as senhas coincidem
            if (password !== confirm_password) {
                alert("As senhas não coincidem.");
                return;
            }

            // Envia os dados via AJAX para o arquivo PHP de processamento
            $.ajax({
                type: 'POST',
                url: 'processa_cadastro.php',
                data: $('#cadastroForm').serialize(), // Serializa os dados do formulário
                dataType: 'json',
                success: function(data) {
                    alert(data.message); // Exibe a mensagem de sucesso ou erro
                    if (data.success) {
                        // Redireciona para a página de login se o cadastro for bem-sucedido
                        window.location.href = "login.php";
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Erro ao enviar os dados do formulário. Por favor, tente novamente.');
                }
            });
        }
    </script>
</body>
</html>
