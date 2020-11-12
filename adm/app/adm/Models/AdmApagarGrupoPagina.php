<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmApagarGrupoPagina{

    private $Resultado;
    private $DadosId;
    private $Dados;
    private $DadosGrupoPaginaInferior;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarGrupoPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verificarGrupoPaginaCadastrada();
        if($this->Resultado){
            $this->verificarGrupoPaginaInferior();
            $apagarGrupoPagina = new \App\adm\Models\helper\AdmDelete();
            $apagarGrupoPagina->exeDelete("adm_grupos_paginas", "WHERE id =:id", "id={$this->DadosId}");
            if($apagarGrupoPagina->getResultado()){
                $this->atualizarOrdemGrupoPagina();
                $_SESSION['msg'] = "<div class='alert alert-success'>Grupo de página apagado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Grupo de página não foi apagado!</div>";
                $this->Resultado = false;
            }
        } 
    }

    private function verificarGrupoPaginaCadastrada()
    {
        $verGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verGrupoPagina->fullRead("SELECT id FROM adm_paginas WHERE adm_grupos_paginas_id =:adm_grupos_paginas_id LIMIT :limit", "adm_grupos_paginas_id=".$this->DadosId."&limit=2");
        if($verGrupoPagina->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O grupo de página não pode ser apagado, há páginas cadastradas neste grupo de página!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verificarGrupoPaginaInferior()
    {
        $verGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verGrupoPagina->fullRead("SELECT id, ordem AS ordem_result FROM adm_grupos_paginas WHERE ordem > (SELECT ordem FROM adm_grupos_paginas WHERE id =:id) ORDER BY ordem ASC", "id={$this->DadosId}");
        $this->DadosGrupoPaginaInferior = $verGrupoPagina->getResultado();
    }

    private function atualizarOrdemGrupoPagina()
    {
        if($this->DadosGrupoPaginaInferior){
            foreach ($this->DadosGrupoPaginaInferior as $atualOrdem) {
                extract($atualOrdem);
                $this->Dados['ordem'] = $ordem_result - 1;
                $this->Dados['modified'] = date('Y-m-d H:i:s');
                $updateAlterarItensMenu = new \App\adm\Models\helper\AdmUpdate();
                $updateAlterarItensMenu->exeUpdate("adm_grupos_paginas", $this->Dados, "WHERE id =:id", "id=" . $id);
            }
        }
    }

}