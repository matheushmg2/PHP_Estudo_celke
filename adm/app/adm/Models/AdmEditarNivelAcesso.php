<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmEditarNivelAcesso{

    private $Resultado;
    private $DadosId;
    private $Dados;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verNivelAcesso($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcesso->fullRead("SELECT * FROM adm_niveis_acessos
                                WHERE id =:id AND ordem >=:ordem LIMIT :limit", 
                                "id=".$this->DadosId."&ordem=".$_SESSION['ordem_nivel']."&limit=1");
        $this->Resultado = $verNivelAcesso->getResultado();
        return $this->Resultado;
    }

    public function alterarNivelAcesso(array $Dados)
    {
        $this->Dados = $Dados;
        
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if($valCampoVazio->getResultado()){
            $this->updateEditarNivelAcesso();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditarNivelAcesso()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $updateNivelAcesso = new \App\adm\Models\helper\AdmUpdate();
        $updateNivelAcesso->exeUpdate("adm_niveis_acessos", $this->Dados, "WHERE id =:id", "id=".$this->Dados['id']);

        if($updateNivelAcesso->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>Nível de acesso editado com sucesso! </div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O nível de acesso não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

}