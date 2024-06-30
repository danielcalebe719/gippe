
function logar(){

 var username = document.getElementById('username').value;

 if(username =='gestoroperacional'){
    
    location.href = 'painel-operacional.html'
    alert('Sucesso')
 }

 else if(username =='gestorfinanceiro'){
    
    location.href = 'painel-financeiro.html'
    alert('Sucesso')
 }
 else{
    alert('Usuário ou senha incorretos')
 }

}