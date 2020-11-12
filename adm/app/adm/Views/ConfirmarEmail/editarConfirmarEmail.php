<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (isset($this->Dados['form'])) {
    $valorFormulario = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorFormulario = $this->Dados['form'][0];
}
//var_dump($this->Dados['select']);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Editar Confirmação de E-mail</h2>
            </div>

        </div><hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data"> 
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Nome Referência</label>
                    <input name="nome" type="text" class="form-control" placeholder="Nome do remetente" value="<?php
                    if (isset($valorFormulario['nome'])) {
                        echo $valorFormulario['nome'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> E-mail Referência</label>
                    <input name="email" type="text" class="form-control" placeholder="E-mail do remetente" value="<?php
                    if (isset($valorFormulario['email'])) {
                        echo $valorFormulario['email'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Host - Servidor E-mail</label>
                    <input name="host" type="text" class="form-control" placeholder="Servidor de envio de e-mail" value="<?php
                    if (isset($valorFormulario['host'])) {
                        echo $valorFormulario['host'];
                    }
                    ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Usuário do E-mail</label>
                    <input name="usuario" type="text" class="form-control" placeholder="Nome do remetente" value="<?php
                    if (isset($valorFormulario['usuario'])) {
                        echo $valorFormulario['usuario'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Senha do E-mail</label>
                    <input name="senha" type="password" class="form-control" placeholder="E-mail do remetente" value="<?php
                    if (isset($valorFormulario['senha'])) {
                        echo $valorFormulario['senha'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Encriptação - SMTP</label>
                    <input name="smtp_secure" type="text" class="form-control" placeholder="Tipo de encriptação SSL/TLS" value="<?php
                    if (isset($valorFormulario['smtp_secure'])) {
                        echo $valorFormulario['smtp_secure'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Porta</label>
                    <input name="porta" type="text" class="form-control" placeholder="Porta de envio de E-mail" value="<?php
                    if (isset($valorFormulario['porta'])) {
                        echo $valorFormulario['porta'];
                    }
                    ?>">
                </div>
            </div>

            <div class="form-row">
            </div>

            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditarConfirmarEmail" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
