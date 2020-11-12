<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class VerPerfil
{

    private $Dados;

    public function perfil()
    {
        $listarMenu = new \App\adm\Models\AdmMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $botao = [
            'EditarPerfil' => ['menu_controller' => 'EditarPerfil', 'menu_metodo' => 'editarPerfil'],
            'AlterarSenha' => ['menu_controller' => 'AterarSenha', 'menu_metodo' => 'editarSenha']
        ];

        $listarBotao = new \App\adm\Models\AdmBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $verPerfil = new \App\adm\Models\AdmVerPerfil();
        $this->Dados['perfil'] = $verPerfil->verPerfil();

        $carregarView = new \Core\ConfigView("adm/Views/Usuario/perfil", $this->Dados);
        $carregarView->renderizar();
    }

}
