<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerPagina
{

    private $Dados;
    private $DadosId;

    public function verPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)){
            $verPagina = new \App\adm\Models\AdmVerPagina();
            $this->Dados['pagina'] = $verPagina->verPagina($this->DadosId);

            $botao = [
                'ListarPagina' => ['menu_controller' => 'Pagina', 'menu_metodo' => 'listar'],
                'EditarPagina' => ['menu_controller' => 'editarUsuario', 'menu_metodo' => 'editarUsuario'],
                'ApagarPagina' => ['menu_controller' => 'apagarUsuario', 'menu_metodo' => 'apagarUsuario']
            ];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);
            
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adm/Views/Pagina/verPagina", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Página não encotrada!</div>";
            $UrlDestino = URLADM . "Pagina/listar";
            header("Location: $UrlDestino");
        }
        
    }

}
