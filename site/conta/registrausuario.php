<?php
include_once '../resources/componentes/header-nav.php';

require_once '../controller/storeController.php';
$store = new storeController();

if(isset($_POST) && count($_POST) > 0){
    if($store->registraCliente($_POST)){
        echo 'sucesso';
    }
}else{
    echo 'fracasso';
}

