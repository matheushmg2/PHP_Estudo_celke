<?php

namespace App\adm\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmCampoVazio {

    private $Resultado;
    private $Dados;

    public function getResultado()
    {
        return $this->Resultado;
    }
    /**
     * Método/Função que valida os campos se contém espaçamento e se está preenchido o campo e
     * Retorna TRUE se estiver preenchido ou 
     * Retorna FALSE se não estiver
     */
    public function validarDados(array $Dados){
        $this->Dados = $Dados;

        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        //var_dump($this->Dados);
        if(in_array('', $this->Dados)){ // Verificando se existir algum campo vazio
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário preencher todos os campos!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}