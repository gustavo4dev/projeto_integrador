
<?php
include_once '../resources/componentes/header-nav.php';

echo '<div class="container">
            <div class="row">';

if (isset($_GET['id'])) {
    $produto = $store->buscaProduto($_GET['id']);
    echo '<br/><div class="col-md-1"></div>';
    echo '<div class="card col-md-10">';
    if (is_array($produto)) {
        //echo '<h3 class="title">' . $produto['nome'] . '</h3><hr/>';
        ?><br/>
        
                <h1 class="title"><?= $produto['nome'] ?></h1><br/>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../">Home</a></li>
                    <li class="breadcrumb-item"><a href="../categoria/categoria.php?id=<?= $produto['idCategoria'] ?>"><?= $produto['categoria'] ?></a></li>
                    <li class="breadcrumb-item active"><?= $produto['nome'] ?></li>
                </ol>
                <!-- <div class="col-md-1"></div>
                <div class="card col-md-10"><br/><!-- comment -->
                <div class="col-md-6" style="padding: 2%">

                    <!--Card image-->
                    <img class="img-fluid" src="../public/img/<?= $produto['imagem'] ?>">
                    <!--/.Card image-->
                </div>
                <div class="col-md-6">
                    <!--Card content-->
                    <div class="card-block">
                        <!--Title-->

                        <!--Text-->
                        <form action="../cesta/addProduto.php" method="POST">
                            <h3 class="card-text col-md-4"><b>R$ <?php echo number_format($produto['valor'], 2, ',', ' '); ?></b></h3>
                            <br/><br/><hr/><br/>
                            <div class="col-md-12">
                                <h5>Quantidade</h5>
                                <div class="input-group" style="width: 100px;">
                                    <span class="input-group-btn"><a onclick="DiminuiQuant()" class="btn btn-danger">-</a></span>
                                    <input name="quantidade" id="quantidade" type="text" class="form-control" aria-label="Quantidade..." value="1" readonly style="width: 35px; text-align: center">
                                    <span class="input-group-btn"><a onclick="AumentaQuant()" class="btn btn-danger">+</a></span>
                                </div>

                                <br/>
                                <p class="card-text col-md-12">Ingredientes:<br/><?= $produto['descricao'] ?></p>
                                <input type="hidden" name="idProduto" value="<?= $produto['idProduto'] ?>"/>
                                <input type="hidden" name="valorUnitarioItem" value="<?= $produto['valor'] ?>"/>
                                <input type="submit" class="btn btn-danger m-y-3" value="Adicionar à cesta">
                            </div>
                        </form>
                    </div>
                    <!--/.Card content-->
                </div>

        <?php
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
    function AumentaQuant() {
        var campo = document.getElementById("quantidade");

        campo.value = parseInt(campo.value) + 1;

    }
    function DiminuiQuant() {
        var campo = document.getElementById("quantidade");
        if (parseInt(campo.value) > 1) {
            campo.value = parseInt(campo.value) - 1;
        }
    }
</script>

<?php
echo '</div>';
echo '</div>';
echo '</div>';

include '../resources/componentes/footer.php';
