<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AlterarOrdemNivelAcesso
{

    private $DadosId;

    public function alterarOrdemNivelAcesso($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)){
            $alterarOrdemNivelAcesso = new \App\adm\Models\AdmAlterarOrdemNivelAcesso();
            $alterarOrdemNivelAcesso->alterarOrdemNivelAcesso($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um nível de acesso!</div>";
        }
        $UrlDestino = URLADM . "NivelAcesso/listar";
        header("Location: $UrlDestino");
    }
    
}
