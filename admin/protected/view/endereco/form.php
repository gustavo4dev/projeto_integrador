<?php ?>

<h2>Cadastro de sabores de pizza</h2>

<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data" role="form" >

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="nome">Nome</label>
        <input class="mdl-textfield__input" type="text" name="nome" value="<?php if (isset($registro)) echo $registro['nome'] ?>"/>
    </div><br/>


    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="descricao">Descrição</label>
        <input class="mdl-textfield__input" type="text" name="descricao" value="<?php if (isset($registro)) echo $registro['descricao'] ?>"/>
    </div><br/>

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="preco">Preço</label>
        <input class="mdl-textfield__input" type="text" name="valor" value="<?php if (isset($registro)) echo $registro['valor'] ?>"/>
    </div><br/>

    <div class="form-group">
        <label for="imagem">Imagem do produto</label>
        <input type="text" name="imagem"/>
    </div><br/>
    <?php if(isset($registro['id'])){ ?>
    <input type="hidden" value="<?=$_GET['id']?>" name="id">
    <?php } ?>

    <input class="mdl-button mdl-js-button mdl-button--raised
           mdl-js-ripple-effect mdl-button--colored" type="submit" value="Cadastrar"/>
    <input onclick="history.back()"
           class="mdl-button mdl-js-button mdl-button--raised
           mdl-js-ripple-effect mdl-button--colored" type="reset" value="Cancelar"/>
</form>