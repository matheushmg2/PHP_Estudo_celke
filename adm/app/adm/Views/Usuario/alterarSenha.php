<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Alterar Senha</h2>
            </div>
            <div class="p-2">
                <?php 
                    if($this->Dados['botao']['VerPerfil']) {
                        echo "<a href='" . URLADM . "VerPerfil/perfil' class='btn btn-outline-primary btn-sm'>Visualizar</a>";
                    }
                ?>
            </div>
        </div>
        <hr>
        <?php 
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
        <form method="POST" action="">
            <div class="form-group col-md-8">
                <label>Senha</label>
                <input name="senha" type="password" class="form-control" id="senha" placeholder="Senha com mínimo 6 caracteres">
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input type="submit" name="AlterarSenha" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>