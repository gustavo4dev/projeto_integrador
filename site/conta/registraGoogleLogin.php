<?php

include_once '../resources/componentes/header-nav.php';
require_once '../controller/storeController.php';
$store = new storeController();

$user = $_POST;
$resposta = $store->clienteLoginExt($user);

if (is_string($resposta)) {
    include '../resources/componentes/dialog.php';
}
if (is_array($resposta) && $resposta['loginExt'] == true) {
    $_SESSION['user']['logado'] = true;
    $_SESSION['user']['nome'] = $resposta['nome'];
    $_SESSION['user']['email'] = $resposta['email'];
    if (isset($_SESSION['checkout']) && $_SESSION['checkout'] == true) {
        echo '<script>
        $(document).ready(function () {
            window.location.href = "../cesta/checkout.php";
        });
    </script>';
    } else {
        echo '<script>
        $(document).ready(function () {
            window.location.href = "../index.php";
        });
    </script>';
    }
}
if (is_bool($resposta) && $resposta == false) {

    echo '<script>
        $(document).ready(function () {
            $.redirect("criarconta.php", {"email":"' . $user['email'] . '" , "nome":"' . $user['nome'] . '","loginExt": true}, "POST");
        });
    </script>';
}


