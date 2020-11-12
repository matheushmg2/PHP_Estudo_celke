<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmListarItensMenu{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5; // Limite de quantidade de registro de (Usuários) na Paginação
    private $ResultadoPg;

    public function getResultadoPg(){
        return $this->ResultadoPg;
    }

    public function listarItensMenu($PageId = null)
    {
        $this->PageId = (int) $PageId; // Obter em qual página o Usuário está
        $paginacao = new \App\adm\Models\helper\AdmPaginacao(URLADM.'Menu/listar'); // Obter o link da Página
        $paginacao->condicao($this->PageId, $this->LimiteResultado); // A condição -> passando a página, e o Limite de quantos registro deseja ter na paginação
        $paginacao->paginacao("SELECT COUNT(id) AS num_result FROM adm_menus"); // Passando a QUERY para contar quantos registro existem no Banco de Dados
        $this->ResultadoPg = $paginacao->getResultado(); // Recupero o resultado

        $listarItensMenu = new \App\adm\Models\helper\AdmLeitura();
        $listarItensMenu->fullRead("SELECT menu.*, situacao.nome nome_situacao, cores.cor cores
                                FROM adm_menus menu
                                INNER JOIN adm_situacoes situacao ON situacao.id = menu.adm_situacoes_id
                                INNER JOIN adm_cores cores ON cores.id = situacao.adm_cores_id
                                ORDER BY ordem ASC LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffSet()}");
        $this->Resultado = $listarItensMenu->getResultado();
        return $this->Resultado;
    }
    
}