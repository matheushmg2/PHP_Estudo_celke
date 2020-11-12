<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmCadastrarItensMenu
{

    private $Resultado;
    private $Dados;
    private $UltimoMenu;
        
    public function getResultado()
    {
        return $this->Resultado;
    }

    public function cadastrarItensMenu(array $Dados)
    {
        $this->Dados = $Dados;
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->inserirItensMenu();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirItensMenu()
    {
        $this->Dados['created'] = date('Y-m-d H:i:s');
        $this->verUltimoMenu();
        $this->Dados['ordem'] = $this->UltimoMenu[0]['ordem'] + 1;
                
        $cadastrarItensMenu = new \App\adm\Models\helper\AdmCreate();
            $cadastrarItensMenu->exeCreate("adm_menus", $this->Dados);
        if($cadastrarItensMenu->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Item de menu cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Item de menu não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrarItensMenu()
    {
        $listar = new \App\adm\Models\helper\AdmLeitura();

        $listar->fullRead("SELECT id id_situacao, nome nome_situacao FROM adm_situacoes ORDER BY nome ASC");
        $registro['situacao'] = $listar->getResultado();

        $this->Resultado = ['situacao' => $registro['situacao']];

        return $this->Resultado;

    }


    private function verUltimoMenu()
    {
        $verMenu = new \App\adm\Models\helper\AdmLeitura();
        $verMenu->fullRead("SELECT ordem FROM adm_menus ORDER BY ordem DESC LIMIT :limit", "limit=1");
        $this->UltimoMenu = $verMenu->getResultado();
    }

}
