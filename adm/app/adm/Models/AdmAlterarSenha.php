<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmAlterarSenha{

    private $Resultado;
    private $Dados;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function editarSenha($Dados){

        $this->Dados = $Dados;

        $valSenha = new \App\adm\Models\helper\AdmValSenha();
        $valSenha->valSenha($this->Dados['senha']);
        if($valSenha->getResultado()){
            $this->updateAtualSenha();
            
        } else {
            $this->Resultado = false;
        }
/*
        $validaChave = new \App\adm\Models\helper\AdmLeitura();
        $validaChave->fullRead("SELECT id FROM adm_usuarios WHERE recuperar_senha =:recuperar_senha LIMIT :limit", "recuperar_senha={$this->Chave}&limit=1");
        
        $this->DadosUsuario = $validaChave->getResultado();

        if(!empty($this->DadosUsuario)){
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Link inválido..</div>";
            $this->Resultado = false;
        }*/
    }

    public function atualSenha(array $Dados){

        $this->Dados = $Dados;
        if($this->Resultado){
            $valSenha = new \App\adm\Models\helper\AdmValSenha();
            $valSenha->valSenha($this->Dados['senha']);
            if($valSenha->getResultado()){
                $this->updateAtualSenha();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateAtualSenha(){
        $this->Dados['senha'] = password_hash($this->Dados['senha'], PASSWORD_DEFAULT);
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $upAtualSenha = new \App\adm\Models\helper\AdmUpdate();
        $upAtualSenha->exeUpdate("adm_usuarios", $this->Dados, "WHERE id =:id", "id=".$_SESSION['usuario_id']);
        if($upAtualSenha->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Sua senha foi atualizada com sucesso.</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: A senha não foi atualizada!</div>";
            $this->Resultado = false;
        }
        
    }

    

}