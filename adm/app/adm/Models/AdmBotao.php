<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmBotao {

    private $Resultado;
    private $Botao;
    private $BotaoValido = [];

    /**
     * Get the value of Resultado
     */ 
    public function getResultado()
    {
        return $this->Resultado;
    }

    public function valBotao(array $Botao){

        $this->Botao = $Botao;
        foreach ($this->Botao as $key => $botaoUnico) { // Quando utilizo um ARRAY de tipo Matriz posso utilizar a VARIÁVEL $key 'chave' para especificar qual o ARRAY/nome que estiver nela; $botao 'valor' é o valor que esta sendo recebida integral do ARRAY ou o conteúdo total que está dentro do ARRAY  $this->Botao
            extract($botaoUnico);
            $verBotao = new \App\adm\Models\helper\AdmLeitura();
            $verBotao->fullRead("SELECT pg.id id_pg
                                FROM adm_paginas pg
                                LEFT JOIN adm_nivel_acesso_paginas nivpg ON nivpg.adm_paginas_id = pg.id
                                WHERE pg.menu_controller =:menu_controller
                                AND pg.menu_metodo =:menu_metodo
                                AND pg.adm_situacoes_id = 1
                                AND nivpg.adm_niveis_acessos_id =:adm_niveis_acessos_id
                                AND nivpg.permissao = 1 LIMIT :limit", "menu_controller=$menu_controller&menu_metodo=$menu_metodo&adm_niveis_acessos_id=".$_SESSION['adm_niveis_acessos_id']."&limit=1");
        
            if($verBotao->getResultado()){
                $this->BotaoValido[$key] = true;
            } else {
                $this->BotaoValido[$key] = false;
            }
        }

        return $this->BotaoValido;
    }
}