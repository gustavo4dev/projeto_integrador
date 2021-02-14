<?php ?>

<h2>Cadastro de categorias</h2>

<form action="<?php echo $action; ?>" method="POST" role="form" enctype="multipart/form-data">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="nome">Nome</label>
        <input class="mdl-textfield__input" type="text" name="nome" value="<?php if (isset($registro)) echo $registro['nome'] ?>" required/>
    </div><br/>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="descricao">Descrição</label>
        <input class="mdl-textfield__input" type="text" name="descricao" value="<?php if (isset($registro)) echo $registro['descricao'] ?>" required/>
    </div><br/>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
        <input class="mdl-textfield__input" placeholder="Imagem" type="text" id="uploadFile" readonly/>
        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
            <i class="material-icons">attach_file</i><input type="file" id="uploadBtn" name="imagem" <?php if (!isset($registro['imagem'])) echo'required'; ?>>
        </div>
    </div><br/>
    <?php if (isset($registro['idCategoria'])) { ?>
        <input type="hidden" value="<?= $registro['idCategoria'] ?>" name="id">
    <?php } ?>

    <input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" value="Enviar"/>
    <a href="index.php?ctrl=categoria"
       class="mdl-button mdl-js-button mdl-button--raised
       mdl-js-ripple-effect mdl-button--colored">Cancelar</a>
</form>

<script type="text/javascript">
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.files[0].name;
    };
</script>