<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class AdmPaginas
{
    private $Resultado;
    private $UrlController;
    private $UrlMetodo;

    public function listarPaginas($UrlController = null, $UrlMetodo = null)
    {
        if(!isset($_SESSION['adm_niveis_acessos_id'])){
            $_SESSION['adm_niveis_acessos_id'] = null;
        }
        $this->UrlController = (string) $UrlController;
        $this->UrlMetodo = (string) $UrlMetodo;
        $listar = new \App\adm\Models\helper\AdmLeitura();
        /*$listar->fullRead("SELECT pg.id, tpg.tipo tipo_tpg
                            FROM adm_paginas pg
                            INNER JOIN adm_tipos_paginas tpg 
                            ON tpg.id = pg.adm_tipos_paginas_id 
                            WHERE pg.controller =:controller
                            AND pg.metodo =:metodo
                            LIMIT :limit", "controller={$this->UrlController}&metodo={$this->UrlMetodo}&limit=1");*/

        $listar->fullRead("SELECT pg.id, tpg.tipo tipo_tpg
                            FROM adm_paginas pg
                            INNER JOIN adm_tipos_paginas tpg ON tpg.id=pg.adm_tipos_paginas_id
                            LEFT JOIN adm_nivel_acesso_paginas nivpg ON nivpg.adm_paginas_id = pg.id AND nivpg.adm_niveis_acessos_id =:adm_niveis_acessos_id 
                            WHERE (pg.controller =:controller
                            AND pg.metodo =:metodo) AND ((pg.liberado_publico =:liberado_publico) OR (nivpg.permissao =:permissao)) LIMIT :limit", "adm_niveis_acessos_id={$_SESSION['adm_niveis_acessos_id']}&controller={$this->UrlController}&metodo={$this->UrlMetodo}&liberado_publico=1&permissao=1&limit=1");
        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}
