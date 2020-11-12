<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Confirmar{

    private $DadosChave;

    public function confirmarEmail(){
        $this->DadosChave = filter_input(INPUT_GET, 'chave', FILTER_SANITIZE_STRING);
        if(!empty($this->DadosChave)){
            $confEmail = new \App\adm\Models\AdmConfirmarEmail();
            $confEmail->confirmarEmail($this->DadosChave);
            if(!empty($confEmail->getResultado())){
                $UrlDestino = URLADM . 'login/acesso';
                header("Location: $UrlDestino");
            } else {
                $UrlDestino = URLADM . 'login/acesso';
                header("Location: $UrlDestino");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Confirmação inválida!</div>";
            $UrlDestino = URLADM . 'login/acesso';
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