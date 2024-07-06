

<!DOCTYPE html>
<html lang="pt-br">
    


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Pedido</title>
    
    <!-- CSS Bootstrap -->
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Flatpickr Portuguese Localization -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>

<!-- Arquivo de estilos personalizados -->
<link rel="stylesheet" href="{{ asset('assets/css/styles_agendamento.css') }}">

<!-- Google Fonts - Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Outro arquivo de estilos personalizados -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container">
        <h1>Agendamento de Pedido</h1>
        <form id="agendamentoForm" method="POST" action="{{route('website.agendamento.salvar')}}">
            @csrf
            <input type="hidden" name="codigo" value="{{ $codigo }}">
            <div class="calendar mb-3">
                <label for="dataInicio">Selecione a data de início do evento:</label>
                <input type="text" id="dataInicio" name="dataInicio" class="form-control" required>
            </div>
            <div class="calendar mb-3">
                <label for="dataFim">Selecione a data de fim do evento:</label>
                <input type="text" id="dataFim" name="dataFim" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="horaInicio">Selecione o horário de início do evento:</label>
                <input type="time" id="horaInicio" name="horaInicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="horaFim">Selecione o horário de fim do evento:</label>
                <input type="time" id="horaFim" name="horaFim" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="observacao">Observação:</label>
                <textarea class="form-control" id="observacao" name="observacao" rows="4" placeholder="Observação sobre qualquer coisa do pedido..."></textarea>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #FF944E; border: none;">Agendar</button>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação de Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja agendar este pedido com os dados informados?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmButton" style="background-color: #fa856e; border: #fa856e;">Confirmar</button>
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
