<?php

namespace Core;

/**
 * Description of ConfigView
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ConfigView
{

    private $Nome;
    private $Dados;

    public function __construct($Nome, array $Dados = null)
    {
        $this->Nome = (string) $Nome;
        $this->Dados = $Dados;
    }

    public function renderizar()
    {
        include 'app/adm/Views/include/cabecalho_adm.php';
        include 'app/adm/Views/include/header.php';
        include 'app/adm/Views/include/menuLateral.php';
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        }else{
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
        include 'app/adm/Views/include/rodape_adm.php';
    }

    public function renderizarComplementoAdm()
    {
        include 'app/adm/Views/include/cabecalho_adm.php';
        include 'app/adm/Views/include/header.php';
        include 'app/adm/Views/include/menuLateral.php';
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        }else{
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
        include 'app/cpadm/Views/include/rodape_cpadm.php';
    }

    public function renderizarComplementoAdmListar()
    {
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        }else{
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }

    public function renderizarLogin()
    {
        include 'app/adm/Views/include/cabecalho.php';
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
        }else{
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
        include 'app/adm/Views/include/rodape.php';
    }

}
