<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmListarSituacao{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10; // Limite de quantidade de registro de (Usuários) na Paginação
    private $ResultadoPg;

    public function getResultadoPg(){
        return $this->ResultadoPg;
    }

    public function listarSituacao($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\adm\Models\helper\AdmPaginacao(URLADM.'Situacao/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id) AS num_result FROM adm_situacoes");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarCores = new \App\adm\Models\helper\AdmLeitura();
        $listarCores->fullRead("SELECT situacao.*, cores.cor cores 
                                FROM adm_situacoes situacao 
                                INNER JOIN adm_cores cores ON cores.id = situacao.adm_cores_id
                                ORDER BY situacao.id ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffSet()}");

        $this->Resultado = $listarCores->getResultado();
        return $this->Resultado;
    }
    
}