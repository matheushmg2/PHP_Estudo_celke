<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmVerNivelAcesso{

    private $Resultado;
    private $DadosId;
    

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verNivelAcesso($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        /*$verNivelAcesso->fullRead("SELECT * FROM adm_niveis_acessos
                                WHERE id =:id AND ordem >=:ordem LIMIT :limit", 
                                "id=".$this->DadosId."&ordem=".$_SESSION['ordem_nivel']."&limit=1");*/
        
        $verNivelAcesso->fullRead("SELECT acesso.*, COUNT(user.adm_niveis_acessos_id) qnt_user
                                FROM adm_niveis_acessos acesso 
                                INNER JOIN adm_usuarios user 
                                WHERE acesso.id =:id AND acesso.ordem >=:ordem AND user.adm_niveis_acessos_id =:adm_niveis_acessos_id LIMIT :limit", "id=".$this->DadosId."&ordem=".$_SESSION['ordem_nivel']."&adm_niveis_acessos_id=".$this->DadosId."&limit=1");
        $this->Resultado = $verNivelAcesso->getResultado();
        return $this->Resultado;
    }

}