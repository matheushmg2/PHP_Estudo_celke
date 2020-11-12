<?php

namespace App\adm\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmUsuario{

    private $Resultado;
    private $Usuario;
    private $EditarUnico;
    private $DadoId;

    /**
     * Get the value of Resultado
     */ 
    public function getResultado()
    {
        return $this->Resultado;
    }

    public function valUsuario($Usuario, $EditarUnico = null, $DadoId = null)
    {
        $this->Usuario = (string) $Usuario;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valUsuario = new \App\adm\Models\helper\AdmLeitura();
        if(!empty($this->EditarUnico) && $this->EditarUnico == true){
            $valUsuario->fullRead("SELECT id FROM adm_usuarios WHERE usuario =:usuario AND id <>:id LIMIT :limit", "usuario={$this->Usuario}&id={$this->DadoId}&limit=1");
        } else {
            $valUsuario->fullRead("SELECT id FROM adm_usuarios WHERE usuario =:usuario LIMIT :limit", "usuario={$this->Usuario}&limit=1");
        }
        

        $this->Resultado = $valUsuario->getResultado();
        if(!empty($this->Resultado)){
            $this->alertas('Generica', 'warning', 'warning', 'Usuário já existente.');
            $this->Resultado = false;
        } else {
            $this->valCaractUsuario();
        }
    }

    private function valCaractUsuario(){
        if(stristr($this->Usuario, "'")){
            $this->alertas('Generica', 'warning', 'warning', 'Caracter especial não é permitido.');
            $this->Resultado = false;
        } else {
            if(stristr($this->Usuario, " ")){
                $_SESSION['msg'] = "<div class='alert alert-warning'>Alerta: Não é permitido espaçamento entre as palavras.</div>";
                $this->Resultado = false;
            } else {
                $this->valExtensUsuario();
            }
            
        }
    }

    private function valExtensUsuario(){
        if(strlen($this->Usuario) < 6){
            $this->alertas('Generica', 'warning', 'warning', 'Mínimo Caracter permitido são 5');
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