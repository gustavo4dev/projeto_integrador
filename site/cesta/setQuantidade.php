<?php
session_start();
$pos = $_POST['pos'];
$quant = $_POST['quantidade'];
$_SESSION['cesta']['item'][$pos]['quantidade'] = $quant;

$unit = $_SESSION['cesta']['item'][$pos]['valorUnitarioItem']*$quant;
$cesta = $_SESSION['cesta']['item'];

$valorTotal = 0;
foreach ($cesta as $item) {
    $valorTotal += $item['valorUnitarioItem']*$item['quantidade'];
}

$ret = array("totalItem"=>$unit, "totalCesta"=>$valorTotal );
echo json_encode($ret);

