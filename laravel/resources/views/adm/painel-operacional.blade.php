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
  <style>
    .card-custom {
      background-color: #276359;
      border-radius: 10px;
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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="painel-operacional.html">
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
          <h5 class="text-gray-1000 ml-3">Olá, Nome da Pessoa!</h5>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
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
                <a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Perfil</a>
                <a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>Configurações</a>
                <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Log de Atividade</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.html"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid -->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-1000">Painel Operacional</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a style="color: #8ebba7;" href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Painel Operacional</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
            <a class="nav-link nav-link-custom" href="{{ url('adm/clientes') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Clientes</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/clientes.png')}}" alt="Clientes">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/pedidos') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Pedidos</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/pedidos.png')}}" alt="Pedidos">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/produtos') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Produtos</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/produtos.png')}}" alt="Produtos">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/MateriaPrimaEstoque') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Matérias Primas</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/estoque.png')}}" alt="Matérias Primas">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/servicos') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Serviços</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/servicos.png')}}" alt="Serviços">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/agendamento') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Agenda</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/agenda.png')}}" alt="Agenda">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/fornecedores') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Fornecedores</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/fornecedores.png')}}" alt="Fornecedores">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/notificacoes') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Notificações</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/notificacoes.png')}}" alt="Notificações">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/receitasItens') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Receitas</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/cardapio.png')}}" alt="Receitas">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/galeriaImagens') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Galeria de Imagens</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/clientes.png')}}" alt="Galeria de Imagens">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <a class="nav-link nav-link-custom" href="{{ url('adm/mensagens') }}">
                <div class="card card-custom h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="h5 mb-0 card-title">Mensagens</div>
                      </div>
                      <div class="col-4">
                        <img src="{{asset('assets/img/clientes.png')}}" alt="Mensagens">
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>

    <footer>

      <div class="footer">
<br><br>

        </div>
      </div>
    </footer>
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