

<!-- Blog Sidebar Widgets Column -->



<div class="col-md-12">
    <div class="col-md-12">
        <!-- Subscription widget -->
        <div class="card-panel">
            <div class="row">
                <div class="col-md-12" style="margin: 0.6em; width: 98%;">
                    <h3>Carrinho de compras</h3>
                    <hr/><br/>
                    <table class="col-md-12 mdl-data-table mdl-js-data-table">
                        <?php
                        if (count($itens) <= 0) {
                            echo '<div class="text-center">';
                            echo '<h5>Carrinho vazio...</h5>';
                            echo '<a href="index.php" class="btn btn-default waves-effect waves-light">Adicionar itens</a>';
                            echo '</div>';
                        } else {
                            $i = 0;
                            $valorTotal = 0;
                            foreach ($itens as $item) {
                                $passagem = $this->model->buscaritem($item['idPassagem']);
                                $valorTotal += $passagem['preco'] * $item['quantidade'];
                                ?>
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric">
                                        <?php echo '<label>De</label><br/>' . $passagem['origem'] . '<br/><label>Para</label><br/>' . $passagem['destino']; ?>

                                    </td>
                                    <td>
                                        <?php echo '<label>Quantidade</label><br/>' . $item['quantidade']; ?>
                                    </td>
                                    <td>
                                        <?php echo '<label>Valor unitário</label><br/>R$ ' . $passagem['preco']; ?>
                                    </td>
                                    <td>
                                        <label>Ver item</label><br/>
                                        <a href="index.php?ctrl=passagemloja&acao=buscaritem&id=<?php echo $item['idPassagem']; ?>">
                                            <i class="material-icons">add_circle</i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo '<label>Remover</label><br/><a href="index.php?ctrl=passagemloja&acao=removeitem&id=' . $chave[$i] . '"><i class="material-icons">remove_shopping_cart</i></a>' ?>
                                    </td>
                                </tr>


                                <?php
                                $i++;
                            }
                            ?>
                            <tr>
                                <td colspan="5"><h5>Valor total: R$ <?php echo $valorTotal; ?></h5></td>
                            </tr>
                        <?php } ?>

                    </table>
                    <?php if (count($itens) > 0) { ?>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <a href="index.php" class="btn btn-danger">Continuar comprando</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <form action="index.php?ctrl=passagemloja&acao=finalizacompra" method="POST">
                                    <input type="hidden" name="valorTotal" value="<?php echo $valorTotal; ?>">
                                    <input type="hidden" name="cod" value="<?php echo md5(uniqid(time())); ?>">
                                    <button type="submit" class="btn btn-default waves-effect waves-light">Finalizar compra</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <!--/.Subscription widget -->


    </div>
</div>
