@extends('adm.templates.template')

@section('title', 'Produtos')

@section('content')

                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Produtos</li>
                        </ol>
                    </div>
 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Produtos</h6>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarProduto">Adicionar Produto</button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Tipo</th>
                                                <th>STATUS</th>
                                                <th>Quantidade</th>
                                                <th>Preço Unitário</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->id }}</td>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->tipo }}</td>
                                    <td>{{ $produto->status }}</td>
                                    <td>{{ $produto->quantidade }}</td>
                                    <td>{{ $produto->percoUnitario }}</td>


                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm" onclick="carregarDadosParaEdicao('{{ $produto->id }}')" data-toggle="modal" data-target="#modalEditarCliente">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="abrirModalExclusao('{{ $produto->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm" onclick="mostrarDetalhes('{{ $produto->id }}')" data-toggle="modal" data-target="#modalDetalhesCliente">
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

                    <!-- Modal Adicionar Produto -->
                    <div class="modal fade" id="modalAdicionarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAdicionarProduto">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Descrição">Descrição</label>
                                            <input type="text" class="form-control" id="Descrição" name="Descrição" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Tipo</label>
                                            <select class="form-control" id="tipo" name="tipo" required>
                                                <option value="salgado">Salgado</option>
                                                <option value="doce">Doce</option>
                                                <option value="bebida">Bebida</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="ativo">Ativo</option>
                                                <option value="inativo">Inativo</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Quantidade">Quantidade</label>
                                            <input type="number" class="form-control" id="Quantidade" name="Quantidade" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="QuantidadeProducao">Quantidade por Producão</label>
                                            <input type="number" class="form-control" id="QuantidadeProducao" name="QuantidadeProducao" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Preço Unitário">Preço Unitário</label>
                                            <input type="number" class="form-control" id="Preço Unitário" name="Preço Unitário" required>
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

                    <!-- Modal Editar Produto -->
                    <div class="modal fade" id="modalEditarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditarProduto">
                                        <div class="form-group">
                                            <label for="editNome">Nome</label>
                                            <input type="text" class="form-control" id="editNome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDescrição">Descrição</label>
                                            <input type="text" class="form-control" id="editDescrição" name="Descrição" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDataNascimento">Tipo</label>
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
                                            <label for="editQuantidade">Quantidade</label>
                                            <input type="Quantidade" class="form-control" id="editQuantidade" name="Quantidade" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editQuantidadeProducao">Quantidade Produção</label>
                                            <input type="text" class="form-control" id="editQuantidadeProducao" name="QuantidadeProducao" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editPreço Unitário">Preço Unitário</label>
                                            <input type="password" class="form-control" id="editPreço Unitário" name="Preço Unitário" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editImgPerfil">Imagem de Perfil</label>
                                            <input type="file" class="form-control-file" id="editImgPerfil" name="imgPerfil">
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

    <!-- Modal Detalhes Produto -->
<div class="modal fade" id="modalDetalhesProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes do Produto</h5>
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
                  <label for="detalhesDescrição" class="col-sm-3 col-form-label">Descrição:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesDescrição" readonly>
                  </div>
              </div>
              <div class="form-group row">
                <label for="detalhesQuantidadeProducao" class="col-sm-3 col-form-label">Quantidade por produção/label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="detalhesQuantidadeProducao" readonly>
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
              <div class="form-group row">
                  <label for="detalhesImgPerfil" class="col-sm-3 col-form-label">Imagem de Perfil:</label>
                  <div class="col-sm-9">
                      <img src="" alt="Imagem de Perfil" id="detalhesImgPerfil" style="max-width: 100%;">
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
            $('#modalDetalhesProduto').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>
@endsection
