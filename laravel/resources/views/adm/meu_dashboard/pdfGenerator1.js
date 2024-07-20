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
  database: 'bdtcc'
});

function generatePDF(res) {
  const doc = new PDFDocument({
    margin: 50,
    bufferPages: true,
    font: 'Helvetica'
  });

  const colors = {
    primary: '#A7C6ED',
    secondary: '#FFB3B3',
    text: '#333333'
  };

  const fonts = {
    header: 'Helvetica-Bold',
    body: 'Helvetica'
  };

  const query = `
    SELECT 
      'Pedidos' AS tipo,
      p.id AS id,
      c.nome AS cliente_nome,
      c.email AS cliente_email,
      c.telefone AS cliente_telefone,
      p.observacao,
      p.status,
      COALESCE(p.totalPedido, 0) AS total,
      p.dataPedido AS data
    FROM pedidos p
    LEFT JOIN clientes c ON p.idClientes = c.id
    WHERE p.dataPedido >= DATE_SUB(NOW(), INTERVAL 30 DAY)

    UNION ALL

    SELECT 
      'Gastos' AS tipo,
      g.id AS id,
      NULL AS cliente_nome,
      NULL AS cliente_email,
      NULL AS cliente_telefone,
      g.motivo AS observacao,
      g.status,
      COALESCE(g.valor, 0) AS total,
      g.dataCadastro AS data
    FROM gastos g
    WHERE g.dataCadastro >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    ORDER BY tipo, id
  `;

  pool.getConnection((err, connection) => {
    if (err) {
      console.error('Erro ao obter conexão do pool:', err);
      res.status(500).send('Erro ao conectar ao banco de dados');
      return;
    }

    connection.query(query, (error, results) => {
      connection.release();

      if (error) {
        console.error('Erro ao executar consulta:', error);
        res.status(500).send('Erro ao executar consulta: ' + error.sqlMessage);
        return;
      }

      let yPos = 150; // Posição inicial do conteúdo

      function drawNewPage() {
        if (yPos > doc.page.height - doc.page.margins.bottom) {
          doc.addPage();
          drawHeader(doc, colors, fonts);
          yPos = 150; // Resetar yPos
        }
      }

      drawHeader(doc, colors, fonts);
      results.forEach((row, index) => {
        drawNewPage(); // Verifica se precisa adicionar uma nova página

        doc.font(fonts.body).fontSize(8);
        doc.text(row.tipo, doc.page.margins.left, yPos);
        doc.text(row.id.toString(), doc.page.margins.left + 50, yPos);
        doc.text(row.cliente_nome || '', doc.page.margins.left + 100, yPos);
        doc.text(row.status || '', doc.page.margins.left + 200, yPos);
        doc.text(row.total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }), doc.page.margins.left + 250, yPos);
        doc.text(formatDate(row.data), doc.page.margins.left + 300, yPos);

        if (index < results.length - 1) {
          doc.moveTo(doc.page.margins.left, yPos + 10).lineTo(doc.page.width - doc.page.margins.right, yPos + 10).stroke();
        }

        yPos += 30; // Aumentar a posição Y para a próxima linha
      });

      drawFooter(doc, colors, fonts);

      const outputFileName = 'relatorio_financeiro.pdf';
      const outputStream = fs.createWriteStream(outputFileName);
      doc.pipe(outputStream);
      doc.end();

      res.download(outputFileName, (err) => {
        if (err) {
          console.error('Erro ao realizar o download:', err);
        } else {
          fs.unlinkSync(outputFileName);
        }
      });
    });
  });
}

function drawHeader(doc, colors, fonts) {
  doc.fillColor(colors.primary)
     .rect(doc.page.margins.left, 50, doc.page.width - 2 * doc.page.margins.left, 50)
     .fill();

  doc.fillColor(colors.text)
     .font(fonts.header)
     .fontSize(16)
     .text('Relatório Financeiro', doc.page.margins.left + 20, 60);

  doc.moveTo(doc.page.margins.left, 100).lineTo(doc.page.width - doc.page.margins.right, 100).stroke();
}

function drawFooter(doc, colors, fonts) {
  const footerText = `Contato: buffetdivinosabor@orgs.com | Data de Geração: ${new Date().toLocaleDateString()} `;
  doc.fontSize(8)
     .text(footerText, doc.page.margins.left, doc.page.height - 50, {
       width: doc.page.width - 2 * doc.page.margins.left,
       align: 'center'
     });
}

function formatDate(date) {
  return new Date(date).toLocaleDateString('pt-BR');
}

app.get('/gerar-relatorio-financeiro', (req, res) => {
  generatePDF(res);
});

app.listen(port, () => {
  console.log(`Servidor Express iniciado na porta ${port}`);
});
