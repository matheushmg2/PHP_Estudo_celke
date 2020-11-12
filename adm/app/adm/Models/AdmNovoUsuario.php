<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmNovoUsuario {

    private $Dados;
    private $Resultado;
    private $InformacaoCadastroUsuario;
    private $DadosEmail;

    /**
     * Get the value of Resultado
     */ 
    public function getResultado()
    {
        return $this->Resultado;
    }

    public function cadUser(array $Dados){
        $this->Dados = $Dados;
        $this->validarDados();
        if($this->Resultado){
            $valEmail = new \App\adm\Models\helper\AdmEmail();
            $valEmail->valEmail($this->Dados['email']);

            $valEmailUnico = new \App\adm\Models\helper\AdmEmailUnico();
            $valEmailUnico->valEmailUnico($this->Dados['email']);

            $valUsuario = new \App\adm\Models\helper\AdmUsuario();
            $valUsuario->valUsuario($this->Dados['usuario']);

            if($valEmail->getResultado() && $valEmailUnico->getResultado() && $valUsuario->getResultado()){
                $this->inserir();
            } else {
                $this->Resultado = false;
            }
            
        }
    }
    
    private function validarDados(){
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        //var_dump($this->Dados);
        if(in_array('', $this->Dados)){
            //$_SESSION['msg'] = "<div class='alert alert-warning'>Usuário Inválido</div>";
            $this->alertas('Generica', 'danger', 'danger', 'Necessário preencher os campos!');
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function informacaoCadastroUsuario()
    {
        $informacaoCadastroUsuario = new \App\adm\Models\helper\AdmLeitura();
        $informacaoCadastroUsuario->fullRead("SELECT enviado_email_confirmado, adm_niveis_acessos_id, adm_situacoes_id FROM adm_cadastrar_usuarios WHERE id =:id LIMIT :limit", "id=1&limit=1");
        $this->InformacaoCadastroUsuario = $informacaoCadastroUsuario->getResultado();
    }

    private function inserir(){
        $this->informacaoCadastroUsuario();
        $this->Dados['senha'] = password_hash($this->Dados['senha'], PASSWORD_DEFAULT);
        
        $this->Dados['confirmar_email'] = md5($this->Dados['senha'] . date('Y-m-d H:i'));
        $this->Dados['adm_niveis_acessos_id'] = $this->InformacaoCadastroUsuario[0]['adm_niveis_acessos_id'];
        $this->Dados['adm_situacoes_id'] = $this->InformacaoCadastroUsuario[0]['adm_situacoes_id'];;
        $this->Dados['created'] = date('Y-m-d H:i:s');
        $cadUser = new \App\adm\Models\helper\AdmCreate();
        $cadUser->exeCreate("adm_usuarios", $this->Dados);
        if($cadUser->getResultado()){
            /*$this->alertas('JS', 'success', false, 'Usuario Cadastrado');
            $this->Resultado = true;*/
            if($this->informacaoCadastroUsuario[0]['enviado_email_confirmado'] != 1){
                $this->DadosEmail();
            } else {
                $this->alertas('JS', 'success', false, 'Usuario Cadastrado', 6000);
                $this->Resultado = true;
            }
        } else {
            $this->alertas('JS', 'error', 'Ops', 'Usuário não Cadastrado!', 6000); 
            $this->Resultado = false;
        }
    }

    private function DadosEmail(){
        $nome = explode(" ", $this->Dados['nome']);
        $prim_nome = $nome[0];
        $this->DadosEmail['dest_nome'] = $prim_nome; // Nome do destinatário
        $this->DadosEmail['dest_email'] = $this->Dados['email']; // Email do destinatário
        $this->DadosEmail['titulo_email'] = 'Confirmar Email';
        $this->DadosEmail['cont_email'] = "Caro(a) $prim_nome, <br><br>";
        $this->DadosEmail['cont_email'] .= "Obrigado por se cadastrar conosco. Para ativar seu perfil, clique no link abaixo: <br><br>";
        $this->DadosEmail['cont_email'] .= "<a href='" . URLADM ."confirmar/confirmar_email?chave=". $this->Dados['confirmar_email']."'>Clique aqui</a><br><br>";
        $this->DadosEmail['cont_email'] .= "Obrigado.<br>";

       
        $this->DadosEmail['cont_text_email'] = "Caro(a) $prim_nome, ";
        $this->DadosEmail['cont_text_email'] .= "Obrigado por se cadastrar conosco. Para ativar seu perfil, copie o endereçõ abaixo e cole no navegador:";
        $this->DadosEmail['cont_text_email'] .= URLADM ."confirmar/confirmar_email?chave=". $this->Dados['confirmar_email'];
        $this->DadosEmail['cont_text_email'] .= "Obrigado.";

        $emailPHPMailer = new \App\adm\Models\helper\AdmPhpMailer();
        $emailPHPMailer->emailPhpMailer($this->DadosEmail);
        if($emailPHPMailer->getResultado()){
            $this->alertas('JS', 'info', 'E-mail enviado', 'Vá ao seu e-mail e click no LINK para confirmação de seu cadastro..', 7000);
            //$_SESSION['msg'] = "<div class='alert alert-success'>Enviado ao seu E-mail um LINK para a confirmação de seu cadastro..</div>";
            $this->Resultado = true;
        } else {
            $this->alertas('Generica', 'warning', 'warning', 'Não foi possiver cadastra o Usuário, erro no email do Usuário.');
            //$_SESSION['msg'] = "<div class='alert alert-primary'>Não foi possiver cadastra o Usuário, erro no email do Usuário.</div>";
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