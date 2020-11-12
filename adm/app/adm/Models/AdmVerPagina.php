<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmVerPagina {

    private $Resultado;
    private $DadosId;

    public function verPagina($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPagina = new \App\adm\Models\helper\AdmLeitura();
        $verPagina->fullRead("SELECT pg.*, grupoPg.nome nome_grupoPg, tipoPg.tipo tipo_pg, tipoPg.nome nome_tipoPg, situacao.nome nome_situacaoPg, cor.cor cores
                                FROM adm_paginas pg
                                INNER JOIN adm_grupos_paginas grupoPg ON grupoPg.id = pg.adm_grupos_paginas_id
                                INNER JOIN adm_tipos_paginas tipoPg ON tipoPg.id = pg.adm_tipos_paginas_id
                                INNER JOIN adm_situacoes situacao ON situacao.id = pg.adm_situacoes_id
                                INNER JOIN adm_cores cor ON cor.id = situacao.adm_cores_id 
                                WHERE pg.id=:id LIMIT :limit", "id=".$this->DadosId."&limit=1");

        $this->Resultado = $verPagina->getResultado();
        return $this->Resultado;
    }

}