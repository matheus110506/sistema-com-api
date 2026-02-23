<h2>Filhos</h2>

<a href="index.php?page=dashboard">Voltar</a>
<a href="index.php?page=filho_create&mae_id=<?php echo $maeId; ?>">
    Novo Filho
</a>

<?php if (!empty($filhos)): ?>
    <?php foreach ($filhos as $filho): ?>
        <p>
            <?php echo $filho["nome"]; ?>

            <a href="index.php?page=filho_edit&id=<?php echo $filho["id"]; ?>&mae_id=<?php echo $maeId; ?>">
                Editar
            </a>

            <a href="index.php?page=filho_delete&id=<?php echo $filho["id"]; ?>&mae_id=<?php echo $maeId; ?>">
                Excluir
            </a>
        </p>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nenhum filho cadastrado.</p>
<?php endif; ?>