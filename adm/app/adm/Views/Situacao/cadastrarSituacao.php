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
                <h2 class="display-4 titulo">Cadastrar Situação</h2>
            </div>
            <?php
            if ($this->Dados['botao']['ListarSituacao']) {
                ?>
                <div class="p-2">
                <a href="<?php echo URLADM . 'Situacao/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome</label>
                    <input name="nome" type="text" class="form-control" placeholder="Nome da situação" value="<?php
                    if (isset($valorFormulario['nome'])) {
                        echo $valorFormulario['nome'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Cor</label>
                    <select name="adm_cores_id" id="adm_cores_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['cores'] as $cores) {
                            extract($cores);
                            if ($valorFormulario['adm_cores_id'] == $id_cor) {
                                echo "<option value='$id_cor' selected>$nome_cor</option>";
                            } else {
                                echo "<option value='$id_cor'>$nome_cor</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadastrarSituacao" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
