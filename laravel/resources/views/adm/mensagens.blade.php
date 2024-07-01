@extends('adm.templates.template')

@section('title', 'Mensagens')

@section('content')
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Mensagenss</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Mensagenss</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Mensagens</h6>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarMensagens">Adicionar Mensagens</button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Assunto</th>
                                                <th>Data Envio</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aqui vai o conteúdo da tabela vindo do banco de dados -->
                                            <!-- Exemplo estático para ilustrar -->
                                            <tr>
                                                <td>1</td>
                                                <td>Claudio</td>
                                                <td>Emai@sdal</td>
                                                <td>Assunto isso</td>
                                                <td>15/02/2024</td>
    
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditarMensagens">Editar</button>
                                                    <button class="btn btn-danger btn-sm" onclick="excluirMensagens(1)">Excluir</button>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDetalhesMensagens">Detalhes</button>
                                               
                                                </td>
                                            </tr>
                                            <!-- Fim do exemplo -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Adicionar Mensagens -->
                    <div class="modal fade" id="modalAdicionarMensagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Mensagens</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAdicionarMensagens">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="assunto">Assunto/label>
                                            <input type="text" class="form-control" id="assunto" name="assunto" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mensagem">Mensagem</label>
                                            <input type="mensagem" class="form-control" id="mensagem" name="mensagem" required>
                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar Mensagens -->
                    <div class="modal fade" id="modalEditarMensagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Mensagens</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditarMensagens">
                                        <div class="form-group">
                                            <label for="EditNome">Nome</label>
                                            <input type="text" class="form-control" id="EditNome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="EditEmail">Email</label>
                                            <input type="email" class="form-control" id="EditEmail" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="EditAssunto">Assunto/label>
                                            <input type="text" class="form-control" id="EditAssunto" name="assunto" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="EditMensagem">Mensagem</label>
                                            <input type="mensagem" class="form-control" id="EditMensagem" name="mensagem" required>
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

    <!-- Modal Detalhes Mensagens -->
<div class="modal fade" id="modalDetalhesMensagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes das Mensagens</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="form-group row">
                  <label for="detalhesNome" class="col-sm-3 col-form-label">Nome</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesNome" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="detalhesMensagem" class="col-sm-3 col-form-label">Mensagem</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesMensagem" readonly>
                  </div>
              </div>
              <div class="form-group row">
                <label for="detalhesDataEnvio" class="col-sm-3 col-form-label">Data de Envio:</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="detalhesDataEnvio" readonly>
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
            $('#modalDetalhesMensagens').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>
@endsection