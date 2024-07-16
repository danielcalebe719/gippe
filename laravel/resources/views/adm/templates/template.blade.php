<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assets/img/logo/logo.png') }}" rel="icon">

    <title>@yield('title', ' Painel ')</title>
    <link href="{{ asset('assets/vendor_adm/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor_adm/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/css_adm/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/vendor_adm/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .row {
            justify-content: center;
            width: 100%;
        }

        .col.mr-2 {
            text-align: center;
        }

        .card-body {
            min-height: 100px;
        }

        .tudu {
            display: flex;
            flex-flow: column nowrap;
            align-content: center;
            height: 100%;
            justify-content: center;
        }

        .container-fluid {
            height: 80%;
        }

        .details {
            display: none;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url ('/adm/painel-operacional')}}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('assets/img/logo/logo.png ') }}">
                </div>
            </a>

            <hr class="sidebar-divider my-0">
            <br>
            <div id="operacional">
                <h5 class="text-center">Operações</h5>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/painel-operacional')}}"><!--{{ asset('assets/img/   ') }}-->
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/painel-op.png') }}" alt="">
                        <span class="text-gray-1000">Painel Operacional</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/clientes')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/clientes.png') }}" alt="">
                        <span class="text-gray-1000">Clientes</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/pedidos')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/pedidos.png') }}" alt="">
                        <span class="text-gray-1000">Pedidos</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/produtos')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/produtos.png') }}" alt="">
                        <span class="text-gray-1000">Produtos</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/MateriaPrimaEstoque')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/estoque.png') }}" alt="">
                        <span class="text-gray-1000">Matérias Primas</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/servicos')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/servicos.png') }}" alt="">
                        <span class="text-gray-1000">Serviços</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/fornecedores')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/fornecedores.png') }}" alt="">
                        <span class="text-gray-1000">Fornecedores</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/notificacoes')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/notificacoes.png') }}" alt="">
                        <span class="text-gray-1000">Notificações</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/agendamentos')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/agenda.png') }}" alt="">
                        <span class="text-gray-1000">Agenda</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/receitasItens')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/cardapio.png') }}" alt="">
                        <span class="text-gray-1000">Itens de Receita</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/galeriaImagens')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/clientes.png') }}" alt="">
                        <span class="text-gray-1000">Galeria de Imagens</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/admins')}}">
                        <img class='fas fa-fw fa-tachometer-alt' src="{{ asset('assets/img/fornecedores.png') }}" alt="">
                        <span class="text-gray-1000">Colaboradores</span>
                    </a>
                </li>
            </div>
            <div id="financeiro">
                <hr class="sidebar-divider my-0">
                <h5 class="text-center">Financeiro</h5>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/painel-financeiro')}}">
                        <img class="fas fa-fw fa-tachometer-alt" src="{{ asset('assets/img/menu-img1.png') }}" alt="">
                        <span class="text-gray-1000">Painel Financeiro</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/painel-financeiro')}}s">
                        <img class="fas fa-fw fa-tachometer-alt" src="{{ asset('assets/img/menu-img2.png') }}" alt="">
                        <span class="text-gray-1000">Relatórios Gráficos</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/painel-financeiro#apagar')}}">
                        <img class="fas fa-fw fa-tachometer-alt" src="{{ asset('assets/img/menu-img3.png') }}" alt="">
                        <span class="text-gray-1000">À Pagar</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('adm/painel-financeiro#areceber')}}">
                        <img class="fas fa-fw fa-tachometer-alt" src="{{ asset('assets/img/menu-img4.png') }}" alt="">
                        <span class="text-gray-1000">À Receber</span>
                    </a>
                </li>
            </div>
            <hr class="sidebar-divider">
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    @if(Auth::guard('admin')->check())

                    <h5 class="text-gray-1000">Olá, {{ Auth::guard('admin')->user()->nome }}!</h5>
                    @endif



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
                                <img class="boyimg" src="{{ asset('assets/img/boy.png') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('adm/logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>

                        </li>
                    </ul>
                </nav>


        
        
                <div class="">  
                    @yield('content')   
                </div>





                <script src="{{ asset('assets/vendor_adm/jquery/jquery.min.js') }}"></script>
                <script src="{{ asset('assets/vendor_adm/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                <!--  <script src="{{ asset('assets/vendor_adm/jquery-easing/jquery.easing.min.js') }}"></script>-->
                <script src="{{ asset('assets/js/js_adm/ruang-admin.min.js') }}"></script>
                <script src="{{ asset('assets/vendor_adm/datatables/jquery.dataTables.min.js') }}"></script>
                <script src="{{ asset('assets/vendor_adm/datatables/dataTables.bootstrap4.min.js') }}"></script>
                <script>
                    // Função para inicializar os componentes de Bootstrap que requerem JavaScript
                    $(document).ready(function() {
                        // Inicializa todos os dropdowns
                        $('.dropdown-toggle').dropdown();
                    });
                </script>
</body>

</html>