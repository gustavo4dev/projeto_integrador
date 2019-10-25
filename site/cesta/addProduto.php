<?php

session_start();

require_once '../controller/storeController.php';

$store = new storeController();

$produto = $_POST;
$cesta = $_SESSION['cesta']['item'];
$existe = 0;
foreach ($cesta as $key => $item) {
    if (isset($item['idProduto']) && $item['idProduto'] === $produto['idProduto']) {
        $_SESSION['cesta']['item'][$key]['quantidade'] += $produto['quantidade'];
        $existe = 1;
    }
}
if ($existe === 1) {
    header("Location: cesta.php");
} else {
    $store->addProduto($_POST);
    header("Location: cesta.php");
}