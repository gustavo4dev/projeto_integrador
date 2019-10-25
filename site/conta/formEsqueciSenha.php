<?php
include_once '../resources/componentes/header-nav.php';

require_once '../controller/storeController.php';
$store = new storeController();

if (isset($_SESSION['altPass']) || isset($_POST['email'])) {
    if (isset($_POST['senhaNova'])) {
        $r = $store->setSenhaForm($_POST);
        if ($r) {
            unset($_SESSION['altPass']);
            include '../resources/componentes/dialog.php';
        }
    } else {
        ?><br/>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card" style="padding: 5%">
                            <h1>Altere sua senha</h1>
                            <hr/><br/>
                            <form action="formEsqueciSenha.php" method="post" id="novaSenha">
                                <input type="hidden" name="email" value="<?= $_SESSION['altPass'] ?>"/>
                                
                                <div class="md-form">
                                    <label for="senhaNova">Insira uma nova senha</label>
                                    <input type="password" name="senhaNova" onblur="validaSenha(this.value)" class="form-control" required/>
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

                                        $('#novaSenha').on('submit', function (e) {

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
        include '../resources/componentes/footer.php';
    }
} else {
    header("Location: login.php");
}

