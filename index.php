<?php
session_start();

require_once "controllers/AuthController.php";

$controller = new AuthController();

$page = $_GET["page"] ?? "login";

switch ($page) {

    case "login":
        $controller->login();
        break;

    case "dashboard":
        $controller->dashboard();
        break;

    case "logout":
        $controller->logout();
        break;

    default:
        $controller->login();
}
