<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmVerGrupoPagina {

    private $Resultado;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verGrupoPagina($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verGrupoPagina->fullRead("SELECT * FROM adm_grupos_paginas WHERE id=:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verGrupoPagina->getResultado();
        return $this->Resultado;
    }

}