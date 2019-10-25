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
    //print_r($_POST);
    if (isset($_POST['nome'])) {
        if ($store->atualizaCliente($_POST)) {
            $_SESSION['modal_message'] = "Dados atualizados com sucesso!";
            $_SESSION['modal_redirect'] = "minhaconta.php";
        } else {
            $_SESSION['modal_message'] = "Não foi possivel atualizar. Tente novamente.";
            $_SESSION['modal_redirect'] = "";
        }
        include '../resources/componentes/dialog.php';
    } else {
        $cliente = $store->clienteConta($_SESSION['user']['email']);
        if (count($cliente) > 0) {
            ?>
            <br/>
            <script src="../resources/js/jquery.maskedinput.js"></script>
            <script src="../resources/js/app.js"></script>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="padding: 5%">
                            
                            <h3>Edite seus dados cadastrais</h3>
                            <a href="minhaconta.php" class="btn btn-danger-outline"><i class="fa fa-angle-left"></i>&nbsp;Voltar</a><br/>
                            <hr/><br/>
                            <form id="dadosForm" action="editaDados.php" method="post">
                                <input type="hidden" name="inf" value="<?= $cliente['idCliente'] ?>"/>
                                <div class="md-form">
                                    <label for="nome">Nome</label>
                                    <input type="text" name="nome" value="<?= $cliente['nome'] ?>" class="form-control" required <?php if ($cliente['loginExt'] == true) echo "readonly"; ?>/>
                                </div>
                                <div class="md-form">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="text" name="email" id="email" onblur="validaEmail(this.value)" value="<?= $cliente['email'] ?>" required <?php if ($cliente['loginExt'] == true) echo "readonly"; ?>/>
                                    <span class="small" id="alertEmail" style="color: red"></span>
                                </div>
                                <div class="md-form">
                                    <label for="cpf">CPF</label>
                                    <input type="text" name="cpf" value="<?= $cliente['cpf'] ?>" class="form-control" readonly required/>
                                </div>
                                <div class="md-form">
                                    <label for="nascimento">Nascimento</label>
                                    <input type="text" name="nascimento" value="<?=$cliente['nascimento']?>" class="form-control" readonly required/>
                                </div>
                                <div class="md-form">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>" class="form-control" required/>
                                </div>
                                <input class="btn btn-danger" type="submit" value="Enviar"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                //$('input[type=text][name=telefone]').mask("(99)9999-9999");
                $('#dadosForm').on('submit', function (e) {


                    if ($('#alertEmail').html().length == 0) {
                        console.log($('#alertEmail').html().length);
                    } else {

                        alert('Preencha os campos corretamente!');
                        e.preventDefault();
                    }
                });
            </script>


            <?php
        } else {
            unset($_SESSION['user']);
            echo '<script>window.location.href= "login.php";</script>';
        }
    }
}

