<?php

/**
 * TipoPizzaModel
 *
 */
class TipoPizzaModel extends Conexao {

    //put your code here

    function __construct() {
        parent::__construct();
    }

    /**
     * função que retorna todos os registros de sabore do banco de dados
     * @return array
     */
    public function buscarTodos() {
        $select = "SELECT * FROM tipopizza ";
        $query = $this->bd->query($select);
        if (is_bool($query)) {
            return false;
        } else {
            return $query->fetchAll();
        }
    }

    /**
     * Função responsável por iserir registros de tipoPizza no banco de dados
     * @param $dados array
     * @return boolean
     */
    public function inserir($dados) {
        $insert = "INSERT INTO tipopizza(descricao, quantidade, reajuste)"
                . " VALUES(:descricao, :quantidade, :reajuste)";
        $query = $this->bd->prepare($insert);
        return $query->execute($dados);
    }

    /**
     * Função responsável por excluir registro de tipoPizza do banco de dados
     * a partir do id passado por parâmetro
     *  
     * @param $id
     * @return boolean
     */
    public function excluir($id) {
        $delete = " DELETE FROM tipopizza WHERE idTipoPizza = :id";
        $query = $this->bd->prepare($delete);
        return $query->execute(array('id' => $id));
    }

    /**
     * Função responsável por buscar um registro pelo id
     * para alteração de tipoPizza
     * 
     * @param $id
     * @return array
     */
    public function buscar($id) {
        $select = "SELECT * FROM tipopizza WHERE idTipoPizza=:id";
        $query = $this->bd->prepare($select);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }
    
    
    public function buscarReajuste($id) {
        $select = "SELECT reajuste FROM tipopizza WHERE idTipoPizza=:id";
        $query = $this->bd->prepare($select);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }

    /**
     * Função responsável por atualizar 
     * o registro de tipoPizza recebido no banco de dados
     * 
     * @param $registro
     * @return boolean
     */
    public function atualizar($registro) {
        $update = "UPDATE tipopizza SET descricao=:descricao, quantidade=:quantidade, reajuste=:reajuste"
                . " WHERE idTipoPizza=:id";
        $query = $this->bd->prepare($update);
        return $query->execute($registro);
    }

}
