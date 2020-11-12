<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['usuario'][0])) {
    extract($this->Dados['usuario'][0]);
?>

    <dl class="row">
        <dt class="col-sm-4">Foto</dt>
        <dd class="col-sm-8">
            <?php
            if (!empty($imagem)) {
                echo "<img src='" . URLADM . "assets/image/usuarios/" . $id . "/" . $imagem . "' width='150px' height='150px'>";
            } else {
                echo "<img src='" . URLADM . "assets/image/usuarios/icone_usuario.png' width='150px' height='150px'>";
            }

            ?>
        </dd>

        <dt class="col-sm-4">ID</dt>
        <dd class="col-sm-8"><?php echo $id; ?></dd>

        <dt class="col-sm-4">Nome</dt>
        <dd class="col-sm-8"><?php echo $nome; ?></dd>

        <dt class="col-sm-4">Apelido</dt>
        <dd class="col-sm-8">
            <?php if (!empty($apelido)) {
                echo $apelido;
            } else {
                echo "---------------";
            } ?>
        </dd>

        <dt class="col-sm-4">E-mail</dt>
        <dd class="col-sm-8"><?php echo $email; ?></dd>

        <dt class="col-sm-4">Usuário</dt>
        <dd class="col-sm-8"><?php echo $usuario; ?></dd>

        <dt class="col-sm-4">Nível de Acesso</dt>
        <dd class="col-sm-8"><?php echo $nome_nivel; ?></dd>

        <dt class="col-sm-4">Sua Situação</dt>
        <dd class="col-sm-8"><span class="badge badge-<?php echo $cores; ?>"><?php echo $nome_situacao; ?></span></dd>

        <?php if ($modified != NULL) {
            echo "<dt class='col-sm-4 text-truncate'>Data da Modificação</dt>";
            echo "<dd class='col-sm-8'> " . date('d/m/Y H:i:s', strtotime($modified)) . "</dd>";
        } else {
            echo "<dt class='col-sm-4 text-truncate'>Data do Cadastro</dt>";
            echo "<dd class='col-sm-8'> " . date('d/m/Y H:i:s', strtotime($created)) . "</dd>";
        } ?>
    </dl>

<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhum Usuário Encontrado</div>";
    $UrlDestino = URLADM . "carregarUsuariosJS/listar";
    header("Location: $UrlDestino");
}
?>