<?php

/**
 * Description of conexao
 *
 */
class Conexao {
    public $bd;
    
    function __construct() {
        $this->estabeleceConexao();
    }
    
    public function estabeleceConexao() {
        try {
            $this->bd = new PDO(
                    BD_TIPO.':host='.BD_HOST.';dbname='.BD_NOME,
                    BD_USUARIO,
                    BD_SENHA
                );
        } catch (PDOException $exc) {
            echo '<script>window.alert("Houve um problema com a conexão ao banco de dados!\nEntre em contato com o administrador do sistema!");</script>';
            exit;
        }
    }
}
