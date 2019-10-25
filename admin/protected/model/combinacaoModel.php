<?php

/**
 * CategoriaModel
 *
 */
class CombinacaoModel extends Conexao {

    //put your code here

    function __construct() {
        parent::__construct();
    }


    /**
     * função que retorna todos os registros de combinação do banco de dados
     * @return array
     *
    public function buscarTodos($ordem) {
        $select = "SELECT * FROM combinacao";
        
        $r = $this->bd->query($select);
        
        return $r->fetchAll();
    }*/

    
    /**
     * Função responsável por iserir registros de combinação no banco de dados
     * @param $dados
     * @return boolean
     */
    public function inserir($dados) {
        $insert = '';
        if(!isset($dados['idSabor2'])){
            $insert = "INSERT INTO combinacao(idSabor1, idTipoPizza) "
                . " VALUES(:idSabor1, :idTipoPizza);";
        }else if(isset($dados['idSabor2']) && !isset($dados['idSabor3'])){
            $insert = "INSERT INTO combinacao(idSabor1, idSabor2, idTipoPizza) "
                . " VALUES(:idSabor1, :idSabor2, :idTipoPizza);";
        }else if(isset($dados['idSabor3'])){
            $insert = "INSERT INTO combinacao(idSabor1, idSabor2, idSabor3, idTipoPizza) "
                . " VALUES(:idSabor1, :idSabor2, :idSabor3, :idTipoPizza);";
        }
         
        $query = $this->bd->prepare($insert);
        $r = $query->execute($dados);
        if($r){
          return $r;
        }else{
          echo 'Erro ao inserir';
        }
    }



    /**
     * função que busca o id de uma combinação no bd
     * caso nao encontre envia ao metodo inserir que cadastra a combinacao no bd
     * 
     * @param type $dados
     * @return array idCombinacao
     * 
     */
    public function buscarCombinacao($dados) {
       
        $select = 'SELECT idCombinacao FROM combinacao'
                . ' WHERE idTipoPizza=:idTipoPizza AND idSabor1=:idSabor1';
        if(isset($dados['idSabor2'])){
            $select = $select.' AND idSabor2=:idSabor2';
        }
        if(isset($dados['idSabor3'])){
            $select = $select.' AND idSabor3=:idSabor3';
        }
        
        $query = $this->bd->prepare($select);
        $query->execute($dados);
        $r = $query->fetch();
        if(!is_array($r)){
            $this->inserir($dados);
        }else{
            return $r;
        }
        
    }
    
    public function buscarNomes($id) {
        $sabores = array();
        $select = "select c.*, t.descricao as tipopizza from combinacao c"
                . " inner join tipopizza t on t.idTipoPizza = c.idTipoPizza"
                . " where idCombinacao=:id";
        $query = $this->bd->prepare($select);
        $query->execute(array('id'=>$id));
        $r = $query->fetch();
        $sabores['tipopizza'] = $r['tipopizza'];
        if($r['idSabor1'] != null){
            $select = "select s.nome as sabor1 from combinacao c "
                    . " inner join sabor s on c.idSabor1=s.idSabor"
                    . " where idCombinacao = :id";
            $query = $this->bd->prepare($select);
        $query->execute(array('id'=>$id));
        $sabor = $query->fetch();
        $sabores['sabor1'] = $sabor['sabor1'];
        }
        if($r['idSabor2'] != null){
            $select = "select s.nome as sabor2 from combinacao c "
                    . " inner join sabor s on c.idSabor2=s.idSabor"
                    . " where idCombinacao = :id";
            $query = $this->bd->prepare($select);
        $query->execute(array('id'=>$id));
        $sabor = $query->fetch();
        $sabores['sabor2'] = $sabor['sabor2'];
        }
        if($r['idSabor3'] != null){
            $select = "select s.nome as sabor3 from combinacao c "
                    . " inner join sabor s on c.idSabor3=s.idSabor"
                    . " where idCombinacao = :id";
            $query = $this->bd->prepare($select);
        $query->execute(array('id'=>$id));
        $sabor = $query->fetch();
        $sabores['sabor3'] = $sabor['sabor3'];
        }
        return $sabores;
    }
    

    
    

}
