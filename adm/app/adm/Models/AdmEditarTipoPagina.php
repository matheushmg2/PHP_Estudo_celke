<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmEditarTipoPagina{

    private $Resultado;
    private $Dados;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verTipoPagina($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verTipoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verTipoPagina->fullRead("SELECT * FROM adm_tipos_paginas WHERE id =:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verTipoPagina->getResultado();
        return $this->Resultado;
    }

    public function editarTipoPagina(array $Dados)
    {
        $this->Dados = $Dados;
        
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->updateEditarTipoPagina();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditarTipoPagina()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateEditarTipoPagina = new \App\adm\Models\helper\AdmUpdate();
        $updateEditarTipoPagina->exeUpdate("adm_tipos_paginas", $this->Dados, "WHERE id =:id", "id=".$this->Dados['id']);

        if($updateEditarTipoPagina->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de página atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Tipo de página não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

}