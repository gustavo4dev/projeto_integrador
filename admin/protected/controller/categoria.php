<?php

/**
 * Description of cidade
 *
 */
require SERVER_ROOT . 'admin/protected/model/categoriaModel.php';

class Categoria {

    private $model;

    function __construct() {
        $this->model = new CategoriaModel();
    }

    /**
     * função para listagem de registros do bd
     */
    public function index() {
        

        $dados = $this->model->buscarTodos();

        require SERVER_ROOT . 'admin/protected/view/categoria/listar.php';
    }

    /*
     * função que direciona para criação de novo registro
     */

    public function novo() {
        $action = "index.php?ctrl=categoria&acao=inserir";
        require SERVER_ROOT . 'admin/protected/view/categoria/form.php';
    }

    /**
     * função que envia novos registros para a model
     * para que seja feita a inclusão dos dados
     */
    public function inserir() {
        $nomeImagem = $this->uploadIcon($_FILES['imagem']);
        
        if($nomeImagem==NULL){
           echo '<script type="text/javascript">'
                   . 'history.back();'
                   . '</script>';
            return;
        }
        
        $_POST['imagem'] = $nomeImagem['nome'];
        
        $r = $this->model->inserir($_POST);
        if ($r) {
            $this->index();
        } else {
            $_SESSION['dialogMessage'] = 'Ocorreu um erro ao cadastrar os dados.<br/>'
                    . 'tente novamente ou contate o desenvolvedor.';
            include 'errorfunction.php';
            unlink($nomeImagem['caminho']);
        }
    }

    /**
     * função que exclui um registro do banco de dados baseado no id
     */
    public function excluir() {


        $r = $this->model->excluir($_GET['id']);
        if (!is_array($r)) {
            $this->index();
        } else {
            include_once 'pdoerror.php';
        }
    }

    /**
     * função que busca um registro pelo id
     *  para que seja feita a alteração dos dados
     */
    public function buscar() {
        $registro = $this->model->buscar($_GET['id']);
        $action = "index.php?ctrl=categoria&acao=atualizar&id=" . $_GET['id'];
        require SERVER_ROOT . 'admin/protected/view/categoria/form.php';
    }

    

    /**
     * Função que envia dados para a model para alteração de informações
     */
    public function atualizar() {
        
        $registro = $_POST;
        
        if(isset($_FILES['imagem']) && $_FILES['imagem']['name']!=NULL){
            $nomeImagem = $this->uploadIcon($_FILES['imagem']);
            if($nomeImagem==NULL){
                echo "Erro ao tentar fazer o upload da imagem";
                return;
            }
            $registro['imagem'] = $nomeImagem['nome'];
            
            //Caso conseguiu fazer o upload da imagem nova
            $categoria = $this->model->buscar($_GET['id']);
            //Removendo a imagem do servidor
            unlink(SERVER_ROOT.'site/public/img/icons/'.$categoria['imagem']);
        }
        
        $r = $this->model->atualizar($registro);
        if ($r)
            $this->index();
        else
            echo "Erro ao atualizar o registro!";
    }
    
    public function uploadIcon($imagem) {
        $diretorio = SERVER_ROOT . "site/public/img/icons/";
        //--Obter a extensao do arquivo
        $ext  = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        //--gerando um nome aleatorio para a imagem
        $nome = md5(uniqid(time())) . "." . $ext;
        //--arquivo
        $arquivo = $diretorio . $nome;
        //echo $arquivo; exit;
        //avalia se o arquivo esta ok
        if(getimagesize($imagem['tmp_name']) == false){
            echo '<script type="text/javascript">'
            . 'alert("Arquivo de imagem inválido.");'
            . '</script>';
            return NULL;
        }
        if($imagem['size'] > 5000000 ){
            echo "Imagem excede o tamanho máximo";
            return NULL;
        }
        if($ext!="jpg" && $ext!="jpeg" && $ext!="png"
                && $ext!="gif"){
            echo '<script type="text/javascript">
                        alert("Formato inválido, os formatos aceitos são:
                        jpg, jpeg, png e gif");
                  </script> ';
            return NULL;
        }
        if(move_uploaded_file($imagem['tmp_name'], $arquivo)){
            return array('nome'=>$nome,'caminho'=>$arquivo);
        }else{
            return NULL;
        }
}

}
