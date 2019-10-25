<?php
include_once '../resources/componentes/header-nav.php';
//confere se o usuario ja esta logado
if (isset($_SESSION['user']) && $_SESSION['user']['logado'] === true) {
    echo '<script>window.location.href = "minhaconta.php";</script>';
}
//confere se existem dados do form de login
if (isset($_POST['email']) && isset($_POST['senha'])) {
    $result = $store->clienteLogin($_POST);
    //print_r($result);exit;
    if (is_string($result)) {
        include '../resources/componentes/dialog.php';
    } else if (is_array($result)) {
        if ($result['flagsenha'] == 1) {
            $_SESSION['altPass'] = $result['email'];
            echo '<script>window.location.href = "formEsqueciSenha.php";</script>';
        } else if (isset($_SESSION['checkout'])) {
            $_SESSION['user']['logado'] = true;
            $_SESSION['user']['nome'] = $result['nome'];
            $_SESSION['user']['email'] = $result['email'];
            echo '<script>window.location.href = "../cesta/checkout.php";</script>';
        } else {
            $_SESSION['user']['logado'] = true;
            $_SESSION['user']['nome'] = $result['nome'];
            $_SESSION['user']['email'] = $result['email'];
            echo '<script>window.location.href = "minhaconta.php";</script>';
        }
    }
}
?>

<div class="container">
    <div class="row"><br/>
        <div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <br/>
                <h2 class="title">Login</h2>
                <hr/>
                <form action="login.php" method="post"><br/>
                    <div class="md-form">
                        <i class="fa fa-envelope prefix"></i>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <label for="email">Digite seu email</label>
                    </div><br/>
                    <div class="md-form">
                        <i class="fa fa-lock prefix"></i>
                        <input type="password" id="senha" name="senha" class="form-control" required>
                        <label for="senha">Digite sua senha</label>
                    </div>
                    <div class="md-form">
                        <input type="submit" class="btn btn-danger" value="Login"/>
                        <a href="esquecisenha.php">Esqueci minha senha</a>
                    </div>
                </form>
                <h4 style="text-align: center">ou</h4>
                <div class="g-signin2" data-onsuccess="onSignIn" data-theme="ligth" data-width="240" data-height="50" data-longtitle="false" data-lang="pt"></div>
                <div id="cadastro-action">
                    <hr/>
                    <h4>Ainda não é cadastrado?</h4>
                    <a href="../conta/criarconta.php" class="btn btn-danger">Crie já sua conta!</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br/><br/>
<script>


    function onSignIn(response) {
        // Conseguindo as informações do seu usuário:
        var perfil = response.getBasicProfile();

        // Conseguindo o ID do Usuário
        var userID = perfil.getId();

        // Conseguindo o Nome do Usuário
        var userName = perfil.getName();

        // Conseguindo o E-mail do Usuário
        var userEmail = perfil.getEmail();

        // Conseguindo a URL da Foto do Perfil
        var userPicture = perfil.getImageUrl();



        // Recebendo o TOKEN que você usará nas demais requisições à API:
        //var LoR = response.getAuthResponse().id_token;
        //console.log("~ le Tolkien: " + LoR);
        //console.log("~ le Tolkien: " + response.getAuthResponse().scope);

        $.redirect('registraGoogleLogin.php', {'nome': userName, 'email': userEmail}, 'POST');
    }
    ;




</script>

<?php include '../resources/componentes/footer.php'; ?>
</body>
</html>
