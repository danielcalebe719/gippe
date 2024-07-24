@extends('adm.templates.template')

@section('title', 'Galeria De Imagens')

@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Galeria de Imagens</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Galeria de Imagens</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Galeria de Imagens</h6>
                    <button class="btn btn-primary" data-toggle="modal"
                        data-target="#modalAdicionarGaleriaImagens">Adicionar Imagem</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Tipo Evento</th>
                                <th>Descrição</th>
                                <th>Nome da Imagem</th>
                                <th>Imagem</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($galeriaImagens as $galeriaImagem)
                                <tr>
                                    <td>{{ $galeriaImagem->id }}</td>
                                    <td>{{ $galeriaImagem->evento }}</td>
                                    <td>{{ $galeriaImagem->descricao }}</td>
                                    <td>{{ $galeriaImagem->nomeImagem }}</td>
                                    <td><img src="/storage/GaleriaImagens/{{ $galeriaImagem->caminhoImagem }}" alt="" width="120px" height="120px"></td>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $galeriaImagem->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarGaleriaImagens">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $galeriaImagem->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $galeriaImagem->id }}')"
                                                    data-toggle="modal" data-target="#modalDetalhesGaleriaImagens">
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

    <!-- Modal Adicionar GaleriaImagens -->
    <div class="modal fade" id="modalAdicionarGaleriaImagens" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar GaleriaImagens</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarGaleriaImagens" method="POST" action="/adm/galeriaImagens/guardar">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome da Imagem</label>
                            <input type="text" class="form-control" id="nomeImagem" name="nomeImagem" required>
                        </div>
                        <div class="form-group">
                            <label for="TipoEvento">Tipo</label>
                            <select class="form-control" id="evento" name="evento" required>
                                <option value="casamento">Casamento</option>
                                <option value="15anos">15 anos</option>
                                <option value="infantil">infantil</option>
                                <option value="formatura">Formatura</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descicao">Descrição</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" required>
                        </div>

                        <div class="form-group">
                            <label for="imgPerfil">Imagem de Perfil</label>
                            <input type="file" class="form-control-file" id="caminhoImagem" name="caminhoImagem">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar GaleriaImagens -->
    <div class="modal fade" id="modalEditarGaleriaImagens" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar GaleriaImagens</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarGaleriaImagens" method="POST" action="/adm/galeriaImagens/guardar"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editarIdGaleriaImagem" name="idGaleriaImagem" value="">
                        <div class="form-group">
                            <label for="editNome">Nome da Imagem:</label>
                            <input type="text" class="form-control" id="editarNomeImagem" name="nomeImagem" required>
                        </div>


                        <div class="form-group">
                            <label for="EditTipoEvento">Tipo de evento</label>
                            <select class="form-control" id="editarEvento" name="evento" required>
                                <option value="casamento">Casamento</option>
                                <option value="15anos">15 anos</option>
                                <option value="infantil">infantil</option>
                                <option value="formatura">Formatura</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editDescricao">Descrição:</label>
                            <input type="text" class="form-control" id="editarDescricao" name="descricao" required>
                        </div>

                        <div class="form-group">
                            <label for="EditimgCaminho">Imagem Caminho</label>
                            <input type="file" class="form-control-file" id="EditarCaminhoImagem" name="caminhoImagem">
                        </div>

                        <button class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#modalVisualizarEndereco">Visualizar Endereço</button>

                        <button class="btn btn-primary btn-sm" id="btnAdicionarEndereco">Adicionar Novo Endereço ao
                            GaleriaImagens</button>
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
                <input type="hidden" id="excluirIdGaleriaImagem">
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
    function abrirModalExclusao(idGaleriaImagem) {
        document.getElementById('excluirIdGaleriaImagem').value = idGaleriaImagem;
        $('#modalConfirmarExclusao').modal('show');
    }

    // Função para confirmar a exclusão
    document.getElementById('confirmarExclusao').addEventListener('click', function () {
        var idGaleriaImagem = document.getElementById('excluirIdGaleriaImagem').value;

        // Enviar requisição AJAX para excluir o cliente
        fetch(`/adm/galeriaImagens/remover/${idGaleriaImagem}`, {
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
                let galeriaImagemRow = document.getElementById(`galeriaImagemRow${idGaleriaImagem}`);
                if (galeriaImagemRow) {
                    galeriaImagemRow.remove();
                } else {
                    console.warn(`Elemento galeriaImagemRow${idGaleriaImagem} não encontrado para remoção.`);
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
    function carregarDadosParaEdicao(idGaleriaImagem) {
        fetch(`/adm/galeriaImagens/show/${idGaleriaImagem}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do agendamento');
                }
                return response.json();
            })
            .then(data => {
                console.log('API Response:', data);
                // Preencher os campos do formulário com os dados do cliente
                document.getElementById('editarIdGaleriaImagem').value = data.id;
                document.getElementById('editarNomeImagem').value = data.nomeImagem;
                document.getElementById('editarEvento').value = data.evento;
                document.getElementById('editarDescricao').value = data.descricao;
                document.getElementById('editarCaminhoImagem').value = data.caminhoImagem;



                // Abrir o modal de edição do cliente
                $('#modalEditarGaleriaImagens').modal('show');
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes do produto:', error);
            });
    }
</script>

<!-- Modal Detalhes GaleriaImagens -->
<div class="modal fade" id="modalDetalhesGaleriaImagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do GaleriaImagens</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="detalhesNome" class="col-sm-3 col-form-label">Nome da Imagem:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesNomeImagem" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="detalhesTipoEvento" class="col-sm-3 col-form-label">Tipo Evento:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesEvento" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesDescricao" class="col-sm-3 col-form-label">Descrição:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesDescricao" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="detalhesImagemCaminho" class="col-sm-3 col-form-label">Imagem:</label>
                    <div class="col-sm-9">
                        <img src="" alt="Imagem" id="detalhesCaminhoImagem" style="max-width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function mostrarDetalhes(idGaleriaImagem) {
        fetch(`/adm/galeriaImagens/show/${idGaleriaImagem}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do agendamento');
                }
                return response.json();
            })
            .then(data => {
                // Preencha os campos do modal com os dados do cliente, ou valores padrão
                document.getElementById('detalhesNomeImagem').value = data.nomeImagem || '';
                document.getElementById('detalhesEvento').value = data.evento || '';
                document.getElementById('detalhesDescricao').value = data.descricao || '';
                 // Atualize o src da imagem
            const imgPath = data.caminhoImagem ? `/storage/GaleriaImagens/eventoImagens/${data.caminhoImagem}` : 'default-image-path.jpg';
            document.getElementById('detalhesCaminhoImagem').src = imgPath;




                // Abra o modal de detalhes do pedido
                $('#modalDetalhesGaleriaImagens').modal('show');
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
<!-- Modal para adicionar novo endereço -->
<div class="modal fade" id="modalAdicionarEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Novo Endereço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário para adicionar novo endereço -->
                <form id="formAdicionarEndereco">
                    <div class="form-group">
                        <label for="tipoEndereco">Tipo de Endereço</label>
                        <select class="form-control" id="tipoEndereco" name="tipoEndereco" required>
                            <option value="residencial">Residencial</option>
                            <option value="comercial">Comercial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" required>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                    </div>
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" required>
                    </div>
                    <div class="form-group">
                        <label for="rua">Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua" required>
                    </div>
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento">
                    </div>
                    <!-- Adicione um campo oculto para armazenar o ID do GaleriaImagens -->
                    <input type="hidden" id="idGaleriaImagens" name="idGaleriaImagens" value="">
                    <!-- Botão para enviar o formulário -->
                    <button type="submit" class="btn btn-primary">Salvar Endereço</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para visualizar detalhes do endereço -->
<div class="modal fade" id="modalVisualizarEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Endereço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Detalhes do endereço -->
                <div class="form-group">
                    <label for="tipoEnderecoVisualizar">Tipo de Endereço</label>
                    <input type="text" class="form-control" id="tipoEnderecoVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="cepVisualizar">CEP</label>
                    <input type="text" class="form-control" id="cepVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="cidadeVisualizar">Cidade</label>
                    <input type="text" class="form-control" id="cidadeVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="bairroVisualizar">Bairro</label>
                    <input type="text" class="form-control" id="bairroVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="ruaVisualizar">Rua</label>
                    <input type="text" class="form-control" id="ruaVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="numeroVisualizar">Número</label>
                    <input type="text" class="form-control" id="numeroVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="complementoVisualizar">Complemento</label>
                    <input type="text" class="form-control" id="complementoVisualizar" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        // Abrir o modal de detalhes ao clicar no botão
        $('#dataTableHover').on('click', '.btn-detalhes', function () {
            $('#modalDetalhesGaleriaImagens').modal('show');
        });
    });


    $(document).ready(function () {
        $('#dataTableHover').DataTable(); // Initialize the DataTable
    });
</script>
<script>
    $(document).ready(function () {
        // Abrir modal ao clicar no botão "Adicionar Novo Endereço"
        $('#btnAdicionarEndereco').click(function () {
            $('#modalAdicionarEndereco').modal('show');
        });
    });
</script>
@endsection