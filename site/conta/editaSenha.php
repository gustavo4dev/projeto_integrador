<?php
include_once '../resources/componentes/header-nav.php';
//$_SESSION['user']['email'] = "gu@gu.com";
//$_SESSION['user']['logado'] = true;
require_once '../controller/storeController.php';
$store = new storeController();


if (!isset($_SESSION['user'])) {

    $_SESSION['modal_redirect'] = 'login.php';
    $_SESSION['modal_message'] = 'Você não está logado!<br/>Por favor faça login.';
    include '../resources/componentes/dialog.php';
} else {

    if (isset($_POST['email'])) {
        $cliente = $store->clienteConta($_POST['email']);
        if ($cliente['loginExt'] == true) {
            $_SESSION['modal_message'] = "não é possivel alterar sua senha.<br/> Você usou sua conta do Google para se registrar.";
            $_SESSION['modal_redirect'] = 'minhaconta.php';
            include '../resources/componentes/dialog.php';
        } else {
            ?><br/>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card" style="padding: 5%">
                                <h1>Altere sua senha</h1>
                                <a href="minhaconta.php" class="btn btn-danger-outline"><i class="fa fa-angle-left"></i>&nbsp;Voltar</a><br/>
                                <hr/><br/>
                                <form action="editaSenha.php" method="post" id="editaSenha">
                                    <input type="hidden" name="usuario" value="<?= $_POST['email'] ?>"/>

                                    <div class="md-form">
                                        <label for="senhaAntiga">Insira a senha antiga</label>
                                        <input type="password" name="senhaAntiga" class="form-control" required/>

                                    </div>
                                    <div class="md-form">
                                        <label for="senhaNova">Insira uma nova senha</label>
                                        <input type="password" id="senha" name="senhaNova" onblur="validaSenha(this.value)" class="form-control" required/>
                                        <span class="small" id="alertSenha" style="color: red"></span>
                                    </div>
                                    <div class="md-form">
                                        <label for="confSenhaNova">Insira novamente</label>
                                        <input type="password" name="confSenhaNova" onblur="confirmaSenha(this.value)" class="form-control" required/>
                                        <span class="small" id="alertConfSenha" style="color: red"></span>
                                    </div>
                                    <input type="submit" value="Enviar" class="btn btn-danger"/>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../resources/js/app.js"></script>
            <script>

                                            $('#editaSenha').on('submit', function (e) {

                                                alertSenha = $('#alertSenha').html();
                                                alertConfSenha = $('#alertConfSenha').html();

                                                if (alertSenha.length == 0 &&
                                                        alertConfSenha.length == 0) {
                                                    console.log(alertSenha.length);
                                                    console.log(alertConfSenha.length);
                                                } else {

                                                    alert('Preencha os campos corretamente!');
                                                    e.preventDefault();
                                                }
                                            });

            </script>
            <?php
        }
    } else if(isset($_POST['usuario'])){
        $r = $store->setSenhaForm($_POST);
        include '../resources/componentes/dialog.php';
    }else{
        echo '<script>window.location.href= "minhaconta.php";</script>';
    }
}
?>
