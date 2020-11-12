<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarGrupoPagina
{

    private $Dados;
    private $DadosId;

    public function editarGrupoPagina($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->EditarGrupoPaginaPrivado();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Grupo de página não encontrado!</div>";
            $UrlDestino = URLADM . "GrupoPagina/listar";
            header("Location: $UrlDestino");
        }
    }
    private function EditarGrupoPaginaPrivado()
    {
        if (!empty($this->Dados['EditarGrupoPagina'])) {
            unset($this->Dados['EditarGrupoPagina']);

            $editarGrupoPagina = new \App\adm\Models\AdmEditarGrupoPagina();
            $editarGrupoPagina->editarGrupoPagina($this->Dados);
            if ($editarGrupoPagina->getResultado()) {
                $UrlDestino = URLADM . "VerGrupoPagina/VerGrupoPagina/" . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->EditarGrupoPaginaViewPrivado();
            }
        } else {
            $verGrupoPagina = new \App\adm\Models\AdmEditarGrupoPagina();
            $this->Dados['form'] = $verGrupoPagina->verGrupoPagina($this->DadosId);

            $this->EditarGrupoPaginaViewPrivado();
        }
    }

    private function EditarGrupoPaginaViewPrivado()
    {
        if ($this->Dados['form']) {

            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = ['VerGrupoPagina' => ['menu_controller' => 'VerGrupoPagina', 'menu_metodo' => 'verGrupoPagina']];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $carregarView = new \Core\ConfigView("adm/Views/GrupoPagina/editarGrupoPagina", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Grupo de página não encontrado!</div>";
            $UrlDestino = URLADM . "GrupoPagina/listar";
            header("Location: $UrlDestino");
        }
    }
}
