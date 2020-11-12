<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmEditarCores{

    private $Resultado;
    private $Dados;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verCores($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verCores = new \App\adm\Models\helper\AdmLeitura();
        $verCores->fullRead("SELECT * FROM adm_cores WHERE id =:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verCores->getResultado();
        return $this->Resultado;
    }

    public function editarCores(array $Dados)
    {
        $this->Dados = $Dados;
        
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->updateEditarCores();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditarCores()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateEditarCores = new \App\adm\Models\helper\AdmUpdate();
        $updateEditarCores->exeUpdate("adm_cores", $this->Dados, "WHERE id =:id", "id=".$this->Dados['id']);

        if($updateEditarCores->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Cor atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A cor não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

}