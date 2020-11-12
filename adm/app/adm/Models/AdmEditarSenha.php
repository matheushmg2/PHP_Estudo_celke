<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmEditarSenha
{
    private $Dados;
    private $DadosId;
    private $Resultado;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function valUsuario($DadosId)
    {
        $this->DadosId = (int) $DadosId;

        $validaUsuario = new \App\adm\Models\helper\AdmLeitura();
        $validaUsuario->fullRead("SELECT usuario.id FROM adm_usuarios usuario 
                                INNER JOIN adm_niveis_acessos nivac ON nivac.id = usuario.adm_niveis_acessos_id
                                WHERE usuario.id =:id AND nivac.ordem >:ordem LIMIT :limit", "id=".$this->DadosId."&ordem=".$_SESSION['ordem_nivel']."&limit=1");

        if(!empty($validaUsuario->getResultado())){
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não é possível Editar a senha.</div>";
            $this->Resultado = false;
        }
    }

    public function editarSenha(array $Dados){

        $this->Dados = $Dados;
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $valSenha = new \App\adm\Models\helper\AdmValSenha();
            $valSenha->valSenha($this->Dados['senha']);
            if($valSenha->getResultado()){
                $this->updateEditarSenha();
            } else {
                $this->Resultado = false;
            }
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditarSenha(){
        $this->valUsuario($this->Dados['id']);
        if($this->Resultado){
            $this->Dados['senha'] = password_hash($this->Dados['senha'], PASSWORD_DEFAULT);
            $this->Dados['modified'] = date("Y-m-d H:i:s");
            $upAtualSenha = new \App\adm\Models\helper\AdmUpdate();
            $upAtualSenha->exeUpdate("adm_usuarios", $this->Dados, "WHERE id =:id", "id={$this->Dados['id']}");
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



}