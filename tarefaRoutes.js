const express = require('express');
const router = express.Router();
const tarefaController = require('../controllers/tarefaController');
const authMiddleware = require('../middlewares/authMiddleware');

router.post('/tarefas', authMiddleware.verificarToken, tarefaController.criarTarefa);
router.get('/tarefas', authMiddleware.verificarToken, tarefaController.listarTarefas);
router.put('/tarefas/:id', authMiddleware.verificarToken, tarefaController.atualizarTarefa);
router.delete('/tarefas/:id', authMiddleware.verificarToken, tarefaController.deletarTarefa);

module.exports = router;