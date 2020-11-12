<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarUsuario
{

    private $DadosId;

    public function apagarUsuario($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $apagarUsuario = new \App\adm\Models\AdmApagarUsuario();
            $apagarUsuario->apagarUsuario($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger text-center'><i class='fas fa-exclamation-triangle'></i>  Selecione o Usuário para ser deletado..</div>";
        }
        $UrlDestino = URLADM . "usuarios/listar";
        header("Location: $UrlDestino");
    }

}
