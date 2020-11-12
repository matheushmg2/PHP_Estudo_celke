<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmListarPermissoes {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5; // Limite de quantidade de registro de (Usuários) na Paginação
    private $ResultadoPg;
    private $NivelAcessoId;

    public function getResultadoPg(){
        return $this->ResultadoPg;
    }

    public function listarPermissoes($PageId = null, $NivelAcessoId = null)
    {
        $this->PageId = (int) $PageId; // Obter em qual página o Usuário está
        $this->NivelAcessoId = (int) $NivelAcessoId; 
        $paginacao = new \App\adm\Models\helper\AdmPaginacao(URLADM.'Permissoes/listar', '?niv=' . $this->NivelAcessoId); // Obter o link da Página
        $paginacao->condicao($this->PageId, $this->LimiteResultado); // A condição -> passando a página, e o Limite de quantos registro deseja ter na paginação
        $paginacao->paginacao("SELECT COUNT(nivacPg.id) AS num_result 
                                    FROM adm_nivel_acesso_paginas nivacPg
                                    INNER JOIN adm_paginas pg ON pg.id = nivacPg.adm_paginas_id
                                    INNER JOIN adm_niveis_acessos nivac ON nivac.id = nivacPg.adm_niveis_acessos_id
                                    WHERE nivacPg.adm_niveis_acessos_id =:adm_niveis_acessos_id
                                    AND nivac.ordem >=:ordem
                                    AND (((SELECT permissao FROM adm_nivel_acesso_paginas WHERE adm_paginas_id=nivacPg.adm_niveis_acessos_id AND adm_niveis_acessos_id={$_SESSION['adm_niveis_acessos_id']}) = 1 ) OR (pg.liberado_publico = 1))
                                    ", 
                                    "adm_niveis_acessos_id={$this->NivelAcessoId}&ordem=".$_SESSION['ordem_nivel']); // Passando a QUERY para contar quantos registro existem no Banco de Dados
        $this->ResultadoPg = $paginacao->getResultado(); // Recupero o resultado

        $listarPagina = new \App\adm\Models\helper\AdmLeitura();
        $listarPagina->fullRead("SELECT nivacPg.id, nivacPg.permissao, nivacPg.ordem, nivacPg.dropdown, nivacPg.liberado_menu, pg.nome_pagina
                                FROM adm_nivel_acesso_paginas nivacPg
                                INNER JOIN adm_paginas pg ON pg.id = nivacPg.adm_paginas_id
                                INNER JOIN adm_niveis_acessos nivac ON nivac.id = nivacPg.adm_niveis_acessos_id
                                WHERE nivacPg.adm_niveis_acessos_id =:adm_niveis_acessos_id
                                AND nivac.ordem >=:ordem
                                AND (((SELECT permissao FROM adm_nivel_acesso_paginas WHERE adm_paginas_id=nivacPg.adm_niveis_acessos_id AND adm_niveis_acessos_id={$_SESSION['adm_niveis_acessos_id']}) = 1 ) OR (pg.liberado_publico = 1))
                                ORDER BY nivacPg.ordem ASC LIMIT :limit OFFSET :offset", "adm_niveis_acessos_id={$this->NivelAcessoId}&ordem=".$_SESSION['ordem_nivel']."&limit={$this->LimiteResultado}&offset={$paginacao->getOffSet()}");
        $this->Resultado = $listarPagina->getResultado();
        return $this->Resultado;
    }

    public function verNivelAcesso($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcesso->fullRead("SELECT id, nome FROM adm_niveis_acessos
                                WHERE id =:id LIMIT :limit", 
                                "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verNivelAcesso->getResultado();
        return $this->Resultado;
    }

}