const express = require('express');
const PDFDocument = require('pdfkit');
const fs = require('fs');
const mysql = require('mysql');

const app = express();
const port = 3001;

// Configurações de conexão com o banco de dados
const pool = mysql.createPool({
  connectionLimit: 10,
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'bb'
});

// Função para gerar o relatório financeiro em PDF
function generatePDF(res) {
  // Criar um novo documento PDF
  const doc = new PDFDocument({
    margin: 50,
    bufferPages: true,
    font: 'Helvetica'
  });

  // Cores personalizadas
  const colors = {
    primary: '#003366',
    secondary: '#FF6600',
    background: '#F0F0F0',
    text: '#333333'
  };

  // Fontes personalizadas
  const fonts = {
    header: 'Helvetica-Bold',
    subheader: 'Helvetica-BoldOblique',
    body: 'Helvetica'
  };

  // Consulta para buscar dados dos pedidos e gastos com join na tabela clientes
  const query = `
    SELECT 'Pedidos' AS tipo, p.idPedidos AS id, c.nome AS cliente_nome, c.email AS cliente_email, c.telefone AS cliente_telefone,
           p.observacao, p.status, p.total_pedido AS total, p.data_pedido AS data, p.descricao, NULL AS departamento
    FROM pedidos p
    LEFT JOIN clientes c ON p.idCliente = c.idCliente
    WHERE p.data_pedido >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    UNION ALL
    SELECT 'Gastos' AS tipo, g.idCusto AS id, NULL AS cliente_nome, NULL AS cliente_email, NULL AS cliente_telefone,
           g.motivo AS observacao, g.status, g.total_gasto AS total, g.data_gasto AS data, g.descricao, g.departamento
    FROM gasto g
    WHERE g.data_gasto >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    ORDER BY tipo, id
  `;

  // Obter uma conexão do pool
  pool.getConnection((err, connection) => {
    if (err) {
      console.error('Erro ao obter conexão do pool:', err);
      res.status(500).send('Erro ao conectar ao banco de dados');
      return;
    }

    console.log('Conexão ao banco de dados obtida com sucesso.');

    // Executar consulta
    connection.query(query, (error, results, fields) => {
      // Liberar conexão de volta ao pool
      connection.release();

      if (error) {
        console.error('Erro ao executar consulta:', error.stack);
        res.status(500).send('Erro ao executar consulta');
        return;
      }

      // Configurações de formatação para o PDF
      doc.fontSize(12);

      // Cabeçalho do relatório
      drawHeader(doc, colors, fonts);

      // Adicionar gráfico de pizza para representar total de pedidos e gastos
      drawPieChart(doc, results, colors);

      // Adicionar gráfico de linha para mostrar evolução dos valores ao longo do tempo
      drawLineChart(doc, results, colors);

      // Adicionar tabela para os detalhes dos pedidos e gastos
      addTable(doc, results, colors, fonts);

      // Rodapé com informações de contato, data e número de página
      drawFooter(doc, colors, fonts);

      // Finaliza o documento PDF
      const outputFileName = 'relatorio_financeiro.pdf';
      const outputStream = fs.createWriteStream(outputFileName);
      doc.pipe(outputStream);
      doc.end();

      console.log(`Relatório Financeiro gerado com sucesso em ${outputFileName}.`);

      // Envio do arquivo PDF como resposta para download
res.download(outputFileName, (err) => {
  if (err) {
    
   //console.error('Erro ao realizar o download:', err);
    if (!res.headersSent) {
    //  res.status(500).send('Erro ao realizar o download');
    }
  } else {
    console.log('Download do arquivo concluído com sucesso.');
    // Após o download, exclua o arquivo PDF gerado
    fs.unlinkSync(outputFileName); // Remove o arquivo após o download
  }
}); 
    });
  });
}

// Função para desenhar o cabeçalho do relatório
function drawHeader(doc, colors, fonts) {
  doc.fillColor(colors.primary)
     .font(fonts.header)
     .text('Relatório Financeiro', { align: 'center', fontSize: 24 })
     .moveDown(0.5)
     .font(fonts.body)
     .text('Buffet Divino Sabor', { align: 'center' })
     .moveDown();
}

// Função para desenhar um gráfico de pizza para representar total de pedidos e gastos
function drawPieChart(doc, results, colors) {
  // Implementação do gráfico de pizza aqui (exemplo)
  // Exemplo: doc.circle(x, y, radius).fillColor(color).stroke();
}

// Função para desenhar um gráfico de linha para mostrar evolução dos valores ao longo do tempo
function drawLineChart(doc, results, colors) {
  // Implementação do gráfico de linha aqui (exemplo)
  // Exemplo: doc.moveTo(x1, y1).lineTo(x2, y2).stroke();
}

// Função para adicionar uma tabela com os detalhes dos pedidos e gastos
function addTable(doc, results, colors, fonts) {
  // Configurações da tabela
  const tableTop = 320; // Posição inicial da tabela
  const rowHeight = 50;
  const col1Width = 50;
  const colWidth = (doc.page.width - 2 * doc.page.margins.left - col1Width) / 7;

  // Cabeçalhos da tabela
  doc.font(fonts.header).fontSize(10);
  doc.text('Tipo', doc.page.margins.left, tableTop);
  doc.text('ID', doc.page.margins.left + col1Width, tableTop);
  doc.text('Cliente', doc.page.margins.left + col1Width + colWidth, tableTop);
  doc.text('Observação', doc.page.margins.left + col1Width + 2 * colWidth, tableTop);
  doc.text('Status', doc.page.margins.left + col1Width + 3 * colWidth, tableTop);
  doc.text('Total', doc.page.margins.left + col1Width + 4 * colWidth, tableTop);
  doc.text('Data', doc.page.margins.left + col1Width + 5 * colWidth, tableTop);
  doc.text('Descrição', doc.page.margins.left + col1Width + 6 * colWidth, tableTop);

  // Linha divisória abaixo dos cabeçalhos
  doc.moveTo(doc.page.margins.left, tableTop + 15).lineTo(doc.page.width - doc.page.margins.right, tableTop + 15).stroke();

  // Dados da tabela
  doc.font(fonts.body).fontSize(8);
  let yPos = tableTop + 20;
  results.forEach((row, index) => {
    yPos += rowHeight;
    doc.text(row.tipo, doc.page.margins.left, yPos);
    doc.text(row.id.toString(), doc.page.margins.left + col1Width, yPos);
    doc.text(row.cliente_nome || '', doc.page.margins.left + col1Width + colWidth, yPos);
    doc.text(row.observacao || '', doc.page.margins.left + col1Width + 2 * colWidth, yPos);
    doc.text(row.status || '', doc.page.margins.left + col1Width + 3 * colWidth, yPos);
    doc.text(row.total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }), doc.page.margins.left + col1Width + 4 * colWidth, yPos);
    doc.text(row.data ? formatDate(row.data) : '', doc.page.margins.left + col1Width + 5 * colWidth, yPos);
    doc.text(row.descricao || '', doc.page.margins.left + col1Width + 6 * colWidth, yPos);

    // Linhas horizontais entre as linhas da tabela
    if (index < results.length - 1) {
      doc.moveTo(doc.page.margins.left, yPos + 10).lineTo(doc.page.width - doc.page.margins.right, yPos + 10).stroke();
    }
  });
}

// Função para desenhar o rodapé do relatório
function drawFooter(doc, colors, fonts) {
  const footerHeight = 50;
  const footerText = `Contato: buffetdivinosabor@orgs.com | Data de Geração: ${new Date().toLocaleDateString()} `;
  doc.fontSize(8)
     .text(footerText, doc.page.margins.left, doc.page.height - footerHeight, {
       width: doc.page.width - 2 * doc.page.margins.left,
       align: 'center'
     });
}

// Função auxiliar para formatar a data no formato dd/mm/aaaa
function formatDate(date) {
  const formattedDate = new Date(date).toLocaleDateString('pt-BR');
  return formattedDate;
}

// Rota para gerar e baixar o relatório financeiro em PDF
app.get('/gerar-relatorio-financeiro', (req, res) => {
  generatePDF(res);
});

// Iniciar o servidor Express
app.listen(port, () => {
  console.log(`Servidor Express iniciado na porta ${port}`);
});
