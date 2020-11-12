<?php

namespace App\adm\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class EditarNivelAcesso
{

    private $Dados;
    private $DadosId;

    public function editarNivelAcesso($DadosId = null)
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if(!empty($this->DadosId)) {
            $this->editarNivelAcessoPrivado();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning'>Usuário não encotrado!</div>";
            $UrlDestino = URLADM . "NivelAcesso/listar";
            header("Location: $UrlDestino");
        }
    }
    private function editarNivelAcessoPrivado()
    {
        if (!empty($this->Dados['EditarNivelAcesso'])) {
            unset($this->Dados['EditarNivelAcesso']);

            $editarNivelAcesso = new \App\adm\Models\AdmEditarNivelAcesso();
            $editarNivelAcesso->alterarNivelAcesso($this->Dados);

            if ($editarNivelAcesso->getResultado()) {
                $UrlDestino = URLADM . 'VerNivelAcesso/verNivelAcesso/'. $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editarNivelAcessoViewPrivado();
            }
        } else {
            $verNivelAcesso = new \App\adm\Models\AdmVerNivelAcesso();
            $this->Dados['form'] = $verNivelAcesso->verNivelAcesso($this->DadosId);

            $this->editarNivelAcessoViewPrivado();
        }
        
    }

    private function editarNivelAcessoViewPrivado(){
        if ($this->Dados['form']) {            
            $botao = ['VisualizarNivelAcesso' => ['menu_controller' => 'verNivelAcesso', 'menu_metodo' => 'verNivelAcesso']];
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adm/Views/NivelAcesso/editarNivelAcesso", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Nível de acesso não encontrado!</div>";
            $UrlDestino = URLADM . 'NivelAcesso/listar';
            header("Location: $UrlDestino");
        }
    }
    
    /*$listarMenu = new \App\adm\Models\AdmMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $botao = [
                'ListarNivelAcesso' => ['menu_controller' => 'nivelAcesso', 'menu_metodo' => 'listar'],
                'EditarNivelAcesso' => ['menu_controller' => 'editarUsuario', 'menu_metodo' => 'editarUsuario'],
                'ApagarNivelAcesso' => ['menu_controller' => 'apagarUsuario', 'menu_metodo' => 'apagarUsuario']
            ];
    
            $listarBotao = new \App\adm\Models\AdmBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $verNivelAcesso = new \App\adm\Models\AdmVerNivelAcesso();
            $this->Dados['verNivelAcesso'] = $verNivelAcesso->verNivelAcesso($this->DadosId);

            $carregarView = new \Core\ConfigView("adm/Views/NivelAcesso/verNivelAcesso", $this->Dados);
            $carregarView->renderizar();

    /**
     * alertaSessaoJS(ICONES['success', 'error', 'warning', 'info'], TÍTULO, MENSAGEM)
     * 
     * alertaSessaoGenerica(ICONES['success', 'danger', 'warning', 'info'], TIPO DO ALERTA['success', 'danger', 'warning', 'info'], MENSAGEM)
     */
    private function alertas($qlAlerta, $icon, $escolha, $msg, $tempo = null){
        $alerta = new \App\adm\Models\helper\AdmAlertaSessao();
        switch($qlAlerta){
            case 'JS':
                $alerta->alertaSessaoJS($icon, $escolha, $msg, $tempo);
            break;
            case 'Generica':
                $alerta->alertaSessaoGenerica($icon, $escolha, $msg);
            break;
        }
    }

}
