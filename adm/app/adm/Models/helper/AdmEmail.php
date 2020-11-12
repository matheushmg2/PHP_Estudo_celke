<?php

namespace App\adm\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmEmail{
    private $Resultado;
    private $Dados;
    private $Formato;

    /**
     * Get the value of Resultado
     */ 
    public function getResultado()
    {
        return $this->Resultado;
    }

    public function valEmail($Email)
    {
        $this->Dados = (string) $Email;
        $this->Formato = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if(preg_match($this->Formato, $this->Dados)){ 
            $this->Resultado = true;
        }else{
            $this->alertas('Generica', 'danger', 'danger', 'Email Inválido!');
            $this->Resultado = false;
        }
    }
    /**
     * alertaSessaoJS(ICONES['success', 'error', 'warning', 'info'], TÍTULO, MENSAGEM)
     * 
     * alertaSessaoGenerica(ICONES['success', 'danger', 'warning', 'info'], TIPO DO ALERTA['success', 'danger', 'warning', 'info'], MENSAGEM)
     */
    private function alertas($qlAlerta, $icon, $escolha, $msg, $tempo = null){
        $alerta = new \App\adm\Models\helper\AdmAlertaSessao();
        switch($qlAlerta){
            case 'JS':
                $alerta->alertaSessaoJS($icon, $escolha, $msg, $tempo);
            break;
            case 'Generica':
                $alerta->alertaSessaoGenerica($icon, $escolha, $msg);
            break;
        }
    }

}