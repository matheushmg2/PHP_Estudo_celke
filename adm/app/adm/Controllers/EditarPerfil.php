<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarPerfil
{

    private $Dados;

    public function editarPerfil()
    {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['EditarPerfil'])) {
            unset($this->Dados['EditarPerfil']);

            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            // Se Existir valor no atributo $_FILES['imagem_nova'] imprima/pegar a imagem, se nao atribua null

            $editarPerfil = new \App\adm\Models\AdmEditarPerfil();
            $editarPerfil->editarPerfil($this->Dados);

            if ($editarPerfil->getResultado()) {
                $UrlDestino = URLADM . 'VerPerfil/perfil';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->PerfilViewPriv();
            }
        } else {
            $verPerfil = new \App\adm\Models\AdmVerPerfil();
            $this->Dados['form'] = $verPerfil->verPerfil();

            $this->PerfilViewPriv();
        }
    }

    private function PerfilViewPriv(){
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $botao = ['VerPerfil' => ['menu_controller' => 'VerPerfil', 'menu_metodo' => 'perfil']];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $carregarView = new \Core\ConfigView("adm/Views/Usuario/editarPerfil", $this->Dados);
        $carregarView->renderizar();
    }
}
