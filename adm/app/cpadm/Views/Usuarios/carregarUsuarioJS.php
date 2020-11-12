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
                <h2 class="display-4 titulo">Listar Usuários</h2>
            </div>
            <?php 
                if($this->Dados['botao']['CadastrarUsuario']) {
                    echo "<a href=". URLADM . "CadastrarUsuario/cadastrarUsuario>";
                    echo "    <div class='p-2'>";
                    echo "        <button class='btn btn-outline-success btn-sm'>";
                    echo "            Cadastrar";
                    echo "        </button>";
                    echo "    </div>";
                    echo "</a>";
                }

                if($this->Dados['botao']['CadastrarUsuarioModal']) {
                    ?>
                    <div class='p-2'>
                        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addUsuarioModal"
                        >
                        Cadastrar Modal
                        </button>
                    </div>
                    <?php
                }
            ?>
            
        </div>
        <form action="" class="form-inline" method="POST">
            <div class="form-group">
                <label for="">Pesquisar</label>
                <input type="text" name="pesquisarUsuarios" id="pesquisarUsuarios" class="form-control mx-sm-3" placeholder="Nome ou E-mail">
            </div>
        </form>
        <hr>
        <?php

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            
            unset($_SESSION['msg']);
        }
        ?>
        <span id="conteudo"></span>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="visializarUsuarioModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background-color: #456; color: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detalhes do Usuário</h5>
                <button type="button" class="close btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="verUsuarioModal"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?php 
    if($this->Dados['botao']['CadastrarUsuarioModal']) {
        ?>
        <span class="enderecoCadastro" data-enderecoCadastro="<?php echo URLADM; ?>CadastrarUsuarioModal/cadastrarUsuarioModal"></span>
    <!-- Modal Cadastrar Usuários -->
    <div class="modal fade addUsuarioModal" id="addUsuarioModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background-color: #456; color: #fff;">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cadastrar do Usuário Modal</h5>
                    <button type="button" class="close btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="msgCadastrarUsuarioModal"></span>
                    <form method="POST" id="insert_usuario_modal" enctype="multipart/form-data">
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
                                <input name="senha" type="password" class="form-control" id="password" placeholder="Senha com mínimo 6 caracteres">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label><span class="text-danger">*</span> Nível de Acesso</label>
                                <select name="adm_niveis_acessos_id" id="adm_niveis_acessos_id" class="form-control">
                                    <option value="5">Selecione</option>
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
                                    <option value="3">Selecione</option>
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
                        <input type="submit" name="CadastrarUsuario" id="CadastrarUsuario" class="btn btn-info" value="Salvar">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
        <?php
    }
?>

<!-- Modal Cadastrar Usuários Exibindo a mensagem de sucesso apos o cadastramento -->
<div class="modal fade" id="addSucessoModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Usuário Cadastrado com Sucesso!!
            </div>
        </div>
    </div>
</div>