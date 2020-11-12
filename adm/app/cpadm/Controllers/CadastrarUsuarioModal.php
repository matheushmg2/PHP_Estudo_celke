<?php

namespace App\cpadm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CadastrarUsuarioModal
{

    private $Dados;

    public function cadastrarUsuarioModal()
    {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        unset($_SESSION['msg']);

        $cadastrarUsuarioModalJs = new \App\cpadm\Models\CpAdmCadastrarUsuario();
        $cadastrarUsuarioModalJs->cadastrarUsuario($this->Dados);

        if($cadastrarUsuarioModalJs->getResultado()){
            $retorna = ['erro' => true, 'msg' => $_SESSION['msg']];
            unset($_SESSION['msg']);
        } else {
            $retorna = ['erro' => false, 'msg' => $_SESSION['msg']];
            unset($_SESSION['msg']);
        }

        

        header('Content-Type: application/json');

        echo json_encode($retorna);
    }

}

