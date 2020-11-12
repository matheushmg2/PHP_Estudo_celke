<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmListarUsuario{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 5; // Limite de quantidade de registro de (Usuários) na Paginação
    private $ResultadoPg;

    public function getResultadoPg(){
        return $this->ResultadoPg;
    }

    public function listarUsuarios($PageId = null)
    {
        $this->PageId = (int) $PageId; // Obter em qual página o Usuário está
        $paginacao = new \App\adm\Models\helper\AdmPaginacao(URLADM.'usuarios/listar'); // Obter o link da Página
        $paginacao->condicao($this->PageId, $this->LimiteResultado); // A condição -> passando a página, e o Limite de quantos registro deseja ter na paginação
        $paginacao->paginacao("SELECT COUNT(usuario.id) AS num_result 
                                FROM adm_usuarios usuario
                                INNER JOIN adm_niveis_acessos nivac ON nivac.id = usuario.adm_niveis_acessos_id
                                WHERE nivac.ordem >=:ordem", "ordem=".$_SESSION['ordem_nivel']); // Passando a QUERY para contar quantos registro existem no Banco de Dados
        $this->ResultadoPg = $paginacao->getResultado(); // Recupero o resultado

        $listarUsuario = new \App\adm\Models\helper\AdmLeitura();
        $listarUsuario->fullRead("SELECT usuario.id, usuario.nome, usuario.email, situacaoUsuario.nome nome_situacao, cores.cor cores
                                FROM adm_usuarios usuario
                                INNER JOIN adm_situacoes situacaoUsuario ON situacaoUsuario.id = usuario.adm_situacoes_id
                                INNER JOIN adm_cores cores ON cores.id = situacaoUsuario.adm_cores_id
                                INNER JOIN adm_niveis_acessos nivac ON nivac.id = usuario.adm_niveis_acessos_id
                                WHERE nivac.ordem >=:ordem
                                ORDER BY id DESC LIMIT :limit OFFSET :offset", "ordem=".$_SESSION['ordem_nivel']."&limit={$this->LimiteResultado}&offset={$paginacao->getOffSet()}");
        $this->Resultado = $listarUsuario->getResultado();
        return $this->Resultado;
    }
    
}