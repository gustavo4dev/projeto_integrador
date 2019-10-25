<?php
include_once '../resources/componentes/header-nav.php';

require_once '../controller/storeController.php';
$store = new storeController();

if (!isset($_SESSION['user']['logado'])) {
    $_SESSION['modal_message'] = "Porfavor faça login para continuar.";
    $_SESSION['modal_redirect'] = "login.php";
    include '../resources/componentes/dialog.php';
} else {
    $pedidos = $store->clientePedidos();
    ?>
    <div class="container">
        <div class="row"><br/>
            <div class="col-md-12">
                <div class="card" style="padding: 5%">
                    <button class="btn btn-danger" type="button" onclick="fechaCollapse('#collapseFechados')" data-toggle="collapse" data-target="#collapseAbertos" aria-expanded="false" aria-controls="collapseAbertos">
                        Pedidos abertos
                    </button>
                    <button class="btn btn-danger" type="button" onclick="fechaCollapse('#collapseAbertos')" data-toggle="collapse" data-target="#collapseFechados" aria-expanded="false" aria-controls="collapseFechados">
                        Pedidos fechados
                    </button>
                    <div class="collapse" id="collapseAbertos">

                        <table class="table table-hover">
                            <thead>
                            <th>Data do pedido</th>
                            <th>Endereço de entrega</th>
                            <th>Codigo do pedido</th>
                            <th>Valor total</th>
                            <th></th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($pedidos as $pedido) {
                                    if ($pedido['status'] == 1) {
                                        ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y H:i', strtotime($pedido['dataPedido'])); ?></td>
                                            <td>
                                                <?php
                                                $endereco = $store->getEndereco($pedido['idEndereco']);
                                                echo $endereco['rua'] . ' ,' . $endereco['numero'] . ' - ' . $endereco['bairro'];
                                                echo '<br/>' . $endereco['cidade'];
                                                ?>
                                            </td>
                                            <td><?=$pedido['codigoValidacao']?></td>
                                            <td><h4>R$&nbsp;<?php echo number_format($pedido['valorTotal'], 2, ',', '.'); ?></h4></td>
                                            <td><a href="verpedido.php?cod=<?=$pedido['codigoValidacao']?>" class="btn btn-danger"><i class="fa fa-plus"></i>Ver detalhes</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br/>


                    <div class="collapse" id="collapseFechados">

                        <table class="table table-hover">
                            <thead>
                            <th>Data do pedido</th>
                            <th>Endereço de entrega</th>
                            <th>Codigo do pedido</th>
                            <th>Valor total</th>
                            <th></th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($pedidos as $pedido) {
                                    if ($pedido['status'] == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y H:i', strtotime($pedido['dataPedido'])); ?></td>
                                            <td>
                                                <?php
                                                $endereco = $store->getEndereco($pedido['idEndereco']);
                                                echo $endereco['rua'] . ' ,' . $endereco['numero'] . ' - ' . $endereco['bairro'];
                                                echo '<br/>' . $endereco['cidade'];
                                                ?>
                                            </td>
                                            <td><?=$pedido['codigoValidacao']?></td>
                                            <td><h4>R$&nbsp;<?php echo number_format($pedido['valorTotal'], 2, ',', '.'); ?></h4></td>
                                            <td><a href="verpedido.php?cod=<?=$pedido['codigoValidacao']?>" class="btn btn-danger"><i class="fa fa-plus"></i>Ver detalhes</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function fechaCollapse(colapse){
            $(colapse).removeClass('in');
        }
    </script>



    <?php
include '../resources/componentes/footer.php';
}        