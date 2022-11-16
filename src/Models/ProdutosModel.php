<?php

namespace App\Models;

use \App\Persistence\Conexao as Conexao;

class ProdutosModel{
    protected $con;
    protected App\Entities\Produto $entity;
    
    public function __construct(){
        $this->con = Conexao::getInstance();
    }
    public function getAll(){
        $sql = 'SELECT * FROM produtos ';
        $query = $this->con->query($sql, \PDO::FETCH_OBJ);

        $data = [];
        foreach( $query->fetchAll() as $row ) { 
             $data[] = $row;
        }
        
        return $data;
    }

    public function add(\App\Entities\Produto $entity): bool{
        $sql = 'INSERT INTO produtos (id, descricao, valor_unitario)';
        $sql .= 'VALUES (?,?,?)';

        $stm = $this->con->prepare($sql);

        $stm->bindValue(1, $entity->getId());
        $stm->bindValue(2, $entity->getDescricao());
        $stm->bindValue(3, $entity->getValorUnitario());

        $inserted = $stm->execute();

        return $inserted;
    }

    public function update(\App\Entities\Produto $entity) : bool{
        $sql = 'UPDATE produtos
                        SET descricao = ?,
                        valor_unitario = ?';

        $sql .= ' WHERE id = ?';

        $stm = $this->con->prepare($sql);

        $stm->bindValue(1, $entity->getDescricao());
        $stm->bindValue(2, $entity->getValorUnitario());
        $stm->bindValue(3, $entity->getId());
        
        $updated = $stm->execute();

        return $updated;
    }

    public function delete ($id){
        
        $sql = 'DELETE FROM produtos';
        $sql .= ' WHERE id = ?';

        $stm = $this->con->prepare($sql);
        $stm-> bindValue(1,$id);

        $deleted = $stm->execute();

        return json_encode([
            'success' => $deleted,
            'data' => [],
            'message' => $deleted ? 'registro excluído com sucesso' : 'não foi possível excluir o registro'
        ]);
    }
}