<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('assets/img/logo/logo.png') }}" rel="icon">
  <title>Gestão Operacional</title>
  <link href="{{ asset('assets/vendor_adm/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/vendor_adm/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/css/css_adm/ruang-admin.min.css') }}" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/vendor_adm/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    .container {
      max-width: 900px;
    }

    .btn-menu {
      height: 100px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      font-weight: bold;
      text-transform: uppercase;
      background-color: #276359;
      border-color: #276359;
      color: white;
    }

    .btn-menu:hover,
    .btn-menu:focus {
      background-color: #1e4d46;
      border-color: #1e4d46;
      color: white;
    }

    .btn-menu i {
      font-size: 2rem;
      margin-bottom: 0.5rem;
    }

    .card-wrapper {
      display: flex;
      flex-wrap: wrap;
    }

    .card-custom {
      background-color: #276359;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }

    .card-title {
      color: #fff;
      font-weight: bold;
    }

    .card img {
      width: 100%;
      height: auto;
    }

    .nav-link-custom {
      padding: 0;
      margin: 5px;
    }

    @media screen and (max-width: 768px) {
      .nav-link-custom {
        margin-bottom: 10px;
      }
    }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('adm/painel-operacional') }}">
        <div class="sidebar-brand-icon">
          <img id="logo" src="{{asset('assets/img/logo/logo.png')}}">
        </div>
      </a>
      <hr class="sidebar-divider">
    
      <div class="sidebar-heading"></div>
    </ul>

    <!-- Content -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar static-top">
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
        @if(Auth::guard('admin')->check())
                    <h5 class="text-gray-1000">  Olá, {{ Auth::guard('admin')->user()->nome }}!</h5>
                    @endif
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               
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
                <img class="boyimg" src="{{asset('assets/img/boy.png')}}">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/adm/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
<br>
@if(Auth::guard('admin')->user()->permissoes == 1 || Auth::guard('admin')->user()->permissoes == 2)
        <!-- Container Fluid -->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-1000">Painel Operacional</h1>
         
          </div>

          <div class="row">
            
            <div class="col-md-4 col-sm-6">
              
              <a class="nav-link nav-link-custom" href="{{ url('adm/clientes') }}">

                <button class="btn btn-menu w-100">
                  <i class="bi bi-people"></i> Clientes
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/pedidos') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-cart"></i>
                  Pedidos
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/produtos') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-box-seam"></i>
                  Produtos
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/MateriaPrimaEstoque') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-tools"></i>
                  Matérias Primas
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/servicos') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-gear"></i>
                  Serviços
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/fornecedores') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-truck"></i>
                  Fornecedores
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/notificacoes') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-bell"></i>
                  Notificações
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/agendamentos') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-calendar-event"></i>
                  Agenda
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/receitasItens') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-journal-text"></i>
                  Receitas
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/galeriaImagens') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-images"></i>
                  Galeria de Imagens
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/mensagens') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-chat-dots"></i>
                  Mensagens
                </button>
              </a>
            </div>

            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/admins') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-person-badge"></i>
                  Colaboradores
                </button>
              </a>
            </div>
          </div>
          <br>
@endif
@if(Auth::guard('admin')->user()->permissoes == 1 || Auth::guard('admin')->user()->permissoes == 3)
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-1000">Painel Financeiro</h1>
         
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/painel-financeiro') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-laptop"></i> Painel Financeiro
                </button>
              </a>
            </div>
            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/painel-financeiro') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-cash"></i> Gastos
                </button>
              </a>
            </div>
            <div class="col-md-4 col-sm-6">
              <a class="nav-link nav-link-custom" href="{{ url('adm/painel-financeiro') }}">
                <button class="btn btn-menu w-100">
                  <i class="bi bi-cash-coin"></i> Gastos à pagar
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endif
    <footer>
      <div class="footer">
        <br><br>
      </div>
    </footer>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('assets/vendor_adm/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor_adm/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor_adm/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/js/js_adm/ruang-admin.min.js') }}"></script>
  <script src="{{ asset('assets/vendor_adm/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/js/js_adm/js_adm/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('assets/js/js_adm/demo/chart-pie-demo.js') }}"></script>
  <script src="{{ asset('assets/js/js_adm/demo/chart-bar-demo.js') }}"></script>
</body>

</html>
