<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (empty($this->Dados['listarUsuario'])) {
    
    echo "<div class='alert alert-warning' role='alert'>Descupe não há Usuário no Sistema - Cadastre-o</div>";

    }

?>
<div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <!--<th style="display:none;">ID</th> Para ocultar o nome da tabela ID-->
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">E-mail</th>
                        <th class="d-none d-lg-table-cell">Situação</th>
                        <?php if($this->Dados['botao']['VisualizarUsuario'] || $this->Dados['botao']['EditarUsuario'] || $this->Dados['botao']['ApagarUsuario']) {?>
                        <th class="text-center">Ações</th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listarUsuario'] as $usuario) {
                        extract($usuario);
                    ?>
                        <tr>
                            <!--<th style="display:none;">< ?php echo $id;?></th> Para ocultar o conteudo da tabela ID-->
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $email; ?></td>
                            <td class="d-none d-lg-table-cell">
                                <span class="badge badge-<?php echo $cores; ?>"><?php echo $nome_situacao; ?></span>

                            </td>
                            <?php if($this->Dados['botao']['VisualizarUsuario'] || $this->Dados['botao']['EditarUsuario'] || $this->Dados['botao']['ApagarUsuario']) {?>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                <?php 
                                    /*if($this->Dados['botao']['VisualizarUsuario']) {
                                        echo " <a href=" . URLADM . 'VerUsuario/verUsuario/'.$id ." class='btn btn-outline-primary btn-sm'>Visualizar</a>";
                                    }*/
                                    if($this->Dados['botao']['VisualizarUsuario']) {
                                        echo " <button type='button' class='btn btn-outline-primary btn-sm view_data' id='".$id."'>Visualizar</button>";
                                    }
                                    if($this->Dados['botao']['EditarUsuario']) {
                                        echo " <a href=" . URLADM . 'editarUsuario/editarUsuario/'.$id ." class='btn btn-outline-warning btn-sm'>Editar</a>";
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
                                            if($this->Dados['botao']['VisualizarUsuario']) {
                                                echo "<a class='dropdown-item' href=" . URLADM . 'VerUsuario/verUsuario/'.$id ." class='btn btn-outline-primary btn-sm'>Visualizar</a>";
                                            }
                                            if($this->Dados['botao']['EditarUsuario']) {
                                                echo "<a class='dropdown-item' href=" . URLADM . 'editarUsuario/editarUsuario/'.$id ." class='btn btn-outline-warning btn-sm'>Editar</a>";
                                            }
                                            if($this->Dados['botao']['ApagarUsuario']) {
                                                echo "<a class='dropdown-item' href=" . URLADM . 'ApagarUsuario/apagarUsuario/'.$id." class='btn btn-outline-danger btn-sm' data-confirm='Deseja Apagar o Usuário?'>Apagar</a>";
                                            }
                                        ?>
                                        <!--
                                        <a href="< ?php echo URLADM . 'VerUsuario/verUsuario/'.$id;?>">Visualizar</a>
                                        <a class='dropdown-item' href="< ?php echo URLADM . 'editarUsuario/editarUsuario/'.$id;?>">Editar</a>
                                        <a class='dropdown-item' href="< ?php echo URLADM . 'ApagarUsuario/apagarUsuario/'.$id;?>" data-toggle='modal' data-target='#apagarRegistro'>Apagar</a> -->
                                    </div>
                                </div>
                            </td>
                            <?php }?>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
            <?php 
                echo $this->Dados['paginação']; // Imprimo a páginação
            ?>
        </div>