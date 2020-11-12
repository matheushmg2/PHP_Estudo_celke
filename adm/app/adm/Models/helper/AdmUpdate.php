<?php

namespace App\adm\Models\helper;

use Exception;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmUpdate extends AdmConexao{

    private $Tabela;
    private $Dados;
    private $Query;
    private $Conn;
    private $Resultado;
    private $Termos;
    private $Values;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function exeUpdate($Tabela, array $Dados, $Termos = null, $ParseString = null){
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Values);
        $this->getInstrucao();
        $this->executarInstrucao();
    }

    private function getInstrucao(){
        foreach($this->Dados as $key => $Value){
            $Values[] = $key . '= :' . $key;
        }
        $Values = implode(', ', $Values);

        $this->Query = "UPDATE {$this->Tabela} SET {$Values} {$this->Termos}";
    }
    private function executarInstrucao(){
        $this->conexao();
        try {
            $this->Query->execute(array_merge($this->Dados, $this->Values));
            $this->Resultado = true;
        } catch (Exception $th) {
            $this->Resultado = false;
        }
    }

    private function conexao()
    {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query);
    }
}