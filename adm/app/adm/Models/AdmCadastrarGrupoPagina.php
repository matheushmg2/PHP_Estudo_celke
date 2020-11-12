<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmCadastrarGrupoPagina
{

    private $Resultado;
    private $Dados;
    private $UltimoGrupoPagina;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function cadastrarGrupoPagina(array $Dados)
    {
        $this->Dados = $Dados;
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->inserirGrupoPagina();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirGrupoPagina()
    {
        $this->Dados['created'] = date('Y-m-d H:i:s');
        $this->verUltimoGrupoPagina();
        $this->Dados['ordem'] = $this->UltimoGrupoPagina[0]['ordem'] + 1;
        $cadastrarGrupoPagina = new \App\adm\Models\helper\AdmCreate();
        $cadastrarGrupoPagina->exeCreate("adm_grupos_paginas", $this->Dados);
        if($cadastrarGrupoPagina->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Grupo de página cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Grupo de página não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    private function verUltimoGrupoPagina()
    {
        $verGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verGrupoPagina->fullRead("SELECT ordem FROM adm_grupos_paginas ORDER BY ordem DESC LIMIT :limit", "limit=1");
        $this->UltimoGrupoPagina = $verGrupoPagina->getResultado();
    }

}
