<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['usuario'][0])) {
    extract($this->Dados['usuario'][0]);
?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Vizualização do Usuário</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php 
                            if($this->Dados['botao']['ListarUsuario']) {
                                //echo "<a href='" . URLADM . "usuarios/listar' class='btn btn-outline-primary btn-sm'>Listar</a>";
                                echo "<a href='". URLADM . "usuarios/listar' class='btn btn-outline-info btn-sm'>Listar</a>";
                            }
                            if($this->Dados['botao']['EditarUsuario']) {
                                echo " <a href=" . URLADM . 'editarUsuario/editarUsuario/'.$id ." class='btn btn-outline-warning btn-sm'>Editar</a>";
                            }
                            if($this->Dados['botao']['EditarSenha']) {
                                echo " <a href=" . URLADM . 'EditarSenha/editarSenha/'.$id ." class='btn btn-outline-danger btn-sm'>Editar Senha</a>";
                            }
                            if($this->Dados['botao']['ApagarUsuario']) {
                                echo " <a href=" . URLADM . 'ApagarUsuario/apagarUsuario/'.$id." class='btn btn-outline-danger btn-sm' data-confirm='Deseja Apagar o Usuário?'>Apagar</a>";
                            }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <?php 
                                if($this->Dados['botao']['ListarUsuario']) {
                                    //echo "<a href='" . URLADM . "usuarios/listar' class='btn btn-outline-primary btn-sm'>Listar</a>";
                                    echo "<a class='dropdown-item' href='". URLADM . "usuarios/listar' class='btn btn-outline-info btn-sm'>Listar</a>";
                                }
                                if($this->Dados['botao']['EditarUsuario']) {
                                    echo " <a class='dropdown-item' href=" . URLADM . 'editarUsuario/editarUsuario/'.$id ." class='btn btn-outline-warning btn-sm'>Editar</a>";
                                }
                                if($this->Dados['botao']['EditarSenha']) {
                                    echo " <a class='dropdown-item' href=" . URLADM . 'EditarSenha/editarSenha/'.$id ." class='btn btn-outline-danger btn-sm'>Editar Senha</a>";
                                }
                                if($this->Dados['botao']['ApagarUsuario']) {
                                    echo " <a class='dropdown-item' href=" . URLADM . 'ApagarUsuario/apagarUsuario/'.$id." class='btn btn-outline-danger btn-sm' data-confirm='Deseja Apagar o Usuário?'>Apagar</a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <dl class="row">
                <dt class="col-sm-3">Foto</dt>
                <dd class="col-sm-9">
                    <?php
                    if (!empty($imagem)) {
                        echo "<img src='" . URLADM . "assets/image/usuarios/" . $id . "/" . $imagem . "' width='150px' height='150px'>";
                    } else {
                        echo "<img src='" . URLADM . "assets/image/usuarios/icone_usuario.png' width='150px' height='150px'>";
                    }

                    ?>
                </dd>

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id; ?></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?php echo $nome; ?></dd>

                <dt class="col-sm-3">Apelido</dt>
                <dd class="col-sm-9">
                    <?php if (!empty($apelido)) {
                        echo $apelido;
                    } else {
                        echo "---------------";
                    } ?>
                </dd>

                <dt class="col-sm-3">E-mail</dt>
                <dd class="col-sm-9"><?php echo $email; ?></dd>

                <dt class="col-sm-3">Usuário</dt>
                <dd class="col-sm-9"><?php echo $usuario; ?></dd>

                <dt class="col-sm-3">Nível de Acesso</dt>
                <dd class="col-sm-9"><?php echo $nome_nivel; ?></dd>

                <dt class="col-sm-3">Sua Situação</dt>
                <dd class="col-sm-9"><span class="badge badge-<?php echo $cores; ?>"><?php echo $nome_situacao; ?></span></dd>

                <?php if ($modified != NULL) {
                    echo "<dt class='col-sm-3 text-truncate'>Data da Modificação</dt>";
                    echo "<dd class='col-sm-9'> " . date('d/m/Y H:i:s', strtotime($modified)) . "</dd>";
                } else {
                    echo "<dt class='col-sm-3 text-truncate'>Data do Cadastro</dt>";
                    echo "<dd class='col-sm-9'> " . date('d/m/Y H:i:s', strtotime($created)) . "</dd>";
                } ?>
            </dl>
        </div>
    </div>
<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhum Usuário Encontrado</div>";
    $UrlDestino = URLADM . "usuarios/listar";
    header("Location: $UrlDestino");
}
?>