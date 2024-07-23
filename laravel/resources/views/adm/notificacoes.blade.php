@extends('adm.templates.template')

@section('title', 'Notificações')

@section('content')
<!-- teste -->
<!-- Begin Page Content -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notificações</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Notificações</li>
        </ol>
    </div>

    <!-- Notificações para Funcionários -->
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Notificações para Funcionários</h6>
            <button class="btn btn-primary" data-toggle="modal"
                data-target="#modalAdicionarNotificacaoFuncionario">Adicionar Notificação</button>
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
                                    onclick="carregarDadosParaEdicaoColaborador({{ $notificacao->id }})">Editar</button>
                                <button class="btn btn-danger btn-sm"
                                    onclick="abrirModalExclusaoA({{ $notificacao->id }})">Excluir</button>
                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                    onclick="mostrarDetalhesColaborador({{ $notificacao->id }})">Detalhes</button>
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
                                    onclick="carregarDadosParaEdicaoCliente({{ $notificacao->id }})">Editar</button>
                                <button class="btn btn-danger btn-sm"
                                    onclick="abrirModalExclusaoC({{ $notificacao->id }})">Excluir</button>
                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                    onclick="mostrarDetalhesCliente({{ $notificacao->id }})">Detalhes</button>
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
                        @csrf

                        <div class="form-group">
                            <label for="idClientes">ID do Cliente</label>
                            <input type="text" class="form-control" id="idClientes" name="idClientes" required>
                        </div>
                        <div class="form-group">
                            <label for="idPedidos">ID do Pedido</label>
                            <input type="text" class="form-control" id="idPedidos" name="idPedidos" required>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="form-group">
                            <label for="mensagem">Mensagem</label>
                            <textarea class="form-control" id="mensagem" name="mensagem" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Notificação para Cliente -->
    <div class="modal fade" id="modalAdicionarNotificacaoFuncionario" tabindex="-1" role="dialog"
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
                    <form id="formAdicionarNotificacaoCliente" method="POST" action="/adm/notificacoes/guardarAdmin">
                        @csrf

                        <div class="form-group">
                            <label for="idClientes">ID do Funcionário</label>
                            <input type="text" class="form-control" id="idAdmins" name="idAdmins" required>
                        </div>
                        <div class="form-group">
                            <label for="idPedidos">ID do Pedido</label>
                            <input type="text" class="form-control" id="idPedidos" name="idPedidos" required>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="form-group">
                            <label for="mensagem">Mensagem</label>
                            <textarea class="form-control" id="mensagem" name="mensagem" rows="3" required></textarea>
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
                    <form id="formEditarNotificacaoCliente" method="POST" action="/adm/notificacoes/guardarCliente"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editarIdNotificacaoC" name="idNotificacao" value="">
                        <div class="form-group">
                            <label for="idClientes">ID do Cliente</label>
                            <input type="text" class="form-control" id="editarIdClientesC" name="idClientes" required>
                        </div>
                        <div class="form-group">
                            <label for="idPedidos">ID do Pedido</label>
                            <input type="text" class="form-control" id="editarIdPedidosC" name="idPedidos" required>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="editarTituloC" name="titulo" required>
                        </div>
                        <div class="form-group">
                            <label for="mensagem">Mensagem</label>
                            <textarea class="form-control" id="editarMensagemC" name="mensagem" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Notificação para Cliente -->
    <div class="modal fade" id="modalEditarNotificacaoColaborador" tabindex="-1" role="dialog"
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
                    <form id="formEditarNotificacaoCliente" method="POST" action="/adm/notificacoes/guardarAdmin"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editarIdNotificacaoA" name="idNotificacao" value="">
                        <div class="form-group">
                            <label for="idClientes">ID do Cliente</label>
                            <input type="text" class="form-control" id="editarIdAdminsA" name="idAdmins" required>
                        </div>
                        <div class="form-group">
                            <label for="idPedidos">ID do Pedido</label>
                            <input type="text" class="form-control" id="editarIdPedidosA" name="idPedidos" required>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="editarTituloA" name="titulo" required>
                        </div>
                        <div class="form-group">
                            <label for="mensagem">Mensagem</label>
                            <textarea class="form-control" id="editarMensagemA" name="mensagem" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes Notificações Colaboradores -->
    <div class="modal fade" id="modalDetalhesNotificacaoColaboradores" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes da Notificação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="detalhesData Inicio" class="col-sm-3 col-form-label">Id do CLiente:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesIdAdmin" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="detalhesDataCadastro" class="col-sm-3 col-form-label">Id do Pedido:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesIdPedidoA" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status:</label>
                        <div class="col-sm-9">
                        <select class="form-control" id="detalhesLidoA"  readonly>
                            @foreach(App\Models\Notificacoes::getNotifiacoesArray() as $chave => $valor)
                                <option value="{{$chave}}">{{$valor}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes Notificações Clientes -->
    <div class="modal fade" id="modalDetalhesNotificacaoClientes" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes da Notificação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="detalhesData Inicio" class="col-sm-3 col-form-label">Id do Cliente:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesIdCliente" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="detalhesDataCadastro" class="col-sm-3 col-form-label">Id do Pedido:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesIdPedidoC" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status:</label>
                        <div class="col-sm-9">
                        <select class="form-control" id="detalhesLidoC"  readonly>
                            @foreach(App\Models\Notificacoes::getNotifiacoesArray() as $chave => $valor)
                                <option value="{{$chave}}">{{$valor}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---Container Fluid-->
<!-- Modal Confirmar Exclusão -->
<div class="modal fade" id="modalConfirmarExclusaoA" tabindex="-1" role="dialog"
        aria-labelledby="modalConfirmarExclusaoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmarExclusaoLabel">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza de que deseja excluir este pedido?</p>
                    <input type="hidden" id="excluirIdNotificacaoA">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarExclusaoA">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Exclusão -->
<div class="modal fade" id="modalConfirmarExclusaoC" tabindex="-1" role="dialog"
        aria-labelledby="modalConfirmarExclusaoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmarExclusaoLabel">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza de que deseja excluir este pedido?</p>
                    <input type="hidden" id="excluirIdNotificacaoC">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarExclusaoC">Excluir</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function () {
            $('#dataTableFuncionario').DataTable();
            $('#dataTableCliente').DataTable();



        });

        function abrirModalExclusaoA(idNotificacao) {
        document.getElementById('excluirIdNotificacaoA').value = idNotificacao;
        $('#modalConfirmarExclusaoA').modal('show');
    }

    // Função para confirmar a exclusão
    document.getElementById('confirmarExclusaoA').addEventListener('click', function () {
        var idNotificacao = document.getElementById('excluirIdNotificacaoA').value;

        // Enviar requisição AJAX para excluir o cliente
        fetch(`/adm/notificacoes/removerColaborador/${idNotificacao}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao excluir o pedido');
                }
                return response.json();
            })
            .then(data => {
                // Fechar o modal de confirmação de exclusão
                $('#modalConfirmarExclusaoA').modal('hide');

                // Remover a linha do cliente na tabela, se existir
                let notificacaoRow = document.getElementById(`notificacaoRow${idNotificacao}`);
                if (notificacaoRow) {
                    notificacaoRow.remove();
                } else {
                    console.warn(`Elemento notificacaoRow${idNotificacao} não encontrado para remoção.`);
                }

                // Exibir mensagem de sucesso
                location.replace(location.href)

            })
            .catch(error => {
                console.log(error)
                console.error('Erro ao excluir o pedido:', error);
                alert('Erro ao excluir o pedido');
            });
    });

    function abrirModalExclusaoC(idNotificacao) {
        document.getElementById('excluirIdNotificacaoC').value = idNotificacao;
        $('#modalConfirmarExclusaoC').modal('show');
    }

    // Função para confirmar a exclusão
    document.getElementById('confirmarExclusaoC').addEventListener('click', function () {
        var idNotificacao = document.getElementById('excluirIdNotificacaoC').value;

        // Enviar requisição AJAX para excluir o cliente
        fetch(`/adm/notificacoes/removerCliente/${idNotificacao}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao excluir o pedido');
                }
                return response.json();
            })
            .then(data => {
                // Fechar o modal de confirmação de exclusão
                $('#modalConfirmarExclusaoA').modal('hide');

                // Remover a linha do cliente na tabela, se existir
                let notificacaoRow = document.getElementById(`notificacaoRow${idNotificacao}`);
                if (notificacaoRow) {
                    notificacaoRow.remove();
                } else {
                    console.warn(`Elemento notificacaoRow${idNotificacao} não encontrado para remoção.`);
                }

                // Exibir mensagem de sucesso
                location.replace(location.href)

            })
            .catch(error => {
                console.log(error)
                console.error('Erro ao excluir o pedido:', error);
                alert('Erro ao excluir o pedido');
            });
    });

    

        function mostrarDetalhesCliente(idNotificacao) {
            fetch(`/adm/notificacoes/show/${idNotificacao}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes da notificação');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    // Preencha os campos do modal com os dados do cliente, ou valores padrão
                    document.getElementById('detalhesIdCliente').value = data.notificacoes_clientes[0].idClientes || '';
                    document.getElementById('detalhesIdPedidoC').value = data.notificacoes_clientes[0].idPedidos || '';
                    document.getElementById('detalhesLidoC').value = data.lido || '';



                    // Abra o modal de detalhes do pedido
                    $('#modalDetalhesNotificacaoClientes').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do produto:', error);
                });
        }
        function mostrarDetalhesColaborador(idNotificacao) {
            fetch(`/adm/notificacoes/show/${idNotificacao}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes da notificação');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    // Preencha os campos do modal com os dados do cliente, ou valores padrão
                    document.getElementById('detalhesIdAdmin').value = data.notificacoes_colaboradores[0].idAdmins || '';
                    document.getElementById('detalhesIdPedidoA').value = data.notificacoes_colaboradores[0].idPedidos || '';
                    document.getElementById('detalhesLidoA').value = data.lido || '';



                    // Abra o modal de detalhes do pedido
                    $('#modalDetalhesNotificacaoColaboradores').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do produto:', error);
                });
        }

        function carregarDadosParaEdicaoCliente(idNotificacao) {
            fetch(`/adm/notificacoes/show/${idNotificacao}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do agendamento');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Dados recebidos:', data);
                    document.getElementById('editarIdNotificacaoC').value = data.id || "";
                    // Preencher os campos do formulário com os dados do cliente
                    // Verifica se existe notificacoesClientes e usa o primeiro item se disponível

                    document.getElementById('editarIdClientesC').value = data.notificacoes_clientes[0].idClientes || "";
                    document.getElementById('editarIdPedidosC').value = data.notificacoes_clientes[0].idPedidos || "";

                    document.getElementById('editarTituloC').value = data.titulo || "";
                    document.getElementById('editarMensagemC').value = data.mensagem || "";

                    // Abrir o modal de edição do cliente
                    $('#modalEditarNotificacaoCliente').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do produto:', error);
                });
        }

        function carregarDadosParaEdicaoColaborador(idNotificacao) {
            fetch(`/adm/notificacoes/show/${idNotificacao}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do agendamento');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Dados recebidos:', data);

                    document.getElementById('editarIdNotificacaoA').value = data.id || "";
                    document.getElementById('editarIdAdminsA').value = data.notificacoes_colaboradores[0].idAdmins || "";
                    document.getElementById('editarIdPedidosA').value = data.notificacoes_colaboradores[0].idPedidos || "";

                    document.getElementById('editarTituloA').value = data.titulo || "";
                    document.getElementById('editarMensagemA').value = data.mensagem || "";

                    // Abrir o modal de edição do cliente
                    $('#modalEditarNotificacaoColaborador').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do produto:', error);
                });
        }

    </script>
    @endsection