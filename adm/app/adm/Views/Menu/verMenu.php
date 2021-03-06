<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['itensMenu'][0])) {
    extract($this->Dados['itensMenu'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Ver Itens de Menu</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['ListarMenu']) {
                            echo "<a href='" . URLADM . "Menu/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['EditarPagina']) {
                            echo "<a href='" . URLADM . "editar-pagina/edit-pagina/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->Dados['botao']['ApagarPagina']) {
                            echo "<a href='" . URLADM . "apagar-pagina/apagar-pagina/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['ListarMenu']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "Menu/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['EditarPagina']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-pagina/edit-pagina/$id'>Editar</a>";
                            }
                            if ($this->Dados['botao']['ApagarPagina']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-pagina/apagar-pagina/$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div><hr>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <dl class="row">

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id; ?></dd>

                <dt class="col-sm-3">Nome do Menu</dt>
                <dd class="col-sm-9"><?php echo "<i class='". $icones ."'></i> - " . $nome; ?></dd>

                <dt class="col-sm-3">Situação</dt>
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Item Menu não encontrado!</div>";
    $UrlDestino = URLADM . 'Menu/listar';
    header("Location: $UrlDestino");
}
