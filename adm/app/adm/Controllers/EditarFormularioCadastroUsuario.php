<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarFormularioCadastroUsuario
{

    private $Dados;

    public function editarFormularioCadastroUsuario()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($this->Dados['EditarFormularioCadastroUsuario'])) {
            unset($this->Dados['EditarFormularioCadastroUsuario']);

            $editarFormularioCadastroUsuario = new \App\adm\Models\AdmEditarFormularioCadastroUsuario();
            $editarFormularioCadastroUsuario->editarFormularioCadastroUsuario($this->Dados);

            if ($editarFormularioCadastroUsuario->getResultado()) {
                $UrlDestino = URLADM . 'editarFormularioCadastroUsuario/editarFormularioCadastroUsuario';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editarFormularioCadUserPrivado();
            }
        } else {
            $verNivelAcesso = new \App\adm\Models\AdmEditarFormularioCadastroUsuario();
            $this->Dados['form'] = $verNivelAcesso->verFormularioCadastroUsuario();

            $this->editarFormularioCadUserPrivado();
        }
        
    }

    private function editarFormularioCadUserPrivado(){
        if ($this->Dados['form']) {
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $listarSelect = new \App\adm\Models\AdmEditarFormularioCadastroUsuario();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $carregarView = new \Core\ConfigView("adm/Views/Usuario/editarFormularioCadastroUsuario", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Formulário para editar o cadastro de usuário na página de login não encontrado!</div>";
            $UrlDestino = URLADM . 'editarFormularioCadastroUsuario/editarFormularioCadastroUsuario';
            header("Location: $UrlDestino");
        }
    }
}
