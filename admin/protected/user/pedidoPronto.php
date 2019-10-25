<?php

require '../../../site/controller/storeController.php';
$store = new storeController();

if(isset($_POST['id'])){
    //echo '<script>alert('.$_POST['id'].');</script>';
    $cliente = $store->getCliente($_POST['id']);
    
    $assunto = "Pedido pronto";
    
    $corpo = "Seu pedido foi finalizado e esta pronto para ser entregue ;).\n\nCodigo pedido: ".$_POST['pedido'];
    
    $store->sendEmail($cliente['email'], $assunto, $corpo);
    
}

