<?php
//CREATE
function inserir($con,$dados){
    $stmt = $con->prepare(
        "INSERT INTO CURTIDAS (id_usuario, id_publicacao)
            VALUES (?,?)"
    );
    $stmt -> execute([  $dados["id_usuario"],
                        $dados["id_punlicacao"]]);
    return $con->lastInsertId();                                 
}
//READ
function listar($con){
    $stmt = $con -> query("SELECT * FROM CURTIDAS");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//UPDATE
function atualizar($con, $id, $dados){
    $stmt = $con->prepare(
        "UPDATE curtidas SET id_usuario = ?
            WHERE id_curtida =?"
    );
    $stmt -> execute([  $dados["id_usuario"],
                        $id]);
}
//DELETE
function remover($con, $id){
    $stmt = $con->prepare(
        "DELETE FROM curtidas WHERE id_curtida = ?"
    );
    $stmt -> execute([$id]);
}