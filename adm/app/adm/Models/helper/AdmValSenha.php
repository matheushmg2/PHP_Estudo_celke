<?php

namespace App\adm\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmValSenha{

    private $Senha;
    private $Resultado;

    public function getResultado(){
        return $this->Resultado;
    }

    public function valSenha($Senha){

        $this->Senha = (string) $Senha;
        if(stristr($this->Senha, "'")){
            $_SESSION['msg'] = "<div class='alert alert-warning'>Alerta: Esse caracter especial não é permitido na Senha</div>";
            $this->Resultado = false;
        } else {
            if(stristr($this->Senha, " ")){
                $_SESSION['msg'] = "<div class='alert alert-warning'>Alerta: Não é permitido espaçamento entre as palavras.</div>";
                $this->Resultado = false;
            } else {
                $this->valExtensUsuario();
            }
            
        }
    }

    private function valExtensUsuario(){
        if(strlen($this->Senha) < 6){
            $_SESSION['msg'] = "<div class='alert alert-warning'>Alerta: A Senha deve conter no mínimo 6 caracteres!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}