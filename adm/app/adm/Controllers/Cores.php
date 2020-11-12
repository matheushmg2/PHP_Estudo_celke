<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Cores
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'CadastrarCores' => ['menu_controller' => 'CadastrarCores', 'menu_metodo' => 'cadastrarCores'],
            'VisualizarCores' => ['menu_controller' => 'VerCores', 'menu_metodo' => 'verCores'],
            'EditarCores' => ['menu_controller' => 'EditarCores', 'menu_metodo' => 'EditarCores'],
            'ApagarCores' => ['menu_controller' => 'ApagarCores', 'menu_metodo' => 'ApagarCores']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarCores = new \App\adm\Models\AdmListarCores();
        $this->Dados['listarCores'] = $listarCores->listarCores($this->PageId);
        $this->Dados['paginação'] = $listarCores->getResultadoPg();

        $carregarView = new \Core\ConfigView("adm/Views/Cores/listarCores", $this->Dados);
        $carregarView->renderizar();
    }

}
