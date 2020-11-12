<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmConfirmarEmail {
    private $DadosChave;
    private $DadosUsuario;
    private $Resultado;
    private $Dados;

    public function getResultado(){
        return $this->Resultado;
    }

    public function confirmarEmail($Chave)
    {
        $this->DadosChave = (string) $Chave;
        $validaChave = new \App\adm\Models\helper\AdmLeitura();
        $validaChave->fullRead("SELECT id FROM adm_usuarios WHERE confirmar_email =:confirmar_email LIMIT :limit", "confirmar_email={$this->DadosChave}&limit=1");
        $this->DadosUsuario = $validaChave->getResultado();
        if(!empty($this->DadosUsuario)){
            $this->updateConfEmail();
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-danger'>Link de Confirmação inválida!</div>";
            $this->alertas('Generica', 'danger', 'danger', 'Link de Confirmação inválida!');
            $this->Resultado = false;
        }
    }

    private function updateConfEmail(){
        $this->Dados['confirmar_email'] = NULL;
        $this->Dados['adm_situacoes_id'] = 1;
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $updateConfEmail = new \App\adm\Models\helper\AdmUpdate();
        $updateConfEmail->exeUpdate("adm_usuarios", $this->Dados, "WHERE id =:id", "id={$this->DadosUsuario[0]['id']}");
        if($updateConfEmail->getResultado()){
            //$_SESSION['msg'] = "<div class='alert alert-success'>E-mail confirmado com sucesso.</div>";
            $this->alertas('JS', 'success', 'E-mail confirmado com sucesso.', 'Usuário cadastrado..', 5000);
            $this->Resultado = true;
        } else {
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