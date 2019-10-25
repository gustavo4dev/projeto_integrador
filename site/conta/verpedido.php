<?php
include_once '../resources/componentes/header-nav.php';

require_once '../controller/storeController.php';
$store = new storeController();

if (isset($_GET['cod'])) {
    $pedido = $store->getPedido($_GET['cod']);
    if (is_array($pedido) && count($pedido) > 0) {
        ?>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Roboto:900');
            #codPedido{
                font-family: 'Roboto', sans-serif;
                font-weight: bold;
                font-size: 60px;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br/>

                    <div class="card" style="padding: 5%">
                        <h2>Pedido</h2>
                        <h1 id="codPedido"><?= $pedido['codigoValidacao'] ?></h1>
                        <hr/>
                        <h4>Dados do pedido</h4>
                        <table class="table">
                            <thead>
                            <th>Data do pedido</th>
                            <th>Endereço de entrega</th>
                            <th>Valor total</th>
                            <th>Status</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo date('d/m/Y H:i', strtotime($pedido['dataPedido'])); ?></td>
                                    <td>
                                        <?php
                                        $endereco = $store->getEndereco($pedido['idEndereco']);
                                        echo $endereco['rua'] . ' ,' . $endereco['numero'] . ' - ' . $endereco['bairro'];
                                        echo '<br/>' . $endereco['cidade'];
                                        ?>
                                    </td>
                                    <td><h4>R$&nbsp;<?php echo number_format($pedido['valorTotal'], 2, ',', '.'); ?></h4></td>
                                    <td>
                                        <?php if ($pedido['status'] == true) { ?>
                                            Preparando...
                                        <?php } else { ?>
                                            Finalizado
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr/>
                        <h4>Itens do pedido</h4>
                        <table class="table">
                            <thead>
                            <th colspan="2">Item</th>
                            <th>Valor unitário</th>
                            <th>Quantidade</th>
                            <th>Valor total</th>
                            </thead>
                            <tbody>
                                <?php
                                $itens = $store->getItensPedido($pedido['idPedido']);
                                foreach ($itens as $item) {
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
                                        <td><?= $item['quantidade'] ?></td>
                                        <td>R$&nbsp;<?php echo number_format($item['valorUnitarioItem'] * $item['quantidade'], 2, ',', ' '); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php
        
    } else {
        echo '<script>window.location.href = "meuspedidos.php";</script>';
    }
} else {
    echo '<script>window.location.href = "meuspedidos.php";</script>';
}

