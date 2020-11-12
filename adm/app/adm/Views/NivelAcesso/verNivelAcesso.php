<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['verNivelAcesso'][0])) {
    extract($this->Dados['verNivelAcesso'][0]);
?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Ver Nível de Acesso</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php 
                            if($this->Dados['botao']['ListarNivelAcesso']) {
                                //echo "<a href='" . URLADM . "usuarios/listar' class='btn btn-outline-primary btn-sm'>Listar</a>";
                                echo "<a href='". URLADM . "NivelAcesso/listar' class='btn btn-outline-info btn-sm'>Listar</a>";
                            }
                            if($this->Dados['botao']['EditarNivelAcesso']) {
                                echo " <a href=" . URLADM . 'EditarNivelAcesso/editarNivelAcesso/'.$id ." class='btn btn-outline-warning btn-sm'>Editar</a>";
                            }
                            if($this->Dados['botao']['ApagarNivelAcesso']) {
                                echo " <a href=" . URLADM . 'ApagarNivelAcesso/apagarNivelAcesso/'.$id." class='btn btn-outline-danger btn-sm' data-confirm='Deseja Apagar o Usuário?'>Apagar</a>";
                            }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <?php 
                                if($this->Dados['botao']['ListarNivelAcesso']) {
                                    //echo "<a href='" . URLADM . "usuarios/listar' class='btn btn-outline-primary btn-sm'>Listar</a>";
                                    echo "<a class='dropdown-item' href='". URLADM . "NivelAcesso/listar' class='btn btn-outline-info btn-sm'>Listar</a>";
                                }
                                if($this->Dados['botao']['EditarNivelAcesso']) {
                                    echo " <a class='dropdown-item' href=" . URLADM . 'EditarNivelAcesso/editarNivelAcesso/'.$id ." class='btn btn-outline-warning btn-sm'>Editar</a>";
                                }
                                if($this->Dados['botao']['ApagarNivelAcesso']) {
                                    echo " <a class='dropdown-item' href=" . URLADM . 'ApagarNivelAcesso/apagarNivelAcesso/'.$id." class='btn btn-outline-danger btn-sm' data-confirm='Deseja Apagar o Usuário?'>Apagar</a>";
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
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id; ?></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?php echo $nome; ?></dd>

                <dt class="col-sm-3">Ordem</dt>
                <dd class="col-sm-9"><?php echo $ordem; ?></dd>

                <dt class="col-sm-3">Usuários Cadastrados</dt>
                <dd class="col-sm-9"><?php echo $qnt_user; ?></dd>

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
    $_SESSION['msg'] = "<div class='alert alert-warning text-center'><i class='fas fa-exclamation-triangle'></i>  Nenhum Nível de Acesso Encontrado</div>";
    $UrlDestino = URLADM . "NivelAcesso/listar";
    header("Location: $UrlDestino");
}
?>