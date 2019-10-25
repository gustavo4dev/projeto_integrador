<?php
include_once '../resources/componentes/header-nav.php';

require_once '../controller/storeController.php';
$store = new storeController();

if (isset($_SESSION['user']['logado']) && $_SESSION['user']['logado'] == true) {
    $cesta = $_SESSION['cesta']['item'];
    ?><br/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Dados do pedido</h1>
                <table class="table">
                    <thead>
                    <th colspan="2">Item</th>
                    <th>Valor unitario</th>
                    <th>Quantidade</th>
                    <th>Valor total</th>
                    </thead>
                    <tbody>

                        <?php
                        $valorTotal = 0;
                        foreach ($cesta as $item) {
                            ?>
                            <tr>
                                <?php
                                if (isset($item['idProduto'])) {

                                    $produto = $store->buscaProduto($item['idProduto']);
                                    $imagem = $produto['imagemCat'];
                                    echo "<td><img id=\"icone-cesta\" src=\"../public/img/icons/$imagem\"></td>";
                                    echo '<td>';
                                    echo '<small>' . $produto['categoria'] . '</small><br/>' . $produto['nome'];
                                    echo '</td>';
                                }
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
                                ?>
                                <td>R$&nbsp;<?php echo number_format($item['valorUnitarioItem'], 2, ',', ' '); ?></td>
                                <td><?= $item['quantidade'] ?></td>
                                <td>R$&nbsp;<?php echo number_format($item['valorUnitarioItem'] * $item['quantidade'], 2, ',', ' '); ?></td>
                            </tr>
                            <?php
                            $valorTotal += $item['valorUnitarioItem'] * $item['quantidade'];
                        }
                        ?>
                        <tr>
                            <td colspan="5" style="text-align: right; padding-right: 10%">
                                <h4> <b>Total</b>&nbsp;R$&nbsp;<?php echo number_format($valorTotal, 2, ',', ' '); ?></h4>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr/>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <h3>Selecione o endereço de entrega</h3>
                        <?php
                        $enderecos = $store->buscaEndereco($_SESSION['user']['email']);
                        ?>
                        <table id="example" class="table table-hover">
                            <thead>
                            <th>Selecione</th>
                            <th>Rua</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($enderecos as $endereco) {
                                    ?>
                                    <tr>
                                        <td style="width: 20px"><input type="radio" value="<?= $endereco['idEndereco'] ?>" name="idEndereco"></td>
                                        <td>
                                            <p><?php echo $endereco['rua'] . ', nº ' . $endereco['numero']; ?></p>
                                        </td>
                                        <td>
                                            <p><?= $endereco['bairro'] ?></p>
                                        </td>
                                        <td>
                                            <?= $endereco['cidade'] ?>
                                        </td>

                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                        <hr/>
                    
                    <h3>Ou</h3>
                    <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseEndereco" aria-expanded="false" aria-controls="collapseEndereco">
                        Adicione um novo endereço
                    </button>
                    <div class="collapse" id="collapseEndereco">
                        
                            <form action="addEndereco.php" method="POST">
                                <div class="md-form">
                                    <label for="rua">Rua</label>
                                    <input type="text" class="form-control" name="rua" required/>
                                </div>
                                <div class="md-form">
                                    <label for="numero">Número</label>
                                    <input type="text" class="form-control" name="numero" required/>
                                </div>
                                <div class="md-form">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" name="bairro" required/>
                                </div>
                                <div class="md-form">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" class="form-control" name="complemento" required/>
                                </div>
                                <div class="md-form">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control" name="cep" required/>
                                </div>
                                <div class="md-form">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" name="cidade" required/>
                                </div>
                                <input type="submit" class="btn btn-danger" value="Adicionar" />
                            </form>
                        </div>
                    </div>

                    <hr/>
                    <div class="col-md-12" style="text-align: center">
                        <hr/>
                        <a class="btn btn-danger-outline" href="cesta.php">Voltar</a>
                        <a class="btn btn-danger" href="#" onclick="finalizar()">Finalizar pedido</a>
                    </div>
                </div>
            </div>
        </div>
    </div><br/><br/>

    <script>
        function finalizar() {
            var endereco = $("input:radio[name='idEndereco']:checked").val();
            if (typeof endereco == "undefined") {
                alert("Selecione um endereco!");
            } else {
                $.redirect('finalizaPedido.php', {'idEndereco': endereco, 'valorTotal': <?=$valorTotal?>}, 'post');
            }
        }
    </script>
    <?php
} else {

    $_SESSION['modal_message'] = 'Por favor faça login para continuar!';
    $_SESSION['modal_redirect'] = '../conta/login.php';
    $_SESSION['checkout'] = true;
    include '../resources/componentes/dialog.php';
}
include '../resources/componentes/footer.php';