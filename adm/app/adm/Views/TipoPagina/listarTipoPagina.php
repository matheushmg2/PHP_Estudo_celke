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
                <h2 class="display-4 titulo">Listar Tipo das Páginas</h2>
            </div>
            <?php
            if ($this->Dados['botao']['CadastrarTipoPagina']) {
                ?>
                <a href="<?php echo URLADM . 'CadastrarTipoPagina/cadastrarTipoPagina'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-success btn-sm">
                            Cadastrar
                        </button>
                    </div>
                </a>
                <?php
            }
            ?>

        </div>
        <?php
        if (empty($this->Dados['listarTipoPagina'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum tipo de página encontrado!
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
                        <th>Tipo - Nome</th>
                        <th class="d-none d-sm-table-cell">ordem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listarTipoPagina'] as $tipoPagina) {
                        extract($tipoPagina);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td>
                                <?php echo  $tipo. " - " . $nome; ?>
                            </td>
                            <td class="d-none d-sm-table-cell"><?php echo $ordem; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['OrdemTipoPagina']) {
                                        echo "<a href='" . URLADM . "alterarOrdemTipoPagina/alterarOrdemTipoPagina/$id' class='btn btn-outline-secondary btn-sm'><i class='fas fa-angle-double-up'></i></a> ";
                                    }
                                    if ($this->Dados['botao']['VerTipoPagina']) {
                                        echo "<a href='" . URLADM . "VerTipoPagina/VerTipoPagina/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['EditarTipoPagina']) {
                                        echo "<a href='" . URLADM . "EditarTipoPagina/EditarTipoPagina/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['ApagarTipoPagina']) {
                                        echo "<a href='" . URLADM . "ApagarTipoPagina/ApagarTipoPagina/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_tpg']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-tipo-pg/ver-tipo-pg/$id'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_tpg']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-tipo-pg/edit-tipo-pg/$id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_tpg']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-tipo-pg/apagar-tipo-pg/$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
            echo $this->Dados['paginação'];
            ?>
        </div>
    </div>
</div>
