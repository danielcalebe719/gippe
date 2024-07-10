<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete seu cadastro</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        /* Adicione os estilos fornecidos aqui */
        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff5e6; /* Cor de fundo do corpo */
        }

        .bg-blur {
            position: fixed; /* Posição fixa para cobrir toda a tela */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f2e9e1;
            background-size: cover;
            z-index: -1; /* Coloca a imagem de fundo atrás de todo o conteúdo */
        }

        .text-bg-primary {
            background-color: #FAA562; /* Cor de fundo do lado esquerdo */
            color: #fff;
            padding: 20px;
        }

        .btn-primary,
        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #FA856E; /* Cor de fundo do botão de login */
            border-color: #FA856E; /* Cor da borda do botão de login */
        }

        .btn-outline-primary,
        .btn-outline-primary:hover,
        .btn-outline-primary:focus {
            color: #FA856E; /* Cor do texto do botão de redes sociais */
            border-color: #FA856E; /* Cor da borda do botão de redes sociais */
        }

        .form-label {
            color: #FA856E; /* Cor do texto das labels do formulário */
        }

        .form-control {
            border-color: #FA856E; /* Cor da borda dos campos de formulário */
        }

        .text-secondary {
            color: #FAA562; /* Cor do texto secundário (ex: 'Keep me logged in') */
        }
    </style>
</head>

<body>
    <div class="bg-blur"></div>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="card border-light-subtle shadow-sm" style="border: 5px solid #FA856E; border-radius: 5px;">
                <div class="row g-0">
                    <!-- Div movida para a direita -->
                    <div class="col-12 col-md-6 order-md-last d-flex align-items-center justify-content-center"
                        style="background-color: #FA856E; color: #fff; margin: -5px;">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="col-10 col-xl-8 py-3">
                                <a href="{{ route('website.index') }}">
                                    <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid rounded mb-4"
                                        loading="lazy" width="245" height="80" alt="Logo" style="margin-left: 17%;">
                                </a>
                                <hr class="border-primary-subtle mb-4">
                                <h2 class="h1 mb-4">Complete seu cadastro para continuar nosso atendimento!</h2>
                                <!-- Texto de boas-vindas ajustado -->
                            </div>
                        </div>
                    </div>

                    <!-- Div movida para a esquerda -->
                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h3 style="color: #FA856E;">Cadastro</h3>
                                        <p>Preencha o formulário abaixo para completar seu cadastro.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="erro">
                                <!-- Conteúdo do #erro -->
                            </div>
                            <form id="cadastroForm" method="POST" action="{{ url('website/cadastroCompletar') }}">
                                @csrf
                                <input type="hidden" name="idClientes" value="{{ Auth::guard('cliente')->user()->id }}">
                                
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nome" name="nome" required value="{{ old('nome', $cliente->nome ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="telefone" class="form-label">Telefone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telefone" name="telefone" required value="{{ old('nome', $cliente->telefone ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="cpf" class="form-label">CPF <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" required value="{{ old('cpf', $cliente->cpf ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="dataNascimento" class="form-label">Data de Nascimento <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required value="{{ old('dataNascimento', $cliente->dataNascimento ?? '0000-00-00') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="cep" class="form-label">CEP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="cep" name="cep" maxlength="8" required value="{{ old('cep', $enderecosClientes->first()->cep ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="rua" class="form-label">Rua <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="rua" name="rua" maxlength="40" required value="{{ old('rua', $enderecosClientes->first()->rua ?? '') }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="numero" class="form-label">Número <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="numero" name="numero" maxlength="5" required value="{{ old('numero', $enderecosClientes->first()->numero ?? '') }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" maxlength="20" value="{{ old('complemento', $enderecosClientes->first()->complemento ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="bairro" class="form-label">Bairro <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" maxlength="25" required value="{{ old('bairro', $enderecosClientes->first()->bairro ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="cidade" class="form-label">Cidade <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" maxlength="40" required value="{{ old('cidade', $enderecosClientes->first()->cidade ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="tipo" class="form-label">Tipo de Endereço <span class="text-danger">*</span></label>
                                        <select class="form-select" id="tipo" name="tipo" required>
                                            <option value="">Selecione o tipo de Endereço</option>
                                            <option value="residencial" {{ old('tipo', $enderecosClientes->first()->tipo ?? '') == 'residencial' ? 'selected' : '' }}>Residencial</option>
                                            <option value="comercial" {{ old('tipo', $enderecosClientes->first()->tipo ?? '') == 'comercial' ? 'selected' : '' }}>Comercial</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                            <label class="form-check-label" for="terms">
                                                Eu concordo com os <a href="#">termos e condições</a> do site.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <br>
                                        <button type="submit" class="btn btn-primary">Continuar</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-5 mb-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                        <a href="{{ url('website/login') }}" class="link-secondary text-decoration-none" style="color: #FA856E;"><!--visuasualizar a pagina de produtos mesmo sem estar logado?--></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function () {
    $('#cadastroForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: "{{ url('/website/cadastroCompletar') }}",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    window.location.href = "{{ url('website/servicos') }}";
                } else {
                    $('.alert-danger').remove(); // Remove quaisquer alertas de erro anteriores
                    $('#erro').empty().append('<div class="alert alert-danger">' + response.message + '</div>');
                    $('html, body').animate({ scrollTop: 0 }, 'slow'); // Scroll para o topo da página
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON.message; // Captura a mensagem de erro do JSON
                $('.alert-danger').remove(); // Remove quaisquer alertas de erro anteriores
                $('#erro').empty().append('<div class="alert alert-danger">' + errorMessage + '</div>');
                $('html, body').animate({ scrollTop: 0 }, 'slow'); // Scroll para o topo da página
            }
        });
    });
});

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

    </script>
</body>

</html>
