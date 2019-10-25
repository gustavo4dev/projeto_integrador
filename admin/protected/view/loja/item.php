

<!-- Blog Sidebar Widgets Column -->


<div class="col-md-6">

    <div class="thumbnail">
        <img class="img-responsive z-depth-2" src="<?php echo DIR_IMG . $dados['imagem'] ?>" alt="">


    </div>    

</div>
<div class="col-md-6">
    <div class="sidebar">
        <!-- Subscription widget -->
        <div class="card-panel">
            <div class="row">
                <div class="col-md-12">
                    <div class="caption-full">

                        <h4><a href="#"><?php echo $dados['origem'] . " <br/> " . $dados['destino'] ?></a>
                        </h4>
                        <h4>R$ <?php echo $dados['preco'] ?></h4>

                    </div>
                </div>
                <div class="text-center">
                    <form action="index.php?ctrl=passagemloja&acao=adicionarcarrinho" method="POST">
                        <input type="hidden" name="idPassagem" value="<?php echo $dados['idPassagem']; ?>"/>
                        <input type="hidden" name="preco" value="<?php echo $dados['preco']; ?>"/>
                        <input type="hidden" name="totalitem" value=""/>
                        
                        <span>Quantidade</span>
                        <select name="quantidade">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button type="submit" class="btn btn-default waves-effect waves-light">Adicionar ao carrinho</button>
                    </form>
                </div>
                <h5>Quantidade disponivel: <?php echo $dados['quantidade']; ?></h5>
                <label>Preço por pessoa.</label>
                <label>Não há reserva de passagens. O item ou a quantidade escolhida pode não estar disponível ao finalizar a compra.</label>
            </div>
        </div>
        <!--/.Subscription widget -->


    </div>
</div>
<hr/>
<div class="col-md-12">
    <hr/>
    <div class="well">

        <div class="text-right">
            <h4>Relacionados</h4>
        </div>

        <hr>
        <?php
        $count = 0;
        foreach ($relacionados as $item) {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <h5>
                            <?php echo "Passagens para: " . $item['cidade'] ?>
                            <span class="pull-right">R$ <?php echo $item['preco']; ?></span>
                        </h5>
                        <span class="pull-right"><a class="btn btn-default waves-effect waves-light" href="index.php?ctrl=PassagemLoja&acao=buscaritem&id=<?php echo $item['idPassagem']; ?>">Ver detalhes</a></span>
                        
                    </div>
                </div>

                <hr>
                <?php
            
            
        }
        ?>


    </div>
</div>