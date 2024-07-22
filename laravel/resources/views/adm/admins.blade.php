@extends('adm.templates.template')

@section('title', 'Colaboradores')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Colaboradores</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Colaboradores</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Colaboradores</h6>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarColaborador">Adicionar Colaborador</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Permissão</th>
                                <th>Ultima vez logado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr id="adminRow{{ $admin->id }}" 
                                data-id="{{ $admin->id }}" 
                                data-nome="{{ $admin->nome }}" 
                                data-email="{{ $admin->email }}" 
                                data-permissoes="{{ $admin->permissoes }}">
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->nome }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->permissoes }}</td>
                                <td>{{ $admin->last_login }}</td>
                                <td>
                                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                            <button class="btn btn-primary btn-sm" onclick="carregarDadosParaEdicao(this)" data-toggle="modal" data-target="#modalEditarColaborador">
                                                Editar
                                            </button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="abrirModalExclusao('{{ $admin->id }}')">
                                                Excluir
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

    <!-- Modal Confirmar Exclusão -->
    <div class="modal fade" id="modalConfirmarExclusao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmarExclusaoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmarExclusaoLabel">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza de que deseja excluir este colaborador?</p>
                    <input type="hidden" id="excluirIdAdmin">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarExclusao">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Colaborador -->
    <div class="modal fade" id="modalAdicionarColaborador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Colaborador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarColaborador" method="POST" action="{{ route('admins.create') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="permissoes">Permissões</label>
                            <select name="permissoes" id="permissoes" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Colaborador -->
    <div class="modal fade" id="modalEditarColaborador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Colaborador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarColaborador" action="{{ route('admins.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="editarId" value="">
                        <div class="form-group">
                            <label for="editarNome">Nome</label>
                            <input type="text" class="form-control" id="editarNome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="editarEmail">Email</label>
                            <input type="email" class="form-control" id="editarEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="editarPermissoes">Permissões</label>
                            <select name="permissoes" id="editarPermissoes" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editarSenha">Nova Senha</label>
                            <input type="password" class="form-control" id="editarSenha" name="senha">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manipular a exclusão e edição -->
    <script>
        $(document).ready(function () {
        $('#dataTableHover').DataTable(); // Initialize the DataTable
    });
        // Função para abrir o modal de confirmação de exclusão
        function abrirModalExclusao(idAdmin) {
            $('#excluirIdAdmin').val(idAdmin);
            $('#modalConfirmarExclusao').modal('show');
        }

        // Função para carregar os dados do colaborador para o modal de edição
        function carregarDadosParaEdicao(button) {
            var row = button.closest('tr');
            var id = $(row).data('id');
            var nome = $(row).data('nome');
            var email = $(row).data('email');
            var permissoes = $(row).data('permissoes');

            $('#editarId').val(id);
            $('#editarNome').val(nome);
            $('#editarEmail').val(email);
            $('#editarPermissoes').val(permissoes);
        }

        // Função para confirmar exclusão
        $('#confirmarExclusao').click(function () {
            var idAdmin = $('#excluirIdAdmin').val();
            $.ajax({
                url: '/admins/' + idAdmin,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (result) {
                    $('#adminRow' + idAdmin).remove();
                    $('#modalConfirmarExclusao').modal('hide');
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
</div>
@endsection
