<?php

if (!defined('URL')) {
    header("Location: /");
    exit();
}

echo "<div class='container contES'>";
    echo "<h2 class='label'>Recuperar Senha</h2>";
        
            //echo "Dentro do acesso.";
            //var_dump($this->Dados['form']);
        echo "<form class='login_form' method='POST' name='form' onsubmit='return validated()'>";

            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                
                unset($_SESSION['msg']);
            }
            if(isset($this->Dados['form'])){
                $valorForm = $this->Dados['form'];
            }
            echo "<div class='font'><i class='fa fa-at'></i> E-mail</div>";
            echo "<input type='text' name='email' autocomplete='off' id='email'>";
            echo "<div id='email_error'>Digite seu E-mail</div>";

            echo "<div class='btn'>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<input name='RecupUserLogin' type='submit' value='Recuperar'>";
            echo "</div>";
            echo "<p class='text-center font'><a href=". URLADM ."login/acesso>Logar-se</a></p>";
        echo "</form>";
    
echo "</div>";
?>