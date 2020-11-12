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
                <h2 class="display-4 titulo">Listar Cores - Bootstrap</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['CadastrarCores']) {
                    echo "<a href='" . URLADM . "CadastrarCores/cadastrarCores' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>                
            </div>

        </div>
        <?php
        if (empty($this->Dados['listarCores'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma cor encontrada!
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
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">Cor</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listarCores'] as $cor) {
                        extract($cor);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome; ?></td>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge badge-<?php echo $cor; ?>"><?php echo $cor; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['VisualizarCores']) {
                                        echo "<a href='" . URLADM . "VerCores/VerCores/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['EditarCores']) {
                                        echo "<a href='" . URLADM . "EditarCores/editarCores/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['ApagarCores']) {
                                        echo "<a href='" . URLADM . "ApagarCores/apagarCores/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_cor']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-cor/ver-cor/$id'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_cor']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-cor/edit-cor/$id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_cor']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-cor/apagar-cor/$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
