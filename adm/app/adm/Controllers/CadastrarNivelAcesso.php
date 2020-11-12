<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarNivelAcesso
{

    private $Dados;

    public function cadastrarNivelAcesso()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadastrarNivelAcesso'])) {
            unset($this->Dados['CadastrarNivelAcesso']);

            $cadastrarNivelAcesso = new \App\adm\Models\AdmCadastrarNivelAcesso();
            $cadastrarNivelAcesso->cadastrarNivelAcesso($this->Dados);
            if ($cadastrarNivelAcesso->getResultado()) {
                $UrlDestino = URLADM . "NivelAcesso/listar";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadastrarUsuarioViewPriv();
            }
        } else {
            $this->cadastrarUsuarioViewPriv();
        }
    }

    private function cadastrarUsuarioViewPriv()
    {
        
        $botao = ['ListarNivelAcesso' => ['menu_controller' => 'NivelAcesso', 'menu_metodo' => 'listar']];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adm/Views/NivelAcesso/cadastrarNivelAcesso", $this->Dados);
        $carregarView->renderizar();
    }
}
