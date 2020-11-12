<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AterarSenha
{

    private $Dados;

    public function editarSenha()
    {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['AlterarSenha'])) {
            unset($this->Dados['AlterarSenha']);
            $alterarSenha = new \App\adm\Models\AdmAlterarSenha();
            $alterarSenha->editarSenha($this->Dados);
            if ($alterarSenha->getResultado()) {
                $UrlDestino = URLADM . 'VerPerfil/perfil';
                header("Location: $UrlDestino");
            } else {
                $this->PerfilViewPriv();
            }
        } else {
            $this->PerfilViewPriv();
        }
        
    }

    private function PerfilViewPriv(){
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $botao = ['VerPerfil' => ['menu_controller' => 'VerPerfil', 'menu_metodo' => 'perfil']];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $carregarView = new \Core\ConfigView("adm/Views/Usuario/alterarSenha", $this->Dados);
        $carregarView->renderizar();
    }
}
