<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmApagarNivelAcesso
{

    private $Resultado;
    private $DadosId;
    private $Dados;
    private $DadosNivelAcessoInferior;


    public function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarNivelAcesso($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verificaUsuarioCadastrado(); // Verifico se exitem Usuário Cadastrado
        if ($this->Resultado) {
            $this->verificaNivelAcessoInferior(); // Verifico o nível de acesso
            $apagarNivelAcesso = new \App\adm\Models\helper\AdmDelete();
            $apagarNivelAcesso->exeDelete("adm_niveis_acessos", "WHERE id =:id", "id={$this->DadosId}");
            if ($apagarNivelAcesso->getResultado()) {
                $this->atualizarOrdem();
                $_SESSION['msg'] = "<div class='alert alert-success'>Nível de acesso apagado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Nível de Acesso não foi apagado!</div>";
                $this->Resultado = false;
            }
        }
    }

    /**
     * Verifica se existe algum Usuário cadastrado com determinado Nível de Acesso.
     * Caso exista, não será possível apagar esse Nível de Acesso
     */
    private function verificaUsuarioCadastrado()
    {

        $verUsuario = new \App\adm\Models\helper\AdmLeitura();
        $verUsuario->fullRead(
            "SELECT id FROM adm_usuarios
                                WHERE adm_niveis_acessos_id =:adm_niveis_acessos_id LIMIT :limit",
            "adm_niveis_acessos_id=" . $this->DadosId . "&limit=2"
        );
        if ($verUsuario->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-warning'> O Nível de Acesso não pode ser apagado, há usuários cadastrados neste nível!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function verificaNivelAcessoInferior()
    {
        $verNivelAcesso = new \App\adm\Models\helper\AdmLeitura();
        $verNivelAcesso->fullRead(
            "SELECT id, ordem AS ordem_result FROM adm_niveis_acessos
                                WHERE ordem > (SELECT ordem FROM adm_niveis_acessos
                                WHERE id =:id) ORDER BY ordem ASC",
            "id={$this->DadosId}"
        );
        $this->DadosNivelAcessoInferior = $verNivelAcesso->getResultado();
    }

    private function atualizarOrdem()
    {
        if ($this->DadosNivelAcessoInferior) {
            foreach ($this->DadosNivelAcessoInferior as $atualizarOrdem) {
                extract($atualizarOrdem);
                $this->Dados['ordem'] = $ordem_result - 1;
                $this->Dados['modified'] = date('Y-m-d H:i:s');
                $updateMoverPraBaixo = new \App\adm\Models\helper\AdmUpdate();
                $updateMoverPraBaixo->exeUpdate("adm_niveis_acessos", $this->Dados, "WHERE id =:id", "id=".$id);
            }
        }
    }
}
