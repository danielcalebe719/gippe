@extends('adm.templates.template')

@section('title', 'Agendamentos')

@section('content')

                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Agendamentos</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Agendamentos</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Agendamentos</h6>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarAgendamento">Adicionar Agendamento</button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Pedido ID</th>
                                                <th>Data Inicio</th>
                                                <th>Data Fim</th>
                                                <th>Hora Inicio</th>
                                                <th>Hora Fim</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($agendamentos as $agendamento)
                                <tr>
                                    <td>{{ $agendamento->id }}</td>
                                    <td>{{ $agendamento->idPedidos }}</td>
                                    <td>{{ $agendamento->dataInicio }}</td>
                                    <td>{{ $agendamento->dataFim }}</td>
                                    <td>{{ $agendamento->horaInicio }}</td>
                                    <td>{{ $agendamento->horaFim }}</td>

                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="carregarDadosParaEdicao('{{ $agendamento->id }}')"
                                                    data-toggle="modal" data-target="#modalEditarPedido">
                                                    Editar
                                                </button>
                                            </div>

                                            <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="abrirModalExclusao('{{ $agendamento->id }}')">
                                                    Excluir
                                                </button>
                                            </div>


                                            <div class="btn-group" role="group" aria-label="Ações do Pedido">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="mostrarDetalhes('{{ $agendamento->id }}')" data-toggle="modal"
                                                    data-target="#modalDetalhesPedido">
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

                    <!-- Modal Adicionar Agendamento -->
                    <div class="modal fade" id="modalAdicionarAgendamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Agendamento</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAdicionarAgendamento">
                                        <div class="form-group">
                                            <label for="PedidoID">PedidoID</label>
                                            <input type="text" class="form-control" id="PedidoID" name="PedidoID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="DataInicio">Data Inicio</label>
                                            <input type="date" class="form-control" id="DataInicio" name="DataInicio" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="dataFim">Data Fim</label>
                                            <input type="date" class="form-control" id="dataFim" name="dataFim" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="HoraInicio">Hora Inicio</label>
                                            <input type="time" class="form-control" id="HoraInicio" name="HoraInicio" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="HoraFim">Hora Fim</label>
                                            <input type="time" class="form-control" id="HoraFim" name="HoraFim" required>
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

                    <!-- Modal Editar Agendamento -->
                    <div class="modal fade" id="modalEditarAgendamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Agendamento</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditarAgendamento">
                                        <div class="form-group">
                                            <label for="editPedidoID">PedidoID</label>
                                            <input type="text" class="form-control" id="editPedidoID" name="PedidoID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editData Inicio">Data Inicio</label>
                                            <input type="text" class="form-control" id="editData Inicio" name="Data Inicio" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDataFim">Data Fim</label>
                                            <input type="date" class="form-control" id="editDataFim" name="dataFim" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editStatus">Status</label>
                                            <select class="form-control" id="editStatus" name="status" required>
                                                <option value="ativo">Ativo</option>
                                                <option value="inativo">Inativo</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editHora Inicio">Hora Inicio</label>
                                            <input type="Hora Inicio" class="form-control" id="editHora Inicio" name="Hora Inicio" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editHora Fim">Hora Fim</label>
                                            <input type="password" class="form-control" id="editHora Fim" name="Hora Fim" required>
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

    <!-- Modal Detalhes Agendamento -->
<div class="modal fade" id="modalDetalhesAgendamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes do Agendamento</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="form-group row">
                  <label for="detalhesPedidoID" class="col-sm-3 col-form-label">PedidoID:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesPedidoID" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="detalhesData Inicio" class="col-sm-3 col-form-label">Data Inicio:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesData Inicio" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="detalhesDataFim" class="col-sm-3 col-form-label">Data Fim:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesDataFim" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="detalhesStatus" class="col-sm-3 col-form-label">Status:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesStatus" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="detalhesHora Inicio" class="col-sm-3 col-form-label">Hora Inicio:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesHora Inicio" readonly>
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
            $('#modalDetalhesAgendamento').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>

@endsection