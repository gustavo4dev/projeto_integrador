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
                            <input type="email" name="email" id="email" class="mdl-textfield__input" >
                            <label class="mdl-textfield__label" for="email">Insira seu email</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" class="btn btn-default waves-effect waves-light">Gerar nova senha</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


