const connection = require('../config/db');

exports.criarMae = (req, res) => {

    const { nome } = req.body;
    const usuario_id = req.usuario.id;

    if (!nome) {
        return res.status(400).json({ mensagem: "Nome é obrigatório" });
    }

    connection.query(
        "INSERT INTO maes (nome, usuario_id) VALUES (?, ?)",
        [nome, usuario_id],
        (err, result) => {
            if (err) {
                return res.status(500).json({ erro: err });
            }

            res.status(201).json({
                mensagem: "Mãe criada com sucesso",
                id: result.insertId
            });
        }
    );
};

exports.listarMaes = (req, res) => {

    const usuario_id = req.usuario.id;

    connection.query(
        "SELECT * FROM maes WHERE usuario_id = ?",
        [usuario_id],
        (err, results) => {
            if (err) {
                return res.status(500).json({ erro: err });
            }

            res.json(results);
        }
    );
};

exports.atualizarMae = (req, res) => {

    const { nome } = req.body;
    const { id } = req.params;
    const usuario_id = req.usuario.id;

    connection.query(
        "UPDATE maes SET nome = ? WHERE id = ? AND usuario_id = ?",
        [nome, id, usuario_id],
        (err, result) => {
            if (err) {
                return res.status(500).json({ erro: err });
            }

            res.json({ mensagem: "Mãe atualizada com sucesso" });
        }
    );
};

exports.deletarMae = (req, res) => {

    const { id } = req.params;
    const usuario_id = req.usuario.id;

    connection.query(
        "DELETE FROM maes WHERE id = ? AND usuario_id = ?",
        [id, usuario_id],
        (err, result) => {
            if (err) {
                return res.status(500).json({ erro: err });
            }

            res.json({ mensagem: "Mãe removida com sucesso" });
        }
    );
};