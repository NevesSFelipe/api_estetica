<?php

require_once 'src/model/Conexoes/ConexaoMySQL.php';

class FuncionariosModel {

    private string $nome;
    private string $email;
    private string $senha;
    private string $cargo;
    private string $permissoes;

    private ConexaoMySQL $conexaoMySQL;

    private string $tabelaFuncionarios = "funcionarios";

    public function __construct()
    {
        $this->conexaoMySQL = new ConexaoMySQL;
    }

    public function autenticarFuncionario($email, $senha)
    {
        $sql = "SELECT * FROM $this->tabelaFuncionarios WHERE email = ? AND ativo = 1";
        $stmt = $this->conexaoMySQL->pdoMySQL->prepare($sql);
        $stmt->execute([$email]);
        
        $funcionarioEncontado = $stmt->fetch(PDO::FETCH_ASSOC);

        if( $funcionarioEncontado === false ) { return array("status" => false, "dadosFuncionario" => array()); }
        if ( password_verify($senha, $funcionarioEncontado['senha']) === false ) { return array("status" => false, "dadosFuncionario" => array()); }

        return array("status" => true, "dadosFuncionario" => $funcionarioEncontado);

    }

}