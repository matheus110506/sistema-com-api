<?php
require_once "models/ApiModel.php";

class AuthController {

    private $api;

    public function __construct() {
        $this->api = new ApiModel();
    }

    public function login() {
        
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST["email"];
            $senha = $_POST["senha"];

            $resultado = $this->api->login($email, $senha);

            if (isset($resultado["token"])) {
                $_SESSION["token"] = $resultado["token"];
                header("Location: index.php?page=dashboard");
                exit();
            } else {
                $mensagem = $resultado["mensagem"] ?? "Erro no login.";
            }
        }

        require "views/login.php";
    }

    public function cadastro() {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $resultado = $this->api->cadastrar($nome, $email, $senha);

        if (isset($resultado["id"])) {
            $mensagem = "Cadastrado realizado com sucesso!";
        } else {
            $mensagem = $resultado["mensagem"] ?? "Erro no cadastro.";
        }
    }

    require "views/cadastro.php";
    
    }

    public function dashboard() {

    session_start();

    if (!isset($_SESSION["token"])) {
        header("Location: index.php?page=login");
        exit();
    }

    $token = $_SESSION["token"];
    $maes = $this->api->listarMaes($token);

    require "views/dashboard.php";
    }
}