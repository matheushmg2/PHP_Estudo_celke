<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AlterarOrdemTipoPagina
{

    private $DadosId;

    public function alterarOrdemTipoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        if(!empty($this->DadosId)){
            $alterarOrdemTipoPagina = new \App\adm\Models\AdmAlterarOrdemTipoPagina();
            $alterarOrdemTipoPagina->alterarTipoPagina($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de página!</div>";
        }
        $UrlDestino = URLADM . "TipoPagina/listar";
        header("Location: $UrlDestino");
    }

}
