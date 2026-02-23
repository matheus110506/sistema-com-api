<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
</head>
<body>

<h2>Cadastro</h2>

<form method="POST" action="index.php?page=cadastro">
    <label>Nome:</label><br>
    <input type="text" name="nome"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha"><br><br>

    <button type="submit">Cadastrar</button>
</form>

<p style="color:green;">
    <?php echo $mensagem ?? ""; ?>
</p>

<a href="index.php?page=login">Já tem conta? Fazer login</a>

</body>
</html>
