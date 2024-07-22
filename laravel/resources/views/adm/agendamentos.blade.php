@extends('adm.templates.template')

@section('title', 'Agendamentos')

@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Agendamentos</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Agendamentos</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Agendamentos</h6>
                    <button class="btn btn-primary" data-toggle="modal"
                        data-target="#modalAdicionarAgendamento">Adicionar Agendamento</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Pedido ID</th>
                                <th>Data Inicio</th>
                                <th>Data Fim</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fim</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agendamentos as $agendamento)
                                <tr>
                                    <td>{{ $agendamento->id }}</td>
                                    <td>{{ $agendamento->idPedidos }}</td>
                                    <td>{{ $agendamento->dataInicio }}</td>
                                    <td>{{ $agendamento->dataFim }}</td>
                                    <td>{{ $agendamento->horaInicio }}</td>
                                    <td>{{ $agendamento->horaFim }}</td>

                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $agendamento->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarAgendamento">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $agendamento->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $agendamento->id }}')" data-toggle="modal"
                                                    data-target="#modalDetalhesAgendamento">
                                                    Detalhes
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Agendamento -->
    <div class="modal fade" id="modalAdicionarAgendamento" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Agendamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarAgendamento" method="POST" action="/adm/agendamentos/guardar">
                        @csrf
                        <div class="form-group">
                            <label for="PedidoID">PedidoID</label>
                            <input type="text" class="form-control" id="idPedidos" name="idPedidos" required>
                        </div>
                        <div class="form-group">
                            <label for="DataInicio">Data Inicio</label>
                            <input type="date" class="form-control" id="dataInicio" name="dataInicio" required>
                        </div>
                        <div class="form-group">
                            <label for="dataFim">Data Fim</label>
                            <input type="date" class="form-control" id="dataFim" name="dataFim" required>
                        </div>
                        <div class="form-group">
                            <label for="HoraInicio">Hora Inicio</label>
                            <input type="time" class="form-control" id="horaInicio" name="horaInicio" required>
                        </div>
                        <div class="form-group">
                            <label for="HoraFim">Hora Fim</label>
                            <input type="time" class="form-control" id="horaFim" name="horaFim" required>
                        </div>
                        <div class="form-group">
                            <label for="HoraFim">Observação:</label>
                            <input type="text" class="form-control" id="observacao" name="observacao" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <!-- Modal Confirmar Exclusão -->
 <div class="modal fade" id="modalConfirmarExclusao" tabindex="-1" role="dialog"
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
                    <input type="hidden" id="excluirIdAgendamento">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarExclusao">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Função para abrir o modal de confirmação de exclusão
    function abrirModalExclusao(idAgendamento) {
        document.getElementById('excluirIdAgendamento').value = idAgendamento;
        $('#modalConfirmarExclusao').modal('show');
    }

    // Função para confirmar a exclusão
    document.getElementById('confirmarExclusao').addEventListener('click', function () {
        var idAgendamento = document.getElementById('excluirIdAgendamento').value;

        // Enviar requisição AJAX para excluir o cliente
        fetch(`/adm/agendamentos/remover/${idAgendamento}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao excluir o produto');
                }
                return response.json();
            })
            .then(data => {
                // Fechar o modal de confirmação de exclusão
                $('#modalConfirmarExclusao').modal('hide');

                // Remover a linha do cliente na tabela, se existir
                let agendamentoRow = document.getElementById(`agendamentoRow${idAgendamento}`);
                if (agendamentoRow) {
                    agendamentoRow.remove();
                } else {
                    console.warn(`Elemento agendamentoRow${idAgendamento} não encontrado para remoção.`);
                }

                // Exibir mensagem de sucesso
                location.replace(location.href)

            })
            .catch(error => {
                console.log(error)
                console.error('Erro ao excluir o produto:', error);
                alert('Erro ao excluir o produto');
            });
    });


</script>

    <!-- Modal Editar Agendamento -->
    <div class="modal fade" id="modalEditarAgendamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Agendamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarAgendamento" method="POST" action="/adm/agendamentos/guardar" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editarIdAgendamento" name="idAgendamento" value="">
                        <div class="form-group">
                            <label for="editPedidoID">PedidoID</label>
                            <input type="text" class="form-control" id="editarIdPedidos" name="idPedidos" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="editData Inicio">Data Inicio</label>
                            <input type="date" class="form-control" id="editarDataInicio" name="dataInicio" required>
                        </div>
                        <div class="form-group">
                            <label for="editDataFim">Data Fim</label>
                            <input type="date" class="form-control" id="editarDataFim" name="dataFim" required>
                        </div>
                        <div class="form-group">
                            <label for="editHora Inicio">Hora Inicio</label>
                            <input type="time" class="form-control" id="editarHoraInicio" name="horaInicio"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="editHora Fim">Hora Fim</label>
                            <input type="time" class="form-control" id="editarHoraFim" name="horaFim" required>
                        </div>
                        <div class="form-group">
                            <label for="editHora Fim">Observação</label>
                            <input type="text" class="form-control" id="editarObservacao" name="observacao" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</div>
</div>

</div>
</div>

<script>
    function carregarDadosParaEdicao(idAgendamento) {
        fetch(`/adm/agendamentos/show/${idAgendamento}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do agendamento');
                }
                return response.json();
            })
            .then(data => {
                console.log('API Response:', data);
                // Preencher os campos do formulário com os dados do cliente
                document.getElementById('editarIdAgendamento').value = data.id;
                document.getElementById('editarIdPedidos').value = data.idPedidos;
                document.getElementById('editarDataInicio').value = data.dataInicio;
                document.getElementById('editarDataFim').value = data.dataFim;
                document.getElementById('editarHoraInicio').value = data.horaInicio;
                document.getElementById('editarHoraFim').value = data.horaFim;
                document.getElementById('editarObservacao').value = data.observacao;
                

                // Abrir o modal de edição do cliente
                $('#modalEditarAgendamento').modal('show');
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes do produto:', error);
            });
    }
</script>


<!-- Modal Detalhes Agendamento -->
<div class="modal fade" id="modalDetalhesAgendamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Agendamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="detalhesData Inicio" class="col-sm-3 col-form-label">Observação:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesObservacao" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesDataCadastro" class="col-sm-3 col-form-label">Data de Cadastro:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesDataCadastro" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesDataAtualizacao" class="col-sm-3 col-form-label">Data de Atualização:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesDataAtualizacao" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrarDetalhes(idAgendamento) {
        fetch(`/adm/agendamentos/show/${idAgendamento}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do agendamento');
                }
                return response.json();
            })
            .then(data => {
                // Preencha os campos do modal com os dados do cliente, ou valores padrão
                document.getElementById('detalhesObservacao').value = data.observacao || '';
                document.getElementById('detalhesDataCadastro').value = data.dataCadastro ? formatarData(data.dataCadastro) : '';
                document.getElementById('detalhesDataAtualizacao').value = data.dataAtualizacao ? formatarData(data.dataAtualizacao) : '';
                


                // Abra o modal de detalhes do pedido
                $('#modalDetalhesAgendamento').modal('show');
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes do produto:', error);
            });
    }

    function formatarData(data) {
        // Formato de exibição de data desejado
        let options = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        };
        return new Date(data).toLocaleDateString('pt-BR', options);
    }


</script>

<script>

    $(document).ready(function () {
        // Abrir o modal de detalhes ao clicar no botão
        $('#dataTableHover').on('click', '.btn-detalhes', function () {
            $('#modalDetalhesAgendamento').modal('show');
        });
    });


    $(document).ready(function () {
        $('#dataTableHover').DataTable(); // Initialize the DataTable
    });
</script>

@endsection