const ctxBar = document.getElementById('myBarChart').getContext('2d');
const ctxArea = document.getElementById('myAreaChart').getContext('2d');
let myBarChart, myAreaChart;

function initializeYearSelector() {
  const yearSelector = document.getElementById('yearSelector');
  const currentYear = new Date().getFullYear();
  for (let year = currentYear - 10; year <= currentYear; year++) {
    const option = document.createElement('option');
    option.value = year;
    option.textContent = year;
    if (year === currentYear) {
      option.selected = true;
    }
    yearSelector.appendChild(option);
  }
}

async function fetchData(year) {
  console.log(`Buscando dados para o ano: ${year}`);
  const response = await fetch(`/api/lucro-mensal?year=${year}`);
  const data = await response.json();
  console.log('Dados recebidos:', data);

  const formattedData = data.map(item => ({
    mes: parseInt(item.mes.substring(5, 7)),
    lucro: parseFloat(item.lucro)
  }));

  return formattedData;
}

async function createChart() {
  const year = document.getElementById('yearSelector').value;
  console.log(`Ano selecionado: ${year}`);
  const data = await fetchData(year);

  const months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
  const lucroPorMes = Array(12).fill(0);

  data.forEach(item => {
    lucroPorMes[item.mes - 1] = parseFloat(item.lucro);
  });

  console.log('Lucro por mês:', lucroPorMes);

  if (myBarChart) {
    myBarChart.destroy();
  }

  myBarChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels: months,
      datasets: [{
        label: `Lucro Mensal - ${year}`,
        data: lucroPorMes,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  if (myAreaChart) {
    myAreaChart.destroy();
  }

  myAreaChart = new Chart(ctxArea, {
    type: 'line',
    data: {
      labels: months,
      datasets: [{
        label: `Lucro Total - ${year}`,
        data: lucroPorMes,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initializeYearSelector();
  createChart();

  fetch('/api/departamentos')
    .then(response => {
      if (!response.ok) {
        return response.text().then(text => {
          throw new Error(`Erro ${response.status}: ${text}`);
        });
      }
      return response.json();
    })
    .then(data => {
      console.log('Departamentos data:', data);
      createPieChart(data);
    })
    .catch(error => {
      console.error(error);
      alert(`Ocorreu um erro ao obter os dados de departamentos: ${error.message}`);
    });

  document.getElementById('yearSelector').addEventListener('change', createChart);
});

function createPieChart(data) {
  const ctx = document.getElementById('myPieChart').getContext('2d');
  const labels = data.map(item => item.departamento);
  const values = data.map(item => item.gasto);

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [{
        label: 'Gasto por Departamento',
        data: values,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Gasto por Departamento'
        }
      }
    }
  });
}




document.addEventListener('DOMContentLoaded', function() {
  // Selecionar o elemento <canvas> e seu contexto 2D
  const canvas = document.getElementById('top5ProdutosChart');
  const ctx = canvas.getContext('2d');

  // Requisição AJAX para obter dados do servidor Node.js
  const xhr = new XMLHttpRequest();
  xhr.open('GET', '/api/top5-produtos', true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);

      const labels = data.map(item => `${item.nomeProduto} (${item.tipoProduto})`); // Nomes e tipos dos produtos
      const dataValues = data.map(item => item.quantidade_vendas); // Quantidades vendidas

      // Configurar o gráfico usando a API Chart.js
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Quantidade de Produtos Vendidos',
            data: dataValues,
            backgroundColor: 'rgba(54, 162, 235, 0.6)', // Cor das barras
            borderColor: 'rgba(54, 162, 235, 1)', // Cor da borda das barras
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                callback: function(value) { return Number(value).toLocaleString(); } // Formata os ticks do eixo Y
              },
              scaleLabel: {
                display: true,
                labelString: 'Quantidade de Vendas'
              }
            }],
            xAxes: [{
              ticks: {
                autoSkip: false,
                maxRotation: 45,
                minRotation: 45
              },
              scaleLabel: {
                display: true,
                labelString: 'Produtos'
              }
            }]
          },
          tooltips: {
            callbacks: {
              title: function(tooltipItem, data) {
                return data.labels[tooltipItem[0].index];
              },
              label: function(tooltipItem, data) {
                return `Vendas: ${tooltipItem.value.toLocaleString()}`;
              }
            }
          }
        }
      });
    } else {
      console.error('Erro ao carregar dados do gráfico');
    }
  };
  xhr.send();
});
