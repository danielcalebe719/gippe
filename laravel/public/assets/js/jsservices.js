
    document.addEventListener("DOMContentLoaded", function() {
        // Seu código JavaScript aqui
        function atualizarPreco() {
            var precoBarmans = 150;
            var precoGarcons = 150;
            var precoCozinheiros = 150;
    
            console.log("Preço Barmans:", precoBarmans);
            console.log("Preço Garçons:", precoGarcons);
            console.log("Preço Cozinheiros:", precoCozinheiros);
    
            // Obtém os valores dos campos de quantidade de barmans, garçons e cozinheiros
            var barmans = parseInt(document.getElementById('barmans').value || 0);
            var garcons = parseInt(document.getElementById('garcons').value || 0);
            var cozinheiros = parseInt(document.getElementById('cozinheiros').value || 0);
            
            console.log("Quantidade Barmans:", barmans);
            console.log("Quantidade Garçons:", garcons);
            console.log("Quantidade Cozinheiros:", cozinheiros);
    
            // Calcula o preço total com base nas quantidades dos serviços e em seus preços individuais
            var precoTotal = (barmans * precoBarmans) + (garcons * precoGarcons) + (cozinheiros * precoCozinheiros);
            
            console.log("Preço Total:", precoTotal);
            
            // Atualiza o conteúdo do elemento <p> com o novo preço total formatado
            document.getElementById('preco').innerText = "Preço: R$" + precoTotal.toFixed(2);
        }
    
        // Adicionar ouvintes de evento após o carregamento completo da página
        document.getElementById('barmans').addEventListener('input', atualizarPreco);
        document.getElementById('garcons').addEventListener('input', atualizarPreco);
        document.getElementById('cozinheiros').addEventListener('input', atualizarPreco);
    });
    


