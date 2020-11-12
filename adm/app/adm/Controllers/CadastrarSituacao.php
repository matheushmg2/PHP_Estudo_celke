<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarSituacao
{

    private $Dados;

    public function cadastrarSituacao()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadastrarSituacao'])) {
            unset($this->Dados['CadastrarSituacao']);

            $cadastrarSituacao = new \App\adm\Models\AdmCadastrarSituacao();
            $cadastrarSituacao->cadastrarSituacao($this->Dados);
            if ($cadastrarSituacao->getResultado()) {
                $UrlDestino = URLADM . "Situacao/listar";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadastrarSituacaoViewPriv();
            }
        } else {
            $this->cadastrarSituacaoViewPriv();
        }
    }

    private function cadastrarSituacaoViewPriv()
    {
        $listarSelect = new \App\adm\Models\AdmCadastrarSituacao();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
        
        $botao = ['ListarSituacao' => ['menu_controller' => 'Situacao', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adm/Views/Situacao/cadastrarSituacao", $this->Dados);
        $carregarView->renderizar();
    }
}
