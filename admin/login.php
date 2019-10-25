<?php
session_start();
if (isset($_GET['acao']) && $_GET['acao'] == 'logout') {
    session_destroy();
}
if (isset($_POST['username'])) {
    require_once './protected/libs/config.php';
    require_once './protected/libs/conexao.php';
    require_once './protected/controller/admin.php';
    //instacia o objeto de conexao
    $user = new Admin();
    $r = $user->loginAdmin($_POST);
    print_r($r);
    if ($r['permissao'] == 'admin') {
        $_SESSION['usuario']['admin'] = true;
        $_SESSION['usuario']['nome'] = $r['nome'];
        header('Location: protected/administrador/');
    } else if ($r['permissao'] == 'user') {
        $_SESSION['usuario']['user'] = true;
        $_SESSION['usuario']['nome'] = $r['nome'];
        header('Location: protected/user/');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
        <!-- <link rel="stylesheet" type="text/css" href="../../mdl/material.min.css" /> -->
        <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-indigo.min.css" />
        <link rel="stylesheet" href="estilo.css"/>
        <script type="text/javascript" src="../mdl/material.min.js"></script>
        <title>Página de Login</title>
    </head>
    <body>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--4-col-desktop"></div>
                    <div class="mdl-cell mdl-cell--4-col">
                        <div class="mdl-card mdl-shadow--16dp">
                            <div class="mdl-card__supporting-text">
                                <h4>Área restrita</h4>
                                <div class="mdl-card__actions mdl-card--border">
                                </div>
                                <form action="login.php" method="POST">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" name="username" type="text" id="username" />
                                        <label class="mdl-textfield__label" for="username">Email</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" name="senha" type="password" id="userpass" />
                                        <label class="mdl-textfield__label" for="userpass">Senha</label>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border">
                                        <input type="submit" class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect" value="Login">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
