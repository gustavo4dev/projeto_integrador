<?php
session_start();
require_once '../libs/config.php';
require_once '../libs/conexao.php';
require_once '../libs/controlador.php';

if (!isset($_SESSION['usuario']) && $_SESSION['usuario']['user'] == false) {
    header('Location: ' . SERVER_ROOT . 'admin/');
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Área do usuario - Food Delivery</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
        <!-- <link rel="stylesheet" type="text/css" href="../../mdl/material.min.css" /> -->
        <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.blue_grey-deep_purple.min.css" />
        <link rel="stylesheet" href="../../estilo.css"/>
        <script type="text/javascript" src="../../../../mdl/material.min.js"></script>
        <script type="text/javascript" src="../resources/js/functions.js"></script>

        <!-- Bootstrap core CSS -->
        <!-- <link href="../../bootstrap-dist/css/bootstrap.min.css" rel="stylesheet"><!-- comment -->

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../bootstrap-dist/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="navbar.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../bootstrap-dist/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../../bootstrap-dist/js/ie-emulation-modes-warning.js"></script>

        <!--Estilo particular-->
        <link type="text/css" rel="stylesheet" href="../../estilo.css"/>

    </head>
    <body>
        <!--escopo padrão header fixado-->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">

                    <!--conteudo do header-->
                    <!--titulo-->
                    <a class="mdl-layout-title mdl-navigation__link" href="index.php">Food Delivery</a>
                    <div class="mdl-layout-spacer"></div>
                    <!--itens menu-->
                    <nav class="mdl-navigation mdl-layout--large-screen-only">

                        <!-- botao para confirmações -->
                        <a href="telaPedidos.php" 
                           class="mdl-navigation__link">
                            Tela de pedidos
                        </a>
                        <a href="#" id="demo-menu-lower-left"
                           class="mdl-navigation__link">
                            Validações<i class="material-icons">keyboard_arrow_down</i>
                        </a>
                        <!-- menu de confirmações -->
                        <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-left">
                            <a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=pedido&acao=validar">
                                Fechar pedido
                            </a>
                            <a class="mdl-menu__item mdl-button mdl-js-button" href="telaPedidos.php">
                                Ver fila de pedidos
                            </a>
                        </ul>


                        <a href="../../login.php?acao=logout" class="mdl-button mdl-button--raised">
                            Logout<i class="material-icons">power_settings_new</i>
                        </a>
                    </nav>

                </div>

            </header>
            <!--menu lateral = drawer-->
            <div class="mdl-layout__drawer">
                <span class="mdl-layout-title">Title</span>
                <nav class="mdl-navigation">
                    <!-- botao para manutenções -->
                    <a href="#" id="demo-menu-lower-left"
                       class="mdl-navigation__link">
                        Manutenções<i class="material-icons">keyboard_arrow_down</i>
                    </a>

                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
                        for="demo-menu-lower-left">
                        <li class="mdl-menu__item">Some Action</li>
                        <li class="mdl-menu__item mdl-menu__item--full-bleed-divider">Another Action</li>
                        <li disabled class="mdl-menu__item">Disabled Action</li>
                        <li class="mdl-menu__item">Yet Another Action</li>
                    </ul>

                    <a href="../../login.php?acao=logout" class="mdl-button mdl-button--colored">
                        Logout<i class="material-icons">power_settings_new</i>
                    </a>
                </nav>
            </div>
        </div>
        <dialog class="mdl-dialog" id="modal-example">
            <div class="mdl-dialog__content">
                <p>
                    This is an example of the MDL Dialog being used as a modal.
                    It is using the full width action design intended for use with buttons
                    that do not fit within the specified <a href="https://www.google.com/design/spec/components/dialogs.html#dialogs-specs">length metrics</a>.
                </p>
            </div>
            <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
                <button type="button" class="mdl-button">Close</button>
                <button type="button" class="mdl-button" disabled>Inactive action</button>
            </div>
        </dialog>
        <br/><br/>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--1-col-desktop"></div>
                    <div class="mdl-cell mdl-cell--10-col">
                        <div class="mdl-card mdl-shadow--16dp">
                            <?php $app = new AplicacaoUser(); ?>
                        </div>
                    </div> <!-- /container -->
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <script>window.jQuery || document.write('<script src="../../bootstrap-dist/js/vendor/jquery.min.js"><\/script>');</script>
        <script src="../../bootstrap-dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../bootstrap-dist/js/ie10-viewport-bug-workaround.js"></script>



    </body>
</html>


