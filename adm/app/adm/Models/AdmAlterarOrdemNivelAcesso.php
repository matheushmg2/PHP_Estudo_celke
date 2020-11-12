<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmAlterarOrdemNivelAcesso{

    private $Resultado;
    private $DadosId;
    private $Dados;
    private $DadosNivelAcesso;
    private $DadosNivelAcessoInferior;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function alterarOrdemNivelAcesso($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verNivelAcesso($this->DadosId);
        if($this->DadosNivelAcesso){
            $this->verificarNivelAcessoInferior();
            $this->exeAlterarOrdemNivelAcesso();
        }
    }

    private function verNivelAcesso($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcesso->fullRead("SELECT * FROM adm_niveis_acessos
                                WHERE id =:id AND ordem >:ordem LIMIT :limit", 
                                "id=".$this->DadosId."&ordem=".$_SESSION['ordem_nivel']."&limit=1");
        $this->DadosNivelAcesso = $verNivelAcesso->getResultado();
    }

    private function verificarNivelAcessoInferior()
    {
        $ordem_superior = $this->DadosNivelAcesso[0]['ordem'] - 1;
        $verNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcesso->fullRead("SELECT id, ordem FROM adm_niveis_acessos WHERE ordem =:ordem", 
                                "ordem={$ordem_superior}");
        $this->DadosNivelAcessoInferior = $verNivelAcesso->getResultado();
    }

    private function exeAlterarOrdemNivelAcesso()
    {
        $this->Dados['ordem'] = $this->DadosNivelAcesso[0]['ordem'];
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateMoverPraBaixo = new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraBaixo->exeUpdate("adm_niveis_acessos", $this->Dados, "WHERE id =:id", "id={$this->DadosNivelAcessoInferior[0]['id']}");

        $this->Dados['ordem'] = $this->DadosNivelAcesso[0]['ordem'] - 1;
        $updateMoverPraCima= new \App\adm\Models\helper\AdmUpdate();
        $updateMoverPraCima->exeUpdate("adm_niveis_acessos", $this->Dados, "WHERE id =:id", "id={$this->DadosNivelAcesso[0]['id']}");

        if($updateMoverPraBaixo->getResultado() || $updateMoverPraCima->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Ordem do nível de acesso editado com sucesso! </div>";
            $this->Resultado = true;
        } else {
            $this->Resultado = false;
        }
    }

}