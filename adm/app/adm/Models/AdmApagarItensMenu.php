<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmApagarItensMenu{

    private $Resultado;
    private $DadosId;
    private $Dados;
    private $DadosMenuInferior;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarItensMenu($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verificarNivelAcessoPaginaCadastrada();
        if($this->Resultado){
            $this->verificarMenuInferior();
            $apagarItensMenu = new \App\adm\Models\helper\AdmDelete();
            $apagarItensMenu->exeDelete("adm_menus", "WHERE id =:id", "id=" . $this->DadosId);
            if($apagarItensMenu->getResultado()){
                $this->atualizarOrdemItensMenu();
                $_SESSION['msg'] = "<div class='alert alert-success'>Item de menu apagado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Item de menu não foi apagado!</div>";
                $this->Resultado = false;
            }
        } 
    }

    private function verificarNivelAcessoPaginaCadastrada()
    {
        $verMenu = new \App\adm\Models\helper\AdmLeitura();
        $verMenu->fullRead("SELECT id FROM adm_nivel_acesso_paginas WHERE adm_menus_id =:adm_menus_id LIMIT :limit", "id=".$this->DadosId."&limit=2");
        if($verMenu->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-danger'>O item de menu não pode ser apagado, há permissões cadastradas neste item de menu!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verificarMenuInferior()
    {
        $verMenu = new \App\adm\Models\helper\AdmLeitura();
        $verMenu->fullRead("SELECT id, ordem AS ordem_result FROM adm_menus WHERE ordem > (SELECT ordem FROM adm_menus WHERE id =:id) ORDER BY ordem ASC", "id={$this->DadosId}");
        $this->DadosMenuInferior = $verMenu->getResultado();
    }

    private function atualizarOrdemItensMenu()
    {
        if($this->DadosMenuInferior){
            foreach ($this->DadosMenuInferior as $atualOrdem) {
                extract($atualOrdem);
                $this->Dados['ordem'] = $ordem_result - 1;
                $this->Dados['modified'] = date('Y-m-d H:i:s');
                $updateAlterarItensMenu = new \App\adm\Models\helper\AdmUpdate();
                $updateAlterarItensMenu->exeUpdate("adm_menus", $this->Dados, "WHERE id =:id", "id=" . $id);
            }
        }
    }

}