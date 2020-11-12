<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmApagarCores{

    private $Resultado;
    private $DadosId;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarCores($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $apagarCores = new \App\adm\Models\helper\AdmDelete();
        $apagarCores->exeDelete("adm_cores", "WHERE id =:id", "id={$this->DadosId}");
        if ($apagarCores->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Cor apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A cor não foi apagada!</div>";
            $this->Resultado = false;
        }
    }

}