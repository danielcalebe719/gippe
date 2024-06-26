<?php 

include("menu.php");
include("funcoes.php");

// Verificar se o idClientes está na sessão
if (isset($_SESSION['idClientes']) && !empty($_SESSION['idClientes'])) {
  // Capturar o idClientes da sessão
  $idCliente = $_SESSION['idClientes'];

  // Conexão com o banco de dados
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bdtcc";

  // Criar conexão
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificar a conexão
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Consulta para obter os detalhes do cliente com base no idClientes
  $sql = "SELECT * FROM clientes WHERE idClientes = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $idCliente);
  $stmt->execute();
  $result = $stmt->get_result();

  $sqlEnderecosClientes = "SELECT * FROM EnderecosClientes WHERE idClientes = ?";
  $stmtEnderecosClientes = $conn->prepare($sqlEnderecosClientes);
  $stmtEnderecosClientes->bind_param("i", $idCliente);
  $stmtEnderecosClientes->execute();
  $resultEnderecosClientes = $stmtEnderecosClientes->get_result();

  // Verificar se encontrou algum resultado
  if ($result->num_rows > 0) {
    // Armazenar os detalhes do cliente em uma variável
    $cliente = $result->fetch_assoc();
    $EnderecosClientes = $resultEnderecosClientes->fetch_assoc();
    $imgCaminho = $cliente['imgCaminho'];
    if ($imgCaminho == null) {
      $imgCaminho = 'user.jpg';
    }

    // Consulta para obter os pedidos do cliente
    $sqlPedidos = "SELECT * FROM pedidos WHERE idCliente = ?";
    $stmtPedidos = $conn->prepare($sqlPedidos);
    $stmtPedidos->bind_param("i", $idCliente);
    $stmtPedidos->execute();
    $resultPedidos = $stmtPedidos->get_result();
  } else {
    // Se nenhum cliente foi encontrado com o idClientes fornecido, redirecione o usuário ou exiba uma mensagem de erro
    header("Location: perfil.php?cliente_nao_encontrado");
    exit();
  }
} else {
  // Se o idClientes não está na sessão, redirecione o usuário ou exiba uma mensagem de erro
  header("Location: login.php?id_nao_fornecido");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $acao = $_POST['acao'];
  if ($acao === 'editaPerfil') {
    // Pegar dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senhaDeprotegida = $_POST['senha'];
    $senha = password_hash($senhaDeprotegida, PASSWORD_DEFAULT);
    $cpf = $_POST['cpf'];
    $dataNascimento = $_POST['data_nascimento'];
    $idClientes = $cliente['idClientes']; // Certifique-se de que $cliente['idClientes'] está definido

    // Atualizar no banco de dados
    $sql = "UPDATE clientes SET nome = ?, email = ?, senha = ?, cpf = ?, dataNascimento = ? WHERE idClientes = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
      $stmt->bind_param("sssssi", $nome, $email, $senha, $cpf, $dataNascimento, $idClientes);
      if ($stmt->execute()) {
        echo '<script>window.location.href = window.location.href;</script>';
      } else {
        echo "Erro ao atualizar o perfil: " . $stmt->error;
      }

      $stmt->close();
    } else {
      echo "Erro na preparação da query: " . $conn->error;
    }
  }
}

// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao']) && $_POST['acao'] == 'editarEndereco') {
  // Verifica se o cliente já possui um endereço cadastrado
  $sql_check = "SELECT COUNT(*) AS num_rows FROM EnderecosClientes WHERE idClientes = ?";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bind_param("i", $idCliente);
  $stmt_check->execute();
  $result_check = $stmt_check->get_result();
  $row = $result_check->fetch_assoc();
  $num_rows = $row['num_rows'];

  // Decida se é um INSERT ou UPDATE
  if ($num_rows == 0) {
    // Se não existir, execute um INSERT
    $sql = "INSERT INTO EnderecosClientes (idClientes, tipo, cep, cidade, bairro, rua, numero, complemento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  } else {
    // Se existir, execute um UPDATE
    $sql = "UPDATE EnderecosClientes SET 
            tipo = ?, 
            cep = ?, 
            cidade = ?, 
            bairro = ?, 
            rua = ?, 
            numero = ?, 
            complemento = ? 
            WHERE idClientes = ?";
  }

  // Prepara a declaração
  if ($stmt = $conn->prepare($sql)) {
    // Vincula os parâmetros
    if ($num_rows == 0) {
      $stmt->bind_param("isssssss", $idCliente, $_POST['tipo'], $_POST['cep'], $_POST['cidade'], $_POST['bairro'], $_POST['rua'], $_POST['numero'], $_POST['complemento']);
    } else {
      $stmt->bind_param("sssssssi", $_POST['tipo'], $_POST['cep'], $_POST['cidade'], $_POST['bairro'], $_POST['rua'], $_POST['numero'], $_POST['complemento'], $idCliente);
    }

    // Executa a declaração
    if ($stmt->execute()) {
      echo '<script>window.location.href = window.location.href;</script>';
      exit(); // Encerre o script após redirecionar
    } else {
      echo "Erro ao atualizar o endereço: " . $stmt->error;
    }

    // Fecha a declaração
    $stmt->close();
  } else {
    echo "Erro na preparação da declaração: " . $conn->error;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Buffet Divino Sabor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+rtOIQ4GX/D7UvOsAP37+C2z8zKL4ZpV96HuP+wnRL0Kw1h" crossorigin="anonymous"></script>

  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha384-oN46R3tlTtTw9stDShs/JFcEAw9xnK5L5uJSvKrY6J7zCjtx+ZI3d2ERsmr6x6y9" crossorigin="anonymous"></script>

  <!-- Bootstrap JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Conteúdo do corpo -->

  <!-- Seção de perfil do cliente -->
  <section style="background-color: #eee;">
    <div class="container py-5">
      <!-- Detalhes do cliente -->
      <div class="row">
        <div class="col-lg-4">
          <!-- Imagem do cliente -->
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="imagensPerfil/<?php echo $cliente['imgCaminho']; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3"><?php echo $cliente['nome']; ?></h5>

              <form action="uploadimgPerfil.php" method="post" enctype="multipart/form-data">
         <div class="mb-3">
            <label for="formFileSm" class="form-label">Defina uma imagem de perfil</label>
            <input type="file" class="form-control form-control-sm"id="imagem" name="imagem">
          </div>
                
                <input type="hidden" name="idClientes" value="<?php echo $cliente['idClientes']; ?>">
                <input type="hidden" name="acao" value="imgInsercao">
                <input type="submit" value="Salvar" class="btn btn-success">
              </form>
            </div>
          </div>

          <!-- Endereço -->
          <div class="card mb-4">
            <div class="card-body">
              <h3>Endereço</h3>
              <p><strong>Tipo:</strong> <?php echo isset($EnderecosClientes['tipo']) ? $EnderecosClientes['tipo'] : ''; ?></p>
              <p><strong>CEP:</strong> <?php echo isset($EnderecosClientes['cep']) ? $EnderecosClientes['cep'] : ''; ?></p>
              <p><strong>Cidade:</strong> <?php echo isset($EnderecosClientes['cidade']) ? $EnderecosClientes['cidade'] : ''; ?></p>
              <p><strong>Bairro:</strong> <?php echo isset($EnderecosClientes['bairro']) ? $EnderecosClientes['bairro'] : ''; ?></p>
              <p><strong>Rua:</strong> <?php echo isset($EnderecosClientes['rua']) ? $EnderecosClientes['rua'] : ''; ?></p>
              <p><strong>Número:</strong> <?php echo isset($EnderecosClientes['numero']) ? $EnderecosClientes['numero'] : ''; ?></p>
              <p><strong>Complemento:</strong> <?php echo isset($EnderecosClientes['complemento']) ? $EnderecosClientes['complemento'] : ''; ?></p>
              <!-- Botão "Editar Endereço" -->
              <button id="editarEnderecoBtn" type="button" class="btn btn-link edit-endereco-btn">
                <i class="bi bi-pencil"></i> Editar Endereço
              </button>
            </div>
          </div>

        </div>
        <!-- Modal para editar endereço -->

        <div class="col-lg-8">
          <!-- Informações detalhadas do cliente -->
          <div class="card mb-4">
            <div class="card-body">
              <form action="" method="post">
                <input type="hidden" name="acao" value='editaPerfil'>
                <!-- Nome -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="nome">Nome completo</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $cliente['nome']; ?>" readonly>
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="nome"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>
                <!-- Email -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="email">Email</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $cliente['email']; ?>" readonly>
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="email"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>
                <!-- Senha -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="senha">Senha</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="password" id="senha" name="senha" class="form-control" value="<?php echo $cliente['senha']; ?>" readonly>
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="senha"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>
                <!-- CPF -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="cpf">CPF</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" id="cpf" name="cpf" class="form-control" value="<?php echo $cliente['cpf']; ?>" readonly maxlength="11">
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="cpf"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>
                <!-- Data de nascimento -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="data_nascimento">Data de nascimento</label>
                  </div>
                  <div class="col-sm-8">
                    <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="<?php if($cliente['dataNascimento'] < date('y-m-d')){ echo $cliente['dataNascimento'];}else{echo "<script>alert('Data Inválida')</script>";} ?>" readonly><!--não ta aparecendo o alert -->
                  </div>
                  <div class="col-sm-1">
                    <a href="#" class="btn btn-link edit-btn" data-target="data_nascimento"><i class="bi bi-pencil"></i></a>
                  </div>
                </div>
                <hr>
                <!-- Botão para salvar alterações -->
                <div class="row">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary" id="saveChangesBtn">Salvar Alterações</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
         <!-- Pedidos do cliente -->
<div class="card mb-4">
  <div class="card-body">
    <h3>Pedidos</h3>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID Pedido</th>
          <th scope="col">Status</th>
          <th scope="col">Data de Entrega</th>
          <th scope="col">Endereço</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Verificar se há pedidos para exibir
        if ($resultPedidos->num_rows > 0) {
          // Loop pelos pedidos
          while ($pedido = $resultPedidos->fetch_assoc()) {
            // Verificar se os campos de endereço existem e não são nulos
            $tipo = isset($EnderecosClientes['tipo']) ? $EnderecosClientes['tipo'] : '';
            $cep = isset($EnderecosClientes['cep']) ? $EnderecosClientes['cep'] : '';
            $cidade = isset($EnderecosClientes['cidade']) ? $EnderecosClientes['cidade'] : '';
            $bairro = isset($EnderecosClientes['bairro']) ? $EnderecosClientes['bairro'] : '';
            $rua = isset($EnderecosClientes['rua']) ? $EnderecosClientes['rua'] : '';
            $numero = isset($EnderecosClientes['numero']) ? $EnderecosClientes['numero'] : '';
            $complemento = isset($EnderecosClientes['complemento']) ? $EnderecosClientes['complemento'] : '';

            echo "<tr>";
            echo "<td>" . htmlspecialchars($pedido['idPedidos']) . "</td>"; // Corrigido para 'idPedidos'
            echo "<td>" . htmlspecialchars($pedido['status']) . "</td>";
            echo "<td>" . htmlspecialchars(formatarData($pedido['dataEntrega'])) . "</td>"; // Usar a função para formatar a data
            echo "<td>" . htmlspecialchars("$rua - $numero - $complemento  - $bairro -  $cidade - $cep - Tipo: $tipo " ) . "</td>"; // Mostrar endereço formatado
            echo "<td>" . htmlspecialchars(formatarParaReal($pedido['totalPedido'])) . "</td>";
            //echo "<td><a href='#'>Expandir</a></td>";
            echo "</tr>";
          }//$tipo $cep $cidade $bairro $rua $numero $complemento
        } else {
          echo "<tr><td colspan='5'>Nenhum pedido encontrado</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

          </div>
        </div>
      </div>
    </div>
  </section>







  





  <div class="modal fade" id="enderecoModal" tabindex="-1" role="dialog" aria-labelledby="enderecoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="enderecoModalLabel">Editar Endereço</h5>
                </div>
                <div class="modal-body">
                    <form id="enderecoForm" method="post">
                        <input type="hidden" name="acao" value="editarEndereco">
                        <input type="hidden" name="idClientes" value="<?php echo $cliente['idClientes']; ?>">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="comercial" <?php if (isset($EnderecosClientes['tipo']) && $EnderecosClientes['tipo'] == 'comercial') echo 'selected'; ?>>Comercial</option>
                                <option value="residencial" <?php if (isset($EnderecosClientes['tipo']) && $EnderecosClientes['tipo'] == 'residencial') echo 'selected'; ?>>Residencial</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" class="form-control" value="<?php echo htmlspecialchars(isset($EnderecosClientes['cep']) ? $EnderecosClientes['cep'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" class="form-control cep-cidade" value="<?php echo htmlspecialchars(isset($EnderecosClientes['cidade']) ? $EnderecosClientes['cidade'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" class="form-control cep-bairro" value="<?php echo htmlspecialchars(isset($EnderecosClientes['bairro']) ? $EnderecosClientes['bairro'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="rua">Rua</label>
                            <input type="text" id="rua" name="rua" class="form-control cep-logradouro" value="<?php echo htmlspecialchars(isset($EnderecosClientes['rua']) ? $EnderecosClientes['rua'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="text" id="numero" name="numero" class="form-control" value="<?php echo htmlspecialchars(isset($EnderecosClientes['numero']) ? $EnderecosClientes['numero'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" name="complemento" class="form-control" value="<?php echo htmlspecialchars(isset($EnderecosClientes['complemento']) ? $EnderecosClientes['complemento'] : ''); ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary" id="saveEnderecoBtn">Salvar mudanças</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




</body>

<script>
    // Evento de clique para abrir o modal e carregar os detalhes do pedido via AJAX
    document.getElementById("btnAbrirModal").addEventListener("click", function() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("modalBody").innerHTML = this.responseText;
                $('#modalDetalhesPedido').modal('show'); // Abre o modal
            }
        };
        xhttp.open("GET", "detalhes_pedido.php", true); // Substitua "detalhes_pedido.php" pelo caminho do arquivo PHP que contém o código para exibir os detalhes do pedido
        xhttp.send();
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    const saveChangesBtn = document.getElementById('saveChangesBtn');


    editButtons.forEach(function(btn) {
      btn.addEventListener('click', function(event) {
        event.preventDefault();
        const targetId = this.getAttribute('data-target');
        const targetInput = document.getElementById(targetId);
        targetInput.removeAttribute('readonly');
        targetInput.focus();
      });
    });
  })
  // Adiciona um evento de clique ao botão "Editar Endereço"
  const editarEnderecoBtn = document.getElementById('editarEnderecoBtn');
  const enderecoModal = document.getElementById('enderecoModal');
  const enderecoForm = document.getElementById('enderecoForm');
  const saveEnderecoBtn = document.getElementById('saveEnderecoBtn');

  document.editarEnderecoBtn.addEventListener('click', () => {
    // Exibe o modal
    $('#enderecoModal').modal('show');
  });

  // Event listener para salvar mudanças no endereço
  saveEnderecoBtn.addEventListener('click', () => {
    // Adicione aqui a lógica para salvar as alterações no endereço
    // Por exemplo, você pode pegar os dados do formulário e enviá-los para um script PHP via AJAX
    const formData = new FormData(enderecoForm);
    // Exemplo de como obter os valores do formulário:
    const tipo = formData.get('tipo');
    const cep = formData.get('cep');
    // etc.
  });
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"></script>

<script>
  document.getElementById("editarEnderecoBtn").addEventListener("click", function() {
    document.getElementById("enderecoModal").classList.add("show");
    document.getElementById("enderecoModal").style.display = "block";
    document.body.classList.add("modal-open");
    document.getElementsByClassName("modal-backdrop")[0].style.display = "block";
  });

  document.querySelectorAll('[data-dismiss="modal"]').forEach(function(el) {
    el.addEventListener("click", function() {
      document.getElementById("enderecoModal").classList.remove("show");
      document.getElementById("enderecoModal").style.display = "none";
      document.body.classList.remove("modal-open");
      document.getElementsByClassName("modal-backdrop")[0].style.display = "none";
    });
  });


  $(document).ready(function () {
            // Função para limpar o formulário de CEP
            function limpaFormularioCEP() {
                $(".cep-logradouro").val("");
                $(".cep-bairro").val("");
                $(".cep-cidade").val("");
                $(".cep-estado").val("");
            }

            // Evento "blur" para detectar quando o usuário termina de digitar o CEP
            $("#cep").blur(function() {
                var cep = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico do CEP
                if (cep !== "") {
                    var validacep = /^[0-9]{8}$/; // Expressão regular para validar o formato do CEP
                    if(validacep.test(cep)) {
                        // Preenche os campos com "..." enquanto a busca está sendo realizada
                        $(".cep-logradouro").val("...");
                        $(".cep-bairro").val("...");
                        $(".cep-cidade").val("...");
                        $(".cep-estado").val("...");
                        
                        // Faz a requisição para a API ViaCEP
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                // Atualiza os campos do formulário com os dados recebidos
                                $(".cep-logradouro").val(dados.logradouro);
                                $(".cep-bairro").val(dados.bairro);
                                $(".cep-cidade").val(dados.localidade);
                                $(".cep-estado").val(dados.uf);
                            } else {
                                // CEP não encontrado
                                limpaFormularioCEP();
                                alert("CEP não encontrado.");
                            }
                        });
                    } else {
                        // CEP em formato inválido
                        limpaFormularioCEP();
                        alert("Formato de CEP inválido.");
                    }
                } else {
                    // CEP sem valor, limpa formulário
                    limpaFormularioCEP();
                }
            });
        });



        

</script>

</body>

</html>




<!-- Modal 
<div class="modal fade" id="modalDetalhesPedido" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesPedidoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetalhesPedidoLabel">Detalhes do Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        //include("conecta.php");

        // Criando conexão
        //$conexao = new mysqli($servername, $username, $password, $dbname);

        // Verificando a conexão
       ///// if ($conexao->connect_error) {
          //  die("Falha na conexão: " . $conexao->connect_error);
       // }

        // Consulta SQL para recuperar os dados do pedido
       // $sql_pedido = "SELECT * FROM pedidos WHERE idPedidos = 5"; // Aqui você pode substituir 5 pelo ID do pedido desejado
       // $result_pedido = $conexao->query($sql_pedido);

        // Verificando se há resultados
       // if ($result_pedido->num_rows > 0) {
          //  // Saída dos dados do pedido
         ///   while($row_pedido = $result_pedido->fetch_assoc()) {
             //   $idPedido = $row_pedido["idPedidos"];
             //   $idCliente = $row_pedido["idCliente"];
            //    $observacao = $row_pedido["observacao"];
            //    $status = $row_pedido["status"];
             //   $totalPedido = $row_pedido["totalPedido"];
             //   $dataPedido = $row_pedido["dataPedido"];
              //  $dataEntrega = $row_pedido["dataEntrega"];
//
                // Saída dos detalhes do pedido
                ?>
                <section id="detalhes_pedido">
                  //  <h2>Detalhes do Pedido</h2>
                  //  //<p><strong>Número do Pedido:</strong> <?php //echo $idPedido; ?></p>
                  //  <p><strong>Data do Pedido:</strong> <?php //echo $dataPedido; ?></p>
                  //  <p><strong>Data de Entrega Prevista:</strong> <?php //echo $dataEntrega; ?></p>
                  //  <p><strong>Status do Pedido:</strong> <?php // echo $status; ?></p>
                   // <p><strong>Observações:</strong> <?php //echo $observacao; ?></p>
                  // // <p><strong>Total do Pedido:</strong> R$ <?php //echo $totalPedido; ?></p>
                </section>
                <?php

                // Consulta SQL para recuperar os produtos do pedido usando JOIN
              //  $sql_produtos = "SELECT pp.*, p.nome, p.descricao, p.preco_unitario FROM pedidosprodutos pp
              //                  INNER JOIN produtos p ON pp.idProdutos = p.idProdutos
              //                  WHERE pp.idPedidos = $idPedido";
              //  $result_produtos = $conexao->query($sql_produtos);

             //   // Verificando se há resultados
              //  if ($result_produtos->num_rows > 0) {
                    // Saída dos detalhes dos produtos
                    ?>
                    <section id="produtos_servicos" class="mt-4">
                        <h2>Produtos do Pedido</h2>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Preço Unitário</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                           //     while($row_produto = $result_produtos->fetch_assoc()) {
                            ///        echo "<tr>";
                            //        echo "<td>" . $row_produto["nome"] . "</td>";
                            //        echo "<td>" . $row_produto["quantidade"] . "</td>";
                              //      echo "<td>R$ " . $row_produto["preco_unitario"] . "</td>";
                             //       echo "<td>R$ " . $row_produto["subtotal"] . "</td>";
                              //      echo "</tr>";
                           //     }
                          //      ?>
                            </tbody>
                        </table>
                    </section>
                    <?php
            //    } else {
            //        echo "<section id='produtos_servicos' class='mt-4'><p>Nenhum produto encontrado para este pedido.</p></section>";
           //     }
          //  }
      //  } else {
        //    echo "Nenhum resultado encontrado para o pedido.";
      //  }

        // Fechando a conexão
      //  $conexao->close();
      //  ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
      -->