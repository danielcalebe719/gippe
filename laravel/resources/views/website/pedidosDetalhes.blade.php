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
  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
  </style>
</head>

<body>
<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:buffetdivinosabor@gmail.com">buffetdivinosabor@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+31 95589 55488</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{ url('/website') }}"><img src="assets/img/logo.png" alt="" style="max-width: 50%;"><span></span></a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ url('/website') }}">Home</a></li>
          <li><a class="nav-link scrollto" href="./#cardapio">Cardápio</a></li>
          <li><a class="nav-link scrollto" href="./#about">Sobre nós</a></li>
          <li><a class="nav-link scrollto" href="./#portfolio">Galeria de fotos</a></li>
          <li><a class="nav-link scrollto" href="./#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="./#contact">Fale Conosco</a></li>

          @guest('cliente')
          <!-- Mostrar se não estiver logado -->
          <li>
            <a href="{{ url('website/cadastro') }}">
              <button id="register-btn" class="nav-link btn"><i class="bi bi-person-plus"></i> Cadastrar-se</button>
            </a>
          </li>
          <li>
            <a href="{{ url('website/login') }}">
              <button id="login-btn" class="nav-link btn">Fazer Login</button>
            </a>
          </li>
          @else
          <!-- Mostrar se estiver logado -->
          <li id="notification-btn">
            <a href="#" data-bs-toggle="modal" data-bs-target="#notificationsModal">
              <button class="nav-link btn"><i class="bi bi-bell"></i> Notificações
                @if($quantidadeNotificacoes > 0)
                <span class="badge bg-danger quantidadeNotificacoes">{{ $quantidadeNotificacoes }}</span>
                @endif
              </button>
            </a>
          </li>
          <li id="profile-btn">
            <a href="{{ url('website/perfil') }}">
              <button class="nav-link btn"><i class="bi bi-person"></i> Perfil</button>
            </a>
          </li>
          @endguest

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  

  <div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationsModalLabel">Notificações</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if ($notificacoes->isNotEmpty())
          @foreach ($notificacoes as $notificacao)
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">{{ $notificacao->mensagem }}</h5>
              <p class="card-text">{{ $notificacao->dataEnvio }}</p>
              <!-- Verificar se a notificação não foi lida -->
              @if ($notificacao->lido == false)
              <form class="form-marcar-lida" data-notificacao-id="{{ $notificacao->id }}" action="{{ route('notificacoes.marcarLida', $notificacao->id) }}" method="POST">
                @csrf
                <button type="button" class="btn btn-primary btn-marcar-lida">
                  <i class="bi bi-check"></i> Marcar como lida
                </button>
              </form>
              @else
              <button type="button" class="btn btn-secondary disabled">
                <i class="bi bi-check"></i> Lida
              </button>
              @endif
            </div>
          </div>
          @endforeach
          @else
          <p>Nenhuma notificação encontrada.</p>
          @endif
        </div>
      </div>
    </div>
  </div>



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

              <a href="{{ url('website/produtos/' . $pedido->codigo) }}">Editar Produtos</a>
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
            <p><strong>Data de Nascimento:</strong> {{ $cliente->dataNascimento }}</p>
          </div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editClientModal">
            Editar Informações
          </button>


          <!-- Modal -->
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

        <!-- Card for Address Information -->
        <!-- Card for Address Information -->
        <div class="card order-card mb-4">
          <div class="card-body">
            <h5 class="card-title">Endereço de Entrega</h5>
          
            <p><strong>Rua:</strong> {{ $endereco->rua ?? ''}}</p>
            <p><strong>Número:</strong> {{ $endereco->numero ?? ''}}</p>
            <p><strong>Bairro:</strong> {{ $endereco->bairro ?? ''}}</p>
            <p><strong>Cidade:</strong> {{ $endereco->cidade ?? ''}}</p>
            <p><strong>CEP:</strong> {{ $endereco->cep ?? ''}}</p>

            <!-- Edit Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAddressModal">
              Editar Endereço
            </button>
          </div>
        </div>


        <!-- Edit Address Modal -->
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
              @if ($pedido->status == '1' || $pedido->status == '2')
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
        <!-- Card for Order Status -->
        <!-- Card for Order Status -->
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

</body>

</html>