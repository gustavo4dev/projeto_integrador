<?php

include '../resources/componentes/header-nav.php';

require_once '../controller/storeController.php';
$store = new storeController();

if (isset($_SESSION['user']) && $_SESSION['user']['logado'] === true) {
    echo '<script>window.location.href = "minhaconta.php";</script>';
}

if(isset($_POST['email'])){
    $resposta = $store->esqueciSenha($_POST['email']);
    include '../resources/componentes/dialog.php';
    
    /*if(is_bool($resposta) && ($resposta == false || $resposta == true)){
        include '../resources/componentes/dialog.php';
    }
    if(is_string($resposta)){
        
    }*/
}
?>
<div class="container">
    <div class="row"><br/>
        <div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <br/>
                <h2 class="title">Esqueceu sua senha?</h2><hr/>
                <form action="esquecisenha.php" method="post" id="esqueciSenha"><br/>
                    <div class="md-form">
                        <i class="fa fa-envelope prefix"></i>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <label for="email">Digite seu email</label>
                    </div><br/>
                    
                    <div class="md-form">
                        <input type="submit" class="btn btn-danger" value="Esqueci minha senha"/>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<?php include '../resources/componentes/footer.php'; 