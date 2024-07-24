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
    
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
          
           
                     
          
        }
        .agendamento-container {
            margin-top: 100px; /* Ajuste a margem para evitar a sobreposição da navbar */
            border-radius: 15px;
        }
        .btn-agendamento-custom {
            background-color: #FF944E;
            border: none;
        }
        .btn-agendamento-confirm {
            background-color: #fa856e;
            border: none;
        }
        .card-agendamento-custom {
            border: none;
            box-shadow: 0 8px 16px #FA856E;
            border-radius: 15px;
        }
        .card-agendamento-title {
            color: #FF944E;
        }
        .form-agendamento-label {
            color: #343a40;
            font-weight: 600;
        }
        .form-agendamento-control {
            border-radius: 10px;
        }
        .modal-agendamento-header {
            background-color: #FF944E;
            color: white;
        }
        .modal-agendamento-footer {
            border-top: none;
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    <div class="container agendamento-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-agendamento-custom mb-4">
                    <div class="card-body">
                        <h1 class="card-agendamento-title mb-4">Agende sua Festa</h1>
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
                                <label for="dataInicio" class="form-agendamento-label">Data de Início do Evento:</label>
                                <input type="text" id="dataInicio" name="dataInicio" class="form-agendamento-control form-control" value="{{ $agendamento->dataInicio ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="dataFim" class="form-agendamento-label">Data de Fim do Evento:</label>
                                <input type="text" id="dataFim" name="dataFim" class="form-agendamento-control form-control" value="{{ $agendamento->dataFim ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="horaInicio" class="form-agendamento-label">Horário de Início:</label>
                                <input type="time" id="horaInicio" name="horaInicio" class="form-agendamento-control form-control" value="{{ $agendamento->horaInicio ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="horaFim" class="form-agendamento-label">Horário de Fim:</label>
                                <input type="time" id="horaFim" name="horaFim" class="form-agendamento-control form-control" value="{{ $agendamento->horaFim ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="observacao" class="form-agendamento-label">Observação:</label>
                                <textarea class="form-agendamento-control form-control" id="observacao" name="observacao" rows="4" placeholder="Observação sobre o pedido...">{{ $agendamento->observacao ?? '' }}</textarea>
                            </div>
                            
                            <button type="button" class="btn btn-agendamento-custom w-100" data-bs-toggle="modal" data-bs-target="#agendamentoConfirmationModal">Agendar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="agendamentoConfirmationModal" tabindex="-1" aria-labelledby="agendamentoConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-agendamento-header modal-header">
                    <h5 class="modal-title" id="agendamentoConfirmationModalLabel">Confirmação de Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja agendar este pedido com os dados informados?
                    <h5>Obs: <strong>Após a análise das observações os valores podem ser alteradores</strong></h5>
                </div>
                <div class="modal-agendamento-footer modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-agendamento-confirm" id="confirmButton">Confirmar</button>
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
        <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

<script src="{{ asset('assets/js/mainn.js') }}"></script>

</body>
</html>
