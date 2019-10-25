<?php
session_start();

require_once '../controller/storeController.php';
$store = new storeController();

if(isset($_POST)){
    $store->addEndereco($_POST, $_SESSION['user']['email']);
    header("Location: checkout.php");
}

