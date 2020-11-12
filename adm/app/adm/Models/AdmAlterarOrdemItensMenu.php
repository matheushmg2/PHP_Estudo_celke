<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmAlterarOrdemItensMenu{

    private $Resultado;
    private $DadosId;
    private $Dados;
    private $DadosMenu;
    private $DadosMenuInferior;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function alterarOrdemItensMenu($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verMenu($this->DadosId);
        if($this->DadosMenu){
            $this->verificarMenuInferior();
            if($this->DadosMenuInferior){
                $this->exeAlterarOrdemItensMenu();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Não foi alterado a ordem do itens do menu!</div>";
                $this->Resultado = false;
            }
        } 
    }

    private function verMenu()
    {
        $verMenu = new \App\adm\Models\helper\AdmLeitura();
        $verMenu->fullRead("SELECT * FROM adm_menus WHERE id =:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->DadosMenu = $verMenu->getResultado();
    }

    private function verificarMenuInferior()
    {
        $ordem_superior = $this->DadosMenu[0]['ordem'] - 1;
        $verMenu = new \App\adm\Models\helper\AdmLeitura();
        $verMenu->fullRead("SELECT id, ordem FROM adm_menus WHERE ordem =:ordem", "ordem={$ordem_superior}");
        $this->DadosMenuInferior = $verMenu->getResultado();
    }

    private function exeAlterarOrdemItensMenu()
    {
        $this->Dados['ordem'] = $this->DadosMenu[0]['ordem'];
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateMoverPraBaixo = new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraBaixo->exeUpdate("adm_menus", $this->Dados, "WHERE id =:id", "id={$this->DadosMenuInferior[0]['id']}");

        $this->Dados['ordem'] = $this->DadosMenu[0]['ordem'] - 1;
        $updateMoverPraCima= new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraCima->exeUpdate("adm_menus", $this->Dados, "WHERE id =:id", "id={$this->DadosMenu[0]['id']}");

        if($updateMoverPraCima->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do Menu editado com sucesso! </div>";
            $this->Resultado = true;
        } else {
            $this->Resultado = false;
        }
    }

}