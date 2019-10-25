
<h2>Cadastro de produtos em destaque</h2>


<form id="demoform" action="index.php?ctrl=destaques&acao=inserir" method="post">
    <select multiple="multiple" size="10" name="destaques[]">
        <?php
        foreach ($produtos as $produto) {
                ?>
                <option value="<?= $produto['idProduto'] ?>" <?php
                if($destaques != false){
                if (array_search($produto['idProduto'], array_column($destaques, 'idProduto')) !== FALSE) echo "selected";}?>>
                <?= $produto['nome'] ?>
                </option>
                <?php
            }
        
        ?>      
    </select>
    <br>
    <button type="submit" class="btn btn-default btn-block">Submit data</button>
</form>
<script>
    var demo1 = $('select[name="destaques[]"]').bootstrapDualListbox();

</script>