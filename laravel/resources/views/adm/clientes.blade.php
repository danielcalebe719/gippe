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
                                    <th>Senha</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aqui vai o conteúdo da tabela vindo do banco de dados -->
                                <!-- Exemplo estático para ilustrar -->
                                <tr>
                                    <td>1</td>
                                    <td>João Silva</td>
                                    <td>123.456.789-00</td>
                                    <td>01/01/1980</td>
                                    <td>Ativo</td>
                                    <td>joao.silva@example.com</td>
                                    <td>••••••••</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditarCliente">Editar</button>
                                        <button class="btn btn-danger btn-sm" onclick="excluirCliente(1)">Excluir</button>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDetalhesCliente">Detalhes</button>
                                    </td>
                                </tr>
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
                        <form id="formAdicionarCliente">
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarCliente">
                            <div class="form-group">
                                <label for="editNome">Nome</label>
                                <input type="text" class="form-control" id="editNome" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="editCpf">CPF</label>
                                <input type="text" class="form-control" id="editCpf" name="cpf" required>
                            </div>
                            <div class="form-group">
                                <label for="editDataNascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" id="editDataNascimento" name="dataNascimento" required>
                            </div>
                            <div class="form-group">
                                <label for="editStatus">Status</label>
                                <select class="form-control" id="editStatus" name="status" required>
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editEmail">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="editSenha">Senha</label>
                                <input type="password" class="form-control" id="editSenha" name="senha" required>
                            </div>
                            <div class="form-group">
                                <label for="editImgPerfil">Imagem de Perfil</label>
                                <input type="file" class="form-control-file" id="editImgPerfil" name="imgPerfil">
                            </div>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalVisualizarEndereco">Visualizar Endereço</button>
                            <button class="btn btn-primary btn-sm" id="btnAdicionarEndereco">Adicionar Novo Endereço ao Cliente</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
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
                            <label for="detalhesImgPerfil" class="col-sm-3 col-form-label">Imagem de Perfil:</label>
                            <div class="col-sm-9">
                                <img id="detalhesImgPerfil" src="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
@endsection
