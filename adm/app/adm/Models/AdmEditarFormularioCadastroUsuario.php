<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmEditarFormularioCadastroUsuario
{

    private $Resultado;
    private $Dados;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function verFormularioCadastroUsuario()
    {
        $verFormularioCadastroUsuario = new \App\adm\Models\helper\AdmLeitura();
        $verFormularioCadastroUsuario->fullRead("SELECT * FROM adm_cadastrar_usuarios
                            WHERE id =:id LIMIT :limit", "id=1&limit=1");
        $this->Resultado = $verFormularioCadastroUsuario->getResultado();
        return $this->Resultado;
    }

    public function editarFormularioCadastroUsuario(array $Dados)
    {
        $this->Dados = $Dados;
        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);
            $this->updateFormularioCadastroUsuario();
        if ($valCampoVazio->getResultado()) {
        } else {
            $this->Resultado = false;
        }
    }


    private function updateFormularioCadastroUsuario()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $upFormularioCadastroUsuario = new \App\adm\Models\helper\AdmUpdate();
        $upFormularioCadastroUsuario->exeUpdate("adm_cadastrar_usuarios", $this->Dados, "WHERE id =:id", "id=1");
        if ($upFormularioCadastroUsuario->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Formulário para editar o cadastro de usuário na página de login atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Formulário para editar o cadastro de usuário na página de login não foi atualizado!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adm\Models\helper\AdmLeitura();
        $listar->fullRead("SELECT id id_nivac, nome nome_nivac FROM adm_niveis_acessos ORDER BY id ASC");
        $registro['nivac'] = $listar->getResultado();

        $listar->fullRead("SELECT id id_situacao, nome nome_situacao FROM adm_situacoes ORDER BY id ASC");
        $registro['situacao'] = $listar->getResultado();

        $this->Resultado = array('nivac' => $registro['nivac'], 'situacao' => $registro['situacao']);
        return $this->Resultado;
    }
}
