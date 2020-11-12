<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarUsuario
{

    private $Dados;
    private $DadosId;
    private $Registro;

    public function editarUsuario($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editarUsuarioPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhum Usuário Encontrado</div>";
            $UrlDestino = URLADM . "usuarios/listar";
            header("Location: $UrlDestino");
        }
    }
    private function editarUsuarioPriv()
    {
        if (!empty($this->Dados['EditarUsuario'])) {
            unset($this->Dados['EditarUsuario']);

            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            // Se Existir valor no atributo $_FILES['imagem'] imprima/pegar a imagem, se nao atribua null

            $editarUsuario = new \App\adm\Models\AdmEditarUsuario();
            $editarUsuario->editarUsuario($this->Dados);
            if ($editarUsuario->getResultado()) {
                //$_SESSION['msg'] = "<div class='alert alert-success text-center'> Usuário Editado com Sucesso..</div>";
                $UrlDestino = URLADM . "VerUsuario/verUsuario/" . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editarUsuarioViewPriv();
            }
        } else {
            $verUsuario = new \App\adm\Models\AdmEditarUsuario();
            $this->Dados['form'] = $verUsuario->verUsuario($this->DadosId);

            $this->editarUsuarioViewPriv();
        }
    }

    private function editarUsuarioViewPriv()
    {
        if ($this->Dados['form']) {
            $listarSelect = new \App\adm\Models\AdmEditarUsuario();
            $this->Dados['select'] = $listarSelect->listarCadastrar();

            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = ['VisualizarUsuario' => ['menu_controller' => 'VerUsuario', 'menu_metodo' => 'verUsuario']];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $carregarView = new \Core\ConfigView("adm/Views/Usuario/editarUsuario", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhum Usuário Encontrado</div>";
            $UrlDestino = URLADM . "usuarios/listar";
            header("Location: $UrlDestino");
        }
    }
}
