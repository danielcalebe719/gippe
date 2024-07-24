@extends('adm.templates.template')

@section('title', 'Produtos')

@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Produtos</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Produtos</h6>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarProduto">Adicionar
                        Produto</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>STATUS</th>
                                <th>Quantidade</th>
                                <th>Preço Unitário</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->id }}</td>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->tipo }}</td>
                                    <td>{{ $produto->status }}</td>
                                    <td>{{ $produto->quantidade }}</td>
                                    <td>{{ $produto->precoUnitario }}</td>


                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $produto->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarProduto">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $produto->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $produto->id }}')" data-toggle="modal"
                                                    data-target="#modalDetalhesProduto">
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

    <!-- Modal Adicionar Produto -->
    <div class="modal fade" id="modalAdicionarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarProduto" method="POST" action="/adm/produtos/guardar"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="Descrição">Descrição</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Tipo</label>
                            <select class="form-control" id="tipo" name="tipo" required>
                                <option value="salgado">Salgado</option>
                                <option value="doce">Doce</option>
                                <option value="bebida">Bebida</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Quantidade">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="Preço Unitário">Preço Unitário</label>
                            <input type="text" class="form-control" id="precoUnitario" name="precoUnitario"
                                required>
                        </div>
                       
                        <div class="form-group">
                            <label for="imgPerfil">Imagem</label>
                            <input type="file" class="form-control-file" id="caminhoImagem" name="caminhoImagem">
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
                    <input type="hidden" id="excluirIdProduto">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarExclusao">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Produto -->
    <div class="modal fade" id="modalEditarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarProduto" method="POST" action="/adm/produtos/guardar"
                    enctype="multipart/form-data" >
                    @csrf
                        <input type="hidden" id="editarIdProduto" name="idProduto" value="">
                        <div class="form-group">
                            <label for="editNome">Nome</label>
                            <input type="text" class="form-control" id="editarNome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="editDescrição">Descrição</label>
                            <input type="text" class="form-control" id="editarDescricao" name="descricao" required>
                        </div>
                        <div class="form-group">
                            <label for="editDataNascimento">Tipo</label>
                            <select class="form-control" id="editarTipo" name="tipo" required>
                                <option value="salgado">Salgado</option>
                                <option value="bebida">Bebida</option>
                                <option value="doce">Doce</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select class="form-control" id="editarStatus" name="status" required>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                                <option value="em falta">Em falta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editQuantidade">Quantidade</label>
                            <input type="number" class="form-control" id="editarQuantidade" name="quantidade"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="editPreço Unitário">Preço Unitário</label>
                            <input type="text" class="form-control" id="editarPrecoUnitario" name="precoUnitario"
                                required>
                        </div>
                        
                        <div class="form-group">
                            <label for="editImgPerfil">Imagem de Perfil</label>
                            <input type="file" class="form-control-file" id="editarCaminhoImagem" name="caminhoImagem">
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

<!-- Modal Detalhes Produto -->
<div class="modal fade" id="modalDetalhesProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="detalhesNome" class="col-sm-3 col-form-label">Nome:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesNome" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesDescrição" class="col-sm-3 col-form-label">Descrição:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesDescrição" readonly>
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
                <div class="form-group">
                            <label for="detalhesImgPerfil">Imagem do Produto:</label>
                            <img id="detalhesImgPerfil" class="form-control-file" src="" alt="Imagem do Produto" width="100px">
                        </div>
                <!-- <div class="form-group row">
                    <label for="detalhesImgPerfil" class="col-sm-3 col-form-label">Imagem de Perfil:</label>
                    <div class="col-sm-9">
                        <img src="" alt="Imagem de Perfil" id="detalhesImgPerfil" style="max-width: 100%;">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        // Abrir o modal de detalhes ao clicar no botão
        $('#dataTableHover').on('click', '.btn-detalhes', function () {
            $('#modalDetalhesProduto').modal('show');
        });
    });


    $(document).ready(function () {
        $('#dataTableHover').DataTable(); // Initialize the DataTable
    });
</script>

<script>
    // Função para abrir o modal de confirmação de exclusão
    function abrirModalExclusao(idProduto) {
        document.getElementById('excluirIdProduto').value = idProduto;
        $('#modalConfirmarExclusao').modal('show');
    }

    // Função para confirmar a exclusão
    document.getElementById('confirmarExclusao').addEventListener('click', function () {
        var idProduto = document.getElementById('excluirIdProduto').value;

        // Enviar requisição AJAX para excluir o cliente
        fetch(`/adm/produtos/remover/${idProduto}`, {
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
                let produtoRow = document.getElementById(`produtoRow${idProduto}`);
                if (produtoRow) {
                    produtoRow.remove();
                } else {
                    console.warn(`Elemento produtoRow${idProduto} não encontrado para remoção.`);
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
<script>
    function mostrarDetalhes(idProduto) {
        fetch(`/adm/produtos/show/${idProduto}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do produto');
                }
                return response.json();
            })
            .then(data => {
                // Preencha os campos do modal com os dados do cliente, ou valores padrão
                document.getElementById('detalhesNome').value = data.nome || '';
                document.getElementById('detalhesDescrição').value = data.descricao || '';
                document.getElementById('detalhesDataCadastro').value = data.dataCadastro ? formatarData(data.dataCadastro) : '';
                document.getElementById('detalhesDataAtualizacao').value = data.dataAtualizacao ? formatarData(data.dataAtualizacao) : '';
                // Atualize o src da imagem
            const imgPath = data.caminhoImagem ? `/storage/ImagensProdutos/${data.caminhoImagem}` : 'default-image-path.jpg';
            document.getElementById('detalhesImgPerfil').src = imgPath;


                // Abra o modal de detalhes do pedido
                $('#modalDetalhesProduto').modal('show');
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
    function carregarDadosParaEdicao(idProduto) {
        fetch(`/adm/produtos/show/${idProduto}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do produto');
                }
                return response.json();
            })
            .then(data => {
                console.log('API Response:', data);
                // Preencher os campos do formulário com os dados do cliente
                document.getElementById('editarIdProduto').value = data.id;
                document.getElementById('editarNome').value = data.nome;
                document.getElementById('editarDescricao').value = data.descricao;
                document.getElementById('editarTipo').value = data.tipo;
                document.getElementById('editarStatus').value = data.status;
                document.getElementById('editarQuantidade').value = data.quantidade;
                document.getElementById('editarPrecoUnitario').value = data.precoUnitario;
                document.getElementById('editarCaminhoImagem').value = data.caminhoImagem;

                // Abrir o modal de edição do cliente
                $('#modalEditarProduto').modal('show');
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes do produto:', error);
            });
    }
</script>
@endsection