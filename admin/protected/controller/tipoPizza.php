<?php

/**
 * Description of tipoPizza
 *
 */
require SERVER_ROOT . 'admin/protected/model/tipoPizzaModel.php';

class TipoPizza {

    private $model;

    function __construct() {
        $this->model = new TipoPizzaModel();
    }

    public function index() {
        $dados = $this->model->buscarTodos();
        require SERVER_ROOT . 'admin/protected/view/tipopizza/listar.php';
    }

    public function novo() {
        $action = "index.php?ctrl=tipopizza&acao=inserir";
        require SERVER_ROOT . 'admin/protected/view/tipopizza/form.php';
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
        $action = "index.php?ctrl=tipopizza&acao=atualizar&id=" . $_GET['id'];
        require SERVER_ROOT . 'admin/protected/view/tipopizza/form.php';
    }

    public function atualizar() {
        $r = $this->model->atualizar($_POST);

        if ($r)
            $this->index();
        else
            echo "Erro ao atualizar o registro!";
    }

}
