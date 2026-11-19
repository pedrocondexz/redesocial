<?php
require_once __DIR__ . "/../models/CurtidaModel.php";

function teste(){
    echo json_encode([
        "mensagem" => "Back-end respondendo com sucesso!"
    ]);
    exit;
}
//RECEBER E VALIDAR OS DADOS
function receberDadosCurtida(){
    $dados = json_decode(
        file_get_contents("php://input"), true);
    if(!is_array($dados)){
        http_response_code(400);
        echo json_encode([
            "erro"=>"Envie um objeto JSON com dados!"
        ]);
        return null;
    }
    //id_usuario, id_publicacao -> SE EXISTE
    foreach(["id_usuario, id_publicacao"] as $campo){
        if( !isset($dados[$campo]) ||
            !is_string($dados[$campo]) ||
            trim($dados[$campo])===""){
                http_response_code(400);
                echo json_encode([
                    "erro" =>
                    "O campo $campo é obrigatório e deve ser um texto!"
                ]);
                return null;
            }
    }
    return $dados;
}
function receberIdCurtida(){
    $id = filter_var($_GET["id"] ?? null,
            FILTER_VALIDATE_INT,
            ["options" => ["min_range"=>1]]);
    if($id === false){
        http_response_code(400);
        echo json_encode([
            "erro" => "Informe um id de curtida válido"
        ]);
        return null;
    }
    return $id;
}
function createCurtida($con){
    $dados = receberDadosCurtida();
    if($dados === null){
        return;
    }
    $id = inserir($con,$dados);
    http_response_code(201);
    echo json_encode([
        "mensagem" => "Curtida criada com sucesso",
        "id" => $id
    ]);
}
function readCurtida($con){
    echo json_encode(listar($con));
}
function updateCurtida($con){
    $id = receberDadosCurtida();
    if($id ===null){
        return;
    }
    $dados = receberDadosCurtida();
    if($dados === null){
        return;
    }
    atualizar($con, $id, $dados);
    echo json_encode([
        "mensagem" => "Curtida alterada com sucesso!"
    ]);
}
function deleteCurtida($con){
    $id = receberIdCurtida();
    if($id === null){
        return;
    }
    remover($con, $id);
    echo json_encode([
        "mensagem" => "Curtida removida com sucesso!"
    ]);
}
