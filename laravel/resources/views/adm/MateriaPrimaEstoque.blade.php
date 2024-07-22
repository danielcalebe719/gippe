@extends('adm.templates.template')

@section('title', 'Matérias Primas')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Matéria Primas</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Matéria Primas</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Matéria Primas</h6>
                        <button class="btn btn-primary" data-toggle="modal"
                            data-target="#modalAdicionarMateriaPrima">Adicionar Matéria Prima</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Fornecedor</th>
                                    <th>Classificação</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unitário</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materiasPrimas as $materiaPrima)
                                    <tr>
                                        <td>{{ $materiaPrima->id }}</td>
                                        <td>{{ $materiaPrima->nome }}</td>
                                        <td>{{ $materiaPrima->fornecedor->nome}}</td>
                                        <td>{{ $materiaPrima->classificacao }}</td>
                                        <td>{{ $materiaPrima->quantidade }}</td>
                                        <td>{{ $materiaPrima->precoUnitario }}</td>


                                        <td>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                    <button class="btn btn-primary btn-sm"
                                                        onclick="carregarDadosParaEdicao('{{ $materiaPrima->id }}')"
                                                        data-toggle="modal" data-target="#modalEditarCliente">
                                                        Editar
                                                    </button>
                                                </div>

                                                <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="abrirModalExclusao('{{ $materiaPrima->id }}')">
                                                        Excluir
                                                    </button>
                                                </div>


                                                <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                    <button class="btn btn-info btn-sm"
                                                        onclick="mostrarDetalhes('{{ $materiaPrima->id }}')"
                                                        data-toggle="modal" data-target="#modalDetalhesCliente">
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

        <!-- Modal Adicionar Matéria Prima -->
        <div class="modal fade" id="modalAdicionarMateriaPrima" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Matéria Prima</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAdicionarMatériaPrima" method="POST" action="/adm/MateriaPrimaEstoque/guardar"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="FornecedorID">Fornecedor ID</label>
                                <input type="text" class="form-control" id="idFornecedor" name="idFornecedor" required>
                            </div>
                            <div class="form-group">
                                <label for="Classificacao">Classificação</label>
                                <select name="classificacao" class="form-control" id="classificacao">
                                    <option value="perecivel"> Perecível</option>
                                    <option value="nao perecivel"> Não Perecível</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantidade">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                            </div>
                            <div class="form-group">
                                <label for="precoUnitario">Preço Unitário</label>
                                <input type="text" class="form-control" id="precoUnitario" name="precoUnitario" required>
                            </div>
                            <div class="form-group">
                                <label for="imgPerfil">Imagem da Matéria prima</label>
                                <input type="file" class="form-control-file" id="caminhoImagem" name="caminhoImagem">
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Matéria Prima -->
        <div class="modal fade" id="modalEditarMateriaPrima" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Matéria Prima</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarMatériaPrima" method="POST" action="/adm/MateriaPrimaEstoque/guardar"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="editarIdMateriaPrima" name="idMateriaPrima" value="">
                            <div class="form-group">
                                <label for="editNome">Nome</label>
                                <input type="text" class="form-control" id="editarNome" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="editFornecedor ID">Fornecedor ID</label>
                                <input type="text" class="form-control" id="editarIdFornecedor" name="idFornecedor"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="editarClassificacao">Classificação</label>
                                <select name="classificacao" class="form-control" id="editarClassificacao">
                                    <option value="perecivel"> Perecível</option>
                                    <option value="nao perecivel"> Não Perecível</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="editQuantidade">Quantidade</label>
                                <input type="number" class="form-control" id="editarQuantidade" name="quantidade"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="editPreçoUnitario">Preço Unitário</label>
                                <input type="text" class="form-control" id="editarPrecoUnitario" name="precoUnitario"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="editImgPerfil">Imagem de Perfil</label>
                                <input type="file" class="form-control-file" id="editarCaminhoImagem"
                                    name="caminhoImagem">
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
                    <input type="hidden" id="excluirIdMateriaPrima">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarExclusao">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes Matéria Prima -->
    <div class="modal fade" id="modalDetalhesMateriaPrima" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes do Matéria Prima</h5>
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
                        <img id="detalhesImgPerfil" class="form-control-file" src="" alt="Imagem do Produto"
                            style="max-width: 100%; height: auto;">
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>

    <script>
        $(document).ready(function() {
            // Abrir o modal de detalhes ao clicar no botão
            $('#dataTableHover').on('click', '.btn-detalhes', function() {
                $('#modalDetalhesMateriaPrima').modal('show');
            });
        });


        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>

    <script>
        // Função para abrir o modal de confirmação de exclusão
        function abrirModalExclusao(idMateriaPrima) {
            document.getElementById('excluirIdMateriaPrima').value = idMateriaPrima;
            $('#modalConfirmarExclusao').modal('show');
        }

        // Função para confirmar a exclusão
        document.getElementById('confirmarExclusao').addEventListener('click', function() {
            var idMateriaPrima = document.getElementById('excluirIdMateriaPrima').value;

            // Enviar requisição AJAX para excluir o cliente
            fetch(`/adm/MateriaPrimaEstoque/remover/${idMateriaPrima}`, {
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
                    let materiaPrimaRow = document.getElementById(`materiaPrimaRow${idMateriaPrima}`);
                    if (materiaPrimaRow) {
                        materiaPrimaRow.remove();
                    } else {
                        console.warn(`Elemento materiaPrimaRow${idMateriaPrima} não encontrado para remoção.`);
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
        function mostrarDetalhes(idMateriaPrima) {
            fetch(`/adm/MateriaPrimaEstoque/show/${idMateriaPrima}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do produto');
                    }
                    return response.json();
                })
                .then(data => {
                    // Preencha os campos do modal com os dados do cliente, ou valores padrão
                    document.getElementById('detalhesNome').value = data.nome || '';
                    document.getElementById('detalhesDataCadastro').value = data.dataCadastro ? formatarData(data
                        .dataCadastro) : '';
                    document.getElementById('detalhesDataAtualizacao').value = data.dataAtualizacao ? formatarData(data
                        .dataAtualizacao) : '';
                    // Atualize o src da imagem
                    const imgPath = data.caminhoImagem ?
                        `/storage/GaleriaImagens/materiasPrimas/${data.caminhoImagem}` : 'default-image-path.jpg';
                    document.getElementById('detalhesImgPerfil').src = imgPath;



                    // Abra o modal de detalhes do pedido
                    $('#modalDetalhesMateriaPrima').modal('show');
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
        function carregarDadosParaEdicao(idMateriaPrima) {
            fetch(`/adm/MateriaPrimaEstoque/show/${idMateriaPrima}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do produto');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('API Response:', data);
                    // Preencher os campos do formulário com os dados do cliente
                    document.getElementById('editarIdMateriaPrima').value = data.id;
                    document.getElementById('editarIdFornecedor').value = data.idFornecedor;
                    document.getElementById('editarNome').value = data.nome;
                    document.getElementById('editarClassificacao').value = data.classificacao;
                    document.getElementById('editarQuantidade').value = data.quantidade;
                    document.getElementById('editarPrecoUnitario').value = data.precoUnitario;
                    // document.getElementById('editarImgCaminho').value = data.imgCaminho;


                    // Abrir o modal de edição do cliente
                    $('#modalEditarMateriaPrima').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do produto:', error);
                });
        }
    </script>
@endsection
