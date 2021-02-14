<?php

require SERVER_ROOT . 'admin/protected/model/pedidoModel.php';
require SERVER_ROOT . 'admin/protected/model/produtoModel.php';

class pedidocompra
{
    private $model;
    private $produtoModel;

    function __construct() {
        $this->model = new PedidoModel();
        $this->produtoModel = new ProdutoModel();
    }

    public function index() {
        $dados = $this->model->buscarTodos();
        require SERVER_ROOT . 'admin/protected/view/pedidocompra/listar.php';
    }

    public function novoPedido(){
        $action = "index.php?ctrl=pedidocompra&acao=inserir";
        require SERVER_ROOT . 'admin/protected/view/pedidocompra/form.php';
    }

    public function buscaProduto($id) {
        return $this->produtoModel->buscarItem($id);
    }

    public function inserir(){



    }
}