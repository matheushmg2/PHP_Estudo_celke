<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmEditarPagina
{

    private $Resultado;
    private $Dados;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verPagina($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPagina = new \App\adm\Models\helper\AdmLeitura();
        $verPagina->fullRead("SELECT * FROM adm_paginas WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verPagina->getResultado();
        return $this->Resultado;
    }

    public function editarPagina(array $Dados)
    {
        $this->Dados = $Dados;
        $this->VazioIcones = $this->Dados['icones'];
        unset($this->Dados['icones']);
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
        if ($valCampoVazio->getResultado()) {
            $this->updateEditarPagina();
        } else {
            $this->Resultado = false;
        }
    }

    private function updateEditarPagina()
    {
        $this->Dados['icones'] = $this->VazioIcones;
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $upAltPagina = new \App\adm\Models\helper\AdmUpdate();
        $upAltPagina->exeUpdate("adm_paginas", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upAltPagina->getResultado()) {


            $_SESSION['msg'] = "<div class='alert alert-success'>Página Editada com sucesso.</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Não foi possível Editar a Página!</div>";
            $this->Resultado = false;
        }
    }

    public function listarEditarPagina()
    {
        $listar = new \App\adm\Models\helper\AdmLeitura();
        $listar->fullRead("SELECT id id_grupoPagina, nome nome_grupoPagina FROM adm_grupos_paginas ORDER BY nome ASC");
        $registro['grupoPagina'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_tiposPagina, tipo tipo_tiposPagina, nome nome_tiposPagina FROM adm_tipos_paginas ORDER BY nome ASC");
        $registro['tiposPagina'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_situacao, nome nome_situacao FROM adm_situacoes ORDER BY nome ASC");
        $registro['situacao'] = $listar->getResultado();

        $this->Resultado = ['grupoPagina' => $registro['grupoPagina'], 'tiposPagina' => $registro['tiposPagina'], 'situacao' => $registro['situacao']];

        return $this->Resultado;

    }
}
