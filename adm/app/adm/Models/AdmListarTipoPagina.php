<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmListarTipoPagina{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10; // Limite de quantidade de registro de (Usuários) na Paginação
    private $ResultadoPg;

    public function getResultadoPg(){
        return $this->ResultadoPg;
    }

    public function listarTipoPagina($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\adm\Models\helper\AdmPaginacao(URLADM.'TipoPagina/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(id) AS num_result FROM adm_tipos_paginas");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarGrupoPagina = new \App\adm\Models\helper\AdmLeitura();
        $listarGrupoPagina->fullRead("SELECT * FROM adm_tipos_paginas ORDER BY ordem ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffSet()}");

        $this->Resultado = $listarGrupoPagina->getResultado();
        return $this->Resultado;
    }
    
}