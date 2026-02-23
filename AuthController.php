<?php
require_once "models/ApiModel.php";

class AuthController {

    private $api;

    public function __construct() {
        $this->api = new ApiModel();
    }

    public function cadastro() {

    $mensagem = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST["email"] ?? "";
        $senha = $_POST["senha"] ?? "";

        if (empty($email) || empty($senha)) {
            $mensagem = "Preencha todos os campos!";
        } else {

            $resultado = $this->api->cadastro($email, $senha);

            if (isset($resultado["mensagem"])) {
                $mensagem = $resultado["mensagem"];
            }

            header("Location: index.php?page=login");
            exit();
        }
    }

    require "views/cadastro.php";
}

    public function login() {

        $mensagem = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST["email"] ?? "";
            $senha = $_POST["senha"] ?? "";

            if (empty($email) || empty($senha)) {
                $mensagem = "Preencha todos os campos!";
            } else {

                $resultado = $this->api->login($email, $senha);

                if (isset($resultado["token"])) {
                    $_SESSION["token"] = $resultado["token"];
                    header("Location: index.php?page=dashboard");
                    exit();
                } else {
                    $mensagem = $resultado["mensagem"] ?? "Erro ao fazer login";
                }
            }
        }

        require "views/login.php";
    }

    public function dashboard() {

        if (!isset($_SESSION["token"])) {
            header("Location: index.php?page=login");
            exit();
        }

        $token = $_SESSION["token"];

        $maes = $this->api->listarMaes($token);

        require "views/dashboard.php";
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?page=login");
        exit();
    }
}
