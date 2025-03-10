<?php

$dados = recuperDadosRequest();

validarAcaoAjax($dados['acaoAjax']);
validarSistema($dados['sistema']);

require_once 'src/controller/FuncionariosController.php';
$funcionariosController = new FuncionariosController($dados['sistema']);

header('Content-Type: application/json; charset=utf-8');

switch( $dados['acaoAjax'] ) {

    case 'funcionarioAcessarSistema':
        return $funcionariosController->acessarSistema($dados['email'], $dados['senha']);
    break;

    case 'funcionarioSairSistema':
        return $funcionariosController->sairSistema();
    break;

    default:
        
        print_r(json_encode(array('status' => false, 'msg' => 'Por favor, informe uma ação válida para executar na API.'), JSON_UNESCAPED_UNICODE ));

    break;
        

}

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

function validarAcaoAjax($acaoAjax) {

    if( !isset($acaoAjax) ) {

        print_r(
            json_encode(
                array('status' => false, 'msg' => 'Por favor, informe uma ação para executar na API.'), JSON_UNESCAPED_UNICODE 
            )
        );
    
        die();
    
    }

}

function validarSistema($sistema) {

    if( !isset($sistema) || empty($sistema) ) {

        print_r(
            json_encode(
                array('status' => false, 'msg' => 'Por favor, informe um sistema válido.'), JSON_UNESCAPED_UNICODE 
            )
        );
    
        die();
    
    }
}