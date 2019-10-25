<?php

/**
 * SaborModel
 *
 */
class SaborModel extends Conexao {

    //put your code here

    function __construct() {
        parent::__construct();
    }


    /**
     * função que retorna todos os registros de sabor do banco de dados
     * @return array
     */
    public function buscarTodos() {
        $select = "SELECT * FROM sabor ";
        $query = $this->bd->query($select);
        if (is_bool($query)) {
            return false;
        } else {
            return $query->fetchAll();
        }
    }

    
    /**
     * Função responsável por iserir registros de sabor no banco de dados
     * @param $dados
     * @return boolean
     */
    public function inserir($dados) {
        $insert = "INSERT INTO sabor(nome, descricao, valor, imagem) "
                . " VALUES(:nome, :descricao, :valor, :imagem);";
        $query = $this->bd->prepare($insert);
        $r =  $query->execute($dados);
        if($r){
            return true;
        }else{
            print_r($query->errorInfo());exit;
        }
            
    }


    /**
     * Função responsável por excluir registro de sabor do banco de dados
     * a partir do id passado por parâmetro
     *  
     * @param $id
     * @return boolean
     */
    public function excluir($id) {
        $delete = " DELETE FROM sabor WHERE idSabor = :idSabor";
        $query = $this->bd->prepare($delete);
        return $query->execute(array('idSabor' => $id));
    }

    
    /**
     * Função responsável por buscar um registro pelo id
     * para alteração de sabor
     * 
     * @param $id
     * @return array
     */
    public function buscar($id) {
        $select = "SELECT * FROM sabor WHERE idSabor=:id";
        $query = $this->bd->prepare($select);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }
    
    /**
     * Função responsável por atualizar 
     * o registro de sabor recebido no banco de dados
     * 
     * @param $registro
     * @return boolean
     */
    public function atualizar($registro) {
        if(isset($registro['imagem'])){
        $update = "UPDATE sabor SET nome=:nome, descricao=:descricao,"
                . " valor=:valor, imagem=:imagem"
                . " WHERE idSabor=:id";
        }else{
            $update = "UPDATE sabor SET nome=:nome, descricao=:descricao,"
                . " valor=:valor "
                . " WHERE idSabor=:id";
        }
        $query = $this->bd->prepare($update);
        return $query->execute($registro);
    }

}
