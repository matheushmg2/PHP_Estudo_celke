<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarConfirmarEmail
{

    private $Dados;

    public function editarConfirmarEmail()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->Dados['EditarConfirmarEmail'])) {
            unset($this->Dados['EditarConfirmarEmail']);

            $editarConfirmarEmail = new \App\adm\Models\AdmEditarConfirmarEmail();
            $editarConfirmarEmail->editarConfirmarEmail($this->Dados);

            if ($editarConfirmarEmail->getResultado()) {
                $UrlDestino = URLADM . 'EditarConfirmarEmail/editarConfirmarEmail';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->EditarConfirmarEmailPrivado();
            }
        } else {
            $verConfirmarEmail = new \App\adm\Models\AdmEditarConfirmarEmail();
            $this->Dados['form'] = $verConfirmarEmail->verConfirmarEmail();

            $this->EditarConfirmarEmailPrivado();
        }
        
    }

    private function EditarConfirmarEmailPrivado(){
        if ($this->Dados['form']) {
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adm/Views/ConfirmarEmail/editarConfirmarEmail", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Formulário para editar os dados do servidor de e-mail não encontrado!</div>";
            $UrlDestino = URLADM . 'EditarConfirmarEmail/editarConfirmarEmail';
            header("Location: $UrlDestino");
        }
    }
}
