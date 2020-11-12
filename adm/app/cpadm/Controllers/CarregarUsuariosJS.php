<?php

namespace App\cpadm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CarregarUsuariosJS
{

    private $Dados;
    private $PageId;
    private $TipoResultado;
    private $PesquisarUsuario;

    public function listar($PageId = null)
    {
        $this->TipoResultado = filter_input(INPUT_GET, 'tiporesultado');
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = [
            'CadastrarUsuario' => ['menu_controller' => 'cadastrarUsuario', 'menu_metodo' => 'cadastrarUsuario'],
            'CadastrarUsuarioModal' => ['menu_controller' => 'cadastrarUsuarioModal', 'menu_metodo' => 'cadastrarUsuarioModal'],
            'VisualizarUsuario' => ['menu_controller' => 'VisualizarUsuarioModal', 'menu_metodo' => 'visualizarUsuarioModal'],
            'EditarUsuario' => ['menu_controller' => 'editarUsuario', 'menu_metodo' => 'editarUsuario'],
            'ApagarUsuario' => ['menu_controller' => 'apagarUsuario', 'menu_metodo' => 'apagarUsuario']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        if(!empty($this->TipoResultado) AND ($this->TipoResultado == 1)){
            $this->listarUsuariosPrivado();
        } else if(!empty($this->TipoResultado) AND ($this->TipoResultado == 2)){
            $this->PesquisarUsuario = filter_input(INPUT_POST, 'palavrasPesquisarUsuario');
            // echo $this->PesquisarUsuario;
            $this->listarPesquisaUsuariosPrivado();
        }else {
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("cpadm/Views/Usuarios/carregarUsuarioJS", $this->Dados);
            $carregarView->renderizarComplementoAdm();
        }
    }

    private function listarUsuariosPrivado()
    {
        $listarUsuario = new \App\cpadm\Models\CpAdmListarUsuario();
        $this->Dados['listarUsuario'] = $listarUsuario->listarUsuarios($this->PageId);
        $this->Dados['paginação'] = $listarUsuario->getResultadoPg();

        $carregarView = new \Core\ConfigView("cpadm/Views/Usuarios/listarUsuarioJS", $this->Dados);
        $carregarView->renderizarComplementoAdmListar();
    }

    private function listarPesquisaUsuariosPrivado()
    {
        $listarUsuario = new \App\cpadm\Models\CpAdmPesquisarUsuario();
        $this->Dados['listarUsuario'] = $listarUsuario->PesquisaUsuarios($this->PesquisarUsuario);
        $this->Dados['paginação'] = $listarUsuario->getResultadoPg();

        $carregarView = new \Core\ConfigView("cpadm/Views/Usuarios/listarUsuarioJS", $this->Dados);
        $carregarView->renderizarComplementoAdmListar();
    }

}

