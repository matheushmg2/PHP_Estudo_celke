<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarSituacao
{

    private $DadosId;

    public function apagarSituacao($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $apagarSituacao = new \App\adm\Models\AdmApagarSituacao();
            $apagarSituacao->apagarSituacao($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma situação!</div>";
        }
        $UrlDestino = URLADM . "Situacao/listar";
        header("Location: $UrlDestino");
    }

}
