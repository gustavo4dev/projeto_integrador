

<!-- Blog Sidebar Widgets Column -->



<div class="col-md-12">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <!-- Subscription widget -->
        <div class="card-panel">
            <div class="row">
                <div class="col-md-12" style="margin: 0.7em; width: 100%;">
                    <h3>Informações da Conta</h3>
                    <hr/><br/>
                    <table class="col-md-12">
                        <tr>
                            <td>
                                <label>Nome</label><h5><?php echo $dados['nome']; ?></h5>
                            </td>
                            <td>
                                <label>CPF</label><h5><?php echo $dados['cpf']; ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Data de nascimento</label><h5><?php echo date('d/m/Y', strtotime($dados['nascimento'])); ?></h5>
                            </td>
                            
                            <td>
                                <label>Sexo</label><h5><?php echo $dados['sexo']; ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label><h5><?php echo $dados['email']; ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 100%">
                                <label>Endereço</label><h5><?php echo $dados['endereco']; ?></h5>
                            </td>
                        </tr>
                    </table>
                    <form action="index.php?ctrl=usuarioloja&acao=buscar" method="post">
                        <input type="hidden" name="id" value="<?php echo $dados['idUsuario']; ?>"/>
                        <button type="submit" class="btn btn-default waves-effect waves-light" >Alterar dados</button>
                    </form>
                    <hr/>
                    <form action="index.php?ctrl=usuarioloja&acao=buscarsenha" method="post">
                        <input type="hidden" name="id" value="<?php echo $dados['idUsuario']; ?>"/>
                        <button type="submit" class="btn btn-default waves-effect waves-light" >Alterar senha</button>
                    </form>


                </div>
            </div>
        </div>
        <!--/.Subscription widget -->


    </div>
</div>
