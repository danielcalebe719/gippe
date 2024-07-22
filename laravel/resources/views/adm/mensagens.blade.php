@extends('adm.templates.template')

@section('title', 'Mensagens')

@section('content')
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Mensagenss</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Mensagens</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Mensagens</h6>
                                    
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Assunto</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mensagens as $mensagem)
                                        <tr>
                                            <td>{{ $mensagem->id }}</td>
                                            <td>{{ $mensagem->nome }}</td>
                                            <td>{{ $mensagem->email }}</td>
                                            <td>{{ $mensagem->assunto }}</td>
                                            


                                            <td>
                                                <div class="btn-toolbar" role="toolbar"
                                                    aria-label="Toolbar with button groups">
                                                    

                                                    <div class="btn-group mr-2" role="group"
                                                        aria-label="Ações do Cliente">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="abrirModalExclusao('{{ $mensagem->id }}')">
                                                            Excluir
                                                        </button>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Ações do Pedido">
                                                        <button class="btn btn-info btn-sm"
                                                            onclick="mostrarDetalhes('{{ $mensagem->id }}')"
                                                            data-toggle="modal">
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

                    

                    

    <!-- Modal Detalhes Mensagens -->
<div class="modal fade" id="modalDetalhesMensagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detalhes das Mensagens</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
              <div class="form-group row">
                  <label for="detalhesMensagem" class="col-sm-3 col-form-label">Mensagem</label>
                  <div class="col-sm-9">
                    <textarea name="" id="detalhesMensagem" class="form-control" readonly></textarea>
                      
                  </div>
              </div>
              <div class="form-group row">
                <label for="detalhesDataEnvio" class="col-sm-3 col-form-label">Data de Envio:</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="detalhesDataEnvio" readonly>
                </div>
            </div>
          
            
          </div>
      </div>
  </div>
</div>


<script>
    function mostrarDetalhes(idMensagem) {
        fetch(`/adm/mensagens/show/${idMensagem}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao carregar os detalhes do agendamento');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // Preencha os campos do modal com os dados do cliente, ou valores padrão
                document.getElementById('detalhesMensagem').value = data.mensagem || '';
                document.getElementById('detalhesDataEnvio').value = data.dataEnvio || '';
                



                // Abra o modal de detalhes do pedido
                $('#modalDetalhesMensagens').modal('show');
            })
            .catch(error => {
                console.error('Erro ao carregar os detalhes do produto:', error);
            });
    }

    function formatarData(data) {
        // Formato de exibição de data desejado
        let options = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        };
        return new Date(data).toLocaleDateString('pt-BR', options);
    }
</script>

    <script>
      
    $(document).ready(function () {
        // Abrir o modal de detalhes ao clicar no botão
        $('#dataTableHover').on('click', '.btn-detalhes', function () {
            $('#modalDetalhesMensagens').modal('show');
        });
    });


        $(document).ready(function () {
            $('#dataTableHover').DataTable(); // Initialize the DataTable
        });
    </script>

    <!-- Modal Confirmar Exclusão -->
 <div class="modal fade" id="modalConfirmarExclusao" tabindex="-1" role="dialog"
 aria-labelledby="modalConfirmarExclusaoLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="modalConfirmarExclusaoLabel">Confirmar Exclusão</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
             <p>Tem certeza de que deseja excluir este pedido?</p>
             <input type="hidden" id="excluirIdMensagem">
         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
             <button type="button" class="btn btn-danger" id="confirmarExclusao">Excluir</button>
         </div>
     </div>
 </div>
</div>

    <script>
        // Função para abrir o modal de confirmação de exclusão
        function abrirModalExclusao(idMensagem) {
            document.getElementById('excluirIdMensagem').value = idMensagem;
            $('#modalConfirmarExclusao').modal('show');
        }
    
        // Função para confirmar a exclusão
        document.getElementById('confirmarExclusao').addEventListener('click', function () {
            var idMensagem = document.getElementById('excluirIdMensagem').value;
    
            // Enviar requisição AJAX para excluir o cliente
            fetch(`/adm/mensagens/remover/${idMensagem}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao excluir a mensagem');
                    }
                    return response.json();
                })
                .then(data => {
                    // Fechar o modal de confirmação de exclusão
                    $('#modalConfirmarExclusao').modal('hide');
    
                    // Remover a linha do cliente na tabela, se existir
                    let mensagemRow = document.getElementById(`mensagemRow${idMensagem}`);
                    if (mensagemRow) {
                        mensagemRow.remove();
                    } else {
                        console.warn(`Elemento mensagemRow${idMensagem} não encontrado para remoção.`);
                    }
    
                    // Exibir mensagem de sucesso
                    location.replace(location.href)
    
                })
                .catch(error => {
                    console.log(error)
                    console.error('Erro ao excluir a mensagem:', error);
                    alert('Erro ao excluir a mensagem');
                });
        });
    
    
    </script>
@endsection