<?php

namespace App\adm\Models\helper;

use PHPMailer\PHPMailer\PHPMailer;
use Exception;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class AdmPhpMailer
{

    private $Resultado;
    private $DadosCredEmail;
    private $Dados;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function emailPhpMailer(array $Dados)
    {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        $credEmail = new \App\adm\Models\helper\AdmLeitura();
        $credEmail->fullRead("SELECT * FROM adm_confirmar_emails
                            WHERE id =:id LIMIT :limit
                            ", "id=1&limit=1");
        $this->DadosCredEmail = $credEmail->getResultado();
        //var_dump($this->DadosCredEmail);

        if((isset($this->DadosCredEmail[0]['host'])) && (!empty($this->DadosCredEmail[0]['host']))){
            $this->confEmail();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Error: O Site não possui as credenciais do HOST para o uso de email</div>";
            $this->Resultado = false;
        }
    }

    /**
     * O Método contEmail() -
     * 
     * É onde ficaram as credenciais que ligam ao banco de dados, sem elas não será possível o envio do email
     * 
     * E também onde se traz parte do cadastro do usuario para enviar a chave para o email do destinatario do usuario.
     * 
     * A tabela do BANCO DE DADOS responsável para as credenciais do envio de EMAIL é adms_confs_emails
     */
    private function confEmail(){
        $mail = new PHPMailer(true);                               // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $this->DadosCredEmail[0]['host'];  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $this->DadosCredEmail[0]['usuario'];                 // SMTP username
            $mail->Password = $this->DadosCredEmail[0]['senha'];                           // SMTP password
            
            $mail->SMTPSecure = $this->DadosCredEmail[0]['smtp_secure'];                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $this->DadosCredEmail[0]['porta'];                                    // TCP port to connect to
            
            //Recipients
            $mail->setFrom($this->DadosCredEmail[0]['email'], $this->DadosCredEmail[0]['nome']);
            $mail->addAddress($this->Dados['dest_email'], $this->Dados['dest_nome']);     // Add a recipient
            //
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $this->Dados['titulo_email'];
            $mail->Body = $this->Dados['cont_email'];
            $mail->AltBody = $this->Dados['cont_text_email'];

            if($mail->send()){
                
                $this->Resultado = true;
            }else{
                //echo 'Erro a messagem não foi enviada com sucesso';
                $this->Resultado = false;
            }
            
        } catch (Exception $e) {
            $this->Resultado = false;
        }
    }

}
