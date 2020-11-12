<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarUsuario
{

    private $Dados;
    private $DadosId;
    private $Registro;

    public function cadastrarUsuario()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadastrarUsuario'])) {
            unset($this->Dados['CadastrarUsuario']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            // Se Existir valor no atributo $_FILES['imagem'] imprima/pegar a imagem, se nao atribua null

            $cadastrarUsuario = new \App\adm\Models\AdmCadastrarUsuario();
            $cadastrarUsuario->cadastrarUsuario($this->Dados);
            if ($cadastrarUsuario->getResultado()) {
                $UrlDestino = URLADM . "usuarios/listar";
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadastrarUsuarioViewPriv();
            }
        } else {
            $this->cadastrarUsuarioViewPriv();
        }
    }

    private function cadastrarUsuarioViewPriv()
    {
        
        $botao = ['ListarUsuario' => ['menu_controller' => 'usuarios', 'menu_metodo' => 'listar']];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarSelect = new \App\adm\Models\AdmCadastrarUsuario();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adm/Views/Usuario/cadastrarUsuario", $this->Dados);
        $carregarView->renderizar();
    }
}
