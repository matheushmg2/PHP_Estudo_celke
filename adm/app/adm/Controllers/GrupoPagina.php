<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class GrupoPagina
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'OrdenarGrupoPagina' => ['menu_controller' => 'AlterarOrdenarGrupoPagina', 'menu_metodo' => 'alterarOrdenarGrupoPagina'],
            'CadastrarGrupoPagina' => ['menu_controller' => 'CadastrarGrupoPagina', 'menu_metodo' => 'cadastrarGrupoPagina'],
            'VerGrupoPagina' => ['menu_controller' => 'VerGrupoPagina', 'menu_metodo' => 'verGrupoPagina'],
            'EditarGrupoPagina' => ['menu_controller' => 'EditarGrupoPagina', 'menu_metodo' => 'editarGrupoPagina'],
            'ApagarGrupoPagina' => ['menu_controller' => 'ApagarGrupoPagina', 'menu_metodo' => 'apagarGrupoPagina']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarGrupoPagina = new \App\adm\Models\AdmListarGrupoPagina();
        $this->Dados['listarGrupoPagina'] = $listarGrupoPagina->listarGrupoPagina($this->PageId);
        $this->Dados['paginação'] = $listarGrupoPagina->getResultadoPg();

        $carregarView = new \Core\ConfigView("adm/Views/GrupoPagina/listarGrupoPagina", $this->Dados);
        $carregarView->renderizar();
    }

}
