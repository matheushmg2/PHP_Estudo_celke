<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Login
{

    private $Dados;

    public function acesso()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Trazer todos os campos para um ARRAY atribuindo em uma string
        //var_dump($this->Dados);
        if(!empty($this->Dados['SendLogin'])){
            unset($this->Dados['SendLogin']);
            $visualizarLogin = new \App\adm\Models\AdmLogin();
            $visualizarLogin->acesso($this->Dados);
            $this->Dados['form'] = $this->Dados; // Enviando/Deixando/Guardando os conteudo no input
            if($visualizarLogin->getResultado()){
                $UrlDestino = URLADM . "home/index";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
            }
        }
        //SendLogin
        $carregarView = new \Core\ConfigView("adm/Views/Login/acesso", $this->Dados);
        $carregarView->renderizarLogin();
    }

    public function logout()
    {
        unset($_SESSION['usuario_id'] ,
            $_SESSION['usuario_nome'] ,
            $_SESSION['usuario_user'] ,
            $_SESSION['usuario_image'] ,
            $_SESSION['adm_niveis_acessos_id'],
            $_SESSION['ordem_nivel']);
            //$_SESSION['msg'] = "<div class='alert alert-success'>Usuário Deslogado</div>";
            //$alerta = new \App\adm\Models\helper\AdmAlertaSessao();
            $this->alertas('Generica', 'success', 'success', 'Usuário deslogado');
            $UrlDestino = URLADM . "login/acesso";
            header("Location: $UrlDestino");
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
