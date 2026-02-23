<?php
session_start();

if (isset($_SESSION["token"])) {
    header("Location: dashboard.php");
    exit();
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (empty($nome) || empty($email) || empty($senha)) {
        $mensagem = "Preencha todos os campos!";
    } else {

        $dados = [
            "nome" => $nome,
            "email" => $email,
            "senha" => $senha
        ];

        $ch = curl_init("http://localhost:3000/usuarios");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));

        $response = curl_exec($ch);
        curl_close($ch);

        $resultado = json_decode($response, true);

        if (isset($resultado["id"])) {
            $mensagem = "Usuário cadastrado com sucesso! Faça login.";
        } else {
            $mensagem = $resultado["mensagem"] ?? "Erro ao cadastrar.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro</title>
</head>
<body>

<h2>Cadastro</h2>

<form method="POST">
    <label>Nome:</label><br>
    <input type="text" name="nome"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha"><br><br>

    <button type="submit">Cadastrar</button>
</form>

<p style="color:green;">
    <?php echo $mensagem; ?>
</p>

<a href="login.php">Já tem conta? Fazer login</a>

</body>
</html>