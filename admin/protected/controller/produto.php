<?php

/**
 * Description of categoria
 *
 */
require SERVER_ROOT.'admin/protected/model/produtoModel.php';
require SERVER_ROOT.'admin/protected/model/categoriaModel.php';
require SERVER_ROOT.'admin/protected/model/clienteModel.php';





class Produto {

//------------------------------------------------------------------------------//    

    // Funções referentes à área administrativa

//-----------------------------------------------------------------------------//

    private $model;

    function __construct() {
        $this->model = new ProdutoModel();
        $this->modelCategoria = new CategoriaModel();
    }

    public function index() {
        
        
        $dados = $this->model->buscarTodos();
       require SERVER_ROOT.'admin/protected/view/produto/listar.php';
    }

    public function novo() {
        $action = "index.php?ctrl=produto&acao=inserir";
        $categorias = $this->modelCategoria->buscarTodos(null, null, null, null);
        require SERVER_ROOT.'admin/protected/view/produto/form.php';
    }

    public function inserir() { 
        $nomeImagem = $this->uploadImagem($_FILES['imagem']);
        
        if($nomeImagem==NULL){
           echo '<script type="text/javascript">'
                   . 'history.back();'
                   . '</script>';
            return;
        }
        
        $_POST['imagem'] = $nomeImagem['nome'];
        $r = $this->model->inserir($_POST);
        if($r){
            $this->index();
        }else{
            $_SESSION['dialogMessage'] = 'Ocorreu um erro ao cadastrar os dados.<br/>'
                    . 'tente novamente ou contate o desenvolvedor.';
            include 'errorfunction.php';
            unlink($nomeImagem['caminho']);
        }
    }

    public function excluir() {
        $r = $this->model->excluir($_GET['id']);
        if (!is_array($r)) {
            $this->index();
        } else {
            include_once 'pdoerror.php';
        }
    }

    public function buscar() {
        $registro = $this->model->buscar($_GET['id']);
        $categorias = $this->modelCategoria->buscarTodos(null, null, null, null);
        $action = "index.php?ctrl=produto&acao=atualizar&id=".$_GET['id'];
        require SERVER_ROOT.'admin/protected/view/produto/form.php';
    }


    public function atualizar() {
        $registro = $_POST;
        
        if(isset($_FILES['imagem']) && $_FILES['imagem']['name']!=NULL){
            $nomeImagem = $this->uploadImagem($_FILES['imagem']);
            if($nomeImagem==NULL){
                echo "Erro ao tentar fazer o upload da imagem";
                return;
            }
            $registro['imagem'] = $nomeImagem['nome'];
            
            //Caso conseguiu fazer o upload da imagem nova
            $produto = $this->model->buscar($_GET['id']);
            //Removendo a imagem do servidor
            unlink(SERVER_ROOT.'site/public/img/'.$produto['imagem']);
        }
        
        $r = $this->model->atualizar($registro);
        
        if ($r) $this->index();
        else "Erro ao atualizar o registro!";
    }
    
    public function uploadImagem($imagem){
        $diretorio = SERVER_ROOT . "site/public/img/";
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


//----------------------------------------------------------------------------------------//

    //Funções referentes ao site, a área do usuário

//----------------------------------------------------------------------------------------//

    

    

    

    public function buscaritem() {
        $dados = $this->model->buscarItem($_GET['id']);
        $relacionados = $this->model->buscarTodosLoja();
        require './passagem/item.php';
    }
    
    public function buscadestino() {
        $itens = $this->model->buscaDestino($_GET['id']);
        require './passagem/destinos.php';
    }
    
    
    


    public function adicionarcarrinho() {

        if ($_SESSION['user-logado']) {
            if (!isset($_SESSION['user-carrinho'])) {
                $_SESSION['user-carrinho'] = array();
            }

            $flag = 0;
            if (count($_SESSION['user-carrinho']) > 0) {
                for ($i = 0; $i < count($_SESSION['user-carrinho']); $i++) {
                    if ($_SESSION['user-carrinho']{$i}['idPassagem'] == $_POST['idPassagem']) {

                        $_SESSION['user-carrinho']{$i}['quantidade'] += $_POST['quantidade'];
                        $_SESSION['user-carrinho']{$i}['totalitem'] = $_SESSION['user-carrinho']{$i}['preco'] * $_SESSION['user-carrinho']{$i}['quantidade'];
                        $flag = 1;
                    } else {
                        if ($flag == 1) {
                            break;
                        } else {
                            $flag = 0;
                        }
                    }
                }
                if ($flag == 0) {
                    $_POST['totalitem'] = $_POST['preco'] * $_POST['quantidade'];
                    array_push($_SESSION['user-carrinho'], $_POST);
                }
            } else {
                $_POST['totalitem'] = $_POST['preco'] * $_POST['quantidade'];
                array_push($_SESSION['user-carrinho'], $_POST);
            }
            $this->vercarrinho();
        } else {
            echo '<script type="text/javascript">'
            . 'alert("Você precisa estar logado para realizar esta ação.\n Por favor faça o login.");'
            . 'window.location.href = "login.php";'
            . '</script>';
        }
    }

    public function vercarrinho() {
        if ($_SESSION['user-logado']) {
            if (isset($_SESSION['user-carrinho']) && count($_SESSION['user-carrinho']) > 0) {
                $itens = $_SESSION['user-carrinho'];
                $chave = array_keys($_SESSION['user-carrinho']);
                require './passagem/carrinho.php';
            } else {
                $itens = null;
                require './passagem/carrinho.php';
            }
        } else {
            echo '<script type="text/javascript">'
            . 'alert("Você precisa estar logado para realizar esta ação.\n Por favor faça o login.");'
            . 'window.location.href = "login.php";'
            . '</script>';
        }
    }

    public function removeitem() {
        unset($_SESSION['user-carrinho'][$_GET['id']]);
        $this->vercarrinho();
    }

    public function finalizacompra() {
        $flag = 0;
        $produtos = $_SESSION['user-carrinho'];
        foreach ($produtos as $val) {
            $r = $this->model->consultaquantidade($val['idPassagem'], $val['quantidade']);
            if ($r && $flag != 1) {
                $flag = 0;
            } else {
                $flag = 1;
            }
        }

        if ($flag == 0) {
            $_SESSION['compra-cod'] = $_POST['cod'];

            $c = $this->modelCompra->inserir($_POST);
            if ($c) {
                $compra = $this->modelCompra->buscarcod($_SESSION['compra-cod']);
                $itens = $_SESSION['user-carrinho'];
                $i = 0;
                foreach ($itens as $item) {

                    $compraitem = array(
                        'idUsuario' => $_SESSION['user-logado'],
                        'idCompra' => $compra['idCompra'],
                        'idPassagem' => $item['idPassagem'],
                        'quantidade' => $item['quantidade'],
                        'valorTotalItem' => $item['totalitem']
                    );
                    $this->model->alteraQuantidade($item['idPassagem'], $item['quantidade']);
                    $this->modelCompraItem->inserir($compraitem);
                }
                echo '<script type="text/javascript">'
                . 'alert("Compra registrada com sucesso!");'
                . 'window.location.href = "index.php?ctrl=passagemloja&acao=verpedidos";'
                . '</script>';
                unset($_SESSION['user-carrinho']);
                $this->index();
            }
        } else {
            echo '<script type="text/javascript">'
            . 'alert("Um ou mais itens não tem quantidade suficiente.\nConsulte a página do item para ver mais detalhes.");'
            . 'window.location.href = "index.php?ctrl=passagemloja&acao=vercarrinho";'
            . '</script>';
        }
    }

    public function verpedidos() {
        if ($_SESSION['user-logado']) {
            $itens = $this->modelCompra->buscarporusuario($_SESSION['user-logado']);
            require './usuario/meusPedidos.php';
        } else {
            echo '<script type="text/javascript">'
            . 'alert("Você precisa estar logado para realizar esta ação.\n Por favor faça o login.");'
            . 'window.location.href = "login.php";'
            . '</script>';
        }
    }


}
