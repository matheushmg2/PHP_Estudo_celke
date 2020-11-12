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
                <h2 class="display-4 titulo">Listar Itens Menu</h2>
            </div>
            <?php
            if ($this->Dados['botao']['CadastrarItensMenu']) {
                ?>
                <a href="<?php echo URLADM . 'CadastrarItensMenu/cadastrarItensMenu'; ?>">
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
        if (empty($this->Dados['listarItensMenu'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum item de Menu encontrado!
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
                        <th class="d-none d-sm-table-cell">Ordem</th>
                        <th class="d-none d-sm-table-cell">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listarItensMenu'] as $itensMenu) {
                        extract($itensMenu);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo "<i class='". $icones ."'></i> - " . $nome; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $ordem; ?></td>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge badge-<?php echo $cores; ?>"><?php echo $nome_situacao; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['OrdenarItensMenu']) {
                                        echo "<a href='" . URLADM . "AlterarOrdemItensMenu/AlterarOrdemItensMenu/$id' class='btn btn-outline-secondary btn-sm'><i class='fas fa-angle-double-up'></i></a> ";
                                    }
                                    if ($this->Dados['botao']['VerMenu']) {
                                        echo "<a href='" . URLADM . "VerMenu/verMenu/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['EditarItensMenu']) {
                                        echo "<a href='" . URLADM . "EditarItensMenu/editarItensMenu/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['ApagarMenu']) {
                                        echo "<a href='" . URLADM . "ApagarItensMenu/apagarItensMenu/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['VerMenu']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "VerMenu/verMenu/$id'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['EditarItensMenu']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "EditarItensMenu/editarItensMenu/$id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['ApagarPagina']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ApagarPagina/apagarPagina/$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
