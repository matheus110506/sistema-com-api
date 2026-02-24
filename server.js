const express = require('express');
const cors = require('cors');
require('dotenv').config();

const app = express();

app.use(cors());
app.use(express.json());

require('./config/db');

// Rotas
const usuarioRoutes = require('./routes/usuarioRoutes');
const maeRoutes = require('./routes/maeRoutes');
const filhoRoutes = require('./routes/filhoRoutes');
const tarefaRoutes = require('./routes/tarefaRoutes');

app.use('/', usuarioRoutes);
app.use('/', maeRoutes);
app.use('/', filhoRoutes);
app.use('/', tarefaRoutes);

app.get('/', (req,res) => {
    res.send("API funcionando");
});

app.listen(3000, () => {
    console.log("Servidor rodando na porta 3000");
});
