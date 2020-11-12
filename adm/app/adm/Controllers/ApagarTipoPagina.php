<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarTipoPagina
{

    private $DadosId;

    public function apagarTipoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        if(!empty($this->DadosId)){
            $apagarTipoPagina = new \App\adm\Models\AdmApagarTipoPagina();
            $apagarTipoPagina->apagarTipoPagina($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de página!</div>";
        }
        $UrlDestino = URLADM . "TipoPagina/listar";
        header("Location: $UrlDestino");
    }

}
