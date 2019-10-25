<h2>Lista de tipos de pizzas</h2>
<div class="mdl-layout-spacer">
    <!-- botao para novo registro -->
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
       href="index.php?ctrl=tipopizza&acao=novo">Novo</a>
</div><br/>
<table id="tabela" class="mdl-data-table mdl-js-data-table mdl-shadow--3dp">
    <thead>
    <th>ID</th>
    <th>Descrição</th>
    <th>Quantidade de sabores</th>
    <th>Reajuste do tamanho</th>
    <th>Editar</th>
    <th>Excluir</th>
</thead>
<tbody>
    <?php if (count($dados) == 0) { ?>
        <tr>
            <td colspan="5" style="text-align: center">Nenhum resultado encontrado</td>
        </tr>
        <?php
    } else {
        foreach ($dados as $item) {
            $id = $item['idTipoPizza'];
            ?>
            <tr>
                <td><?php echo $id ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['descricao'] ?></td>
                <td><?php echo $item['quantidade'] ?></td>
                <td><?php echo $item['reajuste'] ?></td>

                <td><a href='index.php?ctrl=tipopizza&acao=buscar&id=<?php echo $id ?>'><i class="material-icons">edit</i></a></td>
                <td><a href='index.php?ctrl=tipopizza&acao=excluir&id=<?php echo $id ?>' onclick="return confirm('Deseja excluir este registro?')"><i class="material-icons">delete</i></a></td>
            </tr>
        <?php }
    } ?>
</tbody>
</table>