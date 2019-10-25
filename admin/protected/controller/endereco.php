<?php

/**
 * Description of cidade
 *
 */
require SERVER_ROOT.'admin/protected/model/enderecoModel.php';

class Endereco {

    private $model;

    function __construct() {
        $this->model = new EnderecoModel();
    }

    public function index() {
        $dados = $this->model->buscarTodos();
        require SERVER_ROOT.'admin/protected/view/endereco/listar.php';
    }

    public function novo() {
        $action = "index.php?ctrl=endereco&acao=inserir";
        require SERVER_ROOT.'admin/protected/view/endereco/form.php';
    }

    public function inserir() {
        $r = $this->model->inserir($_POST);
        if ($r) {
            $this->index();
        } else {
            echo "Erro ao cadastrar os dados";
        }
    }

    public function excluir() {
        $r = $this->model->excluir($_GET['id']);
        if ($r) {
            $this->index();
        } else {
            echo "Erro ao remover os dados";
        }
    }

    public function buscar() {
        $registro = $this->model->buscar($_GET['id']);
        $action = "index.php?ctrl=endereco&acao=atualizar&id=".$_GET['id'];
        require SERVER_ROOT.'admin/protected/view/endereco/form.php';
    }

    public function atualizar() {
        
        $r = $this->model->atualizar($_POST);
        
        if ($r) $this->index();
        else echo "Erro ao atualizar o registro!";
    }

}
