<?php ?>

<div class="col-md-12">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h3>Cadastre-se já!</h3>
        <hr/>
        <form action="<?php echo $action ?>" method="post">
            <table style="width: 100%">
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input type="text" name="nome" id="nome" class="mdl-textfield__input" value="<?php if (isset($registro)) echo $registro['nome']; ?>" required>
                            <label class="mdl-textfield__label" for="nome">Nome completo</label>
                        </div>
                    </td>
                    <td>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input type="text" name="cpf" id="cpf" maxlength="11" class="mdl-textfield__input" value="<?php if (isset($registro)) echo $registro['cpf']; ?>" required>
                            <label class="mdl-textfield__label" for="cpf">CPF (somente numeros)</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <span>Sexo &nbsp;</span>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                                <input type="radio" id="option-1" class="mdl-radio__button" name="sexo" value="masculino" <?php if (isset($registro) && $registro['sexo'] === "masculino") echo 'checked'; ?>>
                                <span class="mdl-radio__label">Masculino</span>
                            </label>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                                <input type="radio" id="option-2" class="mdl-radio__button" name="sexo" value="feminino" <?php if (isset($registro) && $registro['sexo'] === "feminino") echo 'checked'; ?>>
                                <span class="mdl-radio__label">Feminino</span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input type="date" name="nascimento" id="nascimento" class="mdl-textfield__input" value="<?php if (isset($registro)) echo $registro['nascimento']; ?>" required>
                            <label class="mdl-textfield__label" for="nascimento">Data de nascimento</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                            <input type="text" name="endereco" id="endereco" class="mdl-textfield__input" value="<?php if (isset($registro)) echo $registro['endereco']; ?>" required>
                            <label class="mdl-textfield__label" for="endereco">Endereço</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input type="email" name="email" id="email" class="mdl-textfield__input" value="<?php if (isset($registro)) echo $registro['email']; ?>" required>
                            <label class="mdl-textfield__label" for="email">Email</label>
                        </div>
                    </td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input type="password" name="senha" id="senha" class="mdl-textfield__input" value="<?php if (isset($registro)) echo $registro['senha']; ?>"
                                   <?php if (isset($registro)) echo 'disabled' ?> required>
                            <label class="mdl-textfield__label" for="senha">Senha</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if (isset($registro)) { ?>
                            <input type="hidden" name="id" id="email" class="mdl-textfield__input" value="<?php echo $registro['idUsuario']; ?>">
                        <?php } ?>
                            <button type="submit" onclick="validarCPF(this.cpf)" class="btn btn-default waves-effect waves-light">Cadastrar</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


