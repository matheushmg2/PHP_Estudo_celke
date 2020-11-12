<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmCadastrarSituacao
{

    private $Resultado;
    private $Dados;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function cadastrarSituacao(array $Dados)
    {
        $this->Dados = $Dados;
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->inserirSituacao();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirSituacao()
    {
        $this->Dados['created'] = date('Y-m-d H:i:s');
        $cadastrarSituacao = new \App\adm\Models\helper\AdmCreate();
        $cadastrarSituacao->exeCreate("adm_situacoes", $this->Dados);
        if($cadastrarSituacao->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A situação não foi cadastrada!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adm\Models\helper\AdmLeitura();
        $listar->fullRead("SELECT id id_cor, nome nome_cor FROM adm_cores ORDER BY nome ASC");
        $registro['cores'] = $listar->getResultado();

        $this->Resultado = array('cores' => $registro['cores']);
        return $this->Resultado;
    }

}
