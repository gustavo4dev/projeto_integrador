<?php

/**
 * Description of controlador
 *
 */
class AplicacaoUser {

    function __construct() {

        if (isset($_GET['ctrl'])) {

            $ctrNome = "pedido";

            if (!isset($_GET['acao']))
                $acao = 'validar';
            else
                $acao = $_GET['acao'];

            $arq = '../controller/pedido.php';

            if (file_exists($arq)) {
                require $arq;

                $controlador = new $ctrNome();
                
                if(!method_exists($controlador, $acao)){
                    $controlador->validar();
                }else{
                    $controlador->$acao();
                }
            } else {
                echo "Erro, controlador nao encontrado...";
                exit();
            }
        } else {
            ?>
            <h1>Bem vindo à área de usuário!</h1>
            <h4>Esta sessão permite somente o fechamento de pedidos!</h4>

            
            <?php
        }
    }

}
