<?php
if(isset($_SESSION['usuario']) && $_SESSION['usuario']['admin'] == true){
    header('Location: ../administrador/');
}else if(isset($_SESSION['usuario']) && $_SESSION['usuario']['user'] == true){
    header('Location: ../user/');
}else{
    header('Location: ../');
}