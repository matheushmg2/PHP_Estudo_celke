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
                <h2 class="display-4 titulo">
                    <?php
                    if(!empty($this->Dados['nivelAcesso'])){
                        echo "Listar Permissões - {$this->Dados['nivelAcesso'][0]['nome']}";
                    }
                    ?>
                </h2>
            </div>
            <?php
            if ($this->Dados['botao']['ListarNivelAcesso']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'nivelAcesso/listar'; ?>" class="btn btn-outline-info btn-sm">Nível de Acesso</a>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        if (empty($this->Dados['listarPermissoes'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma permissão encontrada!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Página</th>
                        <th class="d-none d-sm-table-cell">Permissão</th>
                        <th class="d-none d-sm-table-cell">Menu</th>
                        <th class="d-none d-sm-table-cell">Dropdown</th>
                        <th class="d-none d-sm-table-cell">Ordem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qnt_linhas_exe = 1;
                    foreach ($this->Dados['listarPermissoes'] as $permissao) {
                        extract($permissao);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome_pagina; ?></td>
                            <td class="d-none d-sm-table-cell">
                                <?php
                                if ($this->Dados['botao']['LiberarPermissoes']) {
                                    if ($permissao == 1) {
                                        echo "<a href='" . URLADM . "liberarPermissoes/liberarPermissoes/$id?niv={$this->Dados['nivelAcesso'][0]['id']}&pg={$this->Dados['pg']}'><span class='badge badge-pill badge-success'>Liberado</span></a> ";
                                    } else {
                                        echo "<a href='" . URLADM . "liberarPermissoes/liberarPermissoes/$id?niv={$this->Dados['nivelAcesso'][0]['id']}&pg={$this->Dados['pg']}'><span class='badge badge-pill badge-danger'>Bloqueado</span></a> ";
                                    }
                                } else {
                                    if ($permissao == 1) {
                                        echo "<span class='badge badge-pill badge-success'>Liberado</span>";
                                    } else {
                                        echo "<span class='badge badge-pill badge-danger'>Bloqueado</span>";
                                    }
                                }
                                ?>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <?php
                                if ($this->Dados['botao']['LiberarMenu']) {
                                    if ($liberado_menu == 1) {
                                        echo "<a href='" . URLADM . "LiberarMenu/liberarMenu/$id?niv={$this->Dados['nivelAcesso'][0]['id']}&pg={$this->Dados['pg']}'><span class='badge badge-pill badge-success'>Liberado</span></a> ";
                                    } else {
                                        echo "<a href='" . URLADM . "liberarMenu/liberarMenu/$id?niv={$this->Dados['nivelAcesso'][0]['id']}&pg={$this->Dados['pg']}'><span class='badge badge-pill badge-danger'>Bloqueado</span></a> ";
                                    }
                                } else {
                                    if ($liberado_menu == 1) {
                                        echo "<span class='badge badge-pill badge-success'>Liberado</span>";
                                    } else {
                                        echo "<span class='badge badge-pill badge-danger'>Bloqueado</span>";
                                    }
                                }
                                ?>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <?php
                                if ($this->Dados['botao']['LiberarDropdown']) {
                                    if ($dropdown == 1) {
                                        echo "<a href='" . URLADM . "LiberarDropdown/liberarDropdown/$id?niv={$this->Dados['nivelAcesso'][0]['id']}&pg={$this->Dados['pg']}'><span class='badge badge-pill badge-success'>Sim</span></a> ";
                                    } else {
                                        echo "<a href='" . URLADM . "LiberarDropdown/LiberarDropdown/$id?niv={$this->Dados['nivelAcesso'][0]['id']}&pg={$this->Dados['pg']}'><span class='badge badge-pill badge-danger'>Não</span></a> ";
                                    }
                                } else {
                                    if ($dropdown == 1) {
                                        echo "<span class='badge badge-pill badge-success'>Liberado</span>";
                                    } else {
                                        echo "<span class='badge badge-pill badge-danger'>Bloqueado</span>";
                                    }
                                }
                                ?>
                            </td>
                            <td><?php echo $ordem; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['OrdemMenu']) {
                                        if (($qnt_linhas_exe <= 1) AND ($this->Dados['pg'] == 1)) {
                                            echo "<button class='btn btn-outline-secondary btn-sm disabled'><i class='fas fa-angle-double-up'></i></button>";
                                        } else {
                                            echo "<a href='" . URLADM . "AlterarOrdemMenu/alterarOrdemMenu/$id?niv={$this->Dados['nivelAcesso'][0]['id']}&pg={$this->Dados['pg']}' class='btn btn-outline-secondary btn-sm'><i class='fas fa-angle-double-up'></i></a> ";
                                        }
                                    }
                                    $qnt_linhas_exe++;
                                    if ($this->Dados['botao']['EditarNivelAcessoPaginaMenu']) {
                                        echo " <a href='" . URLADM . "EditarNivelAcessoPaginaMenu/editarNivelAcessoPaginaMenu/$id?niv={$this->Dados['nivelAcesso'][0]['id']}&pg={$this->Dados['pg']}' class='btn btn-outline-warning btn-sm'> Editar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php                                        
                                        if ($this->Dados['botao']['EditarNivelAcessoPaginaMenu']) {
                                            echo "<a href='" . URLADM . "EditarNivelAcessoPaginaMenu/editarNivelAcessoPaginaMenu/$id?niv={$this->Dados['nivelAcesso'][0]['id']}&pg={$this->Dados['pg']}' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                        }
                                        ?>


                                    </div>
                                </div>
                            </td>
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
    </div>
</div>
