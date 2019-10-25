<?php ?>

<div class="col-md-12">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h3>Alteração de senha</h3>
        <hr/>
        <form action="<?php echo $action ?>" method="post">
            <table style="width: 100%">
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input type="password" name="senhaAntiga" id="senhaAntiga" class="mdl-textfield__input" >
                            <label class="mdl-textfield__label" for="senhaAntiga">Insira a senha antiga</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input type="password" name="senha" id="senha" class="mdl-textfield__input" >
                            <label class="mdl-textfield__label" for="senha">Insira a nova senha</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                            <input type="hidden" name="id" id="email" class="mdl-textfield__input" value="<?php echo $id; ?>">
                        
                        <button type="submit" class="btn btn-default waves-effect waves-light">Alterar senha</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


