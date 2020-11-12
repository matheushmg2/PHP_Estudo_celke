<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerGrupoPagina
{

    private $Dados;
    private $DadosId;

    public function verGrupoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)){
            $verGrupoPagina = new \App\adm\Models\AdmVerGrupoPagina();
            $this->Dados['verGrupoPagina'] = $verGrupoPagina->verGrupoPagina($this->DadosId);

            $botao = [
                'ListarGrupoPagina' => ['menu_controller' => 'GrupoPagina', 'menu_metodo' => 'listar'],
                'EditarGrupoPagina' => ['menu_controller' => 'EditarGrupoPagina', 'menu_metodo' => 'editarGrupoPagina'],
                'ApagarGrupoPagina' => ['menu_controller' => 'ApagarGrupoPagina', 'menu_metodo' => 'apagarGrupoPagina']
            ];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);
            
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adm/Views/GrupoPagina/verGrupoPagina", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Cor não encontrada!</div>";
            $UrlDestino = URLADM . "Cores/listar";
            header("Location: $UrlDestino");
        }
        
    }

}
