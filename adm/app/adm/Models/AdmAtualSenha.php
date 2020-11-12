<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmAtualSenha{

    private $Chave;
    private $DadosUsuario;
    private $Resultado;
    private $Dados;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function valChave($Chave){
        $this->Chave = (string) $Chave;

        $validaChave = new \App\adm\Models\helper\AdmLeitura();
        $validaChave->fullRead("SELECT id FROM adm_usuarios WHERE recuperar_senha =:recuperar_senha LIMIT :limit", "recuperar_senha={$this->Chave}&limit=1");
        
        $this->DadosUsuario = $validaChave->getResultado();

        if(!empty($this->DadosUsuario)){
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Link inválido..</div>";
            $this->Resultado = false;
        }
    }

    public function atualSenha(array $Dados){

        $this->Dados = $Dados;
        $this->validarDados();
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
        $this->valChave($this->Dados['recuperar_senha']);
        if($this->Resultado){
            $this->Dados['recuperar_senha'] = null;
            $this->Dados['senha'] = password_hash($this->Dados['senha'], PASSWORD_DEFAULT);
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $upAtualSenha = new \App\adm\Models\helper\AdmUpdate();
            $upAtualSenha->exeUpdate("adm_usuarios", $this->Dados, "WHERE id =:id", "id={$this->DadosUsuario[0]['id']}");
            if($upAtualSenha->getResultado()){
                $_SESSION['msg'] = "<div class='alert alert-success'>Sua senha foi atualizada com sucesso.</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Error: A senha não foi atualizada!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: A senha não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

    /**
     * Método/Função que valida os campos se contém espaçamento e se está preenchido o campo e
     * Retorna TRUE se estiver preenchido ou 
     * Retorna FALSE se não estiver
     */
    private function validarDados(){
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        //var_dump($this->Dados);
        if(in_array('', $this->Dados)){ // Verificando se existir algum campo vazio
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário preencher todos os campos!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}