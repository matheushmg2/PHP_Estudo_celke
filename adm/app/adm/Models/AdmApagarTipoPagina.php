<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmApagarTipoPagina{

    private $Resultado;
    private $DadosId;
    private $Dados;
    private $DadosTipooPaginaInferior;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarTipoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verificarTipoPaginaCadastrada();
        if($this->Resultado){
            $this->verificarTipoPaginaInferior();
            $apagarTipoPagina = new \App\adm\Models\helper\AdmDelete();
            $apagarTipoPagina->exeDelete("adm_tipos_paginas", "WHERE id =:id", "id={$this->DadosId}");
            if($apagarTipoPagina->getResultado()){
                $this->atualizarOrdemTipoPagina();
                $_SESSION['msg'] = "<div class='alert alert-success'>Tipo de página apagado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Tipo de página não foi apagado!</div>";
                $this->Resultado = false;
            }
        } 
    }

    private function verificarTipoPaginaCadastrada()
    {
        $verTipoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verTipoPagina->fullRead("SELECT id FROM adm_paginas WHERE adm_tipos_paginas_id =:adm_tipos_paginas_id LIMIT :limit", "adm_tipos_paginas_id=".$this->DadosId."&limit=2");
        if($verTipoPagina->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O tipo de página não pode ser apagado, há páginas cadastradas neste tipo de página!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verificarTipoPaginaInferior()
    {
        $verTipoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verTipoPagina->fullRead("SELECT id, ordem AS ordem_result FROM adm_tipos_paginas WHERE ordem > (SELECT ordem FROM adm_tipos_paginas WHERE id =:id) ORDER BY ordem ASC", "id={$this->DadosId}");
        $this->DadosTipooPaginaInferior = $verTipoPagina->getResultado();
    }

    private function atualizarOrdemTipoPagina()
    {
        if($this->DadosTipooPaginaInferior){
            foreach ($this->DadosTipooPaginaInferior as $atualOrdem) {
                extract($atualOrdem);
                $this->Dados['ordem'] = $ordem_result - 1;
                $this->Dados['modified'] = date('Y-m-d H:i:s');
                $updateAlterarItensMenu = new \App\adm\Models\helper\AdmUpdate();
                $updateAlterarItensMenu->exeUpdate("adm_tipos_paginas", $this->Dados, "WHERE id =:id", "id=" . $id);
            }
        }
    }

}