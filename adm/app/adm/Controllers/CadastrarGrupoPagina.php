<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarGrupoPagina
{

    private $Dados;

    public function cadastrarGrupoPagina()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadastrarGrupoPagina'])) {
            unset($this->Dados['CadastrarGrupoPagina']);

            $cadastrarGrupoPagina = new \App\adm\Models\AdmCadastrarGrupoPagina();
            $cadastrarGrupoPagina->cadastrarGrupoPagina($this->Dados);

            if ($cadastrarGrupoPagina->getResultado()) {
                $UrlDestino = URLADM . "GrupoPagina/listar";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->CadastraGrupoPaginaViewPriv();
            }
        } else {
            $this->CadastraGrupoPaginaViewPriv();
        }
    }

    private function CadastraGrupoPaginaViewPriv()
    {
        
        $botao = ['ListarGrupoPagina' => ['menu_controller' => 'GrupoPagina', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adm/Views/GrupoPagina/cadastrarGrupoPagina", $this->Dados);
        $carregarView->renderizar();
    }

}
