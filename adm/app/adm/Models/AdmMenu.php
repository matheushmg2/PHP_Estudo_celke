<?php

namespace App\adm\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmMenu {
    private $Resultado;

    /**
     * Get the value of Resultado
     */ 
    public function getResultado()
    {
        return $this->Resultado;
    }

    public function itemMenu(){
        $listaItemMenu = new \App\adm\Models\helper\AdmLeitura();
        $listaItemMenu->fullRead("SELECT nivpg.dropdown, menu.id id_menu, menu.nome nome_menu, menu.icones icone_menu, pg.id id_pg, pg.menu_controller, pg.menu_metodo, pg.nome_pagina nome_pg, pg.icones icones_subMenu
                                    FROM adm_nivel_acesso_paginas nivpg
                                    INNER JOIN adm_menus menu ON menu.id = nivpg.adm_menus_id
                                    INNER JOIN adm_paginas pg ON pg.id = nivpg.adm_paginas_id
                                    WHERE nivpg.adm_niveis_acessos_id =:adm_niveis_acessos_id
                                    AND nivpg.permissao =:permissao
                                    AND nivpg.liberado_menu =:liberado_menu
                                    ORDER BY menu.ordem, nivpg.ordem ASC
                                    ", "adm_niveis_acessos_id=".$_SESSION['adm_niveis_acessos_id']."&permissao=1&liberado_menu=1");
    
        $this->Resultado = $listaItemMenu->getResultado();
        //var_dump($this->Resultado);
        return $this->Resultado;
    }
}