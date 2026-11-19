<?php
require_once __DIR__ . "/../models/PostagemModel.php";

function teste(){
    echo json_encode([
        "mensagem" => "Back-end respondendo com sucesso!"
    ]);
    exit;
}
//RECEBER E VALIDAR OS DADOS
function receberDadosPostagem(){
    $dados = json_decode(
        file_get_contents("php://input"), true);
    if(!is_array($dados)){
        http_response_code(400);
        echo json_encode([
            "erro"=>"Envie um objeto JSON com dados!"
        ]);
        return null;
    }
    //id_usuario, legenda, imagem_url -> SE EXISTE
    foreach(["id_usuario", "legenda", "imagem_url"] as $campo){
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
function receberIdPostagem(){
    $id = filter_var($_GET["id"] ?? null,
            FILTER_VALIDATE_INT,
            ["options" => ["min_range"=>1]]);
    if($id === false){
        http_response_code(400);
        echo json_encode([
            "erro" => "Informe um id de postagem válido"
        ]);
        return null;
    }
    return $id;
}
function createPostagem($con){
    $dados = receberDadosPostagem();
    if($dados === null){
        return;
    }
    $id = inserir($con,$dados);
    http_response_code(201);
    echo json_encode([
        "mensagem" => "Postagem criada com sucesso",
        "id" => $id
    ]);
}
function readPostagem($con){
    echo json_encode(listar($con));
}
function updatePostagem($con){
    $id = receberDadosPostagem();
    if($id ===null){
        return;
    }
    $dados = receberDadosPostagem();
    if($dados === null){
        return;
    }
    atualizar($con, $id, $dados);
    echo json_encode([
        "mensagem" => "Postagem alterada com sucesso!"
    ]);
}
function deletePostagem($con){
    $id = receberIdPostagem();
    if($id === null){
        return;
    }
    remover($con, $id);
    echo json_encode([
        "mensagem" => "Postagem removido com sucesso!"
    ]);
}
