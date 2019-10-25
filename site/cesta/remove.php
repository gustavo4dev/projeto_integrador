<?php
session_start();
if(isset($_GET['id'])){
    $itens = $_SESSION['cesta']['item'];
    
    unset($itens[$_GET['id']]);
    
    $_SESSION['cesta']['item'] = $itens;
}
header("Location: cesta.php");

