<?php

require '../model/destaquesModel.php';
require '../model/produtoModel.php';

class Destaques {

    private $model;
    private $produtoModel;

    function __construct() {
        $this->model = new DestaquesModel();
        $this->produtoModel = new ProdutoModel();
    }

    public function index() {
        $produtos = $this->produtoModel->buscarTodos();
        $destaques = $this->model->buscarTodos();
        require SERVER_ROOT . 'admin/protected/view/destaques/listaDestaques.php';
    }

    public function inserir() {
        if (count($_POST) <= 0) {
            $registros = null;
        } else {
            $registros = $_POST['destaques'];
        }
        $r = $this->model->inserir($registros);

        if ($r) {
            $this->index();
        } else {
            echo '<script>window.alert("Erro ao cadastrar!\nTente novamente.");'
            . 'window.location.href="index.php?ctrl=destaques";</script>';
        }
    }

}
