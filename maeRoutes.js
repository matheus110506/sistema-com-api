const express = require('express');
const router = express.Router();
const maeController = require('../controllers/maeController');
const authMiddleware = require('../middlewares/authMiddleware');

router.post('/maes', authMiddleware.verificarToken, maeController.criarMae);
router.get('/maes', authMiddleware.verificarToken, maeController.listarMaes);
router.put('/maes/:id', authMiddleware.verificarToken, maeController.atualizarMae);
router.delete('/maes/:id', authMiddleware.verificarToken, maeController.deletarMae);

module.exports = router;