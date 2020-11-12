<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EsqueceuSenha{

    private $Dados;

    public function esqueceuSenha()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->Dados['RecupUserLogin'])){
            $esqSenha = new \App\adm\Models\AdmEsqueceuSenha();
            $esqSenha->esqueceuSenha($this->Dados);
            if($esqSenha->getResultado()){
                $UrlDestino = URLADM . 'login/acesso';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $carregarView = new \Core\ConfigView("adm/Views/Login/esqueceuSenha", $this->Dados);
                $carregarView->renderizarLogin();
            }
        } else {
            $carregarView = new \Core\ConfigView("adm/Views/Login/esqueceuSenha", $this->Dados);
            $carregarView->renderizarLogin();
        }
    }

}
