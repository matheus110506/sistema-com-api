const connection = require('../config/db');

exports.criarTarefa = (req, res) => {

    const { titulo, descricao, filho_id } = req.body;
    const usuario_id = req.usuario.id;

    if (!titulo || !filho_id) {
        return res.status(400).json({ mensagem: "Título e filho_id são obrigatórios" });
    }

    connection.query(
        `SELECT filhos.id
        FROM filhos
        JOIN maes ON filhos.mae_id = maes.id
        WHERE filhos.id = ? AND maes.usuario_id = ?`,
        [filho_id, usuario_id],
        (err, results) => {
            
            if (err) return res.status(500).json({ erro: err });

            if (results.length === 0) {
                return res.status(403).json({ mensagem: "Acesso negado ao filho informado" });
            }

            connection.query(
                "INSERT INTO tarefas (titulo, descricao, filho_id) VALUES (?, ?, ?)",
                [titulo, descricao, filho_id],
                (err, result) => {

                    if (err) return res.status(500).json({ erro: err });

                    res.status(201).json({
                        mensagem: "Tarefa criada com sucesso",
                        id: result.insertId
                    });
                }
            );
        }
    );
};

exports.listarTarefas = (req, res) => {

    const usuario_id = req.usuario.id;

    connection.query(
        `SELECT tarefas.*
        FROM tarefas
        JOIN filhos ON tarefas.filho_id = filhos.id
        JOIN maes ON filhos.mae_id = maes.id
        WHERE maes.usuario_id = ?`,
        [usuario_id],
        (err, results) => {

            if (err) return res.status(500).json({ erro: err });

            res.json(results);
        }
    );
};

exports.atualizarTarefa = (req, res) => {

    const { titulo, descricao } = req.body;
    const { id } = req.params;
    const usuario_id = req.usuario.id;
    
    connection.query(
        `UPDATE tarefas
        JOIN filhos ON tarefas.filho_id = filhos.id
        JOIN maes ON filhos.mae_id = maes.id
        SET tarefas.titulo = ?, tarefas.descricao = ?
        WHERE tarefas.id = ? AND maes.usuario_id = ?`,
        [titulo, descricao, id, usuario_id],
        (err, result) => {

            if (err) return res.status(500).json({ erro: err });

            res.json({ mensagem: "Tarefa atualizada com sucesso" });
        }
    );
};

exports.deletarTarefa = (req, res) => {

    const { id } = req.params;
    const usuario_id = req.usuario.id;

    connection.query(
        `DELETE tarefas FROM tarefas
        JOIN filhos ON tarefas.filho_id = filhos.id
        JOIN maes ON filhos.mae_id = maes.id
        WHERE tarefas.id = ? AND maes.usuario_id = ?`,
        [id, usuario_id],
        (err, result) => {

            if (err) return res.status(500).json({ erro: err });

            res.json({ mensagem: "Tarefa removida" });
        }
    );
};