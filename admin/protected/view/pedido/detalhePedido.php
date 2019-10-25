<?php
require_once '../controller/pedido.php';
$pedido = new Pedido();
?>
<h2>Pedido <b><?= $registro['codigoValidacao'] ?></b></h2><hr/>

<h4>Cliente: <?= $registro['cliente'] ?></h4>


<h4>Dados do pedido</h4>
<table class="mdl-data-table mdl-js-data-table" id="my-table">
    <thead>
    <th class="mdl-data-table__cell--non-numeric">Data do pedido</th>
    <th class="mdl-data-table__cell--non-numeric">Endereço de entrega</th>
    <th>Valor total</th>
</thead>
<tbody>
    <tr>
        <td class="mdl-data-table__cell--non-numeric"><?php echo date('d/m/Y H:i', strtotime($registro['dataPedido'])); ?></td>
        <td class="mdl-data-table__cell--non-numeric">
            <?php
            $endereco = $registro['endereco'];
            echo $endereco['rua'] . ' ,' . $endereco['numero'] . ' - ' . $endereco['bairro'];
            echo '<br/>' . $endereco['cidade'];
            ?>
        </td>
        <td><h4>R$&nbsp;<?php echo number_format($registro['valorTotal'], 2, ',', '.'); ?></h4></td>
    </tr>
</tbody>
</table>
<hr/>
<h4>Itens do pedido</h4>
<table class="mdl-data-table mdl-js-data-table" id="my-table">
    <thead>
    <th class="mdl-data-table__cell--non-numeric">Item</th>
    <th>Valor unitário</th>
    <th>Quantidade</th>
    <th>Valor total</th>
</thead>
<tbody>
    <?php
    foreach ($itens as $item) {
        ?>
        <tr>
            <?php
            if (isset($item['idCombinacao'])) {

                $sabores = $pedido->buscaNomeCombinacao($item['idCombinacao']);
                echo '<td class="mdl-data-table__cell--non-numeric"><small>Pizza</small><br/> ';
                if (isset($sabores['sabor1']))
                    echo $sabores['sabor1'];
                if (isset($sabores['sabor2']))
                    echo ',&nbsp;' . $sabores['sabor2'];
                if (isset($sabores['sabor3']))
                    echo ',&nbsp;' . $sabores['sabor3'];
                echo '</td>';
            }

            if (isset($item['idProduto'])) {

                $produto = $pedido->buscaProduto($item['idProduto']);
                
                echo '<td class="mdl-data-table__cell--non-numeric">';
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

</table><br/>
<form action="index.php?ctrl=pedido&acao=validaPedido" method="post">
    <input type="hidden" name="id" value="<?=$registro['idPedido']?>"/>
    <input type="submit" class="mdl-button mdl-js-button mdl-button--raised" value="Finalizar pedido"/>
</form>
