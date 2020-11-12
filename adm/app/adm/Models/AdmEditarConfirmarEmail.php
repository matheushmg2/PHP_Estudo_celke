<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmEditarConfirmarEmail{

    private $Resultado;
    private $Dados;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verConfirmarEmail()
    {
        $verNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcesso->fullRead("SELECT * FROM adm_confirmar_emails
                                WHERE id =:id LIMIT :limit", 
                                "id=1&limit=1");
        $this->Resultado = $verNivelAcesso->getResultado();
        return $this->Resultado;
    }

    public function editarConfirmarEmail(array $Dados)
    {
        $this->Dados = $Dados;
        
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->updateEditarConfirmarEmail();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditarConfirmarEmail()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateConfirmarEmail = new \App\adm\Models\helper\AdmUpdate();
        $updateConfirmarEmail->exeUpdate("adm_confirmar_emails", $this->Dados, "WHERE id =:id", "id=".$this->Dados['id']);

        if($updateConfirmarEmail->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Formulário para editar os dados do servidor de e-mail atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Formulário para editar os dados do servidor de e-mail não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

}