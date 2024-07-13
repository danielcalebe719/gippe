<!DOCTYPE html>
<html lang="en">
<head>
  <base href="https://buffetfestamais.com">
  <title>Detalhes do Pedido - Buffet Divino Sabor</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
            <span class="badge bg-success status-badge">
              @switch($pedido->status)
                @case('nao_finalizado')
                  Não Finalizado
                  @break
                @case('pendente')
                  Pendente
                  @break
                @case('aceito')
                  Aceito
                  @break
                @case('em_producao')
                  Em Produção
                  @break
                @case('produzido')
                  Produzido
                  @break
                @case('entregue')
                  Entregue
                  @break
                @case('recusado')
                  Recusado
                  @break
                @case('cancelado')
                  Cancelado
                  @break
                @default
                  {{ $pedido->status }}
              @endswitch
            </span>
            
           
          </div>
         <p><strong>Data do Pedido:</strong> {{ \Carbon\Carbon::parse($pedido->dataPedido)->format('d/m/Y') }}</p>
@if ($agendamento)
  <p><strong>Data da Festa:</strong> {{ \Carbon\Carbon::parse($agendamento->dataInicio)->format('d/m/Y') }}</p>
  <p><strong>Horário:</strong> {{ \Carbon\Carbon::parse($agendamento->horaInicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($agendamento->horaFim)->format('H:i') }}</p>
 
@endif
 
@if ($pedido->status == 'nao_finalizado' || $pedido->status == 'pendente')
    <a href="{{ route('website.agendamento', $pedido->codigo) }}" class="btn btn-warning">Editar Agendamento</a>
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
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <!-- Card for Customer Information -->
      <div class="card order-card mb-4">
        <div class="card-body">
          <h5 class="card-title">Informações do Cliente</h5>
          <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
          <p><strong>Email:</strong> {{ $cliente->email }}</p>
          <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
        </div>
      </div>

      <!-- Card for Address Information -->
      <div class="card order-card mb-4">
        <div class="card-body">
          <h5 class="card-title">Endereço de Entrega</h5>
          <p><strong>Rua:</strong> {{ $endereco->rua }}</p>
          <p><strong>Número:</strong> {{ $endereco->numero }}</p>
          <p><strong>Bairro:</strong> {{ $endereco->bairro }}</p>
          <p><strong>Cidade:</strong> {{ $endereco->cidade }}</p>
          <p><strong>CEP:</strong> {{ $endereco->cep }}</p>
        </div>
      </div>

         <!-- Card for Services -->
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
            @if ($pedido->status == 'nao_finalizado' || $pedido->status == 'pendente')
            <a href="{{ url('website/servicos/' . $pedido->codigo) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a> 
            @endif 
          </div>
        </div>
      </div>

      <!-- Card for Financial Summary -->
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

      <!-- Card for Order Status -->
      <div class="card order-card">
  <div class="card-body">
    <h5 class="card-title">Status do Pedido</h5>
    <div class="timeline">  
      @php
        $statuses = [
          'nao_finalizado' => 'Não Finalizado',
          'pendente' => 'Pendente',
          'aceito' => 'Aceito',
          'em_producao' => 'Em Produção', 
          'produzido' => 'Produzido',
          'entregue' => 'Entregue'
        ];
      @endphp

      @if($pedido->status == 'recusado' || $pedido->status == 'cancelado')
        <div class="timeline-item">
          <p class="mb-0"><strong class="text-danger">{{ ucfirst(str_replace('_', ' ', $pedido->status)) }}</strong></p>
        </div>
      @else
        @foreach($statuses as $status_key => $status_value)
          <div class="timeline-item">
            @if($pedido->status == $status_key)
              <p class="mb-0"><strong class="text-primary">{{ $status_value }}</strong></p>
            @else
              <p class="mb-0">{{ $status_value }}</p>
            @endif
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>

</body>
</html>
