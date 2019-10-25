<?php

class ClienteModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    /**
     * função responsável por inserir
     * clientes no banco de dados vindos do cadastro do site
     * 
     * @param array $dados
     * @return boolean
     */
    public function inserirsite($dados) {
        unset($dados['confSenha']);
        print_r($dados);
        $dados['senha'] = md5($dados['senha']);
        $insert = "INSERT INTO cliente(nome, cpf, telefone, sexo, nascimento, email, senha) "
                . " VALUES(:nome, :cpf, :telefone, :sexo, :nascimento, :email, :senha)";
        $query = $this->bd->prepare($insert);
        return $query->execute($dados);
    }

    /**
     * função responsável por inserir clientes no banco de dados
     * vindos pelo autenticador do google ou facebook
     * 
     * @param array $dados
     * @return boolean
     */
    public function inserirGoogleLogin($dados) {


        $insert = "INSERT INTO cliente(nome, cpf, telefone, sexo, nascimento, email, loginExt) "
                . " VALUES(:nome, :cpf, :telefone, :sexo, :nascimento, :email, :loginExt)";
        $query = $this->bd->prepare($insert);
        return $query->execute($dados);
    }

    /**
     * Função para buscar dados do cliente pelo id
     * @param type $id
     * @return type
     */
    public function buscar($id) {
        $select = "SELECT * FROM cliente WHERE idCliente=:id";
        $query = $this->bd->prepare($select);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }

    /**
     * função responsável por setar uma nova senha para o cliente
     */
    public function esqueciSenha($email) {
        $select = 'select idCliente, loginExt from cliente where email=:email';
        $query = $this->bd->prepare($select);
        $query->execute(array('email' => $email));
        return $query->fetch();
    }

    /**
     * função que seta nova senha para o usuario que esqueceu
     */
    public function setNovaSenha($idCliente, $novaSenha) {
        $senha = md5($novaSenha);
        $update = "update cliente set senha=:senha, flagSenha=true where idCliente=:id";
        $query = $this->bd->prepare($update);
        return $query->execute(array('senha' => $senha, 'id' => $idCliente));
    }

    //modifica senha do usuario quando faz login depois de ter dado esqueci senha
    public function modificaSenha($email, $novaSenha) {
        $senha = md5($novaSenha);
        $update = "update cliente set senha=:senha, flagSenha=false where email=:email";
        $query = $this->bd->prepare($update);
        return $query->execute(array('senha' => $senha, 'email' => $email));
    }

    /**
     * função que busca os dados do cliente pelo cpf
     * 
     * @param String $cpf
     * @return array
     */
    public function buscarcpf($cpf) {
        $select = "SELECT * FROM cliente WHERE cpf=:cpf";
        $query = $this->bd->prepare($select);
        $query->execute(array('cpf' => $cpf));
        return $query->fetch();
    }

    /**
     * função que busca os enderecos do cliente pelo email
     * 
     * @param String $email
     * @return array
     */
    public function buscaEndereco($email) {
        $select = "SELECT e.* FROM cliente c "
                . " inner join endereco e on e.idCliente=c.idCliente"
                . " where c.email = :email";
        $query = $this->bd->prepare($select);
        $query->execute(array('email' => $email));
        return $query->fetchAll();
    }

    /**
     * função que adiciona um novo endereco
     * 
     * @param String $email
     * @return array
     */
    public function addEndereco($endereco, $email) {
        $cliente = $this->conta($email);
        $endereco['idCliente'] = $cliente['idCliente'];

        $select = "INSERT INTO endereco(rua, numero, bairro, complemento, cep, cidade, idCliente)"
                . " VALUES (:rua, :numero, :bairro, :complemento, :cep, :cidade, :idCliente)";
        $query = $this->bd->prepare($select);
        return $query->execute($endereco);
    }

    /**
     * função que valida dados de login
     * 
     * @param String $cpf
     * @return array
     */
    public function clienteLogin($dados) {
        $select = "SELECT * FROM cliente WHERE email=:email";
        $query = $this->bd->prepare($select);
        $query->execute(array('email' => $dados['email']));
        $cliente = $query->fetch();
        if (is_array($cliente)) {
            if ($cliente['loginExt'] == true) {
                return "Você se cadastrou usando sua conta do Google.<br/>Use o botao do Google para fazer login.";
            } else {
                $select = "SELECT * FROM cliente WHERE email=:email AND senha=:senha";
                $query = $this->bd->prepare($select);
                $query->execute(array('email' => $dados['email'], 'senha' => md5($dados['senha'])));
                $cliente = $query->fetch();
                if (is_array($cliente)) {
                    $retorno = array('nome' => $cliente['nome'], 'email' => $cliente['email'], 'flagsenha' => $cliente['flagSenha']);
                    return $retorno;
                } else {
                    return 'Email ou senha incorretos!';
                }
            }
        } else {
            return 'Este email não está associado a nenhuma conta!';
        }
    }

    /**
     * função que valida dados de login externo (Google)
     * 
     * @param String $cpf
     * @return array
     */
    public function clienteLoginExt($dados) {
        $select = "SELECT * FROM cliente WHERE email=:email";
        $query = $this->bd->prepare($select);
        $query->execute(array('email' => $dados['email']));
        $cliente = $query->fetch();
        if (is_array($cliente)) {
            if ($cliente['loginExt'] == false) {
                return 'Você não usou o Google para logar no site.<br/>Por favor informe seu email e senha no formulario de login.';
            } else {
                $retorno = array('nome' => $cliente['nome'], 'email' => $cliente['email'], 'loginExt' => $cliente['loginExt']);
                return $retorno;
            }
        } else {
            return false;
        }
    }

    /**
     * função que atualiza os dados de um cliente no banco de dados
     * 
     * @param array $registro
     * @return boolean
     */
    public function atualizarDados($registro) {
        $update = "UPDATE cliente SET 
                            nome=:nome, 
                            email=:email, 
                            cpf=:cpf, 
                            nascimento=:nascimento, 
                            telefone=:telefone 
                        WHERE idCliente=:inf";
        $query = $this->bd->prepare($update);

        return $query->execute($registro);
    }

    /**
     * função para troca de senha do usuario
     * 
     * @param array $registro
     * @return boolean
     */
    public function atualizarsenha($registro) {
        $select = "SELECT * FROM cliente WHERE email=:email";
        $busca = $this->bd->prepare($select);
        $busca->execute(array('email' => $registro['email']));
        $senha = $busca->fetch();

        if (md5($registro['senhaAntiga']) == $senha['senha']) {
            $update = "UPDATE cliente SET senha=:senha WHERE email=:email";
            $query = $this->bd->prepare($update);
            return $query->execute(array('senha' => md5($registro['senhaNova']), 'email' => $registro['email']));
        } else {
            return 'Senha antiga não correponde.';
        }
    }

    /**
     * função que busca os dados do cliente baseado no email para exibí-los
     * em uma pagina com informações da conta
     * 
     * @param String $email
     * @return array
     */
    public function conta($email) {
        $sql = "SELECT idCliente, nome, email, cpf, telefone, nascimento, loginExt FROM cliente WHERE email=:email";
        $query = $this->bd->prepare($sql);
        $query->execute(array('email' => $email));
        return $query->fetch();
    }

    /**
     * funcaõ que busca os pedidos do usuario baseado no email
     * @param type $email
     * @return type
     */
    public function meusPedidos($email) {
        $sql = "SELECT p.* FROM pedido p "
                . " INNER JOIN cliente c ON c.idCliente=p.idCliente "
                . " WHERE c.email = :email";
        $query = $this->bd->prepare($sql);
        $query->execute(array('email' => $email));
        return $query->fetchAll();
    }

}
