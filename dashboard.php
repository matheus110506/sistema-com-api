<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>

<a href="index.php?page=logout">Sair</a>

<h3>Minhas Mães</h3>

<?php if (is_array($maes) && count($maes) > 0): ?>
    <?php foreach ($maes as $mae): ?>
        <p><?php echo $mae["nome"]; ?></p>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nenhuma mãe cadastrada.</p>
<?php endif; ?>

</body>
</html>
