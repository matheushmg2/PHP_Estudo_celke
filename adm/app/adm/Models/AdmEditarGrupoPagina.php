<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmEditarGrupoPagina{

    private $Resultado;
    private $Dados;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verGrupoPagina($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verGrupoPagina->fullRead("SELECT * FROM adm_grupos_paginas WHERE id =:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verGrupoPagina->getResultado();
        return $this->Resultado;
    }

    public function editarGrupoPagina(array $Dados)
    {
        $this->Dados = $Dados;
        
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->updateEditarGrupoPagina();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditarGrupoPagina()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateEditarGrupoPagina = new \App\adm\Models\helper\AdmUpdate();
        $updateEditarGrupoPagina->exeUpdate("adm_grupos_paginas", $this->Dados, "WHERE id =:id", "id=".$this->Dados['id']);

        if($updateEditarGrupoPagina->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Grupo de página atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Grupo de página não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

}