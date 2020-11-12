<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmEditarNivelAcessoPaginaMenu{

    private $Resultado;
    private $DadosId;
    private $Dados;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verNivelAcessoPagina($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verNivelAcessoPagina = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcessoPagina->fullRead("SELECT * FROM adm_nivel_acesso_paginas
                                WHERE id =:id LIMIT :limit", 
                                "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verNivelAcessoPagina->getResultado();
        return $this->Resultado;
    }

    public function alterarMenu(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);

        if($valCampoVazio->getResultado()){
            $this->updateEditarMenu();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditarMenu()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateAlterarNivelAcessoPagina = new \App\adm\Models\helper\AdmUpdate();
        $updateAlterarNivelAcessoPagina->exeUpdate("adm_nivel_acesso_paginas", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);

        if($updateAlterarNivelAcessoPagina->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Item de menu da página atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O item de menu da página não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrarPagina()
    {
        $listar = new \App\adm\Models\helper\AdmLeitura();
        $listar->fullRead("SELECT id id_menu, nome nome_menu FROM adm_menus ORDER BY nome ASC");
        $registro['menu'] = $listar->getResultado();

        $this->Resultado = ['menu' => $registro['menu']];

        return $this->Resultado;

    }

}