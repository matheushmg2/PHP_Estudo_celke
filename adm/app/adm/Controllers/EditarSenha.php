<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarSenha
{

    private $Dados;
    private $DadosId;

    public function editarSenha($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $validaUsuario = new \App\adm\Models\AdmEditarSenha();
            $validaUsuario->valUsuario($this->DadosId);
            if ($validaUsuario->getResultado()) {
                $this->editarSenhaPriv();
            } else {
                $UrlDestino = URLADM . 'usuarios/listar';
                header("Location: $UrlDestino");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhum Usuário Encontrado</div>";
            $UrlDestino = URLADM . "usuarios/listar";
            header("Location: $UrlDestino");
        }
    }
    private function editarSenhaPriv()
    {
        if (!empty($this->Dados['EditarSenha'])) {
            unset($this->Dados['EditarSenha']);
            $editarSenha = new \App\adm\Models\AdmEditarSenha();
            $editarSenha->editarSenha($this->Dados);
            if ($editarSenha->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success text-center'> Senha Editada com Sucesso..</div>";
                $UrlDestino = URLADM . "VerUsuario/verUsuario/" . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados['id'];
                $this->editarSenhaViewPriv();
            }
        } else {
            $this->Dados['form'] = $this->DadosId;
            $this->editarSenhaViewPriv();
        }
    }

    private function editarSenhaViewPriv()
    {
        if ($this->Dados['form']) {
            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = ['VisualizarUsuario' => ['menu_controller' => 'VerUsuario', 'menu_metodo' => 'verUsuario']];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $carregarView = new \Core\ConfigView("adm/Views/Usuario/editarSenha", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhum Usuário Encontrado</div>";
            $UrlDestino = URLADM . "usuarios/listar";
            header("Location: $UrlDestino");
        }
    }
}
