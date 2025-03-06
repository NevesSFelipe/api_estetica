<?php

final class SegurancaHelpers {

    public static function validarEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new InvalidArgumentException('O e-mail fornecido não é válido. Por favor, verifique e tente novamente.');
        return $email;
    }

    public static function criptografarSenha($senhaSemCriptografia)
    {
        $senhaCriptografada = password_hash($senhaSemCriptografia, PASSWORD_ARGON2ID);
        if (!$senhaCriptografada) throw new InvalidArgumentException('Ocorreu um erro ao processar sua solicitação. Tente novamente mais tarde.');

        return $senhaCriptografada ;
    }
    

}