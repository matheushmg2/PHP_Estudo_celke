<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarItensMenu
{

    private $DadosId;

    public function apagarItensMenu($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        if(!empty($this->DadosId)){
            $alterarOrdemMenu = new \App\adm\Models\AdmApagarItensMenu();
            $alterarOrdemMenu->apagarItensMenu($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Necessário selecionar um item de menu!</div>";
        }
        $UrlDestino = URLADM . "Menu/listar";
        header("Location: $UrlDestino");
    }

}
