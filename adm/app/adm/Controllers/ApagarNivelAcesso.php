<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarNivelAcesso
{

    private $DadosId;

    public function apagarNivelAcesso($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)) {
            $apagarNivelAcesso = new \App\adm\Models\AdmApagarNivelAcesso();
            $apagarNivelAcesso->apagarNivelAcesso($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Usuário não encotrado!</div>";
        }
        $UrlDestino = URLADM . "NivelAcesso/listar";
        header("Location: $UrlDestino");
    }

    /**
     * alertaSessaoJS(ICONES['success', 'error', 'warning', 'info'], TÍTULO, MENSAGEM)
     * 
     * alertaSessaoGenerica(ICONES['success', 'danger', 'warning', 'info'], TIPO DO ALERTA['success', 'danger', 'warning', 'info'], MENSAGEM)
     */
    private function alertas($qlAlerta, $icon, $escolha, $msg, $tempo = null){
        $alerta = new \App\adm\Models\helper\AdmAlertaSessao();
        switch($qlAlerta){
            case 'JS':
                $alerta->alertaSessaoJS($icon, $escolha, $msg, $tempo);
            break;
            case 'Generica':
                $alerta->alertaSessaoGenerica($icon, $escolha, $msg);
            break;
        }
    }

}
