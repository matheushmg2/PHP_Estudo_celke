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
                <h2 class="display-4 titulo">Editar Form Cadastrar Usuário</h2>
            </div>

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
                    <label><span class="text-danger">*</span> Enviar E-mail de Confirmação</label>
                    <select name="enviado_email_confirmado" id="enviado_email_confirmado" class="form-control">
                        <?php
                            if ($valorFormulario['enviado_email_confirmado'] == 1) {
                                echo "<option value=''>Selecione</option>";
                                echo "<option value='1' selected>Sim</option>";
                                echo "<option value='2'>Não</option>";
                            } elseif ($valorFormulario['enviado_email_confirmado'] == 2)  {
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
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label><span class="text-danger">*</span> Situação</label>
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
                <div class="form-group col-md-12">
                    <label><span class="text-danger">*</span> Nível de Acesso</label>
                    <select name="adm_niveis_acessos_id" id="adm_niveis_acessos_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['nivac'] as $nivac) {
                            extract($nivac);
                            if ($valorFormulario['adm_niveis_acessos_id'] == $id_nivac) {
                                echo "<option value='$id_nivac' selected>$nome_nivac</option>";
                            } else {
                                echo "<option value='$id_nivac'>$nome_nivac</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditarFormularioCadastroUsuario" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
