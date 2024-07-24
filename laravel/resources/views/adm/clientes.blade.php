<!--test-->

@extends('adm.templates.template')
@section('title', 'Clientes')
@section('content')

<style>
    
</style>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Clientes</li>
        </ol>
    </div>
@php
function formatarCPF($cpf) {
    return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
}
@endphp

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarCliente">Adicionar
                        Cliente</button>
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
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>{{ formatarCPF($cliente->cpf) }}</td>
                                    <td>{{ $cliente->dataNascimento }}</td>
                                    <td>{{ $cliente->status }}</td>
                                    <td>{{ $cliente->email }}</td>



                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $cliente->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarCliente">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $cliente->id }}')">
                                                    Excluir
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    onclick="mostrarEnderecos('{{ $cliente->id }}')">
                                                    Ver Endereços
                                                </button>
                                            </div>

                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $cliente->id }}')" data-toggle="modal"
                                                    data-target="#modalDetalhesCliente">
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
    <!-- Modal Detalhes Endereços -->
    <div class="modal fade" id="modalEnderecos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes do Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarEndereco" onclick="prepararAdicionarEndereco()"
                       >Adicionar
                        Endereço</button>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <th>Id</th>
                                <th>Tipo</th>
                                <th>CEP</th>
                                <th>Cidade</th>
                                <th>Bairro</th>
                                <th>Rua</th>
                                <th>Número</th>
                                <th>Complemento</th>
                                <th>Ações</th>
                            </thead>
                            <tbody id="tbodyEndereco">

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let idClienteAtual;

        //Preencher os campos do moodal detalhes
        function mostrarEnderecos(idCliente) {
    idClienteAtual = idCliente;
    fetch(`/adm/clientes/showEnderecos/${idCliente}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao carregar os detalhes do cliente');
            }
            return response.json();
        })
        .then(response => {
            $('#tbodyEndereco').empty();

            // Preencher a tabela com os endereços
            $(response).each(function (i) {
                $('#tbodyEndereco').append(
                    "<tr>" +
                    "<td>" + response[i].id + "</td>" +
                    "<td>" + response[i].tipo + "</td>" +
                    "<td>" + response[i].cep + "</td>" +
                    "<td>" + response[i].cidade + "</td>" +
                    "<td>" + response[i].bairro + "</td>" +
                    "<td>" + response[i].rua + "</td>" +
                    "<td>" + response[i].numero + "</td>" +
                    "<td>" + response[i].complemento + "</td>" +
                    "<td>" +
                    "<div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>" +
                    "<div class='btn-group mr-2' role='group' aria-label='Ações do Cliente'>" +
                    "<button class='btn btn-primary btn-sm' onclick='carregarDadosParaEdicaoEndereco(" + response[i].id + ")' data-toggle='modal'>Editar</button>" +
                    "</div>" +
                    "<div class='btn-group mr-2' role='group' aria-label='Ações do Cliente'>" +
                    "<button type='button' class='btn btn-danger btn-sm' onclick='abrirModalExclusaoEndereco(" + response[i].id + ")'>Excluir</button>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "</tr>"
                );
            });

            // Abrir o modal de detalhes do cliente
            $('#modalEnderecos').modal('show');
        })
        .catch(error => {
            console.error('Erro ao carregar os detalhes do cliente:', error);
            // Mesmo se ocorrer um erro, abrir o modal para mostrar a mensagem de erro
            $('#tbodyEndereco').empty().append('<tr><td colspan="9">Não há endereços cadastrados.</td></tr>');
            $('#modalEnderecos').modal('show');
        });
}
        
        function prepararAdicionarEndereco() {
    document.getElementById('adicionarIdCliente').value = idClienteAtual;
    $('#modalAdicionarEndereco').modal('show');
}
    </script>
    <!-- Modal Adicionar Endereço -->
    <div class="modal fade" id="modalAdicionarEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarEndereco" action="/adm/clientes/guardarEndereco" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="adicionarIdCliente" name="idClientes" value="">
                        <div class="form-group">
                            <label for="nome">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="residencial">Residencial</option>
                                <option value="comercial">Comercial</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CEP</label>
                            <input type="text" class="form-control cep" id="cep" name="cep" required>
                        </div>
                        <div class="form-group">
                            <label for="dataNascimento">Cidade</label>
                            <input type="text" class="form-control cidade" id="cidade" name="cidade" required>
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control bairro" name="bairro" id="bairro">
                        </div>

                        <div class="form-group">
                            <label for="email">Rua</label>
                            <input type="text" class="form-control logradouro" id="logradouro" name="rua" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Número</label>
                            <input type="number" class="form-control" id="numero" name="numero" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Endereço -->
    <div class="modal fade" id="modalEditarEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarEndereco" action="/adm/clientes/guardarEndereco" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="editarIdEndereco" name="idEndereco">
                        <input type="hidden" id="editarIdClientes" name="idClientes">
                        <div class="form-group">
                            <label for="nome">Tipo</label>
                            <select class="form-control" name="tipo" id="editarTipo" value="">
                                <option value="residencial">Residencial</option>
                                <option value="comercial">Comercial</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CEP</label>
                            <input type="text" class="form-control cep" id="editarCep" name="cep" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="dataNascimento">Cidade</label>
                            <input type="text" class="form-control cidade" id="editarCidade" name="cidade" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control bairro" id="editarBairro" name="bairro" value="">
                        </div>

                        <div class="form-group">
                            <label for="email">Rua</label>
                            <input type="text" class="form-control logradouro" id="editarLogradouro" name="rua" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Número</label>
                            <input type="number" class="form-control" id="editarNumero" name="numero" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Complemento</label>
                            <input type="text" class="form-control" id="editarComplemento" name="complemento" value=""
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function carregarDadosParaEdicaoEndereco(idEndereco) {
            fetch(`/adm/clientes/showEndereco/${idEndereco}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do cliente');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('API Response:', data); // Log the API response

                    // Preencher os campos do formulário com os dados do cliente
                    document.getElementById('editarIdEndereco').value = data.id;
                    document.getElementById('editarIdClientes').value = data.idClientes;
                    document.getElementById('editarTipo').value = data.tipo;
                    document.getElementById('editarCep').value = data.cep;
                    document.getElementById('editarCidade').value = data.cidade;
                    document.getElementById('editarBairro').value = data.bairro;
                    document.getElementById('editarLogradouro').value = data.rua;
                    document.getElementById('editarNumero').value = data.numero;
                    document.getElementById('editarComplemento').value = data.complemento;



                    // Abrir o modal de edição do cliente
                    $('#modalEditarEndereco').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do cliente:', error);
                });
        }





    </script>

    <div class="modal fade" id="modalConfirmarExclusaoEndereco" tabindex="-1" role="dialog"
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
                    <p>Tem certeza de que deseja excluir este cliente?</p>
                    <input type="hidden" id="excluirIdEndereco">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarExclusaoEndereco">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Função para abrir o modal de confirmação de exclusão
        function abrirModalExclusaoEndereco(idEndereco) {
            document.getElementById('excluirIdEndereco').value = idEndereco;
            $('#modalConfirmarExclusaoEndereco').modal('show');
        }

        // Função para confirmar a exclusão
        document.getElementById('confirmarExclusaoEndereco').addEventListener('click', function () {
            var idEndereco = document.getElementById('excluirIdEndereco').value;

            // Enviar requisição AJAX para excluir o cliente
            fetch(`/adm/clientes/removerEndereco/${idEndereco}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao excluir o cliente');
                    }
                    return response.json();
                })
                .then(data => {
                    // Fechar o modal de confirmação de exclusão
                    $('#modalConfirmarExclusaoEndereco').modal('hide');

                    // Remover a linha do cliente na tabela, se existir
                    let enderecoRow = document.getElementById(`enderecoRow${idEndereco}`);
                    if (enderecoRow) {
                        enderecoRow.remove();
                    } else {
                        console.warn(`Elemento enderecoRow${idEndereco} não encontrado para remoção.`);
                    }

                    // Exibir mensagem de sucesso
                    location.replace(location.href)

                })
                .catch(error => {
                    console.log(error)
                    console.error('Erro ao excluir o cliente:', error);
                    alert('Erro ao excluir o clienteeeeeeee');
                });
        });
    </script>
    <!-- Modal Adicionar Cliente -->
    <div class="modal fade" id="modalAdicionarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarCliente" action="/adm/clientes/guardar" method="POST"
                        enctype="multipart/form-data">
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
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="telefone" class="form-control" id="telefone" name="telefone" required>
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



    <script>
        $(document).ready(function () {
            // Função para limpar os campos do formulário
            function limpaFormularioCEP() {
                $(".logradouro").val(""); // Limpa o campo logradouro
                $(".bairro").val(""); // Limpa o campo bairro
                $(".cidade").val(""); // Limpa o campo cidade

            }

            // Evento "blur" para detectar quando o usuário termina de digitar o CEP
            $("#cep").blur(function () {
                var cep = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico do CEP
                if (cep !== "") {
                    var validacep = /^[0-9]{8}$/; // Expressão regular para validar o formato do CEP
                    if (validacep.test(cep)) {
                        // Preenche os campos com "..." enquanto a busca está sendo realizada
                        $("#logradouro").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");


                        // Faz a requisição para a API ViaCEP
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
                            if (!("erro" in dados)) {
                                // Atualiza os campos do formulário com os dados recebidos
                                $("#logradouro").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);

                            } else {
                                // CEP não encontrado
                                limpaFormularioCEP();
                                alert("CEP não encontrado.");
                            }
                        });
                    } else {
                        // CEP em formato inválido
                        limpaFormularioCEP();
                        alert("Formato de CEP inválido.");
                    }
                } else {
                    // CEP sem valor, limpa formulário
                    limpaFormularioCEP();
                }
            });
        });
    </script>


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
                    <p>Tem certeza de que deseja excluir este cliente?</p>
                    <input type="hidden" id="excluirIdCliente">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarExclusao">Excluir</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Editar Cliente -->
    <div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarCliente" method="POST" action="/adm/clientes/guardar"
                        enctype="multipart/form-data">
                        @csrf

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
                                <input type="text" class="form-control" id="editarCpf" name="cpf">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editarDataNascimento" class="col-sm-3 col-form-label">Data de
                                Nascimento:</label>
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
                        <!-- <div class="form-group row">
                                <label for="editarSenha" class="col-sm-3 col-form-label">Senha:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="editarSenha" name="senha">
                                </div>
                            </div>-->
                        <div class="form-group row">
                            <label for="editarTelefone" class="col-sm-3 col-form-label">Telefone:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="editarTelefone" name="telefone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editarImgCaminho" class="col-sm-3 col-form-label">Imagem de Perfil:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" id="" name="caminhoImagem">
                                <img id="editarCaminhoImagem" class="form-control-file" src="" alt="Imagem do Produto" style="max-width: 150px; height: auto; border-radius: 70px;">
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
    <div class="modal fade" id="modalDetalhesCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                        
                        <img id="detalhesImgPerfil" class="form-control-file" src="" alt="Imagem do Produto" style="max-width: 150px; height: auto; border-radius: 70px;">
                    </div>
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
                        <label for="detalhesEmail" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesEmail" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="detalhesTelefone" class="col-sm-3 col-form-label">Telefone:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesTelefone" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="detalhesStatus" class="col-sm-3 col-form-label">Status:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalhesStatus" readonly>
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
                    
                    
                    <!-- <div class="form-group">
                        <label for="detalhesImgPerfil">Imagem de Perfil</label><br>
                        <div class="img-container">
                            <img id="detalhesCaminhoImagem" src="" class="img-fluid img-thumbnail" alt="Imagem de Perfil"
                                style="max-width: 200px;">
                        </div>
                    </div> -->


                </div>
            </div>
        </div>
    </div>




    <script>
        // Função para abrir o modal de confirmação de exclusão
        function abrirModalExclusao(idCliente) {
            document.getElementById('excluirIdCliente').value = idCliente;
            $('#modalConfirmarExclusao').modal('show');
        }

        // Função para confirmar a exclusão
        document.getElementById('confirmarExclusao').addEventListener('click', function () {
            var idCliente = document.getElementById('excluirIdCliente').value;

            // Enviar requisição AJAX para excluir o cliente
            fetch(`/adm/clientes/remover/${idCliente}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao excluir o cliente');
                    }
                    return response.json();
                })
                .then(data => {
                    // Fechar o modal de confirmação de exclusão
                    $('#modalConfirmarExclusao').modal('hide');

                    // Remover a linha do cliente na tabela, se existir
                    let clienteRow = document.getElementById(`clienteRow${idCliente}`);
                    if (clienteRow) {
                        clienteRow.remove();
                    } else {
                        console.warn(`Elemento clienteRow${idCliente} não encontrado para remoção.`);
                    }

                    // Exibir mensagem de sucesso
                    location.replace(location.href)

                })
                .catch(error => {
                    console.log(error)
                    console.error('Erro ao excluir o cliente:', error);
                    alert('Erro ao excluir o clienteeeeeeee');
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

        //Preencher os campos do moodal detalhes
        function formatarDataEdit(data) {
    if (!data) return '';

    const dataObj = new Date(data);
    const dia = String(dataObj.getDate()).padStart(2, '0');
    const mes = String(dataObj.getMonth() + 1).padStart(2, '0');
    const ano = dataObj.getFullYear();

    return `${dia}/${mes}/${ano}`;
}

function formatarCPF(cpf) {
    if (!cpf) return '';
    
    // Remover qualquer caractere que não seja número
    cpf = cpf.replace(/\D/g, '');
    
    // Aplicar a máscara de CPF
    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

function formatarTelefone(telefone) {
    if (!telefone) return '';
    
    // Remover qualquer caractere que não seja número
    telefone = telefone.replace(/\D/g, '');
    
    // Aplicar a máscara de telefone (considerando que pode ser com 8 ou 9 dígitos no número)
    if (telefone.length === 11) {
        return telefone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
    } else if (telefone.length === 10) {
        return telefone.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
    }

    return telefone; // Retornar o telefone sem formatação se o comprimento não for esperado
}

function mostrarDetalhes(idCliente) {
    fetch(`/adm/clientes/show/${idCliente}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao carregar os detalhes do cliente');
            }
            return response.json();
        })
        .then(data => {
            // Preencha os campos do modal com os dados do cliente, ou valores padrão
            document.getElementById('detalhesId').value = data.id || '';
            document.getElementById('detalhesNome').value = data.nome || '';
            document.getElementById('detalhesCPF').value = formatarCPF(data.cpf) || '';
            document.getElementById('detalhesDataNascimento').value = formatarDataEdit(data.dataNascimento) || '';
            document.getElementById('detalhesDataCadastro').value = formatarDataEdit(data.dataCadastro) || '';
            document.getElementById('detalhesDataAtualizacao').value = formatarDataEdit(data.dataAtualizacao) || '';
            document.getElementById('detalhesStatus').value = data.status || '';
            document.getElementById('detalhesEmail').value = data.email || '';
            document.getElementById('detalhesTelefone').value = formatarTelefone(data.telefone) || ''; // Formatação do telefone

            // Atualize o src da imagem
            const imgPath = data.caminhoImagem ? `/storage/ImagensClientes/${data.caminhoImagem}` : 'default-image-path.jpg';
            document.getElementById('detalhesImgPerfil').src = imgPath;

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



        






        

        function carregarDadosParaEdicao(idCliente) {
            fetch(`/adm/clientes/show/${idCliente}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao carregar os detalhes do cliente');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('API Response:', data); // Log the API response

                    // Preencher os campos do formulário com os dados do cliente
                    document.getElementById('editarIdCliente').value = data.id;
                    document.getElementById('editarNome').value = data.nome;
                    document.getElementById('editarCpf').value = formatarCPF(data.cpf);

                    // Format the date for display
                    
                    document.getElementById('editarDataNascimento').value = data.dataNascimento;

                    document.getElementById('editarStatus').value = data.status;
                    document.getElementById('editarEmail').value = data.email;
                    document.getElementById('editarTelefone').value = formatarTelefone(data.telefone) || '';

                    //document.getElementById('editarSenha').value = data.senha;


                    const imgPath = data.caminhoImagem ? `/storage/ImagensClientes/${data.caminhoImagem}` : 'default-image-path.jpg';
            document.getElementById('editarCaminhoImagem').src = imgPath;

                    // Abrir o modal de edição do cliente
                    $('#modalEditarCliente').modal('show');
                })
                .catch(error => {
                    console.error('Erro ao carregar os detalhes do cliente:', error);
                });
        }

        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>

    @endsection





    <!-- Modal Adicionar Endereço 
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

        <!-- Modal Visualizar Endereço 
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
    </div>-->