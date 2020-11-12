<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmAlterarOrdemTipoPagina{

    private $Resultado;
    private $DadosId;
    private $Dados;
    private $DadosTipoPagina;
    private $DadosTipoPaginaInferior;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function alterarTipoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verTipoPagina($this->DadosId);
        if($this->DadosTipoPagina){
            $this->verificarTipoPaginaInferior();
            if($this->DadosTipoPaginaInferior){
                $this->exeAlterarOrdemTipoPagina();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi alterado a ordem do tipo de página!</div>";
                $this->Resultado = false;
            }
        }
    }

    private function verTipoPagina()
    {
        $verGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verGrupoPagina->fullRead("SELECT * FROM adm_tipos_paginas WHERE id =:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->DadosTipoPagina = $verGrupoPagina->getResultado();
    }

    private function verificarTipoPaginaInferior()
    {
        $ordem_superior = $this->DadosTipoPagina[0]['ordem'] - 1;
        $verGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verGrupoPagina->fullRead("SELECT id, ordem FROM adm_tipos_paginas WHERE ordem =:ordem", "ordem={$ordem_superior}");
        $this->DadosTipoPaginaInferior = $verGrupoPagina->getResultado();
    }

    private function exeAlterarOrdemTipoPagina()
    {
        $this->Dados['ordem'] = $this->DadosTipoPagina[0]['ordem'];
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateMoverPraBaixo = new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraBaixo->exeUpdate("adm_tipos_paginas", $this->Dados, "WHERE id =:id", "id={$this->DadosTipoPaginaInferior[0]['id']}");

        $this->Dados['ordem'] = $this->DadosTipoPagina[0]['ordem'] - 1;
        $updateMoverPraCima= new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraCima->exeUpdate("adm_tipos_paginas", $this->Dados, "WHERE id =:id", "id={$this->DadosTipoPagina[0]['id']}");

        if($updateMoverPraCima->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do tipo de página editado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi alterado a ordem do tipo de página!</div>";
            $this->Resultado = false;
        }
    }

}