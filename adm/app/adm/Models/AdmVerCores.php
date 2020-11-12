<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmVerCores {

    private $Resultado;
    private $DadosId;

    public function verCores($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verCores = new \App\adm\Models\helper\AdmLeitura();
        $verCores->fullRead("SELECT * FROM adm_cores WHERE id =:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verCores->getResultado();
        return $this->Resultado;
    }

}