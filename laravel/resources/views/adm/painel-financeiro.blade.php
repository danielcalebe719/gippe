<!-- resources/views/node/index.blade.php -->
@extends('adm.templates.template')

@section('title', 'Painel Financeiro')

@section('content')
<div>
    <iframe src="http://localhost:3000" style="width: 100%; height: 100vh; border: none;">

    </iframe>


    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gastos</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Gastos</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Gastos</h6>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarGasto">Adicionar
                            Gasto</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Motivo</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Departamento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gastos as $gasto)
                                    <tr>
                                        <td>{{ $gasto->id }}</td>
                                        <td>{{ $gasto->motivo }}</td>
                                        <td>{{ $gasto->valor }}</td>
                                        <td>{{ $gasto->getStatus() }}</td>
                                        <td>{{ $gasto->departamento }}</td>


                                        <td>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                    <button class="btn btn-primary btn-sm"
                                                        onclick="carregarDadosParaEdicao('{{ $gasto->id }}')"
                                                        data-toggle="modal">
                                                        Editar
                                                    </button>
                                                </div>

                                                <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="abrirModalExclusao('{{ $gasto->id }}')">
                                                        Excluir
                                                    </button>
                                                </div>


                                                <div class="btn-group" role="group" aria-label="Ações do Pedido">
                                                    <button class="btn btn-info btn-sm"
                                                        onclick="mostrarDetalhes('{{ $gasto->id }}')" data-toggle="modal">
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
    </div>





    <!-- Modal Adicionar Agendamento -->
    <div class="modal fade" id="modalAdicionarGasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarAgendamento" method="POST" action="/adm/painel-financeiro/guardar">
                        @csrf
                        <div class="form-group">
                            <label for="PedidoID">Motivo:</label>
                            <input type="text" class="form-control" id="motivo" name="motivo" required>
                        </div>
                        <div class="form-group">
                            <label for="DataInicio">Valor:</label>
                            <input type="text" class="form-control" id="valor" name="valor" required>
                        </div>
                        <div class="form-group">
                            <label for="dataFim">Departamento:</label>
                            <input type="text" class="form-control" id="departamento" name="departamento" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" >
                                @foreach(App\Models\Gastos::getStatusArray() as $chave => $valor)
                                    <option value="{{$chave}}">{{$valor}}</option>
                                @endforeach
                            </select>
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
                    <p>Tem certeza de que deseja excluir este gasto?</p>
                    <input type="hidden" id="excluirIdGasto">
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
        function abrirModalExclusao(idGasto) {
            document.getElementById('excluirIdGasto').value = idGasto;
            $('#modalConfirmarExclusao').modal('show');
        }

        // Função para confirmar a exclusão
        document.getElementById('confirmarExclusao').addEventListener('click', function () {
            var idGasto = document.getElementById('excluirIdGasto').value;

            // Enviar requisição AJAX para excluir o cliente
            fetch(`/adm/painel-financeiro/remover/${idGasto}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao excluir o gasto');
                    }
                    return response.json();
                })
                .then(data => {
                    // Fechar o modal de confirmação de exclusão
                    $('#modalConfirmarExclusao').modal('hide');

                    // Remover a linha do cliente na tabela, se existir
                    let gastoRow = document.getElementById(`gastoRow${idGasto}`);
                    if (gastoRow) {
                        gastoRow.remove();
                    } else {
                        console.warn(`Elemento gastoRow${idGasto} não encontrado para remoção.`);
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

    <!-- Modal Editar gasto -->
    <div class="modal fade" id="modalEditarGasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarAgendamento" method="POST" action="/adm/painel-financeiro/guardar"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editarIdGasto" name="idGasto" value="">
                        
                        <div class="form-group">
                            <label for="editPedidoID">Motivo</label>
                            <input type="text" class="form-control" id="editarMotivo" name="motivo" required >
                        </div>
                        <div class="form-group">
                            <label for="editData Inicio">Valor</label>
                            <input type="text" class="form-control" id="editarValor" name="valor" required>
                        </div>
                        <div class="form-group">
                            <label for="editDataFim">Departamento</label>
                            <input type="text" class="form-control" id="editarDepartamento" name="departamento"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="editarStatus" name="status" >
                                @foreach(App\Models\Gastos::getStatusArray() as $chave => $valor)
                                    <option value="{{$chave}}">{{$valor}}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <script>
        function carregarDadosParaEdicao(idGasto) {
            fetch(`/adm/painel-financeiro/show/${idGasto}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do agendamento');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('API Response:', data);
                    // Preencher os campos do formulário com os dados do cliente
                    document.getElementById('editarIdGasto').value = data.id;
                    document.getElementById('editarMotivo').value = data.motivo;
                    document.getElementById('editarValor').value = data.valor;
                    document.getElementById('editarDepartamento').value = data.departamento;
                    document.getElementById('editarStatus').value = data.status;


                    // Abrir o modal de edição do cliente
                    $('#modalEditarGasto').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do produto:', error);
                });
        }
    </script>


    <!-- Modal Detalhes Agendamento -->
    <div class="modal fade" id="modalDetalhesGasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes do gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="detalhesData Inicio" class="col-sm-3 col-form-label">Id:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesId" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="detalhesDataCadastro" class="col-sm-3 col-form-label">Data de Cadastro:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesDataCadastro" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="detalhesDataAtualizacao" class="col-sm-3 col-form-label">Data de
                            Atualização:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesDataAtualizacao" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarDetalhes(idGasto) {
            fetch(`/adm/painel-financeiro/show/${idGasto}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do agendamento');
                    }
                    return response.json();
                })
                .then(data => {
                    // Preencha os campos do modal com os dados do cliente, ou valores padrão
                    document.getElementById('detalhesId').value = data.id || '';
                    document.getElementById('detalhesDataCadastro').value = data.dataCadastro ? formatarData(data
                        .dataCadastro) : '';
                    document.getElementById('detalhesDataAtualizacao').value = data.dataAtualizacao ? formatarData(data
                        .dataAtualizacao) : '';



                    // Abra o modal de detalhes do pedido
                    $('#modalDetalhesGasto').modal('show');
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
                $('#modalDetalhesGasto').modal('show');
            });
        });


        $(document).ready(function () {
            $('#dataTableHover').DataTable();
            $('#dataTablePagar').DataTable(); // Initialize the DataTable
        });
    </script>















<div class="container-fluid" id="container-wrapper" id="apagar">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gastos à pagar</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">À pagar</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">À Pagar</h6>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarGasto">Adicionar
                            Gasto</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTablePagar">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Motivo</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Departamento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gastosPendentes as $gasto)
                                    <tr>
                                        <td>{{ $gasto->id }}</td>
                                        <td>{{ $gasto->motivo }}</td>
                                        <td>{{ $gasto->valor }}</td>
                                        <td>{{ $gasto->getStatus() }}</td>
                                        <td>{{ $gasto->departamento }}</td>


                                        <td>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                    <button class="btn btn-primary btn-sm"
                                                        onclick="carregarDadosParaEdicao('{{ $gasto->id }}')"
                                                        data-toggle="modal">
                                                        Editar
                                                    </button>
                                                </div>

                                                <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="abrirModalExclusao('{{ $gasto->id }}')">
                                                        Excluir
                                                    </button>
                                                </div>


                                                <div class="btn-group" role="group" aria-label="Ações do Pedido">
                                                    <button class="btn btn-info btn-sm"
                                                        onclick="mostrarDetalhes('{{ $gasto->id }}')" data-toggle="modal">
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
    </div>








    <!---Container Fluid a receber-->
    <br>
    <!-- <div id="scroll-areceber" class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-1000">À Receber</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="color: #8ebba7;" href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">À Receber</li>

            </ol>
        </div> -->
    <!-- Simple Tables 2 -->

    <!-- <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Consolidado (O serviço/produto foi entregue)</h6>
                <td><a href="#" class="btn btn-sm btn-info">Adicionar recebimento</a></td>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Data</th>
                            <th>Total</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#">RA0449</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>

                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA5324</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>

                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA8568</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>

                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA1453</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>

                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA1998</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>


                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div> -->


    <!---Container Fluid a receber 2-->
    <br>
    <!-- <div id="scroll-areceber" class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">


        </div> -->
    <!-- Simple Tables 3 -->

    <!-- <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Não Consolidado (O serviço/produto não foi entregue)</h6>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Data</th>
                            <th>Total</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#">RA0449</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>

                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA5324</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>

                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA8568</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>

                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA1453</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>

                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>
                        <tr>
                            <td><a href="#">RA1998</a></td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>R$0,00</td>


                            <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div> -->
</div>



@endsection