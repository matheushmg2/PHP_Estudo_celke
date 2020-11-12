<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class SincronizarNivelAcessoPagina
{

    public function sincronizarNivelAcessoPagina()
    {
        $sincronizarNivelAcessoPagina = new \App\adm\Models\AdmSincronizarNivelAcessoPagina();
        $sincronizarNivelAcessoPagina->sincronizarNivelAcessoPagina();
        
        $UrlDestino = URLADM . "NivelAcesso/listar";
        header("Location: $UrlDestino");
    }

}
