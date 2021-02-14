<h2>Lista de categorias</h2>
<div class="mdl-layout-spacer" style="display: inline">
    <!-- botão para novo registro -->
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
       href="index.php?ctrl=categoria&acao=novo">Novo</a>
</div><br/>
<table id="tabela" class="mdl-data-table mdl-js-data-table mdl-shadow--3dp">
    <thead>
    <th>ID</th>
    <th>Nome</th>
    <th>Descricao</th>
    <th>Alterar</th>
    <th>Excluir</th>        
</thead>
<tbody>
    <?php if ($dados == false) { ?>
        <tr>
            <td colspan="5" style="text-align: center">Nenhum resultado encontrado</td>
        </tr>
        <?php
    } else {
        foreach ($dados as $item) {
            $id = $item['idCategoria'];
            ?>
            <tr>
                <td><?= $id ?></td>
                <td class="mdl-data-table__cell--non-numeric"> <?= $item['nome'] ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?= $item['descricao'] ?></td>
                <td><a href='index.php?ctrl=categoria&acao=buscar&id=<?= $id ?>'><i class="material-icons">edit</i></a></td>
                <td><a href='index.php?ctrl=categoria&acao=excluir&id=<?= $id ?>' onclick="return confirm('Deseja excluir este registro?')"><i class="material-icons">delete</i></a></td>

            </tr>
            <?php
        }
    }
    ?>

</tbody>