<?php

if (!defined('URL')) {
    header("Location: /");
    exit();
}

echo "<div class='container contAS'>";
    echo "<h2 class='label'>Atualizar Senha</h2>";
        
            //echo "Dentro do acesso.";
            //var_dump($this->Dados['form']);
        echo "<form class='login_form' method='POST' name='form' onsubmit='return validated()'>";

            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                
                unset($_SESSION['msg']);
            }

            echo "<div class='font'><i class='fa fa-lock'></i> Senha</div>";
            echo "<input type='password' name='senha' id='senha'>";
            echo "<div id='pass_error'>Insira a senha</div>";
            echo "<div class='btn'>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<input name='AtualSenha' type='submit' value='Atualizar'>";
            echo "</div>";
            echo "<p class='text-center font'><a href=". URLADM ."login/acesso>Logar-se</a></p>";
        echo "</form>";
    
echo "</div>";
?>