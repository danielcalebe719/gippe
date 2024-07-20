<!DOCTYPE html>
<html lang="en">

<head>

  <title>Detalhes do Pedido - Buffet Divino Sabor</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .order-card {
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .status-badge {
      font-size: 0.9rem;
    }

    .product-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 10px;
    }

    .timeline {
      border-left: 3px solid #dee2e6;
      padding: 1rem 0;
    }

    .timeline-item {
      position: relative;
      padding-left: 30px;
      margin-bottom: 20px;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: -9px;
      top: 0;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      background-color: #007bff;
    }

    .service-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .btn-edit {
      background-color: #FF944E;
      /* Cor azul padrão do Bootstrap */
      border: none;
      border-radius: 5px;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s ease;
    }

    .btn-edit a {

      color: white;

    }

    .btn-edit i {
      margin-right: 8px;
     
    }

    .btn-edit:hover {
      background-color: #0056b3;
   
    }
  </style>
</head>

<body>
  @include('partials.navbar')


  <div class="container my-5">
    <h1 class="mb-4">Detalhes do Pedido <strong style="color: #FA856E;">#{{ $pedido->codigo }}</strong></h1>
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <div class="row">
      <div class="col-md-8">
        <div class="card order-card mb-4">
          <div class="card-body">
            <h5 class="card-title">Informações do Pedido</h5>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span>Status:
                <span class="badge bg-success status-badge">
                  {{$pedido->getStatus() }}
                </span>


            </div>
            <p><strong>Data do Pedido:</strong> {{ \Carbon\Carbon::parse($pedido->dataPedido)->format('d/m/Y') }}</p>
            @if ($agendamento)
            <p><strong>Data da Festa:</strong> {{ \Carbon\Carbon::parse($agendamento->dataInicio)->format('d/m/Y') }}</p>
            <p><strong>Horário:</strong> {{ \Carbon\Carbon::parse($agendamento->horaInicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($agendamento->horaFim)->format('H:i') }}</p>

            @endif

            @if ($pedido->status == '1' || $pedido->status == '2')
            <button type="button" class="btn btn-primary btn-edit">



              <a href="{{ route('website.agendamento', $pedido->codigo) }}"> <i class="fas fa-edit"></i> Editar</a>
            </button>
            @endif
          </div>
        </div>

        <div class="card order-card mb-4">
          <div class="card-body">
            <h5 class="card-title">Produtos do Pedido</h5>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($produtos as $produto_pedido)
                  <tr>
                    <td>
                      <img src="{{ asset('storage/ImagensProdutos/' . $produto_pedido->produto->caminhoImagem) }}" alt="{{ $produto_pedido->produto->nome }}" class="product-img me-2">
                      {{ $produto_pedido->produto->nome }}
                    </td>
                    <td>{{ $produto_pedido->quantidade }}</td>
                    <td>R$ {{ number_format($produto_pedido->subtotal, 2, ',', '.') }}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2" class="text-end"><strong>Total:</strong></td>
                    <td><strong>R$ {{ number_format($subtotal_produtos, 2, ',', '.') }} </strong></td>
                  </tr>
                </tfoot>
              </table>
              @if ($pedido->status == '1' || $pedido->status == '2')
              <button type="button" class="btn btn-primary btn-edit">
                <a href="{{ url('website/produtos/' . $pedido->codigo) }}"> <i class="fas fa-edit"></i> Editar</a>
              </button>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">

        <div class="card order-card mb-4">
          <div class="card-body">
            <h5 class="card-title">Informações do Cliente</h5>
            <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
            <p><strong>Data de Nascimento:</strong> {{ $cliente->dataNascimento }}</p>
            @if ($pedido->status == '1' || $pedido->status == '2')
            <button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editClientModal">
              <i class="fas fa-edit"></i> Editar
            </button>
            @endif
          </div>




          <div class="modal fade" id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editClientModalLabel">Editar Informações do Cliente</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('cliente.atualizar') }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="nome">Nome</label>
                      <input type="hidden" class="form-control" id="" name="idClientes" value="{{ $cliente->id }}" required>
                      <input type="text" class="form-control" id="nome" name="nome" value="{{ $cliente->nome }}" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{ $cliente->email }}" required>
                    </div>
                    <div class="form-group">
                      <label for="telefone">Telefone</label>
                      <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $cliente->telefone }}" required>
                    </div>
                    <div class="form-group">
                      <label for="dataNascimento">Data de Nascimento</label>
                      <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="{{ $cliente->dataNascimento }}" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>


        <div class="card order-card mb-4">
          <div class="card-body">
            <h5 class="card-title">Endereço de Entrega</h5>

            <p><strong>Rua:</strong> {{ $endereco->rua ?? ''}}</p>
            <p><strong>Número:</strong> {{ $endereco->numero ?? ''}}</p>
            <p><strong>Bairro:</strong> {{ $endereco->bairro ?? ''}}</p>
            <p><strong>Cidade:</strong> {{ $endereco->cidade ?? ''}}</p>
            <p><strong>CEP:</strong> {{ $endereco->cep ?? ''}}</p>

            @if ($pedido->status == '1' || $pedido->status == '2')
            <button type="button" class="btn btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editAddressModal">
              <i class="fas fa-edit"></i>Editar
            </button>
            @endif
          </div>
        </div>

        <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">Editar Endereço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('endereco.atualizar')}}" method="POST">
                  @csrf
                  <input type="hidden" class="form-control" id="idEnderecos" name="idEnderecos" value="{{ $endereco->id ?? ''}}" required>

                  <div class="mb-3">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="rua" name="rua" value="{{ $endereco->rua ?? ''}}" required>
                  </div>
                  <div class="mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="{{ $endereco->numero ?? ''}}" required>
                  </div>
                  <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $endereco->bairro ?? ''}}" required>
                  </div>
                  <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $endereco->cidade ?? ''}}" required>
                  </div>
                  <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" value="{{ $endereco->cep ?? ''}}" required>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card order-card mb-4">
          <div class="card-body">
            <h5 class="card-title">Serviços Contratados</h5>
            <div class="row text-center">

              @foreach ($pedidos_servicos as $pedido_servico)
              <div class="col-md-4">
                <div class="service-icon {{ $pedido_servico->funcionarioTipo == 'Cozinheiro' ? 'text-danger' : ($pedido_servico->funcionarioTipo == 'Garcom' ? 'text-success' : 'text-info') }}">
                  <i class="{{ $pedido_servico->funcionarioTipo == 'Cozinheiro' ? 'fas fa-user-tie' : ($pedido_servico->funcionarioTipo == 'Garcom' ? 'fas fa-utensils' : 'fas fa-glass-martini-alt') }}"></i>
                </div>
                <h6>
                  @php
                  $pluralTipo = $pedido_servico->funcionarioTipo == 'Cozinheiro' ? 'Cozinheiros' : ($pedido_servico->funcionarioTipo == 'Garcom' ? 'Garçons' : 'Barmans');
                  @endphp
                  {{ $pluralTipo }}
                </h6>
                <p>{{ $pedido_servico->quantidade }}</p>
              </div>
              @endforeach
              @if ($servicos)
              <p><strong>Número de Convidados:</strong> {{ $servicos->quantidadePessoas }}</p>
              @endif
              @if ($pedido->status == '1' || $pedido->status == '2')
              <div>
                <button type="button" class="btn btn-primary btn-edit">
                  <a href="{{ url('website/servicos/' . $pedido->codigo) }}"> <i class="fas fa-edit"></i>Editar</a>
                </button>
              </div>
              @endif
            </div>
          </div>
        </div>

        <div class="card order-card mb-4">
          <div class="card-body">
            <h5 class="card-title">Resumo Financeiro</h5>
            <table class="table">
              <tbody>
                <tr>
                  <td>Subtotal Produtos:</td>
                  <td class="text-end">R$ {{ number_format($subtotal_produtos, 2, ',', '.') }}</td>
                </tr>
                <tr>
                  <td>Serviços:</td>
                  <td class="text-end">R$ {{ number_format($servicos->totalServicos, 2, ',', '.') }}</td>
                </tr>
                <tr>
                  <td>Taxa de Entrega:</td>
                  <td class="text-end">R$ {{ number_format($pedido->taxaEntrega, 2, ',', '.') }}</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <th class="text-end">R$ {{ number_format($pedido->totalPedido, 2, ',', '.') }}</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card order-card">
          <div class="card-body">
            <h5 class="card-title">Status do Pedido</h5>
            <div class="timeline">
              @php
              $currentStatus = $statuses[$pedido->status] ?? 'Status desconhecido';
              @endphp

              @if(in_array($pedido->status, ['7', '8'])) {{-- Recusado ou Cancelado --}}
              <div class="timeline-item">
                <p class="mb-0"><strong class="text-danger">{{ $currentStatus }}</strong></p>
              </div>
              @else
              @foreach($statuses as $status_key => $status_value)
              @if($status_key != '7' && $status_key != '8') {{-- Não mostrar Recusado e Cancelado na lista --}}
              <div class="timeline-item">
                @if($pedido->status == $status_key)
                <p class="mb-0"><strong class="text-primary">{{ $status_value }}</strong></p>
                @else
                <p class="mb-0">{{ $status_value }}</p>
                @endif
              </div>
              @endif
              @endforeach
              @endif
            </div>
          </div>
        </div>
        <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

        <script src="{{ asset('assets/js/mainn.js') }}"></script>

</body>

</html>