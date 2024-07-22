@extends('adm.templates.template')

@section('title', 'Receitas Itens')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Receitas Itens</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Receitas Itens</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Receitas Itens</h6>
                    <button class="btn btn-primary" data-toggle="modal"
                        data-target="#modalAdicionarReceitaItem">Adicionar Receita Item</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Produto </th>
                                <th>Materia Prima </th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receitasItens as $receitaItem)
                                <tr>
                                    <td>{{ $receitaItem->id }}</td>
                                    <td>{{ $receitaItem->produto->nome}}</td>
                                    <td>{{ $receitaItem->materiaPrima->nome}}</td>
                                    <td>{{ $receitaItem->quantidade }}</td>
                                    <td>{{ $receitaItem->subtotal }}</td>
                                    


                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $receitaItem->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarReceitaItem">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $receitaItem->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $receitaItem->id }}')" data-toggle="modal"
                                                    data-target="#modalDetalhesReceitaItem">
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

    <!-- Modal Adicionar ReceitaItem -->
    <div class="modal fade" id="modalAdicionarReceitaItem" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Item de Receita </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarReceitaItem" method="POST" action="/adm/receitasItens/guardar">
                    @csrf
                        <div class="form-group">
                            <label for="ProdutoID">Produto ID</label>
                            
                            <input type="text" class="form-control" id="idProdutos" name="idProdutos" required>
                        </div>
                        <div class="form-group">
                            <label for="MateriaPrimaID">Materia Prima ID</label>
                            <input type="text" class="form-control" id="idMateriasPrimas" name="idMateriasPrimas" required>
                        </div>
                        <div class="form-group">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                        </div>

                        <div class="form-group">
                            <label for="valor ">Subtotal </label>
                            <input type="text" class="form-control" id="subtotal " name="subtotal" required>
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
                    <input type="hidden" id="excluirIdReceitaItem">
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
    function abrirModalExclusao(idReceitaItem) {
        document.getElementById('excluirIdReceitaItem').value = idReceitaItem;
        $('#modalConfirmarExclusao').modal('show');
    }

    // Função para confirmar a exclusão
    document.getElementById('confirmarExclusao').addEventListener('click', function () {
        var idReceitaItem = document.getElementById('excluirIdReceitaItem').value;

        // Enviar requisição AJAX para excluir o cliente
        fetch(`/adm/receitasItens/remover/${idReceitaItem}`, {
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
                let receitaItemRow = document.getElementById(`receitaItemRow${idReceitaItem}`);
                if (receitaItemRow) {
                    receitaItemRow.remove();
                } else {
                    console.warn(`Elemento agendamentoRow${idReceitaItem} não encontrado para remoção.`);
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

    <!-- Modal Editar ReceitaItem -->
    <div class="modal fade" id="modalEditarReceitaItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Item de Receita </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarReceitaItem" method="POST" action="/adm/receitasItens/guardar" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editarIdReceitaItem" name="idReceitaItem" value="">
                        <div class="form-group">
                            <label for="editProdutoID">Produto ID</label>
                            <input type="text" class="form-control" id="editarIdProdutos" name="idProdutos" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="editMateriaPrimaID">Materia Prima ID</label>
                            <input type="text" class="form-control" id="editarIdMateriasPrimas" name="idMateriasPrimas"
                                required readonly>
                        </div>
                        <div class="form-group">
                            <label for="editQuantidade">Quantidade</label>
                            <input type="number" class="form-control" id="editarQuantidade" name="quantidade" required>
                        </div>


                        <div class="form-group">
                            <label for="editValor">Subtotal</label>
                            <input type="text" class="form-control" id="editarSubtotal" name="subtotal" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<script>
    function carregarDadosParaEdicao(idReceitaItem) {
        fetch(`/adm/receitasItens/show/${idReceitaItem}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do agendamento');
                }
                return response.json();
            })
            .then(data => {
                console.log('API Response:', data);
                // Preencher os campos do formulário com os dados do cliente
                document.getElementById('editarIdReceitaItem').value = data.id;
                document.getElementById('editarIdProdutos').value = data.idProdutos;
                document.getElementById('editarIdMateriasPrimas').value = data.idMateriasPrimas;
                document.getElementById('editarQuantidade').value = data.quantidade;
                document.getElementById('editarSubtotal').value = data.subtotal;
                

                // Abrir o modal de edição do cliente
                $('#modalEditarReceitaItem').modal('show');
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes do produto:', error);
            });
    }
</script>

</div>
</div>

<!-- Modal Detalhes ReceitaItem -->
<div class="modal fade" id="modalDetalhesReceitaItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do ReceitaItem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="detalhesProdutoID" class="col-sm-3 col-form-label">Produto ID:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesIdProduto" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesMateriaPrimaID" class="col-sm-3 col-form-label">Materia Prima ID:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesIdMateriaPrima" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesQuantidade" class="col-sm-3 col-form-label">Quantidade:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesQuantidade" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesValor" class="col-sm-3 col-form-label">Subtotal:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesSubtotal" readonly>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function mostrarDetalhes(idReceitaItem) {
        fetch(`/adm/receitasItens/show/${idReceitaItem}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do agendamento');
                }
                return response.json();
            })
            .then(data => {
                // Preencha os campos do modal com os dados do cliente, ou valores padrão
                document.getElementById('detalhesIdProduto').value = data.idProdutos || '';
                document.getElementById('detalhesIdMateriaPrima').value = data.idMateriasPrimas || '';
                document.getElementById('detalhesQuantidade').value = data.quantidade || '';
                document.getElementById('detalhesSubtotal').value = data.subtotal || '';
                
                


                // Abra o modal de detalhes do pedido
                $('#modalDetalhesReceitaItem').modal('show');
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

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>

    $(document).ready(function () {
        // Abrir o modal de detalhes ao clicar no botão
        $('#dataTableHover').on('click', '.btn-detalhes', function () {
            $('#modalDetalhesReceitaItem').modal('show');
        });
    });


    $(document).ready(function () {
        $('#dataTableHover').DataTable(); // Initialize the DataTable
    });
</script>
@endsection