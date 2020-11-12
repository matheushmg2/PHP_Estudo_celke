<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Permissoes
{

    private $Dados;
    private $PageId;
    private $NivelAcessoId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;
        $this->Dados['pg'] = $this->PageId;
        $this->NivelAcessoId = filter_input(INPUT_GET,"niv", FILTER_SANITIZE_NUMBER_INT);

        $botao = [
            'ListarNivelAcesso' => ['menu_controller' => 'nivelAcesso', 'menu_metodo' => 'listar'],
            'EditarNivelAcessoPaginaMenu' => ['menu_controller' => 'editarNivelAcessoPaginaMenu', 'menu_metodo' => 'editarNivelAcessoPaginaMenu'],
            'OrdenarPermissoes' => ['menu_controller' => 'apagarPagina', 'menu_metodo' => 'apagarPagina'],
            'LiberarPermissoes' => ['menu_controller' => 'liberarPermissoes', 'menu_metodo' => 'liberarPermissoes'],
            'LiberarMenu' => ['menu_controller' => 'liberarMenu', 'menu_metodo' => 'liberarMenu'],
            'LiberarDropdown' => ['menu_controller' => 'liberarDropdown', 'menu_metodo' => 'liberarDropdown'],
            'OrdemMenu' => ['menu_controller' => 'alterarOrdemMenu', 'menu_metodo' => 'alterarOrdemMenu']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarPermissoes = new \App\adm\Models\AdmListarPermissoes();
        $this->Dados['listarPermissoes'] = $listarPermissoes->listarPermissoes($this->PageId, $this->NivelAcessoId);
        $this->Dados['paginação'] = $listarPermissoes->getResultadoPg();
        $this->Dados['nivelAcesso'] = $listarPermissoes->verNivelAcesso($this->NivelAcessoId);
        
        $carregarView = new \Core\ConfigView("adm/Views/Permissoes/listarPermissoes", $this->Dados);
        $carregarView->renderizar();
    }

}
