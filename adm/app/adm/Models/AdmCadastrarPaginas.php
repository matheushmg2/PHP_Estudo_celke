<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmCadastrarPaginas
{

    private $Resultado;
    private $Dados;
    private $VazioIcones;
    private $UltimoIdInserido;
    private $ListarNivelAcesso;
    private $ListarNivelAcessoPagina;
    private $DadosNivelAcessoPagina;
    private $NivelAcessoId;
    private $DadosArrayNivelAcessoPg = [];

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function cadastrarPaginas(array $Dados)
    {
        $this->Dados = $Dados;
        $this->VazioIcones = $this->Dados['icones'];
        unset($this->Dados['icones']);
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->inserirPagina();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirPagina()
    {
        $this->DadosArrayNivelAcessoPg['dropdown'] = $this->Dados['dropdown'];
        $this->DadosArrayNivelAcessoPg['liberado_menu'] = $this->Dados['liberado_menu'];
        $this->DadosArrayNivelAcessoPg['adm_menus_id'] = $this->Dados['adm_menus_id'];
        unset($this->Dados['dropdown'], $this->Dados['liberado_menu'], $this->Dados['adm_menus_id']);
        $this->Dados['icones'] = $this->VazioIcones;
        $this->Dados['created'] = date('Y-m-d H:i:s');

        var_dump($this->Dados);
        
        $cadastrarPaginas = new \App\adm\Models\helper\AdmCreate();
        $this->UltimoIdInserido = $cadastrarPaginas->getResultado();
            $this->inserirPermissaoNivelAcessoPagina();
            $cadastrarPaginas->exeCreate("adm_paginas", $this->Dados);
        if($cadastrarPaginas->getResultado()){
            $this->UltimoIdInserido = $cadastrarPaginas->getResultado();
            $this->inserirPermissaoNivelAcessoPagina();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Página não cadastrada!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrarPagina()
    {
        $listar = new \App\adm\Models\helper\AdmLeitura();
        $listar->fullRead("SELECT id id_grupoPagina, nome nome_grupoPagina FROM adm_grupos_paginas ORDER BY nome ASC");
        $registro['grupoPagina'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_tiposPagina, tipo tipo_tiposPagina, nome nome_tiposPagina FROM adm_tipos_paginas ORDER BY nome ASC");
        $registro['tiposPagina'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_situacao, nome nome_situacao FROM adm_situacoes ORDER BY nome ASC");
        $registro['situacao'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_menu, nome nome_menu FROM adm_menus ORDER BY id");
        $registro['menu'] = $listar->getResultado();

        $this->Resultado = ['grupoPagina' => $registro['grupoPagina'], 'tiposPagina' => $registro['tiposPagina'], 'situacao' => $registro['situacao'] , 'menu' => $registro['menu']];

        return $this->Resultado;

    }

    private function inserirPermissaoNivelAcessoPagina()
    {
        $this->listarNivelAcesso();
        foreach($this->ListarNivelAcesso as $nivelAcesso){
            extract($nivelAcesso);
            $this->NivelAcessoId = $id;
            $this->pesquisarUltimaOrdemNivelAcessoPagina();
            $this->DadosNivelAcessoPagina['permissao'] = ($id == 1 ? 1 : 2);
            $this->DadosNivelAcessoPagina['ordem'] = $this->ListarNivelAcessoPagina[0]['ordem'] + 1;
            $this->DadosNivelAcessoPagina['dropdown'] = $this->DadosArrayNivelAcessoPg['dropdown'];
            $this->DadosNivelAcessoPagina['liberado_menu'] = $this->DadosArrayNivelAcessoPg['liberado_menu'];
            $this->DadosNivelAcessoPagina['adm_menus_id'] = $this->DadosArrayNivelAcessoPg['adm_menus_id'];
            $this->DadosNivelAcessoPagina['adm_niveis_acessos_id'] = $id;
            $this->DadosNivelAcessoPagina['adm_paginas_id'] = $this->UltimoIdInserido;
            $this->DadosNivelAcessoPagina['created'] = date('Y-m-d H:i:s');

            $cadastrarNivelAcessoPagina = new \App\adm\Models\helper\AdmCreate();
            $cadastrarNivelAcessoPagina->exeCreate("adm_nivel_acesso_paginas", $this->DadosNivelAcessoPagina);
            if($cadastrarNivelAcessoPagina->getResultado()){
                $_SESSION['msg'] = "<div class='alert alert-success'>Página cadastrada com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-warning'>Página cadastrada com sucesso. Erro ao liberar a permissão de acesso ao nível de acesso!</div>";
                $this->Resultado = false;
            }
        }
    }

    private function listarNivelAcesso()
    {
        $listarNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $listarNivelAcesso->fullRead("SELECT id FROM adm_niveis_acessos");
        $this->ListarNivelAcesso = $listarNivelAcesso->getResultado();
    }

    private function pesquisarUltimaOrdemNivelAcessoPagina()
    {
        $listarNivelAcessoPagina = new \App\adm\Models\helper\AdmLeitura();
        $listarNivelAcessoPagina->fullRead("SELECT ordem FROM adm_nivel_acesso_paginas ORDER BY ordem DESC");
        $this->ListarNivelAcessoPagina = $listarNivelAcessoPagina->getResultado();

        if(!$this->ListarNivelAcessoPagina){
            $this->ListarNivelAcessoPagina[0]['ordem'] = 0;
        }

    }
}
