<?php ?>

<h2>Cadastro de tipos de pizzas</h2>

<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data" role="form" >

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="descricao">Descrição</label>
        <input class="mdl-textfield__input" type="text" name="descricao"
               value="<?php if (isset($registro)) echo $registro['descricao'] ?>" required/>
    </div><br/>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="quantidade">Quantidade de sabores</label>
        <input class="mdl-textfield__input" type="number" name="quantidade" 
               value="<?php if (isset($registro)) echo $registro['quantidade'] ?>" required/>
    </div><br/>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="reajuste">Reajuste do tamanho(%)</label>
        <input class="mdl-textfield__input" type="number" name="reajuste" 
               value="<?php if (isset($registro)) echo $registro['reajuste'] ?>" required/>
    </div><br/>

    <?php
    if(isset($registro['idTipoPizza'])){ ?>
    <input type="hidden" value="<?=$_GET['id']?>" name="id">
    <?php } ?>

    <input class="mdl-button mdl-js-button mdl-button--raised
           mdl-js-ripple-effect mdl-button--colored" type="submit" value="Cadastrar"/>
    
    <a href="index.php?ctrl=tipopizza"
           class="mdl-button mdl-js-button mdl-button--raised
           mdl-js-ripple-effect mdl-button--colored">Cancelar</a>
    
</form>