<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class LiberarDropdown
{

    private $DadosId;
    private $PageId;
    private $NivelAcessoId;

    public function liberarDropdown($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->NivelAcessoId = filter_input(INPUT_GET,"niv", FILTER_SANITIZE_NUMBER_INT);
        $this->PageId = filter_input(INPUT_GET,"pg", FILTER_SANITIZE_NUMBER_INT);

        if(!empty($this->DadosId) AND ! empty($this->NivelAcessoId) AND ! empty($this->PageId)){
            $liberarPermissao = new \App\adm\Models\AdmLiberarDropdown();
            $liberarPermissao->liberarDropdown($this->DadosId);
            $UrlDestino = URLADM . "Permissoes/listar/{$this->PageId}?niv={$this->NivelAcessoId}";
            header("Location: $UrlDestino");
        } else {
            $UrlDestino = URLADM . "NivelAcesso/listar";
            header("Location: $UrlDestino");
        }
    }

}
