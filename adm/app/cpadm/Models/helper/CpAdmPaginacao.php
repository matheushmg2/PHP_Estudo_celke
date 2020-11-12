<?php

namespace App\cpadm\Models\helper;

if(!defined('URL')){
    header("Location: /");
    exit();
}

class CpAdmPaginacao{ // Quando instrâcio a classe "AdmPaginacao" -> Terei que passa o __contruct($Link)

    private $Link;
    private $Pagina;
    private $LimiteResultado;
    private $OffSet; // Para indicar até quando irei buscar as informações
    private $Query;
    private $ParseString;
    private $ResultBd;
    private $Resultado;
    private $TotalPaginas;
    private $MaxLinks = 2;
    private $Variavel; // Se refere-se a um Nível a mais para o acesso

    public function getResultado(){
        return $this->Resultado;
    }

    public function getOffSet(){
        return $this->OffSet;
    }

    public function __construct($Link, $Variavel = null) 
    {
        $this->Link = $Link;
        $this->Variavel = $Variavel;
    }

    /**
     * Recebo a Página que o Usuário esta
     * 
     * E o limite de resultado que deseja conter
     */
    public function condicao($Pagina, $LimiteResultado)
    {
        $this->Pagina = (int) $Pagina ? $Pagina : 1; 
        // significado do IF ternario | $Pagina ? => Se $Pagina possuir valor, atribua o valor que estiver vindo a própria variavel $Pagina, Se não estiver, ou seja, : 1 => atribua o valor 1
        $this->LimiteResultado = (int) $LimiteResultado;
        $this->OffSet = ($this->Pagina * $this->LimiteResultado) - $this->LimiteResultado;
    }

    public function paginacao($Query, $ParseString = null)
    {
        $this->Query = (string) $Query;
        $this->ParseString = (string) $ParseString;
        $contar = new \App\adm\Models\helper\AdmLeitura();
        $contar->fullRead($this->Query, $this->ParseString); // Esta fazendo uma ligação direta; Pois esta pegando a $this->Query das Models para ser usada no Helper
        $this->ResultBd = $contar->getResultado();
        if($this->ResultBd[0]['num_result'] > $this->LimiteResultado){
            $this->instrucaoPaginacao();
        } else {
            $this->Resultado = null;
        }
    }

    private function instrucaoPaginacao(){
        $this->TotalPaginas = ceil($this->ResultBd[0]['num_result'] / $this->LimiteResultado); // ceil será arredondamento de números, ou seja, caso seja 10/2 = 5, mas caso seja 11/2 = 5.5. o ceil irá arredondar para cima ou para baixo sendo assim 5
        if($this->TotalPaginas >= $this->Pagina){
            $this->layoutPaginacao();
        } else{
            header("Location: {$this->Link}");
        }
    }

    private function layoutPaginacao(){
        $this->Resultado = "<nav aria-label='paginacao'>";
        $this->Resultado .= "<ul class='pagination pagination-sm justify-content-center'>";
        $this->Resultado .= "<li class='page-item'>";
        if($this->Pagina == 1) {
            $this->Resultado .= "<a class='page-link' style='pointer-events: none;
            cursor: default; opacity: 0.6; color: black;' href='#' tabindex='-1'>Primeira</a>";
        } else {
            $this->Resultado .= '<a class="page-link" href="#" tabindex="-1" onclick="listar_usuario(1, '.$this->Variavel.')">Primeira</a>';
        }
        
        $this->Resultado .= "</li>";
        
        for($iPag = $this->Pagina - $this->MaxLinks; $iPag <= $this->Pagina - 1; $iPag++){
            if($iPag >= 1){
                //$this->Resultado .= "<li class='page-item'><a class='page-link' href='#'>$iPag</a></li>";
                $this->Resultado .= '<a class="page-link" href="#" onclick="listar_usuario('.$iPag.', '.$this->Variavel.')">'.$iPag.'</a>';
            }
            
        }
        
        $this->Resultado .= "<li class='page-item active'>";
        $this->Resultado .= "<a class='page-link' href='#'>".$this->Pagina."</a>";
        $this->Resultado .= "</li>";

        for($dPag = $this->Pagina + 1; $dPag <= $this->Pagina + $this->MaxLinks; $dPag++){
            if($dPag  <= $this->TotalPaginas){
                //$this->Resultado .= "<li class='page-item'><a class='page-link' href='#'>$dPag</a></li>";
                $this->Resultado .= '<a class="page-link" href="#" onclick="listar_usuario('.$dPag.', '.$this->Variavel.')">'.$dPag.'</a>';
            }
        }

        $this->Resultado .= "<li class='page-item'>";
        if($this->Pagina == $this->TotalPaginas){
            $this->Resultado .= "<a class='page-link' style='pointer-events: none;
            cursor: default; opacity: 0.6; color: black;' href='#'>Última</a>";
        } else {
            $this->Resultado .= '<a class="page-link" href="#" onclick="listar_usuario('.$this->TotalPaginas.', '.$this->Variavel.')">Última</a>';
        }
        

        $this->Resultado .= "        </li>";
        $this->Resultado .= "    </ul>";
        $this->Resultado .= "</nav>";
    }

}