<?php

namespace App\adm\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Classe para a manipulação de remoção de caracteres especiais
 */
class AdmSlug{

    private $Nome;
    private $Formato;

    public function nomeSlug($Nome){
        $this->Nome = (string) $Nome;
        $this->Formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->Formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';
        
        $this->Nome = strtr(utf8_decode($this->Nome), utf8_decode($this->Formato['a']), $this->Formato['b']); // strtr -> está fazendo o seguinte: pegando o coteudo do utf8_decode($this->Nome), passa os caracteres do array utf8_decode($this->Formato['a']) quais eu não usarei e substituindo dos os caracteres especiais que estão no utf8_decode($this->Formato['a']) e para o $this->Formato['b'].
        $this->Nome = strip_tags($this->Nome); // Retirando as "tags"
        
        $this->Nome = str_replace(' ', '-', $this->Nome); // substituindo o "espaço" pelo "-"
        
        $this->Nome = str_replace(array('-----','----','---','--'), '-', $this->Nome);
        
        $this->Nome = strtolower($this->Nome); // Colocando todas as letras em minuscula
        
        return $this->Nome;
    }

}