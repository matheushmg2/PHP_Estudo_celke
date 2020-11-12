<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarItensMenu
{

    private $Dados;

    public function cadastrarItensMenu()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadastrarItensMenu'])) {
            unset($this->Dados['CadastrarItensMenu']);

            $cadastrarItensMenu = new \App\adm\Models\AdmCadastrarItensMenu();
            $cadastrarItensMenu->cadastrarItensMenu($this->Dados);
            if ($cadastrarItensMenu->getResultado()) {
                $UrlDestino = URLADM . "Menu/listar";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadastrarItensMenuViewPriv();
            }
        } else {
            $this->cadastrarItensMenuViewPriv();
        }
    }

    private function cadastrarItensMenuViewPriv()
    {
        $listarSelect = new \App\adm\Models\AdmCadastrarItensMenu();
        $this->Dados['select'] = $listarSelect->listarCadastrarItensMenu();
        
        $botao = ['ListarItensMenu' => ['menu_controller' => 'Menu', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adm/Views/Menu/cadastrarItensMenu", $this->Dados);
        $carregarView->renderizar();
    }
}
