@extends('adm.templates.template')

@section('title', 'Pedidos')

@section('content')






<style>
    .alert {
        display: none;
    }

    #detalhesServico,
    #detalhesProdutos,
    #detalhesAgendamento {
        display: none;
    }

    .star-rating i {
    color: gold;
    font-size: 1.5em;
    margin-right: 0.1em;
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
            <h6 class="m-0 font-weight-bold text-primary">Pedidos em análise</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarPedido">Adicionar
                Pedido</button>
        </div>

        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTablePendente">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Serviço</th>
                        <th>STATUS</th>
                        <th>Total Pedido</th>
                        <th>Data de Entrega</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pedidosPendentes as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->codigo }}</td>
                            <td>{{ $pedido->cliente->nome }}</td>
                            <td>{{  $pedido->servico->nome ?? 'Nome do serviço não disponível' }}</td>
                            <td>{{ $pedido->getStatus() }}</td>
                            <td>{{ $pedido->totalPedido }}</td>
                            <td>{{ $pedido->dataEntrega }}</td>

                            <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

                                    <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                        <button class="btn btn-info btn-sm" onclick="mostrarDetalhes('{{ $pedido->id }}')"
                                            data-toggle="modal" data-target="#modalDetalhesPedido">
                                            Detalhes
                                        </button>
                                    </div>

                                    <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                        <button type="button" class="btn btn-success btn-sm"
                                            onclick="abrirModalAceitarPedido('{{ $pedido->id }}')">
                                            Aceitar
                                        </button>
                                    </div>

                                    <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                        <button class="btn btn-primary btn-sm"
                                            onclick="carregarDadosParaEdicao('{{ $pedido->id }}')" data-toggle="modal"
                                            data-target="#modalEditarPedido">
                                            Editar
                                        </button>
                                    </div>

                                    <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="abrirModalExclusao('{{ $pedido->id }}')">
                                            Excluir
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






    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pedidos</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarPedido">Adicionar
                Pedido</button>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableNormal">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
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
                            <td>{{ $pedido->codigo }}</td>
                            <td>{{ $pedido->cliente->nome }}</td>
                            <td>{{ $pedido->servico->nome ?? 'Nome do serviço não disponível' }}</td>
                            <td>{{ $pedido->getStatus() }}</td>
                            <td>{{ $pedido->totalPedido }}</td>
                            <td>{{ $pedido->dataEntrega }}</td>

                            <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                        <button class="btn btn-primary btn-sm"
                                            onclick="carregarDadosParaEdicao('{{ $pedido->id }}')" data-toggle="modal"
                                            data-target="#modalEditarPedido">
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
                                        <button class="btn btn-info btn-sm" onclick="mostrarDetalhes('{{ $pedido->id }}')"
                                            data-toggle="modal" data-target="#modalDetalhesPedido">
                                            Detalhes
                                        </button>
                                    </div>

                                    <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                        <button class="btn btn-success btn-sm" onclick="mostrarFeedback('{{ $pedido->id }}')"
                                            data-toggle="modal" >
                                            Feedback
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


    <!-- Modal Aceitar -->
    <div class="modal fade" id="modalAceitarPedido" tabindex="-1" role="dialog"
        aria-labelledby="modalAceitarPedidoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAceitarPedidoLabel">Aceitar Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza de que deseja aceitar este pedido?</p>
                    <input type="hidden" id="aceitarIdPedido">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="aceitarPedido">Aceitar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="pedidoModal" tabindex="-1" role="dialog" aria-labelledby="pedidoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pedidoModalLabel">Produtos do Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
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
                                @foreach(App\Models\Pedidos::getStatusArray() as $chave => $valor)
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
                                @foreach(App\Models\Pedidos::getStatusArray() as $chave => $valor)
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
                    <!-- Menu -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="detalhes-tab" data-bs-toggle="tab"
                                data-bs-target="#detalhes" type="button" role="tab" aria-controls="detalhes"
                                aria-selected="false">Detalhes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="produtos-tab" data-bs-toggle="tab" data-bs-target="#produtos"
                                type="button" role="tab" aria-controls="produtos"
                                aria-selected="false">Produtos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="servico-tab" data-bs-toggle="tab" data-bs-target="#servico"
                                type="button" role="tab" aria-controls="servico" aria-selected="false">Serviço</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="agendamento-tab" data-bs-toggle="tab" data-bs-target="#agendamento"
                                type="button" role="tab" aria-controls="agendamento" aria-selected="false">Agendamento</button>
                        </li>
                    </ul>
                    <br>
                    <div id="detalhes">
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Pedido ID:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesIdPedidos" name="idPedidos" value=""
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
                    </div>

                    <div id="detalhesAgendamento">
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Data de início:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesDataInicio" name="dataInicio" value=""
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesObservacao" class="col-sm-3 col-form-label">Data do fim:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesDataFim" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesObservacao" class="col-sm-3 col-form-label">Hora de início:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesHoraInicio" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesDataPedido" class="col-sm-3 col-form-label">Hora do fim:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesHoraFim" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesDataPedido" class="col-sm-3 col-form-label">Observação:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesObservacaoAgendamento" value="" readonly>
                            </div>
                        </div>
                    </div>

                    <div id="detalhesProdutos">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Subtotal</th>

                                </thead>
                                <tbody id="tbodyDetalhesProdutos">

                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="form-group row">
                        <label for="DetalhesObservacao" class="col-sm-3 col-form-label">Observação:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="DetalhesObservacao" value="" readonly>
                        </div>
                    </div> -->
                        <!-- produtos.nome
                    pedidos_produtos.quantidade
                    pedidos_produtos.subtotal -->

                    </div>

                    <div id="detalhesServico">
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Serviço ID:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesIdServicos" name="idServicos"
                                    value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Nome do serviço:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesNome" name="idServicos" value=""
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Total do serviço:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesTotalServico" name="idServicos"
                                    value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Duração em horas:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesDuracao" name="idServicos" value=""
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Quantidade de pessoas:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesQuantidadePessoas" name="idServicos"
                                    value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Quantidade de garçons:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesGarcons" name="idServicos" value=""
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Quantidade de
                                cozinheiros:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesCozinheiros" name="idServicos"
                                    value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Quantidade de barmans:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="DetalhesBarmans" name="idServicos" value=""
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Botão para abrir modal de feedback -->
                    
                </div>

            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Modal Feedback do Pedido -->
<div class="modal fade" id="modalFeedbackPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                        <input type="hidden" class="form-control" id="DetalhesIdFeedback" readonly>
                   

                <div class="form-group row">
                    <label for="detalhesMensagem" class="col-sm-3 col-form-label">Mensagem:</label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" id="DetalhesMensagem" rows="5" cols="3" readonly></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesAvaliacao" class="col-sm-3 col-form-label">Avaliação:</label>
                    <div class="col-sm-9">
                        <div id="DetalhesAvaliacao" class="star-rating"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrarFeedback(idPedidos) {
    fetch(`/adm/pedidos/showFeedback/${idPedidos}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao carregar os detalhes do feedback');
            }
            return response.json();
        })
        .then(data => {
            console.log('Dados recebidos:', data); // Verifique os dados recebidos no console

            // Preenche os campos do modal com os dados do feedback
            document.getElementById('DetalhesIdFeedback').value = data[0].id;
            document.getElementById('DetalhesMensagem').value = data[0].mensagem;

            // Preenche as estrelas de acordo com a avaliação
            const avaliacao = data[0].avaliacao;
            const starContainer = document.getElementById('DetalhesAvaliacao');
            starContainer.innerHTML = ''; // Limpa qualquer estrela existente

            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('i');
                star.className = i <= avaliacao ? 'fas fa-star' : 'far fa-star';
                starContainer.appendChild(star);
            }

            // Abre o modal de feedback
            $('#modalFeedbackPedido').modal('show');
        })
        .catch(error => {
            console.error('Erro ao carregar os detalhes do feedback:', error);
        });
}



</script>
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
                
                // Preencha os campos do modal com os dados do pedido
                document.getElementById('DetalhesIdPedidos').value = data.id || '';
                document.getElementById('DetalhesObservacao').value = data.observacao || '';
                document.getElementById('DetalhesCodigo').value = data.codigo || '';
                document.getElementById('DetalhesDataPedido').value = data.dataPedido ? formatarData(data.dataPedido) : '';

                // Resetar campos de serviços para evitar dados residuais
                document.getElementById('DetalhesIdServicos').value = '';
                document.getElementById('DetalhesNome').value = '';
                document.getElementById('DetalhesTotalServico').value = '';
                document.getElementById('DetalhesDuracao').value = '';
                document.getElementById('DetalhesQuantidadePessoas').value = '';
                document.getElementById('DetalhesGarcons').value = '';
                document.getElementById('DetalhesCozinheiros').value = '';
                document.getElementById('DetalhesBarmans').value = '';

                // Preencher campos de serviços se existirem
                if (data.pedidos_servicos && data.pedidos_servicos.length > 0) {
                    data.pedidos_servicos.forEach(pedidos_servico => {
                        const servico = pedidos_servico.servico;

                        // Preencher campos comuns de serviço
                        document.getElementById('DetalhesIdServicos').value = servico.id || '';
                        document.getElementById('DetalhesNome').value = servico.nome || '';
                        document.getElementById('DetalhesTotalServico').value = servico.totalServicos || '';
                        document.getElementById('DetalhesDuracao').value = servico.duracaoHoras || '';
                        document.getElementById('DetalhesQuantidadePessoas').value = servico.quantidadePessoas || '';

                        // Preencher campos específicos de tipos de funcionários
                        if (pedidos_servico.funcionarioTipo === "Garcom") {
                            document.getElementById('DetalhesGarcons').value = pedidos_servico.quantidade || '';
                        } else if (pedidos_servico.funcionarioTipo === "Cozinheiro") {
                            document.getElementById('DetalhesCozinheiros').value = pedidos_servico.quantidade || '';
                        } else if (pedidos_servico.funcionarioTipo === "Barman") {
                            document.getElementById('DetalhesBarmans').value = pedidos_servico.quantidade || '';
                        }
                    });
                }

                $('#tbodyDetalhesProdutos').empty();

                // Preencher campos de serviços se existirem
                if (data.pedidos_produtos && data.pedidos_produtos.length > 0) {
                    data.pedidos_produtos.forEach(pedidos_produto => {
                        const produto = pedidos_produto.produto;


                        $('#tbodyDetalhesProdutos').append(
                            "<tr>" +
                            "<td>" + produto.nome + "</td>" +
                            "<td>" + pedidos_produto.quantidade + "</td>" +
                            "<td>" + pedidos_produto.subtotal + "</td>" +

                            "</tr>"
                        );



                    });
                }

                
                    
                        

                        // Preencher campos comuns de serviço
                        document.getElementById('DetalhesDataInicio').value = data.agendamento.dataInicio || '';
                        document.getElementById('DetalhesDataFim').value = data.agendamento.dataFim || '';
                        document.getElementById('DetalhesHoraInicio').value = data.agendamento.horaInicio || '';
                        document.getElementById('DetalhesHoraFim').value = data.agendamento.horaFim || '';
                        document.getElementById('DetalhesObservacaoAgendamento').value = data.agendamento.observacao || '';

                        
                    
                

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
    $("#produtos-tab").click(function () {
        $("#detalhes").hide();
        $("#detalhesProdutos").show();
        $("#detalhesServico").hide();
        $("#detalhesAgendamento").hide();
        $("button").removeClass('active');
        $("#produtos-tab").addClass('active');
    });

    $("#servico-tab").click(function () {
        $("#detalhes").hide();
        $("#detalhesProdutos").hide();
        $("#detalhesServico").show();
        $("#detalhesAgendamento").hide();
        $("button").removeClass('active');
        $("#servico-tab").addClass('active');
    });

    $("#detalhes-tab").click(function () {
        $("#detalhes").show();
        $("#detalhesProdutos").hide();
        $("#detalhesServico").hide();
        $("#detalhesAgendamento").hide();
        $("button").removeClass('active');
        $("#detalhes-tab").addClass('active');
    });

    $("#agendamento-tab").click(function () {
        $("#detalhes").hide();
        $("#detalhesProdutos").hide();
        $("#detalhesServico").hide();
        $("#detalhesAgendamento").show();
        $("button").removeClass('active');
        $("#agendamento-tab").addClass('active');
    });




</script>
<script>
    function aceitarPedido(idPedido) {
        fetch(`/adm/pedidos/aceitar/${idPedido}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao excluir o pedido');
                }
                location.reload();
            })

    }
</script>

<script>
    // Função para abrir o modal de confirmação de exclusão
    function abrirModalAceitarPedido(idPedido) {
        document.getElementById('aceitarIdPedido').value = idPedido;
        $('#modalAceitarPedido').modal('show');
    }

    // Função para confirmar a exclusão
    document.getElementById('aceitarPedido').addEventListener('click', function () {
        var idPedido = document.getElementById('aceitarIdPedido').value;

        // Enviar requisição AJAX para excluir o cliente
        fetch(`/adm/pedidos/aceitar/${idPedido}`, {
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
                $('#modalAceitarPedido').modal('hide');



                // Exibir mensagem de sucesso
                location.replace(location.href)

            })
            .catch(error => {
                console.log(error)
                console.error('Erro ao excluir o pedido:', error);
                alert('Erro ao excluir o pedido');
            });
    });
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
    


    $(document).ready(function () {
        $('#dataTablePendente').DataTable();
        $('#dataTableNormal').DataTable(); // Initialize the DataTable
    });
</script>
@endsection
