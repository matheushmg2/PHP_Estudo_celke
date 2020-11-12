<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarCores
{

    private $Dados;

    public function cadastrarCores()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadastrarCores'])) {
            unset($this->Dados['CadastrarCores']);

            $cadastrarCores = new \App\adm\Models\AdmCadastrarCores();
            $cadastrarCores->cadastrarCores($this->Dados);

            if ($cadastrarCores->getResultado()) {
                $UrlDestino = URLADM . "Cores/listar";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->CadastrarCoresViewPriv();
            }
        } else {
            $this->CadastrarCoresViewPriv();
        }
    }

    private function CadastrarCoresViewPriv()
    {
        
        $botao = ['listarCores' => ['menu_controller' => 'Cores', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adm/Views/Cores/cadastrarCores", $this->Dados);
        $carregarView->renderizar();
    }

}
