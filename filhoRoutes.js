const express = require('express');
const router = express.Router();
const filhoController = require('../controllers/filhoController');
const authMiddleware = require('../middlewares/authMiddleware');

router.post('/filhos', authMiddleware.verificarToken, filhoController.criarFilho);
router.get('/filhos', authMiddleware.verificarToken, filhoController.listarFilhos);
router.put('/filhos/:id', authMiddleware.verificarToken, filhoController.atualizarFilho);
router.delete('/filhos/:id', authMiddleware.verificarToken, filhoController.deletarFilho);

module.exports = router;