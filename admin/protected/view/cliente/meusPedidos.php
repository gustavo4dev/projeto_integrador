

<!-- Blog Sidebar Widgets Column -->



<div class="col-md-12">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <!-- Subscription widget -->
        <div class="card-panel">
            <div class="row">
                <div class="col-md-12" style="margin: 0.7em; width: 100%;">
                    <h3>Compras realizadas</h3>
                    <hr/><br/>
                    <table class="col-md-12 mdl-data-table mdl-js-data-table">
                        <?php
                        if (count($itens) <= 0) {
                            echo '<div class="text-center">';
                            echo '<h5>Nenhuma compra registrada</h5>';
                            echo '<a href="index.php" class="btn btn-default waves-effect waves-light">Ver passagens!</a>';
                            echo '</div>';
                        } else if (count($itens) === 1) {
                            foreach ($itens as $item) {
                                ?>
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric">
                                        <?php echo '<label>De</label><br/>' . $item['origem'] . '<br/><label>Para</label><br/>' . $item['destino']; ?>
                                    </td>
                                    <td>
                                        <?php echo '<label>Data da compra</label><br/>' . date('d/m/Y', strtotime($item['dataCompra'])); ?>
                                    </td>
                                    <td>
                                        <?php echo '<label>Valor total</label><br/>R$ ' . $item['valorTotal']; ?>
                                    </td>
                                </tr> 
                                <?php
                            }
                        } else if (count($itens) > 1) {

                            foreach ($itens as $item) {
                                ?>
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric">
                                        <?php echo '<label>De</label><br/>' . $item['origem'] . '<br/><label>Para</label><br/>' . $item['destino']; ?>

                                    </td>
                                    <td>
                                        <?php echo '<label>Data da compra</label><br/>' . date('d/m/Y', strtotime($item['dataCompra'])); ?>
                                    </td>
                                    <td>
                                        <?php echo '<label>Valor total</label><br/>R$ ' . $item['valorTotal']; ?>
                                    </td>
                                    
                                </tr>


                                <?php
                            }
                        }
                        ?>

                    </table>


                </div>
            </div>
        </div>
        <!--/.Subscription widget -->


    </div>
</div>
