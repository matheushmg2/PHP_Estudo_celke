<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmCadastrarCores
{

    private $Resultado;
    private $Dados;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function cadastrarCores(array $Dados)
    {
        $this->Dados = $Dados;
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->inserirCores();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirCores()
    {
        $this->Dados['created'] = date('Y-m-d H:i:s');
        $cadastrarCores = new \App\adm\Models\helper\AdmCreate();
            $cadastrarCores->exeCreate("adm_cores", $this->Dados);
        if($cadastrarCores->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Cor cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A cor não foi cadastrada!</div>";
            $this->Resultado = false;
        }
    }

}
