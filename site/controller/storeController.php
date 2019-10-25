<?php

require $_SERVER['DOCUMENT_ROOT'] . '/pintegrador/admin/protected/libs/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/pintegrador/admin/protected/libs/conexao.php';

require_once SERVER_ROOT . 'admin/protected/model/clienteModel.php';
require_once SERVER_ROOT . 'admin/protected/model/enderecoModel.php';
require_once SERVER_ROOT . 'admin/protected/model/produtoModel.php';
require_once SERVER_ROOT . 'admin/protected/model/categoriaModel.php';
require_once SERVER_ROOT . 'admin/protected/model/saborModel.php';
require_once SERVER_ROOT . 'admin/protected/model/tipoPizzaModel.php';
require_once SERVER_ROOT . 'admin/protected/model/combinacaoModel.php';
require_once SERVER_ROOT . 'admin/protected/model/pedidoModel.php';
require_once SERVER_ROOT . 'admin/protected/model/destaquesModel.php';

class storeController {

    //variáveis model
    private $clienteModel;
    private $enderecoModel;
    private $produtoModel;
    private $categoriaModel;
    private $saborModel;
    private $tipoPizzaModel;
    private $combinacaoModel;
    private $pedidoModel;
    private $destaquesModel;

    function __construct() {
        $this->clienteModel = new clienteModel();
        $this->enderecoModel = new EnderecoModel();
        $this->produtoModel = new ProdutoModel();
        $this->categoriaModel = new CategoriaModel();
        $this->saborModel = new SaborModel();
        $this->tipoPizzaModel = new TipoPizzaModel();
        $this->combinacaoModel = new CombinacaoModel();
        $this->pedidoModel = new PedidoModel();
        $this->destaquesModel = new DestaquesModel();
    }

    //funções do cliente
    public function clienteConta($email) {
        return $this->clienteModel->conta($email);
    }
    //função que retorna o email do cliente pelo id
    public function getCliente($id) {
        return $this->clienteModel->buscar($id);
    }

    public function clientePedidos() {
        return $this->clienteModel->meusPedidos($_SESSION['user']['email']);
    }

    public function buscaEndereco($email) {
        return $this->clienteModel->buscaEndereco($email);
    }

    public function addEndereco($endereco, $email) {
        return $this->clienteModel->addEndereco($endereco, $email);
    }

    public function getEndereco($idendereco) {
        return $this->enderecoModel->buscar($idendereco);
    }

    //login com formulario do site
    public function clienteLogin($dados) {
        $result = $this->clienteModel->clienteLogin($dados);
        if (is_string($result)) {
            $_SESSION['modal_message'] = $result;
            $_SESSION['modal_redirect'] = '';
            return $result;
        } else if (is_array($result)) {
            return $result;
        }
    }

    //insere dados do cliente no banco de dados no primeiro registro
    public function registraCliente($cliente) {
        if (isset($cliente['loginExt'])) {

            return $this->clienteModel->inserirGoogleLogin($cliente);
        } else {

            return $this->clienteModel->inserirsite($cliente);
        }
    }

    //altera dados do cliente no form altera dados
    public function atualizaCliente($cliente) {
        if ($this->clienteModel->atualizarDados($cliente)) {
            $_SESSION['user']['email'] = $cliente['email'];
            return true;
        } else {
            return false;
        }
    }

    //login com Botao do google
    public function clienteLoginExt($dados) {
        $result = $this->clienteModel->clienteLoginExt($dados);
        if (is_string($result)) {
            $_SESSION['modal_message'] = $result;
            $_SESSION['modal_redirect'] = 'login.php';
            return $result;
        } else if (is_array($result)) {
            return $result;
        } else if (is_bool($result) && $result === false) {
            return false;
        }
    }

    public function esqueciSenha($email) {
        $user = $this->clienteModel->esqueciSenha($email);
        if (isset($user['idCliente']) && isset($user['loginExt'])) {
            if ($user['loginExt'] == true) {
                $_SESSION['modal_message'] = "Você usou sua conta do Google para se registrar.\n"
                        . "Por favor use o botão do google para fazer login.";
                $_SESSION['modal_redirect'] = "login.php";
            } else {
                $novaSenha = $this->geraCodigoPedido(8);
                $setSenha = $this->clienteModel->setNovaSenha($user['idCliente'], $novaSenha);
                if ($setSenha) {
                    $corpo = "Ola, tudo bem?\n"
                . "Voce solicitou uma nova senha em nosso site.\n"
                . "Por favos utilize esta senha para fazer login\n"
                . "$novaSenha";
                    $assunto = 'Nova senha';
                    $this->sendEmail($email, $assunto, $corpo);
                    $_SESSION['modal_message'] = "Uma nova senha foi enviada para o seu email ;).";
                    $_SESSION['modal_redirect'] = "login.php";
                }
            }
        } else {
            $_SESSION['modal_message'] = "Este email nao consta em nossos registros.\nVerifique e tente novamente :(.";
            $_SESSION['modal_redirect'] = "";
        }
    }

    //funcao que faz a troca da senha quando esqueci senha e do formulario de senha
    public function setSenhaForm($dados) {
        if (isset($dados['usuario'])) {
            $registro = array('email' => $dados['usuario'], 'senhaAntiga' => $dados['senhaAntiga'], 'senhaNova' => $dados['senhaNova']);
            $r = $this->clienteModel->atualizarsenha($registro);
            print_r($r);
            if (is_bool($r)) {
                $_SESSION['modal_message'] = "Senha alterada com sucesso. Por favor faça login novamente";
                $_SESSION['modal_redirect'] = "login.php";
                unset($_SESSION['user']);
                return true;
            }
            if (is_string($r)) {
                $_SESSION['modal_message'] = $r;
                $_SESSION['modal_redirect'] = "editaSenha.php";
                return false;
            }
        } else {
            $r = $this->clienteModel->modificaSenha($dados["email"], $dados['senhaNova']);
            if ($r) {
                $_SESSION['modal_message'] = 'Senha alterada com sucesso!';
                $_SESSION['modal_redirect'] = 'login.php';
                return true;
            }
        }
    }

    //envia email com nova senha
    public function sendEmail($email, $assunto, $corpo) {

        $dados = array('email' => $email, 'mensagem' => $corpo, 'assunto'=>$assunto);

        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, 'http://usuarios.upf.br/~141859/sentMail.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);

        curl_exec($ch);

        //$resposta = http_post_fields('http://usuarios.upf.br/~141859/sentMail.php', $dados);
        /* echo '
          <script src="../resources/js/jquery-2.2.3.min.js"></script>
          <script>
          $.ajax({
          type: "POST",
          url: "http://usuarios.upf.br/~141859/sentMail.php",
          data: "email=' . $email . '&mensagem=' . $corpo . '";
          success: function(data, textStatus, jqXHR) {

          }
          });</script>
          '; */
    }

    //funções de categoria
    /**
     * retorna lista de categorias
     */
    public function listaCategorias() {
        return $this->categoriaModel->buscarTodos();
    }

    public function categoriaPorId($id) {
        return $this->categoriaModel->buscar($id);
    }

    /**
     * funções para produtos em destaque
     */
    //busca de destaques
    public function listaDestaques() {
        return $this->destaquesModel->buscarProdutos();
    }

    /**
     * funções de produto
     */
    //busca de produtos para o carousel na pagina inicial
    public function produtosCarousel() {
        return $this->produtoModel->buscaCarrousel();
    }

    //busca de produtos por categoria
    public function buscaPorCategoria($id) {
        return $this->produtoModel->buscaPorCategoria($id);
    }

    //busca produto pelo id passado
    public function buscaProduto($id) {
        return $this->produtoModel->buscarItem($id);
    }

    /**
     * funções de pizzas
     */
    public function buscarPizzas() {
        return $this->saborModel->buscarTodos();
    }

    public function buscarSabor($id) {
        return $this->saborModel->buscar($id);
    }

    public function buscarTipoPizza() {
        return $this->tipoPizzaModel->buscarTodos();
    }

    public function reajusteTipoPizza($id) {
        return $this->tipoPizzaModel->buscarReajuste($id);
    }

    //inserir combinação de pizza no bd
    public function buscaCombinacao() {
        unset($_POST['quantidade']);
        if (isset($_POST['sabor']) && isset($_POST['tipopizza']) && count($_POST['sabor']) > 0) {
            $pizza['idTipoPizza'] = $_POST['tipopizza'];
            if (isset($_POST['sabor'][0])) {
                $pizza['idSabor1'] = $_POST['sabor'][0];
            }
            if (isset($_POST['sabor'][1])) {
                $pizza['idSabor2'] = $_POST['sabor'][1];
            }
            if (isset($_POST['sabor'][2])) {
                $pizza['idSabor3'] = $_POST['sabor'][2];
            }
            //print_r($pizza);exit;
            return $this->combinacaoModel->buscarCombinacao($pizza);
        }
    }

    //retorna or nomes dos sabores para a cesta de compras
    public function buscaNomeCombinacao($id) {
        return $this->combinacaoModel->buscarNomes($id);
    }

    /**
     * Cesta de compras
     */
    //adiciona pizza na cesta
    public function addPizza($pizza) {

        if (isset($_SESSION['cesta']) && isset($_SESSION['cesta']['item'])) {
            array_push($_SESSION['cesta']['item'], $pizza);
        } else {
            $_SESSION['cesta']['item'] = array();
            array_push($_SESSION['cesta']['item'], $pizza);
        }
        return true;
    }

    //adiciona um produto na cesta
    public function addProduto($produto) {

        if (isset($_SESSION['cesta']) && isset($_SESSION['cesta']['item'])) {
            array_push($_SESSION['cesta']['item'], $produto);
        } else {
            $_SESSION['cesta']['item'] = array();
            array_push($_SESSION['cesta']['item'], $produto);
        }
        return true;
    }

    /**
     * Finalizar pedido
     */
    //função para finalizar o pedido
    public function checkout($pedido, $itens) {
        return $this->pedidoModel->inserirPedido($pedido, $itens);
    }

    public function getPedido($cod) {
        return $this->pedidoModel->buscarcod($cod);
    }

    public function getItensPedido($idpedido) {
        return $this->pedidoModel->getItensPedido($idpedido);
    }

    //gera codigo aleatorio para o pedido
    public function geraCodigoPedido($tamanho) {
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmai . $num;
        $len = strlen($caracteres);

        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

}
