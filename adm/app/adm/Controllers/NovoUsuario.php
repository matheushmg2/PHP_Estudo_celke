<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class NovoUsuario
{

    private $Dados;

    public function novoUsuario(){
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->Dados['CadLogin'])){
            unset($this->Dados['CadLogin']);
            $cadUser = new \App\adm\Models\AdmNovoUsuario();
            $cadUser->cadUser($this->Dados);
            if($cadUser->getResultado()){
                $UrlDestino = URLADM . "login/acesso";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $carregarView = new \Core\ConfigView("adm/Views/Login/novoUsuario", $this->Dados);
                $carregarView->renderizarLogin();
            }
        } else {
            $carregarView = new \Core\ConfigView("adm/Views/Login/novoUsuario", $this->Dados);
            $carregarView->renderizarLogin();
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
