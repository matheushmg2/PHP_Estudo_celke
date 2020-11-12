<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class NivelAcesso
{
    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $botao = [
            'CadastrarNivelAcesso' => ['menu_controller' => 'cadastrarNivelAcesso', 'menu_metodo' => 'cadastrarNivelAcesso'],
            'VisualizarNivelAcesso' => ['menu_controller' => 'verNivelAcesso', 'menu_metodo' => 'verNivelAcesso'],
            'EditarNivelAcesso' => ['menu_controller' => 'editarNivelAcesso', 'menu_metodo' => 'editarNivelAcesso'],
            'ApagarNivelAcesso' => ['menu_controller' => 'apagarUsuario', 'menu_metodo' => 'apagarUsuario'],
            'OrdemNivelAcesso' => ['menu_controller' => 'alterarOrdemNivelAcesso', 'menu_metodo' => 'alterarOrdemNivelAcesso'],
            'Permissoes' => ['menu_controller' => 'Permissoes', 'menu_metodo' => 'listar'],
            'Sincronizar' => ['menu_controller' => 'sincronizarNivelAcessoPagina', 'menu_metodo' => 'sincronizarNivelAcessoPagina']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarNivelAcesso = new \App\adm\Models\AdmListarNivelAcesso();
        $this->Dados['listarNivelAcesso'] = $listarNivelAcesso->listarNivelAcesso($this->PageId);
        $this->Dados['paginação'] = $listarNivelAcesso->getResultadoPg();

        $carregarView = new \Core\ConfigView("adm/Views/NivelAcesso/listarNivelAcesso", $this->Dados);
        $carregarView->renderizar();
    }

    /**
     * alertaSessaoJS(ICONES['success', 'error', 'warning', 'info'], TÍTULO, MENSAGEM)
     * 
     * alertaSessaoGenerica(ICONES['success', 'danger', 'warning', 'info'], TIPO DO ALERTA['success', 'danger', 'warning', 'info'], MENSAGEM)
     */
    private function alertas($qlAlerta, $icon, $escolha, $msg, $tempo = null){
        $alerta = new \App\adm\Models\helper\AdmAlertaSessao();
        switch($qlAlerta){
            case 'JS':
                $alerta->alertaSessaoJS($icon, $escolha, $msg, $tempo);
            break;
            case 'Generica':
                $alerta->alertaSessaoGenerica($icon, $escolha, $msg);
            break;
        }
    }

}
