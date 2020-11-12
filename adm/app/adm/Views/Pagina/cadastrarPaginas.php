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
                <h2 class="display-4 titulo">Cadastrar Página</h2>
            </div>
            <?php
            if ($this->Dados['botao']['ListarPagina']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'Pagina/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Nome da Página</label>
                    <input name="nome_pagina" type="text" class="form-control" placeholder="Nome da Página a ser apresentado no menu" value="<?php
                    if (isset($valorFormulario['nome_pagina'])) {
                        echo $valorFormulario['nome_pagina'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Classe/Controller</label>
                    <input name="controller" type="text" class="form-control" placeholder="Nome da Classe" value="<?php
                    if (isset($valorFormulario['controller'])) {
                        echo $valorFormulario['controller'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Método</label>
                    <input name="metodo" type="text" class="form-control" placeholder="Nome do Método" value="<?php
                    if (isset($valorFormulario['metodo'])) {
                        echo $valorFormulario['metodo'];
                    }
                    ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Classe/Controller no menu</label>
                    <input name="menu_controller" type="text" class="form-control" placeholder="Nome da classe no menu" value="<?php
                    if (isset($valorFormulario['menu_controller'])) {
                        echo $valorFormulario['menu_controller'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Método no menu</label>
                    <input name="menu_metodo" type="text" class="form-control" placeholder="Nome do método no menu" value="<?php
                    if (isset($valorFormulario['menu_metodo'])) {
                        echo $valorFormulario['menu_metodo'];
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
            </div>


            <div class="form-group">
                <label><span class="text-danger">*</span> Observação</label>
                <textarea name="observacoes" class="form-control" rows="3"><?php if (isset($valorFormulario['observacoes'])) { echo $valorFormulario['observacoes']; } ?>
                </textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Página Pública</label>
                    <select name="liberado_publico" id="liberado_publico" class="form-control">
                        <?php
                            if ($valorFormulario['liberado_publico'] == 1) {
                                echo "<option value=''>Selecione</option>";
                                echo "<option value='1' selected>Sim</option>";
                                echo "<option value='2'>Não</option>";
                            } elseif ($valorFormulario['liberado_publico'] == 2)  {
                                echo "<option value=''>Selecione</option>";
                                echo "<option value='1'>Sim</option>";
                                echo "<option value='2' selected>Não</option>";
                            }else{
                                echo "<option value='' selected>Selecione</option>";
                                echo "<option value='1'>Sim</option>";
                                echo "<option value='2'>Não</option>";                                
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Grupo da Página</label>
                    <select name="adm_grupos_paginas_id" id="adm_grupos_paginas_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['grupoPagina'] as $grupoPagina) {
                            extract($grupoPagina);
                            if ($valorFormulario['adm_grupos_paginas_id'] == $id_grupoPagina) {
                                echo "<option value='$id_grupoPagina' selected>$nome_grupoPagina</option>";
                            } else {
                                echo "<option value='$id_grupoPagina'>$nome_grupoPagina</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Tipo da Página</label>
                    <select name="adm_tipos_paginas_id" id="adm_tipos_paginas_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['tiposPagina'] as $tiposPagina) {
                            extract($tiposPagina);
                            if ($valorFormulario['adm_tipos_paginas_id'] == $id_tiposPagina) {
                                echo "<option value='$id_tiposPagina' selected>$nome_tiposPagina</option>";
                            } else {
                                echo "<option value='$id_tiposPagina'>$tipo_tiposPagina - $nome_tiposPagina</option>";
                            }
                        }
                        ?>
                    </select>
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
            <hr>
            
            <h4 class="display-2 titulo">Cadastrar Acesso da Página</h4>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Dropdown</label>
                    <select name="dropdown" id="dropdown" class="form-control">
                        <?php
                            if ($valorFormulario['dropdown'] == 1) {
                                echo "<option value=''>Selecione</option>";
                                echo "<option value='1' selected>Sim</option>";
                                echo "<option value='2'>Não</option>";
                            } elseif ($valorFormulario['dropdown'] == 2) {
                                echo "<option value=''>Selecione</option>";
                                echo "<option value='1'>Sim</option>";
                                echo "<option value='2' selected>Não</option>";
                            }else{
                                echo "<option value='' selected>Selecione</option>";
                                echo "<option value='1'>Sim</option>";
                                echo "<option value='2'>Não</option>";                                
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Liberado Menu</label>
                    <select name="liberado_menu" id="liberado_menu" class="form-control">
                        <?php
                            if ($valorFormulario['liberado_menu'] == 1) {
                                echo "<option value=''>Selecione</option>";
                                echo "<option value='1' selected>Sim</option>";
                                echo "<option value='2'>Não</option>";
                            } elseif ($valorFormulario['liberado_menu'] == 2) {
                                echo "<option value=''>Selecione</option>";
                                echo "<option value='1'>Sim</option>";
                                echo "<option value='2' selected>Não</option>";
                            }else{
                                echo "<option value='' selected>Selecione</option>";
                                echo "<option value='1'>Sim</option>";
                                echo "<option value='2'>Não</option>";                                
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Menu</label>
                    <select name="adm_menus_id" id="adm_menus_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['menu'] as $menu) {
                            extract($menu);
                            if ($valorFormulario['adm_menus_id'] == $id_menu) {
                                echo "<option value='$id_menu' selected>$nome_menu</option>";
                            } else {
                                echo "<option value='$id_menu'>$nome_menu</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadastrarPaginas" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
