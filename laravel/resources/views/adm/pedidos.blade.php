@extends('adm.templates.template')

@section('title', 'Pedidos')

@section('content')






<style>
    .alert {
        display: none;
    }
</style>




<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pedidos</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Pedidos</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pedidos</h6>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarPedido">Adicionar Pedido</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Cliente ID</th>
                                <th>STATUS</th>
                                <th>Total Pedido</th>
                                <th>Data Entrega</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->idPedidos }}</td>
                                <td>{{ $pedido->idCliente }}</td>
                                <td>{{ $pedido->status }}</td>
                                <td>{{ $pedido->totalPedido }}</td>
                                <td>{{ $pedido->dataEntrega }}</td>
                                
                                <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-primary btn-sm" onclick="carregarDadosParaEdicao('{{ $pedido->idPedidos }}')" data-toggle="modal" data-target="#modalEditarPedido">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="abrirModalExclusao('{{ $pedido->idPedidos }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-info btn-sm" onclick="mostrarDetalhes('{{ $pedido->idPedidos }}')" data-toggle="modal" data-target="#modalDetalhesPedido">
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

    <!-- Modal Adicionar Pedido -->
    <div class="modal fade" id="modalAdicionarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarPedido" method="POST" action="{{ route('pedidos.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="acao" id="acao" value="adicionar">
                            <label for="Cliente ID">Cliente ID</label>
                            <input type="text" class="form-control" id="idCliente" name="idCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="observacao">Observação</label>
                            <input type="text" class="form-control" id="observacao" name="observacao" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="pendente">Pendente</option>
                                <option value="aceito">Aceito</option>
                                <option value="cancelado">Cancelado</option>
                                <option value="entregue">Entregue</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Total Pedido">Total Pedido</label>
                            <input type="Total Pedido" class="form-control" id="totalPedido" name="totalPedido" required>
                        </div>
                        <div class="form-group">
                            <label for="dataEntrega">Data Entrega</label>
                            <input type="date" class="form-control" id="dataEntrega" name="dataEntrega" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Exclusão -->
    <div class="modal fade" id="modalConfirmarExclusao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmarExclusaoLabel" aria-hidden="true">
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
                        <input type="hidden" id="excluirIdPedido">
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
            function abrirModalExclusao(idPedido) {
                document.getElementById('excluirIdPedido').value = idPedido;
                $('#modalConfirmarExclusao').modal('show');
            }

            // Função para confirmar a exclusão
            document.getElementById('confirmarExclusao').addEventListener('click', function() {
                var idCliente = document.getElementById('excluirIdPedido').value;

                // Enviar requisição AJAX para excluir o cliente
                fetch(`/adm/pedidos/${idPedido}`, {
                        method: 'DELETE',
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
                        $('#modalConfirmarExclusao').modal('hide');

                        // Remover a linha do cliente na tabela, se existir
                        let pedidoRow = document.getElementById(`pedidoRow${idPedido}`);
                        if (pedidoRow) {
                            pedidoRow.remove();
                        } else {
                            console.warn(`Elemento pedidoRow${idPedido} não encontrado para remoção.`);
                        }

                        // Exibir mensagem de sucesso
                        alert('Pedido excluído com sucesso');
                    })
                    .catch(error => {
                        console.error('Erro ao excluir o pedido:', error);
                        alert('Erro ao excluir o pedido');
                    });
            });

            // Função para excluir o cliente sem modal de confirmação
            function excluirCliente(idPedido) {
                if (confirm('Tem certeza que deseja excluir este pedido?')) {
                    fetch(`/adm/pedidos/${idPedido}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erro ao excluir o pedido');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Pedido excluído com sucesso:', data.message);
                            // Atualizar a lista de clientes ou tomar outra ação necessária
                            let pedidoRow = document.getElementById(`pedidoRow${idPedido}`);
                            if (pedidoRow) {
                                pedidoRow.remove();
                            } else {
                                console.warn(`Elemento pedidoRow${idPedido} não encontrado para remoção.`);
                            }
                        })
                        .catch(error => {
                            console.error('Erro ao excluir o pedido:', error);
                        });
                }
            }
        </script>

    <!-- Modal Editar Pedido -->
    <div class="modal fade" id="modalEditarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarPedido" method="POST"action="{{ route('pedidos.update', ['idPedidos' => $pedido->idPedidos]) }}" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT') <!-- Utiliza o método PUT para atualização -->
                        <div class="form-group">
                            <input type="hidden" name="acao" id="acao" value="editar">
                            <label for="editID">ID</label>
                            <input type="text" class="form-control" id="EditarIdPedido" name="idPedidos" value="" required>
                        </div>
                        <div class="form-group">

                            <label for="editClienteID">Cliente ID</label>
                            <input type="text" class="form-control" id="EditarIdCliente" name="idCliente" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="editobservacao">Observação</label>
                            <input type="text" class="form-control" id="EditarObservacao" name="observacao" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="editDataEntrega">Data de Entrega</label>
                            <input type="date" class="form-control" id="EditarDataEntrega" name="dataEntrega" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select class="form-control" id="EditarStatus" name="status" required>
                                <option value="Pendente">Pendente</option>
                                <option value="Aceito">Aceito</option>
                                <option value="Cancelado">Cancelado</option>
                                <option value="Entregue">Entregue</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editTotal Pedido">Total Pedido</label>
                            <input type="Total Pedido" class="form-control" id="EditarTotalPedido" name="totalPedido" value="" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<footer class="sticky-footer bg-white">
    <div class="container my-auto">

    </div>
</footer>
</div>
</div>
<footer class="sticky-footer bg-white">
    <div class="container my-auto">

    </div>
</footer>
</div>
</div>

<!-- Modal Detalhes Pedido -->

<div class="modal fade" id="modalDetalhesPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="pedidoContent" class="modal-body">

                <div class="form-group row">
                    <input type="hidden" name="acao" id="acao" value="editar">
                    <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Pedido ID:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="DetalhesIdPedidos" name="idPedidos" value="" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="DetalhesObservacao" class="col-sm-3 col-form-label">Observação:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="DetalhesObservacao" value="" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="DetalhesDataPedido" class="col-sm-3 col-form-label">Data de Pedido:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="DetalhesDataPedido" value="" readonly>
                    </div>
                </div>

                <!-- Botão para abrir modal de feedback -->
                <button type="button" class="btn btn-info btn-sm" id="btnFeedback">Visualizar Feedback</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Feedback do Pedido -->
<div class="modal fade" id="modalFeedbackPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Feedback do Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aqui serão exibidos os detalhes do feedback do pedido -->
                <div id="feedbackContent"></div>
            </div>
        </div>
    </div>
</div>


<script>
  function mostrarDetalhes(idPedido) {
    fetch(`/adm/pedidos/show/${idPedido}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao carregar os detalhes do pedido');
            }
            return response.json();
        })
        .then(data => {
            // Preencha os campos do modal com os dados do cliente, ou valores padrão
            document.getElementById('DetalhesIdPedidos').value = data.idPedidos || '';
            document.getElementById('DetalhesObservacao').value = data.observacao || '';
            document.getElementById('DetalhesDataPedido').value = data.dataPedido ? formatarData(data.dataPedido) : '';
           

           

            // Abra o modal de detalhes do pedido
            $('#modalDetalhesPedido').modal('show');
        })
        .catch(error => {
            console.error('Erro ao carregar os detalhes do pedido:', error);
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
        function carregarDadosParaEdicao(idPedido) {
            fetch(`/adm/pedidos/show/${idPedido}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do cliente');
                    }
                    return response.json();
                })
                .then(data => {
                    // Preencher os campos do formulário com os dados do cliente
                    document.getElementById('EditarIdPedidos').value = data.idPedidos;
                    document.getElementById('EditarIdCliente').value = data.idCliente;
                    document.getElementById('EditarObservacao').value = data.nome;
                    document.getElementById('EditarDataEntrega').value = data.cpf;
                    document.getElementById('EditarStatus').value = data.dataNascimento;
                    document.getElementById('EditarTotalPedido').value = data.status;

                    // Abrir o modal de edição do cliente
                    $('#modalEditarPedido').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do pedido:', error);
                });
        }
    </script>

    <script>
        // $(document).ready(function () {
        //     // Abrir o modal de detalhes ao clicar no botão
        //     $('#dataTableHover').on('click', '.btn-detalhes', function () {
        //         $('#modalDetalhesPedido').modal('show');
        //     });
        // });


        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>
@endsection