<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmCadastrarNivelAcesso{

    private $Resultado;
    private $Dados;
    private $UltimoNivelAcesso;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function cadastrarNivelAcesso(array $Dados){

        $this->Dados = $Dados;
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->inserirNivelAcesso();
        } else {
            $this->Resultado = false;
        }
        
    }


    private function inserirNivelAcesso(){
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $this->verUltimoNivelAcesso();
        $this->Dados['ordem'] = $this->UltimoNivelAcesso[0]['ordem'] + 1;
        $cadastrarNivelAcesso = new \App\adm\Models\helper\AdmCreate();
        $cadastrarNivelAcesso->exeCreate("adm_niveis_acessos", $this->Dados);
        if($cadastrarNivelAcesso->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Nível de acesso foi atualizada com sucesso.</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Nível de acesso não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    private function verUltimoNivelAcesso()
    {
        $verNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcesso->fullRead("SELECT ordem FROM adm_niveis_acessos ORDER BY ordem DESC LIMIT :limit", "limit=1");
        $this->UltimoNivelAcesso = $verNivelAcesso->getResultado();
    }

}