<?php
session_start();
//inicia variavel do controlador
require '../controller/storeController.php';
$store = new storeController();
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- google login -->
        <script>
            window.___gcfg = {
                "lang": 'pt-BR'
            };
        </script>

        <meta charset="UTF-8">
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="860992483680-onfpj85si3ah4pur3n769euilap9qbtj.apps.googleusercontent.com">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <style>
            .g-signin2,
            .g-signin2 .abcRioButton {
                display: block;
                margin: 20px auto 0 auto;
                text-align: center;
            }
        </style>



        <title>Food Delivery</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link href="../resources/css/bootstrap.min.css" rel="stylesheet">

        <!-- Material Design Bootstrap -->
        <link href="../resources/css/mdb.min.css" rel="stylesheet">

        <!-- Your custom styles (optional) -->
        <link href="../resources/css/style.css" rel="stylesheet">


        <!-- ScrollReveal -->
        <script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>

        <!-- datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>


        <!-- lightbox -->
        <link href="../resources/css/lightbox.css" rel="stylesheet">

        <!-- JQuery -->
        <script type="text/javascript" src="../resources/js/jquery-2.2.3.min.js"></script>


    </head>

    <body>
        <div>
            <style>
                #backtop {
                    position: fixed;
                    display: block;
                    right: 0;
                    bottom: 0;
                    margin-right: 40px;
                    margin-bottom: 40px;
                    z-index: 900;
                }
            </style>
            <script>
            $(document).ready(function () {
                var btt = $('#backtop');
                btt.on('click', function (e) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);

                    e.preventDefault();
                });

                $(window).on('scroll', function () {
                    var self = $(this),
                            height = 180,
                            top = self.scrollTop();

                    if (top > height) {
                        if (!btt.is('#page-top:visible')) {
                            btt.fadeIn();
                        }
                    } else {
                        btt.hide();
                    }
                });
            });
            </script>
            <button class="btn btn-danger-outline" id="backtop"><i class="fa fa-angle-up"></i></button>
            <nav class="navbar navbar-dark red">

                <!-- Collapse button-->
                <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx23"><i class="fa fa-bars"></i></button>

                <div class="container">
                    <a class="navbar-brand" href="../index.php" style="vertical-align: middle "><i class="fa fa-cutlery fa-lg" aria-hidden="true"></i>
                        &nbsp;Food delivery</a>
                    <!--Collapse content-->
                    <div class="collapse navbar-toggleable-xs" id="collapseEx23">
                        <!--Navbar Brand-->



                        <!--Links-->
                        <ul class="nav navbar-nav nav-flex-icons">
                            <li class="nav-item ">
                                <a class="nav-link" href="../cesta/cesta.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;Cesta</a>
                            </li>
                            <li class="nav-item avatar dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                                    <?php
                                    if (isset($_SESSION['user']['nome']))
                                        echo $_SESSION['user']['nome'];
                                    else
                                        echo 'Conta';
                                    ?>
                                </a>


                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['logado'] == true) { ?>

                                    <div class="dropdown-menu dropdown-warning" aria-labelledby="dropdownMenu1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item" href="../conta/minhaconta.php">Minha conta</a>
                                        <a class="dropdown-item" href="../conta/meuspedidos.php">Meus pedidos</a>
                                        <a class="dropdown-item" href="../conta/logout.php">Sair</a>                                        
                                    </div>
                                <?php } else { ?>
                                    <div class="dropdown-menu dropdown-warning" aria-labelledby="dropdownMenu1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item" href="../conta/login.php">Login</a>
                                    </div>
                                <?php } ?>
                            </li>

                        </ul>

                        <!--Links-->
                    </div>
                    <!--/.Collapse content-->

                </div>

            </nav>
            <!--/.Navbar-->
        </div>
        <!-- SCRIPTS -->



        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../resources/js/tether.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../resources/js/bootstrap.min.js"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../resources/js/mdb.min.js"></script>

        <!-- datatables -->
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

        <!-- lightbox -->
        <script type="text/javascript" src="../resources/js/lightbox.js"></script>

        <!-- jquery redirect -->
        <script type="text/javascript" src="../resources/js/jquery.redirect.js"></script>


