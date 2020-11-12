<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Usuarios
{

    private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'CadastrarUsuario' => ['menu_controller' => 'cadastrarUsuario', 'menu_metodo' => 'cadastrarUsuario'],
            'VisualizarUsuario' => ['menu_controller' => 'VerUsuario', 'menu_metodo' => 'verUsuario'],
            'EditarUsuario' => ['menu_controller' => 'editarUsuario', 'menu_metodo' => 'editarUsuario'],
            'ApagarUsuario' => ['menu_controller' => 'apagarUsuario', 'menu_metodo' => 'apagarUsuario']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarUsuario = new \App\adm\Models\AdmListarUsuario();
        $this->Dados['listarUsuario'] = $listarUsuario->listarUsuarios($this->PageId);
        $this->Dados['paginação'] = $listarUsuario->getResultadoPg();

        $carregarView = new \Core\ConfigView("adm/Views/Usuario/listarUsuario", $this->Dados);
        $carregarView->renderizar();
    }

}
