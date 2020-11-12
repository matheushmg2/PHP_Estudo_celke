<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmApagarSituacao{

    private $Resultado;
    private $DadosId;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarSituacao($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $apagarSituacao = new \App\adm\Models\helper\AdmDelete();
        $apagarSituacao->exeDelete("adm_situacoes", "WHERE id =:id", "id={$this->DadosId}");
        if ($apagarSituacao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação apagada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A situação não foi apagada!</div>";
            $this->Resultado = false;
        }
    }

}