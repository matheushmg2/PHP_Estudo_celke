<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmApagarPagina
{

    private $Resultado;
    private $DadosId;
    private $DadosUpdateNivelAcessoPagina;
    private $DadosNivelAcessoPagina;
    private $DadosNivelAcesso;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarPagina($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->pesquisarNivelAcesso();
        $apagarPagina = new \App\adm\Models\helper\AdmDelete();
        $apagarPagina->exeDelete("adm_paginas", "WHERE id =:id", "id={$this->DadosId}");
        if ($apagarPagina->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success text-center'><i class='fas fa-exclamation-triangle'></i> Página deleta..</div>";
            $this->Resultado = true;

        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger text-center'><i class='fas fa-exclamation-triangle'></i> Página deleta Não..</div>";
            $this->Resultado = false;
        }
    }
    private function pesquisarNivelAcesso()
    {
        $verNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcesso->fullRead("SELECT id id_nivelAcesso FROM adm_niveis_acessos ORDER BY id ASC");
        $this->DadosNivelAcesso = $verNivelAcesso->getResultado();
        $this->pesquisarNivelAcessoPagina();
    }

    private function pesquisarNivelAcessoPagina()
    {
        if($this->DadosNivelAcesso){
            foreach ($this->DadosNivelAcesso as $nivelAcesso) {
                extract($nivelAcesso);
                $verNivelAcessoPagina = new \App\adm\Models\helper\AdmLeitura();
                $verNivelAcessoPagina->fullRead("SELECT id id_nivelAcessoPagina, ordem 
                                FROM adm_nivel_acesso_paginas 
                                WHERE adm_niveis_acessos_id =:Aadm_niveis_acessos_id AND ordem > 
                                (SELECT ordem FROM adm_nivel_acesso_paginas 
                                WHERE adm_paginas_id =:adm_paginas_id 
                                AND adm_niveis_acessos_id =:Badm_niveis_acessos_id) ORDER BY id ASC", 
                                "Aadm_niveis_acessos_id={$id_nivelAcesso}&adm_paginas_id={$this->DadosId}&Badm_niveis_acessos_id={$id_nivelAcesso}");
                $this->DadosNivelAcessoPagina = $verNivelAcessoPagina->getResultado();

                $this->updateOrdemNivelAcessoPagina();

                $apagarNivelAcessoPagina = new \App\adm\Models\helper\AdmDelete();
                $apagarNivelAcessoPagina->exeDelete("adm_nivel_acesso_paginas", "WHERE adm_paginas_id =:adm_paginas_id AND adm_niveis_acessos_id=:adm_niveis_acessos_id", "adm_paginas_id={$this->DadosId}&adm_niveis_acessos_id={$id_nivelAcesso}");
            }
        }
    }

    private function updateOrdemNivelAcessoPagina()
    {
        if($this->DadosNivelAcessoPagina){
            foreach ($this->DadosNivelAcessoPagina as $nivelAcessoPagina) {
                extract($nivelAcessoPagina);
                $this->DadosUpdateNivelAcessoPagina['ordem'] = $ordem - 1;
                $this->DadosUpdateNivelAcessoPagina['modified']  = date('Y-m-d H:i:s');
                $updateAlterarNivelAcessoPagina = new \App\adm\Models\helper\AdmUpdate();
                $updateAlterarNivelAcessoPagina->exeUpdate("adm_nivel_acesso_paginas", $this->DadosUpdateNivelAcessoPagina, "WHERE id =:id", "id=" . $id_nivelAcessoPagina);
            }
        }
    }

}
