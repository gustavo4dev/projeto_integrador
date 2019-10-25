<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?><style type="text/css">
    form{
        text-align: center;
        align-items: center;
    }
    #cod{
        text-transform: uppercase;
    }
</style>
<h2>Buscar pedido</h2>


<form action="<?php echo $action;?>" method="post">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="nome">Insira o código do pedido</label>
        <input class="mdl-textfield__input" type="text" name="cod" id="cod" required maxlength="5"/>
    </div>
    <input class="mdl-button mdl-js-button mdl-button--raised
           mdl-js-ripple-effect mdl-button--colored" type="submit" value="Buscar"/>
</form>
