<?php
session_start();

if (!isset($_SESSION["token"])) {
    header("Loaction: login.php");
    exit();
}

$token = $_SESSION["token"];

$ch = curl_init("http://localhost:3000/maes");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $token"
]);

$response = curl_exec($ch);
curl_close($ch);

$maes = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>

<a href="logout.php">Sair</a>

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