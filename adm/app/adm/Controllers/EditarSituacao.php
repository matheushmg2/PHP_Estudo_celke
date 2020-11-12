<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarSituacao
{

    private $Dados;
    private $DadosId;

    public function editarSituacao($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editarSituacaoPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhuma Página Encontrada.</div>";
            $UrlDestino = URLADM . "Pagina/listar";
            header("Location: $UrlDestino");
        }
    }
    private function editarSituacaoPriv()
    {
        if (!empty($this->Dados['EditarSituacao'])) {
            unset($this->Dados['EditarSituacao']);

            $editarSituacao = new \App\adm\Models\AdmEditarSituacao();
            $editarSituacao->editarSituacao($this->Dados);
            if ($editarSituacao->getResultado()) {
                $UrlDestino = URLADM . "VerSituacao/verSituacao/" . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editarSituacaoViewPriv();
            }
        } else {
            $verSituacao = new \App\adm\Models\AdmEditarSituacao();
            $this->Dados['form'] = $verSituacao->verSituacao($this->DadosId);

            $this->editarSituacaoViewPriv();
        }
    }

    private function editarSituacaoViewPriv()
    {
        if ($this->Dados['form']) {
            $listarSelect = new \App\adm\Models\AdmEditarSituacao();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = ['VerSituacao' => ['menu_controller' => 'VerSituacao', 'menu_metodo' => 'verSituacao']];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $carregarView = new \Core\ConfigView("adm/Views/Situacao/editarSituacao", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Situação não encontrada!</div>";
            $UrlDestino = URLADM . "Situacao/listar";
            header("Location: $UrlDestino");
        }
    }
}
