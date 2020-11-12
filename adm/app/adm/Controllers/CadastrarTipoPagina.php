<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarTipoPagina
{

    private $Dados;

    public function cadastrarTipoPagina()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadastrarTipoPagina'])) {
            unset($this->Dados['CadastrarTipoPagina']);

            $cadastrarTipoPagina = new \App\adm\Models\AdmCadastrarTipoPagina();
            $cadastrarTipoPagina->cadastrarTipoPagina($this->Dados);

            if ($cadastrarTipoPagina->getResultado()) {
                $UrlDestino = URLADM . "TipoPagina/listar";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->CadastraTipoPaginaViewPriv();
            }
        } else {
            $this->CadastraTipoPaginaViewPriv();
        }
    }

    private function CadastraTipoPaginaViewPriv()
    {
        
        $botao = ['ListarTipoPagina' => ['menu_controller' => 'TipoPagina', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adm/Views/TipoPagina/cadastrarTipoPagina", $this->Dados);
        $carregarView->renderizar();
    }

}
