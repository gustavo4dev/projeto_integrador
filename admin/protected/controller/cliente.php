<?php

require './protected/model/clienteModel.php';
require './protected/model/enderecoModel.php';

class ClienteLoja {

    private $model;
    private $modelEndereco;

    function __construct() {
        $this->model = new ClienteModel();
        $this->modelEndereco = new EnderecoModel();
    }

    public function novo() {
        $action = "index.php?ctrl=cliente&acao=inserir";
        require './view/cliente/form.php';
    }

    public function inserir() {
        $conta = $this->model->conta($_POST['email']);
        $cpf = $this->model->buscarcpf($_POST['cpf']);
        if (!isset($conta['email']) && !isset($cpf['cpf'])) {
            if (!$this->validarCPF($_POST['cpf'])) {
                echo '<script type="text/javascript">
                        alert("CPF inválido");
                        window.location.href = "index.php?ctrl=usuarioloja&acao=novo";
                    </script>';
                exit;
            }

            $r = $this->model->inserir($_POST);
            if ($r) {
                $_SESSION['cliente']['logado'] = true;
                $_SESSION['cliente']['email'] = $_POST['email'];
                $_SESSION['cliente']['nome'] = $_POST['nome'];
                $this->conta();
            } else {
                echo '<script type="text/javascript">
                    alert("Erro ao cadastrar os dados. \n Tente novamente!");
                    window.location.href = "./index.php?ctrl=usuarioloja&acao=novo";
                </script>';
            }
        } else {
            echo '<script type="text/javascript">
                    alert("Email ou cpf já cadastrado.");
                    window.location.href = "./index.php?ctrl=usuarioloja&acao=novo";
                </script>';
        }
    }

    public function conta() {
        $dados = $this->model->conta($_SESSION['cliente']['email']);
        $dados['cpf'] = $this->Mask('###.###.###-##', $dados['cpf']);
        require './view/cliente/minhaConta.php';
    }

    public function buscar() {
        $action = "index.php?ctrl=usuarioloja&acao=atualizar";
        $registro = $this->model->buscar($_POST['id']);
        require './view/cliente/form.php';
    }

    public function atualizar() {
        $r = $this->model->atualizar($_POST);
        if ($r) {
            $_SESSION['cliente']['nome'] = $_POST['nome'];
            $_SESSION['cliente']['email'] = $_POST['email'];
            $this->conta();
        } else {
            ?>
            <script type="text/javascript">
                altert('Erro ao cadastrar os dados!\nTente novamente!');
                window.location.href = "index.php?ctrl=usuarioloja&acao=buscar";
            </script>
            <?php

        }
    }

    public function formsenha() {
        $action = "index.php?ctrl=cliente&acao=atualizarsenha";
        $id = $_POST['id'];
        require './view/cliente/formsenha.php';
    }

    public function atualizarsenha() {
        $senhaAntiga = md5($_POST['senhaAntiga']);
        $senhaNova = md5($_POST['senha']);
        $id = $_POST['id'];
        $senhas = array('senhaAntiga' => $senhaAntiga, 'senha' => $senhaNova, 'id' => $id);
        $r = $this->model->atualizarSenha($senhas);
        if ($r) {
            echo '<script type="text/javascript">alert("Senha alterada com sucesso.");</script>';
            $this->conta();
        } else {

            echo '<script type="text/javascript">
                alert("Dados nao conferem. Tente novamente");
                window.location.href = "index.php?ctrl=usuarioloja&acao=conta";
            </script>';
        }
    }

    /*
     * sessão de esqueci minha senha
     */

    public function esquecisenha() {
        $action = "index.php?ctrl=usuarioloja&acao=novasenha";
        require './usuario/formNovaSenha.php';
    }

    /**
     * Função que procura se a conta do cliente existe baseado no email informado,
     *  gera e cadastra uma nova senha no banco de dados para o cliente.
     * Após isso a senha é enviada ao cliente por email
     */
    public function novasenha() {
        $conta = $this->model->conta($_POST['email']);
        if (count($conta) > 1) {
            $senha = $this->gerasenha();
            $senhamd5 = md5($senha);
            $r = $this->model->novasenha($_POST['email'], $senhamd5);
            if ($r) {
                $this->emailsenha($_POST['email'], $senha);
            } else {
                echo '<script type="text/javascript">alert("Erro ao cadastrar senha.");'
                . 'window.location.href = "index.php?ctrl=usuarioloja&acao=novasenha";</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("Email nao consta na base de dados. Tente novamente");'
            . 'window.location.href = "index.php?ctrl=usuarioloja&acao=esquecisenha";</script>';
        }
    }

    /**
     * função responsável por gerar uma nova senha para o usuario
     *  ao usar a função esqueci a senha
     * 
     * @return string nova senha gerada automaticamente
     */
    public function gerasenha() {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin . $lmai . $num;
        $len = strlen($caracteres);

        for ($n = 1; $n <= 8; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

    function Mask($mask, $str) {

        $str = str_replace(" ", "", $str);

        for ($i = 0; $i < strlen($str); $i++) {
            $mask[strpos($mask, "#")] = $str[$i];
        }

        return $mask;
    }

    /* realizar validação com javascript
      function validarCPF($cpf) {

      $cpf = preg_replace('/[^\d]+/', '', $cpf);
      if ($cpf == '')
      return false;
      // Elimina CPFs invalidos conhecidos
      if (strlen($cpf) != 11 ||
      $cpf == "00000000000" ||
      $cpf == "11111111111" ||
      $cpf == "22222222222" ||
      $cpf == "33333333333" ||
      $cpf == "44444444444" ||
      $cpf == "55555555555" ||
      $cpf == "66666666666" ||
      $cpf == "77777777777" ||
      $cpf == "88888888888" ||
      $cpf == "99999999999")
      return false;
      // Valida 1o digito
      $add = 0;
      for ($i = 0; $i < 9; $i ++)
      $add += intval($cpf{$i}) * (10 - $i);
      $rev = 11 - ($add % 11);
      if ($rev == 10 || $rev == 11)
      $rev = 0;
      if ($rev != intval($cpf{9}))
      return false;
      // Valida 2o digito
      $add = 0;
      for ($i = 0; $i < 10; $i ++)
      $add += intval($cpf{$i}) * (11 - $i);
      $rev = 11 - ($add % 11);
      if ($rev == 10 || $rev == 11)
      $rev = 0;
      if ($rev != intval($cpf{10}))
      return false;
      return true;
      }
     */
}
