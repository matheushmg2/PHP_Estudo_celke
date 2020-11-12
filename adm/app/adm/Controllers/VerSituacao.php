<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerSituacao
{

    private $Dados;
    private $DadosId;

    public function verSituacao($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)){
            $verSituacao = new \App\adm\Models\AdmVerSituacao();
            $this->Dados['Situacao'] = $verSituacao->verSituacao($this->DadosId);

            $botao = [
                'ListarSituacao' => ['menu_controller' => 'Situacao', 'menu_metodo' => 'listar'],
                'EditarSituacao' => ['menu_controller' => 'EditarSituacao', 'menu_metodo' => 'editarSituacao'],
                'ApagarSituacao' => ['menu_controller' => 'ApagarSituacao', 'menu_metodo' => 'apagarSituacao']
            ];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);
            
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adm/Views/Situacao/verSituacao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não encontrado!</div>";
            $UrlDestino = URLADM . "Situacao/listar";
            header("Location: $UrlDestino");
        }
        
    }

}
