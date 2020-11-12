<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (isset($this->Dados['form'])) {
    $valorFormulario = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorFormulario = $this->Dados['form'][0];
}
//var_dump($this->Dados['select']);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Editar Item do Menu</h2>
            </div>

            <?php
            if ($this->Dados['botao']['VisualizarMenu']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'verMenu/verMenu/' . $valorFormulario['id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                </div>
                <?php
            }
            ?>

        </div><hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data"> 
            <input name="id" type="hidden" value="<?php
            if (isset($valorFormulario['id'])) {
                echo $valorFormulario['id'];
            }
            ?>">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Nome do Menu</label>
                    <input name="nome" type="text" class="form-control" placeholder="Nome da Página a ser apresentado no menu" value="<?php
                    if (isset($valorFormulario['nome'])) {
                        echo $valorFormulario['nome'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>
                        <span tabindex="0" data-toggle="tooltip" data-placement="top" data-html="true" title="Página de icone: <a href='https://fontawesome.com/icons?d=gallery' target='_blank'>fontawesome</a>. Somente inserir o nome, Ex: fas fa-volume-up">
                            <i class="fas fa-question-circle"></i>
                        </span> Ícone</label>
                    <input name="icones" type="text" class="form-control" placeholder="Ícone a ser apresentado no menu" value="<?php
                    if (isset($valorFormulario['icones'])) {
                        echo $valorFormulario['icones'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Situação da Página</label>
                    <select name="adm_situacoes_id" id="adm_situacoes_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['situacao'] as $situacao) {
                            extract($situacao);
                            if ($valorFormulario['adm_situacoes_id'] == $id_situacao) {
                                echo "<option value='$id_situacao' selected>$nome_situacao</option>";
                            } else {
                                echo "<option value='$id_situacao'>$nome_situacao</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
            </div>

            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditarItensMenu" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
