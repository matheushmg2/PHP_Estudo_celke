<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerMenu
{

    private $Dados;
    private $DadosId;

    public function verMenu($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)){
            $verMenu = new \App\adm\Models\AdmVerMenu();
            $this->Dados['itensMenu'] = $verMenu->verItensMenu($this->DadosId);

            $botao = [
                'ListarMenu' => ['menu_controller' => 'menu', 'menu_metodo' => 'listar'],
                'EditarPagina' => ['menu_controller' => 'editarUsuario', 'menu_metodo' => 'editarUsuario'],
                'ApagarPagina' => ['menu_controller' => 'apagarUsuario', 'menu_metodo' => 'apagarUsuario']
            ];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);
            
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adm/Views/Menu/verMenu", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Itens do Menu não encotrado!</div>";
            $UrlDestino = URLADM . "Menu/listar";
            header("Location: $UrlDestino");
        }
        
    }

}
