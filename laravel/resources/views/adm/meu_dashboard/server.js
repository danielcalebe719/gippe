const express = require('express');
const mysql = require('mysql2/promise'); // Use mysql2/promise for async/await
const path = require('path');
const app = express();
const port = 3000;

// Configuração do banco de dados MySQL
const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'bb'
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
  // Obtém a data atual menos 30 dias
  const dataInicial = new Date();
  dataInicial.setDate(dataInicial.getDate() - 30);

  // Formata a data para o formato SQL (YYYY-MM-DD)
  const dataFormatada = dataInicial.toISOString().slice(0, 10);

  // Monta a query SQL com a cláusula WHERE para os últimos 30 dias
  const query = `
    SELECT departamento, SUM(total_gasto) AS gasto 
    FROM gasto 
    WHERE data_gasto >= '${dataFormatada}' 
    GROUP BY departamento
  `;

  try {
    const connection = await mysql.createConnection(dbConfig);
    const [results] = await connection.execute(query);
    console.log(`Resultados da consulta (${results.length} registros):`, results);
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
  console.log(`Ano solicitado: ${year}`);
  const query = `
    SELECT 
        mes,
        COALESCE(SUM(total_pedido), 0) AS total_pedido,
        COALESCE(SUM(total_gasto), 0) AS total_gasto,
        COALESCE(SUM(lucro), 0) AS lucro
    FROM (
        SELECT 
            DATE_FORMAT(p.data_pedido, '%Y-%m') AS mes,
            p.total_pedido,
            g.total_gasto,
            (p.total_pedido - g.total_gasto) AS lucro
        FROM 
            pedidos p
        LEFT JOIN 
            gasto g ON DATE_FORMAT(g.data_gasto, '%Y-%m') = DATE_FORMAT(p.data_pedido, '%Y-%m')
        WHERE 
            YEAR(p.data_pedido) = ?
    ) AS lucros_mensais
    GROUP BY 
        mes
    ORDER BY 
        mes;
  `;
  try {
    const connection = await mysql.createConnection(dbConfig);
    const [results] = await connection.execute(query, [year]);
    console.log('Resultados da consulta:', results);
    res.json(results);
    await connection.end();
  } catch (error) {
    console.error('Erro ao executar consulta:', error);
    res.status(500).send('Erro ao obter dados');
  }
});

/// Endpoint para obter dados de 'a_receber', 'a_pagar', 'vendas_mensais' e 'lucro_mensal'
app.get('/api/dashboard-data', async (req, res) => {
  try {
    // Conexão com o banco de dados
    const connection = await mysql.createConnection(dbConfig);

    // Consulta SQL para obter 'total_a_receber'
    const totalReceberQuery = `
      SELECT COALESCE(SUM(total_pedido), 0) AS total_a_receber 
      FROM pedidos 
      WHERE status = 'aPagar'`;
    const [totalReceberRows] = await connection.execute(totalReceberQuery); // Corrigido

    // Consulta SQL para obter 'total_a_pagar'
    const totalPagarQuery = `
      SELECT COALESCE(SUM(total_gasto), 0) AS total_a_pagar 
      FROM gasto 
      WHERE status = 'a pagar'`;
    const [totalPagarRows] = await connection.execute(totalPagarQuery); // Corrigido

    // Consulta SQL para obter 'vendas_mensais'
    const currentMonth = new Date().getMonth() + 1;
    const vendasMensaisQuery = `
      SELECT COALESCE(COUNT(*), 0) AS vendas_mensais 
      FROM pedidos 
      WHERE MONTH(data_pedido) = ? AND YEAR(data_pedido) = ?`;
    const [vendasMensaisRows] = await connection.execute(vendasMensaisQuery, [currentMonth, new Date().getFullYear()]);

    // Consulta SQL para obter 'lucro_mensal'
    const lucroMensalQuery = `
      SELECT COALESCE(SUM(total_pedido), 0) AS lucro_mensal 
      FROM pedidos 
      WHERE MONTH(data_pedido) = ? AND YEAR(data_pedido) = ? AND status = 'pago'`;
    const [lucroMensalRows] = await connection.execute(lucroMensalQuery, [currentMonth, new Date().getFullYear()]);

    // Fechar conexão com o banco de dados
    await connection.end();

    // Extrair os resultados das consultas
    const total_a_receber = parseFloat(totalReceberRows[0].total_a_receber);
    const total_a_pagar = parseFloat(totalPagarRows[0].total_a_pagar);
    const vendas_mensais = parseInt(vendasMensaisRows[0].vendas_mensais);
    const lucro_mensal = parseFloat(lucroMensalRows[0].lucro_mensal);

    // Enviar os dados como JSON
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






  app.get('/api/top5-produtos', async (req, res) => {
    try {
      const query = `
      SELECT 
        pp.idProdutos AS idProduto, 
        pr.nome AS nomeProduto, 
        pr.tipo AS tipoProduto, 
        SUM(pp.quantidade) AS quantidade_vendas
      FROM pedidosprodutos pp
      INNER JOIN produtos pr ON pp.idProdutos = pr.idProdutos
      INNER JOIN pedidos p ON pp.idPedidos = p.idPedidos
      WHERE p.data_pedido >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)
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




