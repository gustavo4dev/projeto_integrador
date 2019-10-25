<h2>Listagem de produtos</h2>
<div class="mdl-layout-spacer" style="display: inline">
    <!-- botão para novo registro -->
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
       href="index.php?ctrl=produto&acao=novo">Novo</a>
</div><br/>
<table id="tabela" class="mdl-data-table mdl-js-data-table mdl-shadow--3dp">
    <thead>
    <th>ID</th>
    <th>Nome</th>
    <th>Descrição</th>
    <th>Valor</th>
    <th>Tempo de preparo</th>
    <th>Categoria</th>
    <th>Alterar</th>
    <th>Excluir</th>

</thead>
<tbody>
    <?php if ($dados == false) { ?>
        <tr>
            <td colspan="8" style="text-align: center">Nenhum resultado encontrado</td>
        </tr>
        <?php
    } else {
        foreach ($dados as $item) {
            $id = $item['idProduto'];
            ?>
            <tr>
                <td><?php echo $id ?></td>
                
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['nome'] ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo substr($item['descricao'], 0, 45) . " ..."; ?></td>
                <td>R$ <?php echo number_format($item['valor'], 2, ',', ' '); ?></td>
                <td><?php echo $item['tempoPreparo'] ?></td>
                <td><?php echo $item['categoria'] ?></td>
                <td>
                    <a href="index.php?ctrl=produto&acao=buscar&id=<?php echo $id ?>">
                        <i class="material-icons">edit</i>
                    </a>
                </td>
                <td>
                    <a href="index.php?ctrl=produto&acao=excluir&id=<?php echo $id ?>"
                       onclick="return confirm('Deseja excluir este registro?')">
                        <i class="material-icons">delete</i>
                    </a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</tbody>
</table>