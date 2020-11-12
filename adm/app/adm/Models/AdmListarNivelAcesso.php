<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmListarNivelAcesso{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 10; // Limite de quantidade de registro de (Usuários) na Paginação
    private $ResultadoPg;

    public function getResultadoPg(){
        return $this->ResultadoPg;
    }

    public function listarNivelAcesso($PageId = null)
    {
        $this->PageId = (int) $PageId; // Obter em qual página o Usuário está
        $paginacao = new \App\adm\Models\helper\AdmPaginacao(URLADM.'NivelAcesso/listar'); // Obter o link da Página
        $paginacao->condicao($this->PageId, $this->LimiteResultado); // A condição -> passando a página, e o Limite de quantos registro deseja ter na paginação
        $paginacao->paginacao("SELECT COUNT(nivac.id) AS num_result 
                                FROM adm_niveis_acessos nivac
                                WHERE nivac.ordem >=:ordem", "ordem=".$_SESSION['ordem_nivel']); // Passando a QUERY para contar quantos registro existem no Banco de Dados
        $this->ResultadoPg = $paginacao->getResultado(); // Recupero o resultado

        $listarNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $listarNivelAcesso->fullRead("SELECT nivac.id, nivac.nome, nivac.ordem
                                FROM adm_niveis_acessos nivac
                                WHERE nivac.ordem >=:ordem
                                ORDER BY ordem ASC LIMIT :limit OFFSET :offset", "ordem=".$_SESSION['ordem_nivel']."&limit={$this->LimiteResultado}&offset={$paginacao->getOffSet()}");
        $this->Resultado = $listarNivelAcesso->getResultado();
        return $this->Resultado;
    }
    
}