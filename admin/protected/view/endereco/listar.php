<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2>Lista de sabore de pizza</h2>
<div class="mdl-layout-spacer">
    <!-- botao para novo registro -->
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
       href="index.php?ctrl=sabor&acao=novo">Novo</a>
       
       <!-- formulario de pesquisa -->
    <form action="index.php?ctrl=sabor&acao=pesquisar" method="POST">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="termo">
                <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
                <input class="mdl-textfield__input" type="text" id="termo" name="termo" value="<?php if (isset($palavra)) echo $palavra; ?>">
                <label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
            </div>
        </div>
    </form>
</div>

<table id="my-table" class="mdl-data-table mdl-js-data-table mdl-shadow--3dp">
    <thead>
    <th>#</th>
    <th>Nome</th>
    <th>Descrição</th>
    <th>Valor (pizza inteira)</th>
</thead>
<tbody>
    <?php if (count($dados) == 0) { ?>
        <tr>
            <td colspan="6" style="text-align: center">Nenhum resultado encontrado</td>
        </tr>
        <?php
    } else {
        foreach ($dados as $item) {
            $id = $item['idSabor'];
            ?>
            <tr>
                <td><?php echo $id ?></td>

                <td><?php echo $item['nome'] ?></td>
                <td><?php echo $item['descricao'] ?></td>
                <td><?php echo 'R$ ' . $item['valor'] ?></td>
                <td><a href='index.php?ctrl=sabor&acao=buscar&id=<?php echo $id ?>'><i class="material-icons">edit</i></a></td>
                <td><a href='index.php?ctrl=sabor&acao=excluir&id=<?php echo $id ?>'><i class="material-icons">delete</i></a></td>
            </tr>
    <?php } } ?>
</tbody>
</table>
