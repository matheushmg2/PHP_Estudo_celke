<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmLogin {

    private $Dados;
    private $Resultado;

    /**
     * Get the value of Resultado
     */ 
    public function getResultado()
    {
        return $this->Resultado;
    }

    public function acesso(array $Dados)
    {
        $this->Dados = $Dados;

        //$Dados = ['nome' => 'teste', 'email' => 'teste@teste.com', 'usuario' => 'teste1', 'senha' => '$2y$10$DAmTOxHvEVS.XVfGmH1gmesJvSxKQhLgPNiHBBpKOwFR14UZvRk2i', 'confirmar_email' => '2', 'adm_niveis_acessos_id' => '1', 'adm_situacoes_id' => '1', 'created' => date('Y-m-d H:i:s')];
        //$create = new \App\adm\Models\helper\AdmCreate();
        //$create->exeCreate("adm_usuarios", $Dados);
        //var_dump($Dados);
        /*echo "Dados Formulario -> ";
        var_dump($this->Dados);
        echo "<br><hr>";*/
        $this->validarDados();
        if($this->Resultado){
            $validaLogin = new \App\adm\Models\helper\AdmLeitura();
            $validaLogin->fullRead("SELECT user.id, user.nome, user.email, user.usuario, user.senha, user.imagem, user.adm_niveis_acessos_id, nivel.ordem ordem_nivel
                                    FROM adm_usuarios user
                                    INNER JOIN adm_niveis_acessos nivel ON nivel.id = user.adm_niveis_acessos_id
                                    WHERE usuario =:usuario LIMIT :limit", "usuario={$this->Dados['usuario']}&limit=1");
            $this->Resultado = $validaLogin->getResultado();
            /*echo "<br><hr>";
            echo "Dados bd -> ";
            var_dump($this->Resultado);
            */
            if($this->Resultado) {
                $this->validarSenha();
            } else {
                //$_SESSION['msg'] = "<div class='alert alert-warning'>Usuário Inválido</div>";
                $this->alertas('Generica', 'danger', 'danger', 'Usuário não encontrado!');
                $this->Resultado = false;
            }
        }
    }

    private function validarSenha(){
        if(password_verify($this->Dados['senha'], $this->Resultado[0]['senha'])){
            $_SESSION['usuario_id'] = $this->Resultado[0]['id'];
            $_SESSION['usuario_nome'] = $this->Resultado[0]['nome'];
            $_SESSION['usuario_email'] = $this->Resultado[0]['email'];
            $_SESSION['usuario_user'] = $this->Resultado[0]['usuario'];
            $_SESSION['usuario_image'] = $this->Resultado[0]['imagem'];
            $_SESSION['adm_niveis_acessos_id'] = $this->Resultado[0]['adm_niveis_acessos_id'];
            $_SESSION['ordem_nivel'] = $this->Resultado[0]['ordem_nivel'];
            $this->Resultado = true;
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-warning'>Usuário Inválido</div>";
            $this->alertas('Generica', 'warning', 'warning', 'Usuário ou a senha incorreto');
            $this->Resultado = false;
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