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
                <h2 class="display-4 titulo">Cadastrar Grupo de Página</h2>
            </div>
            <?php
            if ($this->Dados['botao']['ListarGrupoPagina']) {
                ?>
                <div class="p-2">
                <a href="<?php echo URLADM . 'GrupoPagina/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label><span class="text-danger">*</span> Nome</label>
                    <input name="nome" type="text" class="form-control" placeholder="Nome do grupo da página" value="<?php
                    if (isset($valorFormulario['nome'])) {
                        echo $valorFormulario['nome'];
                    }
                    ?>">
                </div>
            </div>

            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadastrarGrupoPagina" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
