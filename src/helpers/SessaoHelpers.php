<?php

final class SessaoHelpers {

    public static function criarSessao(array $arrayDadosParaSessao)
    {
        session_start();
        
        foreach( $arrayDadosParaSessao as $chaveSessao => $valorSessao ) {

            if( $chaveSessao != "senha" ) {
                $_SESSION[$chaveSessao] = $valorSessao;
            }

        }
    }

    public static function destruirSessao()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
    }

}