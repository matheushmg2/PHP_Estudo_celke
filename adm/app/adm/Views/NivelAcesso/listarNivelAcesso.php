<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

//var_dump($this->Dados['botao']);
?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Listar Nível de Acesso</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php 
                        if ($this->Dados['botao']['Sincronizar']) {
                            echo "<a href='" . URLADM . "SincronizarNivelAcessoPagina/SincronizarNivelAcessoPagina' class='btn btn-outline-warning btn-sm'>Sincronizar</a> ";
                        }
                        if($this->Dados['botao']['CadastrarNivelAcesso']) {
                            echo "<a href='". URLADM . "CadastrarNivelAcesso/cadastrarNivelAcesso' class='btn btn-outline-success btn-sm'> Cadastrar</a>";
                        }
                    ?>
                </span>
            </div>
        </div>
        <?php
        if (empty($this->Dados['listarNivelAcesso'])) {
        ?>
            <div class="alert alert-warning" role="alert">
                Descupe não há Usuário no Sistema - Cadastre-o
            </div>
        <?php
        }
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <!--<th style="display:none;">ID</th> Para ocultar o nome da tabela ID-->
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">Ordem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qnt_linhas_exe = 1;
                    foreach ($this->Dados['listarNivelAcesso'] as $nivelAcesso) {
                        extract($nivelAcesso);
                    ?>
                        <tr>
                            <!--<th style="display:none;">< ?php echo $id;?></th> Para ocultar o conteudo da tabela ID-->
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $ordem; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                <?php 
                                    if ($qnt_linhas_exe <= 2) {
                                        if ($this->Dados['botao']['OrdemNivelAcesso']) {
                                            echo "<button class='btn btn-outline-secondary btn-sm disabled'><i class='fas fa-angle-double-up'></i></button> ";
                                        }
                                    } else {
                                        if ($this->Dados['botao']['OrdemNivelAcesso']) {
                                            echo "<a href='" . URLADM . "AlterarOrdemNivelAcesso/alterarOrdemNivelAcesso/$id' class='btn btn-outline-secondary btn-sm'><i class='fas fa-angle-double-up'></i></a> ";
                                        }
                                    }
                                    $qnt_linhas_exe++;
                                    if ($this->Dados['botao']['Permissoes']) {
                                        echo "<a href='" . URLADM . "Permissoes/listar/1?niv=$id' class='btn btn-outline-info btn-sm'>Permissão</a> ";
                                    }
                                    if ($this->Dados['botao']['VisualizarNivelAcesso']) {
                                        echo "<a href='" . URLADM . "VerNivelAcesso/verNivelAcesso/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['EditarNivelAcesso']) {
                                        echo "<a href='" . URLADM . "EditarNivelAcesso/editarNivelAcesso/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['ApagarNivelAcesso']) {
                                        echo "<a href='" . URLADM . "ApagarNivelAcesso/apagarNivelAcesso/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php 
                                            if ($this->Dados['botao']['vis_nivac']) {
                                                echo "<a class='dropdown-item' href='" . URLADM . "VerNivelAcesso/verNivelAcesso/$id'>Visualizar</a>";
                                            }
                                            if ($this->Dados['botao']['edit_nivac']) {
                                                echo "<a class='dropdown-item' href='" . URLADM . "EditarNivelAcesso/editarNivelAcesso//$id'>Editar</a>";
                                            }
                                            if ($this->Dados['botao']['del_nivac']) {
                                                echo "<a class='dropdown-item' href='" . URLADM . "ApagarNivelAcesso/apagarNivelAcesso//$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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