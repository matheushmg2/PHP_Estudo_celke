<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmSincronizarNivelAcessoPagina {

    private $Resultado;
    private $ListaNivelAcesso;
    private $DadosNivelAcessoPagina;
    private $NivelAcessoId;
    private $PaginaId;
    private $ListarPagina;
    private $ListarNivelAcessoPagina;
    private $ListarNivelAcessoPaginaOrdenada;
    private $LiberadoPublico;
    private $cont;

    public function getResultado(){
        return $this->Resultado;
    }

    public function sincronizarNivelAcessoPagina()
    {
        /*$this->listaNivelAcesso();
        if($this->ListaNivelAcesso){
            $this->listarPagina();
            if($this->ListarPagina){
                echo "<pre> ListaNivelAcesso <br>" ;
                var_dump($this->ListaNivelAcesso);
                //$this->lerNivelAcesso();
                
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhum nível de acesso encontrado!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Nenhum nível de acesso encontrado!</div>";
            $this->Resultado = false;
        }*/
        $this->inserirPermissaoNivelAcesso();
    }

    private function listaNivelAcesso()
    {
        $listaNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $listaNivelAcesso->fullRead("SELECT id FROM adm_niveis_acessos");
        $this->ListaNivelAcesso = $listaNivelAcesso->getResultado();
        //echo "<pre>";
        //echo $this->NivelAcessoId . " - - " . $this->PaginaId . "- - ";
        //var_dump($this->ListaNivelAcesso);
        
    }

    private function listarPagina()
    {
        $listarPagina = new \App\adm\Models\helper\AdmLeitura();
        $listarPagina->fullRead("SELECT id, liberado_publico FROM adm_paginas");
        $this->ListarPagina = $listarPagina->getResultado();
        
    }

    private function lerNivelAcesso()
    {
        
        $this->pesquisarUltimaOrdemNivelAcessoPagina();
        foreach ($this->ListaNivelAcesso as $nivelAcesso) {
            extract($nivelAcesso);
            $this->NivelAcessoId = $id;
            //$this->lerPagina();
        }
    }

    private function lerPagina()
    {
        foreach ($this->ListarPagina as $listarPagina) {
            extract($listarPagina);
            $this->PaginaId = $id;
            $this->LiberadoPublico = $liberado_publico;
            //$this->pesquisarCadastroNivelAcessoPermissao();
        }
    }

    private function pesquisarCadastroNivelAcessoPermissao()
    {
        $listaNivelAcessoPagina = new \App\adm\Models\helper\AdmLeitura();
        $listaNivelAcessoPagina->fullRead("SELECT id, adm_niveis_acessos_id, adm_paginas_id FROM adm_nivel_acesso_paginas
                                            WHERE adm_niveis_acessos_id =:adm_niveis_acessos_id
                                            AND adm_paginas_id =:adm_paginas_id
                                            ", "adm_niveis_acessos_id={$this->NivelAcessoId}&adm_paginas_id={$this->PaginaId}");
        $this->ListarNivelAcessoPagina = $listaNivelAcessoPagina->getResultado();
        //var_dump($this->ListarNivelAcessoPagina);
    }

    
    private function inserirPermissaoNivelAcesso()
    {
        $this->listaNivelAcesso();
        $this->listarPagina();
        
        $this->lerPagina();
        
        //echo "<pre> ListarPagina <br>";
        //var_dump($this->ListarPagina);
        if($this->ListarPagina){
                foreach($this->ListaNivelAcesso as $nivelAcesso){
                    extract($nivelAcesso);
                    $this->NivelAcessoId = $id;
                    $this->pesquisarUltimaOrdemNivelAcessoPagina();
                    $this->DadosNivelAcessoPagina['permissao'] = ((($this->NivelAcessoId == 1) OR ($this->LiberadoPublico == 1)) ? 1 : 2);
        
                    $this->DadosNivelAcessoPagina['ordem'] = $this->ListarNivelAcessoPaginaOrdenada[0]['ordem'] + 1;
                    
                    $this->DadosNivelAcessoPagina['dropdown'] = 2;
                    $this->DadosNivelAcessoPagina['liberado_menu'] = 2;
                    $this->DadosNivelAcessoPagina['adm_menus_id'] = 2;
                    
                    $this->DadosNivelAcessoPagina['adm_niveis_acessos_id'] = $this->NivelAcessoId;
                    $this->DadosNivelAcessoPagina['adm_paginas_id'] = $this->PaginaId;
                    $this->DadosNivelAcessoPagina['created'] = date("Y-m-d H:i:s");

                    echo "<pre> DadosNivelAcessoPagina <br>";
                    var_dump($this->DadosNivelAcessoPagina);
                }
        }
        
        
        /*$cadastrarNivelAcessoPagina = new \App\adm\Models\helper\AdmCreate();
        $cadastrarNivelAcessoPagina->exeCreate("adm_nivel_acesso_paginas", $this->DadosNivelAcessoPagina);
        if($cadastrarNivelAcessoPagina->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Permissões aos Usuários concebida!</div>";
            $this->Resultado = false;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Impossível Inserir a Permissão ao Nível de Acesso</div>";
            $this->Resultado = false;
        }*/

    }

    private function pesquisarUltimaOrdemNivelAcessoPagina()
    {
        $listarNivelAcessoPagina = new \App\adm\Models\helper\AdmLeitura();
        $listarNivelAcessoPagina->fullRead("SELECT ordem FROM adm_nivel_acesso_paginas ORDER BY ordem DESC");
        $this->ListarNivelAcessoPaginaOrdenada = $listarNivelAcessoPagina->getResultado();

        //echo "<pre> DadosNivelAcessoPagina";
        //        var_dump($this->ListarNivelAcessoPaginaOrdenada[0]);
        if(!$this->ListarNivelAcessoPaginaOrdenada){
            $this->ListarNivelAcessoPaginaOrdenada[0]['ordem'] = 0;
        }

    }

}