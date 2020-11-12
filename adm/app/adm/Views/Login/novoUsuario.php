<?php

if (!defined('URL')) {
    header("Location: /");
    exit();
}

echo "<div class='container contNU'>";
    echo "<h2 class='label'>Novo Usuário</h2>";
        
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
            echo "<div class='font'><i class='fa fa-users'></i> Nome</div>";
            if(isset($valorForm['nome'])) { // Se existir valor no campo permanecerá o nome
                echo "<input type='text' name='nome' autocomplete='off' value='".$valorForm['nome']."' id='nome'>";
            } else {
                echo "<input type='text' name='nome' autocomplete='off' id='nome'>";
            }
            echo "<div id='nome_error'></div>";

            echo "<div class='font'><i class='fa fa-at'></i> E-mail</div>";
            echo "<input type='text' name='email' autocomplete='off' id='email'>";
            echo "<div id='email_error'>Insira seu E-mail</div>";

            echo "<div class='font'><i class='fa fa-user'></i> Usuário</div>";
            echo "<input type='text' name='usuario' autocomplete='off' id='usuario'>";
            echo "<div id='usuario_error'>Insira o usuário</div>";

            echo "<div class='font'><i class='fa fa-lock'></i> Senha</div>";
            echo "<input type='password' name='senha' id='senha'>";
            echo "<div id='pass_error'>Insira a senha</div>";
            echo "<div class='btn'>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<span></span>";
                echo "<input name='CadLogin' type='submit' value='Cadastrar'>";
            echo "</div>";
            echo "<p class='text-center font'><a href=". URLADM ."login/acesso>Logar-se</a></p>";
        echo "</form>";
    
echo "</div>";
?>