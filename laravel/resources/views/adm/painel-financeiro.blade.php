<!-- resources/views/node/index.blade.php -->
@extends('adm.templates.template')

@section('title', 'Painel Financeiro')

@section('content')
<div>
<iframe src="http://localhost:3000" style="width: 100%; height: 100vh; border: none;">
    
</iframe>
    
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

