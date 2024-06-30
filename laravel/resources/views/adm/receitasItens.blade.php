@extends('adm.templates.template')

@section('title', 'Receitas Itens')

@section('content')
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Receitas Itens</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Receitas Itens</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Receitas Itens</h6>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarReceitaItem">Adicionar Receita Item</button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Produto ID</th>
                                                <th>Materia Prima ID</th>
                                                <th>Quantidade</th>
                                                <th>Valor </th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aqui vai o conteúdo da tabela vindo do banco de dados -->
                                            <!-- Exemplo estático para ilustrar -->
                                            <tr>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>11</td>
                                                <td>R$22</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditarReceitaItem">Editar</button>
                                                    <button class="btn btn-danger btn-sm" onclick="excluirReceitaItem(1)">Excluir</button>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDetalhesReceitaItem">Detalhes</button>
                                               
                                                </td>
                                            </tr>
                                            <!-- Fim do exemplo -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Adicionar ReceitaItem -->
                    <div class="modal fade" id="modalAdicionarReceitaItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Item de Receita </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAdicionarReceitaItem">
                                        <div class="form-group">
                                            <label for="ProdutoID">Produto ID</label>
                                            <input type="text" class="form-control" id="ProdutoID" name="ProdutoID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="MateriaPrimaID">Materia Prima ID</label>
                                            <input type="text" class="form-control" id="MateriaPrimaID" name="MateriaPrimaID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantidade">Quantidade</label>
                                            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="valor ">Valor </label>
                                            <input type="text" class="form-control" id="valor " name="valor" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar ReceitaItem -->
                    <div class="modal fade" id="modalEditarReceitaItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Item de Receita </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditarReceitaItem">
                                        <div class="form-group">
                                            <label for="editProdutoID">Produto ID</label>
                                            <input type="text" class="form-control" id="editProdutoID" name="ProdutoID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editMateriaPrimaID">Materia Prima ID</label>
                                            <input type="text" class="form-control" id="editMateriaPrimaID" name="MateriaPrimaID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editQuantidade">Quantidade</label>
                                            <input type="number" class="form-control" id="editQuantidade" name="quantidade" required>
                                        </div>
                                  
                                    
                                        <div class="form-group">
                                            <label for="editValor">Valor</label>
                                            <input type="text" class="form-control" id="editValor" name="valor" required>
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

    <!-- Modal Detalhes ReceitaItem -->
<div class="modal fade" id="modalDetalhesReceitaItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes do ReceitaItem</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="form-group row">
                  <label for="detalhesProdutoID" class="col-sm-3 col-form-label">Produto ID:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesProdutoID" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="detalhesMateriaPrimaID" class="col-sm-3 col-form-label">Materia Prima ID:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesMateriaPrimaID" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="detalhesQuantidade" class="col-sm-3 col-form-label">Quantidade:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesQuantidade" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="detalhesValor" class="col-sm-3 col-form-label">Valor:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesValor" readonly>
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
            $('#modalDetalhesReceitaItem').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>
@endsection
