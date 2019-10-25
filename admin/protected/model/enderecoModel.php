<?php

/**
 * Description of EnderecoModel;
 * Endereço do usuario;
 * Não pertinente à área administrativa;
 * administrador apenas consulta;
 *
 */
class EnderecoModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    /**
     * função que retorna todos os registros de endereco do banco de dados
     * 
     * @return array
     */
    /*public function buscarTodos() {
        $select = "SELECT * FROM endereco";
        $query = $this->bd->query($select);
        return $query->fetchAll();
    }*/

    /**
     * Função responsável por iserir registros de endereco no banco de dados
     * @param $dados
     * @return boolean
     */
    public function inserir($dados) {
        if (empty($dados['complemento'])) {
            unset($dados['complemento']);
            $insert = "INSERT INTO endereco(rua, numero, bairro, cep, cidade, idCliente) "
                    . " VALUES(:rua, :numero, :bairro, :cep, :cidade, :idCliente);";
        } else {
            $insert = "INSERT INTO endereco(rua, numero, bairro, complemento, cep, cidade, idCliente) "
                    . " VALUES(:rua, :numero, :bairro, :complemento, :cep, :cidade, :idCliente);";
        }
        $query = $this->bd->prepare($insert);
        return $query->execute($dados);
    }

    /**
     * Função responsável por excluir registros de categoria do banco de dados
     * a partir do id do registro
     * 
     * @param $id
     * @return boolean
     */
    public function excluir($id) {
        $delete = " DELETE FROM endereco WHERE idEndereco = :id";
        $query = $this->bd->prepare($delete);
        return $query->execute(array('id' => $id));
    }

    /**
     * Função responsável por buscar um registro pelo id
     * para alteração de endereco
     * 
     * @param $id
     * @return boolean
     */
    public function buscar($id) {
        $select = "SELECT * FROM endereco WHERE idEndereco=:id";
        $query = $this->bd->prepare($select);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }
    
    /**
     * Função responsável por buscar um registro pelo termo digitado pelo usuario
     * para consulta de endereço
     * 
     * @param $termo
     * @return array
     */
    public function pesquisar($campo, $termo) {
        
        $select = "SELECT * FROM endereco "
                . " WHERE :campo LIKE :termo; ";
        $query = $this->bd->prepare($select);
        $query->execute(array('%'.$campo['campo'].'%', '%'.$termo['termo'].'%'));
        return $query->fetchAll();
    }
    
    /**
     * Função responsável por buscar um registro pelo id do cliente
     * para consulta de dados do cliente
     * 
     * @param $id
     * @return boolean
     */
    public function buscarPorCliente($id) {
        $select = "SELECT * FROM endereco WHERE idCliente=:id";
        $query = $this->bd->prepare($select);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }

    /**
     * Função responsável por atualizar 
     * o registro de endereco recebido no banco de dados
     * 
     * @param $registro
     * @return boolean
     */
    public function atualizar($registro) {
        $update = "UPDATE endereco SET rua=:rua, numero=:numero, bairro=:bairro,"
                . " complemento=:complemento, cep=:cep, cidade=:cidade"
                . " WHERE idEndereco=:idEndereco";
        $query = $this->bd->prepare($update);
        return $query->execute($registro);
    }

}
