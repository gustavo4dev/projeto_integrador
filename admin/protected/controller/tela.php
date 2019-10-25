<?php


require SERVER_ROOT . 'admin/protected/model/pedidoModel.php';
require SERVER_ROOT . 'admin/protected/model/combinacaoModel.php';
require SERVER_ROOT . 'admin/protected/model/produtoModel.php';

class Tela {

    private $model;
    private $combinacaoModel;
    private $produtoModel;

    function __construct() {
        $this->model = new PedidoModel();
        $this->combinacaoModel = new CombinacaoModel();
        $this->produtoModel = new ProdutoModel();
    }

    public function getPedidos() {
        return $this->model->buscarTodos();
    }

    public function getItensPedido($id) {
        return $this->model->getItensPedido($id);
    }

    public function buscaCombinacao($id) {
        return $this->combinacaoModel->buscarNomes($id);
    }
    
    public function buscaProduto($id) {
        return $this->produtoModel->buscarItem($id);
    }

}
