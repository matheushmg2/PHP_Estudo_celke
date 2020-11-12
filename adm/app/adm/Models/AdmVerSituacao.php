<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmVerSituacao {

    private $Resultado;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verSituacao($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verTipoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verTipoPagina->fullRead("SELECT situacao.*, cores.cor cores 
                                FROM adm_situacoes situacao 
                                INNER JOIN adm_cores cores ON cores.id = situacao.adm_cores_id
                                WHERE situacao.id=:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verTipoPagina->getResultado();
        return $this->Resultado;
    }

}