<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmEditarItensMenu
{

    private $Resultado;
    private $Dados;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verMenu($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verMenu = new \App\adm\Models\helper\AdmLeitura();
        $verMenu->fullRead("SELECT * FROM adm_menus WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verMenu->getResultado();
        return $this->Resultado;
    }

    public function editarItensMenu(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->updateEditarItensMenu();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditarItensMenu()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $upAltPagina = new \App\adm\Models\helper\AdmUpdate();
        $upAltPagina->exeUpdate("adm_menus", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upAltPagina->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Item do Mudo Editado com sucesso.</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Não foi possível Editar o Item Menu!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adm\Models\helper\AdmLeitura();

        $listar->fullRead("SELECT id id_situacao, nome nome_situacao FROM adm_situacoes ORDER BY nome ASC");
        $registro['situacao'] = $listar->getResultado();

        $this->Resultado = ['situacao' => $registro['situacao']];

        return $this->Resultado;

    }
}
