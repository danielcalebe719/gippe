<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Pedido</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <!-- Flatpickr Portuguese Localization -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: url('') no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: blur(5px);                 display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;  
        }
        .container {
            margin-top: 50px;
            border-radius: 15px ;
        }
        .btn-custom {
            background-color: #FF944E;
            border: none;
        }
        .btn-confirm {
            background-color: #fa856e;
            border: none;
        }
        .card-custom {
            border: none;
            box-shadow: 0 8px 16px #FA856E;
            border-radius: 15px ;
        }
        .card-title {
            color: #FF944E;
        }
        .form-label {
            color: #343a40;
            font-weight: 600;
        }
        .form-control {
            border-radius: 10px;
        }
        .modal-header {
            background-color: #FF944E;
            color: white;
        }
        .modal-footer {
            border-top: none;
        }
    </style>
</head>

<body>

<div class="container">


        <div class="row justify-content-center">
            
            <div class="col-md-8">
                <div class="card card-custom mb-4">
                    <div class="card-body">
                  
                        <h1 class="card-title mb-4">Agende sua Festa</h1>
                        @if(!$criacao)
                        <div class="alert alert-info">
                            Você está editando um pedido existente. Faça as alterações abaixo.
                        </div>
                    @endif  
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="agendamentoForm" method="POST" action="{{ route('website.agendamento.salvar') }}">
                            @csrf
                            <input type="hidden" name="codigo" value="{{ $codigo }}">
                            
                            <div class="mb-3">
                                <label for="dataInicio" class="form-label">Data de Início do Evento:</label>
                                <input type="text" id="dataInicio" name="dataInicio" class="form-control" value="{{ $agendamento->dataInicio ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="dataFim" class="form-label">Data de Fim do Evento:</label>
                                <input type="text" id="dataFim" name="dataFim" class="form-control" value="{{ $agendamento->dataFim ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="horaInicio" class="form-label">Horário de Início:</label>
                                <input type="time" id="horaInicio" name="horaInicio" class="form-control" value="{{ $agendamento->horaInicio ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="horaFim" class="form-label">Horário de Fim:</label>
                                <input type="time" id="horaFim" name="horaFim" class="form-control" value="{{ $agendamento->horaFim ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="observacao" class="form-label">Observação:</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="4" placeholder="Observação sobre o pedido...">{{ $agendamento->observacao ?? '' }}</textarea>
                            </div>
                            
                            <button type="button" class="btn btn-custom w-100" data-bs-toggle="modal" data-bs-target="#confirmationModal">Agendar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmação de Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja agendar este pedido com os dados informados?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-confirm" id="confirmButton">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('confirmButton').addEventListener('click', function () {
            document.getElementById('agendamentoForm').submit();
        });

        // Inicializa o Flatpickr
        flatpickr("#dataInicio", {
            locale: "pt",
            dateFormat: "Y-m-d",
        });
        flatpickr("#dataFim", {
            locale: "pt",
            dateFormat: "Y-m-d",
        });
    </script>
</body>
</html>
