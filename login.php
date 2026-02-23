<?php
session_start();

if (isset($_SESSION["token"])) {
    header("Location: dashboard.php");
    exit();
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (empty($email) || empty($senha)) {
        $mensagem = "Preencha todos os campos!";
    }  else {

        $dados = [
            "email" => $email,
            "senha" => $senha
        ];

        $ch = curl_init("http://localhost:3000/login");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));

        $response = curl_exec($ch);
        curl_close($ch);

        $resultado = json_decode($response, true);

        if (isset($resultado["token"])) {
            $_SESSION["token"] = $resultado["token"];
            header("Location: dashboard.php");
            exit();
        } else {
            $mensagem = $resultado["mensagem"] ?? "Erro ao fazer login";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST">
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="senha" placeholder="Senha"><br><br>
    <button type="submit">Entrar</button>
</form>

<p style="color:red;">
    <?php echo $mensagem ?? ""; ?>
</p>

</body>
</html>
