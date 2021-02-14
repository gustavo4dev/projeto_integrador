<?php
session_start();
require_once '../libs/config.php';
require_once '../libs/conexao.php';
require_once '../libs/controladorAdmin.php';

if (!isset($_SESSION['usuario']) && $_SESSION['usuario']['admin'] == false) {
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
        <title>Área administrativa - Food Delivery</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <!-- jQuery -->
        <script src="http://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

        <!-- data tables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>

        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>


        <!-- dualListBox -->
        <link rel="stylesheet" type="text/css" href="../resources/css/bootstrap.css">
        <!--<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">-->
        <link rel="stylesheet" type="text/css" href="../src/bootstrap-duallistbox.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
       <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>-->
        <script src="../src/jquery.bootstrap-duallistbox.js"></script>



        <!-- material design -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
        <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.blue_grey-deep_purple.min.css" />
        <script type="text/javascript" src="../../../mdl/material.min.js"></script>
        <script type="text/javascript" src="../resources/js/functions.js"></script>

        <!-- Bootstrap core CSS -->
        <!-- <link href="../../bootstrap-dist/css/bootstrap.min.css" rel="stylesheet"><!-- comment -->

        <!-- Custom styles for this template -->
        <!-- <link href="navbar.css" rel="stylesheet"><!-- comment -->



        <!--Estilo particular-->
        <link type="text/css" rel="stylesheet" href="../../estilo.css"/>
        
        <style>
            a{
                text-decoration: none !important;
            }
        </style>

    </head>
    <body>
        <!--escopo padrão header fixado-->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">

                    <!--conteudo do header-->
                    <!--titulo-->
                    <span class="mdl-layout-title">Food Delivery</span>
                    <div class="mdl-layout-spacer"></div>
                    <!--itens menu-->

                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="index.php?ctrl=pedidocompra">Nova compra</a>
                    </nav>
                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <!-- botao para manutenções -->
                        <a href="#" id="demo-menu-lower-left-1"
                           class="mdl-navigation__link">
                            Manutenções<i class="material-icons">keyboard_arrow_down</i>
                        </a>
                        <!-- menu de manutenções -->
                        <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-left-1">
                            <a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=produto">Produtos</a>
                            <a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=destaques">Produtos em destaque</a>
                            <a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=Categoria">Categorias</a>
                            <a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=sabor">Sabores</a>
                            <a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=tipopizza">Tipos de pizzas</a>
                        </ul>
                        <!-- botao para confirmações -->
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
                    
                    <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect">
                        Manutenções<i class="material-icons" role="presentation">arrow_drop_down</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                        <li class="mdl-menu__item"><a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=produto">Produtos</a></li>
                        <li class="mdl-menu__item"><a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=destaques">Produtos em destaque</a></li>
                        <li class="mdl-menu__item"><a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=Categoria">Categorias</a></li>
                        <li class="mdl-menu__item"><a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=sabor">Sabores</a></li>
                        <li class="mdl-menu__item"><a class="mdl-menu__item mdl-button mdl-js-button" href="index.php?ctrl=tipopizza">Tipos de pizzas</a></li>
                    </ul>

                    <a href="../../login.php?acao=logout" class="mdl-button mdl-button--colored">
                        Logout<i class="material-icons">power_settings_new</i>
                    </a>
                </nav>
            </div>
        </div>

        <br/><br/>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--1-col-desktop"></div>
                    <div class="mdl-cell mdl-cell--10-col">
                        <div class="mdl-card mdl-shadow--16dp">
                            <?php $app = new AplicacaoAdmin(); ?>
                        </div>
                    </div> <!-- /container -->
                </div>
            </div>
        </div>






        <script type="text/javascript">
            $(document).ready(function () {
                $('#tabela').DataTable({
                    "language": {
                        "lengthMenu": "",
                        "zeroRecords": "Nenhum resultado encontrado.",
                        "info": "",
                        "infoEmpty": "",
                        "infoFiltered": "",
                        "search": "Pesquisar",
                        "paginate": {
                            "first": "Primeiro",
                            "last": "Ultimo",
                            "next": "Próximo",
                            "previous": "Anterior"
                        }
                    }
                }
                );
            });
        </script>



    </body>
</html>


