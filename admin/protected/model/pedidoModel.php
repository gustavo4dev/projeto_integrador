<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of compraModel
 *
 */
class PedidoModel extends Conexao {

    //método construtor
    public function __construct() {
        parent::__construct();
    }

    /**
     * ----------------------------------------------
     * funcções pertinentes à área administrativa,
     * utilizadas para a geração de relatórios
     * ----------------------------------------------
     */

    /**
     * Função responsável por retornar 
     * todos os registros de pedidos do banco de dados
     * 
     * @return array
     */
    public function buscarTodos() {
        $sql = "SELECT * FROM pedido"
                . " order by dataPedido asc";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function buscarPorData() {
        $sql = "SELECT * FROM pedido"
                . " WHERE dataPedido BETWEEN :data1 AND :data2"
                . " ORDER BY dataPedido DESC";
        $query = $this->bd->prepare($sql);
        $query->execute(array('idCompra' => $id));
        return $query->fetch();
    }

    public function buscar($id) {
        $sql = "SELECT c.*, ci.*, u.email as user, p.*, o.nome as origem, d.nome as destino FROM compra c"
                . " inner join compraItem ci ON c.idCompra=ci.idCompra"
                . " inner join usuario u ON ci.idUsuario=u.idUsuario"
                . " inner join passagem p ON ci.idPassagem=p.idPassagem"
                . " inner join origem o ON p.idOrigem=o.idOrigem"
                . " inner join destino d ON p.idDestino=o.idDestino"
                . " WHERE c.idCompra=:idCompra";
        $query = $this->bd->prepare($sql);
        $query->execute(array('idCompra' => $id));
        return $query->fetch();
    }

    public function buscarporusuario($user) {
        $sql = "SELECT pe.*";
        $query = $this->bd->prepare($sql);
        $query->execute(array('idUsuario' => $user));
        return $query->fetchAll();
    }

    public function buscarcod($cod) {
        $sql = "SELECT * FROM pedido WHERE codigoValidacao=UPPER(:cod)";
        $query = $this->bd->prepare($sql);
        $query->execute(array('cod' => $cod));
        return $query->fetch();
    }

    public function getItensPedido($idpedido) {
        $select = "select ip.* from itempedido ip"
                . " right join pedido pe on pe.idpedido=ip.idpedido "
                . " where pe.idpedido=:idpedido";
        $query = $this->bd->prepare($select);
        $query->execute(array('idpedido' => $idpedido));
        return $query->fetchAll();
    }

    /**
     * função que altera o status do pedido de aberto 1, para fechado 0
     * @param int $id
     * @return boolean
     */
    public function fecharPedido($id) {
        $sql = "UPDATE pedido SET status=0 WHERE idPedido=:id";
        $query = $this->bd->prepare($sql);
        return $query->execute(array('id' => $id));
    }

    /**
     * ----------------------------------------------
     * funcções pertinentes à área do cliente (site),
     * utilizadas para registro e consulta de pedidos
     * ----------------------------------------------
     */
    public function inserirPedido($pedido, $itempedido) {

        $sql = "INSERT INTO pedido (valorTotal, idEndereco, codigoValidacao, idCliente)"
                . " VALUES (:valorTotal, :idEndereco, :cod, :idCliente)";
        $query = $this->bd->prepare($sql);
        $query->execute($pedido);
        $idpedido = $this->buscarcod($pedido['cod']);



        $addpedido = $this->inserirItem($itempedido, $idpedido['idPedido']);
        if ($addpedido) {
            return true;
        } else {
            return false;
        }
    }

    public function inserirItem($itempedido, $idpedido) {
        $true = 0;
        foreach ($itempedido as $item) {
            $item['idPedido'] = $idpedido;
            unset($item[0]);
            //print_r($item);exit;
            if (isset($item['idProduto'])) {
                $sql = "INSERT INTO itempedido (idPedido, idProduto, quantidade, valorUnitarioItem)"
                        . " VALUES (:idPedido, :idProduto, :quantidade, :valorUnitarioItem)";
            } else if (isset($item['idCombinacao'])) {
                $sql = "INSERT INTO itempedido (idPedido, idCombinacao, quantidade, valorUnitarioItem)"
                        . " VALUES (:idPedido, :idCombinacao, :quantidade, :valorUnitarioItem)";
            }
            $query = $this->bd->prepare($sql);

            $r = $query->execute($item);
            if ($r)
                $true +=1;
        }
        if (count($itempedido) == $true) {
            return true;
        }
    }

}
