<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2>Listagem de compras realizadas</h2>


<table id="my-table" class="mdl-data-table mdl-js-data-table mdl-shadow--3dp">
    <thead>
        <th>Id</th>
        <th class="mdl-data-table__cell--non-numeric">Usuario</th>
        <th class="mdl-data-table__cell--non-numeric">Origem</th>
        <th class="mdl-data-table__cell--non-numeric">Destino</th>
        <th class="mdl-data-table__cell--non-numeric">Valor total</th>
        <th class="mdl-data-table__cell--non-numeric">Data da Compra</th>
    </thead>
    <tbody>
        <?php
        foreach ($dados as $item) {
            $id = $item['idCompra'];
            ?>
            <tr>
                <td><?php echo $id;?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['user']; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['origem']; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['destino']; ?></td>
                <td class="mdl-data-table__cell--non-numeric">R$ <?php echo $item['valorTotal']; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo date('d/m/Y',strtotime($item['dataCompra'])); ?></td>
        <?php } ?>
    </tbody>
</table>
