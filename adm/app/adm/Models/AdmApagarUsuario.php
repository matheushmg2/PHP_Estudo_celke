<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmApagarUsuario
{

    private $Resultado;
    private $DadosId;
    private $DadosUsuario;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarUsuario($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $this->verUsuario();

        if ($this->DadosUsuario) {
            $apagarUsuarios = new \App\adm\Models\helper\AdmDelete();
            $apagarUsuarios->exeDelete("adm_usuarios", "WHERE id =:id", "id={$this->DadosId}");

            if ($apagarUsuarios->getResultado()) {
                $apagarImg = new \App\adm\Models\helper\AdmApagarImg();
                $apagarImg->apagarImg('assets/image/usuarios/' . $this->DadosId . '/' . $this->DadosUsuario['0']['imagem'], 'assets/image/usuarios/' . $this->DadosId);
                $_SESSION['msg'] = "<div class='alert alert-success text-center'><i class='fas fa-check-circle'></i>  Usuário deletado..</div>";
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger text-center'><i class='fas fa-exclamation-triangle'></i>  Não foi possível deletar o Usuário..</div>";
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger text-center'><i class='fas fa-exclamation-triangle'></i> Error: Não foi possível deletar o Usuário..</div>";
        }


        /*
        $this->Resultado = $apagarUsuarios->getResultado();
        return $this->Resultado;*/
    }
    private function verUsuario()
    {
        $verUsuario = new \App\adm\Models\helper\AdmLeitura();
        $verUsuario->fullRead("SELECT usuario.imagem FROM adm_usuarios usuario
                            INNER JOIN adm_niveis_acessos nivac ON nivac.id = usuario.adm_niveis_acessos_id
                            WHERE usuario.id=:id AND nivac.ordem >:ordem LIMIT :limit", "id=" . $this->DadosId . "&ordem=" . $_SESSION['ordem_nivel'] . "&limit=1");
        $this->DadosUsuario = $verUsuario->getResultado();
    }
}
