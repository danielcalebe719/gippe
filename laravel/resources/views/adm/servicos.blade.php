@extends('adm.templates.template')

@section('title', 'Serviços')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Serviços</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Serviços</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Serviços</h6>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarServico">Adicionar
                        Serviço</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome Serviço</th>
                                <th>Total Serviços</th>
                                <th>Duração em horas</th>
                                <th>Quantidade de pessoas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($servicos as $servico)
                                <tr>
                                    <td>{{ $servico->id }}</td>
                                    <td>{{ $servico->nome }}</td>
                                    <td>{{ $servico->totalServicos }}</td>
                                    <td>{{ $servico->duracaoHoras }}</td>
                                    <td>{{ $servico->quantidadePessoas }}</td>



                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $servico->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarServico">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $servico->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $servico->id }}')" data-toggle="modal"
                                                    data-target="#modalDetalhesServico">
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

    <!-- Modal Adicionar Servico -->
    <div class="modal fade" id="modalAdicionarServico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Servico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarServico" method="POST" action="/adm/servicos/guardar">
                        @csrf
                        <div class="form-group">
                            <label for="NomeServiço">Nome Serviço</label>
                            <select name="nome" class="form-control" id="nome">
                                <option value="festa pequena">Festa Pequena</option>
                                <option value="festa media">Festa Média</option>
                                <option value="festa grande">Festa Grande</option>
                                <option value="apenas entrega">Apenas Entrega</option>
                                <option value="festa personalizada">Festa Personalizada</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Totalservicos">Total serviços</label>
                            <input type="number" class="form-control" id="totalServicos" name="totalServicos" required>
                        </div>
                        <div class="form-group">
                            <label for="Totalservicos">Quantidade de horas</label>
                            <input type="number" class="form-control" id="duracaoHoras" name="duracaoHoras" required>
                        </div>
                        <div class="form-group">
                            <label for="Totalservicos">Número de pessoas</label>
                            <input type="number" class="form-control" id="quantidadePessoas" name="quantidadePessoas"
                                required>
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

    <!-- Modal Editar Servico -->
    <div class="modal fade" id="modalEditarServico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Servico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarServico" method="POST" action="/adm/servicos/guardar"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editarIdServico" name="idServico" value="">
                        <div class="form-group">
                            <label for="editarnome">Nome Serviço</label>
                            <select name="nome" class="form-control" id="editarNome">
                            <option value="festa pequena">Festa Pequena</option>
                                <option value="festa media">Festa Média</option>
                                <option value="festa grande">Festa Grande</option>
                                <option value="apenas entrega">Apenas Entrega</option>
                                <option value="festa personalizada">Festa Personalizada</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editTotalservicos">Total Serviços</label>
                            <input type="text" class="form-control" id="editarTotalServicos" name="totalServicos"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="editTotalservicos">Quantidade de horas</label>
                            <input type="text" class="form-control" id="editarDuracaoHoras" name="duracaoHoras"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="editTotalservicos">Número de pessoas</label>
                            <input type="text" class="form-control" id="editarQuantidadePessoas" name="quantidadePessoas"
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


<!-- Modal Detalhes Servico -->
<div class="modal fade" id="modalDetalhesServico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Servico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="detalhesNome Serviço" class="col-sm-3 col-form-label">Nome Serviço:</label>
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
                <div class="form-group row">
                    <label for="detalhesImgPerfil" class="col-sm-3 col-form-label">Imagem de Perfil:</label>
                    <div class="col-sm-9">
                        <img src="" alt="Imagem de Perfil" id="detalhesCaminhoImagem" style="max-width: 100%;">
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
                <input type="hidden" id="excluirIdServico">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarExclusao">Excluir</button>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        // Abrir o modal de detalhes ao clicar no botão
        $('#dataTableHover').on('click', '.btn-detalhes', function () {
            $('#modalDetalhesServico').modal('show');
        });
    });


    $(document).ready(function () {
        $('#dataTableHover').DataTable(); // Initialize the DataTable
    });
</script>

<script>
    // Função para abrir o modal de confirmação de exclusão
    function abrirModalExclusao(idServico) {
        document.getElementById('excluirIdServico').value = idServico;
        $('#modalConfirmarExclusao').modal('show');
    }

    // Função para confirmar a exclusão
    document.getElementById('confirmarExclusao').addEventListener('click', function () {
        var idServico = document.getElementById('excluirIdServico').value;

        // Enviar requisição AJAX para excluir o cliente
        fetch(`/adm/servicos/remover/${idServico}`, {
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
                let servicoRow = document.getElementById(`servicoRow${idServico}`);
                if (servicoRow) {
                    servicoRow.remove();
                } else {
                    console.warn(`Elemento servicoRow${idServico} não encontrado para remoção.`);
                }

                // Exibir mensagem de sucesso
                location.replace(location.href)

            })
            .catch(error => {
                console.log(error)
                console.error('Erro ao excluir o servico:', error);
                alert('Erro ao excluir o servico');
            });
    });


</script>
<script>
    function mostrarDetalhes(idServico) {
        fetch(`/adm/servicos/show/${idServico}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do servico');
                }
                return response.json();
            })
            .then(data => {
                // Preencha os campos do modal com os dados do cliente, ou valores padrão
                document.getElementById('detalhesNome').value = data.nome || '';
                document.getElementById('detalhesDataCadastro').value = data.dataCadastro ;
                document.getElementById('detalhesDataAtualizacao').value = data.dataAtualizacao ;
                 // Atualize o src da imagem
            const imgPath = data.caminhoImagem ? `/storage/GaleriaImagens/servicos/${data.caminhoImagem}` : 'default-image-path.jpg';
            document.getElementById('detalhesCaminhoImagem').src = imgPath;


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
    function carregarDadosParaEdicao(idServico) {
        fetch(`/adm/servicos/show/${idServico}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do produto');
                }
                return response.json();
            })
            .then(data => {
                console.log('API Response:', data);
                // Preencher os campos do formulário com os dados do cliente
                document.getElementById('editarIdServico').value = data.id;
                document.getElementById('editarNome').value = data.nome;
                document.getElementById('editarTotalServicos').value = data.totalServicos;
                document.getElementById('editarDuracaoHoras').value = data.duracaoHoras;
                document.getElementById('editarQuantidadePessoas').value = data.quantidadePessoas;              
                document.getElementById('editarCaminhoImagem').value = data.caminhoImagem;

                // Abrir o modal de edição do cliente
                $('#modalEditarServico').modal('show');
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes do produto:', error);
            });
    }
</script>
@endsection