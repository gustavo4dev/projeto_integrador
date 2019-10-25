<?php

session_start();
require_once '../controller/storeController.php';
$store = new storeController();

$itemPizza = $_POST;
//print_r($_POST);
//print_r($itemPizza);exit;

$pizza = $store->buscaCombinacao($itemPizza);
//print_r($pizza);exit;
$itemCesta = 0;

if ($pizza !== null) {
    if (isset($_SESSION['cesta']['item'])) {
        $cesta = $_SESSION['cesta']['item'];

        foreach ($cesta as $key => $item) {
            if (isset($item['idCombinacao']) && $item['idCombinacao'] === $pizza['idCombinacao']) {
                
                $_SESSION['cesta']['item'][$key]['quantidade'] = $_SESSION['cesta']['item'][$key]['quantidade']+$itemPizza['quantidade'];
                $itemCesta = 1;
            }
        }
        if($itemCesta === 0){
            reajuste($itemPizza);
        }else{
            header("Location: cesta.php");
        }
    } else {
        reajuste($itemPizza);
    }
}else{

reajuste($itemPizza);
}


function reajuste($item) {
    $store = new storeController();
    $reajuste = $store->reajusteTipoPizza($item['tipopizza']);
    $valreajuste = '1.0' . ($reajuste['reajuste']);

    $valorFinal = 0;

    foreach ($item['sabor'] as $sabor) {
        $r = $store->buscarSabor($sabor);
        $valorUnit = (float) $r['valor'];
        $calcreajuste = (float) $valreajuste;

        $valorReajuste = $valorUnit * $calcreajuste;
        if ($valorReajuste > $valorFinal) {
            $valorFinal = $valorReajuste;
        }
    }

//$pizza = $store->buscaCombinacao($item);


    $pizza = $store->buscaCombinacao($item);

    $pizza['quantidade'] = $item['quantidade'];
    $pizza['valorUnitarioItem'] = $valorFinal;


    $store->addPizza($pizza);


    header("Location: cesta.php");
}
