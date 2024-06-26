<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <button id="editarEnderecoBtn" type="button" class="btn btn-link edit-endereco-btn">
        <i class="bi bi-pencil"></i> Editar Endereço
    </button>

    <!-- Modal para editar endereço -->
    <div class="modal" id="enderecoModal" tabindex="-1" role="dialog" aria-labelledby="enderecoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enderecoModalLabel">Editar Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de edição de endereço -->
                    <form id="enderecoForm">
                        <!-- Campos do formulário -->
                        <input type="text" id="tipo" name="tipo" class="form-control" placeholder="Tipo">
                        <input type="text" id="cep" name="cep" class="form-control" placeholder="CEP">
                        <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade">
                        <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro">
                        <input type="text" id="rua" name="rua" class="form-control" placeholder="Rua">
                        <input type="text" id="numero" name="numero" class="form-control" placeholder="Número">
                        <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Complemento">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="saveEnderecoBtn">Salvar mudanças</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
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
    </script>
</body>
</html>
