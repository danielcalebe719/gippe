    @extends('adm.templates.template')

    @section('title', 'Clientes')

    @section('content')


    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Clientes</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarCliente">Adicionar Cliente</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Data de nascimento</th>
                                    <th>STATUS</th>
                                    <th>Email</th>

                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aqui vai o conteúdo da tabela vindo do banco de dados -->
                                <!-- Exemplo estático para ilustrar -->
                                @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->idClientes }}</td>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>{{ $cliente->cpf }}</td>
                                    <td>{{ $cliente->dataNascimento }}</td>
                                    <td>{{ $cliente->status }}</td>
                                    <td>{{ $cliente->email }}</td>


                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm" onclick="carregarDadosParaEdicao('{{ $cliente->idClientes }}')" data-toggle="modal" data-target="#modalEditarCliente">
                                                    Editar
                                                </button>
                                            </div>
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-danger btn-sm" onclick="excluirCliente(1)">
                                                    Excluir
                                                </button>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm" onclick="mostrarDetalhes('{{ $cliente->idClientes }}')" data-toggle="modal" data-target="#modalDetalhesCliente">
                                                    Detalhes
                                                </button>
                                            </div>
                                        </div>
                                    </td>


                                </tr>
                                @endforeach
                                <!-- Fim do exemplo -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal Adicionar Cliente -->
    <div class="modal fade" id="modalAdicionarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="formAdicionarCliente" action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="dataNascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                        <div class="form-group">
                            <label for="imgPerfil">Imagem de Perfil</label>
                            <input type="file" class="form-control-file" id="imgPerfil" name="imgPerfil">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


        <!-- Modal Editar Cliente -->
        <div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <<form id="formEditarCliente" method="POST" action="{{ route('clientes.update', ['idClientes' => $cliente->idClientes]) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editarIdCliente" name="idCliente">

                            <div class="form-group row">
                                <label for="editarNome" class="col-sm-3 col-form-label">Nome:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editarNome" name="nome">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="editarCPF" class="col-sm-3 col-form-label">CPF:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editarCPF" name="cpf">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="editarDataNascimento" class="col-sm-3 col-form-label">Data de Nascimento:</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editarDataNascimento" name="dataNascimento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="editarStatus" class="col-sm-3 col-form-label">Status:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="editarStatus" name="status">
                                        <option value="ativo">Ativo</option>
                                        <option value="inativo">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="editarEmail" class="col-sm-3 col-form-label">Email:</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="editarEmail" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="editarSenha" class="col-sm-3 col-form-label">Senha:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="editarSenha" name="senha">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="editarTelefone" class="col-sm-3 col-form-label">Telefone:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editarTelefone" name="telefone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="editarImgCaminho" class="col-sm-3 col-form-label">Imagem de Perfil:</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control-file" id="editarImgCaminho" name="imgCaminho">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Editar Endereço</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Detalhes Cliente -->
        <div class="modal fade" id="modalDetalhesCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="detalhesId" class="col-sm-3 col-form-label">ID:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="detalhesId" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detalhesNome" class="col-sm-3 col-form-label">Nome:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="detalhesNome" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detalhesCPF" class="col-sm-3 col-form-label">CPF:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="detalhesCPF" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detalhesDataNascimento" class="col-sm-3 col-form-label">Data de Nascimento:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="detalhesDataNascimento" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detalhesStatus" class="col-sm-3 col-form-label">Status:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="detalhesStatus" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detalhesEmail" class="col-sm-3 col-form-label">Email:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="detalhesEmail" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detalhesSenha" class="col-sm-3 col-form-label">Senha:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="detalhesSenha" readonly>
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
                            <label for="detalhesDataRemocao" class="col-sm-3 col-form-label">Data de Remoção:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="detalhesDataRemocao" readonly>
                            </div>
                        </div>
                        <div class="form-group">
        <label for="detalhesImgPerfil">Imagem de Perfil</label><br>
        <div class="img-container">
            <img id="detalhesImgCaminho" src="" class="img-fluid img-thumbnail" alt="Imagem de Perfil">
        </div>
    </div>
                        <div class="form-group row">
                            <label for="detalhesTelefone" class="col-sm-3 col-form-label">Telefone:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="detalhesTelefone" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function mostrarDetalhes(idCliente) {
        // Faça uma requisição AJAX para obter os detalhes do cliente
        fetch(`/adm/clientes/${idCliente}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do cliente');
                }
                return response.json();
            })
            .then(data => {
                // Preencha os campos do modal com os dados do cliente
                document.getElementById('detalhesId').value = data.idClientes;
                document.getElementById('detalhesNome').value = data.nome;
                document.getElementById('detalhesCPF').value = data.cpf;
                document.getElementById('detalhesDataNascimento').value = data.dataNascimento ? formatarData(data.dataNascimento) : '';
                document.getElementById('detalhesDataCadastro').value = data.dataCadastro ? formatarData(data.dataCadastro) : '';
                document.getElementById('detalhesDataAtualizacao').value = data.dataAtualizacao ? formatarData(data.dataAtualizacao) : '';
                document.getElementById('detalhesStatus').value = data.status;
                document.getElementById('detalhesEmail').value = data.email;
                document.getElementById('detalhesTelefone').value = data.telefone;

                // Exibir apenas parte da senha
                let senhaOculta = '*'.repeat(data.senha.length - 3) + data.senha.slice(-3); // Exibe apenas os últimos 3 caracteres
                document.getElementById('detalhesSenha').value = senhaOculta;

                // Atualizar a imagem de perfil
                let imgPath = data.imgCaminho ? `/storage/GaleriaImagens/${data.imgCaminho}` : '/default.png'; // Usar uma imagem padrão caso o caminho seja nulo
                document.getElementById('detalhesImgCaminho').src = imgPath;

                // Abra o modal de detalhes do cliente
                $('#modalDetalhesCliente').modal('show');
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes do cliente:', error);
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




    <!-- Modal Adicionar Endereço -->
    <div class="modal fade" id="modalAdicionarEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarEndereco">
                        <div class="form-group row">
                            <label for="cep" class="col-sm-3 col-form-label">CEP:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cep" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endereco" class="col-sm-3 col-form-label">Endereço:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="endereco" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numero" class="col-sm-3 col-form-label">Número:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="numero" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="complemento" class="col-sm-3 col-form-label">Complemento:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="complemento">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bairro" class="col-sm-3 col-form-label">Bairro:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="bairro" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cidade" class="col-sm-3 col-form-label">Cidade:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cidade" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="estado" class="col-sm-3 col-form-label">Estado:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="estado" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Endereço</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Visualizar Endereço -->
    <div class="modal fade" id="modalVisualizarEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Visualizar Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="visualizarCep" class="col-sm-3 col-form-label">CEP:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="visualizarCep" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="visualizarEndereco" class="col-sm-3 col-form-label">Endereço:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="visualizarEndereco" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="visualizarNumero" class="col-sm-3 col-form-label">Número:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="visualizarNumero" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="visualizarComplemento" class="col-sm-3 col-form-label">Complemento:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="visualizarComplemento" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="visualizarBairro" class="col-sm-3 col-form-label">Bairro:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="visualizarBairro" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="visualizarCidade" class="col-sm-3 col-form-label">Cidade:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="visualizarCidade" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="visualizarEstado" class="col-sm-3 col-form-label">Estado:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="visualizarEstado" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function carregarDadosParaEdicao(idCliente) {
            fetch(`adm/clientes/show/${idCliente}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do cliente');
                    }
                    return response.json();
                })
                .then(data => {
                    // Preencher os campos do formulário com os dados do cliente
                    document.getElementById('editarIdCliente').value = data.idClientes;
                    document.getElementById('editarNome').value = data.nome;
                    document.getElementById('editarCPF').value = data.cpf;
                    document.getElementById('editarDataNascimento').value = data.dataNascimento;
                    document.getElementById('editarStatus').value = data.status;
                    document.getElementById('editarEmail').value = data.email;
                    document.getElementById('editarTelefone').value = data.telefone;
                    document.getElementById('editarImgCaminho').src = 'GaleriaImagens' + data.imgCaminho;

                    // Abrir o modal de edição do cliente
                    $('#modalEditarCliente').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do cliente:', error);
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