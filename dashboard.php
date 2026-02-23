<h2>Dashboard</h2>

<a href="index.php?page=logout">Sair</a>
<a href="index.php?page=mae_create">Cadastrar Nova Mãe</a>

<h3>Lista de Mães</h3>

<?php if (!empty($maes)): ?>
    <?php foreach ($maes as $mae): ?>
        <p>
            <?php echo $mae["nome"]; ?>
            <a href="index.php?page=mae_edit&id=<?php echo $mae["id"]; ?>">Editar</a>
            <a href="index.php?page=mae_delete&id=<?php echo $mae["id"]; ?>">Excluir</a>
        </p>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nenhuma mãe cadastrada.</p>
<?php endif; ?>
