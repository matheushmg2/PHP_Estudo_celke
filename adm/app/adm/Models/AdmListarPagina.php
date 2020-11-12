<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmListarPagina{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5; // Limite de quantidade de registro de (Usuários) na Paginação
    private $ResultadoPg;

    public function getResultadoPg(){
        return $this->ResultadoPg;
    }

    public function listarPagina($PageId = null)
    {
        $this->PageId = (int) $PageId; // Obter em qual página o Usuário está
        $paginacao = new \App\adm\Models\helper\AdmPaginacao(URLADM.'Pagina/listar'); // Obter o link da Página
        $paginacao->condicao($this->PageId, $this->LimiteResultado); // A condição -> passando a página, e o Limite de quantos registro deseja ter na paginação
        $paginacao->paginacao("SELECT COUNT(id) AS num_result FROM adm_paginas"); // Passando a QUERY para contar quantos registro existem no Banco de Dados
        $this->ResultadoPg = $paginacao->getResultado(); // Recupero o resultado

        $listarPagina = new \App\adm\Models\helper\AdmLeitura();
        $listarPagina->fullRead("SELECT pg.id, pg.nome_pagina, tipoPg.tipo tipo_pg, tipoPg.nome nome_tipoPg,situacaoPg.nome nome_situacaoPg, cores.cor cores
                                FROM adm_paginas pg
                                INNER JOIN adm_tipos_paginas tipoPg ON tipoPg.id = pg.adm_tipos_paginas_id
                                INNER JOIN adm_situacoes situacaoPg ON situacaoPg.id = pg.adm_situacoes_id
                                INNER JOIN adm_cores cores ON cores.id = situacaoPg.adm_cores_id
                                ORDER BY pg.id DESC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffSet()}");
        $this->Resultado = $listarPagina->getResultado();
        return $this->Resultado;
    }
    
}