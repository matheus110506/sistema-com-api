<?php
session_start();

require_once "controllers/AuthController.php";
require_once "controllers/MaeController.php";

$page = $_GET["page"] ?? "login";

switch ($page) {

    case "login":
        (new AuthController())->login();
        break;

    case "logout":
        (new AuthController())->logout();
        break;

    case "dashboard":
        (new MaeController())->index();
        break;

    case "mae_create":
        (new MaeController())->create();
        break;

    case "mae_store":
        (new MaeController())->store();
        break;

    case "mae_edit":
        (new MaeController())->edit();
        break;

    case "mae_update":
        (new MaeController())->update();
        break;

    case "mae_delete":
        (new MaeController())->delete();
        break;

    default:
        (new AuthController())->login();
}
