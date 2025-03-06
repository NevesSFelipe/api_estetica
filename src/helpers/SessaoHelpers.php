<?php

final class SessaoHelpers {

    public static function criarSessao(array $arrayDadosParaSessao)
    {
        session_start();
        
        foreach( $arrayDadosParaSessao as $chaveSessao => $valorSessao ) {

            $_SESSION[$chaveSessao] = $valorSessao;    

        }
    }    

}