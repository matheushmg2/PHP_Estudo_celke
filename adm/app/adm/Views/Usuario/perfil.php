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
                <h2 class="display-4 titulo">Perfil do Usuário</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php 
                        if($this->Dados['botao']['EditarPerfil']) {
                            //echo "<a href='" . URLADM . "usuarios/listar' class='btn btn-outline-primary btn-sm'>Listar</a>";
                            echo " <a href='". URLADM . "EditarPerfil/editarPerfil' class='btn btn-outline-warning btn-sm'>Editar</a>";
                        }
                        if($this->Dados['botao']['AlterarSenha']) {
                            //echo "<a href='" . URLADM . "usuarios/listar' class='btn btn-outline-primary btn-sm'>Listar</a>";
                            echo " <a href='". URLADM . "AterarSenha/editarSenha' class='btn btn-outline-danger btn-sm'>Alterar Senha</a>";
                        }
                    ?>
                </span>
                <div class="dropdown d-block d-md-none">
                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                        <?php 
                            if($this->Dados['botao']['EditarPerfil']) {
                                //echo "<a href='" . URLADM . "usuarios/listar' class='btn btn-outline-primary btn-sm'>Listar</a>";
                                echo " <a class='dropdown-item' href='". URLADM . "EditarPerfil/editarPerfil' class='btn btn-outline-warning btn-sm'>Editar</a>";
                            }
                            if($this->Dados['botao']['AlterarSenha']) {
                                //echo "<a href='" . URLADM . "usuarios/listar' class='btn btn-outline-primary btn-sm'>Listar</a>";
                                echo " <a class='dropdown-item' href='". URLADM . "AterarSenha/editarSenha' class='btn btn-outline-danger btn-sm'>Alterar Senha</a>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php 
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
        <dl class="row">
            <?php
                //echo "<pre>";
                //var_dump($this->Dados['perfil'][0]);
                if (!empty($this->Dados['perfil'][0])) {
                    extract($this->Dados['perfil'][0]);
                ?>
                    <dt class="col-sm-3">Foto</dt>
                    <dd class="col-sm-9">
                        <?php 
                            if(!empty($_SESSION['usuario_image'])) {
                                echo "<img src='".URLADM."assets/image/usuarios/".$_SESSION['usuario_id']."/".$_SESSION['usuario_image']."' width='150px' height='150px'>"; 
                            } else {
                                echo "<img src='".URLADM."assets/image/usuarios/icone_usuario.png' width='150px' height='150px'>"; 
                            }
                        
                        ?>
                    </dd>

                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9"><?php echo $id; ?></dd>

                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9"><?php echo $nome; ?></dd>

                    <dt class="col-sm-3">Apelido</dt>
                    <dd class="col-sm-9">
                        <?php if(!empty($apelido)){ echo $apelido; } else{ echo "---------------";}?>
                    </dd>

                    <dt class="col-sm-3">E-mail</dt>
                    <dd class="col-sm-9"><?php echo $email; ?></dd>

                    <dt class="col-sm-3">Usuário</dt>
                    <dd class="col-sm-9"><?php echo $usuario; ?></dd>

                    <dt class="col-sm-3 text-truncate">Data do Cadastro</dt>
                    <dd class="col-sm-9"><?php echo date('d/m/Y H:i:s', strtotime($created)); ?></dd>
                <?php
                }
            ?>
        </dl>
    </div>
</div>