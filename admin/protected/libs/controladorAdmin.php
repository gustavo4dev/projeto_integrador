<?php

/**
 * Description of controlador
 *
 */
class AplicacaoAdmin {

    function __construct() {

        if (isset($_GET['ctrl'])) {

            $ctrNome = $_GET['ctrl'];

            if (!isset($_GET['acao']))
                $acao = 'index';
            else
                $acao = $_GET['acao'];

            $arq = '../controller/' . $ctrNome . '.php';

            if (file_exists($arq)) {
                require $arq;

                $controlador = new $ctrNome();
                if (method_exists($controlador, $acao)) {
                    $controlador->$acao();
                } else {
                    $controlador->index();
                }
            } else {
                $_SESSION['dialogMessage'] = "Controlador nao encontrado! <br/>"
                        . "Você será redirecionado para a home.";
                $_SESSION['dialogRedirect'] = "index.php";
                include_once '../resources/componentes/dialog.php';
            }
        } else {
            echo '<h1>Bem vindo!</h1>';
        }
    }

}
