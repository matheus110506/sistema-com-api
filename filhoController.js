const connection = require('../config/db');

exports.criarFilho = (req, res) => {

    const { nome, mae_id } = req.body;
    const usuario_id = req.usuario.id;

    if (!nome || !mae_id) {
        return res.status(400).json({ mensagem: "Nome e mae_id são obrigatórios" });
    }

    connection.query(
        "SELECT * FROM mae WHERE id = ? AND usuario_id = ?",
        [mae_id, usuario_id],
        (err, results) => {
            
            if (err) return res.status(500).json({ erro: err });

            if (results.length === 0) {
                return res.status(403).json({ mensagem: "Aesso negado à mãe informada" });
            }

            connection.query(
                "INSERT INTO filhos (nome, mae_id) VALUES (?, ?)",
                [nome, mae_id],
                (err, result) => {

                    if (err) return res.status(500),json({ erro: err });

                    res.status(201).json({
                        mensagem: "Filho criado com sucesso",
                        id: result.insertId
                    });
                }
            );
        }
    );
};

exports.listarFilhos = (req, res) => {

    const usuario_id = req.usuario.id;

    connection.query(
        `SELECT filhos.*
         FROM filhos
         JOIN maes ON filhos.mae_id = maes.id
         WHERE maes.usuario_id = ?`,
         [usuario_id],
         (err, results) => {

            if (err) return res.status(500).json({ erro: err });

            res.json(results);
         }
    );
};

exports.atualizarFilho = (req, res) => {

    const { nome } = req.body;
    const { id } = req.params;
    const usuario_id = req.usuario.id;

    connection.query(
        `UPDATE filhos
        JOIN maes ON filhos.mae_id = maes.id
        SET filhos.nome = ?
        WHERE filhos.id = ? AND maes.usuario_id = ?`,
        [nome, id, usuario_id],
        (err, result) => {

            if (err) return res.status(500).json({ erro: err });

            res.json({ mensagem: "Filho atualizado com sucesso"});
        }
    );
};

exports.deletarFilho = (req, res) => {

    const { id } = req.params;
    const usuario_id = req.usuario.id;

    connection.query(
        `DELETE filhos FROM filhos
        JOIN maes ON filhos.mae_id = maes.id
        WHERE filhos.id = ? AND maes.usuario_id = ?`,
        [id, usuario_id],
        (err, result) => {

            if (err) return res.status(500).json({ erro: err });

            res.json({ mensagem: "Filho removido" });
        }
    );
};