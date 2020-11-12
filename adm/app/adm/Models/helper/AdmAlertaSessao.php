<?php

namespace App\adm\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmAlertaSessao {

    /**
     * 
     * alertaSessaoJS(ICONES['success', 'error', 'warning', 'info'], TÍTULO, MENSAGEM, int TEMPO)
     * 
     */
    public function alertaSessaoJS($icon, $title, $msg, int $tempo = null){
        switch($icon){
            case 'success':
                $icones = 'success';
            break;
            case 'warning':
                $icones = 'warning';
            break;
            case 'info':
                $icones = 'info';
            break;
            case 'error':
                $icones = 'error';
            break;
        }
        $_SESSION['msg'] = "<script type='text/javascript'>
            Swal.fire({
                icon: '$icones',
                title: '$title',
                text: '$msg',
                showConfirmButton: false,
                timer: $tempo
            });
            </script>";
    }

    /**
     *  
     * alertaSessaoGenerica(ICONES['success', 'danger', 'warning', 'info'], TIPO DO ALERTA['success', 'danger', 'warning', 'info'], MENSAGEM)
     * 
     */
    public function alertaSessaoGenerica($icon, $tipo, $msg){
        switch($icon){
            case 'success':
                $icones = 'fa-check-circle';
            break;
            case 'warning':
                $icones = 'fa-exclamation-triangle';
            break;
            case 'info':
                $icones = 'fa-info';
            break;
            case 'danger':
                $icones = 'fa-times-circle';
            break;
        }
        $_SESSION['msg'] = "<div id='myAlert' class='alert alert-$tipo'><i class='fas $icones'></i>  $msg</div>";
        
    }

}