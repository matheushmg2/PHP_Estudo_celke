<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarCores
{

    private $Dados;
    private $DadosId;

    public function editarCores($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->EditarCoresPrivado();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Cor não encontrada!</div>";
            $UrlDestino = URLADM . "Cores/listar";
            header("Location: $UrlDestino");
        }
    }
    private function EditarCoresPrivado()
    {
        if (!empty($this->Dados['EditarCores'])) {
            unset($this->Dados['EditarCores']);

            $editarCores = new \App\adm\Models\AdmEditarCores();
            $editarCores->editarCores($this->Dados);
            if ($editarCores->getResultado()) {
                //$_SESSION['msg'] = "<div class='alert alert-success text-center'> Usuário Editado com Sucesso..</div>";
                $UrlDestino = URLADM . "VerCores/VerCores/" . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->EditarCoresViewPrivado();
            }
        } else {
            $verMenu = new \App\adm\Models\AdmEditarCores();
            $this->Dados['form'] = $verMenu->verCores($this->DadosId);

            $this->EditarCoresViewPrivado();
        }
    }

    private function EditarCoresViewPrivado()
    {
        if ($this->Dados['form']) {

            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = ['VisualizarCores' => ['menu_controller' => 'VerCores', 'menu_metodo' => 'verCores']];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $carregarView = new \Core\ConfigView("adm/Views/Cores/editarCores", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Cor não encontrada!</div>";
            $UrlDestino = URLADM . "Cores/listar";
            header("Location: $UrlDestino");
        }
    }
}
