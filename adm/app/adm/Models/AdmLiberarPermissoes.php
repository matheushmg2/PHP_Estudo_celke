<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmLiberarPermissoes {

    private $DadosId;
    private $Dados;
    private $Resultado;
    private $DadosNivelAcessoPagina;


    public function getResultado(){
        return $this->Resultado;
    }

    public function liberarPermissoes($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verNivelAcessoPagina();
        if($this->DadosNivelAcessoPagina){
            $this->alterarPermissao();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi alterado a permissão de acesso a página!</div>";
            $this->Resultado = false;
        }
        
    }

    public function verNivelAcessoPagina()
    {
        $verNivelAcessoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcessoPagina->fullRead("SELECT nivacPg.id, nivacPg.permissao 
                                FROM adm_nivel_acesso_paginas nivacPg
                                INNER JOIN adm_niveis_acessos nivac ON nivac.id = nivacPg.adm_niveis_acessos_id
                                WHERE nivacPg.id =:id AND nivac.ordem >:ordem", 
                                "id={$this->DadosId}&ordem=".$_SESSION['ordem_nivel']);
        $this->DadosNivelAcessoPagina = $verNivelAcessoPagina->getResultado();
    }
    
    private function alterarPermissao()
    {
        if($this->DadosNivelAcessoPagina[0]['permissao'] == 1){
            $this->Dados['permissao'] = 2;
        } else {
            $this->Dados['permissao'] = 1;
        }
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updatePermissao = new \App\adm\Models\helper\AdmUpdate();
        $updatePermissao->exeUpdate("adm_nivel_acesso_paginas", $this->Dados, "WHERE id =:id", "id={$this->DadosId}");
        if($updatePermissao->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Alterado a permissão de acesso a página!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi alterado a permissão de acesso a página!</div>";
            $this->Resultado = false;
        }
    }

}