<?php

/**
 * Description of cidade
 *
 */
require SERVER_ROOT.'admin/protected/model/adminModel.php';

class Admin {

    private $model;

    function __construct() {
        $this->model = new AdminModel();
    }

    public function loginAdmin($param) {
        $r = $this->model->buscarLogin($param);


        if (empty($r)) {
            echo '<script type="text/javascript">'
            . 'alert("Usuario ou senha nao encontrados!");'
            . 'windows.location.href="login.php";'
            . '</script>';
        } else {
            return $r;
        }
    }
}
