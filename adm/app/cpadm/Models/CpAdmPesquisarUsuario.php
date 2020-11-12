<?php

namespace App\cpadm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class CpAdmPesquisarUsuario{

    private $Resultado;
    private $LimiteResultado = 5; // Limite de quantidade de registro de (Usuários) na Paginação

    private $PesquisarUsuario;

    public function getResultadoPg(){
        return $this->ResultadoPg;
    }

    public function PesquisaUsuarios($PesquisarUsuario = null)
    {
        $this->PesquisarUsuario = (string) $PesquisarUsuario;
        echo $this->PesquisarUsuario;
        $this->ResultadoPg = null;

        $listarUsuario = new \App\adm\Models\helper\AdmLeitura();
        $listarUsuario->fullRead("SELECT usuario.id, usuario.nome, usuario.email, situacaoUsuario.nome nome_situacao, cores.cor cores
                                FROM adm_usuarios usuario
                                INNER JOIN adm_situacoes situacaoUsuario ON situacaoUsuario.id = usuario.adm_situacoes_id
                                INNER JOIN adm_cores cores ON cores.id = situacaoUsuario.adm_cores_id
                                INNER JOIN adm_niveis_acessos nivac ON nivac.id = usuario.adm_niveis_acessos_id
                                WHERE nivac.ordem >=:ordem AND (usuario.nome LIKE '%' :nome '%' OR usuario.email LIKE '%' :email '%')
                                ORDER BY id DESC LIMIT :limit", "ordem=".$_SESSION['ordem_nivel']."&nome=".$this->PesquisarUsuario."&email=".$this->PesquisarUsuario."&limit={$this->LimiteResultado}");
        $this->Resultado = $listarUsuario->getResultado();

        return $this->Resultado;
    }
    
}