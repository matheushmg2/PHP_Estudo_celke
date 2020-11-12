<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Situacao
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'CadastrarSituacao' => ['menu_controller' => 'CadastrarSituacao', 'menu_metodo' => 'cadastrarSituacao'],
            'VerSituacao' => ['menu_controller' => 'VerSituacao', 'menu_metodo' => 'verSituacao'],
            'EditarSituacao' => ['menu_controller' => 'EditarSituacao', 'menu_metodo' => 'editarSituacao'],
            'ApagarSituacao' => ['menu_controller' => 'ApagarSituacao', 'menu_metodo' => 'apagarSituacao']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarPagina = new \App\adm\Models\AdmListarSituacao();
        $this->Dados['listarSituacao'] = $listarPagina->listarSituacao($this->PageId);
        $this->Dados['paginação'] = $listarPagina->getResultadoPg();

        $carregarView = new \Core\ConfigView("adm/Views/Situacao/listarSituacao", $this->Dados);
        $carregarView->renderizar();
    }

}
