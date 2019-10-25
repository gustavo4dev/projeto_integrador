<?php ?>

<h2>Cadastro de Produtos</h2>

<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data" role="form">

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="nome">Nome</label>
        <input class="mdl-textfield__input" type="text" name="nome" value="<?php if (isset($registro)) echo $registro['nome'] ?>" required/>
    </div><br/>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="descricao">Descrição</label>
        <input class="mdl-textfield__input" type="text" name="descricao" value="<?php if (isset($registro)) echo $registro['descricao'] ?>" required/>
    </div><br/>

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="valor">Valor</label>
        <input class="mdl-textfield__input" type="number" step="0.01" name="valor" value="<?php if (isset($registro)) echo $registro['valor'] ?>" required/>
    </div><br/>

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="tempoPreparo">Tempo de preparo (min)</label>
        <input class="mdl-textfield__input" type="number" name="tempoPreparo" value="<?php if (isset($registro)) echo $registro['tempoPreparo']; ?>" required/>
    </div><br/>

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="idCategoria">Categoria</label>
        <select class="mdl-textfield__input" name="idCategoria" required>
            <?php foreach ($categorias as $categoria) { ?>
                <option value = "<?php echo $categoria['idCategoria'] ?>"
                <?php
                if (isset($registro) && $registro['idCategoria'] == $categoria['idCategoria']) {
                    echo "selected";
                }
                ?>>
                            <?php echo $categoria['nome'] ?>
                </option>
            <?php } ?>
        </select>
    </div><br/><br/>

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
        <input class="mdl-textfield__input" placeholder="Imagem" type="text" id="uploadFile" readonly/>
        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
            <i class="material-icons">attach_file</i><input type="file" id="uploadBtn" name="imagem" <?php if(!isset($registro['imagem']))echo'required'; ?>>
        </div>
    </div><br/>
    <?php if (isset($registro['imagem'])) { ?>
        <!-- Image card -->
        <style>
            .demo-card-image.mdl-card {
                width: 300px;
                height: 256px;
                background: url('<?php echo "../../../site/public/img/" . $registro['imagem']; ?>') center / cover;
            }

        </style>

        <div class="demo-card-image mdl-card mdl-shadow--2dp"></div>
        <br/>

        <?php } if (isset($registro['idProduto'])) { ?>
        <input type="hidden" value="<?= $registro['idProduto'] ?>" name="id">
    <?php } ?>


    <input class="mdl-button mdl-js-button mdl-button--raised
           mdl-js-ripple-effect mdl-button--colored"
           type="submit" value="Enviar"/>
    <a href="index.php?ctrl=produto"
       class="mdl-button mdl-js-button mdl-button--raised
       mdl-js-ripple-effect mdl-button--colored">Cancelar</a>
</form>

<script type="text/javascript">
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.files[0].name;
    };
</script>

