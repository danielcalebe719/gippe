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

    
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pedidos</h6>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarPedido">Adicionar
                        Pedido</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Serviço</th>
                                <th>STATUS</th>
                                <th>Total Pedido</th>
                                <th>Data Entrega</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($pedidosPendentes as $pedido)
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->cliente->nome }}</td>
                                    <td>{{  $pedido->servico->nome ?? 'Nome do serviço não disponível' }}</td>
                                    <td>{{ $pedido->getStatus() }}</td>
                                    <td>{{ $pedido->totalPedido }}</td>
                                    <td>{{ $pedido->dataEntrega }}</td>

                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

                                        <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button type="button" class="btn btn-success btn-sm"
                                                    onclick="">
                                                    Aceitar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $pedido->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarPedido">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $pedido->id }}')">
                                                    Excluir
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pedidoModal" data-id="{{ $pedido->id }}">
                                                Ver Produtos
                                            </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $pedido->id }}')" data-toggle="modal"
                                                    data-target="#modalDetalhesPedido">
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
        
  
        <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pedidos</h6>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarPedido">Adicionar
                        Pedido</button>
                </div>
<div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Servico</th>
                                <th>STATUS</th>
                                <th>Total Pedido</th>
                                <th>Data Entrega</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($outrosPedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->cliente->nome }}</td>
                                    <td>{{ $pedido->servico->nome ?? 'Nome do serviço não disponível' }}</td>
                                    <td>{{ $pedido->getStatus() }}</td>
                                    <td>{{ $pedido->totalPedido }}</td>
                                    <td>{{ $pedido->dataEntrega }}</td>

                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $pedido->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarPedido">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $pedido->id }}')">
                                                    Excluir
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pedidoModal" data-id="{{ $pedido->id }}">
                                                Ver Produtos
                                            </button>
                                            </div>

                                            


                                            <div class="btn-group" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $pedido->id }}')" data-toggle="modal"
                                                    data-target="#modalDetalhesPedido">
                                                    Detalhes
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <!-- Modal -->
    <div class="modal fade" id="pedidoModal" tabindex="-1" role="dialog" aria-labelledby="pedidoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pedidoModalLabel">Produtos do Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table >
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço Unitário</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="pedidoProdutosBody">
                            <!-- Conteúdo será preenchido via JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>



    <script>
    $('#pedidoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botão que acionou o modal
        var pedidoId = button.data('id'); // Extrair informação dos atributos data-*

        var modal = $(this);
        var modalTitle = modal.find('.modal-title');
        var modalBody = modal.find('#pedidoProdutosBody');

        // Limpar o conteúdo do modal
        modalTitle.text('Produtos do Pedido #' + pedidoId);
        modalBody.empty();

        // Fazer a requisição AJAX para obter os produtos do pedido
        $.ajax({
            url: '/pedidos/' + pedidoId,
            method: 'GET',
            success: function (data) {
                data.pedidos_produtos.forEach(function (pedidoProduto) {
                    var produto = pedidoProduto.produto;
                    var row = `
                        <tr>
                            <td>${produto.nome}</td>
                            <td>${produto.descricao}</td>
                            <td>${produto.precoUnitario}</td>
                            <td>${pedidoProduto.quantidade}</td>
                            <td>${pedidoProduto.subtotal}</td>
                        </tr>
                    `;
                    modalBody.append(row);
                });
            }
        });
    });
</script>




    
    

    <!-- Modal Adicionar Pedido -->
    <div class="modal fade" id="modalAdicionarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarPedido" method="POST" action="/adm/pedidos/guardar"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="Cliente ID">Cliente ID</label>
                            <input type="text" class="form-control" id="idCliente" name="idCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="Cliente ID">Serviço ID</label>
                            <input type="text" class="form-control" id="idServico" name="idServico" required>
                        </div>
                        <div class="form-group">
                            <label for="observacao">Observação</label>
                            <input type="text" class="form-control" id="observacao" name="observacao" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                            @foreach(App\Models\Pedidos::getStatusArray() as $chave=>$valor)
                                <option value="{{$chave}}">{{$valor}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Total Pedido">Total Pedido</label>
                            <input type="Total Pedido" class="form-control" id="totalPedido" name="totalPedido"
                                required>
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
        document.getElementById('confirmarExclusao').addEventListener('click', function () {
            var idPedido = document.getElementById('excluirIdPedido').value;

            // Enviar requisição AJAX para excluir o cliente
            fetch(`/adm/pedidos/remover/${idPedido}`, {
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
                    $('#modalConfirmarExclusao').modal('hide');

                    // Remover a linha do cliente na tabela, se existir
                    let pedidoRow = document.getElementById(`pedidoRow${idPedido}`);
                    if (pedidoRow) {
                        pedidoRow.remove();
                    } else {
                        console.warn(`Elemento pedidoRow${idPedido} não encontrado para remoção.`);
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


        // Função para excluir o cliente sem modal de confirmação
        function excluirCliente(idCliente) {

            if (confirm('Tem certeza que deseja excluir este cliente?')) {

                return false;
                fetch(`/adm/clientes/remover/${idCliente}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro ao excluir o cliente');
                        }
                        return response.json();
                    })
                    .then(data => {
                        location.replace(location.href)
                        console.log('Cliente excluído com sucesso:', data.message);

                        let clienteRow = document.getElementById(`clienteRow${idCliente}`);
                        if (clienteRow) {
                            clienteRow.remove();
                        } else {
                            console.warn(`Elemento clienteRow${idCliente} não encontrado para remoção.`);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        console.error('Erro ao excluir o cliente:', error);
                    });
            }
        }
    </script>
    <!-- Modal Editar Pedido -->
    <div class="modal fade" id="modalEditarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarPedido" method="POST" action="/adm/pedidos/guardar"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="EditarIdPedido" name="idPedido" value="">
                        <div class="form-group">

                            <label for="editClienteID">Cliente ID</label>
                            <input type="text" class="form-control" id="EditarIdCliente" name="idCliente" value=""
                                required readonly>
                        </div>
                        <div class="form-group">

                            <label for="editClienteID">Serviço ID</label>
                            <input type="text" class="form-control" id="EditarIdServico" name="idServico" value=""
                                required readonly>
                        </div>
                        <div class="form-group">
                            <label for="editobservacao">Observação</label>
                            <input type="text" class="form-control" id="EditarObservacao" name="observacao" value=""
                                required>
                        </div>

                        <div class="form-group">
                            <label for="editDataEntrega">Data de Entrega</label>
                            <input type="date" class="form-control" id="EditarDataEntrega" name="dataEntrega" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select class="form-control" id="EditarStatus" name="status" required>
                                @foreach(App\Models\Pedidos::getStatusArray() as $chave=>$valor)
                                <option value="{{$chave}}">{{$valor}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editTotal Pedido">Total Pedido</label>
                            <input type="Total Pedido" class="form-control" id="EditarTotalPedido" name="totalPedido"
                                value="" required>
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

<div class="modal fade" id="modalDetalhesPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                    <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Pedido ID:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="DetalhesIdPedidos" name="idPedidos" value=""
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Serviço ID:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="DetalhesIdServicos" name="idServicos" value=""
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="DetalhesObservacao" class="col-sm-3 col-form-label">Observação:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="DetalhesObservacao" value="" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="DetalhesObservacao" class="col-sm-3 col-form-label">Código:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="DetalhesCodigo" value="" readonly>
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
<div class="modal fade" id="modalFeedbackPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                document.getElementById('DetalhesIdPedidos').value = data.id || '';
                document.getElementById('DetalhesIdServicos').value = data.idServicos || '';
                document.getElementById('DetalhesObservacao').value = data.observacao || '';
                document.getElementById('DetalhesCodigo').value = data.codigo || '';
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
                    throw new Error('Erro ao carregar os detalhes do pedido');
                }
                return response.json();
            })
            .then(data => {
                console.log('API Response:', data);
                // Preencher os campos do formulário com os dados do cliente
                document.getElementById('EditarIdPedido').value = data.id;
                document.getElementById('EditarIdCliente').value = data.idClientes;
                document.getElementById('EditarIdServico').value = data.idServicos;
                document.getElementById('EditarObservacao').value = data.observacao;
                document.getElementById('EditarDataEntrega').value = data.dataEntrega;
                document.getElementById('EditarStatus').value = data.status;
                document.getElementById('EditarTotalPedido').value = data.totalPedido;

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


    $(document).ready(function () {
        $('#dataTableHover').DataTable(); // Initialize the DataTable
    });
</script>
@endsection