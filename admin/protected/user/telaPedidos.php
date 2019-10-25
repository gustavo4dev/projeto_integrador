<?php
session_start();

require '../libs/config.php';
require '../libs/conexao.php';
require '../controller/tela.php';
$tela = new Tela();

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
        <title>pedidos - Food Delivery</title>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="20" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
        <!-- <link rel="stylesheet" type="text/css" href="../../mdl/material.min.css" /> -->
        <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.blue_grey-deep_purple.min.css" />
        <link rel="stylesheet" href="../../estilo.css"/>
        <script type="text/javascript" src="../../../../mdl/material.min.js"></script>
        <!-- <script type="text/javascript" src="../resources/js/functions.js"></script><!-- comment -->


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
        <br/><br/><br/>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-grid" >
                    <!-- <div class="mdl-cell mdl-cell--2-col" style="color:black;background-color:#F08080; margin:0; padding:3px; border:1px solid black">Pizza</div>
                    <div class="mdl-cell mdl-cell--2-col" style="color:black;background-color:#FFFF00; margin:0; padding:3px; border:1px solid black">Lanche</div>
                    <div class="mdl-cell mdl-cell--3-col" style="color:black;background-color:#00BFFF; margin:0; padding:3px; border:1px solid black">Pastel</div>
                    <div class="mdl-cell mdl-cell--2-col" style="color:black;background-color:#FFA500; margin:0; padding:3px; border:1px solid black">Porção</div>
                    <div class="mdl-cell mdl-cell--3-col" style="color:black;background-color:#ADFF2F; margin:0; padding:3px; border:1px solid black">Sobremesa</div><br/>
                    <!-- comment -->
                    <?php
                    $pedidos = $tela->getPedidos();
                    foreach ($pedidos as $pedido) {
                        if ($pedido['status'] != 0) {
                            $itens = $tela->getItensPedido($pedido['idPedido']);
                            foreach ($itens as $item) {
                                echo '<div class="mdl-cell mdl-cell--2-col" style="color:black;background-color:#F08080; margin:0; padding:3px; border:1px solid black; clear:both">';
                                if (isset($item['idCombinacao'])) {
                                    $pizza = $tela->buscaCombinacao($item['idCombinacao']);
                                    echo '';
                                    echo '<b>' . $item['quantidade'] . '<br/>' . $pizza['tipopizza'] . "</b><br/> ";
                                    if (isset($pizza['sabor1']))
                                        echo $pizza['sabor1'] . '<br/>';
                                    if (isset($pizza['sabor2']))
                                        echo $pizza['sabor2'] . '<br/>';
                                    if (isset($pizza['sabor3']))
                                        echo $pizza['sabor3'];
                                }
                                echo '</div>';

                                echo '<div class="mdl-cell mdl-cell--2-col" style="color:black;background-color:#FFFF00; margin:0; padding:3px; border:1px solid black">';
                                if (isset($item['idProduto'])) {

                                    $produto = $tela->buscaProduto($item['idProduto']);
                                    if (strcmp($produto['categoria'], "Lanches") == 0) {
                                        echo $produto['nome'];
                                    }
                                }
                                echo '</div>';
                                echo '<div class="mdl-cell mdl-cell--3-col" style="color:black;background-color:#00BFFF; margin:0; padding:3px; border:1px solid black">';
                                if (isset($item['idProduto'])) {

                                    $produto = $tela->buscaProduto($item['idProduto']);

                                    if (strcmp($produto['categoria'], "Pastéis") == 0) {
                                        echo $produto['nome'];
                                    }
                                }
                                echo '</div>';
                                echo '<div class="mdl-cell mdl-cell--2-col" style="color:black;background-color:#FFA500; margin:0; padding:3px; border:1px solid black">';

                                if (isset($item['idProduto'])) {

                                    $produto = $tela->buscaProduto($item['idProduto']);
                                    if (strcmp($produto['categoria'], "Porções") == 0) {
                                        echo $produto['nome'];
                                    }
                                }
                                echo '</div>';
                                echo '<div class="mdl-cell mdl-cell--3-col" style="color:black;background-color:#ADFF2F; margin:0; padding:3px; border:1px solid black">';
                                if (isset($item['idProduto'])) {

                                    $produto = $tela->buscaProduto($item['idProduto']);

                                    if (strcmp($produto['categoria'], "Sobremesas") == 0) {
                                        echo $produto['nome'];
                                    }
                                }
                                echo '</div>';
                            }
                            ?>
                            <div class="mdl-cell mdl-cell--12-col">

                                <a onclick="finaliza(this)" href="#" data-id="<?= $pedido['idCliente'] ?>" data-ped="<?= $pedido['codigoValidacao'] ?>" class="mdl-button mdl-butto--raised">Finalizar</a></div>

                            <?php
                        }
                    }
                    ?>                    
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script>
                                    function finaliza(componente) {
                                        var id = componente.getAttribute('data-id');
                                        var pedido = componente.getAttribute('data-ped');
                                        $.ajax({
                                            type: 'POST',
                                            url: 'pedidoPronto.php',
                                            data: 'id=' + id + '&pedido=' + pedido,
                                            success: function (data, textStatus, jqXHR) {
                                                window.location.reload();
                                            }
                                        });
                                    }
                                    ;
        </script>


    </body>
</html>




