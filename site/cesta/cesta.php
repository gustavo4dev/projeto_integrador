
<?php
include_once '../resources/componentes/header-nav.php';
$cestavazia = false;
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br/>
            <div class="card" style="padding: 3%">
                <h2>Cesta de compras</h2><hr/>

                <table class="table table-hover">
                    <?php
                    if (isset($_SESSION['cesta']['item']) && count($_SESSION['cesta']['item']) > 0) {
                        ?>
                        <thead>
                        <th colspan="2">Item</th>
                        <th>Valor Unitário</th>
                        <th>Quantidade</th>
                        <th>Valor total</th>
                        <th></th>

                        </thead>
                        <tbody>
                            <?php
                            $itens = $_SESSION['cesta']['item'];
                            $valorTotal = 0;
                            $arrayIndex = 0;

                            foreach ($itens as $key => $item) {
                                ?>
                                <tr>
                                    <?php
                                    if (isset($item['idCombinacao'])) {
                                        echo "<td><img id=\"icone-cesta\" src=\"../public/img/icons/7cf2db5ec261a0fa27a502d3196a6f60.png\"></td>";
                                        //echo "<td><small>Pizza:</small><br/> ";
                                        $sabores = $store->buscaNomeCombinacao($item['idCombinacao']);
                                        echo "<td><small>Pizza:&nbsp;" . $sabores['tipopizza'] . "</small><br/> ";
                                        if (isset($sabores['sabor1']))
                                            echo $sabores['sabor1'];
                                        if (isset($sabores['sabor2']))
                                            echo ',&nbsp;' . $sabores['sabor2'];
                                        if (isset($sabores['sabor3']))
                                            echo ',&nbsp;' . $sabores['sabor3'];
                                        echo '</td>';
                                    }
                                    if (isset($item['idProduto'])) {

                                        $produto = $store->buscaProduto($item['idProduto']);
                                        $imagem = $produto['imagemCat'];
                                        echo "<td><img id=\"icone-cesta\" src=\"../public/img/icons/$imagem\"></td>";
                                        echo '<td>';
                                        echo '<small>' . $produto['categoria'] . '</small><br/>' . $produto['nome'];
                                        echo '</td>';
                                    }
                                    ?>

                                    <td>R$&nbsp;<?php echo number_format($item['valorUnitarioItem'], 2, ',', ' '); ?></td>
                                    <td><div class="input-group" style="width: 100px;">
                                            <span class="input-group-btn"><a onclick="MudaQuant(<?php echo $key; ?>, -1)" id="aumentar" class="btn btn-danger">-</a></span>
                                            <input name="quantidade" type="text" class="form-control" aria-label="Quantidade..." data-pos="<?php echo $key; ?>" value="<?= $item['quantidade'] ?>" readonly style="width: 35px; text-align: center">
                                            <span class="input-group-btn"><a onclick="MudaQuant(<?php echo $key; ?>, 1)" id="diminuir" class="btn btn-danger">+</a></span>
                                        </div></td>
                                    <td>R$&nbsp;<span id="unit<?= $key ?>"><?php echo number_format($item['valorUnitarioItem'] * $item['quantidade'], 2, ',', ' '); ?></span></td>
                                    <td><a href="remove.php?id=<?= $key ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                </tr>
                                <?php
                                $arrayIndex ++;
                                $valorTotal += $item['valorUnitarioItem'] * $item['quantidade'];
                            }
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: right; padding-right: 10%">
                                    <b>Total</b>&nbsp;R$&nbsp;<span id="total"><?php echo number_format($valorTotal, 2, ',', ' '); ?>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                    } else {
                        $cestavazia = true;
                        ?>
                        <tr>
                            <td>
                                <h2>Nenhum item na cesta :(</h2>
                                <a class="btn btn-danger-outline" href="../index.php">Comprar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <?php if ($cestavazia === false) { ?>
                    <a class="btn btn-danger-outline" href="../index.php">Continuar comprando</a>
                    <a class="btn btn-danger right" href="checkout.php">Finalizar pedido</a>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
<script>
    function MudaQuant(pos, n) {
        var campo = $("input[data-pos=" + pos + "]")[0];
        if (n == 1 || (n == -1 && parseInt(campo.value) > 1)) {
            campo.value = parseInt(campo.value) + n;
        }
        $.ajax({
            type: 'POST',
            url: 'setQuantidade.php',
            data: 'quantidade=' + campo.value + "&pos=" + pos,
            success: function(data, textStatus, jqXHR) {
                //alert(JSON.stringify(data));
                dados = JSON.parse(data);
                $('#unit' + pos).text(dados.totalItem);
                $('#total').text(dados.totalCesta);
                //alert('Alterado');
                // window.location.href = "/pintegrador/site/cesta/cesta.php";
            }
        });
    }
    
    

    /*$('#aumentar').click(function (){
     var campo = $('#quantidade');
     if(parseInt(campo.value) < 5){
     campo.value = parseInt(campo.value) + 1;
     }
     });
     
     $('#diminuir').click(function (){
     var campo = $('#quantidade');
     if (parseInt(campo.value) > 1) {
     campo.value = parseInt(campo.value) - 1;
     }
     });*/
</script>
<?php
include '../resources/componentes/footer.php';

