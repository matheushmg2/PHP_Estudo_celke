<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmCadastrarTipoPagina
{

    private $Resultado;
    private $Dados;
    private $UltimoTipoPagina;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function cadastrarTipoPagina(array $Dados)
    {
        $this->Dados = $Dados;
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->inserirTipoPagina();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirTipoPagina()
    {
        $this->Dados['created'] = date('Y-m-d H:i:s');
        $this->verTipoPagina();
        $this->Dados['ordem'] = $this->UltimoTipoPagina[0]['ordem'] + 1;
        $cadastrarTipoPagina = new \App\adm\Models\helper\AdmCreate();
        $cadastrarTipoPagina->exeCreate("adm_tipos_paginas", $this->Dados);
        if($cadastrarTipoPagina->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de página cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Tipo de página não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    private function verTipoPagina()
    {
        $verTipoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verTipoPagina->fullRead("SELECT ordem FROM adm_tipos_paginas ORDER BY ordem DESC LIMIT :limit", "limit=1");
        $this->UltimoTipoPagina = $verTipoPagina->getResultado();
    }

}
