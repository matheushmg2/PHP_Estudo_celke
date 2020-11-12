<?php

namespace App\cpadm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VisualizarUsuarioModal
{

    private $Dados;
    private $DadosId;

    public function visualizarUsuarioModal($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)) {
            $verUsuario = new \App\adm\Models\AdmVerUsuario();
            $this->Dados['usuario'] = $verUsuario->verUsuario($this->DadosId);
            //var_dump($this->Dados['usuario']);
            $carregarView = new \Core\ConfigView("cpadm/Views/Usuarios/verUsuarioModal", $this->Dados);
            $carregarView->renderizarComplementoAdmListar();
        }
        

    }

}

