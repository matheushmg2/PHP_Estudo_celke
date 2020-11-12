<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerNivelAcesso
{

    private $Dados;
    private $DadosId;

    public function verNivelAcesso($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)) {
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = [
                'ListarNivelAcesso' => ['menu_controller' => 'nivelAcesso', 'menu_metodo' => 'listar'],
                'EditarNivelAcesso' => ['menu_controller' => 'editarNivelAcesso', 'menu_metodo' => 'editarNivelAcesso'],
                'ApagarNivelAcesso' => ['menu_controller' => 'apagarUsuario', 'menu_metodo' => 'apagarUsuario']
            ];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $verNivelAcesso = new \App\adm\Models\AdmVerNivelAcesso();
            $this->Dados['verNivelAcesso'] = $verNivelAcesso->verNivelAcesso($this->DadosId);

            $carregarView = new \Core\ConfigView("adm/Views/NivelAcesso/verNivelAcesso", $this->Dados);
            $carregarView->renderizar();
        } else {
            //$this->alertas('Generica', 'danger', 'danger', 'Usuário não encontrado');
            //$this->alertas('JS', 'success', null, 'Usuário não encontrado', 5000);
            $_SESSION['msg'] = "<div class='alert alert-warning'>Usuário não encotrado!</div>";
            $UrlDestino = URLADM . "NivelAcesso/listar";
            header("Location: $UrlDestino");
        }
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
