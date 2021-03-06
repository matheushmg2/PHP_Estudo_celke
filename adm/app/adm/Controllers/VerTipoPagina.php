<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerTipoPagina
{

    private $Dados;
    private $DadosId;

    public function verTipoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)){
            $verTipoPagina = new \App\adm\Models\AdmVerTipoPagina();
            $this->Dados['verTipoPagina'] = $verTipoPagina->verTipoPagina($this->DadosId);

            $botao = [
                'ListarTipoPagina' => ['menu_controller' => 'TipoPagina', 'menu_metodo' => 'listar'],
                'EditarTipoPagina' => ['menu_controller' => 'EditarTipoPagina', 'menu_metodo' => 'editarTipoPagina'],
                'ApagarTipoPagina' => ['menu_controller' => 'ApagarTipoPagina', 'menu_metodo' => 'apagarTipoPagina']
            ];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);
            
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adm/Views/TipoPagina/verTipoPagina", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Tipo de página não encontrado!</div>";
            $UrlDestino = URLADM . "TipoPagina/listar";
            header("Location: $UrlDestino");
        }
        
    }

}
