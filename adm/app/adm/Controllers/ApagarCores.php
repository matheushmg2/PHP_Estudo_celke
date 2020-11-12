<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarCores
{

    private $DadosId;

    public function apagarCores($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        if(!empty($this->DadosId)){
            $alterarOrdemMenu = new \App\adm\Models\AdmApagarCores();
            $alterarOrdemMenu->apagarCores($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma cor!</div>";
        }
        $UrlDestino = URLADM . "Cores/listar";
        header("Location: $UrlDestino");
    }

}
