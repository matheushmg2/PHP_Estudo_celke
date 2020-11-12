<?php

namespace App\adm\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmEmailUnico{

    private $Resultado;
    private $Email;
    private $EditarUnico;
    private $DadoId;

    /**
     * Get the value of Resultado
     */ 
    public function getResultado()
    {
        return $this->Resultado;
    }

    public function valEmailUnico($Email, $EditarUnico = null, $DadoId = null)
    {
        $this->Email = (string) $Email;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valEmailUnico = new \App\adm\Models\helper\AdmLeitura();
        if(!empty($this->EditarUnico) && $this->EditarUnico == true){
            $valEmailUnico->fullRead("SELECT id FROM adm_usuarios WHERE email =:email AND id <>:id LIMIT :limit", "email={$this->Email}&id={$this->DadoId}&limit=1");
        } else {
            $valEmailUnico->fullRead("SELECT id FROM adm_usuarios WHERE email =:email LIMIT :limit", "email={$this->Email}&limit=1");
        }
        
        $this->Resultado = $valEmailUnico->getResultado();
        if(!empty($this->Resultado)){
            $this->alertas('Generica', 'warning', 'warning', 'Já existe esse Email');
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
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