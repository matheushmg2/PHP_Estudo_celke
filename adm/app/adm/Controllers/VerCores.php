<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerCores
{

    private $Dados;
    private $DadosId;

    public function verCores($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)){
            $verMenu = new \App\adm\Models\AdmVerCores();
            $this->Dados['verCores'] = $verMenu->verCores($this->DadosId);

            $botao = [
                'ListarCores' => ['menu_controller' => 'Cores', 'menu_metodo' => 'listar'],
                'EditarCores' => ['menu_controller' => 'editarCores', 'menu_metodo' => 'editarCores'],
                'ApagarCores' => ['menu_controller' => 'apagarCores', 'menu_metodo' => 'apagarCores']
            ];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);
            
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adm/Views/Cores/verCores", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Cor não encontrada!</div>";
            $UrlDestino = URLADM . "Cores/listar";
            header("Location: $UrlDestino");
        }
        
    }

}
