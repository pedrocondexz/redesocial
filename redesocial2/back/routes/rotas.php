<?php
require_once __DIR__ . "/../controllers/UsuarioController.php";
require_once __DIR__ . "/../controllers/PostagemController.php";
require_once __DIR__ . "/../controllers/CurtidaController.php";

$rota = $_GET["rota"] ?? "";
$metodo = $_SERVER["REQUEST_METHOD"];

if ($rota === "usuario"){
    switch($metodo){
        case "POST":
            createUsuario($con);
            break;
        case "GET":
            readUsuario($con);
            break;
        case "PUT":
            updateUsuario($con);
            break;
        case "DELETE":
            deleteUsuario($con);
            break;
        default:
            teste();

    }
}
else if ($rota === "postagens") {
    switch($metodo){
        case "POST":
            createPostagem($con, $corpo);
            break;
        case "GET":
            readPostagem($con);
            break;
        case "PUT":
            updatePostagem($con, $_GET["id"], $corpo);
            break;
        case "DELETE":
            deletePostagem($con, $_GET["id"]);
            break;
        default:
            teste();
    }
}
else if ($rota === "curtidas") {
    switch($metodo){
        case "POST":
            createCurtida($con, $corpo);
            break;
        case "GET":
            readCurtida($con);
            break;
        case "PUT":
            updateCurtida($con, $_GET["id"], $corpo);
            break;
        case "DELETE":
            deleteCutida($con, $_GET["id"]);
            break;
        default:
            teste();
    }
}
?>