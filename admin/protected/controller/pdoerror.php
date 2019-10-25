<?php

switch ($r[0]) {
    case 23000:
        //excluir registro com relação no banco
        $_SESSION['dialogMessage'] = "Não é possivel excluir! <br/>"
                . "Há um registro relacionado com este no banco de dados.";
        echo '<script type="text/javascript">'
        . ' window.onload = function(){ '
        . 'dialog.showModal();'
        . 'dialog.querySelector(\'button:not([disabled])\').addEventListener(\'click\', function () {
                        dialog.close();
                    });'
        . '}'
        . ' </script>';
        $this->index();
        break;
    case 0 :
        
        break;
    default:
        break;
}

