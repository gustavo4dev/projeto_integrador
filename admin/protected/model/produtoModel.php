<?php

class ProdutoModel extends Conexao {

    //metodo construtor
    function __construct() {
        parent::__construct();
        //print_r($this->bd);
    }

    /**
     * -----------------------------------------
     * funções relativas à area do administrador
     * -----------------------------------------
     */

    /**
     * função responsável por retornar informações sobre produto para o administrador
     * @return array passagem
     */
    public function buscarTodos() {
        $select = "SELECT p.*, c.nome as categoria FROM produto p"
                . " INNER JOIN categoria c ON c.idCategoria=p.idCategoria ";
        $query = $this->bd->query($select);
        if (is_bool($query)) {
            return false;
        } else {
            return $query->fetchAll();
        }
    }

    /**
     * função responsável por inserir um registro de produto no banco de dados
     * @param $dados
     * @return boolean
     */
    public function inserir($dados) {
        $insert = "INSERT INTO produto(nome, descricao, valor, tempoPreparo, idCategoria, imagem) "
                . " VALUES(:nome, :descricao, :valor, :tempoPreparo, :idCategoria, :imagem)";
        $query = $this->bd->prepare($insert);
        return $query->execute($dados);
    }

    /**
     * função responsável por excluir um registro do banco de dados
     * @param $id
     * @return boolean
     */
    public function excluir($id) {
        $delete = "DELETE FROM produto WHERE idProduto = :id";
        $query = $this->bd->prepare($delete);
        $r = $query->execute(array('id' => $id));
        if ($r) {
            return true;
        } else {
            return $query->errorInfo();
        }
    }

    /**
     * função responsável por buscar determinado registro
     *  para que seja feita a edição dos dados
     * 
     * @param $id
     * @return array
     */
    public function buscar($id) {
        $select = "SELECT * FROM produto WHERE idProduto=:id";
        $query = $this->bd->prepare($select);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }

    /**
     * função responsável por atualizar o registro vindo do formulario de edição
     * @param $registro
     * @return boolean
     */
    public function atualizar($registro) {
        if (isset($registro['imagem'])) {
            //caso haja alteração de imagem será usada esta query
            $update = "UPDATE produto SET 
                            nome=:nome, descricao=:descricao,  
                            valor=:valor, tempoPreparo=:tempoPreparo,
                            idCategoria=:idCategoria, imagem=:imagem
                        WHERE idProduto=:id";
        } else {
            //caso NÃO haja alteração de imagem será usada esta query
            $update = "UPDATE produto SET 
                            nome=:nome, descricao=:descricao,  
                            valor=:valor, tempoPreparo=:tempoPreparo,
                            idCategoria=:idCategoria
                        WHERE idProduto=:id";
        }
        $query = $this->bd->prepare($update);


        return $query->execute($registro);
    }

    /* ----------------------------------------
     * conjunto de funções relativas à loja
     * dizem respeito ao usuario
     * ----------------------------------------
     */

    /**
     * função responsável por buscar um registro pelo id
     * para que seja mostrado em detalhes ao usuario
     * 
     * @param $id produto
     * @return array
     */
    public function buscarItem($id) {
        $sql = "SELECT p.*, c.nome as categoria, c.imagem as imagemCat FROM produto p"
                . " INNER JOIN categoria c ON p.idCategoria=c.idCategoria"
                . " WHERE p.idProduto=:id";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));
        return $query->fetch();
    }

    /**
     * função responsável por retornar 
     * os produtos relacionados à determinada categoria
     * 
     * @param $id categoria
     * @return array
     */
    public function buscaPorCategoria($id) {
        $sql = "SELECT p.*, c.nome as categoria, c.imagem as imagemCat FROM produto p"
                . " INNER JOIN categoria c ON p.idCategoria=c.idCategoria"
                . " WHERE p.idCategoria=:id ORDER BY rand()";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));
        return $query->fetchAll();
    }

    /**
     * função responsável por retornar 
     * os produtos relacionados à determinada categoria
     * 
     * @param $id categoria
     * @return array
     */
    public function buscaCarrousel() {
        $sql = "SELECT p.* FROM produto p
                LEFT JOIN destaques d ON p.idProduto = d.idProduto
                WHERE ISNULL(d.idProduto)
                ORDER BY rand()";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

}
