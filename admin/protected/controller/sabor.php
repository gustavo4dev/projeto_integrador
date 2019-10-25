<?php

/**
 * Description of saborPizza
 *
 */
require SERVER_ROOT . 'admin/protected/model/saborModel.php';
require SERVER_ROOT . 'admin/protected/controller/produto.php';

class Sabor {

    private $model;
    var $produto;

    function __construct() {
        $this->model = new SaborModel();
        $this->produto = new Produto();
    }

    public function index() {
        //busca dados no banco
        $dados = $this->model->buscarTodos();
        require SERVER_ROOT . 'admin/protected/view/sabor/listar.php';
    }

    public function novo() {
        $action = "index.php?ctrl=sabor&acao=inserir";
        require SERVER_ROOT . 'admin/protected/view/sabor/form.php';
    }

    public function inserir() {
        $nomeImagem = $this->produto->uploadImagem($_FILES['imagem']);

        if ($nomeImagem == NULL) {
            echo '<script type="text/javascript">'
            . 'history.back();'
            . '</script>';
            return;
        }

        $_POST['imagem'] = $nomeImagem['nome'];
        $r = $this->model->inserir($_POST);
        if ($r) {
            $this->index();
        } else if(is_array($r)) {
            
            include_once 'pdoerror.php';
            unlink($nomeImagem['caminho']);
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
        $action = "index.php?ctrl=sabor&acao=atualizar&id=" . $_GET['id'];
        require SERVER_ROOT . 'admin/protected/view/sabor/form.php';
    }

    /**
     * função que busca um registro pelo termo pesquisado
     */


    public function atualizar() {
        $registro = $_POST;
        if(isset($_FILES['imagem']) && $_FILES['imagem']['name']!=NULL){
            $nomeImagem = $this->produto->uploadImagem($_FILES['imagem']);
            if($nomeImagem==NULL){
                echo "Erro ao tentar fazer o upload da imagem";
                return;
            }
            $registro['imagem'] = $nomeImagem['nome'];
            
            //Caso conseguiu fazer o upload da imagem nova
            $sabor = $this->model->buscar($_GET['id']);
            //Removendo a imagem do servidor
            unlink(SERVER_ROOT.'site/public/img/'.$sabor['imagem']);
        }
        
        $r = $this->model->atualizar($registro);
        if ($r)
            $this->index();
        else
            echo "Erro ao atualizar o registro!";
    }

}
