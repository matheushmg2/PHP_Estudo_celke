<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmEditarSituacao
{

    private $Resultado;
    private $Dados;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verSituacao($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verEditarSituacao = new \App\adm\Models\helper\AdmLeitura();
        $verEditarSituacao->fullRead("SELECT * FROM adm_situacoes WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verEditarSituacao->getResultado();
        return $this->Resultado;
    }

    public function editarSituacao(array $Dados)
    {
        $this->Dados = $Dados;
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
            $this->updateEditarSituacao();
        if ($valCampoVazio->getResultado()) {
        } else {
            $this->Resultado = false;
        }
    }


    private function updateEditarSituacao()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $upEditarSituacao = new \App\adm\Models\helper\AdmUpdate();
        $upEditarSituacao->exeUpdate("adm_situacoes", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upEditarSituacao->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Situação atualizada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A situação não foi atualizada!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adm\Models\helper\AdmLeitura();
        $listar->fullRead("SELECT id id_cor, nome nome_cor FROM adm_cores ORDER BY nome ASC");
        $registro['cores'] = $listar->getResultado();

        $this->Resultado = array('cores' => $registro['cores']);
        return $this->Resultado;
    }
}
