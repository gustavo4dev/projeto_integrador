<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2>Listagem usuários</h2>


<table id="my-table" class="mdl-data-table mdl-js-data-table mdl-shadow--3dp">
    <thead>
        <th>Id</th>
        <th class="mdl-data-table__cell--non-numeric">Nome</th>
        <th class="mdl-data-table__cell--non-numeric">CPF</th>
        <th class="mdl-data-table__cell--non-numeric">email</th>
        <th class="mdl-data-table__cell--non-numeric">Sexo</th>
        <th class="mdl-data-table__cell--non-numeric">Tipo</th>
        <th class="mdl-data-table__cell--non-numeric">Data de cadastro</th>
    </thead>
    <tbody>
        <?php
        foreach ($dados as $item) {
            $id = $item['idUsuario'];
            ?>
            <tr>
                <td><?php echo $id;?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['nome']; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['cpf']; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['email']; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['sexo']; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo $item['tipo']; ?></td>
                <td class="mdl-data-table__cell--non-numeric"><?php echo date('d/m/Y', strtotime($item['dataCadastro']));  ?></td>
        <?php } ?>
    </tbody>
</table>
