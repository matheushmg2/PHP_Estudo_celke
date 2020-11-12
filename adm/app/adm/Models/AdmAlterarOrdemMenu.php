<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmAlterarOrdemMenu{

    private $Resultado;
    private $DadosId;
    private $Dados;
    private $DadosNivelAcessoPagina;
    private $DadosNivelAcessoPaginaInferior;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function alterarOrdemMenu($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verNivelAcessoPagina();
        if($this->DadosNivelAcessoPagina){
            $this->verificarNivelAcessoPaginaInferior();
            $this->exeAlterarOrdemNivelAcesso();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi alterado a ordem do menu!</div>";
            $this->Resultado = false;
        }
    }

    private function verNivelAcessoPagina()
    {
        $verNivelAcessoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcessoPagina->fullRead("SELECT nivpg.id, nivpg.ordem, nivpg.adm_niveis_acessos_id
                                FROM adm_nivel_acesso_paginas nivpg
                                INNER JOIN adm_niveis_acessos nivac ON nivac.id = nivpg.adm_niveis_acessos_id
                                WHERE nivpg.id =:id AND nivac.ordem >=:ordem", 
                                "id=".$this->DadosId."&ordem=".$_SESSION['ordem_nivel']);
        $this->DadosNivelAcessoPagina = $verNivelAcessoPagina->getResultado();
    }

    private function verificarNivelAcessoPaginaInferior()
    {
        $ordem_superior = $this->DadosNivelAcessoPagina[0]['ordem'] - 1;
        $verNivelAcessoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcessoPagina->fullRead("SELECT id, ordem, adm_niveis_acessos_id FROM adm_nivel_acesso_paginas WHERE ordem =:ordem AND adm_niveis_acessos_id=:adm_niveis_acessos_id", 
                                "ordem={$ordem_superior}&adm_niveis_acessos_id={$this->DadosNivelAcessoPagina[0]['adm_niveis_acessos_id']}");
        $this->DadosNivelAcessoPaginaInferior = $verNivelAcessoPagina->getResultado();
    }

    private function exeAlterarOrdemNivelAcesso()
    {
        $this->Dados['ordem'] = $this->DadosNivelAcessoPagina[0]['ordem'];
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateMoverPraBaixo = new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraBaixo->exeUpdate("adm_nivel_acesso_paginas", $this->Dados, "WHERE id =:id", "id={$this->DadosNivelAcessoPaginaInferior[0]['id']}");

        $this->Dados['ordem'] = $this->DadosNivelAcessoPagina[0]['ordem'] - 1;
        $updateMoverPraCima= new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraCima->exeUpdate("adm_nivel_acesso_paginas", $this->Dados, "WHERE id =:id", "id={$this->DadosNivelAcessoPagina[0]['id']}");

        if($updateMoverPraCima->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do Menu editado com sucesso! </div>";
            $this->Resultado = true;
        } else {
            $this->Resultado = false;
        }
    }

}