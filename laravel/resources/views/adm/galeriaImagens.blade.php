@extends('adm.templates.template')

@section('title', 'Galeria De Imagens')

@section('content')


                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">GaleriaImagenss</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">GaleriaImagenss</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">GaleriaImagenss</h6>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarGaleriaImagens">Adicionar GaleriaImagens</button>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th> Tipo Evento</th>
                                                <th>Descrição</th>
                                                <th>Nome da Imagem</th>
                                                <th>Tamanho</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aqui vai o conteúdo da tabela vindo do banco de dados -->
                                            <!-- Exemplo estático para ilustrar -->
                                            <tr>
                                                <td>1</td>
                                                <td>casamento</td>
                                                <td>lalalala</td>
                                                <td>img</td>
                                                <td>45kb</td>

                                
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditarGaleriaImagens">Editar</button>
                                                    <button class="btn btn-danger btn-sm" onclick="excluirGaleriaImagens(1)">Excluir</button>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDetalhesGaleriaImagens">Detalhes</button>
                                               
                                                </td>
                                            </tr>
                                            <!-- Fim do exemplo -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Adicionar GaleriaImagens -->
                    <div class="modal fade" id="modalAdicionarGaleriaImagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar GaleriaImagens</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAdicionarGaleriaImagens">
                                        <div class="form-group">
                                            <label for="nome">Nome da Imagem</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="TipoEvento">Tipo</label>
                                            <select class="form-control" id="TipoEvento" name="TipoEvento" required>
                                                <option value="casamento">Casamento</option>
                                                <option value="15anos">15 anos</option>
                                                <option value="infantil">infantil</option>
                                                <option value="formatura">Formatura</option>
                                                <option value="outros">Outros</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="descicao">Descrição</label>
                                            <input type="text" class="form-control" id="descicao" name="descicao" required>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="imgCaminho">Imagem Caminho</label>
                                            <input type="file" class="form-control-file" id="imgCaminho" name="imgCaminho">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar GaleriaImagens -->
                    <div class="modal fade" id="modalEditarGaleriaImagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar GaleriaImagens</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formEditarGaleriaImagens">
                                        <div class="form-group">
                                            <label for="editNome">Nome da Imagem</label>
                                            <input type="text" class="form-control" id="editNome" name="nome" required>
                                        </div>
                                        
                               
                                        <div class="form-group">
                                            <label for="EditTipoEvento">Status</label>
                                            <select class="form-control" id="EditTipoEvento" name="TipoEvento" required>
                                                <option value="casamento">Casamento</option>
                                                <option value="15anos">15 anos</option>
                                                <option value="infantil">infantil</option>
                                                <option value="formatura">Formatura</option>
                                                <option value="outros">Outros</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDescricao">Email</label>
                                            <input type="text" class="form-control" id="editDescricao" name="descricao" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="EditimgCaminho">Imagem Caminho</label>
                                            <input type="file" class="form-control-file" id="EditimgCaminho" name="imgCaminho">
                                        </div>
                                     
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalVisualizarEndereco">Visualizar Endereço</button>

                                        <button class="btn btn-primary btn-sm" id="btnAdicionarEndereco">Adicionar Novo Endereço ao GaleriaImagens</button>
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

    <!-- Modal Detalhes GaleriaImagens -->
<div class="modal fade" id="modalDetalhesGaleriaImagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes do GaleriaImagens</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="form-group row">
                  <label for="detalhesNome" class="col-sm-3 col-form-label">Nome da Imagem:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesNome" readonly>
                  </div>
              </div>
             
              <div class="form-group row">
                  <label for="detalhesTipoEvento" class="col-sm-3 col-form-label">Tipo Evento:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesTipoEvento" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="detalhesDescricao" class="col-sm-3 col-form-label">Descrição:</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="detalhesDescricao" readonly>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="detalhesImagemCaminho" class="col-sm-3 col-form-label">Imagem de Perfil:</label>
                  <div class="col-sm-9">
                      <img src="" alt="Imagem" id="detalhesImagemCaminho" style="max-width: 100%;">
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Modal para adicionar novo endereço -->
<div class="modal fade" id="modalAdicionarEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Novo Endereço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário para adicionar novo endereço -->
                <form id="formAdicionarEndereco">
                    <div class="form-group">
                        <label for="tipoEndereco">Tipo de Endereço</label>
                        <select class="form-control" id="tipoEndereco" name="tipoEndereco" required>
                            <option value="residencial">Residencial</option>
                            <option value="comercial">Comercial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" required>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                    </div>
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" required>
                    </div>
                    <div class="form-group">
                        <label for="rua">Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua" required>
                    </div>
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento">
                    </div>
                    <!-- Adicione um campo oculto para armazenar o ID do GaleriaImagens -->
                    <input type="hidden" id="idGaleriaImagens" name="idGaleriaImagens" value="">
                    <!-- Botão para enviar o formulário -->
                    <button type="submit" class="btn btn-primary">Salvar Endereço</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para visualizar detalhes do endereço -->
<div class="modal fade" id="modalVisualizarEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Endereço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Detalhes do endereço -->
                <div class="form-group">
                    <label for="tipoEnderecoVisualizar">Tipo de Endereço</label>
                    <input type="text" class="form-control" id="tipoEnderecoVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="cepVisualizar">CEP</label>
                    <input type="text" class="form-control" id="cepVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="cidadeVisualizar">Cidade</label>
                    <input type="text" class="form-control" id="cidadeVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="bairroVisualizar">Bairro</label>
                    <input type="text" class="form-control" id="bairroVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="ruaVisualizar">Rua</label>
                    <input type="text" class="form-control" id="ruaVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="numeroVisualizar">Número</label>
                    <input type="text" class="form-control" id="numeroVisualizar" readonly>
                </div>
                <div class="form-group">
                    <label for="complementoVisualizar">Complemento</label>
                    <input type="text" class="form-control" id="complementoVisualizar" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
      
    $(document).ready(function () {
        // Abrir o modal de detalhes ao clicar no botão
        $('#dataTableHover').on('click', '.btn-detalhes', function () {
            $('#modalDetalhesGaleriaImagens').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>
    <script>
        $(document).ready(function () {
            // Abrir modal ao clicar no botão "Adicionar Novo Endereço"
            $('#btnAdicionarEndereco').click(function () {
                $('#modalAdicionarEndereco').modal('show');
            });
        });
    </script>
@endsection
