<?php

namespace App\cpadm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class CpAdmCadastrarUsuario
{

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;
    private $ImgAntiga;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verUsuario($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \App\adm\Models\helper\AdmLeitura();
        $verPerfil->fullRead("SELECT * FROM adm_usuarios WHERE id=:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
    }

    public function cadastrarUsuario(array $Dados)
    {
        $this->Dados = $Dados;
        //$this->Foto = $this->Dados['imagem_nova'];
        //unset($this->Dados['imagem_nova']);
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            //$this->Resultado = true;
            //$_SESSION['msg'] = "<div class='alert alert-success'> Certo </div>";
            $this->valCampos();
            
        } else {
            $this->Resultado = false;
        }
    }

    private function valCampos()
    {
        $valEmail = new \App\adm\Models\helper\AdmEmail();
        $valEmail->valEmail($this->Dados['email']);

        $valEmailUnico = new \App\adm\Models\helper\AdmEmailUnico();
        $valEmailUnico->valEmailUnico($this->Dados['email']);

        $valUsuario = new \App\adm\Models\helper\AdmUsuario();
        $valUsuario->valUsuario($this->Dados['usuario']);

        $valSenha = new \App\adm\Models\helper\AdmValSenha();
        $valSenha->valSenha($this->Dados['senha']);

        if (($valUsuario->getResultado()) && ($valEmailUnico->getResultado()) && ($valEmail->getResultado()) && ($valSenha->getResultado())) {
            //$this->Resultado = true;
            //$_SESSION['msg'] = "<div class='alert alert-success'> Certo </div>";
            $this->inserirUsuario();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirUsuario()
    {
        $this->Dados['senha'] = password_hash($this->Dados['senha'], PASSWORD_DEFAULT);
        $this->Dados['created'] = date('Y-m-d H:i:s');

        //$slugImg = new \App\adm\Models\helper\AdmSlug();
        //$this->Dados['imagem'] = $slugImg->nomeSlug($this->Foto['name']);

        $cadastrarUsuarios = new \App\adm\Models\helper\AdmCreate();
        $cadastrarUsuarios->exeCreate("adm_usuarios", $this->Dados);
        if ($cadastrarUsuarios->getResultado()) {
            if (empty($this->Foto['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário Cadastrado com sucesso.</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['id'] = $cadastrarUsuarios->getResultado();
                //$this->valFoto();
            }
            
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Não foi possível Cadastrar o Usuário!</div>";
            $this->Resultado = false;
        }
    }

    private function valFoto()
    {
        $uploadImg = new \App\adm\Models\helper\AdmUploadImgRed();
        $uploadImg->uploadImagem($this->Foto, 'assets/image/usuarios/' . $this->Dados['id'] . '/', $this->Dados['imagem'], 150, 150);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário Cadastrado com sucesso.</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Não foi possível Cadastrar o Usuário!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adm\Models\helper\AdmLeitura();
        $listar->fullRead("SELECT id id_nivac, nome nome_nivac FROM adm_niveis_acessos WHERE ordem >=:ordem ORDER BY id ASC", "ordem=" . $_SESSION['ordem_nivel']);
        $registro['nivac'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_situacao, nome nome_situacao FROM adm_situacoes ORDER BY id ASC");
        $registro['situacao'] = $listar->getResultado();

        $this->Resultado = array('nivac' => $registro['nivac'], 'situacao' => $registro['situacao']);
        return $this->Resultado;
    }
}
