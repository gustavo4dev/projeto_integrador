<?php
include_once '../resources/componentes/header-nav.php';

require_once '../controller/storeController.php';

if (isset($_POST)) {
    $user = $_POST;
}
?>
<script src="../resources/js/jquery.maskedinput.js"></script>

<script src="../resources/js/app.js"></script>

<div class="container">
    <div class="row">
        <br/>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card" style="padding: 5%">

                <h3>Insira seus dados para o cadastro</h3><br/>
                <?php if (count($user) > 0) { ?>
                    <div class="alert alert-info"><b>Só mais um passo ;)</b> .Complete as informações para registrar seu perfil</div><br/>
                <?php } ?>
                <form action="registrausuario.php" method="post" id="novaConta">
                    <div class="md-form">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" name="nome" id="nome" value="<?php if (isset($user['nome'])) echo $user['nome']; ?>" required/>
                    </div>
                    <div class="md-form">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email" onblur="validaEmail(this.value)" value="<?php if (isset($user['email'])) echo $user['email']; ?>" required/>
                        <span class="small" id="alertEmail" style="color: red"></span>
                    </div>
                    <?php if (count($user) == 0) { ?>
                        <div class="md-form">
                            <label for="senha">Senha</label>
                            <input class="form-control" type="password" onblur="validaSenha(this.value)" id="senha" name="senha" required/>
                            <span class="small" id="alertSenha" style="color: red"></span>
                        </div>
                        <div class="md-form">
                            <label for="confSenha">Confirme a senha</label>
                            <input class="form-control" type="password" onblur="confirmaSenha(this.value)" id="confSenha" name="confSenha" required/>
                            <span class="small" id="alertConfSenha" style="color: red"></span>
                        </div>
                    <?php } ?>
                    <div class="md-form">
                        <label for="cpf">CPF</label>
                        <input class="form-control" type="text" onblur="validarCPF(this.value)" id="cpf" name="cpf" required/>
                        <span class="small" id="alertCpf" style="color: red"></span>
                    </div>
                    <div class="md-form">
                        <label for="dataNascimento">Nascimento</label>
                        <input class="form-control" name="nascimento" id="dataNascimento" type="text" onfocus="(this.type = 'date')" onfocusout="(this.type='text')" required>
                    </div><br/>
                    <div class="form-inline">
                        Sexo &nbsp;&nbsp;
                        <input type="radio" name="sexo" value="m"/>Masculino
                        <input type="radio" name="sexo" value="f"/>Feminino
                    </div><br/>
                    <div class="md-form">
                        <label for="telefone">Telefone</label>
                        <input class="form-control" type="text" name="telefone" required/>
                    </div>

                    <input class="btn btn-danger" type="submit" value="Cadastrar"/>

                    <?php if (isset($user['loginExt'])) { ?>
                        <input type="hidden" name="loginExt" value="1"/>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('input[type=text][name=cpf]').mask("999.999.999-99");
    $('input[type=text][name=telefone]').mask("(99)9999-9999");
    $('#novaConta').on('submit', function (e) {
        var alertSenha;
        var alertConfSenha;
        if ($('#senha').length) {
            alertSenha = $('#alertSenha').val();
        }
        if ($('#confSenha').length) {
            alertConfSenha = $('#alertConfSenha').val();
        }

        if ($('#alertEmail').html().length == 0 &&
                $('#alertCpf').html().length == 0 &&
                alertSenha.length == 0 &&
                alertConfSenha.length == 0) {
            console.log($('#alertEmail').html().length);
            console.log($('#alertCpf').html().length);
            console.log(alertSenha.length);
            console.log(alertConfSenha.length);
        } else {

            alert('Preencha os campos corretamente!');
            e.preventDefault();
        }
    });
</script>

<?php
include '../resources/componentes/footer.php';