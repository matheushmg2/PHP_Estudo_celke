<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarItensMenu
{

    private $Dados;
    private $DadosId;

    public function editarItensMenu($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->EditarItensMenuPrivado();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhuma Página Encontrada.</div>";
            $UrlDestino = URLADM . "Pagina/listar";
            header("Location: $UrlDestino");
        }
    }
    private function EditarItensMenuPrivado()
    {
        if (!empty($this->Dados['EditarItensMenu'])) {
            unset($this->Dados['EditarItensMenu']);

            $editarItensMenu = new \App\adm\Models\AdmEditarItensMenu();
            $editarItensMenu->editarItensMenu($this->Dados);
            if ($editarItensMenu->getResultado()) {
                //$_SESSION['msg'] = "<div class='alert alert-success text-center'> Usuário Editado com Sucesso..</div>";
                $UrlDestino = URLADM . "VerMenu/VerMenu/" . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->EditarItensMenuViewPrivado();
            }
        } else {
            $verMenu = new \App\adm\Models\AdmEditarItensMenu();
            $this->Dados['form'] = $verMenu->verMenu($this->DadosId);

            $this->EditarItensMenuViewPrivado();
        }
    }

    private function EditarItensMenuViewPrivado()
    {
        if ($this->Dados['form']) {
            $listarSelect = new \App\adm\Models\AdmEditarItensMenu();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = ['VisualizarMenu' => ['menu_controller' => 'verMenu', 'menu_metodo' => 'verMenu']];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $carregarView = new \Core\ConfigView("adm/Views/Menu/editarItensMenu", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhuma Página Encontrada.</div>";
            $UrlDestino = URLADM . "Menu/listar";
            header("Location: $UrlDestino");
        }
    }
}
