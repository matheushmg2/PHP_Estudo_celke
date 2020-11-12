<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerUsuario
{

    private $Dados;
    private $DadosId;

    public function verUsuario($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)) {
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = [
                'ListarUsuario' => ['menu_controller' => 'usuarios', 'menu_metodo' => 'listar'],
                'EditarUsuario' => ['menu_controller' => 'editarUsuario', 'menu_metodo' => 'editarUsuario'],
                'EditarSenha' => ['menu_controller' => 'EditarSenha', 'menu_metodo' => 'editarSenha'],
                'ApagarUsuario' => ['menu_controller' => 'apagarUsuario', 'menu_metodo' => 'apagarUsuario']
            ];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $verUsuario = new \App\adm\Models\AdmVerUsuario();
            $this->Dados['usuario'] = $verUsuario->verUsuario($this->DadosId);

            $carregarView = new \Core\ConfigView("adm/Views/Usuario/verUsuario", $this->Dados);
            $carregarView->renderizar();
        } else {
            //$this->alertas('Generica', 'danger', 'danger', 'Usuário não encontrado');
            //$this->alertas('JS', 'success', null, 'Usuário não encontrado', 5000);
            $_SESSION['msg'] = "<div class='alert alert-warning'>Usuário não encotrado!</div>";
            $UrlDestino = URLADM . "usuarios/listar";
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
