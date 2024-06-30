<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title>Cadastro de Pedidos</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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


<?php
include("config.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //IF geral
    $acao = $_POST['acao']; //Pega a ação crud a ser feita
    $idCliente = $_POST['idCliente'];
    $observacao = $_POST['observacao'];
    $status = $_POST['status'];
    $totalPedido = $_POST['totalPedido'];
    $dataEntrega = $_POST['dataEntrega'];
    $dataPedido = date('d/m/Y');
    $data_atualizacao = date('d/m/Y');
    switch ($acao) {
        case 'adicionar':
            $queryAdicao = mysqli_query($conn, "INSERT INTO pedidos (idCLiente, observacao, status, totalPedido, dataPedido, dataEntrega, dataAtualizacao) 
        VALUES ('$clienteId', '$observacao', '$status', '$totalPedido', '$dataPedido', DATE(NOW()), DATE(NOW())");
            break;
        case 'editar':
            $id = $_POST['idPedidos'];
            $idCliente = $_POST['idCliente'];
            $queryEdicao = mysqli_query($conn,"UPDATE pedidos SET 
            observacao = '$observacao', 
            status = '$status', 
            totalPedido = '$totalPedido',
            dataEntrega = '$dataEntrega',  
            dataAtualizacao = DATE(NOW()) 
            WHERE idPedidos = '$id'");
            //$result = mysqli_query($conn, $queryEdicao);
            break;
        case 'apagar':
            $id = $_POST['id'];
            $queryApagar = mysqli_query($conn, "DELETE FROM pedidos WHERE idPedidos = '$id'");
            header("Location: pedidos.php");
            break;

        default:
            echo 'Nenhuma ação reconhecida';
    }
}
?>
   
    

    
    <style>
        .row {
            justify-content: center;
            width: 100%;
        }
        .col.mr-2 {
            text-align: center;
        }
        .card-body {
            min-height: 100px;
        }
        .tudu {
            display: flex;
            flex-flow: column nowrap;
            align-content: center;
            height: 100%;
            justify-content: center;
        }
        .container-fluid {
            height: 80%;
        }
        .details {
            display: none;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="painel-operacional.html">
                <div class="sidebar-brand-icon">
                    <img src="img/logo/logo.png">
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="painel-operacional.html">
                    <img class='fas fa-fw fa-tachometer-alt' src="img/painel-op.png" alt="">
                    <span class="text-gray-1000">Painel Operacional</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="Clientes.html">
                    <img class='fas fa-fw fa-tachometer-alt' src="img/Clientes.png" alt="">
                    <span class="text-gray-1000">Clientes</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="cardapio.html">
                    <img class='fas fa-fw fa-tachometer-alt' src="img/cardapio.png" alt="">
                    <span class="text-gray-1000">Config cardápio</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="estoque.html">
                    <img class='fas fa-fw fa-tachometer-alt' src="img/estoque.png" alt="">
                    <span class="text-gray-1000">Estoque</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="produtos.html">
                    <img class='fas fa-fw fa-tachometer-alt' src="img/produtos.png" alt="">
                    <span class="text-gray-1000">Produtos</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="pedidos.html">
                    <img class='fas fa-fw fa-tachometer-alt' src="img/pedidos.png" alt="">
                    <span class="text-gray-1000">Pedidos</span>
                </a>
            </li>
            <hr class="sidebar-divider">
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h5 class="text-gray-1000">Olá, Pedido ID da Pessoa!</h5>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-1 small" placeholder="O que você está procurando?" aria-label="Search" aria-describedby="basic-addon2" style="border-color: #8ebba791">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="boyimg" src="img/boy.png">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

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
                                            <?php
                                            include("config.php");
                                            $conn = new mysqli($servername, $username, $password, $dbname);

                                                $queryListar = "SELECT p.idPedidos, p.idCliente, p.observacao, p.status, p.totalPedido, p.dataPedido, p.dataEntrega,
                                                c.nome
                                                FROM pedidos p
                                                LEFT JOIN clientes c
                                                ON p.idCliente = c.idClientes";
                                                $resultado = mysqli_query($conn, $queryListar);
                                            while ($row = mysqli_fetch_assoc($resultado)) {
                                                echo "<tr>";
                                                echo "<td>" . $row["idPedidos"] . "</td>";
                                                echo "<td>" . $row["nome"] . "</td>";
                                                echo "<td>" . $row["status"] . "</td>";
                                                echo "<td>" . $row["totalPedido"] . "</td>";
                                                echo "<td>" . $row["dataEntrega"] . "</td>";
                                                
                                                echo "<td>
                                                    <form method='post'>
                                                        <input type='hidden' name='id' value='" . $row["idPedidos"] . "'>
                                                        <input type='hidden' name='acao' value='apagar'>
                                                        <input class='btn btn-primary btn-sm' type='submit' value='Apagar'>
                                                    </form>
                                                    <button class='btn-editar btn btn-danger btn-sm' type='submit' data-id ='" . $row["idPedidos"] . "'  data-toggle='modal' data-target='#modalEditarPedido'>Editar</button>
                                                    <button class='btn-detalhes btn btn-info btn-sm' type='submit'  data-id ='" . $row["idPedidos"] . "' data-toggle='modal' data-target='#modalDetalhesPedido'>Detalhes</button>
                                                </td>";
                                                echo "</tr>";
                                            }
                                            ?>
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


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
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
</body>
</html>
