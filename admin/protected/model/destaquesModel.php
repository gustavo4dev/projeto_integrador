<?php

class DestaquesModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function buscarTodos() {
        $select = "SELECT * FROM destaques";
        $query = $this->bd->query($select);
        return $query->fetchAll();
    }

    public function inserir($registros) {
        $indice = 0;
        $erro = 0;
        $truncate = "TRUNCATE TABLE destaques; ALTER TABLE destaques AUTO_INCREMENT = 1";
        if ($this->bd->query($truncate) && is_array($registros)) {
            foreach ($registros as $item) {
                $insert = "INSERT INTO destaques (idproduto) VALUES(" . $item . ")";
                $query = $this->bd->query($insert);
                if ($query)
                    $indice ++;
                else
                    $erro++;
            }
            if ($indice === count($registros)) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    public function buscarProdutos() {
        $select = "SELECT p.*, c.nome as categoria FROM produto p "
                . "INNER JOIN categoria c ON c.idCategoria=p.idCategoria "
                . "INNER JOIN destaques d ON d.idProduto=p.idProduto ";
        $query = $this->bd->query($select);
        return $query->fetchAll();
    }

}
