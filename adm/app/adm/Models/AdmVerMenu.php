<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmVerMenu {

    private $Resultado;
    private $DadosId;

    public function verItensMenu($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verItensMenu = new \App\adm\Models\helper\AdmLeitura();
        $verItensMenu->fullRead("SELECT menu.*, situacao.nome nome_situacao, cores.cor cores
                                FROM adm_menus menu
                                INNER JOIN adm_situacoes situacao ON situacao.id = menu.adm_situacoes_id
                                INNER JOIN adm_cores cores ON cores.id = situacao.adm_cores_id
                                WHERE menu.id =:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verItensMenu->getResultado();
        return $this->Resultado;
    }

}