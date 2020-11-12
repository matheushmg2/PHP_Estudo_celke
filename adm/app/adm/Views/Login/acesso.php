<?php

if (!defined('URL')) {
    header("Location: /");
    exit();
}
echo "<div class='container contA'>";
    echo "<h2 class='label'>Welcome</h2>";
        
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
            // value="<?php if(isset($valorForm['usuario'])) { echo $valorForm['usuario'];}" /* Só iremos colocar quando não estiver animações */
            
            echo "<div class='font'><i class='fa fa-user'></i> Usuário</div>";
            echo "<input type='text' name='usuario' autocomplete='off'>";
            echo "<div id='usuario_error'>Insira o usuário</div>";

            echo "<div class='font'><i class='fa fa-lock'></i> Senha</div>";
            echo "<input type='password' name='senha'>";
            echo "<div id='pass_error'>Insira a senha</div>";
            echo "<p class='text-right font'><a href=". URLADM ."EsqueceuSenha/esqueceuSenha>Esqueceu a senha?</a></p>";
            echo "<div class='btn'>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<input name='SendLogin' type='submit' value='Login'>";
            echo "</div>";
            echo "<p class='text-center font'><a href=". URLADM ."novoUsuario/novoUsuario>Cadastra-se</a></p>";
        echo "</form>";
    
echo "</div>";
?>
