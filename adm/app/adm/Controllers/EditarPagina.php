<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarPagina
{

    private $Dados;
    private $DadosId;

    public function editarPagina($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editarPaginaPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhuma Página Encontrada.</div>";
            $UrlDestino = URLADM . "Pagina/listar";
            header("Location: $UrlDestino");
        }
    }
    private function editarPaginaPriv()
    {
        if (!empty($this->Dados['EditarPagina'])) {
            unset($this->Dados['EditarPagina']);

            $editarPagina = new \App\adm\Models\AdmEditarPagina();
            $editarPagina->editarPagina($this->Dados);
            if ($editarPagina->getResultado()) {
                //$_SESSION['msg'] = "<div class='alert alert-success text-center'> Usuário Editado com Sucesso..</div>";
                $UrlDestino = URLADM . "VerPagina/verPagina/" . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editarPaginaViewPriv();
            }
        } else {
            $verPagina = new \App\adm\Models\AdmEditarPagina();
            $this->Dados['form'] = $verPagina->verPagina($this->DadosId);

            $this->editarPaginaViewPriv();
        }
    }

    private function editarPaginaViewPriv()
    {
        if ($this->Dados['form']) {
            $listarSelect = new \App\adm\Models\AdmEditarPagina();
            $this->Dados['select'] = $listarSelect->listarEditarPagina();

            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = ['VisualizarPagina' => ['menu_controller' => 'verPagina', 'menu_metodo' => 'verPagina']];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $carregarView = new \Core\ConfigView("adm/Views/Pagina/editarPagina", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhuma Página Encontrada.</div>";
            $UrlDestino = URLADM . "Pagina/listar";
            header("Location: $UrlDestino");
        }
    }
}
