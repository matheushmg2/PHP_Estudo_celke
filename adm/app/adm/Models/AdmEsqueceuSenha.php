<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmEsqueceuSenha{
    
    private $Resultado;
    private $DadosUpdate;
    private $DadosUsuario;
    private $Dados;
    private $DadosEmail;

    public function getResultado(){
        return $this->Resultado;
    }

    public function esqueceuSenha(array $Dados) {
        $this->Dados = $Dados;

        $this->validarDados();
        $esqSenha = new \App\adm\Models\helper\AdmLeitura();
        $esqSenha->fullRead("SELECT id, nome, usuario, recuperar_senha FROM adm_usuarios WHERE email =:email LIMIT :limit", "email={$this->Dados['email']}&limit=1");
        //$esqSenha->fullRead("SELECT id, nome, usuario, recuperar_senha FROM adm_usuarios WHERE email =:email LIMIT :limit", "email={$this->Dados['email']}&limit=1");
        $this->DadosUsuario = $esqSenha->getResultado();
        if(!empty($this->DadosUsuario)){
            $this->ValChaveRecSenha();
        } else {
            $this->alertas('Generica', 'danger', 'danger', 'E-mail não cadastrado');
            $this->Resultado = false;
        }
    }

    private function ValChaveRecSenha(){
        if(!empty($this->DadosUsuario[0]['recuperar_senha'])){
            $this->DadosEmail();
        } else {
            $this->DadosUpdate['recuperar_senha'] = md5($this->DadosUsuario[0]['id'] . date('Y-m-d H:i:s'));
            $this->DadosUpdate['modified'] = date('Y-m-d H:i:s');

            $updateRecSenha = new \App\adm\Models\helper\AdmUpdate();
            $updateRecSenha->exeUpdate("adm_usuarios", $this->DadosUpdate, "WHERE id =:id", "id={$this->DadosUsuario[0]['id']}");

            if($updateRecSenha->getResultado()){
                $this->DadosUsuario[0]['recuperar_senha'] = $this->DadosUpdate['recuperar_senha'];
                $this->DadosEmail();
            } else {
                $this->alertas('Generica', 'danger', 'danger', 'Não foi possível a recuperação de sua senha!');
                $this->Resultado = false;
            }
        }
    }

    private function DadosEmail(){
        $nome = explode(" ", $this->DadosUsuario[0]['nome']);
        $prim_nome = $nome[0];
        $this->DadosEmail['dest_nome'] = $prim_nome;
        $this->DadosEmail['dest_email'] = $this->Dados['email'];
        $this->DadosEmail['titulo_email'] = "Recuperar Senha.";
        
        $this->DadosEmail['cont_email'] = "Olá $prim_nome<br><br>";
        $this->DadosEmail['cont_email'] .= "Você solicitou uma alteração de senha<br><br>";
        $this->DadosEmail['cont_email'] .= "Seguindo o link abaixo você poderá alterar a sua senha.<br>";
        $this->DadosEmail['cont_email'] .= "Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço abaixo no seu navegador<br><br>";
        $this->DadosEmail['cont_email'] .= "<a href='" . URLADM ."atual-senha/atual-senha?chave=". $this->DadosUsuario[0]['recuperar_senha']."'>Clique aqui</a><br><br>";
        $this->DadosEmail['cont_email'] .= "Usuário : ". $this->DadosUsuario[0]['usuario'] ."<br><br>";
        $this->DadosEmail['cont_email'] .= "Se você não solicitou esse alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative esse código.<br><br>";

        $this->DadosEmail['cont_text_email'] = "Olá $prim_nome";
        $this->DadosEmail['cont_text_email'] .= "Você solicitou uma alteração de senha";
        $this->DadosEmail['cont_text_email'] .= "Seguindo o link abaixo você poderá alterar a sua senha.";
        $this->DadosEmail['cont_text_email'] .= "Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço abaixo no seu navegador";
        $this->DadosEmail['cont_text_email'] .= URLADM ."atual-senha/atual-senha?chave=". $this->DadosUsuario[0]['recuperar_senha'];
        $this->DadosEmail['cont_text_email'] .= "Usuário : ". $this->DadosUsuario[0]['usuario'] ."";
        $this->DadosEmail['cont_text_email'] .= "Se você não solicitou esse alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative esse código.";


        $emailPHPMailer = new \App\adm\Models\helper\AdmPhpMailer();
        $emailPHPMailer->emailPhpMailer($this->DadosEmail);

        if($emailPHPMailer->getResultado()){
            $_SESSION['msg'] = "<div class='alert alert-success'>E-mail enviado com sucesso, verifique a sua caixa de entrada ou span!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Não foi possível a recuperação de sua senha!</div>";
            $this->Resultado = false;
        }
    }

    /**
     * Método/Função que valida os campos se contém espaçamento e se está preenchido o campo e
     * Retorna TRUE se estiver preenchido ou 
     * Retorna FALSE se não estiver
     */
    private function validarDados(){
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        //var_dump($this->Dados);
        if(in_array('', $this->Dados)){ // Verificando se existir algum campo vazio
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário preencher todos os campos!</div>";
            $this->Resultado = false;
        } else {
            $valEmail = new \App\adm\Models\helper\AdmEmail();
            $valEmail->valEmail($this->Dados['email']);

            if($valEmail->getResultado()){
                $this->Resultado = true;
            } else {
                $this->Resultado = false;
            }
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