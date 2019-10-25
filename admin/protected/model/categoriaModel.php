<?php

/**
 * CategoriaModel
 *
 */
class CategoriaModel extends Conexao {

    //put your code here

    function __construct() {
        parent::__construct();
    }

    /**
     * função que retorna todos os registros de categoria do banco de dados
     * @return array
     */
    public function buscarTodos() {
        $select = "SELECT * FROM categoria ";
        $query = $this->bd->query($select);
        if (is_bool($query)) {
            return false;
        } else {
            return $query->fetchAll();
        }
    }

    /**
     * Função responsável por iserir registros de categoria no banco de dados
     * @param $dados
     * @return boolean
     */
    public function inserir($dados) {
        $insert = "INSERT INTO categoria(nome, descricao, imagem) "
                . " VALUES(:nome, :descricao, :imagem);";
        $query = $this->bd->prepare($insert);
        return $query->execute($dados);
    }

    /**
     * Função responsável por excluir registro de categoria do banco de dados
     * a partir do id passado por parâmetro
     *  
     * @param $id
     * @return boolean
     */
    public function excluir($id) {
        $delete = " DELETE FROM categoria WHERE idCategoria = :id";
        $query = $this->bd->prepare($delete);
        $r = $query->execute(array('id' => $id));
        if ($r) {
            return true;
        } else {
            return $query->errorInfo();
        }
    }

    /**
     * Função responsável por buscar um registro pelo id
     * para alteração de categoria
     * 
     * @param $id
     * @return array
     */
    public function buscar($id) {
        $select = "SELECT * FROM categoria WHERE idCategoria=:id";
        $query = $this->bd->prepare($select);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }

    /**
     * Função responsável por atualizar 
     * o registro de categoria recebido no banco de dados
     * 
     * @param $registro
     * @return boolean
     */
    public function atualizar($registro) {
        if (isset($registro['imagem'])) {
            //caso haja alteração de imagem será usada esta query
            $update = "UPDATE categoria SET 
                            nome=:nome, descricao=:descricao,  
                             imagem=:imagem
                        WHERE idCategoria=:id";
        } else {
            //caso NÃO haja alteração de imagem será usada esta query
            $update = "UPDATE categoria SET 
                            nome=:nome, descricao=:descricao,
                        WHERE idCategoria=:id";
        }
        $query = $this->bd->prepare($update);
        return $query->execute($registro);
    }

}
