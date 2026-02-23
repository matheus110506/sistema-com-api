<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST" action="index.php?page=login">
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="senha" placeholder="Senha"><br><br>
    <button type="submit">Entrar</button>
</form>

<p style="color:red;">
    <?php echo $mensagem ?? ""; ?>
</p>

<a href="index.php?page=cadastro">Não possui uma conta? Fazer cadastro</a>

</body>
</html>
