<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Menu
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'OrdenarItensMenu' => ['menu_controller' => 'AlterarOrdemItensMenu', 'menu_metodo' => 'alterarOrdemItensMenu'],
            'CadastrarItensMenu' => ['menu_controller' => 'CadastrarItensMenu', 'menu_metodo' => 'cadastrarItensMenu'],
            'VerMenu' => ['menu_controller' => 'VerMenu', 'menu_metodo' => 'verMenu'],
            'EditarItensMenu' => ['menu_controller' => 'editarItensMenu', 'menu_metodo' => 'editarItensMenu'],
            'ApagarMenu' => ['menu_controller' => 'ApagarItensMenu', 'menu_metodo' => 'ApagarItensMenu']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarItensMenu = new \App\adm\Models\AdmListarItensMenu();
        $this->Dados['listarItensMenu'] = $listarItensMenu->listarItensMenu($this->PageId);
        $this->Dados['paginação'] = $listarItensMenu->getResultadoPg();

        $carregarView = new \Core\ConfigView("adm/Views/Menu/listarMenu", $this->Dados);
        $carregarView->renderizar();
    }

}
