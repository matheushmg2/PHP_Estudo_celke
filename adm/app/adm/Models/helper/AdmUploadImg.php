<?php

namespace App\adm\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmUploadImg {

    private $DadosImagem;
    private $Diretorio;
    private $NomeImg;
    private $Resultado;
    private $Imagem;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function uploadImagem(array $DadosImagem, $Diretorio, $NomeImg)
    {
        $this->DadosImagem = $DadosImagem;
        $this->Diretorio = $Diretorio;
        $this->NomeImg = $NomeImg;
        $this->validarImagem();
    }

    private function validarImagem()
    {
        switch($this->DadosImagem['type']):
            case 'image/jpeg';
            case 'image/pjpeg';
                $this->Imagem = imagecreatefromjpeg($this->DadosImagem['tmp_name']);
                break;
            case 'image/png';
            case 'image/x-png';
                $this->Imagem = imagecreatefrompng($this->DadosImagem['tmp_name']);
                break;
        endswitch;

        if($this->Imagem){
            $this->valDiretorio();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Extensão da Imagem é inválida. Selecione uma Imgem JPEG OU PNG</div>";
            $this->Resultado = false;
        }
    }

    /**
     * Método para validar o Diretório
     */
    private function valDiretorio(){
        if(!file_exists($this->Diretorio) && !is_dir($this->Diretorio)){ // Se não existir e se não for um diretório irá cria um
            mkdir($this->Diretorio, 0755);
        }
        $this->realizarUpload();
    }

    private function realizarUpload(){
        if(move_uploaded_file($this->DadosImagem['tmp_name'], $this->Diretorio . $this->NomeImg)){
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: Não foi possível inserir a imagem</div>";
            $this->Resultado = false;
        }
    }
    
}