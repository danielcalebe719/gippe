@extends('adm.templates.template')

@section('title', 'Notificações')

@section('content')
<!-- teste -->
<!-- Begin Page Content -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Clientes</li>
        </ol>
    </div>

    <!-- Notificações para Funcionários -->
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Notificações para Funcionários</h6>
            <button class="btn btn-primary" data-toggle="modal"
                data-target="#modalAdicionarNotificacaoCliente">Adicionar Notificação</button>
        </div>
        
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTableFuncionario">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Mensagem</th>
                            <th>Data</th>
                            <th>Título</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Conteúdo da tabela para notificações de funcionários -->
                        <!-- Exemplo estático -->
                        @foreach($notificacaoColaborador as $notificacao)
                            <tr>
                                <td>{{ $notificacao->id }}</td>
                                <td>{{ $notificacao->mensagem }}</td>
                                <td>{{ $notificacao->dataEnvio }}</td>
                                <td>{{ $notificacao->titulo }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modalEditarNotificacaoCliente"
                                        onclick="editarNotificacao(1, 'cliente')">Editar</button>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="excluirNotificacao(1, 'cliente')">Excluir</button>
                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#modalDetalhesNotificacaoCliente"
                                        onclick="mostrarDetalhes(1, 'cliente')">Detalhes</button>
                                </td>
                            </tr>
                            <!-- Fim do exemplo -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        
    </div>

    <!-- Notificações para Clientes -->
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Notificações para Clientes</h6>
            <button class="btn btn-primary" data-toggle="modal"
                data-target="#modalAdicionarNotificacaoCliente">Adicionar Notificação</button>
        </div>
        
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTableCliente">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Mensagem</th>
                            <th>Data</th>
                            <th>Título</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notificacaoCliente as $notificacao)
                            <tr>
                                <td>{{ $notificacao->id }}</td>
                                <td>{{ $notificacao->mensagem }}</td>
                                <td>{{ $notificacao->dataEnvio }}</td>
                                <td>{{ $notificacao->titulo }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modalEditarNotificacaoCliente"
                                        onclick="editarNotificacao(1, 'cliente')">Editar</button>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="excluirNotificacao(1, 'cliente')">Excluir</button>
                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#modalDetalhesNotificacaoCliente"
                                        onclick="mostrarDetalhes(1, 'cliente')">Detalhes</button>
                                </td>
                            </tr>
                            <!-- Fim do exemplo -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        
    </div>

    <!-- Modal Adicionar Notificação para Cliente -->
    <div class="modal fade" id="modalAdicionarNotificacaoCliente" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Notificação para Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="formAdicionarNotificacaoCliente" method="POST" action="/adm/notificacoes/guardarCliente">
                        <div class="form-group">
                            <label for="idCliente"> ID do Cliente</label>
                            <input type="text" class="form-control" id="idCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="idCliente"> ID do Cliente</label>
                            <input type="text" class="form-control" id="idCliente" required>
                        </div>

                        <div class="form-group">
                            <label for="tituloCliente">Título</label>
                            <input type="text" class="form-control" id="tituloCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="mensagemCliente">Mensagem</label>
                            <textarea class="form-control" id="mensagemCliente" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="dataCliente">Data</label>
                            <input type="date" class="form-control" id="data
                                            Cliente" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Notificação para Cliente -->
    <div class="modal fade" id="modalEditarNotificacaoCliente" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Notificação para Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="formEditarNotificacaoCliente">
                        <div class="form-group">
                            <label for="editaridCliente"> ID do Cliente</label>
                            <input type="text" class="form-control" id="editaridCliente" readonly>
                        </div>
                        <div class="form-group">
                            <label for="editarTituloCliente">Título</label>
                            <input type="text" class="form-control" id="editarTituloCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="editarMensagemCliente">Mensagem</label>
                            <textarea class="form-control" id="editarMensagemCliente" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editarDataCliente">Data</label>
                            <input type="date" class="form-control" id="editarDataCliente" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes Notificação para Funcionário -->
    <div class="modal fade" id="modalDetalhesNotificacaoFuncionario" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes da Notificação para Funcionário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="detalhesIdFuncionario"></span></p>
                    <p><strong>Título:</strong> <span id="detalhesTituloFuncionario"></span></p>
                    <p><strong>Mensagem:</strong> <span id="detalhesMensagemFuncionario"></span></p>
                    <p><strong>Data:</strong> <span id="detalhesDataFuncionario"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes Notificação para Cliente -->
    <div class="modal fade" id="modalDetalhesNotificacaoCliente" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes da Notificação para Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="detalhesIdCliente"></span></p>
                    <p><strong>Título:</strong> <span id="detalhesTituloCliente"></span></p>
                    <p><strong>Mensagem:</strong> <span id="detalhesMensagemCliente"></span></p>
                    <p><strong>Data:</strong> <span id="detalhesDataCliente"></span></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!---Container Fluid-->





<script>
    $(document).ready(function () {
        $('#dataTableFuncionario').DataTable();
        $('#dataTableCliente').DataTable();

        $('#formAdicionarNotificacaoCliente').on('submit', function (event) {
            event.preventDefault();
            // Código para adicionar notificação para cliente
            adicionarNotificacaoCliente();
        });

        $('#formEditarNotificacaoCliente').on('submit', function (event) {
            event.preventDefault();
            // Código para editar notificação para cliente
            editarNotificacaoCliente();
        });
    });

    function adicionarNotificacaoCliente() {
        // Implementar lógica para adicionar notificação para cliente
    }

    function editarNotificacaoCliente() {
        // Implementar lógica para editar notificação para cliente
    }

    function excluirNotificacao(id, tipo) {
        // Implementar lógica para excluir notificação
    }

    function mostrarDetalhes(id, tipo) {
        // Implementar lógica para mostrar detalhes da notificação
    }
</script>
@endsection
