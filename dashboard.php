<h2>Dashboard</h2>

<p>
    <a href="index.php?page=logout">Sair</a> |
    <a href="index.php?page=mae_create">Cadastrar Nova Mãe</a>
</p>

<h3>Lista de Mães</h3>

<?php if (!empty($maes) && is_array($maes)): ?>

    <ul>
        <?php foreach ($maes as $mae): ?>
            <li>
                <strong><?php echo htmlspecialchars($mae["nome"]); ?></strong>

                | <a href="index.php?page=mae_edit&id=<?php echo $mae["id"]; ?>">
                    Editar
                  </a>

                | <a href="index.php?page=mae_delete&id=<?php echo $mae["id"]; ?>"
                     onclick="return confirm('Tem certeza que deseja excluir?')">
                    Excluir
                  </a>

                | <a href="index.php?page=filhos&mae_id=<?php echo $mae["id"]; ?>">
                    Ver Filhos
                  </a>
            </li>
        <?php endforeach; ?>
    </ul>

<?php else: ?>
    <p>Nenhuma mãe cadastrada.</p>
<?php endif; ?>
