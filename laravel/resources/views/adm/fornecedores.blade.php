@extends('adm.templates.template')

@section('title', 'Fornecedores')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Fornecedores</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Fornecedores</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Fornecedores</h6>
                    <button class="btn btn-primary" data-toggle="modal"
                        data-target="#modalAdicionarFornecedor">Adicionar Fornecedor</button>
                </div>

@php
function formatarCNPJ($cnpj) {
    return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
}
@endphp
@php
function formatarTelefone($telefone) {
    if (strlen($telefone) == 10) {
        // Formato: (XX) XXXX-XXXX
        return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
    } elseif (strlen($telefone) == 11) {
        // Formato: (XX) XXXXX-XXXX
        return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4);
    }
    return $telefone; // Caso não tenha o número de dígitos esperado
}
@endphp
@php
function formatarCEP($cep) {
    return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
}
@endphp


                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CNPJ</th>
                                <th>Telefone 1</th>
                                <th>STATUS</th>
                                <th>Email</th>
                                <th>CEP</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fornecedores as $fornecedor)
                                <tr>
                                    <td>{{ $fornecedor->id }}</td>
                                    <td>{{ $fornecedor->nome }}</td>
                                    <td>{{ formatarCNPJ($fornecedor->cnpj) }}</td>
                                    <td>{{ formatarTelefone($fornecedor->telefone1) }}</td>
                                    <td>{{ $fornecedor->status }}</td>
                                    <td>{{ $fornecedor->email }}</td>
                                    <td>{{ formatarCEP($fornecedor->cep) }}</td>


                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $fornecedor->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarFornecedor">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $fornecedor->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $fornecedor->id }}')" data-toggle="modal"
                                                    data-target="#modalDetalhesFornecedor">
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



    <!-- Modal Adicionar Fornecedor -->
    <div class="modal fade" id="modalAdicionarFornecedor" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Fornecedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarFornecedor" method="POST" action="/adm/fornecedores/guardar">
                    @csrf
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj" required>
                        </div>
                        <div class="form-group">
                            <label for="tel1">Telefone 1</label>
                            <input type="text" class="form-control" id="telefone1" name="telefone1" required>
                        </div>
                        <div class="form-group">
                            <label for="tel2">Telefone 2</label>
                            <input type="text" class="form-control" id="telefone2" name="telefone2" required>
                        </div>

                        <div class="form-group">
                            <label for="tel3">Telefone 3</label>
                            <input type="text" class="form-control" id="telefone3" name="telefone3" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" class="form-control" id="estado" name="estado" required>
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" required>
                        </div>
                        <div class="form-group">
                            <label for="rua">Rua</label>
                            <input type="text" class="form-control" id="rua" name="rua" required>
                        </div>
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="number" class="form-control" id="numero" name="numero" required>
                        </div>
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
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
                    <p>Tem certeza de que deseja excluir este pedido?</p>
                    <input type="hidden" id="excluirIdFornecedor">
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
    function abrirModalExclusao(idFornecedor) {
        document.getElementById('excluirIdFornecedor').value = idFornecedor;
        $('#modalConfirmarExclusao').modal('show');
    }

    // Função para confirmar a exclusão
    document.getElementById('confirmarExclusao').addEventListener('click', function () {
        var idFornecedor = document.getElementById('excluirIdFornecedor').value;

        // Enviar requisição AJAX para excluir o cliente
        fetch(`/adm/fornecedores/remover/${idFornecedor}`, {
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
                let fornecedorRow = document.getElementById(`fornecedorRow${idFornecedor}`);
                if (fornecedorRow) {
                    fornecedorRow.remove();
                } else {
                    console.warn(`Elemento fornecedorRow${idFornecedor} não encontrado para remoção.`);
                }

                // Exibir mensagem de sucesso
                location.replace(location.href)

            })
            .catch(error => {
                console.log(error)
                console.error('Erro ao excluir o fornecedor:', error);
                alert('Erro ao excluir o fornecedor');
            });
    });


</script>

    <!-- Modal Editar Fornecedor -->
    <div class="modal fade" id="modalEditarFornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Fornecedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarFornecedor" method="POST" action="/adm/fornecedores/guardar"
                    enctype="multipart/form-data" >
                    @csrf
                        <input type="hidden" id="editarIdFornecedor" name="idFornecedor" value="">
                        <div class="form-group">
                            <label for="editNome">Nome</label>
                            <input type="text" class="form-control" id="editarNome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="editCNPJ">CNPJ</label>
                            <input type="text" class="form-control" id="editarCNPJ" name="cnpj" >
                        </div>
                        <div class="form-group">
                            <label for="editTel1">Telefone 1</label>
                            <input type="text" class="form-control" id="editarTelefone1" name="telefone1" required>
                        </div>
                        <div class="form-group">
                            <label for="editarTel2">Telefone 2</label>
                            <input type="text" class="form-control" id="editarTelefone2" name="telefone2" >
                        </div>
                        <div class="form-group">
                            <label for="editarTel3">Telefone 3</label>
                            <input type="text" class="form-control" id="editarTelefone3" name="telefone3" >
                        </div>
                        <div class="form-group">
                            <label for="editarEmail">Email</label>
                            <input type="email" class="form-control" id="editarEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="editarcep">CEP</label>
                            <input type="text" class="form-control" id="editarCep" name="cep" required>
                        </div>
                        <div class="form-group">
                            <label for="editarestado">Estado</label>
                            <input type="text" class="form-control" id="editarEstado" name="estado" required>
                        </div>
                        <div class="form-group">
                            <label for="editarcidade">Cidade</label>
                            <input type="text" class="form-control" id="editarCidade" name="cidade" required>
                        </div>
                        <div class="form-group">
                            <label for="editarrua">Rua</label>
                            <input type="text" class="form-control" id="editarRua" name="rua" required>
                        </div>
                        <div class="form-group">
                            <label for="editarnumero">Número</label>
                            <input type="number" class="form-control" id="editarNumero" name="numero" required>
                        </div>
                        <div class="form-group">
                            <label for="editarcomplemento">Complemento</label>
                            <input type="text" class="form-control" id="editarComplemento" name="complemento" required>
                        </div>
                        <div class="form-group">
                            <label for="editarstatus">Status</label>
                            <select class="form-control" id="editarStatus" name="status" required>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    function carregarDadosParaEdicao(idFornecedor) {
        fetch(`/adm/fornecedores/show/${idFornecedor}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do fornecedor');
                }
                return response.json();
            })
            .then(data => {
                console.log('API Response:', data);
                // Preencher os campos do formulário com os dados do cliente
                document.getElementById('editarIdFornecedor').value = data.id;
                document.getElementById('editarNome').value = data.nome;
                document.getElementById('editarCNPJ').value = data.cnpj;
                document.getElementById('editarTelefone1').value = data.telefone1;
                document.getElementById('editarTelefone2').value = data.telefone2;
                document.getElementById('editarTelefone3').value = data.telefone3;
                document.getElementById('editarEmail').value = data.email;
                document.getElementById('editarCep').value = data.cep;
                document.getElementById('editarEstado').value = data.estado;
                document.getElementById('editarCidade').value = data.cidade;
                document.getElementById('editarRua').value = data.rua;
                document.getElementById('editarNumero').value = data.numero;
                document.getElementById('editarComplemento').value = data.complemento;
                document.getElementById('editarStatus').value = data.status;
                

                // Abrir o modal de edição do cliente
                $('#modalEditarFornecedor').modal('show');
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes do produto:', error);
            });
    }
</script>

<!-- Modal Detalhes Fornecedor -->
<div class="modal fade" id="modalDetalhesFornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Fornecedor</h5>
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
                    <label for="detalhesTel1" class="col-sm-3 col-form-label">Telefone 1</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesTelefone1" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesTel2" class="col-sm-3 col-form-label">Telefone 2</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesTelefone2" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesTel3" class="col-sm-3 col-form-label">Telefone 3</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesTelefone3" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesEstado" class="col-sm-3 col-form-label">Estado</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesEstado" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesCidade" class="col-sm-3 col-form-label">Cidade</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesCidade" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesRua" class="col-sm-3 col-form-label">Rua</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesRua" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesNumero" class="col-sm-3 col-form-label">Número</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesNumero" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detalhesComplemento" class="col-sm-3 col-form-label">Complemento</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="detalhesComplemento" readonly>
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
                
            </div>
        </div>
    </div>
</div>

<script>
    function mostrarDetalhes(idFornecedor) {
        fetch(`/adm/fornecedores/show/${idFornecedor}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do produto');
                }
                return response.json();
            })
            .then(data => {
                // Preencha os campos do modal com os dados do cliente, ou valores padrão
                document.getElementById('detalhesNome').value = data.nome || '';
                document.getElementById('detalhesTelefone1').value = data.telefone1 || '';
                document.getElementById('detalhesTelefone2').value = data.telefone2 || '';
                document.getElementById('detalhesTelefone3').value = data.telefone3 || '';
                document.getElementById('detalhesEstado').value = data.estado || '';
                document.getElementById('detalhesCidade').value = data.cidade || '';
                document.getElementById('detalhesRua').value = data.rua || '';
                document.getElementById('detalhesNumero').value = data.numero || '';
                document.getElementById('detalhesComplemento').value = data.complemento || '';
                document.getElementById('detalhesDataCadastro').value = data.dataCadastro ? formatarData(data.dataCadastro) : '';
                document.getElementById('detalhesDataAtualizacao').value = data.dataAtualizacao ? formatarData(data.dataAtualizacao) : '';
                


                // Abra o modal de detalhes do pedido
                $('#modalDetalhesFornecedor').modal('show');
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
            $('#modalDetalhesFornecedor').modal('show');
        });
    });


    $(document).ready(function () {
        $('#dataTableHover').DataTable(); // Initialize the DataTable
    });
</script>
@endsection