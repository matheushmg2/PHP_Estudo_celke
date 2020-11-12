<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmVerTipoPagina {

    private $Resultado;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verTipoPagina($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verTipoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verTipoPagina->fullRead("SELECT * FROM adm_tipos_paginas WHERE id=:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verTipoPagina->getResultado();
        return $this->Resultado;
    }

}