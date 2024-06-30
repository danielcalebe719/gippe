

@extends('adm.templates.template')

@section('title', 'Pedidos')

@section('content')




<script>
    $(document).ready(function() {
        $('.btn-editar, .btn-detalhes').click(function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            var targetModal = $(this).data('target');

            $.ajax({
                type: 'POST',
                url: 'consultaPedidos.php',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.error) {
                        console.error(response.error);
                    } else {
                        // Populating the Edit Modal
                        if (targetModal === '#modalEditarPedido') {
                            $('#EditarIdPedido').val(response.idPedidos);
                            $('#EditarIdCliente').val(response.idCliente);
                            $('#EditarObservacao').val(response.observacao);
                            $('#EditarStatus').val(response.status);
                            $('#EditarTotalPedido').val(response.totalPedido);
                            $('#EditarDataEntrega').val(response.dataEntrega);
                            
                        }
                        // Populating the Details Modal
                        else if (targetModal === '#modalDetalhesPedido') {
                            $('#DetalhesIdPedidos').val(response.idPedidos);
                            $('#DetalhesObservacao').val(response.observacao);
                            $('#DetalhesDataPedido').val(response.dataPedido);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                    console.error("Response: " + xhr.responseText);
                }
            });
        });

        $('.btn-salvar').click(function(event) {
            event.preventDefault();
            var id = $(this).data('id');
        });
    });
</script>

<style>
    .alert {
        display: none;
    }
</style>




                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Pedidos</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Pedidos</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pedidos</h6>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarPedido">Adicionar Pedido</button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Cliente ID</th>
                                                <th>STATUS</th>
                                                <th>Total Pedido</th>
                                                <th>Data Entrega</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
    <tr>
        <td>1</td>
        <td>João da Silva</td>
        <td>Pendente</td>
        <td>R$ 150,00</td>
        <td>2024-07-01</td>
        <td>
            <form method='post'>
                <input type='hidden' name='id' value='1'>
                <input type='hidden' name='acao' value='apagar'>
                <input class='btn btn-primary btn-sm' type='submit' value='Apagar'>
            </form>
            <button class='btn-editar btn btn-danger btn-sm' type='submit' data-id='1' data-toggle='modal' data-target='#modalEditarPedido'>Editar</button>
            <button class='btn-detalhes btn btn-info btn-sm' type='submit' data-id='1' data-toggle='modal' data-target='#modalDetalhesPedido'>Detalhes</button>
        </td>
    </tr>
    <tr>
        <td>2</td>
        <td>Maria Souza</td>
        <td>Entregue</td>
        <td>R$ 250,00</td>
        <td>2024-07-02</td>
        <td>
            <form method='post'>
                <input type='hidden' name='id' value='2'>
                <input type='hidden' name='acao' value='apagar'>
                <input class='btn btn-primary btn-sm' type='submit' value='Apagar'>
            </form>
            <button class='btn-editar btn btn-danger btn-sm' type='submit' data-id='2' data-toggle='modal' data-target='#modalEditarPedido'>Editar</button>
            <button class='btn-detalhes btn btn-info btn-sm' type='submit' data-id='2' data-toggle='modal' data-target='#modalDetalhesPedido'>Detalhes</button>
        </td>
    </tr>
    <tr>
        <td>3</td>
        <td>Carlos Oliveira</td>
        <td>Em andamento</td>
        <td>R$ 180,00</td>
        <td>2024-07-03</td>
        <td>
            <form method='post'>
                <input type='hidden' name='id' value='3'>
                <input type='hidden' name='acao' value='apagar'>
                <input class='btn btn-primary btn-sm' type='submit' value='Apagar'>
            </form>
            <button class='btn-editar btn btn-danger btn-sm' type='submit' data-id='3' data-toggle='modal' data-target='#modalEditarPedido'>Editar</button>
            <button class='btn-detalhes btn btn-info btn-sm' type='submit' data-id='3' data-toggle='modal' data-target='#modalDetalhesPedido'>Detalhes</button>
        </td>
    </tr>
</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Adicionar Pedido -->
                    <div class="modal fade" id="modalAdicionarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Pedido</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAdicionarPedido" method="post" action="pedidos_cadastro_salvar.php">
                                        <div class="form-group">
                                        <input type="hidden" name="acao" id="acao" value="adicionar">
                                            <label for="Cliente ID">Cliente ID</label>
                                            <input type="text" class="form-control" id="idCliente" name="idCliente" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="observacao">Observação</label>
                                            <input type="text" class="form-control" id="observacao" name="observacao" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="pendente">Pendente</option>
                                                <option value="aceito">Aceito</option>
                                                <option value="cancelado">Cancelado</option>
                                                <option value="entregue">Entregue</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Total Pedido">Total Pedido</label>
                                            <input type="Total Pedido" class="form-control" id="totalPedido" name="totalPedido" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="dataEntrega">Data Entrega</label>
                                            <input type="date" class="form-control" id="dataEntrega" name="dataEntrega" required>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar Pedido -->
                    <div class="modal fade" id="modalEditarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Pedido</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditarPedido" method="POST" >
                                        <div class="form-group">
                                                <input type="hidden" name="acao" id="acao" value="editar">
                                                <label for="editID">ID</label>
                                                <input type="text" class="form-control" id="EditarIdPedido" name="idPedidos" value="" required>
                                        </div>
                                        <div class="form-group">
                                        
                                            <label for="editClienteID">Cliente ID</label>
                                            <input type="text" class="form-control" id="EditarIdCliente" name="idCliente" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editobservacao">Observação</label>
                                            <input type="text" class="form-control" id="EditarObservacao" name="observacao" value="" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="editDataEntrega">Data de Entrega</label>
                                            <input type="date" class="form-control" id="EditarDataEntrega" name="dataEntrega" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editStatus">Status</label>
                                            <select class="form-control" id="EditarStatus" name="status"  required>
                                              <option value="Pendente">Pendente</option>
                                              <option value="Aceito">Aceito</option>
                                              <option value="Cancelado">Cancelado</option>
                                              <option value="Entregue">Entregue</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editTotal Pedido">Total Pedido</label>
                                            <input type="Total Pedido" class="form-control" id="EditarTotalPedido" name="totalPedido" value="" required>
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

    <!-- Modal Detalhes Pedido -->
    
<div  class="modal fade" id="modalDetalhesPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes do Pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          
          <div id="pedidoContent" class="modal-body">
          
              <div class="form-group row">
              <input type="hidden" name="acao" id="acao" value="editar">
                  <label for="DetalhesIdPedido" class="col-sm-3 col-form-label">Pedido ID:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="DetalhesIdPedidos" name="idPedidos" value="" readonly>
                    </div>
              </div>
              <div class="form-group row">
                  <label for="DetalhesObservacao" class="col-sm-3 col-form-label">Observação:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="DetalhesObservacao" value="" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="DetalhesDataPedido" class="col-sm-3 col-form-label">Data de Pedido:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="DetalhesDataPedido" value="" readonly>
                  </div>
              </div>
              
              <!-- Botão para abrir modal de feedback -->
              <button type="button" class="btn btn-info btn-sm" id="btnFeedback">Visualizar Feedback</button>
          </div>
          
      </div>
  </div>
</div>

<!-- Modal Feedback do Pedido -->
<div class="modal fade" id="modalFeedbackPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Feedback do Pedido</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <!-- Aqui serão exibidos os detalhes do feedback do pedido -->
              <div id="feedbackContent"></div>
          </div>
      </div>
  </div>
                                            </div>


    <script>
      
    // $(document).ready(function () {
    //     // Abrir o modal de detalhes ao clicar no botão
    //     $('#dataTableHover').on('click', '.btn-detalhes', function () {
    //         $('#modalDetalhesPedido').modal('show');
    //     });
    // });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>

<script>
  $(document).ready(function () {
      // Abrir o modal de feedback ao clicar no botão
      $('#btnFeedback').on('click', function () {
          // Você precisa obter os detalhes do feedback do pedido via AJAX e exibi-los dentro do modal
          var idPedido = $('#detalhesPedidoID').val();

          // Fazer uma requisição AJAX para obter os detalhes do feedback do pedido
          $.ajax({
              type: "GET",
              url: "obter_feedback_pedido.php",
              data: { idPedido: idPedido },
              success: function (response) {
                  // Exibir os detalhes do feedback do pedido dentro do modal
                  $('#feedbackContent').html(response);
                  $('#modalFeedbackPedido').modal('show');
              },
              error: function (xhr, status, error) {
                  alert("Erro ao obter feedback do pedido: " + xhr.responseText);
              }
          });
      });
  });
</script>
@endsection