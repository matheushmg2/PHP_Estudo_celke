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
                <h2 class="display-4 titulo">Editar Perfil</h2>
            </div>
            <div class="p-2">
                <?php 
                    if($this->Dados['botao']['VerPerfil']) {
                        echo "<a href='" . URLADM . "VerPerfil/perfil' class='btn btn-outline-primary btn-sm'>Visualizar</a>";
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
        if(isset($this->Dados['form'])){
            $valorFormulario = $this->Dados['form'];
        }
        if(isset($this->Dados['form'][0])){
            $valorFormulario = $this->Dados['form'][0];
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data"> <!-- Para trabalhar com Tipo Imagem é necessário ultilizar no FORM o sequinte  |enctype="multipart/form-data"| para que não ocorra erro -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome</label>
                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome completo" value="<?php if(isset($valorFormulario['nome'])) { echo $valorFormulario['nome'];}?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Apelido</label>
                    <input name="apelido" type="text" class="form-control" id="apelido" placeholder="Apelido" value="<?php if(isset($valorFormulario['apelido'])) {echo $valorFormulario['apelido'];}?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> E-mail</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="E-mail Principal" value="<?php if(isset($valorFormulario['email'])) {echo $valorFormulario['email'];}?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Usuário</label>
                    <input name="usuario" type="text" class="form-control" id="usuario" placeholder="Digite um Usuário" value="<?php if(isset($valorFormulario['usuario'])) {echo $valorFormulario['usuario'];}?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input name="imagem_antiga" type="hidden" value="<?php 
                    if(isset($valorFormulario['imagem_antiga'])) {echo $valorFormulario['imagem_antiga'];} // Se existir uma imagem atribua a própria
                    elseif(isset($valorFormulario['imagem'])) {echo $valorFormulario['imagem'];} // Se não atribua a qual está sendo atribuída
                    ?>">
                    <label>Foto</label>
                    <input name="imagem_nova" type="file" onchange="previewImagem();">
                </div>
                <div class="form-group col-md-6">
                    <?php 
                        if(isset($valorFormulario['imagem']) && !empty($valorFormulario['imagem'])) {
                            $imagem_antiga = URLADM.'assets/image/usuarios/'.$_SESSION['usuario_id'].'/'.$_SESSION['usuario_image'];
                        } else {
                            $imagem_antiga = URLADM.'assets/image/usuarios/icone_usuario.png';
                        }
                    ?>
                    <img src="<?php echo $imagem_antiga;?>" alt="Imagem do Usuário" id="preview-user" class="img-thumbnail" style="width: 150px; height: 150px;">
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input type="submit" name="EditarPerfil" class="btn btn-info" value="Salvar">
        </form>
    </div>
</div>