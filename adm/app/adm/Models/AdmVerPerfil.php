<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmVerPerfil {

    private $Resultado;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verPerfil()
    {
        $verPerfil = new \App\adm\Models\helper\AdmLeitura();
        $verPerfil->fullRead("SELECT * FROM adm_usuarios WHERE id=:id LIMIT :limit", "id=".$_SESSION['usuario_id']."&limit=1");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
    }

}