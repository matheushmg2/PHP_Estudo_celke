<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmAlterarOrdemGrupoPagina{

    private $Resultado;
    private $DadosId;
    private $Dados;
    private $DadosGrupoPagina;
    private $DadosGrupoPaginaInferior;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function alterarGrupoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verGrupoPagina($this->DadosId);
        if($this->DadosGrupoPagina){
            $this->verificarGrupoPaginaInferior();
            if($this->DadosGrupoPaginaInferior){
                $this->exeAlterarOrdemGrupoPagina();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi alterado a ordem do grupo de página!</div>";
                $this->Resultado = false;
            }
        }
    }

    private function verGrupoPagina()
    {
        $verGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verGrupoPagina->fullRead("SELECT * FROM adm_grupos_paginas WHERE id =:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->DadosGrupoPagina = $verGrupoPagina->getResultado();
    }

    private function verificarGrupoPaginaInferior()
    {
        $ordem_superior = $this->DadosGrupoPagina[0]['ordem'] - 1;
        $verGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verGrupoPagina->fullRead("SELECT id, ordem FROM adm_grupos_paginas WHERE ordem =:ordem", "ordem={$ordem_superior}");
        $this->DadosGrupoPaginaInferior = $verGrupoPagina->getResultado();
    }

    private function exeAlterarOrdemGrupoPagina()
    {
        $this->Dados['ordem'] = $this->DadosGrupoPagina[0]['ordem'];
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateMoverPraBaixo = new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraBaixo->exeUpdate("adm_grupos_paginas", $this->Dados, "WHERE id =:id", "id={$this->DadosGrupoPaginaInferior[0]['id']}");

        $this->Dados['ordem'] = $this->DadosGrupoPagina[0]['ordem'] - 1;
        $updateMoverPraCima= new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraCima->exeUpdate("adm_grupos_paginas", $this->Dados, "WHERE id =:id", "id={$this->DadosGrupoPagina[0]['id']}");

        if($updateMoverPraCima->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do grupo de página editado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi alterado a ordem do grupo de página!</div>";
            $this->Resultado = false;
        }
    }

}