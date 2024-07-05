@extends('adm.templates.template')

@section('title', 'Serviços')

@section('content')
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Servicos</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Servicos</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Servicos</h6>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarServico">Adicionar Serviço</button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome Serviço</th>
                                                <th>Total Serviços</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($servicos as $servico)
                                <tr>
                                    <td>{{ $servico->id }}</td>
                                    <td>{{ $servico->nomeServico }}</td>
                                    <td>{{ $servico->totalServicos }}</td>
                                    


                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-primary btn-sm" onclick="carregarDadosParaEdicao('{{ $servico->id }}')" data-toggle="modal" data-target="#modalEditarCliente">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="abrirModalExclusao('{{ $servico->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Cliente">
                                                <button class="btn btn-info btn-sm" onclick="mostrarDetalhes('{{ $servico->id }}')" data-toggle="modal" data-target="#modalDetalhesCliente">
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

                    <!-- Modal Adicionar Servico -->
                    <div class="modal fade" id="modalAdicionarServico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Servico</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAdicionarServico">
                                        <div class="form-group">
                                            <label for="NomeServiço">Nome Serviço</label>
                                          <select name="NomeServico" id="NomeServico">
                                            <option value="FestaPequena">Festa Pequena</option>
                                            <option value="FestaMedia">Festa Média</option>
                                            <option value="FestaGrande">Festa Grande</option>
                                            <option value="FestaPersonalizada">Festa Personalizada</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Totalservicos">Total serviços</label>
                                            <input type="number" class="form-control" id="Totalservicos" name="Totalservicos" required>
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

                    <!-- Modal Editar Servico -->
                    <div class="modal fade" id="modalEditarServico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Servico</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditarServico">
                                        <div class="form-group">
                                            <label for="editNome Serviço">Nome Serviço</label>
                                            <select name="NomeServico" id="NomeServico">
                                                <option value="FestaPequena">Festa Pequena</option>
                                                <option value="FestaMedia">Festa Média</option>
                                                <option value="FestaGrande">Festa Grande</option>
                                                <option value="FestaPersonalizada">Festa Personalizada</option>
                                              </select>
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="editTotalservicos">Total Serviços</label>
                                            <input type="Totalservicos" class="form-control" id="editTotalservicos" name="Totalservicos" required>
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

    <!-- Modal Detalhes Servico -->
<div class="modal fade" id="modalDetalhesServico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes do Servico</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="form-group row">
                  <label for="detalhesNome Serviço" class="col-sm-3 col-form-label">Nome Serviço:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesNome Serviço" readonly>
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
            $('#modalDetalhesServico').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>
@endsection
