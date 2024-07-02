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
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarFornecedor">Adicionar Fornecedor</button>
                                </div>
                                
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
                                            <!-- Aqui vai o conteúdo da tabela vindo do banco de dados -->
                                            <!-- Exemplo estático para ilustrar -->
                                            <tr>
                                                <td>1</td>
                                                <td>Casa da carne</td>
                                                <td>12345678900</td>
                                                <td>31 12345678900</td>
                                                <td>Ativo</td>
                                                <td>joao.silva@example.com</td>
                                                <td>1321321</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditarFornecedor">Editar</button>
                                                    <button class="btn btn-danger btn-sm" onclick="excluirFornecedor(1)">Excluir</button>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDetalhesFornecedor">Detalhes</button>
                                               
                                                </td>
                                            </tr>
                                            <!-- Fim do exemplo -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Modal Adicionar Fornecedor -->
                    <div class="modal fade" id="modalAdicionarFornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Fornecedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAdicionarFornecedor">
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
                                            <input type="text" class="form-control" id="tel1" name="tel1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tel2">Telefone 2</label>
                                            <input type="text" class="form-control" id="tel2" name="tel2" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="tel3">Telefone 3</label>
                                            <input type="text" class="form-control" id="tel3" name="tel3" required>
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

                    <!-- Modal Editar Fornecedor -->
                    <div class="modal fade" id="modalEditarFornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Fornecedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditarFornecedor">
                                        <div class="form-group">
                                            <label for="editNome">Nome</label>
                                            <input type="text" class="form-control" id="editNome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editCNPJ">CNPJ</label>
                                            <input type="text" class="form-control" id="editCNPJ" name="cnpj" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editTel1">Telefone 1</label>
                                            <input type="text" class="form-control" id="editTel1" name="tel1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editTel2">Telefone 2</label>
                                            <input type="text" class="form-control" id="editTel2" name="tel2" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editTel3">Telefone 3</label>
                                            <input type="text" class="form-control" id="editTel3" name="tel3" required>
                                        </div>


                                       
                                        <div class="form-group">
                                            <label for="EditEmail">Email</label>
                                            <input type="email" class="form-control" id="EditEmail" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Editcep">CEP</label>
                                            <input type="text" class="form-control" id="Editcep" name="cep" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Editestado">Estado</label>
                                            <input type="text" class="form-control" id="Editestado" name="estado" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Editcidade">Cidade</label>
                                            <input type="text" class="form-control" id="Editcidade" name="cidade" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Editrua">Rua</label>
                                            <input type="text" class="form-control" id="Editrua" name="rua" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Editnumero">Número</label>
                                            <input type="number" class="form-control" id="Editnumero" name="numero" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Editcomplemento">Complemento</label>
                                            <input type="text" class="form-control" id="Editcomplemento" name="complemento" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Editstatus">Status</label>
                                            <select class="form-control" id="Editstatus" name="status" required>
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

    <!-- Modal Detalhes Fornecedor -->
<div class="modal fade" id="modalDetalhesFornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <input type="text" class="form-control" id="detalhesTel1" readonly>
                  </div>
              </div>
              <div class="form-group row">
                <label for="detalhesTel2" class="col-sm-3 col-form-label">Telefone 2</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="detalhesTel2" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="detalhesTel3" class="col-sm-3 col-form-label">Telefone 3</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="detalhesTel3" readonly>
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
              <div class="form-group row">
                <label for="detalhesDataRemocao" class="col-sm-3 col-form-label">Data de Remoção:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="detalhesDataRemocao" readonly>
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
            $('#modalDetalhesFornecedor').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>
@endsection
