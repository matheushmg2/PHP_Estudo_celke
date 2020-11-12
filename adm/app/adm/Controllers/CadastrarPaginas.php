<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarPaginas
{

    private $Dados;

    public function cadastrarPaginas()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadastrarPaginas'])) {
            unset($this->Dados['CadastrarPaginas']);

            $cadastrarPaginas = new \App\adm\Models\AdmCadastrarPaginas();
            $cadastrarPaginas->cadastrarPaginas($this->Dados);
            if ($cadastrarPaginas->getResultado()) {
                $UrlDestino = URLADM . "Pagina/listar";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadastrarPaginasViewPriv();
            }
        } else {
            $this->cadastrarPaginasViewPriv();
        }
    }

    private function cadastrarPaginasViewPriv()
    {
        $listarSelect = new \App\adm\Models\AdmCadastrarPaginas();
        $this->Dados['select'] = $listarSelect->listarCadastrarPagina();
        
        $botao = ['ListarPagina' => ['menu_controller' => 'Pagina', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adm/Views/Pagina/cadastrarPaginas", $this->Dados);
        $carregarView->renderizar();
    }
}
