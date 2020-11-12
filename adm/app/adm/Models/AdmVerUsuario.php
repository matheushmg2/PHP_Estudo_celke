<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmVerUsuario {

    private $Resultado;
    private $DadosId;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verUsuario($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \App\adm\Models\helper\AdmLeitura();
        $verPerfil->fullRead("SELECT usuario.*, nivac.nome nome_nivel, situacao.nome nome_situacao, cor.cor cores
                                FROM adm_usuarios usuario
                                INNER JOIN adm_niveis_acessos nivac ON nivac.id = usuario.adm_niveis_acessos_id
                                INNER JOIN adm_situacoes situacao ON situacao.id = usuario.adm_situacoes_id
                                INNER JOIN adm_cores cor ON cor.id = situacao.adm_cores_id 
                                WHERE usuario.id=:id AND nivac.ordem >=:ordem LIMIT :limit", "id=".$this->DadosId."&ordem=".$_SESSION['ordem_nivel']."&limit=1");

        /* $verPerfil->fullRead("SELECT usuario.*, nivac.nome nome_nivel, situacao.nome nome_situacao, cor.cor cores
                                FROM adm_usuarios usuario
                                INNER JOIN adm_niveis_acessos nivac ON nivac.id = usuario.adm_niveis_acessos_id
                                INNER JOIN adm_situacoes situacao ON situcao.id = usuario.adm_situacoes_id
                                INNER JOIN adm_cores cor ON cor.id = situacao.adm_cores_id 
                                WHERE usuario.id=:id LIMIT :limit", "id=".$this->DadosId."&limit=1");*/
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
    }

}