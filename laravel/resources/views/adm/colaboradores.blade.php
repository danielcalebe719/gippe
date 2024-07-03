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
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarColaborador">Adicionar Serviço</button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
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
                                                <td>Joao</td>
                                                <td>Joao@222</td>
                                                <td>****</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditarColaborador">Editar</button>
                                                    <button class="btn btn-danger btn-sm" onclick="excluirColaborador(1)">Excluir</button>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDetalhesColaborador">Detalhes</button>
                                               
                                                </td>
                                            </tr>
                                            <!-- Fim do exemplo -->
                                        </tbody>
                                    </table>
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
                                    <form id="formAdicionarColaborador">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="senha">Senha</label>
                                            <input type="text" class="form-control" id="senha" name="senha">
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
                                    <form id="formEditarColaborador">
                        
                                        <div class="form-group">
                                            <label for="editarNome">Nome</label>
                                            <input type="text" class="form-control" id="editarNome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editarEmail">Email</label>
                                            <input type="text" class="form-control" id="editarEmail" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editarSenha">Senha</label>
                                            <input type="password" class="form-control" id="editarSenha" name="senha" required>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
              
                </div>
            </footer>
        </div>
    </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                  
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Detalhes Colaborador -->
<div class="modal fade" id="modalDetalhesColaborador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes do Colaborador</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          Sem detalhes para visualizar...
              <div class="form-group row">
                  <label for="detalhesNome Serviço" class="col-sm-3 col-form-label"></label>
                  <div class="col-sm-9">
                      <!--<input type="text" class="form-control" id="detalhesNome Serviço" readonly>-->
                  </div>
              </div>

              
            
              </div>
          </div>
      </div>
  </div>
</div>


    <script>
      
    $(document).ready(function () {
        // Abrir o modal de detalhes ao clicar no botão
        $('#dataTableHover').on('click', '.btn-detalhes', function () {
            $('#modalDetalhesColaborador').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>
@endsection