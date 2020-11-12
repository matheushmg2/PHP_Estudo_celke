<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarNivelAcessoPaginaMenu
{

    private $Dados;
    private $DadosId;
    private $PageId;
    private $NivelAcessoId;

    public function editarNivelAcessoPaginaMenu($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->NivelAcessoId = filter_input(INPUT_GET,"niv", FILTER_SANITIZE_NUMBER_INT);
        $this->PageId = filter_input(INPUT_GET,"pg", FILTER_SANITIZE_NUMBER_INT);
        $this->DadosId = (int) $DadosId;
        

        if(!empty($this->DadosId) AND ! empty($this->NivelAcessoId) AND ! empty($this->PageId)){
            $this->editarNivelAcessoPaginaMenuPrivado();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Item de menu não encontrado!</div>";
            $UrlDestino = URLADM . "NivelAcesso/listar";
            header("Location: $UrlDestino");
        }
    }
    
    private function editarNivelAcessoPaginaMenuPrivado()
    {
        if (!empty($this->Dados['EditarNivelAcessoPaginaMenu'])) {
            unset($this->Dados['EditarNivelAcessoPaginaMenu']);
            $editarMenu = new \App\adm\Models\AdmEditarNivelAcessoPaginaMenu();
            $editarMenu->alterarMenu($this->Dados);
            if($editarMenu->getResultado()){
                $UrlDestino = URLADM . "Permissoes/listar/{$this->PageId}?niv={$this->NivelAcessoId}";
                header("Location: $UrlDestino");
            }else {
                $this->Dados['form'] = $this->Dados;
                $this->editarMenuViewPrivado();
            }
        } else {
            $verNivelAcessoPagina = new \App\adm\Models\AdmEditarNivelAcessoPaginaMenu();
            $this->Dados['form'] = $verNivelAcessoPagina->verNivelAcessoPagina($this->DadosId);
            $this->editarMenuViewPrivado();
        }
    }

    private function editarMenuViewPrivado()
    {
        if($this->Dados['form']){
            $listarSelecao = new \App\adm\Models\AdmEditarNivelAcessoPaginaMenu();
            $this->Dados['select'] = $listarSelecao->listarCadastrarPagina();

            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adm/Views/Permissoes/editarNivelAcessoPaginaMenu", $this->Dados);
            $carregarView->renderizar();
        }  else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Item de menu não encontrado!</div>";
            $UrlDestino = URLADM . "NivelAcesso/listar";
            header("Location: $UrlDestino");
        }
    }

}
