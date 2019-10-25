<?php
include_once '../resources/componentes/header-nav.php';



if (isset($_GET['id'])) {
    $produtos = $store->buscaPorCategoria($_GET['id']);

    if (count($produtos) <= 0) {
        $categoria = $store->categoriaPorId($_GET['id']);
        echo '<br/><div class="col-md-1"></div>';
        echo '<div class="col-md-10">';
        echo '<h1 class="title" style="display: inline">' . $categoria['nome'] . '</h1>&nbsp; &nbsp;'
        . '<img style="padding-bottom:1%" id="icone-cesta" src="../public/img/icons/' . $categoria['imagem'] . '"><br/>';
        ?>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../">Home</a></li>
            <li class="breadcrumb-item active"><?= $categoria['nome'] ?></li>
        </ol><hr/>
        <br/><h3 class="title">Nenhum item encontrado :(</h3><hr/>
        <a onClick="history.back()" class="card-link"><i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp;Voltar</a>

        <?php
    } else if (count($produtos) > 0) {
        echo '<br/><div class="col-md-1"></div>';
        echo '<div class="col-md-10">';
        echo '<h1 class="title" style="display: inline">' . $produtos['0']['categoria'] . '</h1>&nbsp; &nbsp;'
        . '<img style="padding-bottom:1%" id="icone-cesta" src="../public/img/icons/' . $produtos['0']['imagemCat'] . '"><br/>';
        ?>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../">Home</a></li>
            <li class="breadcrumb-item active"><?= $produtos['0']['categoria'] ?></li>
        </ol><hr/>



        <?php
        $quebraLinha = 0;
        foreach ($produtos as $produto) {
            ?>
            <div class="col-md-4" style="<?php if ($quebraLinha === 3) echo "clear:both;"; ?>">
                <div class="card" id="catItem">

                    <!--Card image-->
                    <img class="img-fluid" src="../public/img/<?= $produto['imagem'] ?>">
                    <!--/.Card image-->

                    <!--Card content-->
                    <div class="card-block">
                        <!--Title-->
                        <h4 class="card-title"><?= $produto['nome'] ?></h4>
                        <!--Text-->
                        <p class="card-text">R$ <?php echo number_format($produto['valor'], 2, ',', ' '); ?></p>
                        <a href="../produto/produto.php?id=<?= $produto['idProduto'] ?>" class="btn btn-danger" id="botao-add">Adicionar à cesta</a>
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
    } else {//if (count($produtos) > 0)
        echo '<br/><h3 class="title">Nenhum item encontrado :(</h3><hr/>';
        echo '<a onClick="history.back()" class="card-link"><i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp;Voltar</a>';
    }
} else {//if (isset($_GET['id']))
    echo '<br/><h3 class="title">Nenhum item encontrado :(</h3><hr/>';
    echo '<a onClick="history.back()" class="card-link"><i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp;Voltar</a>';
}
?>
<script>
    window.sr = ScrollReveal({reset: true});
    sr.reveal('#catItem');
</script>

</div>