<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require SERVER_ROOT . 'admin/protected/model/pedidoModel.php';
require SERVER_ROOT . 'admin/protected/model/clienteModel.php';
require SERVER_ROOT . 'admin/protected/model/enderecoModel.php';
require SERVER_ROOT . 'admin/protected/model/combinacaoModel.php';
require SERVER_ROOT . 'admin/protected/model/produtoModel.php';

class Pedido {

    private $model;
    private $clienteModel;
    private $enderecoModel;
    private $conbinacaoModel;
    private $produtoModel;

    function __construct() {
        $this->model = new PedidoModel();
        $this->clienteModel = new ClienteModel();
        $this->enderecoModel = new EnderecoModel();
        $this->conbinacaoModel = new CombinacaoModel();
        $this->produtoModel = new ProdutoModel();
    }

    public function index() {
        $dados = $this->model->buscarTodos();
        require SERVER_ROOT . 'admin/protected/view/pedido/listar.php';
    }

    public function validar() {
        $action = "index.php?ctrl=pedido&acao=validaPedido";
        require SERVER_ROOT . 'admin/protected/view/pedido/formPedido.php';
    }

    public function validaPedido() {
        if (isset($_POST['cod'])) {
            $registro = $this->model->buscarcod($_POST['cod']);
            $cliente = $this->clienteModel->buscar($registro['idCliente']);
            $registro['endereco'] = $this->enderecoModel->buscar($registro['idEndereco']);
            $registro['cliente'] = $cliente['nome'];
            $itens = $this->model->getItensPedido($registro['idPedido']);
            if (count($registro) > 1) {
                require SERVER_ROOT . 'admin/protected/view/pedido/detalhePedido.php';
            } else {
                echo '<script type="text/javascript">'
                . 'window.alert("Pedido nao encontrado! \n Verifique o codigo digitado.");'
                . 'window.location.href="index.php?ctrl=pedido&acao=validar";'
                . '</script>';
            }
        } else if (isset($_POST['id'])) {
            $this->model->fecharPedido($_POST['id']);
            echo '<script>window.location.href="index.php?ctrl=pedido&acao=validar";</script>';
        }
    }

    public function buscaNomeCombinacao($id) {
        return $this->conbinacaoModel->buscarNomes($id);
    }

    public function buscaProduto($id) {
        return $this->produtoModel->buscarItem($id);
    }

}
