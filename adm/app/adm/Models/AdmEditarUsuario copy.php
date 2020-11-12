<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
class AdmEditarUsuario
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
        $verPerfil->fullRead("SELECT * FROM adm_usuarios WHERE id=:id LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
    }

    public function editarUsuario(array $Dados)
    {
        $this->Dados = $Dados;
        $this->Foto = $this->Dados['imagem_nova']; // Está pegando um array $this->Dados['imagem_nova'] e colocando na variavel $this->Foto; Pois para manipular a imagem/foto na prática a imagem/foto tráz contigo um array e que terá que ser transformado para que possa ser usado em uma outra variavel como $this->Foto
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']); // Após as variaveis ter sido inserido em uma outra variavel de ARRAY, destrua para que não ocorra nenhum erro a seguir.

        $valCampoVazio = new \App\adm\Models\helper\AdmCampoVazio();
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
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
        $valEmailUnico->valEmailUnico($this->Dados['email'], true, $this->Dados['id']);

        $valUsuario = new \App\adm\Models\helper\AdmUsuario();
        $valUsuario->valUsuario($this->Dados['usuario'], true, $this->Dados['id']);
        if (($valUsuario->getResultado()) && ($valEmailUnico->getResultado()) && ($valEmail->getResultado())) {
            $this->valFoto();
        } else {
            $this->Resultado = false;
        }
    }

    private function valFoto()
    {
        if (empty($this->Foto['name'])) {
            $this->updateEditUsuario();
        } else {
            $slugImg = new \App\adm\Models\helper\AdmSlug();
            $this->Dados['imagem'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\adm\Models\helper\AdmUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'assets/image/usuarios/' . $this->Dados['id'] . '/', $this->Dados['imagem'], 150, 150);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adm\Models\helper\AdmApagarImg();
                $apagarImg->apagarImg('assets/image/usuarios/' . $this->Dados['id'] . '/' . $this->ImgAntiga);
                $this->updateEditUsuario();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditUsuario()
    {
        $this->Dados['modified'] = date('Y-m-d H:i:s');
        $upAltSenha = new \App\adm\Models\helper\AdmUpdate();
        $upAltSenha->exeUpdate("adm_usuarios", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upAltSenha->getResultado()) {
            /*$_SESSION['usuario_nome'] = $this->Dados['nome'];
            $_SESSION['usuario_email'] = $this->Dados['email'];
            $_SESSION['usuario_user'] = $this->Dados['usuario'];
            if($_SESSION['usuario_image'] == $this->ImgAntiga && $this->Foto['name'] == '') { // Para que as imagem que já estarão na sessão não seja perdido, esse IF é para isso
                $_SESSION['usuario_image'] = $_SESSION['usuario_image'];
            }else { // Caso esteja adiquerindo/colocando uma nova imagem, esse ELSE é para isso
                $_SESSION['usuario_image'] = $this->Dados['imagem'];
            }*/
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário Editado com sucesso.</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Não foi possível Editar o Usuário!</div>";
            $this->Resultado = false;
        }
    }
}
