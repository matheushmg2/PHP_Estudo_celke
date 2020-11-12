<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmListarCores{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10; // Limite de quantidade de registro de (Usuários) na Paginação
    private $ResultadoPg;

    public function getResultadoPg(){
        return $this->ResultadoPg;
    }

    public function listarCores($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\adm\Models\helper\AdmPaginacao(URLADM.'Cores/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id) AS num_result FROM adm_cores");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarCores = new \App\adm\Models\helper\AdmLeitura();
        $listarCores->fullRead("SELECT id, nome, cor FROM adm_cores ORDER BY id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffSet()}");

        $this->Resultado = $listarCores->getResultado();
        return $this->Resultado;
    }
    
}