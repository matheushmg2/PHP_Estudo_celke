<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ApagarPagina
{

    private $DadosId;

    public function apagarPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $apagarPagina = new \App\adm\Models\AdmApagarPagina();
            $apagarPagina->apagarPagina($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger text-center'><i class='fas fa-exclamation-triangle'></i>  Selecione a Página para ser deletada..</div>";
        }
        $UrlDestino = URLADM . "Pagina/listar";
        header("Location: $UrlDestino");
    }

}
