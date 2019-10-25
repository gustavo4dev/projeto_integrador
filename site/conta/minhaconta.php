<?php
include_once '../resources/componentes/header-nav.php';
//$_SESSION['user']['email'] = "gu@gu.com";
//$_SESSION['user']['logado'] = true;



if (isset($_SESSION['user'])) {
    $conta = $store->clienteConta($_SESSION['user']['email']);
} else {
    $_SESSION['modal_redirect'] = 'login.php';
    $_SESSION['modal_message'] = 'Você não está logado!<br/>Por favor faça login.';
    include '../resources/componentes/dialog.php';
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12"><br/>
            <div class="card" style="padding: 5%">
                <h3 class="title">Meus dados</h3><hr/><br/>
                <h4><?= $conta['nome'] ?></h4><br/>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><b>CPF</b></td>
                            <td><?= $conta['cpf'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td><?= $conta['email'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Telefone</b></td>
                            <td><?= $conta['telefone'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Nascimento</b></td>
                            <td><?php echo date('d/m/Y', strtotime($conta['nascimento'])); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="editadados.php" class="btn btn-danger">Editar dados</a>
                                <a href="#" id="editSenha" class="btn btn-danger">Editar senha</a></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script>
    $('#editSenha').on('click', function(){
       
           $.redirect('editaSenha.php', {'email': '<?=$conta['email']?>'},'POST');
    });
</script>
<?php
include '../resources/componentes/footer.php';