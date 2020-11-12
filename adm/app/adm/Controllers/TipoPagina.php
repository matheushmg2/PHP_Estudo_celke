<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class TipoPagina
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'CadastrarTipoPagina' => ['menu_controller' => 'CadastrarTipoPagina', 'menu_metodo' => 'cadastrarTipoPagina'],
            'VerTipoPagina' => ['menu_controller' => 'VerTipoPagina', 'menu_metodo' => 'verTipoPagina'],
            'EditarTipoPagina' => ['menu_controller' => 'EditarTipoPagina', 'menu_metodo' => 'editarTipoPagina'],
            'ApagarTipoPagina' => ['menu_controller' => 'ApagarTipoPagina', 'menu_metodo' => 'apagarTipoPagina'],
            'OrdemTipoPagina' => ['menu_controller' => 'alterarOrdemTipoPagina', 'menu_metodo' => 'alterarOrdemTipoPagina']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarTipoPagina = new \App\adm\Models\AdmListarTipoPagina();
        $this->Dados['listarTipoPagina'] = $listarTipoPagina->listarTipoPagina($this->PageId);
        $this->Dados['paginação'] = $listarTipoPagina->getResultadoPg();

        $carregarView = new \Core\ConfigView("adm/Views/TipoPagina/listarTipoPagina", $this->Dados);
        $carregarView->renderizar();
    }

}
