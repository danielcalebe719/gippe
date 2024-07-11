<!DOCTYPE html>
<html lang="en">
<head>
  <base href="https://buffetfestamais.com">
  <title>Detalhes do Pedido - Buffet Festa Mais</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome para ícones -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
  </style>
</head>
<body>

<div class="container my-5">
  <h1 class="mb-4">Detalhes do Pedido <strong style="color: #FA856E;">#{{ $pedido->codigo }}</strong></h1>
  
  <div class="row">
    <div class="col-md-8">
      <div class="card order-card mb-4">
        <div class="card-body">
          <h5 class="card-title">Informações do Pedido</h5>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <span>Status: 
              <span class="badge bg-success status-badge">{{ $pedido->status }}</span>
            </span>
            <span>Data do Pedido: {{ $pedido->dataPedido }}</span>
          </div>
          @if ($agendamento)
          <p><strong>Data da Festa:</strong> {{ $agendamento->dataInicio }}</p>
          <p><strong>Horário:</strong> {{ $agendamento->horaInicio }} - {{ $agendamento->horaFim }}</p>
          @endif
          @if ($servicos)
          <p><strong>Número de Convidados:</strong> {{ $servicos->quantidadePessoas }}</p>
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
                  <td><strong>R$ {{ number_format($pedido->totalPedido, 2, ',', '.') }}</strong></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card order-card mb-4">
        <div class="card-body">
          <h5 class="card-title">Serviços Contratados</h5>
          <div class="row text-center">
            @foreach ($pedidos_servicos as $pedido_servico)
              @if ($pedido_servico->funcionarioTipo === 'cozinheiros')
                <div class="col-md-4">
                  <div class="service-icon text-primary">
                    <i class="fas fa-user-tie"></i>
                  </div>
                  <h6>Garçons</h6>
                  <p>{{ $pedido_servico->quantidade }}</p>
                </div>
              @elseif ($pedido_servico->funcionarioTipo === 'garcons')
                <div class="col-md-4">
                  <div class="service-icon text-success">
                    <i class="fas fa-utensils"></i>
                  </div>
                  <h6>Cozinheiros</h6>
                  <p>{{ $pedido_servico->quantidade }}</p>
                </div>
              @elseif ($pedido_servico->funcionarioTipo === 'barmans')
                <div class="col-md-4">
                  <div class="service-icon text-info">
                    <i class="fas fa-glass-martini-alt"></i>
                  </div>
                  <h6>Barman</h6>
                  <p>{{ $pedido_servico->quantidade }}</p>
                </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>

      <div class="card order-card mb-4">
        <div class="card-body">
          <h5 class="card-title">Resumo Financeiro</h5>
          <table class="table">
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
          </table>
        </div>
      </div>

      <div class="card order-card">
        <div class="card-body">
          <h5 class="card-title">Status do Pedido</h5>
          <div class="timeline">
            @php
              $statuses = ['nao_finalizado', 'pendente', 'aceito', 'em_producao', 'produzido', 'entregue'];
            @endphp

            @if($pedido->status == 'recusado' || $pedido->status == 'cancelado')
              <div class="timeline-item">
                <p class="mb-0"><strong class="text-danger">{{ ucfirst(str_replace('_', ' ', $pedido->status)) }}</strong></p>
                <p class="text-muted"></p>
              </div>
            @else
              @foreach($statuses as $status)
                <div class="timeline-item">
                  @if($pedido->status == $status)
                    @if($status == 'recusado' || $status == 'cancelado')
                      <p class="mb-0"><strong class="text-danger">{{ ucfirst(str_replace('_', ' ', $status)) }}</strong></p>
                    @else
                      <p class="mb-0"><strong class="text-primary">{{ ucfirst(str_replace('_', ' ', $status)) }}</strong></p>
                    @endif
                  @else
                    <p class="mb-0">{{ ucfirst(str_replace('_', ' ', $status)) }}</p>
                  @endif    
                  <p class="text-muted"></p>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
