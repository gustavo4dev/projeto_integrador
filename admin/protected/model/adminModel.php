<?php

class AdminModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    
//Função responsável por buscar informações para login

    public function buscarLogin($registro) {
        $select = "SELECT * FROM usuario WHERE username=:username and senha=:senha";
        $query = $this->bd->prepare($select);
        $query->execute(array('username' => $registro['username'], 'senha' => md5($registro['senha'])));
        return $query->fetch();
        
    }

}
