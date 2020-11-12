<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarGrupoPagina
{

    private $DadosId;

    public function apagarGrupoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        if(!empty($this->DadosId)){
            $apagarGrupoPagina = new \App\adm\Models\AdmApagarGrupoPagina();
            $apagarGrupoPagina->apagarGrupoPagina($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um grupo de página!</div>";
        }
        $UrlDestino = URLADM . "GrupoPagina/listar";
        header("Location: $UrlDestino");
    }

}
