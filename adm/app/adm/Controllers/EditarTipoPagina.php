<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarTipoPagina
{

    private $Dados;
    private $DadosId;

    public function editarTipoPagina($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->EditarTipoPaginaPrivado();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Tipo de página não encontrado!</div>";
            $UrlDestino = URLADM . "TipoPagina/listar";
            header("Location: $UrlDestino");
        }
    }
    private function EditarTipoPaginaPrivado()
    {
        if (!empty($this->Dados['EditarTipoPagina'])) {
            unset($this->Dados['EditarTipoPagina']);

            $editarTipoPagina = new \App\adm\Models\AdmEditarTipoPagina();
            $editarTipoPagina->editarTipoPagina($this->Dados);
            if ($editarTipoPagina->getResultado()) {
                $UrlDestino = URLADM . "VerTipoPagina/VerTipoPagina/" . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->EditarTipoPaginaViewPrivado();
            }
        } else {
            $verTipoPagina = new \App\adm\Models\AdmEditarTipoPagina();
            $this->Dados['form'] = $verTipoPagina->verTipoPagina($this->DadosId);

            $this->EditarTipoPaginaViewPrivado();
        }
    }

    private function EditarTipoPaginaViewPrivado()
    {
        if ($this->Dados['form']) {

            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = ['VerTipoPagina' => ['menu_controller' => 'VerTipoPagina', 'menu_metodo' => 'verTipoPagina']];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $carregarView = new \Core\ConfigView("adm/Views/TipoPagina/editarTipoPagina", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Tipo de página não encontrado!</div>";
            $UrlDestino = URLADM . "TipoPagina/listar";
            header("Location: $UrlDestino");
        }
    }
}
