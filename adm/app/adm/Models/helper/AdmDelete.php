<?php

namespace App\adm\Models\helper;

use Exception;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmDelete extends AdmConexao
{

    private $Tabela;
    private $Query;
    private $Conn;
    private $Termos;
    private $Values;
    private $Resultado;

    /**
     * Get the value of Resultado
     */ 
    public function getResultado()
    {
        return $this->Resultado;
    }

    public function exeDelete($Tabela, $Termos = null, $ParseString = null){
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Values);
        $this->executarInstrucao();
    }

    private function executarInstrucao(){
        $this->Query = "DELETE FROM {$this->Tabela} {$this->Termos}";
        $this->conexao();
        try {
            //$this->Query->execute($this->Values);
            $this->Query->execute($this->Values);
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