<?php

require_once 'src/model/Conexoes/ConexaoMySQL.php';

class ParametrosHorariosModel {

    private ConexaoMySQL $conexaoMySQL;

    private string $tabelaParametrizadorHorarios = "parametrizador_horarios";

    public function __construct($sistema)
    {
        $this->conexaoMySQL = new ConexaoMySQL($sistema);
    }

    public function carregarHorariosParametrizados()
    {

        $sql = "SELECT * FROM $this->tabelaParametrizadorHorarios";
        $stmt = $this->conexaoMySQL->pdoMySQL->prepare($sql);

        if ($stmt->execute() === false) {
            return ["status" => false, "horariosParametrizados" => []];
        }

        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dados as &$row) {
            if (isset($row['horarios_parametrizados'])) {
                $row['horarios_parametrizados'] = json_decode($row['horarios_parametrizados'], true);
            }
        }

        return ["status" => true, "horariosParametrizados" => $dados];
    }

}