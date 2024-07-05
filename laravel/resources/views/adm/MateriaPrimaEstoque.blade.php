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
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarMatériaPrima">Adicionar Matéria Prima</button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Fornecedor ID</th>
                                                <th>Classificação</th>
                                                <th>Quantidade</th>
                                                <th>Preço Unitário</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($materiasPrimas as $materiaPrima)
                                <tr>
                                    <td>{{ $materiaPrima->id }}</td>
                                    <td>{{ $materiaPrima->nome }}</td>
                                    <td>{{ $materiaPrima->idFornecedor }}</td>
                                    <td>{{ $materiaPrima->classificacao }}</td>
                                    <td>{{ $materiaPrima->quantidade }}</td>
                                    <td>{{ $materiaPrima->precoUnitario }}</td>


                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm" onclick="carregarDadosParaEdicao('{{ $materiaPrima->id }}')" data-toggle="modal" data-target="#modalEditarCliente">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="abrirModalExclusao('{{ $materiaPrima->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm" onclick="mostrarDetalhes('{{ $materiaPrima->id }}')" data-toggle="modal" data-target="#modalDetalhesCliente">
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
                    <div class="modal fade" id="modalAdicionarMatériaPrima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Matéria Prima</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAdicionarMatériaPrima">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="FornecedorID">Fornecedor ID</label>
                                            <input type="text" class="form-control" id="FornecedorID" name="FornecedorID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Classificacao">Classificação</label>
                                            <select name="Classificacao" id="Classificacao">
                                              <option value="Perecivel"> Perecível</option>
                                              <option value="NaoPerecivel"> Não Perecível</option>
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
                                    
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar Matéria Prima -->
                    <div class="modal fade" id="modalEditarMatériaPrima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Matéria Prima</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditarMatériaPrima">
                                        <div class="form-group">
                                            <label for="editNome">Nome</label>
                                            <input type="text" class="form-control" id="editNome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editFornecedor ID">Fornecedor ID</label>
                                            <input type="text" class="form-control" id="editFornecedorID" name="FornecedorID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editClassificacao">Classificação</label>
                                            <select name="Classificacao" id="editClassificacao">
                                              <option value="Perecivel"> Perecível</option>
                                              <option value="NaoPerecivel"> Não Perecível</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                          <label for="editQuantidade">Quantidade</label>
                                          <input type="number" class="form-control" id="editQuantidade" name="quantidade" required>
                                      </div>
                                        <div class="form-group">
                                            <label for="editPreçoUnitario">Preço Unitário</label>
                                            <input type="text" class="form-control" id="editPrecoUnitario" name="precoUnitario" required>
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

    <!-- Modal Detalhes Matéria Prima -->
<div class="modal fade" id="modalDetalhesMatériaPrima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
           
          </div>
      </div>
  </div>
</div>


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
      
    $(document).ready(function () {
        // Abrir o modal de detalhes ao clicar no botão
        $('#dataTableHover').on('click', '.btn-detalhes', function () {
            $('#modalDetalhesMatériaPrima').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>
@endsection
