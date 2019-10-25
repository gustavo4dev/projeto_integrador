<?php
session_start();

if (isset($_SESSION['user']) && $_SESSION['user']['logado'] === true){
    header("Location: minhaconta.php");
}else{
    header("Location: login.php");
}


?>
