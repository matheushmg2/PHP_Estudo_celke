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
                <h2 class="display-4 titulo">Cadastrar Usuário</h2>
            </div>
            <div class="p-2">
                <?php 
                    if($this->Dados['botao']['ListarUsuario']) {
                        echo "<a href='" . URLADM . "usuarios/listar' class='btn btn-outline-primary btn-sm'>Listar Usuário</a>";
                    }
                ?>
            </div>
        </div>
        <hr>
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
                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome completo" value="<?php if (isset($valorFormulario['nome'])) {echo $valorFormulario['nome'];} ?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Apelido</label>
                    <input name="apelido" type="text" class="form-control" id="apelido" placeholder="Apelido" value="<?php if (isset($valorFormulario['apelido'])) {echo $valorFormulario['apelido'];} ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> E-mail</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="E-mail Principal" value="<?php if (isset($valorFormulario['email'])) {echo $valorFormulario['email'];} ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Usuário</label>
                    <input name="usuario" type="text" class="form-control" id="usuario" placeholder="Digite um Usuário" value="<?php if (isset($valorFormulario['usuario'])) {echo $valorFormulario['usuario'];} ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Senha</label>
                    <input name="senha" type="password" class="form-control" id="senha" placeholder="Senha com mínimo 6 caracteres" value="<?php if (isset($valorFormulario['senha'])) {echo $valorFormulario['senha'];} ?>" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Nível de Acesso</label>
                    <select name="adm_niveis_acessos_id" id="adm_niveis_acessos_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                            foreach($this->Dados['select']['nivac'] as $nivac){
                                extract($nivac);
                                if($valorFormulario['adm_niveis_acessos_id'] == $id_nivac){
                                    echo "<option value='$id_nivac' selected>$nome_nivac</option>";
                                } else {
                                    echo "<option value='$id_nivac'>$nome_nivac</option>";
                                }                                
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Situação</label>
                    <select name="adm_situacoes_id" id="adm_situacoes_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                            foreach($this->Dados['select']['situacao'] as $situacao){
                                extract($situacao);
                                if($valorFormulario['adm_situacoes_id'] == $id_situacao){
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
                <div class="form-group col-md-4">
                    <label>Foto</label>
                    <input name="imagem_nova" type="file" onchange="previewImagem();">
                </div>
                <div class="form-group col-md-3">
                    <?php $imagem_antiga = URLADM . 'assets/image/usuarios/icone_usuario.png'; ?>
                    <img src="<?php echo $imagem_antiga; ?>" alt="Imagem do Usuário" id="preview-user" class="img-thumbnail" style="width: 150px; height: 150px;">
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input type="submit" name="CadastrarUsuario" class="btn btn-info" value="Salvar">
        </form>
    </div>
</div>