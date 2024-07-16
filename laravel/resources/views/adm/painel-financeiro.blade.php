<!-- resources/views/node/index.blade.php -->
@extends('adm.templates.template')

@section('title', 'Painel Financeiro')

@section('content')
<div>
<iframe src="http://localhost:3000" style="width: 100%; height: 100vh; border: none;">
    
</iframe>


<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Gastos</h1>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item">Gastos</li>
      </ol>
  </div>

  <div class="row">
      <div class="col-lg-12">
          <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Gastos</h6>
                  <button class="btn btn-primary" data-toggle="modal"
                      data-target="#modalAdicionarAgendamento">Adicionar Gasto</button>
              </div>
              <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                      <thead class="thead-light">
                          <tr>
                              <th>ID</th>
                              <th>Motivo</th>
                              <th>Valor</th>
                              <th>Ações</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($gastos as $gasto)
                              <tr>
                                  <td>{{ $gasto->id }}</td>
                                  <td>{{ $gasto->motivo }}</td>
                                  <td>{{ $gasto->valor }}</td>
                                  

                                  <td>
                                      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                          <div class="btn-group mr-2" role="group" aria-label="Ações do Pedido">
                                              <button class="btn btn-primary btn-sm"
                                                  onclick="carregarDadosParaEdicao('{{ $gasto->id }}')"
                                                  data-toggle="modal" data-target="#modalEditarAgendamento">
                                                  Editar
                                              </button>
                                          </div>

                                          <div class="btn-group mr-2" role="group" aria-label="Ações do Cliente">
                                              <button type="button" class="btn btn-danger btn-sm"
                                                  onclick="abrirModalExclusao('{{ $gasto->id }}')">
                                                  Excluir
                                              </button>
                                          </div>


                                          <div class="btn-group" role="group" aria-label="Ações do Pedido">
                                              <button class="btn btn-info btn-sm"
                                                  onclick="mostrarDetalhes('{{ $gasto->id }}')" data-toggle="modal"
                                                  data-target="#modalDetalhesAgendamento">
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

    
<div  id="scroll-apagar" class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-1000" >À Pagar</h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a style="color: #8ebba7;" href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">À pagar</li>
          </ol>
        </div>
          <!-- Simple Tables -->
          <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Custos</h6>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Custos</th>
                    <th>Departamento</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Ação</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="#">RA0449</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                    
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA5324</a></td>
                    <td>Loremr</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                   
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA8568</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                 
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA1453</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                    
                
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA1998</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>                      
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                  <td><a href="#" class="btn btn-sm btn-info">Adicionar Gasto</a></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>
            
          





         <!---Container Fluid a receber-->
         <br>
         <div  id="scroll-areceber" class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-1000" >À Receber</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a style="color: #8ebba7;"  href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">À Receber</li>
              
            </ol>
          </div>
           <!-- Simple Tables 2 -->
           
           <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Consolidado (O serviço/produto foi entregue)</h6>
              <td><a href="#" class="btn btn-sm btn-info">Adicionar recebimento</a></td>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Ação</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="#">RA0449</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                    
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA5324</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                   
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA8568</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                 
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA1453</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA1998</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                    
                  
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  
                  
                </tbody>
              </table>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>
      
         <!---Container Fluid a receber 2-->
         <br>
         <div  id="scroll-areceber" class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          
           
          </div>
           <!-- Simple Tables 3 -->
           
           <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Não Consolidado (O serviço/produto não foi entregue)</h6>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Ação</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="#">RA0449</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                    
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA5324</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                   
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA8568</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                 
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA1453</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                  <tr>
                    <td><a href="#">RA1998</a></td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>R$0,00</td>
                    
                  
                    <td><a href="#" class="btn btn-sm btn-primary">Detalhes</a></td>
                  </tr>
                 
                  
                </tbody>
              </table>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>
            
     
    </div>
    
        
  </div>
  </div>
@endsection

