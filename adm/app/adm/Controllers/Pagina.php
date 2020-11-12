<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Pagina
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'CadastrarPagina' => ['menu_controller' => 'cadastrarPaginas', 'menu_metodo' => 'cadastrarPaginas'],
            'VisualizarPagina' => ['menu_controller' => 'verPagina', 'menu_metodo' => 'verPagina'],
            'EditarPagina' => ['menu_controller' => 'editarPagina', 'menu_metodo' => 'editarPagina'],
            'ApagarPagina' => ['menu_controller' => 'apagarPagina', 'menu_metodo' => 'apagarPagina']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarPagina = new \App\adm\Models\AdmListarPagina();
        $this->Dados['listarPagina'] = $listarPagina->listarPagina($this->PageId);
        $this->Dados['paginação'] = $listarPagina->getResultadoPg();

        $carregarView = new \Core\ConfigView("adm/Views/Pagina/listarPagina", $this->Dados);
        $carregarView->renderizar();
    }

}
