<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn-editar, .btn-detalhes').click(function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            var targetModal = $(this).data('target');

            $.ajax({
                type: 'POST',
                url: 'pages/consultaClientes.php',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.error) {
                        console.error(response.error);
                    } else {
                        // Populating the Edit Modal
                        if (targetModal === '#modalEditarCliente') {
                            $('#Editarid').val(response.id);
                            $('#Editarnome').val(response.nome);
                            $('#Editarcpf').val(response.cpf);
                            $('#Editarcep').val(response.cep);
                            $('#Editarendereco').val(response.endereco);
                            $('#Editarbairro').val(response.bairro);
                            $('#Editarcidade').val(response.cidade);
                            $('#Editarestado').val(response.estado);
                            $('#Editaremail').val(response.email);
                            $('#Editartelefone').val(response.telefone);
                            $('#Editarstatus').val(response.status);
                        }
                        // Populating the Details Modal
                        else if (targetModal === '#modalDetalhesCliente') {
                            $('#Detalhesid').val(response.id);
                            $('#Detalhesnome').val(response.nome);
                            $('#Detalhescpf').val(response.cpf);
                            $('#Detalhescep').val(response.cep);
                            $('#Detalhesendereco').val(response.endereco);
                            $('#Detalhesbairro').val(response.bairro);
                            $('#Detalhescidade').val(response.cidade);
                            $('#Detalhesestado').val(response.estado);
                            $('#Detalhesemail').val(response.email);
                            $('#Detalhestelefone').val(response.telefone);
                            $('#Detalhesstatus').val(response.status);
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
include("conexao.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //IF geral
    $acao = $_POST['acao']; //Pega a ação crud a ser feita
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];
    $data_cadastro = date('d/m/Y');
    $data_atualizacao = date('d/m/Y');
    $status = $_POST['status'];
    switch ($acao) {
        case 'adicionar':
            $queryAdicao = mysqli_query($conn, "INSERT INTO clientes (nome, cpf, endereco, bairro, cidade, estado, cep, email, telefone, data_cadastro, data_atualizacao, status) 
        VALUES ('$nome', '$cpf', '$endereco', '$bairro', '$cidade', '$estado', '$cep', '$email', '$telefone', NOW(), NOW(), '$status')");
            break;
        case 'editar':

            $id = $_POST['Editarid'];
            $queryEdicao = "UPDATE clientes SET 
            nome = '$nome', 
            cpf = '$cpf', 
            endereco = '$endereco',
            bairro = '$bairro', 
            cidade = '$cidade', 
            estado = '$estado', 
            cep = '$cep', 
            email = '$email', 
            telefone = '$telefone', 
            status = '$status', 
            data_atualizacao = NOW() 
            WHERE id = '$id'";
            $result = mysqli_query($conn, $queryEdicao);
            break;
        case 'apagar':
            $id = $_POST['id'];
            $queryApagar = mysqli_query($conn, "DELETE FROM clientes WHERE id = '$id'");
            header("Location: index.php?pagina=clientes");
            break;

        default:
            echo 'Nenhuma ação reconhecida';
    }
}
?>




<div class="container-fluid" id="container-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarCliente">Adicionar Cliente</button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>STATUS</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("conexao.php");
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            $queryListar = "SELECT * FROM clientes";
                            $resultado = mysqli_query($conn, $queryListar);
                            while ($row = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["nome"] . "</td>";
                                echo "<td>" . $row["cpf"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["telefone"] . "</td>";
                                echo "<td>" . $row["status"] . "</td>";
                                echo "<td>
                                    <form method='post'>
                                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                                        <input type='hidden' name='acao' value='apagar'>
                                        <input class='btn btn-primary btn-sm' type='submit' value='Apagar'>
                                    </form>
                                    <button class='btn-editar btn btn-danger btn-sm' type='submit' data-id ='" . $row["id"] . "'  data-toggle='modal' data-target='#modalEditarCliente'>Editar</button>
                                    <button class='btn-detalhes btn btn-info btn-sm' type='submit'  data-id ='" . $row["id"] . "' data-toggle='modal' data-target='#modalDetalhesCliente'>Detalhes</button>
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



    <!-- Modal Adicionar Cliente -->
    <div class="modal fade" id="modalAdicionarCliente" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Adicionar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarCliente" method="post">
                        <div class="form-group">
                            <input type="hidden" name="acao" id="acao" value="adicionar">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="cep    ">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" required>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" required>
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro </label>
                            <input type="text" class="form-control" id="bairro" name="bairro" required>
                        </div>
                        <div class="form-group">
                            <label for="cidade  ">Cidade </label>
                            <input type="text" class="form-control" id="cidade" name="cidade" required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" class="form-control" id="estado" name="estado" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" required>
                        </div>
                        <div class="form-group">
                            <label for="data_cadastro ">Data de Cadastro</label>
                            <input type="text" class="form-control" id="data_cadastro" name="data_cadastro" readonly placeholder="<?php echo date('d/m/Y') ?>">
                        </div>
                        <div class="form-group">
                            <label for="data_atualizacao">Data de Atualização</label>
                            <input type="text" class="form-control" id="data_atualizacao" name="data_atualizacao" readonly placeholder="<?php echo date('d/m/Y') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnAdicao">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Cliente -->
    <div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarCliente" method="post">
                        <input type="hidden" name="acao" id="acao" value="editar">
                        <div class="form-group">
                            <label for="Editarid">ID</label>
                            <input type="text" class="form-control" name="Editarid" id="Editarid" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Editarnome">Nome</label>
                            <input type="text" class="form-control" id="Editarnome" name="nome">
                        </div>
                        <div class="form-group">
                            <label for="Editarcpf">CPF</label>
                            <input type="text" class="form-control" id="Editarcpf" name="cpf">
                        </div>
                        <div class="form-group">
                            <label for="Editarcep    ">CEP</label>
                            <input type="text" class="form-control" id="Editarcep" name="cep">
                        </div>
                        <div class="form-group">
                            <label for="Editarendereco">Endereço</label>
                            <input type="text" class="form-control" id="Editarendereco" name="endereco">
                        </div>
                        <div class="form-group">
                            <label for="Editarbairro">Bairro </label>
                            <input type="text" class="form-control" id="Editarbairro" name="bairro">
                        </div>
                        <div class="form-group">
                            <label for="Editarcidade  ">Cidade </label>
                            <input type="text" class="form-control" id="Editarcidade" name="cidade">
                        </div>
                        <div class="form-group">
                            <label for="Editarestado">Estado</label>
                            <input type="text" class="form-control" id="Editarestado" name="estado">
                        </div>
                        <div class="form-group">
                            <label for="Editaremail">Email</label>
                            <input type="email" class="form-control" id="Editaremail" name="email">
                        </div>
                        <div class="form-group">
                            <label for="Editarstatus">Status</label>
                            <select class="form-control" id="Editarstatus" name="status">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Editartelefone">Telefone</label>
                            <input type="text" class="form-control" id="Editartelefone" name="telefone">
                        </div>
                        <div class="form-group">
                            <label for="Editardata_cadastro ">Data de Cadastro</label>
                            <input type="text" class="form-control" id="Editardata_cadastro" name="data_cadastro" readonly placeholder="<?php echo date('d/m/Y') ?>">
                        </div>
                        <div class="form-group">
                            <label for="Editardata_atualizacao">Data de Atualização</label>
                            <input type="text" class="form-control" id="Editardata_atualizacao" name="data_atualizacao" readonly placeholder="<?php echo date('d/m/Y') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes Cliente -->
    <div class="modal fade" id="modalDetalhesCliente" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Detalhes do Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formDetalhesCliente" method="post">
                        <input type="hidden" name="acao" id="acao" value="editar">
                        <div class="form-group">
                            <label for="Detalhesid">ID</label>
                            <input type="text" class="form-control" name="Detalhesid" id="Detalhesid" readonly>
                        </div>

                        <div class="form-group">
                            <label for="Detalhesnome">Nome</label>
                            <input type="text" class="form-control" id="Detalhesnome" name="nome" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Detalhescpf">CPF</label>
                            <input type="text" class="form-control" id="Detalhescpf" name="cpf" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Detalhescep    ">CEP</label>
                            <input type="text" class="form-control" id="Detalhescep" name="cep" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Detalhesendereco">Endereço</label>
                            <input type="text" class="form-control" id="Detalhesendereco" name="endereco" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Detalhesbairro">Bairro </label>
                            <input type="text" class="form-control" id="Detalhesbairro" name="bairro" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Detalhescidade  ">Cidade </label>
                            <input type="text" class="form-control" id="Detalhescidade" name="cidade" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Detalhesestado">Estado</label>
                            <input type="text" class="form-control" id="Detalhesestado" name="estado" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Detalhesemail">Email</label>
                            <input type="email" class="form-control" id="Detalhesemail" name="email" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Detalhesstatus">Status</label>
                            <select class="form-control" id="Detalhesstatus" name="status" readonly>
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Detalhestelefone">Telefone</label>
                            <input type="text" class="form-control" id="Detalhestelefone" name="telefone" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Detalhesdata_cadastro ">Data de Cadastro</label>
                            <input type="text" class="form-control" id="Detalhesdata_cadastro" name="data_cadastro" readonly placeholder="<?php echo date('d/m/Y') ?>">
                        </div>
                        <div class="form-group">
                            <label for="Detalhesdata_atualizacao">Data de Atualização</label>
                            <input type="text" class="form-control" id="Detalhesdata_atualizacao" name="data_atualizacao" readonly placeholder="<?php echo date('d/m/Y') ?>">
                        </div>
                </div>
            </div>
        </div>
    </div>


</div>
</div>

</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>