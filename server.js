const express = require('express');
const cors = require('cors');
require('dotenv').config();

const app = express();

app.use(cors());
app.use(express.json());

require('./config/db');

const usuarioRoutes = require('./routes/usuarioRoutes');
app.use('/', usuarioRoutes);

app.get('/', (req,res) => {
    res.send("API funcionando");
});

app.listen(3000, () => {
    console.log("Servidor rodando na porta 3000");
});

const maeRoutes = require('./routes/maeRoutes');
app.use('/', maeRoutes);

const filhoRoutes = require('./routes/filhoRoutes');
app.use('/', filhoRoutes);

const tarefaRoutes = require('./routes/tarefaRoutes');

app.use('/', usuarioRoutes);
app.use('/', maeRoutes);
app.use('/', filhoRoutes);
app.use('/', tarefaRoutes);