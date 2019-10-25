<?php
session_start();

//importa arquivo store controller e inicializa variavel para funções
require_once './controller/storeController.php';
$store = new storeController();

//lista de categorias
$categorias = $store->listaCategorias();

//produtos em destaque
$destaques = $store->listaDestaques();

//produtos carousel
$carouselItems = $store->produtosCarousel();

$pizzaDestaque = $store->buscarPizzas();
shuffle($pizzaDestaque);
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Food Delivery</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link href="resources/css/bootstrap.min.css" rel="stylesheet">

        <!-- Material Design Bootstrap -->
        <link href="resources/css/mdb.min.css" rel="stylesheet">

        <!-- Your custom styles (optional) -->
        <link href="resources/css/style.css" rel="stylesheet">

    </head>

    <body>
        <div>
            <nav class="navbar navbar-dark red">

                <!-- Collapse button-->
                <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx23"><i class="fa fa-bars"></i></button>

                <div class="container">
                    <a class="navbar-brand" href="index.php" style="vertical-align: middle "><i class="fa fa-cutlery fa-lg" aria-hidden="true"></i>
                        &nbsp;Food delivery</a>
                    <!--Collapse content-->
                    <div class="collapse navbar-toggleable-xs" id="collapseEx23">

                        <!--/Links-->


                        <!--Links-->
                        <ul class="nav navbar-nav nav-flex-icons">
                            <li class="nav-item ">
                                <a class="nav-link" href="cesta/cesta.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;Cesta</a>
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
                                        <a class="dropdown-item" href="conta/minhaconta.php">Minha conta</a>
                                        <a class="dropdown-item" href="conta/meuspedidos.php">Meus pedidos</a>
                                        <a class="dropdown-item" href="conta/logout.php">Sair</a>   
                                    </div>
                                <?php } else { ?>
                                    <div class="dropdown-menu dropdown-warning" aria-labelledby="dropdownMenu1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item" href="conta/login.php">Login</a>
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

        <!-- JQuery -->
        <script type="text/javascript" src="resources/js/jquery-2.2.3.min.js"></script>

        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="resources/js/tether.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="resources/js/bootstrap.min.js"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="resources/js/mdb.min.js"></script>

        <!-- conteudo -->

        <!-- botao back to top -->
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

        <!-- Conteudo do site -->
        <div class="container">
            <div class="row">

                <!--Carousel Wrapper-->
                <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel" style="box-shadow: 0 5px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);">


                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <!--Mask color-->
                            <div class="view hm-black-light">
                                <img src="public/img/<?= $pizzaDestaque[6]['imagem'] ?>" class="img-fluid" alt="">
                                <div class="full-bg-img">
                                </div>
                            </div>
                            <!--Caption-->
                            <div class="carousel-caption">
                                <div class="animated fadeInDown">
                                    <h3 class="h3-responsive">Pizza <?= $pizzaDestaque[6]['nome'] ?></h3>
                                    <h5>R$&nbsp;<?php echo number_format($pizzaDestaque[6]['valor'], 2, ',', ' '); ?></h5>
                                    <a href="pizzas/"
                                       class="btn btn-danger">Ver mais...</a>
                                </div>
                            </div>
                            <!--Caption-->
                        </div>
                        <!--First slide-->
                        <?php
                        $itemLimit = 0;
                        foreach ($carouselItems as $item) {
                            ?>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view hm-black-light">
                                    <img src="public/img/<?= $item['imagem'] ?>" class="img-fluid" alt="">
                                    <div class="full-bg-img">
                                    </div>
                                </div>
                                <!--Caption-->
                                <div class="carousel-caption">
                                    <div class="animated fadeInDown">
                                        <h3 class="h3-responsive"><?= $item['nome'] ?></h3>
                                        <h5>R$&nbsp;<?php echo number_format($item['valor'], 2, ',', ' '); ?></h5>
                                        <a href="produto/produto.php?id=<?= $item['idProduto'] ?>"
                                           class="btn btn-danger">Adicionar à cesta</a>
                                    </div>
                                </div>
                                <!--Caption-->
                            </div>
                            <?php
                            if ($itemLimit < 2)
                                $itemLimit++;
                            else
                                break;
                        }
                        ?>
                        <div class="carousel-item">
                            <!--Mask color-->
                            <div class="view hm-black-light">
                                <img src="public/img/<?= $pizzaDestaque[3]['imagem'] ?>" class="img-fluid" alt="">
                                <div class="full-bg-img">
                                </div>
                            </div>
                            <!--Caption-->
                            <div class="carousel-caption">
                                <div class="animated fadeInDown">
                                    <h3 class="h3-responsive">Pizza <?= $pizzaDestaque[3]['nome'] ?></h3>
                                    <h5>R$&nbsp;<?php echo number_format($pizzaDestaque[3]['valor'], 2, ',', ' '); ?></h5>
                                    <a href="pizzas/"
                                       class="btn btn-danger">Ver mais...</a>
                                </div>
                            </div>
                            <!--Caption-->
                        </div>
                    </div>
                </div>
                <!-- </div><!-- comment -->
                <br/>
                <div class="container">
                    <div class="col-md-12">
                        <div class="col-md-2">

                            <div class="card">
                                <div class="card-header danger-color-dark white-text">
                                    Categorias
                                    <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx22"><i class="fa fa-bars"></i></button>
                                </div>

                                <!--Collapse content-->
                                <div class="collapse navbar-toggleable-xs" id="collapseEx22">
                                    <!--Links-->
                                    <div class="list-group">
                                        <?php foreach ($categorias as $cat) { ?>
                                            <a href="categoria/categoria.php?id=<?= $cat['idCategoria'] ?>" class="list-group-item"><?= $cat['nome'] ?></a>
                                        <?php } ?>
                                        <a href="pizzas/" class="list-group-item">Pizzas</a>
                                    </div>

                                    <!--Links-->
                                </div>
                                <!--/.Collapse content-->
                            </div>
                        </div>

                        <div class="col-md-10">
                            <h3 class="title">Destaques</h3><hr/>
                            <?php
                            shuffle($destaques);
                            $quebraLinha = 0;
                            foreach ($destaques as $destaque) {
                                if ($quebraLinha === 2)
                                    echo '<br/>';
                                ?>
                                <div class="col-md-4">
                                    <div class="card">

                                        <!--Card image-->
                                        <img class="img-fluid" src="public/img/<?= $destaque['imagem'] ?>" alt="Pizza Calabresa">
                                        <!--/.Card image-->

                                        <!--Card content-->
                                        <div class="card-block">
                                            <!--Title-->
                                            <h4 class="card-title"><?= $destaque['nome'] ?></h4>
                                            <!--Text-->
                                            <p class="card-text">R$ <?php echo number_format($destaque['valor'], 2, ',', ' '); ?></p>
                                            <a href="produto/produto.php?id=<?= $destaque['idProduto'] ?>" id="btn-destaque" class="btn btn-danger">Adicionar à cesta</a>
                                        </div>
                                        <!--/.Card content-->

                                    </div>
                                </div>
                                <?php
                                if ($quebraLinha < 3) {
                                    $quebraLinha++;
                                } else {

                                    $quebraLinha = 0;
                                }
                            }
                            ?>
                        </div><hr/>
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <hr/><br/>
                            <h3 class="title">Demais produtos</h3><hr/>
                            <?php
                            $quebraLinha = 0;
                            $limite = 0;
                            foreach ($carouselItems as $item) {
                                if ($quebraLinha === 2)
                                    echo '<br/>';
                                ?>
                                <div class="col-md-4">
                                    <div class="card">

                                        <!--Card image-->
                                        <img class="img-fluid" src="public/img/<?= $item['imagem'] ?>">
                                        <!--/.Card image-->

                                        <!--Card content-->
                                        <div class="card-block">
                                            <!--Title-->
                                            <h4 class="card-title"><?= $item['nome'] ?></h4>
                                            <!--Text-->
                                            <p class="card-text">R$ <?php echo number_format($item['valor'], 2, ',', ' '); ?></p>
                                            <a href="produto/produto.php?id=<?= $item['idProduto'] ?>" id="btn-destaque" class="btn btn-danger">Adicionar à cesta</a>
                                        </div>
                                        <!--/.Card content-->

                                    </div>
                                </div>
                                <?php
                                if ($quebraLinha < 3) {
                                    $quebraLinha++;
                                } else {

                                    $quebraLinha = 0;
                                }
                                if ($itemLimit < 10)
                                    $itemLimit++;
                                else
                                    break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer red center-on-small-only">

        <!--Footer Links-->
        <div class="container-fluid">
            <div class="row">

                <!--First column-->
                <div class="col-md-6">
                    <h5 class="title">Food Delivery <i class="fa fa-smile-o fa-3x" aria-hidden="true"></i></h5>
                    <p>Sua fome não pode esperar!</p>
                </div>
                <!--/.First column-->

                <!--Second column-->
                <div class="col-md-6">
                    <h5 class="title">Categorias</h5>
                    <ul>
                        <li><a href="categoria/categoria.php?id=3">Lanches</a></li>
                        <li><a href="categoria/categoria.php?id=4">Porções</a></li>
                        <li><a href="categoria/categoria.php?id=5">Pastéis</a></li>
                        <li><a href="categoria/categoria.php?id=6">Sobremesas</a></li>
                        <li><a href="categoria/categoria.php?id=7">Bebidas</a></li>
                        <li><a href="pizzas/">Link 1</a></li>
                    </ul>
                </div>
                <!--/.Second column-->
            </div>
        </div>
        <!--/.Footer Links-->

        <!--Copyright-->
        <div class="footer-copyright">
            <div class="container-fluid">
                © 2016 Copyright: Food Delivery

            </div>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->



</body>

</html>