<?php

require_once 'src/helpers/SegurancaHelpers.php';
require_once 'src/helpers/SessaoHelpers.php';

require_once 'src/model/FuncionariosModel.php';

class FuncionariosController {

    private string $nome;
    private string $email;
    private string $senha;
    private string $cargo;
    private string $permissoes;

    private FuncionariosModel $funcionariosModel;

    public function __construct()
    {
        $this->funcionariosModel = new FuncionariosModel;
    }

    public function acessarSistema($email, $senha)
    {
        
        try {
            
            $this->email = SegurancaHelpers::validarEmail($email);
            $this->senha = $senha;

            $usuarioAutenticado = $this->funcionariosModel->autenticarFuncionario($this->email, $this->senha);

            if( $usuarioAutenticado['status'] === false ) print_r( json_encode(array('status' => false, 'msg' => 'Acesso negado. Por favor, verifique o email / senha.'), JSON_UNESCAPED_UNICODE ));

            SessaoHelpers::criarSessao($usuarioAutenticado['dadosFuncionario']);
            print_r( json_encode(array('status' => true, 'msg' => 'Acesso permitido. Você será redirecionado em breve.'), JSON_UNESCAPED_UNICODE ));
            
        } catch (InvalidArgumentException $e) {
            echo 'Erro: ' . $e->getMessage();
        }

    }
    
}
