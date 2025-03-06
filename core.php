<?php

$dados = recuperDadosRequest();

require_once 'src/controller/FuncionariosController.php';
$funcionariosController = new FuncionariosController();

header('Content-Type: application/json; charset=utf-8');

if( $dados['acaoAjax'] === "acessarSistema" ) return $funcionariosController->acessarSistema($dados['email'], $dados['senha']);

function recuperDadosRequest() {

    if( $_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'POST' ) {

        $json = file_get_contents('php://input');
        $dados = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {

            http_response_code(400);
            echo json_encode(["error" => "Erro ao processar os dados JSON."]);
            exit;

        }

        return $dados;

    }

    return $_REQUEST;

}