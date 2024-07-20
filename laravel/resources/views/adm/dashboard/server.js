const express = require('express');
const mysql = require('mysql2/promise');
const path = require('path');
const app = express();
const port = 3000;

// Configuração do banco de dados MySQL
const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'bdtcc'
};

// Middleware para definir o Content-Type como application/json para a API
app.use((req, res, next) => {
  if (req.path.startsWith('/api/')) {
    res.setHeader('Content-Type', 'application/json');
  }
  next();
});

// Endpoint para obter dados dos departamentos
app.get('/api/departamentos', async (req, res) => {
  const dataInicial = new Date();
  dataInicial.setDate(dataInicial.getDate() - 30);
  const dataFormatada = dataInicial.toISOString().slice(0, 10);

  const query = `
    SELECT departamento, SUM(valor) AS gasto 
    FROM gastos 
    WHERE dataCadastro >= ? 
    GROUP BY departamento
  `;

  try {
    const connection = await mysql.createConnection(dbConfig);
    const [results] = await connection.execute(query, [dataFormatada]);
    res.json(results);
    await connection.end();
  } catch (error) {
    console.error('Erro ao executar consulta:', error);
    res.status(500).send('Erro ao obter dados');
  }
});

// Endpoint para obter dados de lucro mensal filtrados por ano
app.get('/api/lucro-mensal', async (req, res) => {
  const year = req.query.year || new Date().getFullYear();
  const query = `
    SELECT 
        DATE_FORMAT(dataPedido, '%Y-%m') AS mes,
        COALESCE(SUM(totalPedido), 0) AS total_pedido,
        COALESCE(SUM((SELECT SUM(valor) FROM gastos WHERE YEAR(dataCadastro) = ? AND MONTH(dataCadastro) = MONTH(dataPedido))), 0) AS total_gasto,
        COALESCE(SUM(totalPedido) - (SELECT SUM(valor) FROM gastos WHERE YEAR(dataCadastro) = ? AND MONTH(dataCadastro) = MONTH(dataPedido)), 0) AS lucro
    FROM 
        pedidos
    WHERE 
        YEAR(dataPedido) = ?
    GROUP BY 
        mes
    ORDER BY 
        mes;
  `;

  try {
    const connection = await mysql.createConnection(dbConfig);
    const [results] = await connection.execute(query, [year, year, year]);
    res.json(results);
    await connection.end();
  } catch (error) {
    console.error('Erro ao executar consulta:', error);
    res.status(500).send('Erro ao obter dados');
  }
});

// Endpoint para obter dados de 'a_receber', 'a_pagar', 'vendas_mensais' e 'lucro_mensal'
app.get('/api/dashboard-data', async (req, res) => {
  try {
    const connection = await mysql.createConnection(dbConfig);

    // Total a Receber
    const totalReceberQuery = `
      SELECT COALESCE(SUM(totalPedido), 0) AS total_a_receber 
      FROM pedidos 
      WHERE status = '3';
    `;
    const [totalReceberRows] = await connection.execute(totalReceberQuery);

    // Total a Pagar
    const totalPagarQuery = `
      SELECT COALESCE(SUM(valor), 0) AS total_a_pagar 
      FROM gastos 
      WHERE status = '1';
    `;
    const [totalPagarRows] = await connection.execute(totalPagarQuery);

    // Vendas Mensais
    const currentMonth = new Date().getMonth() + 1;
    const vendasMensaisQuery = `
      SELECT COALESCE(COUNT(*), 0) AS vendas_mensais 
      FROM pedidos 
      WHERE MONTH(dataPedido) = ? AND YEAR(dataPedido) = ?;
    `;
    const [vendasMensaisRows] = await connection.execute(vendasMensaisQuery, [currentMonth, new Date().getFullYear()]);

    // Lucro Mensal
    const lucroMensalQuery = `
      SELECT COALESCE(SUM(totalPedido), 0) AS lucro_mensal 
      FROM pedidos 
      WHERE MONTH(dataPedido) = ? AND YEAR(dataPedido) = ? AND status = '6';
    `;
    console.log(lucroMensalQuery)
    const [lucroMensalRows] = await connection.execute(lucroMensalQuery, [currentMonth, new Date().getFullYear()]);

    await connection.end();

    const total_a_receber = parseFloat(totalReceberRows[0].total_a_receber);
    const total_a_pagar = parseFloat(totalPagarRows[0].total_a_pagar);
    const vendas_mensais = parseInt(vendasMensaisRows[0].vendas_mensais);
    const lucro_mensal = parseFloat(lucroMensalRows[0].lucro_mensal);

    res.json({
      total_a_receber,
      total_a_pagar,
      vendas_mensais,
      lucro_mensal
    });
  } catch (error) {
    console.error('Erro ao obter dados do painel:', error);
    res.status(500).send('Erro ao obter dados do painel');
  }
});

// Endpoint para obter os 5 produtos mais vendidos
app.get('/api/top5-produtos', async (req, res) => {
  try {
    const query = `
      SELECT 
        pp.idProdutos AS idProduto, 
        pr.nome AS nomeProduto, 
        pr.tipo AS tipoProduto, 
        SUM(pp.quantidade) AS quantidade_vendas
      FROM pedidos_produtos pp
      INNER JOIN produtos pr ON pp.idProdutos = pr.id
      INNER JOIN pedidos p ON pp.idPedidos = p.id
      WHERE p.dataPedido >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)
      GROUP BY pp.idProdutos
      ORDER BY quantidade_vendas DESC
      LIMIT 5
    `;

    const connection = await mysql.createConnection(dbConfig);
    const [results] = await connection.execute(query);
    res.json(results);
    await connection.end();
  } catch (error) {
    console.error('Erro ao obter os top 5 produtos:', error);
    res.status(500).send('Erro ao obter os top 5 produtos');
  }
});

// Servir arquivos estáticos
app.use(express.static(path.join(__dirname, 'public')));

// Iniciar o servidor
app.listen(port, () => {
  console.log(`Servidor rodando em http://localhost:${port}`);
});
