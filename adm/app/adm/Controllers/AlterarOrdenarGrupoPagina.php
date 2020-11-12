<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AlterarOrdenarGrupoPagina
{

    private $DadosId;

    public function AlterarOrdenarGrupoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        if(!empty($this->DadosId)){
            $alterarOrdemGrupoPagina = new \App\adm\Models\AdmAlterarOrdemGrupoPagina();
            $alterarOrdemGrupoPagina->alterarGrupoPagina($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Necessário selecionar um item de menu!</div>";
        }
        $UrlDestino = URLADM . "GrupoPagina/listar";
        header("Location: $UrlDestino");
    }

}
