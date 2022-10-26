<?php
/**
 * Model contato
 *
 * @author Wanderlei Silva do Carmo <wander.silva@gmail.com>
 * @version 1.0
 *
 */

namespace App\Models;

use \App\Persistence\Conexao as Conexao;

class ProdutoModel  {

    protected \App\Entities\Produto $entity;
    private \PDO $con;

    public function __construct() {
        $this->con = Conexao::getInstance();
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM produtos ';
        $query = $this->con->query($sql, \PDO::FETCH_OBJ);

        $data = [];
        foreach( $query->fetchAll() as $row ) {
            $data[] = $row;
        }

        return $data;
    }

    public function add(\app\Entities\Produto $entity): bool{

        //die(var_dump($entity));

        $sql  = ' INSERT INTO produtos (produto, marca, unidade, descricao) ';
        $sql .= ' VALUES(?,?,?,? ) ' ;

        $stm = $this->con->prepare($sql);

//        $stm->bindValue(1, $entity->getId());
        $stm->bindValue(1, $entity->getProduto());
        $stm->bindValue(2, $entity->getMarca());
        $stm->bindValue(3, $entity->getUnidade());
        $stm->bindValue(4, $entity->getDescricao());

        $inserted = $stm->execute();

        //die(var_dump($inserted));

        // return [
        //     'success' => $inserted,
        //     'data' => [],
        //     'message' => $inserted ? 'registro salvo com sucesso' : 'não foi possível incluir o registro'
        // ];

        return $inserted;
    }

    public function update(\App\Entities\Produto $entity): bool{
        //die(var_dump($entity));

        $sql  = ' UPDATE produtos                             
                            SET produto = ? , 
                            marca = ? , 
                            unidade = ?, 
                            descricao = ? ';

        $sql .= ' WHERE id = ? ' ;

        $stm = $this->con->prepare($sql);

        $stm->bindValue(1, $entity->getProduto());
        $stm->bindValue(2, $entity->getMarca());
        $stm->bindValue(3, $entity->getUnidade());
        $stm->bindValue(4, $entity->getDescricao());
        $stm->bindValue(5, $entity->getId());

        $updated = $stm->execute();

        //die(var_dump($inserted));

        //    return [
        //        'success' => $updated,
        //        'data' => [],
        //        'message' => $update ? 'registro salvo com sucesso' : 'não foi possível incluir o registro'
        //    ];

        return $updated;
    }

    public function delete($id)
    {
        $sql  = ' DELETE FROM produtos ';
        $sql .= ' WHERE id = ? ' ;

        $stm = $this->con->prepare($sql);
        $stm->bindValue(1, $id);

        $deleted = $stm->execute();


        return json_encode([
            'success' => $deleted,
            'data' => [],
            'message' => $deleted ? 'registro excluído com sucesso' : 'não foi possível excluir o registro'
        ]);

        //return $updated;
    }

}