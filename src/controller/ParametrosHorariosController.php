<?php

require_once 'src/model/ParametrosHorariosModel.php';

class ParametrosHorariosController {

    private ParametrosHorariosModel $parametrosHorariosModel;

    public function __construct($sistema)
    {
        $this->parametrosHorariosModel = new ParametrosHorariosModel($sistema);
    }

    public function carregarHorariosParametrizados()
    {
        
        try {
            
            $horariosParametrizados = $this->parametrosHorariosModel->carregarHorariosParametrizados();

            if( $horariosParametrizados['status'] === false ) print_r( json_encode(array('status' => false, 'msg' => 'Não foi identificado nenhum horário parametrizado.'), JSON_UNESCAPED_UNICODE ));

            print_r( json_encode(array('status' => true, 'msg' => $horariosParametrizados), JSON_UNESCAPED_UNICODE ));

            
        } catch (InvalidArgumentException $e) {
            echo 'Erro: ' . $e->getMessage();
        }

    }

    
}
