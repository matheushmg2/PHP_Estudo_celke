<?php
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
                <h2 class="display-4 titulo">Editar Tipo de Página</h2>
            </div>

            <?php
            if ($this->Dados['botao']['VerTipoPagina']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'VerTipoPagina/verTipoPagina/' . $valorFormulario['id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Tipo</label>
                    <input name="tipo" type="text" class="form-control" placeholder="Tipo da página Ex: adms, sts" value="<?php
                    if (isset($valorFormulario['tipo'])) {
                        echo $valorFormulario['tipo'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome</label>
                    <input name="nome" type="text" class="form-control" placeholder="Nome do tipo da página" value="<?php
                    if (isset($valorFormulario['nome'])) {
                        echo $valorFormulario['nome'];
                    }
                    ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label><span class="text-danger">*</span> Observação</label>
                <textarea name="observacoes" class="form-control" rows="3"><?php
                    if (isset($valorFormulario['observacoes'])) {
                        echo $valorFormulario['observacoes'];
                    }
                    ?>
                </textarea>
            </div>
            
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditarTipoPagina" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
