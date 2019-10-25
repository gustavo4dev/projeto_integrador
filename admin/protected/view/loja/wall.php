





<!-- carousel -->
<div id="carousel-example-generic" class="carousel slide carousel-fade card">



    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php
        $i = 0;
        for ($i; $i < count($dados); $i++) {

            if ($i < 3) {
                $item_class = ($i) ? 'item active' : 'item';
                ?>
                <!-- First slide -->
                <div class="<?php echo $item_class; ?>" style="
                     background-image: url(<?php echo DIR_IMG . $dados{$i}['imagem']; ?>);">
                    <div class="carousel-caption">
                        <div data-animation="animated fadeInRightBig">
                            <h3 class="h3-responsive">Passagens para <?php echo $dados{$i}['cidade']; ?></h3>
                            <h4 class="h4-responsive">Por apenas R$ <?php echo $dados{$i}['preco']; ?></h4>
                            <span>Partindo de <?php echo $dados{$i}['origem']; ?></span><br/>
                            <a href="index.php?ctrl=PassagemLoja&acao=buscaritem&id=<?php echo $dados{$i}['idPassagem']; ?>" class="btn btn-default waves-effect waves-light">Ver detalhes</a>
                        </div>

                    </div>
                </div>
                <!-- /.item -->

                <?php
            } else {
                break;
            }
        }
        print_r($i);
        ?>
        

    </div>
    <!-- /.carousel-inner -->

    <!-- Controls -->
    <a class="left carousel-control new-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="fa fa fa-angle-left waves-effect waves-light"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control new-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="fa fa fa-angle-right waves-effect waves-light"></span>
        <span class="sr-only">Previous</span>
    </a>

</div>
<!-- /.carousel -->

<!-- Page Features -->
<div class="row text-center">

    <!-- /.col-md-4 -->
    <?php
    $count = 0;
    for ($i; $i < count($dados); $i++) {
        if ($count < 4) {
            ?>
            <div class="col-md-3">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="<?php echo DIR_IMG . $dados{$i}['imagem']; ?>">
                        <span class="card-title"><br/><?php echo $dados{$i}['cidade']; ?></span>
                    </div>
                    <div class="card-content">
                        <p><?php echo $dados{$i}['descricao']; ?></p>
                    </div>
                    <div class="card-action">
                        <a href="index.php?ctrl=PassagemLoja&acao=buscaritem&id=<?php echo $dados{$i}['idPassagem']; ?>" class="btn btn-info waves-effect waves-light">Ver detalhes</a>
                    </div>
                </div>
            </div>
            <?php
        } else {
            break;
        }
        $count++;
    }
    
    ?>
    
    

</div>
<div class="row text-center">

    <!-- /.col-md-4 -->
    <?php
    $count = 0;
    for ($i; $i < count($dados); $i++) {
        if ($count < 4) {
            ?>
            <div class="col-md-3">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="<?php echo DIR_IMG . $dados{$i}['imagem']; ?>">
                        <span class="card-title"><br/><?php echo $dados{$i}['cidade']; ?></span>
                    </div>
                    <div class="card-content">
                        <p><?php echo $dados{$i}['descricao']; ?></p>
                    </div>
                    <div class="card-action">
                        <a href="index.php?ctrl=PassagemLoja&acao=buscaritem&id=<?php echo $dados{$i}['idPassagem']; ?>" class="btn btn-info waves-effect waves-light">Ver detalhes</a>
                    </div>
                </div>
            </div>
            <?php
        } else {
            break;
        }
        $count++;
    }
    
    ?>
    
    

</div>

<!-- /.row -->

